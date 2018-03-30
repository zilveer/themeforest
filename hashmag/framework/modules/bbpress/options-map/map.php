<?php

if(!function_exists('hashmag_mikado_bbpress_options_map')) {
	/**
	 * Maps options that are specific to BBPress
	 */
	function hashmag_mikado_bbpress_options_map() {
		$custom_sidebars = hashmag_mikado_get_custom_sidebars();

		hashmag_mikado_add_admin_page(
			array(
				'slug'  => '_bbpress',
				'title' => 'BBPress',
				'icon'  => 'fa fa-users'
			)
		);

		$panel_bbpress = hashmag_mikado_add_admin_panel(
			array(
				'page'  => '_bbpress',
				'name'  => 'panel_bbpress',
				'title' => 'BBPress'
			)
		);

		hashmag_mikado_add_admin_field(
			array(
				'name'          => 'bbpress_archive_slider',
				'type'          => 'text',
				'default_value' => '',
				'label'         => 'Forums Page Slider Shortcode',
				'description'   => 'Enter shortcode for slider that will be displayed on forums page',
				'parent'        => $panel_bbpress,
				'args'          => array(
					'col_width' => 4
				)
			)
		);

		hashmag_mikado_add_admin_field(
			array(
				'name'          => 'bbpress_show_archive_title',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => 'Display Page Title on Forums Page?',
				'description'   => 'Enabling this option will display page title on forums page',
				'parent'        => $panel_bbpress
			)
		);

		hashmag_mikado_add_admin_field(array(
			'name'        => 'bbpress_sidebar_layout',
			'type'        => 'select',
			'label'       => 'BBPress Sidebar',
			'description' => 'Choose a sidebar layout for all BBPress pages',
			'parent'      => $panel_bbpress,
			'options'     => array(
				'default'          => 'No Sidebar',
				'sidebar-33-right' => 'Sidebar 1/3 Right',
				'sidebar-25-right' => 'Sidebar 1/4 Right',
				'sidebar-33-left'  => 'Sidebar 1/3 Left',
				'sidebar-25-left'  => 'Sidebar 1/4 Left',
			)
		));


		if(count($custom_sidebars) > 0) {
			hashmag_mikado_add_admin_field(array(
				'name'        => 'bbpress_sidebar',
				'type'        => 'selectblank',
				'label'       => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on all BBPress pages. Default sidebar is "Sidebar Page"',
				'parent'      => $panel_bbpress,
				'options'     => hashmag_mikado_get_custom_sidebars()
			));
		}
	}

	add_action('hashmag_mikado_options_map', 'hashmag_mikado_bbpress_options_map');
}