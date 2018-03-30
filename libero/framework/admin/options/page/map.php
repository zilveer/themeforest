<?php

if ( ! function_exists('libero_mikado_page_options_map') ) {

    function libero_mikado_page_options_map() {

        libero_mikado_add_admin_page(
            array(
                'slug'  => '_page_page',
                'title' => 'Page',
                'icon'  => 'icon_document_alt'
            )
        );

        $custom_sidebars = libero_mikado_get_custom_sidebars();

        $panel_sidebar = libero_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => 'Design Style'
            )
        );

        libero_mikado_add_admin_field(array(
            'name'        => 'page_sidebar_layout',
            'type'        => 'select',
            'label'       => 'Sidebar Layout',
            'description' => 'Choose a sidebar layout for pages',
            'default_value' => 'default',
            'parent'      => $panel_sidebar,
            'options'     => array(
                'default'			=> 'No Sidebar',
                'sidebar-33-right'	=> 'Sidebar 1/3 Right',
                'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
                'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
                'sidebar-25-left' 	=> 'Sidebar 1/4 Left'
            )
        ));


        if(count($custom_sidebars) > 0) {
            libero_mikado_add_admin_field(array(
                'name' => 'page_custom_sidebar',
                'type' => 'selectblank',
                'label' => 'Sidebar to Display',
                'description' => 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"',
                'parent' => $panel_sidebar,
                'options' => $custom_sidebars
            ));
        }

        libero_mikado_add_admin_field(array(
            'name'        => 'page_show_comments',
            'type'        => 'yesno',
            'label'       => 'Show Comments',
            'description' => 'Enabling this option will show comments on your page',
            'default_value' => 'yes',
            'parent'      => $panel_sidebar
        ));

        $panel_widgets = libero_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_widgets',
                'title' => 'Sidebar'
            )
        );

        libero_mikado_add_admin_section_title(
            array(
                'parent' => $panel_widgets,
                'name' => 'logo_area_title',
                'title' => 'Widgets'
            )
        );

        libero_mikado_add_admin_field(array(
            'type'			=> 'color',
            'name'			=> 'sidebar_background_color',
            'default_value'	=> '',
            'label'			=> 'Sidebar Background Color',
            'description'	=> 'Choose background color for sidebar',
            'parent'		=> $panel_widgets
        ));

        $group_sidebar_padding = libero_mikado_add_admin_group(array(
            'name'		=> 'group_sidebar_padding',
            'title'		=> 'Padding',
            'parent'	=> $panel_widgets
        ));

        $row_sidebar_padding = libero_mikado_add_admin_row(array(
            'name'		=> 'row_sidebar_padding',
            'parent'	=> $group_sidebar_padding
        ));

        libero_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'sidebar_padding_top',
            'default_value'	=> '',
            'label'			=> 'Top Padding',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_sidebar_padding
        ));

        libero_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'sidebar_padding_right',
            'default_value'	=> '',
            'label'			=> 'Right Padding',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_sidebar_padding
        ));

        libero_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'sidebar_padding_bottom',
            'default_value'	=> '',
            'label'			=> 'Bottom Padding',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_sidebar_padding
        ));

        libero_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'sidebar_padding_left',
            'default_value'	=> '',
            'label'			=> 'Left Padding',
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $row_sidebar_padding
        ));

        libero_mikado_add_admin_field(array(
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

    add_action( 'libero_mikado_options_map', 'libero_mikado_page_options_map', 7);

}