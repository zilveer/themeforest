<?php

if(!function_exists('hue_mikado_parallax_options_map')) {
	/**
	 * Parallax options page
	 */
	function hue_mikado_parallax_options_map() {

		$panel_parallax = hue_mikado_add_admin_panel(
			array(
				'page'  => '_elements_page',
				'name'  => 'panel_parallax',
				'title' => esc_html__('Parallax', 'hue')
			)
		);

		hue_mikado_add_admin_field(array(
			'type'          => 'onoff',
			'name'          => 'parallax_on_off',
			'default_value' => 'off',
			'label'         => esc_html__('Parallax on touch devices', 'hue'),
			'description'   => esc_html__('Enabling this option will allow parallax on touch devices', 'hue'),
			'parent'        => $panel_parallax
		));

		hue_mikado_add_admin_field(array(
			'type'          => 'text',
			'name'          => 'parallax_min_height',
			'default_value' => '400',
			'label'         => esc_html__('Parallax Min Height', 'hue'),
			'description'   => esc_html__('Set a minimum height for parallax images on small displays (phones, tablets, etc.)', 'hue'),
			'args'          => array(
				'col_width' => 3,
				'suffix'    => 'px'
			),
			'parent'        => $panel_parallax
		));

	}

	add_action('hue_mikado_options_map', 'hue_mikado_parallax_options_map');

}