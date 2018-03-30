<?php

/**
 * Plugin Name: R-Posts Widget
 * Plugin URI: http://rascals.eu
 * Description: Display latest posts.
 * Version: 1.1
 * Author: Rascals Labs
 * Author URI: http://rascals.eu
 */
 
class r_posts_widget extends WP_Widget {

	/* Widget setup */ 
	function __construct() {

		/* Widget settings */ 
		$widget_ops = array(
			'classname' => 'widget_r_posts',
			'description' => _x('Display latest posts', 'R-Posts Widget', SHORT_NAME)
		);

		/* Widget control settings */ 
		$control_ops = array(
			'width' => 200,
			'height' => 200,
			'id_base' => 'r-posts-widget'
		);

		/* Create the widget */
		parent::__construct('r-posts-widget', _x('R-Posts', 'Posts Widget (RT)', SHORT_NAME), $widget_ops, $control_ops);
		
	}

	/* Display the widget on the screen */ 
	function widget($args, $instance) {
		
		global $post, $wp_query, $r_option;
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$cat = (get_cat_ID($instance['posts_cat']) != '_all') ? $cat = get_cat_ID($instance['posts_cat']) : $cat = '_all';
		$limit = ($instance['posts_limit'] != '') ? $limit = $instance['posts_limit'] : $limit = 3;

		echo $before_widget;
		
		if ($title) echo $before_title . $title . $after_title;
		
		echo r_recent_posts($atts = array('cat' => $cat, 'limit' => $limit, 'date_format' => $instance['date_format']));
        
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_cat'] = $new_instance['posts_cat'];
		$instance['posts_limit'] = $new_instance['posts_limit'];
		$instance['date_format'] = $new_instance['date_format'];
		
		return $instance;
		
	}

	function form($instance) {
		
		$defaults = array('title' => _x('Recent Posts', 'R-Posts Widget', SHORT_NAME), 'posts_cat' => '_all', 'posts_limit' => '3', 'date_format' => 'd/m/y');
		$instance = wp_parse_args((array)$instance, $defaults);
		$options_dates = array(array('value' => 'd/m/y', 'label' => 'd/m/y'), array('value' => 'm/d/y', 'label' => 'm/d/y'));
		echo '<p>';
			echo '<label for="' . $this->get_field_id('title') . '">' . _x('Title:', 'R-Posts Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('title') . '" type="text" name="' . $this->get_field_name('title') . '" value="' . $instance['title'] . '" class="widefat" />';
		echo '</p>';

      echo '<p>';
			echo '<label for="' . $this->get_field_id('posts_cat') . '">' . _x('Select category:', 'R-Posts Widget', SHORT_NAME) . '</label>';
			echo '<select id="' . $this->get_field_id('posts_cat') . '" name="' . $this->get_field_name('posts_cat') . '" class="widefat" style="width:100%;">';
			
			if ($instance['posts_cat'] == '_all') $selected = 'selected="selected"';
			else $selected = '';
			
			echo '<option ' . $selected . ' value="_all">' . _x('All', 'R-Posts Widget', SHORT_NAME) . '</option>';
				
			foreach((get_categories()) as $category) {
					
				if ($instance['posts_cat'] == $category->cat_name) $selected = 'selected="selected"';
				else $selected = '';
					
	     		echo '<option ' . $selected . ' value="' . $category->cat_name . '">' . $category->cat_name . '</option>';
			}
				
			echo '</select>';
		echo '</p>';

      echo '<p>';
			echo '<label for="' . $this->get_field_id('posts_limit') . '">' . _x('Number of posts to show:', 'R-Posts Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('posts_limit') . '" type="text" name="' . $this->get_field_name('posts_limit') . '" value="' . $instance['posts_limit'] . '" class="widefat" />';
		echo '</p>';

		echo '<p>';
			echo '<label for="' . $this->get_field_id('date_format') . '">' . _x('Date format:', 'R-Posts Widget', SHORT_NAME) . '</label>';
			echo '<select id="' . $this->get_field_id('date_format') . '" name="' . $this->get_field_name('date_format') . '"  style="width:100%;" >';
			
			foreach($options_dates as $option) {
					
				if ($instance['date_format'] == $option['value']) $selected = 'selected="selected"';
				else $selected = '';
					
	     		echo '<option ' . $selected . ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
			}
			
		echo '</select>';
		
	}
	
}

register_widget('r_posts_widget');

?>