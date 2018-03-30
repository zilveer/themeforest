<?php
class wize_widget_vimeo extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_vimeo() {
        $widget_opts = array(
            'classname' => 'widget_vimeo',
            'description' => __('This widget displays a Vimeo video.', 'wizedesign')
        );
        parent::__construct('widget-vimeo', esc_html__('BEATON - Vimeo', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        $code  = $instance['code'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
		
        if ($code) {
            echo '
	<div id="wd-vimeo">
		<iframe src="http://player.vimeo.com/video/' . esc_attr($code) . '" width="364" height="280" frameborder="0" allowFullScreen></iframe>
	</div><!-- end #wd-vimeo -->';
        }
		
        /* after widget */
		
        echo $after_widget;
    }
	
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
	
    function update($new_instance, $old_instance) {
        $instance          = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['code']  = strip_tags($new_instance['code']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Vimeo Video',
            'code' => null
        ));
		
        /* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '"> ' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>
	<p>
		<label for="' . esc_attr($this->get_field_id('code')) . '">' . esc_html__('Vimeo Code:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('code')) . '" name="' . esc_attr($this->get_field_name('code')) . '" value="' . esc_attr($instance['code']) . '" />
	</p>
	<p>' . esc_html__('eg CODE:', 'wizedesign') . ' https://vimeo.com/<b>108325020</b></p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_vimeo");'));