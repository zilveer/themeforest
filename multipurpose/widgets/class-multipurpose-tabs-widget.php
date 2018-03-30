<?php
add_action('widgets_init', 'multipurpose_tabs_widget_register');

function multipurpose_tabs_widget_register() {
    register_widget('multipurpose_tabs_widget');
}

class multipurpose_tabs_widget extends WP_Widget
{
    private $fields;
    private $comment_excerpt_length = 4;
    private $avatar_size = 40;

    public function __construct()
    {
        parent::__construct(
            'tabs',
            esc_attr__( 'MultiPurpose Tabs', 'multipurpose' ),
            array(
                'description' => esc_attr__( 'Tabs', 'multipurpose' ),
            )
        );

        /**
         * widget options
         */
        $this->fields = array(
            'select' => array(
                'order' => array(
                    'label' => esc_attr__( 'Popular Posts Order By:', 'multipurpose' ),
                    'options' => array(
                        'comment_count' => esc_attr__( 'Highest Comments', 'multipurpose' ),
                    ),
                    'default' => 'comment_count',
                ),
            ),
            'number' => array(
                'number_of_popular' => esc_attr__( 'Number of popular posts to show:', 'multipurpose' ),
                'number_of_recent' => esc_attr__( 'Number of recent posts to show:', 'multipurpose' ),
                'number_of_comments' => esc_attr__( 'Number of comments to show:', 'multipurpose' ),
            ),
            'checkbox' => array(
                'show_popular' => array(
                    'label' => esc_attr__( 'Show popular posts', 'multipurpose' ),
                    'href' => 'popular',
                    'link' => esc_attr__( 'Popular', 'multipurpose' ),
                ),
                'show_recent' => array(
                    'label' =>  esc_attr__( 'Show recent posts', 'multipurpose' ),
                    'href' => 'recent',
                    'link' => esc_attr__( 'Recent', 'multipurpose' ),
                ),
                'show_comments' => array(
                    'label' =>  esc_attr__( 'Show comments', 'multipurpose' ),
                    'href' => 'comments',
                    'link' => esc_attr__( 'Comments', 'multipurpose' ),
                ),
                'show_tags' => array(
                    'label' =>  esc_attr__( 'Show tags', 'multipurpose' ),
                    'href' => 'tags',
                    'link' => esc_attr__( 'Tags', 'multipurpose' ),
                ),
            ),
        );
    }

    public function widget($args, $instance)
    {
        $instance = $this->parse_defaults($instance);
        echo $args['before_widget'];
        echo '<div class="tabbed"><ul class="tabs">';
        foreach( $this->fields['checkbox'] as $key => $labels ) {
            if ( $instance[$key] ) {
                printf(
                    '<li><a href="#%s">%s</a></li>',
                    $labels['href'],
                    $labels['link']
                );
            }
        }
        echo '</ul>';
        $this->get_popular($instance);
        $this->get_recent($instance);
        $this->get_comments($instance);
        $this->get_tags($instance);
        echo '</div>';
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $instance = $this->parse_defaults($instance);
        foreach ( $this->fields as $type => $one ) {
            foreach( $one as $key => $labels ) {
                switch($type) {
                case 'select':
                    if ( count( $labels['options'] ) > 1 ) {
                        echo '<p>';
                        printf(
                            '<label for="%s">%s</label>',
                            $this->get_field_id($key),
                            $labels['label']
                        );
                        printf(
                            '<select id="%s" name="%s">',
                            $this->get_field_id($key),
                            $this->get_field_name($key)
                        );
                        foreach( $labels['options'] as $option_value => $option_label ) {
                            printf(
                                '<option value="%s"%s>%s</option>',
                                $option_value,
                                $instance[$key] == $option_value ? ' selected="selected"':'',
                                $option_label
                            );
                        }
                        echo '</select>';
                        echo '</p>';
                    } elseif ( 1 == count( $labels['options'] ) ) {
                        printf(
                            '<input type="hidden" name="%s" value="%s" />',
                            $this->get_field_name($key),
                            $instance[$key]
                        );

                    }
                    break;
                case 'checkbox':
                    echo '<p>';
                    printf(
                        '<input type="checkbox" name="%s" id="%s" %s /><label for="%s"> %s</label>',
                        $this->get_field_name($key),
                        $this->get_field_id($key),
                        $instance[$key]? 'checked="checked"':'',
                        $this->get_field_id($key),
                        $labels['label']
                    );
                    echo '</p>';
                    break;
                case 'number':
                    echo '<p>';
                    printf(
                        '<label for="%s">%s </label><input type="number" name="%s" id="%s" class="small-text" min="1" value="%d"/>',
                        $this->get_field_id($key),
                        $labels,
                        $this->get_field_name($key),
                        $this->get_field_id($key),
                        $instance[$key]
                    );
                    echo '</p>';
                    break;
                default:
                    echo '<p>';
                    printf( 'error: %s', $type );
                    echo '</p>';
                }
            }
        }
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        foreach ( $this->fields as $type => $one ) {
            foreach( $one as $key => $label ) {
                switch($type) {
                case 'checkbox':
                    $instance[$key] = empty($new_instance[$key])? false:true;
                    break;
                case 'number':
                    $instance[$key] = empty($new_instance[$key])? 0:(int)$new_instance[$key];
                    break;
                default:
                }
            }
        }
        return $instance;
    }

