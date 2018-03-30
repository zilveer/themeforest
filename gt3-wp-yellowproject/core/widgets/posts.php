<?php

class posts extends WP_Widget
{

    function posts()
    {
        // Instantiate the parent object
        parent::__construct(false, 'Posts (current theme)');
    }

    function widget($args, $instance)
    {
        extract($args);

        echo $before_widget;
        echo $before_title;
        echo $instance['widget_title'];
        echo $after_title;

        #Output widget here

        if (!isset($compilepopular)) {
            $compilepopular = '';
        }

        #Popular posts
        $args = array(
            'showposts' => $instance['posts_widget_number'],
            'offset' => 0,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        );

        $temp_latest = (isset($wp_query) ? $wp_query : '');
        $wp_query_latest = null;
        $wp_query_latest = new WP_Query();
        $wp_query_latest->query($args);
        while ($wp_query_latest->have_posts()) : $wp_query_latest->the_post();
            $featured_image_latest = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
            $firstCat = get_the_category(get_the_ID());

            $readmorelinktext = ((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more...', 'theme_localization'));


            $compilepopular .= '

			<li>
			    <div class="img_wrapper">';
            if (has_post_thumbnail()) {
                $compilepopular .= '<img class="alignleft" src="' . aq_resize($featured_image_latest[0], 88, 88, true, true, true) . '" alt="' . get_the_title() . '">';
            }

            $compilepopular .= '
                </div>
                <div class="recent_posts_content">
                    <span class="post_date">' . get_the_date() . '</span>
                    <p>
                        ' . smarty_modifier_truncate(get_the_excerpt(), 45) . '
                    </p>
                    <span class="read_more"><a href="' . get_permalink() . '">' . $readmorelinktext . '</a></span>
                </div>
			</li>
			
		';

        endwhile;
        wp_reset_query();


        echo '
			<ul class="recent_posts">
				' . $compilepopular . '
			</ul>
		';

        #END OUTPUT

        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr( $new_instance['widget_title'] );
        $instance['posts_widget_number'] = absint( $new_instance['posts_widget_number'] );

        return $instance;
    }

    function form($instance)
    {

        $defaultValues = array(
            'widget_title' => 'Posts',
            'posts_widget_number' => '2'
        );
        $instance = wp_parse_args((array)$instance, $defaultValues);
        ?>
        <table class="fullwidth">
            <tr>
                <td>Title:</td>
                <td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name('widget_title'); ?>'
                           value='<?php echo $instance['widget_title']; ?>'/></td>
            </tr>
            <tr>
                <td>Number:</td>
                <td><input type='text' class="fullwidth"
                           name='<?php echo $this->get_field_name('posts_widget_number'); ?>'
                           value='<?php echo $instance['posts_widget_number']; ?>'/></td>
            </tr>
        </table>
        <?php
    }
}

function posts_register_widgets()
{
    register_widget('posts');
}

add_action('widgets_init', 'posts_register_widgets');