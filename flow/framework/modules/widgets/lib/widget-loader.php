<?php

if (!function_exists('flow_elated_register_widgets')) {

	function flow_elated_register_widgets() {

		$widgets = array(
			'FlowLatestPosts',
			'FlowStickySidebar',
			'FlowSocialIconWidget',
			'FlowSearch'
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'flow_elated_register_widgets');