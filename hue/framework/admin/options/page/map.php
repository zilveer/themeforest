<?php

if(!function_exists('hue_mikado_page_options_map')) {

    function hue_mikado_page_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '_page_page',
                'title' => esc_html__('Page', 'hue'),
                'icon'  => 'icon_document_alt'
            )
        );

        $custom_sidebars = hue_mikado_get_custom_sidebars();

        $panel_sidebar = hue_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => esc_html__('Design Style', 'hue')
            )
        );

        hue_mikado_add_admin_field(array(
            'name'          => 'page_sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__('Sidebar Layout', 'hue'),
            'description'   => esc_html__('Choose a sidebar layout for pages', 'hue'),
            'default_value' => 'default',
            'parent'        => $panel_sidebar,
            'options'       => array(
                'default'          => esc_html__('No Sidebar', 'hue'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'hue'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'hue'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'hue'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'hue')
            )
        ));


        if(count($custom_sidebars) > 0) {
            hue_mikado_add_admin_field(array(
                'name'        => 'page_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'hue'),
                'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'hue'),
                'parent'      => $panel_sidebar,
                'options'     => $custom_sidebars
            ));
        }

        hue_mikado_add_admin_field(array(
            'name'          => 'page_show_likes',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Likes', 'hue'),
            'description'   => esc_html__('Enabling this option will show likes on your page', 'hue'),
            'default_value' => 'no',
            'parent'        => $panel_sidebar
        ));

        hue_mikado_add_admin_field(array(
            'name'          => 'page_show_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'hue'),
            'description'   => esc_html__('Enabling this option will show comments on your page', 'hue'),
            'default_value' => 'yes',
            'parent'        => $panel_sidebar
        ));

    }

    add_action('hue_mikado_options_map', 'hue_mikado_page_options_map', 9);

}