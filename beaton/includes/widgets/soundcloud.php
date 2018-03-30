<?php
class wize_widget_soundcloud extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_soundcloud() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'widget_soundcloud',
            'description' => __('This widget displays the SoundCloud player.', 'wizedesign')
        );
        parent::__construct('widget-soundcloud', esc_html__('BEATON - SoundCloud', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title      = apply_filters('widget_title', $instance['title']);
        $soundcloud = $instance['soundcloud_api'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display */
		
        if ($soundcloud) {
            echo '
    <div id="wd-soundcloud">
		<iframe height="300" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $soundcloud . '&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
    </div><!-- end #wd-soundcloud -->';
        }
		
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
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'SoundCloud',
            'soundcloud_api' => null
        ));
		
        /* display the admin form */
		
        echo '
		
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>	
	<p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('SoundCloud API:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('soundcloud_api')) . '" name="' . esc_attr($this->get_field_name('soundcloud_api')) . '" value="' . esc_attr($instance['soundcloud_api']) . '" />
	</p>
		';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_soundcloud");'));