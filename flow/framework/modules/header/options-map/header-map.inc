<?php

if ( ! function_exists('flow_elated_header_options_map') ) {

	function flow_elated_header_options_map() {

		flow_elated_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => 'Header',
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = flow_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => 'Header'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'radiogroup',
				'name' => 'header_type',
				'default_value' => 'header-type2',
				'label' => 'Choose Header Type',
				'description' => 'Select the type of header you would like to use',
				'options' => array(
					'header-type2' => array(
						'image' => ELATED_ASSETS_ROOT . '/img/header-with-logo.png'
					),
					'header-standard' => array(
						'image' => ELATED_ASSETS_ROOT . '/img/header-standard.png'
					),
                    'header-vertical' => array(
                        'image' => ELATED_ASSETS_ROOT . '/img/header-vertical.png'
                    )
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-type2' => '#eltd_panel_header_type2,#eltd_header_behaviour,#eltd_panel_fixed_header,#eltd_panel_sticky_header,#eltd_panel_main_menu',
						'header-standard' => '#eltd_panel_header_standard,#eltd_header_behaviour,#eltd_panel_fixed_header,#eltd_panel_sticky_header,#eltd_panel_main_menu',
                        'header-vertical' => '#eltd_panel_header_vertical,#eltd_panel_vertical_main_menu',
					),
					'hide' => array(
						'header-type2' => '#eltd_panel_header_standard,#eltd_panel_header_vertical,#eltd_panel_vertical_main_menu',
						'header-standard' => '#eltd_panel_header_type2,#eltd_panel_header_vertical,#eltd_panel_vertical_main_menu',
                        'header-vertical' => '#eltd_panel_header_type2,#eltd_panel_header_standard,#eltd_header_behaviour,#eltd_panel_fixed_header,#eltd_panel_sticky_header,#eltd_panel_main_menu',
					)
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'sticky-header-on-scroll-up',
				'label' => 'Choose Header behaviour',
				'description' => 'Select the behaviour of header when you scroll down to page',
				'options' => array(
					'sticky-header-on-scroll-up' => 'Sticky on scroll up',
					'sticky-header-on-scroll-down-up' => 'Sticky on scroll up/down',
					'fixed-on-scroll' => 'Fixed on scroll'
				),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array('header-vertical'),
				'args' => array(
					'dependence' => true,
					'show' => array(
						'sticky-header-on-scroll-up' => '#eltd_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#eltd_panel_sticky_header',
						'fixed-on-scroll' => '#eltd_panel_fixed_header'
					),
					'hide' => array(
						'sticky-header-on-scroll-up' => '#eltd_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#eltd_panel_fixed_header',
						'fixed-on-scroll' => '#eltd_panel_sticky_header',
					)
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'name' => 'top_bar',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Top Bar',
				'description' => 'Enabling this option will show top bar area',
				'parent' => $panel_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_container"
				)
			)
		);

		$top_bar_container = flow_elated_add_admin_container(array(
			'name' => 'top_bar_container',
			'parent' => $panel_header,
			'hidden_property' => 'top_bar',
			'hidden_value' => 'no'
		));

		flow_elated_add_admin_field(
			array(
				'parent' => $top_bar_container,
				'type' => 'select',
				'name' => 'top_bar_layout',
				'default_value' => 'three-columns',
				'label' => 'Choose top bar layout',
				'description' => 'Select the layout for top bar',
				'options' => array(
					'two-columns' => 'Two columns',
					'three-columns' => 'Three columns'
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"two-columns" => "#eltd_top_bar_layout_container",
						"three-columns" => ""
					),
					"show" => array(
						"two-columns" => "",
						"three-columns" => "#eltd_top_bar_layout_container"
					)
				)
			)
		);

		$top_bar_layout_container = flow_elated_add_admin_container(array(
			'name' => 'top_bar_layout_container',
			'parent' => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value' => '',
			'hidden_values' => array("two-columns"),
		));

		flow_elated_add_admin_field(
			array(
				'parent' => $top_bar_layout_container,
				'type' => 'select',
				'name' => 'top_bar_column_widths',
				'default_value' => '30-30-30',
				'label' => 'Choose column widths',
				'description' => '',
				'options' => array(
					'30-30-30' => '33% - 33% - 33%',
					'25-50-25' => '25% - 50% - 25%'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'name' => 'top_bar_in_grid',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Top Bar in grid',
				'description' => 'Set top bar content to be in grid',
				'parent' => $top_bar_layout_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_in_grid_container"
				)
			)
		);

		$top_bar_in_grid_container = flow_elated_add_admin_container(array(
			'name' => 'top_bar_in_grid_container',
			'parent' => $top_bar_layout_container,
			'hidden_property' => 'top_bar_in_grid',
			'hidden_value' => 'no'
		));

		flow_elated_add_admin_field(array(
			'name' => 'top_bar_grid_background_color',
			'type' => 'color',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for top bar',
			'parent' => $top_bar_in_grid_container
		));


		flow_elated_add_admin_field(array(
			'name' => 'top_bar_grid_background_transparency',
			'type' => 'text',
			'label' => 'Grid Background Transparency',
			'description' => 'Set grid background transparency for top bar',
			'parent' => $top_bar_in_grid_container,
			'args' => array('col_width' => 3)
		));

		flow_elated_add_admin_field(array(
			'name' => 'top_bar_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for top bar',
			'parent' => $top_bar_layout_container
		));

		flow_elated_add_admin_field(array(
			'name' => 'top_bar_background_transparency',
			'type' => 'text',
			'label' => 'Background Transparency',
			'description' => 'Set background transparency for top bar',
			'parent' => $top_bar_layout_container,
			'args' => array('col_width' => 3)
		));

		flow_elated_add_admin_field(array(
			'name' => 'top_bar_height',
			'type' => 'text',
			'label' => 'Top bar height',
			'description' => 'Enter top bar height (Default is 40px)',
			'parent' => $top_bar_layout_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_style',
				'default_value' => '',
				'label' => 'Header Skin',
				'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
				'options' => array(
					'' => '',
					'light-header' => 'Light',
					'dark-header' => 'Dark'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'yesno',
				'name' => 'enable_header_style_on_scroll',
				'default_value' => 'no',
				'label' => 'Enable Header Style on Scroll',
				'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
			)
		);

		$panel_header_type2 = flow_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_type2',
				'title' => 'Header Large Logo',
				'hidden_property' => 'header_type',
				'hidden_value' => '',
				'hidden_values' => array(
					'header-standard',
                    'header-vertical'
				)
			)
		);

		flow_elated_add_admin_section_title(
			array(
				'parent' => $panel_header_type2,
				'name' => 'logo_area_title',
				'title' => 'Logo Area'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'yesno',
				'name' => 'logo_area_in_grid_header_type2',
				'default_value' => 'yes',
				'label' => 'Logo area in grid',
				'description' => 'Set logo area content to be in grid',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_logo_area_in_grid_header_type2_container'
				)
			)
		);

		$logo_area_in_grid_header_type2_container = flow_elated_add_admin_container(
			array(
				'parent' => $panel_header_type2,
				'name' => 'logo_area_in_grid_header_type2_container',
				'hidden_property' => 'logo_area_in_grid_header_type2',
				'hidden_value' => 'no'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $logo_area_in_grid_header_type2_container,
				'type' => 'color',
				'name' => 'logo_area_grid_background_color_header_type2',
				'default_value' => '',
				'label' => 'Grid Background color',
				'description' => 'Set grid background color for logo area',
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $logo_area_in_grid_header_type2_container,
				'type' => 'text',
				'name' => 'logo_area_grid_background_transparency_header_type2',
				'default_value' => '',
				'label' => 'Grid background transparency',
				'description' => 'Set grid background transparency for logo area',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'color',
				'name' => 'logo_area_background_color_header_type2',
				'default_value' => '',
				'label' => 'Background color',
				'description' => 'Set background color for logo area',
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'text',
				'name' => 'logo_area_background_transparency_header_type2',
				'default_value' => '',
				'label' => 'Background transparency',
				'description' => 'Set background transparency for logo area',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'text',
				'name' => 'logo_area_height_header_type2',
				'default_value' => '',
				'label' => 'Height',
				'description' => 'Enter logo area height (default is 200px)',
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		flow_elated_add_admin_section_title(
			array(
				'parent' => $panel_header_type2,
				'name' => 'menu_area_title',
				'title' => 'Menu Area'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_type2',
				'default_value' => 'no',
				'label' => 'Menu area in grid',
				'description' => 'Set menu area content to be in grid',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_menu_area_in_grid_header_type2_container'
				)
			)
		);

		$menu_area_in_grid_header_type2_container = flow_elated_add_admin_container(
			array(
				'parent' => $panel_header_type2,
				'name' => 'menu_area_in_grid_header_type2_container',
				'hidden_property' => 'menu_area_in_grid_header_type2',
				'hidden_value' => 'no'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_type2_container,
				'type' => 'color',
				'name' => 'menu_area_grid_background_color_header_type2',
				'default_value' => '',
				'label' => 'Grid Background color',
				'description' => 'Set grid background color for menu area',
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_type2_container,
				'type' => 'text',
				'name' => 'menu_area_grid_background_transparency_header_type2',
				'default_value' => '',
				'label' => 'Grid background transparency',
				'description' => 'Set grid background transparency for menu area',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_type2',
				'default_value' => '',
				'label' => 'Background color',
				'description' => 'Set background color for menu area'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_type2',
				'default_value' => '',
				'label' => 'Background transparency',
				'description' => 'Set background transparency for menu area',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_type2,
				'type' => 'text',
				'name' => 'menu_area_height_header_type2',
				'default_value' => '',
				'label' => 'Height',
				'description' => 'Enter menu area height (default is 200px)',
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);


		$panel_header_standard = flow_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_standard',
				'title' => 'Header Standard',
				'hidden_property' => 'header_type',
				'hidden_value' => '',
				'hidden_values' => array(
					'header-type2',
                    'header-vertical'
				)
			)
		);

		flow_elated_add_admin_section_title(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_title',
				'title' => 'Menu Area'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_standard',
				'default_value' => 'no',
				'label' => 'Header in grid',
				'description' => 'Set header content to be in grid',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_menu_area_in_grid_header_standard_container'
				)
			)
		);

		$menu_area_in_grid_header_standard_container = flow_elated_add_admin_container(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_in_grid_header_standard_container',
				'hidden_property' => 'menu_area_in_grid_header_standard',
				'hidden_value' => 'no'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'color',
				'name' => 'menu_area_grid_background_color_header_standard',
				'default_value' => '',
				'label' => 'Grid Background color',
				'description' => 'Set grid background color for header area',
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'text',
				'name' => 'menu_area_grid_background_transparency_header_standard',
				'default_value' => '',
				'label' => 'Grid background transparency',
				'description' => 'Set grid background transparency for header',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_standard',
				'default_value' => '',
				'label' => 'Background color',
				'description' => 'Set background color for header'
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_standard',
				'default_value' => '',
				'label' => 'Background transparency',
				'description' => 'Set background transparency for header',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_height_header_standard',
				'default_value' => '',
				'label' => 'Height',
				'description' => 'Enter header height (default is 50px)',
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

        $panel_header_vertical = flow_elated_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_vertical',
                'title' => 'Header Vertical',
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-type2',
                    'header-standard'
                )
            )
        );

            flow_elated_add_admin_field(array(
                'name' => 'vertical_header_background_color',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Set background color for vertical menu',
                'parent' => $panel_header_vertical
            ));

            flow_elated_add_admin_field(array(
                'name' => 'vertical_header_transparency',
                'type' => 'text',
                'label' => 'Transparency',
                'description' => 'Enter transparency for vertical menu (value from 0 to 1)',
                'parent' => $panel_header_vertical,
                'args' => array(
                    'col_width' => 1
                )
            ));

            flow_elated_add_admin_field(
                array(
                    'name' => 'vertical_header_background_image',
                    'type' => 'image',
                    'default_value' => '',
                    'label' => 'Background Image',
                    'description' => 'Set background image for vertical menu',
                    'parent' => $panel_header_vertical
                )
            );

		$panel_sticky_header = flow_elated_add_admin_panel(
			array(
				'title' => 'Sticky Header',
				'name' => 'panel_sticky_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array(
					'fixed-on-scroll'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'name' => 'scroll_amount_for_sticky',
				'type' => 'text',
				'label' => 'Scroll Amount for Sticky',
				'description' => 'Enter scroll amount for Sticky Menu to appear (deafult is header height)',
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'name' => 'sticky_header_in_grid',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Sticky Header in grid',
				'description' => 'Set sticky header content to be in grid',
				'parent' => $panel_sticky_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_sticky_header_in_grid_container"
				)
			)
		);

		$sticky_header_in_grid_container = flow_elated_add_admin_container(array(
			'name' => 'sticky_header_in_grid_container',
			'parent' => $panel_sticky_header,
			'hidden_property' => 'sticky_header_in_grid',
			'hidden_value' => 'no'
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_header_grid_background_color',
			'type' => 'color',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for sticky header',
			'parent' => $sticky_header_in_grid_container
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_header_grid_transparency',
			'type' => 'text',
			'label' => 'Sticky Header Grid Transparency',
			'description' => 'Enter transparency for sticky header grid (value from 0 to 1)',
			'parent' => $sticky_header_in_grid_container,
			'args' => array(
				'col_width' => 1
			)
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_header_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for sticky header',
			'parent' => $panel_sticky_header
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_header_transparency',
			'type' => 'text',
			'label' => 'Sticky Header Transparency',
			'description' => 'Enter transparency for sticky header (value from 0 to 1)',
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 1
			)
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_header_height',
			'type' => 'text',
			'label' => 'Sticky Header Height',
			'description' => 'Enter height for sticky header (default is 50px)',
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$group_sticky_header_menu = flow_elated_add_admin_group(array(
			'title' => 'Sticky Header Menu',
			'name' => 'group_sticky_header_menu',
			'parent' => $panel_sticky_header,
			'description' => 'Define styles for sticky menu items',
		));

		$row1_sticky_header_menu = flow_elated_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_sticky_header_menu
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_color',
			'type' => 'colorsimple',
			'label' => 'Text Color',
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		flow_elated_add_admin_field(array(
			'name' => 'sticky_hovercolor',
			'type' => 'colorsimple',
			'label' => 'Hover/Active color',
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = flow_elated_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_sticky_header_menu
		));

		flow_elated_add_admin_field(
			array(
				'name' => 'sticky_google_fonts',
				'type' => 'fontsimple',
				'label' => 'Font Family',
				'default_value' => '-1',
				'parent' => $row2_sticky_header_menu,
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_fontsize',
				'label' => 'Font Size',
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_lineheight',
				'label' => 'Line height',
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_texttransform',
				'label' => 'Text transform',
				'default_value' => '',
				'options' => flow_elated_get_text_transform_array(),
				'parent' => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = flow_elated_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_sticky_header_menu
		));

		flow_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_fontstyle',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => flow_elated_get_font_style_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_fontweight',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => flow_elated_get_font_weight_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		flow_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_letterspacing',
				'label' => 'Letter Spacing',
				'default_value' => '',
				'parent' => $row3_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$panel_fixed_header = flow_elated_add_admin_panel(
			array(
				'title' => 'Fixed Header',
				'name' => 'panel_fixed_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up')
			)
		);

		flow_elated_add_admin_field(array(
			'name' => 'fixed_header_grid_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for fixed header',
			'parent' => $panel_fixed_header
		));

		flow_elated_add_admin_field(array(
			'name' => 'fixed_header_grid_transparency',
			'type' => 'text',
			'default_value' => '',
			'label' => 'Header Transparency Grid',
			'description' => 'Enter transparency for fixed header grid (value from 0 to 1)',
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));

		flow_elated_add_admin_field(array(
			'name' => 'fixed_header_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => 'Background Color',
			'description' => 'Set background color for fixed header',
			'parent' => $panel_fixed_header
		));

		flow_elated_add_admin_field(array(
			'name' => 'fixed_header_transparency',
			'type' => 'text',
			'label' => 'Header Transparency',
			'description' => 'Enter transparency for fixed header (value from 0 to 1)',
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));


		$panel_main_menu = flow_elated_add_admin_panel(
			array(
				'title' => 'Main Menu',
				'name' => 'panel_main_menu',
				'page' => '_header_page',
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-vertical')
			)
		);

		flow_elated_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'select',
				'name' => 'menu_dropdown_appearance',
				'default_value' => 'default',
				'label' => 'Main Dropdown Menu Appearance',
				'description' => 'Choose appearance for dropdown menu',
				'options' => array(
					'dropdown-default' => 'Default',
					'dropdown-slide-from-bottom' => 'Slide From Bottom',
					'dropdown-slide-from-top' => 'Slide From Top',
					'dropdown-animate-height' => 'Animate Height',
					'dropdown-slide-from-left' => 'Slide From Left'
				)
			)
		);

	}

	add_action( 'flow_elated_options_map', 'flow_elated_header_options_map', 7);

}