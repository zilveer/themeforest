<?php

/**
 * google map widget
 */

class wpv_gmap_widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'wpv_gmap_widget',
			'description' => __('Displays a google map.', 'health-center')
		);
		parent::__construct('gmap', __('Vamtam - Gmap', 'health-center') , $widget_ops);
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$address = $instance['address'];
		$latitude = !empty($instance['latitude']) ? $instance['latitude'] : 0;
		$longitude = !empty($instance['longitude']) ? $instance['longitude'] : 0;
		$zoom = (int) $instance['zoom'];
		$html = $instance['html'];
		$popup = $instance['popup'];
		$height = (int) $instance['height'];

		include(locate_template('templates/widgets/front/gmap.php'));
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['latitude'] = strip_tags($new_instance['latitude']);
		$instance['longitude'] = strip_tags($new_instance['longitude']);

		$zoom = (int)$new_instance['zoom'];
		if ($zoom < 1)
			$zoom = 1;
		if ($zoom > 19)
			$zoom = 19;

		$instance['zoom'] = $zoom;
		$instance['html'] = strip_tags($new_instance['html']);
		$instance['popup'] = !empty($new_instance['popup']) ? 1 : 0;
		$instance['height'] = (int) $new_instance['height'];
		return $instance;
	}

	public function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$latitude = isset($instance['latitude']) ? esc_attr($instance['latitude']) : '';
		$longitude = isset($instance['longitude']) ? esc_attr($instance['longitude']) : '';
		$zoom = isset($instance['zoom']) ? absint($instance['zoom']) : 14;
		$html = isset($instance['html']) ? esc_attr($instance['html']) : '';
		$popup = isset($instance['popup']) ? (bool) $instance['popup'] : false;
		$height = isset($instance['height']) ? absint($instance['height']) : 250;

		include(locate_template('templates/widgets/conf/gmap.php'));
	}
}
register_widget('wpv_gmap_widget');
