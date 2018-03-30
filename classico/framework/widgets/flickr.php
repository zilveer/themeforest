<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Flickr Photos
// **********************************************************************// 
class Etheme_Flickr_Widget extends WP_Widget {
    
    function __construct()
    {
        $widget_ops = array('classname' => 'flickr', 'description' => 'Photos from flickr.');
        $control_ops = array('id_base' => 'etheme_flickr-widget');
        parent::__construct('etheme_flickr-widget', '8theme Flickr Photos', $widget_ops, $control_ops);
    }
    
    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Flickr', ET_DOMAIN) : $instance['title'], $instance, $this->id_base);
        $screen_name = @$instance['screen_name'];
        $number = @$instance['number'];
        $show_button = @$instance['show_button'];
        
        if(!$screen_name || $screen_name == '') {
            $screen_name = '95572727@N00';
        }
        
        echo $before_widget;
        if($title) {
            echo $before_title.'<span class="footer_title">'.$title.'</span>'.$after_title;
        }
        
        if($screen_name && $number) {
			echo '<script type="text/javascript" src="//www.flickr.com/badge_code_v2.gne?count='.$number.'&display=latest&size=s&layout=x&source=user&user='.$screen_name.'"></script>';
        }
        
        echo $after_widget;
    }
    
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['screen_name'] = $new_instance['screen_name'];
        $instance['number'] = $new_instance['number'];
        
        return $instance;
    }

    function form($instance)
    {
        $defaults = array('title' => 'Photos from Flickr', 'screen_name' => '', 'number' => 6, 'show_button' => 1);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('screen_name'); ?>">Flickr ID</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" value="<?php echo $instance['screen_name']; ?>" />
            <br/>
            <p class="help">To find your flickID visit <a href="http://idgettr.com/" target="_blank">idGettr</a>.</p>
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">Number of photos to show:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
        </p>
        
        
    <?php
    }
}
