<?php

if(!function_exists('hue_mikado_header_options_map')) {

    function hue_mikado_header_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '_header_page',
                'title' => esc_html__('Header', 'hue'),
                'icon'  => 'icon_folder-open_alt',
            )
        );

        $panel_header = hue_mikado_add_admin_panel(
            array(
                'page'  => '_header_page',
                'name'  => 'panel_header',
                'title' => esc_html__('Header', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header,
                'type'          => 'radiogroup',
                'name'          => 'header_type',
                'default_value' => 'header-standard',
                'label'         => esc_html__('Choose Header Type', 'hue'),
                'description'   => esc_html__('Select the type of header you would like to use', 'hue'),
                'options'       => array(
                    'header-standard'          => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-standard.png',
                        'label' => esc_html__('Standard', 'hue')
                    ),
                    'header-standard-extended' => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-standard-extended.png',
                        'label' => esc_html__('Standard Extended', 'hue')
                    ),
                    'header-box'               => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-box.png',
                        'label' => esc_html__('In The Box', 'hue')
                    ),
                    'header-minimal'           => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-minimal.png',
                        'label' => esc_html__('Minimal', 'hue')
                    ),
                    'header-divided'           => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-divided.png',
                        'label' => esc_html__('Divided', 'hue')
                    ),
                    'header-centered'          => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-centered.png',
                        'label' => esc_html__('Centered', 'hue')
                    ),
                    'header-vertical'          => array(
                        'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-vertical.png',
                        'label' => esc_html__('Vertical', 'hue')
                    )
                ),
                'args'          => array(
                    'use_images'  => true,
                    'hide_labels' => true,
                    'dependence'  => true,
                    'show'        => array(
                        'header-standard'          => '#mkd_panel_header_standard,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
                        'header-standard-extended' => '#mkd_panel_header_standard_extended,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
                        'header-box'               => '#mkd_panel_header_box,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
                        'header-minimal'           => '#mkd_panel_header_minimal,#mkd_header_behaviour,#mkd_panel_fullscreen_menu,#mkd_panel_sticky_header',
                        'header-divided'           => '#mkd_panel_header_divided,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
                        'header-centered'          => '#mkd_panel_header_centered,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
                        'header-vertical'          => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu',
                    ),
                    'hide'        => array(
                        'header-standard'          => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
                        'header-standard-extended' => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_box',
                        'header-box'               => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_standard_extended',
                        'header-minimal'           => '#mkd_panel_header_standard,#mkd_panel_main_menu,#mkd_panel_header_vertical,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_centered,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
                        'header-divided'           => '#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
                        'header-centered'          => '#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_divided,#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
                        'header-vertical'          => '#mkd_panel_header_standard,#mkd_header_behaviour,#mkd_panel_fixed_header,#mkd_panel_sticky_header,#mkd_panel_main_menu,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_header_divided,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
                    )
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'          => $panel_header,
                'type'            => 'select',
                'name'            => 'header_behaviour',
                'default_value'   => 'sticky-header-on-scroll-up',
                'label'           => esc_html__('Choose Header behaviour', 'hue'),
                'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'hue'),
                'options'         => array(
                    'no-behavior'                     => esc_html__('No Behavior', 'hue'),
                    'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'hue'),
                    'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'hue'),
                    'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'hue')
                ),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array('header-vertical'),
                'args'            => array(
                    'dependence' => true,
                    'show'       => array(
                        'sticky-header-on-scroll-up'      => '#mkd_panel_sticky_header',
                        'sticky-header-on-scroll-down-up' => '#mkd_panel_sticky_header',
                        'fixed-on-scroll'                 => '',
                    ),
                    'hide'       => array(
                        'sticky-header-on-scroll-up'      => '#mkd_panel_fixed_header',
                        'sticky-header-on-scroll-down-up' => '#mkd_panel_fixed_header',
                        'no-behavior'                     => '#mkd_panel_fixed_header, #mkd_panel_fixed_header, #mkd_panel_sticky_header',
                        'fixed-on-scroll'                 => '#mkd_panel_sticky_header',
                    )
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'top_bar',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Top Bar', 'hue'),
                'description'   => esc_html__('Enabling this option will show top bar area', 'hue'),
                'parent'        => $panel_header,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_top_bar_container"
                )
            )
        );

        $top_bar_container = hue_mikado_add_admin_container(array(
            'name'            => 'top_bar_container',
            'parent'          => $panel_header,
            'hidden_property' => 'top_bar',
            'hidden_value'    => 'no'
        ));

        hue_mikado_add_admin_field(
            array(
                'parent'        => $top_bar_container,
                'type'          => 'select',
                'name'          => 'top_bar_layout',
                'default_value' => 'three-columns',
                'label'         => esc_html__('Choose top bar layout', 'hue'),
                'description'   => esc_html__('Select the layout for top bar', 'hue'),
                'options'       => array(
                    'two-columns'   => esc_html__('Two columns', 'hue'),
                    'three-columns' => esc_html__('Three columns', 'hue')
                ),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => array(
                        'two-columns'   => '#mkd_top_bar_layout_container',
                        'three-columns' => '#mkd_top_bar_two_columns_layout_container'
                    ),
                    'show'       => array(
                        'two-columns'   => '#mkd_top_bar_two_columns_layout_container',
                        'three-columns' => '#mkd_top_bar_layout_container'
                    )
                )
            )
        );

        $top_bar_layout_container = hue_mikado_add_admin_container(array(
            'name'            => 'top_bar_layout_container',
            'parent'          => $top_bar_container,
            'hidden_property' => 'top_bar_layout',
            'hidden_value'    => '',
            'hidden_values'   => array('two-columns'),
        ));

        hue_mikado_add_admin_field(
            array(
                'parent'        => $top_bar_layout_container,
                'type'          => 'select',
                'name'          => 'top_bar_column_widths',
                'default_value' => '30-30-30',
                'label'         => esc_html__('Choose column widths', 'hue'),
                'description'   => '',
                'options'       => array(
                    '30-30-30' => '33% - 33% - 33%',
                    '25-50-25' => '25% - 50% - 25%'
                )
            )
        );

        $top_bar_two_columns_layout = hue_mikado_add_admin_container(array(
            'name'            => 'top_bar_two_columns_layout_container',
            'parent'          => $top_bar_container,
            'hidden_property' => 'top_bar_layout',
            'hidden_value'    => '',
            'hidden_values'   => array('three-columns'),
        ));

        hue_mikado_add_admin_field(
            array(
                'parent'        => $top_bar_two_columns_layout,
                'type'          => 'select',
                'name'          => 'top_bar_two_column_widths',
                'default_value' => '50-50',
                'label'         => esc_html__('Choose column widths', 'hue'),
                'description'   => '',
                'options'       => array(
                    '50-50' => '50% - 50%',
                    '33-66' => '33% - 66%',
                    '66-33' => '66% - 33%'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'top_bar_in_grid',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Top Bar in grid', 'hue'),
                'description'   => esc_html__('Set top bar content to be in grid', 'hue'),
                'parent'        => $top_bar_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_top_bar_in_grid_container"
                )
            )
        );

        $top_bar_in_grid_container = hue_mikado_add_admin_container(array(
            'name'            => 'top_bar_in_grid_container',
            'parent'          => $top_bar_container,
            'hidden_property' => 'top_bar_in_grid',
            'hidden_value'    => 'no'
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'top_bar_grid_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Grid Background Color', 'hue'),
            'description' => esc_html__('Set grid background color for top bar', 'hue'),
            'parent'      => $top_bar_in_grid_container
        ));


        hue_mikado_add_admin_field(array(
            'name'        => 'top_bar_grid_background_transparency',
            'type'        => 'text',
            'label'       => esc_html__('Grid Background Transparency', 'hue'),
            'description' => esc_html__('Set grid background transparency for top bar', 'hue'),
            'parent'      => $top_bar_in_grid_container,
            'args'        => array('col_width' => 3)
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'top_bar_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Background Color', 'hue'),
            'description' => esc_html__('Set background color for top bar', 'hue'),
            'parent'      => $top_bar_container
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'top_bar_background_transparency',
            'type'        => 'text',
            'label'       => esc_html__('Background Transparency', 'hue'),
            'description' => esc_html__('Set background transparency for top bar', 'hue'),
            'parent'      => $top_bar_container,
            'args'        => array('col_width' => 3)
        ));

        hue_mikado_add_admin_field(
            array(
                'name'          => 'top_bar_border',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Top Bar Border', 'hue'),
                'description'   => esc_html__('Set top bar border', 'hue'),
                'parent'        => $top_bar_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_top_bar_border_container"
                )
            )
        );

        $top_bar_border_container = hue_mikado_add_admin_container(array(
            'name'            => 'top_bar_border_container',
            'parent'          => $top_bar_container,
            'hidden_property' => 'top_bar_border',
            'hidden_value'    => 'no'
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'top_bar_border_color',
            'type'        => 'color',
            'label'       => esc_html__('Top Bar Border', 'hue'),
            'description' => esc_html__('Set border color for top bar', 'hue'),
            'parent'      => $top_bar_border_container
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'top_bar_height',
            'type'        => 'text',
            'label'       => esc_html__('Top bar height', 'hue'),
            'description' => esc_html__('Enter top bar height (Default is 37px)', 'hue'),
            'parent'      => $top_bar_container,
            'args'        => array(
                'col_width' => 2,
                'suffix'    => 'px'
            )
        ));

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header,
                'type'          => 'select',
                'name'          => 'header_style',
                'default_value' => '',
                'label'         => esc_html__('Header Skin', 'hue'),
                'description'   => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'hue'),
                'options'       => array(
                    ''             => '',
                    'light-header' => esc_html__('Light', 'hue'),
                    'dark-header'  => esc_html__('Dark', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header,
                'type'          => 'yesno',
                'name'          => 'enable_header_style_on_scroll',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Header Style on Scroll', 'hue'),
                'description'   => esc_html__('Enabling this option, header will change style depending on row settings for dark/light style', 'hue'),
            )
        );

        $panel_header_standard = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_standard',
                'title'           => esc_html__('Header Standard', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-standard-extended',
                    'header-box',
                    'header-vertical',
                    'header-minimal',
                    'header-centered',
                    'header-divided'
                )
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_standard,
                'name'   => 'menu_area_title',
                'title'  => esc_html__('Menu Area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_header_standard',
                'default_value' => 'yes',
                'label'         => esc_html__('Header In Grid', 'hue'),
                'description'   => esc_html__('Set header content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_standard_container'
                )
            )
        );

        $menu_area_in_grid_header_standard_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_standard,
                'name'            => 'menu_area_in_grid_header_standard_container',
                'hidden_property' => 'menu_area_in_grid_header_standard',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_standard_container,
                'type'          => 'color',
                'name'          => 'menu_area_grid_background_color_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_standard_container,
                'type'          => 'text',
                'name'          => 'menu_area_grid_background_transparency_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency for header', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_standard_container,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_border_header_standard',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_standard_container'
                )
            )
        );

        $menu_area_in_grid_border_header_standard_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $menu_area_in_grid_header_standard_container,
                'name'            => 'menu_area_in_grid_border_header_standard_container',
                'hidden_property' => 'menu_area_in_grid_border_header_standard',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_border_header_standard_container,
                'type'          => 'color',
                'name'          => 'menu_area_in_grid_border_color_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard,
                'type'          => 'color',
                'name'          => 'menu_area_background_color_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Background color', 'hue'),
                'description'   => esc_html__('Set background color for header', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard,
                'type'          => 'text',
                'name'          => 'menu_area_background_transparency_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Background transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for header', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard,
                'type'          => 'yesno',
                'name'          => 'menu_area_border_header_standard',
                'default_value' => 'yes',
                'label'         => esc_html__('Header Area Border', 'hue'),
                'description'   => esc_html__('Set border on header area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_border_header_standard_container'
                )
            )
        );

        $menu_area_border_header_standard_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_standard,
                'name'            => 'menu_area_border_header_standard_container',
                'hidden_property' => 'menu_area_border_header_standard',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_border_header_standard_container,
                'type'          => 'color',
                'name'          => 'menu_area_border_color_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard,
                'type'          => 'text',
                'name'          => 'menu_area_height_header_standard',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter header height (default is 92px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        $panel_header_minimal = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_minimal',
                'title'           => esc_html__('Header Minimal', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-vertical',
                    'header-standard',
                    'header-standard-extended',
                    'header-box',
                    'header-centered',
                    'header-divided',
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_minimal,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_header_minimal',
                'default_value' => 'no',
                'label'         => esc_html__('Header In Grid', 'hue'),
                'description'   => esc_html__('Set header content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_minimal_container'
                )
            )
        );

        $menu_area_in_grid_header_minimal_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_minimal,
                'name'            => 'menu_area_in_grid_header_minimal_container',
                'hidden_property' => 'menu_area_in_grid_header_minimal',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_minimal_container,
                'type'          => 'color',
                'name'          => 'menu_area_grid_background_color_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_minimal_container,
                'type'          => 'text',
                'name'          => 'menu_area_grid_background_transparency_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency for header', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_minimal_container,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_border_header_minimal',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_minimal_container'
                )
            )
        );

        $menu_area_in_grid_border_header_minimal_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $menu_area_in_grid_header_minimal_container,
                'name'            => 'menu_area_in_grid_border_header_minimal_container',
                'hidden_property' => 'menu_area_in_grid_border_header_minimal',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_border_header_minimal_container,
                'type'          => 'color',
                'name'          => 'menu_area_in_grid_border_color_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_minimal,
                'type'          => 'color',
                'name'          => 'menu_area_background_color_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Background color', 'hue'),
                'description'   => esc_html__('Set background color for header', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_minimal,
                'type'          => 'text',
                'name'          => 'menu_area_background_transparency_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Background transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for header', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_minimal,
                'type'          => 'yesno',
                'name'          => 'menu_area_border_header_minimal',
                'default_value' => 'yes',
                'label'         => esc_html__('Header Area Border', 'hue'),
                'description'   => esc_html__('Set border on header area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_border_header_minimal_container'
                )
            )
        );

        $menu_area_border_header_minimal_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_minimal,
                'name'            => 'menu_area_border_header_minimal_container',
                'hidden_property' => 'menu_area_border_header_minimal',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_border_header_minimal_container,
                'type'          => 'color',
                'name'          => 'menu_area_border_color_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_minimal,
                'type'          => 'text',
                'name'          => 'menu_area_height_header_minimal',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter header height (default is 92px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        do_action('hue_mikado_header_options_map');

        /***************** Divided Header Layout *******************/

        $panel_header_divided = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_divided',
                'title'           => esc_html__('Header Divided', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-standard',
                    'header-standard-extended',
                    'header-box',
                    'header-minimal',
                    'header-centered',
                    'header-vertical'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_divided,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_header_divided',
                'default_value' => 'no',
                'label'         => esc_html__('Header In Grid', 'hue'),
                'description'   => esc_html__('Set header content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_divided_container'
                )
            )
        );

        $menu_area_in_grid_header_divided_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_divided,
                'name'            => 'menu_area_in_grid_header_divided_container',
                'hidden_property' => 'menu_area_in_grid_header_divided',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_divided_container,
                'type'          => 'color',
                'name'          => 'menu_area_grid_background_color_header_divided',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_divided_container,
                'type'          => 'text',
                'name'          => 'menu_area_grid_background_transparency_header_divided',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency for header', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_divided_container,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_border_header_divided',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_divided_container'
                )
            )
        );

        $menu_area_in_grid_border_header_divided_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $menu_area_in_grid_header_divided_container,
                'name'            => 'menu_area_in_grid_border_header_divided_container',
                'hidden_property' => 'menu_area_in_grid_border_header_divided',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_border_header_divided_container,
                'type'          => 'color',
                'name'          => 'menu_area_in_grid_border_color_header_divided',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_divided,
                'type'          => 'color',
                'name'          => 'menu_area_background_color_header_divided',
                'default_value' => '',
                'label'         => esc_html__('Background Color', 'hue'),
                'description'   => esc_html__('Set background color for header', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_divided,
                'type'          => 'text',
                'name'          => 'menu_area_background_transparency_header_divided',
                'default_value' => '',
                'label'         => esc_html__('Background Transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for header', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );


        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_divided,
                'type'          => 'yesno',
                'name'          => 'menu_area_border_header_divided',
                'default_value' => 'yes',
                'label'         => esc_html__('Header Area Border', 'hue'),
                'description'   => esc_html__('Set border on header area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_border_header_divided_container'
                )
            )
        );

        $menu_area_border_header_divided_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_divided,
                'name'            => 'menu_area_border_header_divided_container',
                'hidden_property' => 'menu_area_border_header_divided',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_border_header_divided_container,
                'type'          => 'color',
                'name'          => 'menu_area_border_color_header_divided',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for header', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_divided,
                'type'          => 'text',
                'name'          => 'menu_area_height_header_divided',
                'default_value' => '',
                'label'         => 'Height',
                'description'   => esc_html__('Enter Header Height (default is 92px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        /***************** Divided Header Layout - end *******************/

        /***************** Centered Header Layout - start ****************/

        $panel_header_centered = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_centered',
                'title'           => esc_html__('Header Centered', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-vertical',
                    'header-standard',
                    'header-standard-extended',
                    'header-box',
                    'header-minimal',
                    'header-divided',
                )
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_centered,
                'name'   => 'logo_menu_area_title',
                'title'  => esc_html__('Logo Area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'yesno',
                'name'          => 'logo_area_in_grid_header_centered',
                'default_value' => 'no',
                'label'         => esc_html__('Logo Area In Grid', 'hue'),
                'description'   => esc_html__('Set menu area content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_logo_area_in_grid_header_centered_container'
                )
            )
        );

        $logo_area_in_grid_header_centered_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_centered,
                'name'            => 'logo_area_in_grid_header_centered_container',
                'hidden_property' => 'logo_area_in_grid_header_centered',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_header_centered_container,
                'type'          => 'color',
                'name'          => 'logo_area_grid_background_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for logo area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_header_centered_container,
                'type'          => 'text',
                'name'          => 'logo_area_grid_background_transparency_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_header_centered_container,
                'type'          => 'yesno',
                'name'          => 'logo_area_in_grid_border_header_centered',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_logo_area_in_grid_border_header_centered_container'
                )
            )
        );

        $logo_area_in_grid_border_header_centered_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $logo_area_in_grid_header_centered_container,
                'name'            => 'logo_area_in_grid_border_header_centered_container',
                'hidden_property' => 'logo_area_in_grid_border_header_centered',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_border_header_centered_container,
                'type'          => 'color',
                'name'          => 'logo_area_in_grid_border_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'color',
                'name'          => 'logo_area_background_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Background color', 'hue'),
                'description'   => esc_html__('Set background color for logo area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'text',
                'name'          => 'logo_area_background_transparency_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Background transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for logo area', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'yesno',
                'name'          => 'logo_area_border_header_centered',
                'default_value' => 'no',
                'label'         => esc_html__('Logo Area Border', 'hue'),
                'description'   => esc_html__('Set border on logo area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_logo_area_border_header_centered_container'
                )
            )
        );

        $logo_area_border_header_centered_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_centered,
                'name'            => 'logo_area_border_header_centered_container',
                'hidden_property' => 'logo_area_border_header_centered',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_border_header_centered_container,
                'type'          => 'color',
                'name'          => 'logo_area_border_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for logo area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'text',
                'name'          => 'logo_wrapper_padding_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Logo Padding', 'hue'),
                'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'text',
                'name'          => 'logo_area_height_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter logo area height (default is 155px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );


        hue_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_centered,
                'name'   => 'main_menu_area_title',
                'title'  => esc_html__('Menu Area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_header_centered',
                'default_value' => 'no',
                'label'         => esc_html__('Menu Area In Grid', 'hue'),
                'description'   => esc_html__('Set menu area content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_centered_container'
                )
            )
        );

        $menu_area_in_grid_header_centered_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_centered,
                'name'            => 'menu_area_in_grid_header_centered_container',
                'hidden_property' => 'menu_area_in_grid_header_centered',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_centered_container,
                'type'          => 'color',
                'name'          => 'menu_area_grid_background_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for menu area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_centered_container,
                'type'          => 'text',
                'name'          => 'menu_area_grid_background_transparency_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_centered_container,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_border_header_centered',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_centered_container'
                )
            )
        );

        $menu_area_in_grid_border_header_centered_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $menu_area_in_grid_header_centered_container,
                'name'            => 'menu_area_in_grid_border_header_centered_container',
                'hidden_property' => 'menu_area_in_grid_border_header_centered',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_border_header_centered_container,
                'type'          => 'color',
                'name'          => 'menu_area_in_grid_border_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'color',
                'name'          => 'menu_area_background_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Background color', 'hue'),
                'description'   => esc_html__('Set background color for menu area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'text',
                'name'          => 'menu_area_background_transparency_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Background transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for menu area', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'yesno',
                'name'          => 'menu_area_border_header_centered',
                'default_value' => 'no',
                'label'         => esc_html__('Menu Area Border', 'hue'),
                'description'   => esc_html__('Set border on menu area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_border_header_centered_container'
                )
            )
        );

        $menu_area_border_header_centered_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_centered,
                'name'            => 'menu_area_border_header_centered_container',
                'hidden_property' => 'menu_area_border_header_centered',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_border_header_centered_container,
                'type'          => 'color',
                'name'          => 'menu_area_border_color_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_centered,
                'type'          => 'text',
                'name'          => 'menu_area_height_header_centered',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter menu area height (default is 92px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        /***************** Centered Header Layout - end ****************/


        /***************** Standard Extended Header Layout - start ****************/

        $panel_header_standard_extended = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_standard_extended',
                'title'           => esc_html__('Header Standard Extended', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-vertical',
                    'header-standard',
                    'header-box',
                    'header-minimal',
                    'header-divided',
                    'header-centered'
                )
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_standard_extended,
                'name'   => 'logo_menu_area_title',
                'title'  => esc_html__('Logo Area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'yesno',
                'name'          => 'logo_area_in_grid_header_standard_extended',
                'default_value' => 'yes',
                'label'         => esc_html__('Logo Area In Grid', 'hue'),
                'description'   => esc_html__('Set menu area content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_logo_area_in_grid_header_standard_extended_container'
                )
            )
        );

        $logo_area_in_grid_header_standard_extended_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_standard_extended,
                'name'            => 'logo_area_in_grid_header_standard_extended_container',
                'hidden_property' => 'logo_area_in_grid_header_standard_extended',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_header_standard_extended_container,
                'type'          => 'color',
                'name'          => 'logo_area_grid_background_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for logo area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_header_standard_extended_container,
                'type'          => 'text',
                'name'          => 'logo_area_grid_background_transparency_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_header_standard_extended_container,
                'type'          => 'yesno',
                'name'          => 'logo_area_in_grid_border_header_standard_extended',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_logo_area_in_grid_border_header_standard_extended_container'
                )
            )
        );

        $logo_area_in_grid_border_header_standard_extended_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $logo_area_in_grid_header_standard_extended_container,
                'name'            => 'logo_area_in_grid_border_header_standard_extended_container',
                'hidden_property' => 'logo_area_in_grid_border_header_standard_extended',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_in_grid_border_header_standard_extended_container,
                'type'          => 'color',
                'name'          => 'logo_area_in_grid_border_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'color',
                'name'          => 'logo_area_background_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Background color', 'hue'),
                'description'   => esc_html__('Set background color for logo area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'text',
                'name'          => 'logo_area_background_transparency_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Background transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for logo area', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'yesno',
                'name'          => 'logo_area_border_header_standard_extended',
                'default_value' => 'yes',
                'label'         => esc_html__('Logo Area Border', 'hue'),
                'description'   => esc_html__('Set border on logo area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_logo_area_border_header_standard_extended_container'
                )
            )
        );

        $logo_area_border_header_standard_extended_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_standard_extended,
                'name'            => 'logo_area_border_header_standard_extended_container',
                'hidden_property' => 'logo_area_border_header_standard_extended',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $logo_area_border_header_standard_extended_container,
                'type'          => 'color',
                'name'          => 'logo_area_border_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for logo area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'text',
                'name'          => 'logo_area_height_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter logo area height (default is 90px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );


        hue_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_standard_extended,
                'name'   => 'main_menu_area_title',
                'title'  => esc_html__('Menu Area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_header_standard_extended',
                'default_value' => 'yes',
                'label'         => esc_html__('Menu Area In Grid', 'hue'),
                'description'   => esc_html__('Set menu area content to be in grid', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_standard_extended_container'
                )
            )
        );

        $menu_area_in_grid_header_standard_extended_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_standard_extended,
                'name'            => 'menu_area_in_grid_header_standard_extended_container',
                'hidden_property' => 'menu_area_in_grid_header_standard_extended',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_standard_extended_container,
                'type'          => 'color',
                'name'          => 'menu_area_grid_background_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for menu area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_standard_extended_container,
                'type'          => 'text',
                'name'          => 'menu_area_grid_background_transparency_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Grid Background Transparency', 'hue'),
                'description'   => esc_html__('Set grid background transparency', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_header_standard_extended_container,
                'type'          => 'yesno',
                'name'          => 'menu_area_in_grid_border_header_standard_extended',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Area Border', 'hue'),
                'description'   => esc_html__('Set border on grid area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_standard_extended_container'
                )
            )
        );

        $menu_area_in_grid_border_header_standard_extended_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $menu_area_in_grid_header_standard_extended_container,
                'name'            => 'menu_area_in_grid_border_header_standard_extended_container',
                'hidden_property' => 'menu_area_in_grid_border_header_standard_extended',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_in_grid_border_header_standard_extended_container,
                'type'          => 'color',
                'name'          => 'menu_area_in_grid_border_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for grid area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'color',
                'name'          => 'menu_area_background_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Background color', 'hue'),
                'description'   => esc_html__('Set background color for menu area', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'text',
                'name'          => 'menu_area_background_transparency_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Background transparency', 'hue'),
                'description'   => esc_html__('Set background transparency for menu area', 'hue'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'yesno',
                'name'          => 'menu_area_border_header_standard_extended',
                'default_value' => 'yes',
                'label'         => esc_html__('Menu Area Border', 'hue'),
                'description'   => esc_html__('Set border on menu area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_border_header_standard_extended_container'
                )
            )
        );

        $menu_area_border_header_standard_extended_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_header_standard_extended,
                'name'            => 'menu_area_border_header_standard_extended_container',
                'hidden_property' => 'menu_area_border_header_standard_extended',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $menu_area_border_header_standard_extended_container,
                'type'          => 'color',
                'name'          => 'menu_area_border_color_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
                'description'   => esc_html__('Set border color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_standard_extended,
                'type'          => 'text',
                'name'          => 'menu_area_height_header_standard_extended',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter menu area height (default is 75px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        /***************** Standard Extended Header Layout - end ****************/

        /***************** In The Box Header Layout - start ****************/

        $panel_header_box = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_box',
                'title'           => esc_html__('Header "In The Box"', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-standard',
                    'header-standard-extended',
                    'header-vertical',
                    'header-minimal',
                    'header-centered',
                    'header-divided'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_box,
                'type'          => 'color',
                'name'          => 'menu_area_grid_background_color_header_box',
                'default_value' => '',
                'label'         => esc_html__('Background Color', 'hue'),
                'description'   => esc_html__('Set grid background color for header area', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_header_box,
                'type'          => 'text',
                'name'          => 'menu_area_height_header_box',
                'default_value' => '',
                'label'         => esc_html__('Height', 'hue'),
                'description'   => esc_html__('Enter header height (default is 85px)', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );

        /***************** In The Box Header Layout - end ****************/

        $panel_header_vertical = hue_mikado_add_admin_panel(
            array(
                'page'            => '_header_page',
                'name'            => 'panel_header_vertical',
                'title'           => esc_html__('Header Vertical', 'hue'),
                'hidden_property' => 'header_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    'header-standard',
                    'header-standard-extended',
                    'header-box',
                    'header-minimal',
                    'header-centered',
                    'header-divided'
                )
            )
        );

        hue_mikado_add_admin_field(array(
            'name'        => 'vertical_header_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Background Color', 'hue'),
            'description' => esc_html__('Set background color for vertical menu', 'hue'),
            'parent'      => $panel_header_vertical
        ));

        hue_mikado_add_admin_field(
            array(
                'name'          => 'vertical_header_background_image',
                'type'          => 'image',
                'default_value' => '',
                'label'         => esc_html__('Background Image', 'hue'),
                'description'   => esc_html__('Set background image for vertical menu', 'hue'),
                'parent'        => $panel_header_vertical
            )
        );

        $panel_sticky_header = hue_mikado_add_admin_panel(
            array(
                'title'           => esc_html__('Sticky Header', 'hue'),
                'name'            => 'panel_sticky_header',
                'page'            => '_header_page',
                'hidden_property' => 'header_behaviour',
                'hidden_values'   => array(
                    'no-behavior',
                    'fixed-on-scroll'

                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'scroll_amount_for_sticky',
                'type'        => 'text',
                'label'       => esc_html__('Scroll Amount for Sticky', 'hue'),
                'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height)', 'hue'),
                'parent'      => $panel_sticky_header,
                'args'        => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'sticky_header_in_grid',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Sticky Header in grid', 'hue'),
                'description'   => esc_html__('Set sticky header content to be in grid', 'hue'),
                'parent'        => $panel_sticky_header,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_sticky_header_in_grid_container"
                )
            )
        );

        $sticky_header_in_grid_container = hue_mikado_add_admin_container(array(
            'name'            => 'sticky_header_in_grid_container',
            'parent'          => $panel_sticky_header,
            'hidden_property' => 'sticky_header_in_grid',
            'hidden_value'    => 'no'
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'sticky_header_grid_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Grid Background Color', 'hue'),
            'description' => esc_html__('Set grid background color for sticky header', 'hue'),
            'parent'      => $sticky_header_in_grid_container
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'sticky_header_grid_transparency',
            'type'        => 'text',
            'label'       => esc_html__('Sticky Header Grid Transparency', 'hue'),
            'description' => esc_html__('Enter transparency for sticky header grid (value from 0 to 1)', 'hue'),
            'parent'      => $sticky_header_in_grid_container,
            'args'        => array(
                'col_width' => 1
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'sticky_header_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Background Color', 'hue'),
            'description' => esc_html__('Set background color for sticky header', 'hue'),
            'parent'      => $panel_sticky_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'sticky_header_transparency',
            'type'        => 'text',
            'label'       => esc_html__('Sticky Header Transparency', 'hue'),
            'description' => esc_html__('Enter transparency for sticky header (value from 0 to 1)', 'hue'),
            'parent'      => $panel_sticky_header,
            'args'        => array(
                'col_width' => 1
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'sticky_header_height',
            'type'        => 'text',
            'label'       => esc_html__('Sticky Header Height', 'hue'),
            'description' => esc_html__('Enter height for sticky header (default is 92px)', 'hue'),
            'parent'      => $panel_sticky_header,
            'args'        => array(
                'col_width' => 2,
                'suffix'    => 'px'
            )
        ));

        $group_sticky_header_menu = hue_mikado_add_admin_group(array(
            'title'       => esc_html__('Sticky Header Menu', 'hue'),
            'name'        => 'group_sticky_header_menu',
            'parent'      => $panel_sticky_header,
            'description' => esc_html__('Define styles for sticky menu items', 'hue'),
        ));

        $row1_sticky_header_menu = hue_mikado_add_admin_row(array(
            'name'   => 'row1',
            'parent' => $group_sticky_header_menu
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'sticky_color',
            'type'        => 'colorsimple',
            'label'       => esc_html__('Text Color', 'hue'),
            'description' => '',
            'parent'      => $row1_sticky_header_menu
        ));

        $row2_sticky_header_menu = hue_mikado_add_admin_row(array(
            'name'   => 'row2',
            'parent' => $group_sticky_header_menu
        ));

        hue_mikado_add_admin_field(
            array(
                'name'          => 'sticky_google_fonts',
                'type'          => 'fontsimple',
                'label'         => esc_html__('Font Family', 'hue'),
                'default_value' => '-1',
                'parent'        => $row2_sticky_header_menu,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'textsimple',
                'name'          => 'sticky_fontsize',
                'label'         => esc_html__('Font Size', 'hue'),
                'default_value' => '',
                'parent'        => $row2_sticky_header_menu,
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'textsimple',
                'name'          => 'sticky_lineheight',
                'label'         => esc_html__('Line height', 'hue'),
                'default_value' => '',
                'parent'        => $row2_sticky_header_menu,
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'selectblanksimple',
                'name'          => 'sticky_texttransform',
                'label'         => esc_html__('Text transform', 'hue'),
                'default_value' => '',
                'options'       => hue_mikado_get_text_transform_array(),
                'parent'        => $row2_sticky_header_menu
            )
        );

        $row3_sticky_header_menu = hue_mikado_add_admin_row(array(
            'name'   => 'row3',
            'parent' => $group_sticky_header_menu
        ));

        hue_mikado_add_admin_field(
            array(
                'type'          => 'selectblanksimple',
                'name'          => 'sticky_fontstyle',
                'default_value' => '',
                'label'         => esc_html__('Font Style', 'hue'),
                'options'       => hue_mikado_get_font_style_array(),
                'parent'        => $row3_sticky_header_menu
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'selectblanksimple',
                'name'          => 'sticky_fontweight',
                'default_value' => '',
                'label'         => esc_html__('Font Weight', 'hue'),
                'options'       => hue_mikado_get_font_weight_array(),
                'parent'        => $row3_sticky_header_menu
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'textsimple',
                'name'          => 'sticky_letterspacing',
                'label'         => esc_html__('Letter Spacing', 'hue'),
                'default_value' => '',
                'parent'        => $row3_sticky_header_menu,
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $panel_fixed_header = hue_mikado_add_admin_panel(
            array(
                'title'           => esc_html__('Fixed Header', 'hue'),
                'name'            => 'panel_fixed_header',
                'page'            => '_header_page',
                'hidden_property' => 'header_behaviour',
                'hidden_values'   => array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up',
                    'no-behavior',
                    'fixed-on-scroll'
                )
            )
        );

        hue_mikado_add_admin_field(array(
            'name'          => 'fixed_header_grid_background_color',
            'type'          => 'color',
            'default_value' => '',
            'label'         => esc_html__('Grid Background Color', 'hue'),
            'description'   => esc_html__('Set grid background color for fixed header', 'hue'),
            'parent'        => $panel_fixed_header
        ));

        hue_mikado_add_admin_field(array(
            'name'          => 'fixed_header_grid_transparency',
            'type'          => 'text',
            'default_value' => '',
            'label'         => esc_html__('Header Transparency Grid', 'hue'),
            'description'   => esc_html__('Enter transparency for fixed header grid (value from 0 to 1)', 'hue'),
            'parent'        => $panel_fixed_header,
            'args'          => array(
                'col_width' => 1
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'          => 'fixed_header_background_color',
            'type'          => 'color',
            'default_value' => '',
            'label'         => esc_html__('Background Color', 'hue'),
            'description'   => esc_html__('Set background color for fixed header', 'hue'),
            'parent'        => $panel_fixed_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'fixed_header_transparency',
            'type'        => 'text',
            'label'       => esc_html__('Header Transparency', 'hue'),
            'description' => esc_html__('Enter transparency for fixed header (value from 0 to 1)', 'hue'),
            'parent'      => $panel_fixed_header,
            'args'        => array(
                'col_width' => 1
            )
        ));


        $panel_main_menu = hue_mikado_add_admin_panel(
            array(
                'title'           => esc_html__('Main Menu', 'hue'),
                'name'            => 'panel_main_menu',
                'page'            => '_header_page',
                'hidden_property' => 'header_type',
                'hidden_values'   => array('header-vertical', 'header-minimal')
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $panel_main_menu,
                'name'   => 'main_menu_area_title',
                'title'  => esc_html__('Main Menu General Settings', 'hue')
            )
        );

        $drop_down_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'drop_down_group',
                'title'       => esc_html__('Main Dropdown Menu', 'hue'),
                'description' => esc_html__('Choose a color and transparency for the main menu background (0 = fully transparent, 1 = opaque)', 'hue')
            )
        );

        $drop_down_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $drop_down_group,
                'name'   => 'drop_down_row1',
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $drop_down_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_background_color',
                'default_value' => '',
                'label'         => esc_html__('Background Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $drop_down_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_border_color',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
            )
        );


        hue_mikado_add_admin_field(
            array(
                'parent'        => $drop_down_row1,
                'type'          => 'textsimple',
                'name'          => 'dropdown_background_transparency',
                'default_value' => '',
                'label'         => esc_html__('Transparency', 'hue'),
            )
        );

        $drop_down_padding_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'drop_down_padding_group',
                'title'       => esc_html__('Main Dropdown Menu Padding', 'hue'),
                'description' => esc_html__('Choose a top/bottom padding for dropdown menu', 'hue')
            )
        );

        $drop_down_padding_row = hue_mikado_add_admin_row(
            array(
                'parent' => $drop_down_padding_group,
                'name'   => 'drop_down_padding_row',
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $drop_down_padding_row,
                'type'          => 'textsimple',
                'name'          => 'dropdown_top_padding',
                'default_value' => '',
                'label'         => esc_html__('Top Padding', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $drop_down_padding_row,
                'type'          => 'textsimple',
                'name'          => 'dropdown_bottom_padding',
                'default_value' => '',
                'label'         => esc_html__('Bottom Padding', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_main_menu,
                'type'          => 'select',
                'name'          => 'menu_dropdown_appearance',
                'default_value' => 'default',
                'label'         => esc_html__('Main Dropdown Menu Appearance', 'hue'),
                'description'   => esc_html__('Choose appearance for dropdown menu', 'hue'),
                'options'       => array(
                    'dropdown-default'           => esc_html__('Default', 'hue'),
                    'dropdown-slide-from-bottom' => esc_html__('Slide From Bottom', 'hue'),
                    'dropdown-slide-from-top'    => esc_html__('Slide From Top', 'hue'),
                    'dropdown-animate-height'    => esc_html__('Animate Height', 'hue'),
                    'dropdown-slide-from-left'   => esc_html__('Slide From Left', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_main_menu,
                'type'          => 'text',
                'name'          => 'dropdown_top_position',
                'default_value' => '',
                'label'         => esc_html__('Dropdown position', 'hue'),
                'description'   => esc_html__('Enter value in percentage of entire header height', 'hue'),
                'args'          => array(
                    'col_width' => 3,
                    'suffix'    => '%'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_main_menu,
                'type'          => 'yesno',
                'name'          => 'enable_wide_menu_background',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'hue'),
                'description'   => esc_html__('Enabling this option will show full width background  for wide dropdown type', 'hue'),
            )
        );

        $first_level_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'first_level_group',
                'title'       => esc_html__('1st Level Menu', 'hue'),
                'description' => esc_html__('Define styles for 1st level in Top Navigation Menu', 'hue')
            )
        );

        $first_level_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row1'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'menu_color',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'menu_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Hover Text Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'menu_activecolor',
                'default_value' => '',
                'label'         => esc_html__('Active Text Color', 'hue'),
            )
        );

        $first_level_row2 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row2',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row2,
                'type'          => 'colorsimple',
                'name'          => 'menu_text_background_color',
                'default_value' => '',
                'label'         => esc_html__('Text Background Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row2,
                'type'          => 'colorsimple',
                'name'          => 'menu_hover_background_color',
                'default_value' => '',
                'label'         => esc_html__('Hover Text Background Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row2,
                'type'          => 'colorsimple',
                'name'          => 'menu_active_background_color',
                'default_value' => '',
                'label'         => esc_html__('Active Text Background Color', 'hue'),
            )
        );

        $first_level_row3 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row3',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'colorsimple',
                'name'          => 'menu_light_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Light Menu Hover Text Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'colorsimple',
                'name'          => 'menu_light_activecolor',
                'default_value' => '',
                'label'         => esc_html__('Light Menu Active Text Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'colorsimple',
                'name'          => 'menu_light_border_color',
                'default_value' => '',
                'label'         => esc_html__('Light Menu Border Hover/Active Color', 'hue'),
            )
        );

        $first_level_row4 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row4',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row4,
                'type'          => 'colorsimple',
                'name'          => 'menu_dark_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Dark Menu Hover Text Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row4,
                'type'          => 'colorsimple',
                'name'          => 'menu_dark_activecolor',
                'default_value' => '',
                'label'         => esc_html__('Dark Menu Active Text Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row4,
                'type'          => 'colorsimple',
                'name'          => 'menu_dark_border_color',
                'default_value' => '',
                'label'         => esc_html__('Dark Menu Border Hover/Active Color', 'hue'),
            )
        );

        $first_level_row5 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row5',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row5,
                'type'          => 'fontsimple',
                'name'          => 'menu_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row5,
                'type'          => 'textsimple',
                'name'          => 'menu_fontsize',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row5,
                'type'          => 'textsimple',
                'name'          => 'menu_hover_background_color_transparency',
                'default_value' => '',
                'label'         => esc_html__('Hover Background Color Transparency', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row5,
                'type'          => 'textsimple',
                'name'          => 'menu_active_background_color_transparency',
                'default_value' => '',
                'label'         => esc_html__('Active Background Color Transparency', 'hue'),
            )
        );

        $first_level_row6 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row6',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row6,
                'type'          => 'selectblanksimple',
                'name'          => 'menu_fontstyle',
                'default_value' => '',
                'label'         => esc_html__('Font Style', 'hue'),
                'options'       => hue_mikado_get_font_style_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row6,
                'type'          => 'selectblanksimple',
                'name'          => 'menu_fontweight',
                'default_value' => '',
                'label'         => esc_html__('Font Weight', 'hue'),
                'options'       => hue_mikado_get_font_weight_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row6,
                'type'          => 'textsimple',
                'name'          => 'menu_letterspacing',
                'default_value' => '',
                'label'         => esc_html__('Letter Spacing', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row6,
                'type'          => 'selectblanksimple',
                'name'          => 'menu_texttransform',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'hue'),
                'options'       => hue_mikado_get_text_transform_array()
            )
        );

        $first_level_row7 = hue_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name'   => 'first_level_row7',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row7,
                'type'          => 'textsimple',
                'name'          => 'menu_lineheight',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row7,
                'type'          => 'textsimple',
                'name'          => 'menu_padding_left_right',
                'default_value' => '',
                'label'         => esc_html__('Padding Left/Right', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $first_level_row7,
                'type'          => 'textsimple',
                'name'          => 'menu_margin_left_right',
                'default_value' => '',
                'label'         => esc_html__('Margin Left/Right', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $second_level_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'second_level_group',
                'title'       => esc_html__('2nd Level Menu', 'hue'),
                'description' => esc_html__('Define styles for 2nd level in Top Navigation Menu', 'hue')
            )
        );

        $second_level_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $second_level_group,
                'name'   => 'second_level_row1'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_color',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_background_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Background Color', 'hue')
            )
        );

        $second_level_row2 = hue_mikado_add_admin_row(
            array(
                'parent' => $second_level_group,
                'name'   => 'second_level_row2',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row2,
                'type'          => 'fontsimple',
                'name'          => 'dropdown_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_fontsize',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_lineheight',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_padding_top_bottom',
                'default_value' => '',
                'label'         => esc_html__('Padding Top/Bottom', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $second_level_row3 = hue_mikado_add_admin_row(
            array(
                'parent' => $second_level_group,
                'name'   => 'second_level_row3',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_fontstyle',
                'default_value' => '',
                'label'         => esc_html__('Font style', 'hue'),
                'options'       => hue_mikado_get_font_style_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_fontweight',
                'default_value' => '',
                'label'         => esc_html__('Font weight', 'hue'),
                'options'       => hue_mikado_get_font_weight_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => 'dropdown_letterspacing',
                'default_value' => '',
                'label'         => esc_html__('Letter spacing', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_texttransform',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'hue'),
                'options'       => hue_mikado_get_text_transform_array()
            )
        );

        $second_level_wide_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'second_level_wide_group',
                'title'       => esc_html__('2nd Level Wide Menu', 'hue'),
                'description' => esc_html__('Define styles for 2nd level in Wide Menu', 'hue')
            )
        );

        $second_level_wide_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $second_level_wide_group,
                'name'   => 'second_level_wide_row1'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_wide_color',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_wide_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_wide_background_hovercolor',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Background Color', 'hue')
            )
        );

        $second_level_wide_row2 = hue_mikado_add_admin_row(
            array(
                'parent' => $second_level_wide_group,
                'name'   => 'second_level_wide_row2',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row2,
                'type'          => 'fontsimple',
                'name'          => 'dropdown_wide_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_fontsize',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_lineheight',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_padding_top_bottom',
                'default_value' => '',
                'label'         => esc_html__('Padding Top/Bottom', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $second_level_wide_row3 = hue_mikado_add_admin_row(
            array(
                'parent' => $second_level_wide_group,
                'name'   => 'second_level_wide_row3',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_wide_fontstyle',
                'default_value' => '',
                'label'         => esc_html__('Font style', 'hue'),
                'options'       => hue_mikado_get_font_style_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_wide_fontweight',
                'default_value' => '',
                'label'         => esc_html__('Font weight', 'hue'),
                'options'       => hue_mikado_get_font_weight_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row3,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_letterspacing',
                'default_value' => '',
                'label'         => esc_html__('Letter spacing', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $second_level_wide_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_wide_texttransform',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'hue'),
                'options'       => hue_mikado_get_text_transform_array()
            )
        );

        $third_level_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'third_level_group',
                'title'       => esc_html__('3nd Level Menu', 'hue'),
                'description' => esc_html__('Define styles for 3nd level in Top Navigation Menu', 'hue')
            )
        );

        $third_level_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $third_level_group,
                'name'   => 'third_level_row1'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_color_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_hovercolor_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_background_hovercolor_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Background Color', 'hue')
            )
        );

        $third_level_row2 = hue_mikado_add_admin_row(
            array(
                'parent' => $third_level_group,
                'name'   => 'third_level_row2',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row2,
                'type'          => 'fontsimple',
                'name'          => 'dropdown_google_fonts_thirdlvl',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_fontsize_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_lineheight_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $third_level_row3 = hue_mikado_add_admin_row(
            array(
                'parent' => $third_level_group,
                'name'   => 'third_level_row3',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_fontstyle_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Font style', 'hue'),
                'options'       => hue_mikado_get_font_style_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_fontweight_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Font weight', 'hue'),
                'options'       => hue_mikado_get_font_weight_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => 'dropdown_letterspacing_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Letter spacing', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_texttransform_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'hue'),
                'options'       => hue_mikado_get_text_transform_array()
            )
        );


        /***********************************************************/
        $third_level_wide_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_main_menu,
                'name'        => 'third_level_wide_group',
                'title'       => esc_html__('3rd Level Wide Menu', 'hue'),
                'description' => esc_html__('Define styles for 3rd level in Wide Menu', 'hue')
            )
        );

        $third_level_wide_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $third_level_wide_group,
                'name'   => 'third_level_wide_row1'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_wide_color_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Text Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_wide_hovercolor_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Color', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row1,
                'type'          => 'colorsimple',
                'name'          => 'dropdown_wide_background_hovercolor_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Hover/Active Background Color', 'hue')
            )
        );

        $third_level_wide_row2 = hue_mikado_add_admin_row(
            array(
                'parent' => $third_level_wide_group,
                'name'   => 'third_level_wide_row2',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row2,
                'type'          => 'fontsimple',
                'name'          => 'dropdown_wide_google_fonts_thirdlvl',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_fontsize_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Font Size', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row2,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_lineheight_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Line Height', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        $third_level_wide_row3 = hue_mikado_add_admin_row(
            array(
                'parent' => $third_level_wide_group,
                'name'   => 'third_level_wide_row3',
                'next'   => true
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_wide_fontstyle_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Font style', 'hue'),
                'options'       => hue_mikado_get_font_style_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_wide_fontweight_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Font weight', 'hue'),
                'options'       => hue_mikado_get_font_weight_array()
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row3,
                'type'          => 'textsimple',
                'name'          => 'dropdown_wide_letterspacing_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Letter spacing', 'hue'),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $third_level_wide_row3,
                'type'          => 'selectblanksimple',
                'name'          => 'dropdown_wide_texttransform_thirdlvl',
                'default_value' => '',
                'label'         => esc_html__('Text Transform', 'hue'),
                'options'       => hue_mikado_get_text_transform_array()
            )
        );

        $panel_vertical_main_menu = hue_mikado_add_admin_panel(
            array(
                'title'           => esc_html__('Vertical Main Menu', 'hue'),
                'name'            => 'panel_vertical_main_menu',
                'page'            => '_header_page',
                'hidden_property' => 'header_type',
                'hidden_values'   => array(
                    'header-standard',
                    'header-minimal'
                )
            )
        );

        $drop_down_group = hue_mikado_add_admin_group(
            array(
                'parent'      => $panel_vertical_main_menu,
                'name'        => 'vertical_drop_down_group',
                'title'       => esc_html__('Main Dropdown Menu', 'hue'),
                'description' => esc_html__('Set a style for dropdown menu', 'hue')
            )
        );

        $vertical_drop_down_row1 = hue_mikado_add_admin_row(
            array(
                'parent' => $drop_down_group,
                'name'   => 'mkd_drop_down_row1',
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $vertical_drop_down_row1,
                'type'          => 'colorsimple',
                'name'          => 'vertical_dropdown_background_color',
                'default_value' => '',
                'label'         => esc_html__('Background Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $vertical_drop_down_row1,
                'type'          => 'colorsimple',
                'name'          => 'vertical_dropdown_border_color',
                'default_value' => '',
                'label'         => esc_html__('Border Color', 'hue'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $vertical_drop_down_row1,
                'type'          => 'textsimple',
                'name'          => 'vertical_dropdown_transparency',
                'default_value' => '',
                'label'         => esc_html__('Transparency', 'hue'),
            )
        );

        $group_vertical_first_level = hue_mikado_add_admin_group(array(
            'name'        => 'group_vertical_first_level',
            'title'       => esc_html__('1st level', 'hue'),
            'description' => esc_html__('Define styles for 1st level menu', 'hue'),
            'parent'      => $panel_vertical_main_menu
        ));

        $row_vertical_first_level_1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_first_level_1',
            'parent' => $group_vertical_first_level
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_1st_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'hue'),
            'parent'        => $row_vertical_first_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_1st_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Hover Color', 'hue'),
            'parent'        => $row_vertical_first_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_1st_hover_background_color',
            'default_value' => '',
            'label'         => esc_html__('Hover Background Color', 'hue'),
            'parent'        => $row_vertical_first_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_1st_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_first_level_1
        ));

        $row_vertical_first_level_2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_first_level_2',
            'parent' => $group_vertical_first_level,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_1st_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_first_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_1st_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'hue'),
            'options'       => hue_mikado_get_text_transform_array(),
            'parent'        => $row_vertical_first_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'vertical_menu_1st_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'hue'),
            'parent'        => $row_vertical_first_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_1st_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'hue'),
            'options'       => hue_mikado_get_font_style_array(),
            'parent'        => $row_vertical_first_level_2
        ));

        $row_vertical_first_level_3 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_first_level_3',
            'parent' => $group_vertical_first_level,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_1st_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'hue'),
            'options'       => hue_mikado_get_font_weight_array(),
            'parent'        => $row_vertical_first_level_3
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_1st_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_first_level_3
        ));

        $group_vertical_second_level = hue_mikado_add_admin_group(array(
            'name'        => 'group_vertical_second_level',
            'title'       => esc_html__('2nd level', 'hue'),
            'description' => esc_html__('Define styles for 2nd level menu', 'hue'),
            'parent'      => $panel_vertical_main_menu
        ));

        $row_vertical_second_level_1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_second_level_1',
            'parent' => $group_vertical_second_level
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_2nd_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'hue'),
            'parent'        => $row_vertical_second_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_2nd_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Hover Color', 'hue'),
            'parent'        => $row_vertical_second_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_2nd_hover_background_color',
            'default_value' => '',
            'label'         => esc_html__('Hover Background Color', 'hue'),
            'parent'        => $row_vertical_second_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_2nd_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_second_level_1
        ));

        $row_vertical_second_level_2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_second_level_2',
            'parent' => $group_vertical_second_level,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_2nd_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_second_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_2nd_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'hue'),
            'options'       => hue_mikado_get_text_transform_array(),
            'parent'        => $row_vertical_second_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'vertical_menu_2nd_google_fonts',
            'default_value' => '-1',
            'label'         => 'Font Family',
            'parent'        => $row_vertical_second_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_2nd_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'hue'),
            'options'       => hue_mikado_get_font_style_array(),
            'parent'        => $row_vertical_second_level_2
        ));

        $row_vertical_second_level_3 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_second_level_3',
            'parent' => $group_vertical_second_level,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_2nd_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'hue'),
            'options'       => hue_mikado_get_font_weight_array(),
            'parent'        => $row_vertical_second_level_3
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_2nd_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_second_level_3
        ));

        $group_vertical_third_level = hue_mikado_add_admin_group(array(
            'name'        => 'group_vertical_third_level',
            'title'       => esc_html__('3rd level', 'hue'),
            'description' => esc_html__('Define styles for 3rd level menu', 'hue'),
            'parent'      => $panel_vertical_main_menu
        ));

        $row_vertical_third_level_1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_third_level_1',
            'parent' => $group_vertical_third_level
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_3rd_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'hue'),
            'parent'        => $row_vertical_third_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_3rd_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Hover Color', 'hue'),
            'parent'        => $row_vertical_third_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'vertical_menu_3rd_hover_background_color',
            'default_value' => '',
            'label'         => esc_html__('Hover Background Color', 'hue'),
            'parent'        => $row_vertical_third_level_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_3rd_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_third_level_1
        ));

        $row_vertical_third_level_2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_third_level_2',
            'parent' => $group_vertical_third_level,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_3rd_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_third_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_3rd_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'hue'),
            'options'       => hue_mikado_get_text_transform_array(),
            'parent'        => $row_vertical_third_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'vertical_menu_3rd_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'hue'),
            'parent'        => $row_vertical_third_level_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_3rd_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'hue'),
            'options'       => hue_mikado_get_font_style_array(),
            'parent'        => $row_vertical_third_level_2
        ));

        $row_vertical_third_level_3 = hue_mikado_add_admin_row(array(
            'name'   => 'row_vertical_third_level_3',
            'parent' => $group_vertical_third_level,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'vertical_menu_3rd_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'hue'),
            'options'       => hue_mikado_get_font_weight_array(),
            'parent'        => $row_vertical_third_level_3
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'vertical_menu_3rd_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_vertical_third_level_3
        ));

        $panel_mobile_header = hue_mikado_add_admin_panel(array(
            'title' => 'Mobile header',
            'name'  => 'panel_mobile_header',
            'page'  => '_header_page'
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_header_height',
            'type'        => 'text',
            'label'       => esc_html__('Mobile Header Height', 'hue'),
            'description' => esc_html__('Enter height for mobile header in pixels', 'hue'),
            'parent'      => $panel_mobile_header,
            'args'        => array(
                'col_width' => 3,
                'suffix'    => 'px'
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_header_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Mobile Header Background Color', 'hue'),
            'description' => esc_html__('Choose color for mobile header', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_menu_background_color',
            'type'        => 'color',
            'label'       => esc_html__('Mobile Menu Background Color', 'hue'),
            'description' => esc_html__('Choose color for mobile menu', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_menu_separator_color',
            'type'        => 'color',
            'label'       => esc_html__('Mobile Menu Item Separator Color', 'hue'),
            'description' => esc_html__('Choose color for mobile menu horizontal separators', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_logo_height',
            'type'        => 'text',
            'label'       => esc_html__('Logo Height For Mobile Header', 'hue'),
            'description' => esc_html__('Define logo height for screen size smaller than 1000px', 'hue'),
            'parent'      => $panel_mobile_header,
            'args'        => array(
                'col_width' => 3,
                'suffix'    => 'px'
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_logo_height_phones',
            'type'        => 'text',
            'label'       => esc_html__('Logo Height For Mobile Devices', 'hue'),
            'description' => esc_html__('Define logo height for screen size smaller than 480px', 'hue'),
            'parent'      => $panel_mobile_header,
            'args'        => array(
                'col_width' => 3,
                'suffix'    => 'px'
            )
        ));

        hue_mikado_add_admin_section_title(array(
            'parent' => $panel_mobile_header,
            'name'   => 'mobile_header_fonts_title',
            'title'  => esc_html__('Typography', 'hue')
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_text_color',
            'type'        => 'color',
            'label'       => esc_html__('Navigation Text Color', 'hue'),
            'description' => esc_html__('Define color for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_text_hover_color',
            'type'        => 'color',
            'label'       => esc_html__('Navigation Hover/Active Color', 'hue'),
            'description' => esc_html__('Define hover/active color for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_font_family',
            'type'        => 'font',
            'label'       => esc_html__('Navigation Font Family', 'hue'),
            'description' => esc_html__('Define font family for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_font_size',
            'type'        => 'text',
            'label'       => esc_html__('Navigation Font Size', 'hue'),
            'description' => esc_html__('Define font size for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header,
            'args'        => array(
                'col_width' => 3,
                'suffix'    => 'px'
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_line_height',
            'type'        => 'text',
            'label'       => esc_html__('Navigation Line Height', 'hue'),
            'description' => esc_html__('Define line height for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header,
            'args'        => array(
                'col_width' => 3,
                'suffix'    => 'px'
            )
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_text_transform',
            'type'        => 'select',
            'label'       => esc_html__('Navigation Text Transform', 'hue'),
            'description' => esc_html__('Define text transform for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header,
            'options'     => hue_mikado_get_text_transform_array(true)
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_font_style',
            'type'        => 'select',
            'label'       => esc_html__('Navigation Font Style', 'hue'),
            'description' => esc_html__('Define font style for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header,
            'options'     => hue_mikado_get_font_style_array(true)
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_font_weight',
            'type'        => 'select',
            'label'       => esc_html__('Navigation Font Weight', 'hue'),
            'description' => esc_html__('Define font weight for mobile navigation text', 'hue'),
            'parent'      => $panel_mobile_header,
            'options'     => hue_mikado_get_font_weight_array(true)
        ));

        hue_mikado_add_admin_section_title(array(
            'name'   => 'mobile_opener_panel',
            'parent' => $panel_mobile_header,
            'title'  => esc_html__('Mobile Menu Opener', 'hue')
        ));

        hue_mikado_add_admin_field(array(
            'name'          => 'mobile_icon_pack',
            'type'          => 'select',
            'label'         => esc_html__('Mobile Navigation Icon Pack', 'hue'),
            'default_value' => 'font_awesome',
            'description'   => esc_html__('Choose icon pack for mobile navigation icon', 'hue'),
            'parent'        => $panel_mobile_header,
            'options'       => hue_mikado_icon_collections()->getIconCollectionsExclude(array(
                'linea_icons',
                'simple_line_icons',
                'linear_icons'
            ))
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_icon_color',
            'type'        => 'color',
            'label'       => esc_html__('Mobile Navigation Icon Color', 'hue'),
            'description' => esc_html__('Choose color for icon header', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_icon_hover_color',
            'type'        => 'color',
            'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'hue'),
            'description' => esc_html__('Choose hover color for mobile navigation icon ', 'hue'),
            'parent'      => $panel_mobile_header
        ));

        hue_mikado_add_admin_field(array(
            'name'        => 'mobile_icon_size',
            'type'        => 'text',
            'label'       => esc_html__('Mobile Navigation Icon size', 'hue'),
            'description' => esc_html__('Choose size for mobile navigation icon', 'hue'),
            'parent'      => $panel_mobile_header,
            'args'        => array(
                'col_width' => 3,
                'suffix'    => 'px'
            )
        ));
    }

    add_action('hue_mikado_options_map', 'hue_mikado_header_options_map', 3);

}