    private function parse_defaults($instance)
    {
        foreach ( $this->fields as $type => $one ) {
            foreach( $one as $key => $labels ) {
                switch($type) {
                case 'checkbox':
                    $defaults[$key] = false;
                    break;
                case 'number':
                    $defaults[$key] = 1;
                    break;
                case 'select':
                    $defaults[$key] = $labels['default'];
                    break;
                default:
                    $defaults[$key] = null;
                }
            }
        }
        return wp_parse_args( $instance, $defaults );
    }

    private function get_popular($instance)
    {
        if(!$instance['show_popular']){
            return;
        }
        $this->tab('start', 'popular');
        $args = array(
            'ignore_sticky_posts' => 1,
            'orderby' => $instance['order'],
            'posts_per_page' => $instance['number_of_popular'],
        );
        $this->get_posts($args);
        $this->tab('end');
    }

    private function get_recent($instance)
    {
        if(!$instance['show_recent']){
            return;
        }
        $this->tab('start', 'recent');
        $args = array(
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $instance['number_of_recent'],
        );
        $this->get_posts($args);
        $this->tab('end');
    }

    private function get_comments($instance)
    {
        if(!$instance['show_comments']){
            return;
        }
        $this->tab('start', 'comments');
        $args =  array(
            'number' => $instance['number_of_comments'],
            'post_status' => 'publish',
            'status' => 'approve',
        );
        $comments = get_comments($args);
        if ( $comments ) {

            echo '<ul class="recent-comments">';
            foreach ( (array) $comments as $comment) {
                echo '<li>';
                $author = get_comment_author( $comment->comment_ID );
                $url    = get_comment_author_link( $comment->comment_ID );
                if ( $url == $author ) {
                    echo get_avatar(get_comment_author_email($comment->comment_ID), $this->avatar_size );
                } else {
                    printf(
                        '<a href="%s" rel="external nofollow">%s</a>',
                        get_comment_author_url($comment->comment_ID),
                        get_avatar(get_comment_author_email($comment->comment_ID), $this->avatar_size )
                    );
                }
                printf(
                    '<p class="comment-head">%s</p>',
                    sprintf(
                        __( '<span class="who">%1$s</span> on <a href="%2$s">%3$s</a>', 'multipurpose' ),
                        get_comment_author($comment->comment_ID),
                        get_comment_link($comment),
                        apply_filters( 'the_title', $comment->post_title )
                    )
                );
                printf(
                    '<p>%s</p>',
                    $this->get_comment_excerpt($comment)
                );
                echo '</li>';
            }
            echo '</ul>';
        }

        $this->tab('end');
    }

    private function get_tags($instance)
    {
        if(!$instance['show_tags']){
            return;
        }
        $this->tab('start', 'tags');
        wp_tag_cloud();
        $this->tab('end');
    }

    private function tab($type, $kind = '')
    {
        switch( $type ) {
        case 'start':
            printf( '<div class="tab-content" id="%s">', $kind );
            break;
        case 'end':
            echo '</div>';
            break;
        }
    }

    private function get_posts($args)
    {
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<ul class="posts">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                echo '<li>';
                if(has_post_thumbnail()) {
                    printf(
                        '<a href="%s">%s</a>',
                        get_permalink(),
                        get_the_post_thumbnail( get_the_ID(), 'thumbnail-widget' )

                    );
                }
                printf(
                    '<a href="%s">%s</a>',
                    get_permalink(),
                    get_the_title()
                );
                printf(
                    __( '<span>%1$s by %2$s</span>', 'multipurpose' ),
                    get_the_date(),
                    get_the_author()
                );
                echo '</li>';
            }
            echo '</ul>';
        }
        wp_reset_postdata();
        wp_reset_query();
    }

    private function get_comment_excerpt($comment)
    {
        $comment_text = strip_tags($comment->comment_content);
        $blah = explode(' ', $comment_text);
        if (count($blah) > $this->comment_excerpt_length) {
            $k = $this->comment_excerpt_length;
            $use_dotdotdot = 1;
        } else {
            $k = count($blah);
            $use_dotdotdot = 0;
        }
        $excerpt = '';
        for ($i=0; $i<$k; $i++) {
            $excerpt .= $blah[$i] . ' ';
        }
        $excerpt .= ($use_dotdotdot) ? '&hellip;' : '';
        return apply_filters('get_comment_excerpt', $excerpt);
    }
}
