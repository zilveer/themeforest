<?php

if ( ! function_exists('libero_mikado_call_to_action_options_map') ) {
	/**
	 * Add Call to Action options to elements page
	 */
	function libero_mikado_call_to_action_options_map() {

		$panel_call_to_action = libero_mikado_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_call_to_action',
				'title' => 'Call To Action'
			)
		);

		$coloring_group = libero_mikado_add_admin_group(array(
			'name' => 'coloring_group',
			'title' => 'Color style',
			'description' => 'Choose default color style for Call to Action',
			'parent' => $panel_call_to_action
		));

		$coloring_row = libero_mikado_add_admin_row(array(
			'name' => 'coloring_row',
			'parent' => $coloring_group
		));

		libero_mikado_add_admin_field(array(
			'parent' => $coloring_row,
			'type' => 'colorsimple',
			'name' => 'call_to_action_bckg_color',
			'default_value' => '',
			'label' => 'Background Color',
		));

		libero_mikado_add_admin_field(array(
			'parent' => $coloring_row,
			'type' => 'colorsimple',
			'name' => 'call_to_action_border_color',
			'default_value' => '',
			'label' => 'Border Color'
		));

	}

	add_action( 'libero_mikado_options_elements_map', 'libero_mikado_call_to_action_options_map',3);

}