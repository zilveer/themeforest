<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Recent comments Widget
// **********************************************************************// 

class Etheme_Recent_Comments_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_recent_comments', 'description' => __( 'The most recent comments (Etheme edit)', ET_DOMAIN ) );
        parent::__construct('etheme-recent-comments', '8theme - '.__('Recent Comments', ET_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_recent_comments';

        if ( is_active_widget(false, false, $this->id_base) )
            add_action( 'wp_head', array(&$this, 'recent_comments_style') );

        add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
        add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
    }

    function recent_comments_style() {
        if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
            || ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
            return;
        ?>
<?php
    }

    function flush_widget_cache() {
        wp_cache_delete('etheme_widget_recent_comments', 'widget');
    }

    function widget( $args, $instance ) {
        global $comments, $comment;

        $cache = wp_cache_get('etheme_widget_recent_comments', 'widget');

        if ( ! is_array( $cache ) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        extract($args, EXTR_SKIP);
        $output = '';
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 5;

        $comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) );
        $output .= $before_widget;
        if ( $title != '')
            $output .= $before_title . $title . $after_title;

        $output .= '<ul id="recentcomments">';
        if ( $comments ) {
            foreach ( (array) $comments as $comment) {
                //$output .=  '<li class="recentcomments"><div class="comment-date">' . get_comment_date('d') . ' <span>' . get_comment_date('M') . '</span>' . '</div>' . sprintf(_x('<span class="comment_author">%1$s</span> <br> %2$s', 'widgets'), get_comment_author_link(), '<span class="comment_link"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a></span>') . '<div class="clear"></div></li>';

                $output .=  '<li class="recentcomments">';
                    $output .=  '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '" class="post-title">' . get_the_title($comment->comment_post_ID) . '</a><br>';
                    $output .=  get_the_time('d M Y', $comment->comment_post_ID);
                    $output .=  ' @ '.get_the_time(get_option('time_format'), $comment->comment_post_ID);
                    $output .=  ' '.__('by', ET_DOMAIN).' <span class="comment_author">'.get_comment_author_link().'</span>';
                $output .=  '</li>';
            }
        }
        $output .= '</ul>';
        $output .= $after_widget;

        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('widget_recent_comments', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = absint( $new_instance['number'] );
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['etheme_widget_recent_comments']) )
            delete_option('etheme_widget_recent_comments');

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ET_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:', ET_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
    }
}