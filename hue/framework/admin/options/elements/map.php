<?php

if(!function_exists('hue_mikado_load_elements_map')) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function hue_mikado_load_elements_map() {

		hue_mikado_add_admin_page(
			array(
				'slug'  => '_elements_page',
				'title' => esc_html__('Elements', 'hue'),
				'icon'  => 'icon_star_alt '
			)
		);

		do_action('hue_mikado_options_elements_map');

	}

	add_action('hue_mikado_options_map', 'hue_mikado_load_elements_map');

}