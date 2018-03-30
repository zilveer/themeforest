<?php

/**
 * Plugin Name: R-Comments Widget
 * Plugin URI: http://rascals.eu
 * Description: Display latests comments.
 * Version: 1.1
 * Author: Rascals Labs
 * Author URI: http://rascals.eu
 */

class r_comments_widget extends WP_Widget {

	/* Widget setup */
	function __construct() {

		/* Widget settings */
		$widget_ops = array(
			'classname' => 'widget_r_comments',
			'description' => _x('Display latests comments', 'R-Comments Widget', SHORT_NAME)
		);

		/* Widget control settings */ 
		$control_ops = array(
			'width' => 200,
			'height' => 200,
			'id_base' => 'r-comments-widget'
		);

		/* Create the widget */
		parent::__construct('r-comments-widget', _x('R-Comments', 'Comments Widget (RT)', SHORT_NAME), $widget_ops, $control_ops);
		
	}

	/* Display the widget on the screen */ 
	function widget($args, $instance) {
		
		global $wpdb, $r_option;
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$limit = ($instance['comments_nr'] != '') ? $limit = $instance['comments_nr'] : $limit = 2;
		$length = ($instance['length'] != '') ? $length = $instance['length'] : $length = 5;
		
		echo $before_widget;
		
		if (isset($title)) echo $before_title . $title . $after_title;
		
		echo r_recent_comments($atts = array('limit' => $limit, 'length' => $length));
		
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['comments_nr'] = $new_instance['comments_nr'];
		$instance['length'] = $new_instance['length'];
		
		return $instance;
		
	}

	function form($instance) {
		$defaults = array('title' => _x('Recent Comments', 'R-Comments Widget', SHORT_NAME), 'comments_nr' => '3', 'length' => '5');
		$instance = wp_parse_args((array)$instance, $defaults);
		echo '<p>';
		echo '<label for="' . $this->get_field_id('title') . '">' . _x('Title:', 'R-Comments Widget', SHORT_NAME) . '</label>';
		echo '<input id="' . $this->get_field_id('title') . '" type="text" name="' . $this->get_field_name('title') . '" value="' . $instance['title'] . '" class="widefat" />';
		echo '</p>';
        echo '<p>';
		echo '<label for="' . $this->get_field_id('comments_nr') . '">' . _x('Number of comments:', 'R-Comments Widget', SHORT_NAME) . '</label>';
		echo '<input id="' . $this->get_field_id('comments_nr') . '" type="text" name="' . $this->get_field_name('comments_nr') . '" value="' . $instance['comments_nr'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
		echo '<label for="' . $this->get_field_id('length') . '">' . _x('Type the word limit for the comment:', 'R-Comments Widget', SHORT_NAME) . '</label>';
		echo '<input id="' . $this->get_field_id('length') . '" type="text" name="' . $this->get_field_name('length') . '" value="' . $instance['length'] . '" class="widefat" />';
        echo '<small style="line-height:12px;">' . _x('Enter the number of words eg: 5.', 'R-Comments Widget', SHORT_NAME) . '</small>';
		echo '</p>';
		
	}
	
}

register_widget('r_comments_widget');

?>