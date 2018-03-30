<?php

if ( ! function_exists('libero_mikado_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function libero_mikado_reset_options_map() {

		libero_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => 'Reset',
				'icon'  => 'icon_refresh'
			)
		);

		$panel_reset = libero_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => 'Reset'
			)
		);

		libero_mikado_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> 'Reset to Defaults',
			'description'	=> 'This option will reset all Mikado Options values to defaults',
			'parent'		=> $panel_reset
		));

	}

	add_action( 'libero_mikado_options_map', 'libero_mikado_reset_options_map', 100 );

}