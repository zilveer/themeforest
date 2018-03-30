<?php

/**
 * contact info widget
 */

class WPV_Flickr_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'wpv_flickr',
			'description' => __( 'Displays photos from Flickr', 'health-center' )
		);
		parent::__construct('wpv_flickr', __('Vamtam - Flickr', 'health-center'), $widget_ops);
	}

	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Photos on flickr', 'health-center') : $instance['title'], $instance, $this->id_base);
		$type = empty($instance['type']) ? 'user' : $instance['type'];
		$flickr_id = $instance['flickr_id'];
		$count = (int) $instance['count'];
		$display = empty($instance['display']) ? 'latest' : $instance['display'];

		include(locate_template('templates/widgets/front/flickr.php'));
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['count'] = (int) $new_instance['count'];
		$instance['display'] = strip_tags($new_instance['display']);

		return $instance;
	}

	public function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$type = isset($instance['type']) ? esc_attr($instance['type']) : 'user';
		$flickr_id = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';

		include(locate_template('templates/widgets/conf/flickr.php'));
	}
}

register_widget('WPV_Flickr_Widget');
