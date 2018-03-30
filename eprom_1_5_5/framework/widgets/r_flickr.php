<?php

/*
 * Plugin Name: R-Flickr Widget
 * Plugin URI: http://rascals.eu
 * Description: Display images from flickr.
 * Version: 1.2
 * Author: Rascals Labs
 * Author URI: http://rascals.eu
 */
 
class r_flickr_widget extends WP_Widget {

	/* Widget setup */ 
	function __construct() {

		/* Widget settings */ 
		$widget_ops = array(
			'classname' => 'widget_r_flickr',
			'description' => _x('Display images from flickr', 'R-Flickr Widget', SHORT_NAME)
		);

		/* Widget control settings */ 
		$control_ops = array(
			'width' => 200,
			'height' => 200,
			'id_base' => 'r-flickr-widget'
		);

		/* Create the widget */ 
		parent::__construct('r-flickr-widget', _x('R-Flickr', 'Flickr Widget (RT)', SHORT_NAME), $widget_ops, $control_ops);
		
	}

	/* Display the widget on the screen */ 
	function widget($args, $instance) {
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$source = (isset($instance['flickr_source'])) ? $source = $instance['flickr_source'] : $source = 'user';
		$display = (isset($instance['flickr_display'])) ? $display = $instance['flickr_display'] : $source = 'latest';
		$id = (isset($instance['flickr_id']) && $instance['flickr_id'] != '') ? $id = $instance['flickr_id'] : $id ='';
		$set = (isset($instance['flickr_set']) && $instance['flickr_set'] != '') ? $set = $instance['flickr_set'] : $set ='';
		$nr = (isset($instance['flickr_limit']) && $instance['flickr_limit'] != '') ? $nr = $instance['flickr_limit'] : $nr = 6;
		
		echo $before_widget;
		
		if (isset($title)) echo $before_title . $title . $after_title;
        if ($source == 'user' && $id != '') {
		    echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $nr . '&amp;display='.$display.'&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $id . '"></script>';
		} else if ($source == 'set' && $set != '') {
			echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $nr . '&amp;display='.$display.'&amp;size=s&amp;layout=x&amp;source=user_set&amp;set=' . $set . '"></script>';
		} else {
			echo '<p>' . _x('The Flickr ID or user set is invalid or does not exist.', 'R-Flickr Widget', SHORT_NAME) . '</p>';
		}
		
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_source'] = strip_tags($new_instance['flickr_source']);
		$instance['flickr_display'] = strip_tags($new_instance['flickr_display']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_set'] = strip_tags($new_instance['flickr_set']);
		$instance['flickr_limit'] = strip_tags($new_instance['flickr_limit']);
		
		return $instance;
		
	}

	function form($instance) {
		$defaults = array('title' => _x('Flickr', 'R-Flickr Widget', SHORT_NAME), 'flickr_source' => 'user', 'flickr_display' => 'latest', 'flickr_id' => '', 'flickr_set' => '', 'flickr_limit' => '6');
		$instance = wp_parse_args((array)$instance, $defaults);
		$options = array(array('value' => 'user', 'label' => 'User'), array('value' => 'set', 'label' => 'User set'));
		$options_display = array(array('value' => 'latest', 'label' => 'Latest'), array('value' => 'random', 'label' => 'Random'));
		echo '<p>';
			echo '<label for="' . $this->get_field_id('title') . '">' . _x('Title:', 'R-Flickr Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('title') . '" type="text" name="' . $this->get_field_name('title') . '" value="' . $instance['title'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('flickr_source') . '">' . _x('Flickr Source:', 'R-Flickr Widget', SHORT_NAME) . '</label>';
			echo '<select id="' . $this->get_field_id('flickr_source') . '" name="' . $this->get_field_name('flickr_source') . '"  style="width:100%;" >';
				
			foreach($options as $option) {
					
				if ($instance['flickr_source'] == $option['value']) $selected = 'selected="selected"';
				else $selected = '';
					
	     		echo '<option ' . $selected . ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
			}
				
			echo '</select>';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('flickr_display') . '">' . _x('Flickr Source:', 'R-Flickr Widget', SHORT_NAME) . '</label>';
			echo '<select id="' . $this->get_field_id('flickr_display') . '" name="' . $this->get_field_name('flickr_display') . '"  style="width:100%;" >';
				
			foreach($options_display as $option) {
					
				if ($instance['flickr_display'] == $option['value']) $selected = 'selected="selected"';
				else $selected = '';
					
	     		echo '<option ' . $selected . ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
			}
				
			echo '</select>';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('flickr_id') . '">' . _x('Flickr ID:', 'R-Flickr Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('flickr_id') . '" type="text" name="' . $this->get_field_name('flickr_id') . '" value="' . $instance['flickr_id'] . '" class="widefat" />';
			echo '<small style="line-height:12px;">Displays photos from a user or group. <a href="http://www.idgettr.com">' . _x('Find your Flickr user or group id', 'R-Flickr Widget', SHORT_NAME) . '</a></small>';
			echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('flickr_set') . '">' . _x('Flickr Set:', 'R-Flickr Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('flickr_set') . '" type="text" name="' . $this->get_field_name('flickr_set') . '" value="' . $instance['flickr_set'] . '" class="widefat" />';
			echo '<small style="line-height:12px;">Displays photos from a photo set. The set ID is at the end of the URL.</small>';
		echo '</p>';
      echo '<p>';
			echo '<label for="' . $this->get_field_id('flickr_limit') . '">' . _x('Number of photos:', 'R-Flickr Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('flickr_limit') . '" type="text" name="' . $this->get_field_name('flickr_limit') . '" value="' . $instance['flickr_limit'] . '" class="widefat" />';
			echo '<small style="line-height:12px;">Number of thumbnails to show. Limit of 10 thumbnails.</small>';
		echo '</p>';
		
	}
	
}

register_widget('r_flickr_widget');

?>