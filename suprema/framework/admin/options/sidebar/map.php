<?php

if ( ! function_exists('suprema_qodef_sidebar_options_map') ) {

	function suprema_qodef_sidebar_options_map() {

		suprema_qodef_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => 'Sidebar',
				'icon'  => 'fa fa-bars'
			)
		);

		$panel_widgets = suprema_qodef_add_admin_panel(
			array(
				'page'  => '_sidebar_page',
				'name'  => 'panel_widgets',
				'title' => 'Widgets'
			)
		);

		/**
		 * Navigation style
		 */
		suprema_qodef_add_admin_field(array(
			'type'			=> 'color',
			'name'			=> 'sidebar_background_color',
			'default_value'	=> '',
			'label'			=> 'Sidebar Background Color',
			'description'	=> 'Choose background color for sidebar',
			'parent'		=> $panel_widgets
		));

		$group_sidebar_padding = suprema_qodef_add_admin_group(array(
			'name'		=> 'group_sidebar_padding',
			'title'		=> 'Padding',
			'parent'	=> $panel_widgets
		));

		$row_sidebar_padding = suprema_qodef_add_admin_row(array(
			'name'		=> 'row_sidebar_padding',
			'parent'	=> $group_sidebar_padding
		));

		suprema_qodef_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_top',
			'default_value'	=> '',
			'label'			=> 'Top Padding',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		suprema_qodef_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_right',
			'default_value'	=> '',
			'label'			=> 'Right Padding',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		suprema_qodef_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_bottom',
			'default_value'	=> '',
			'label'			=> 'Bottom Padding',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		suprema_qodef_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_left',
			'default_value'	=> '',
			'label'			=> 'Left Padding',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		suprema_qodef_add_admin_field(array(
			'type'			=> 'select',
			'name'			=> 'sidebar_alignment',
			'default_value'	=> '',
			'label'			=> 'Text Alignment',
			'description'	=> 'Choose text aligment',
			'options'		=> array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right'
			),
			'parent'		=> $panel_widgets
		));

	}

	add_action( 'suprema_qodef_options_map', 'suprema_qodef_sidebar_options_map', 10);

}