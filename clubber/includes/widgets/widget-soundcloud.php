<?php
class SoundCloud_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function SoundCloud_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'soundcloud_widget',
            'description' => __('Display your SoundCloud.', 'clubber')
        );
        parent::__construct('soundcloud-widget', esc_html__('CLUBBER - SoundCloud', 'clubber'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */
?>
		


<?php
        $soundcloud = $instance['soundcloud_api'];
        if ($soundcloud != null) {
            echo '
    <div class="widgets-col">
<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F' . $soundcloud . '&show_artwork=true"></iframe>
    </div><!-- end .widgets-col -->';
        }
?>


		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags($new_instance['title']);
        $instance['soundcloud_api'] = strip_tags($new_instance['soundcloud_api']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'SoundCloud',
            'soundcloud_api' => null
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
			
	<p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('SoundCloud API:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('soundcloud_api');
?>" name="<?php
        echo $this->get_field_name('soundcloud_api');
?>" value="<?php
        echo $instance['soundcloud_api'];
?>" />
	</p>
	
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("SoundCloud_Widget");'));
?>