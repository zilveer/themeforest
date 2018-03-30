<?php
class wize_widget_flickr extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_flickr() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'widget_flickr',
            'description' => __('Display images from a Flickr account.', 'wizedesign')
        );
        parent::__construct('widget-flickr', esc_html__('BEATON - Flickr', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        $id    = $instance['id'];
        if (!$number = (int) $instance['number']) {
            $number = 3;
        } else if ($number < 1) {
            $number = 1;
        } else if ($number > 9) {
            $number = 9;
        }
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
		
        echo '
    <div id="wd-flickr">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $number . '&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $id . '"></script>
    </div><!-- end #wd-flickr -->';
	
        /* after widget */
		
        echo $after_widget;
    }
	
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
	
    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['id']     = strip_tags($new_instance['id']);
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Photos on flickr',
            'id' => null,
            'number' => 9
        ));
		
        /* display the admin form */
		
        echo '
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>	
	<p>
        <label for="' . esc_attr($this->get_field_id('id')) . '">' . __('Flickr ID <a href="http://www.idgettr.com" target="_blank">idGettr</a>', 'wizedesign') . ':</label>
        <input class="widefat" id="' . esc_attr($this->get_field_id('id')) . '" name="' . esc_attr($this->get_field_name('id')) . '" type="text" value="' . esc_attr($instance['id']) . '" />
	</p>
	<p>
        <label for="' . esc_attr($this->get_field_id('number')) . '">' . esc_html__('Number of photos:', 'wizedesign') . '</label>
        <input class="widefat" id="' . esc_attr($this->get_field_id('number')) . '" name="' . esc_attr($this->get_field_name('number')) . '" type="text" value="' . esc_attr($instance['number']) . '" />
	</p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_flickr");'));