<?php

if (!function_exists('libero_mikado_register_widgets')) {

	function libero_mikado_register_widgets() {

		$widgets = array(
			'LiberoLatestPosts',
			'LiberoSearchOpener',
			'LiberoSideAreaOpener',
			'LiberoHolder'
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}

	}

}

add_action('widgets_init', 'libero_mikado_register_widgets');