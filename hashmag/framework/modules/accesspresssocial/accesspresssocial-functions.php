<?php

if(!function_exists('hashmag_mikado_access_press_social_plugin')) {
	/**
	 * Map Access Press Social Count plugin
	 * Hooks on vc_after_init action
	 */
	function hashmag_mikado_access_press_social_plugin() {

        hashmag_mikado_add_admin_page(
			array(
				'slug' => '_aps_plugin_page',
				'title' => 'Access Press Social',
				'icon' => 'fa fa-home'
			)
		);

		$aps_panel = hashmag_mikado_add_admin_panel(
			array(
				'title' => 'Access Press Social Count',
				'name' => 'aps_plugin',
				'page' => '_aps_plugin_page'
			)
		);

        hashmag_mikado_add_admin_field(
			array(
				'parent'		=> $aps_panel,
				'type'			=> 'select',
				'name'			=> 'aps_custom_style',
				'default_value'	=> '',
				'label' 		=> 'Enable Custom Style',
				'description' 	=> "Enabling this option you will set our custom style for Access Press Social Count elements",
				'options' 		=> array(
					'apsc-custom-style-enabled' => 'Yes',
					'' => 'No',
				)
			)
		);
	}

	add_action('vc_after_init', 'hashmag_mikado_access_press_social_plugin', 16);
}