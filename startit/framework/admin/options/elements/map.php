<?php

if ( ! function_exists('qode_startit_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function qode_startit_load_elements_map() {

		qode_startit_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-diamond'
			)
		);

		do_action( 'qode_startit_options_elements_map' );

	}

	add_action('qode_startit_options_map', 'qode_startit_load_elements_map', 8);

}