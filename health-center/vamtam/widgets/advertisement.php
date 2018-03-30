<?php

/**
 * advertisement widget
 */

class wpv_advertisement extends WP_Widget {

	private $max_ads = 10;

	public function __construct() {
		$widget_opts = array(
			'classname' => 'wpv_advertisement',
			'description' => __('Displays ads', 'health-center' )
		);
		parent::__construct('wpv_advertisement', __('Vamtam - Advertisement', 'health-center'), $widget_opts);
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$count = (int)$instance['count'];

		include(locate_template('templates/widgets/front/advertisement.php'));
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = (int) $new_instance['count'];
		for($i=1; $i<=$instance['count']; $i++){
			$instance['ad_image'][$i] = strip_tags($new_instance['ad_image_'.$i]);
			$instance['ad_link'][$i] = strip_tags($new_instance['ad_link_'.$i]);
		}
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		for($i=1; $i<=$this->max_ads; $i++){
			$selected_ad_image[$i] = isset($instance['ad_image'][$i]) ? $instance['ad_image'][$i] : '';
			$selected_ad_link[$i] = isset($instance['ad_link'][$i]) ? $instance['ad_link'][$i] : '';
		}

		include(locate_template('templates/widgets/conf/advertisement.php'));
	}
}

register_widget('wpv_advertisement');
