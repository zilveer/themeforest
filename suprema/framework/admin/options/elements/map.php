<?php

if ( ! function_exists('suprema_qodef_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function suprema_qodef_load_elements_map() {

		suprema_qodef_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-header'
			)
		);

		do_action( 'suprema_qodef_options_elements_map' );

	}

	add_action('suprema_qodef_options_map', 'suprema_qodef_load_elements_map', 8);

}