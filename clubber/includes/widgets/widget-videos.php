<?php
class Videos_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Videos_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'videos_widget',
            'description' => __('Display your latest Videos.', 'clubber')
        );
        parent::__construct('videos-widget', esc_html__('CLUBBER - Latest Videos', 'clubber'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title  = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */
?>
		
	<?php
        global $post;
        $query = new WP_Query();
        $query->query('post_type=video&posts_per_page=' . $number);
        echo '
    <div class="widgets-col">';
        while ($query->have_posts()):
            $query->the_post();
            $video    = get_post_meta($post->ID, "video_link", true);
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'video-widgets');
?>
                                     
      <div class="video-widget-cover bar-widget-video">
        <a href="<?php echo $video; ?>" rel="prettyPhoto">
            <?php
            if ($image_id) {
                echo '
          <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
            } else {
                echo '
          <img src="' . get_template_directory_uri() . '/images/no-featured/video-widget.png" alt="no image" />';
            }
?>
          <div class="media-title mosaic-overlay"><?php if (strlen($post->post_title) > 39) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 39) . '...'; } else {
the_title();
} ?></div><!-- end .media-title -->
        </a>
      </div><!-- end .video-widget-cover -->

<?php
        endwhile;
        echo '
    </div><!-- .event-widgets-col-->';
        wp_reset_query();
?>
		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Latest Videos',
            'number' => 1
        ));
        // Display the admin form
?>
        <p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('Title:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('title');
?>" name="<?php
        echo $this->get_field_name('title');
?>" value="<?php
        echo $instance['title'];
?>" />
	</p>
		
	<p>
		<label for="<?php
        echo $this->get_field_id('number');
?>"><?php
        _e('Posts Number:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('number');
?>" name="<?php
        echo $this->get_field_name('number');
?>" value="<?php
        echo $instance['number'];
?>" />
	</p>
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("Videos_Widget");'));
?>