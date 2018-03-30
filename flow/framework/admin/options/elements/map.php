<?php

if ( ! function_exists('flow_elated_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function flow_elated_load_elements_map() {

		flow_elated_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-header'
			)
		);

		do_action( 'flow_elated_options_elements_map' );

	}

	add_action('flow_elated_options_map', 'flow_elated_load_elements_map', 14);

}