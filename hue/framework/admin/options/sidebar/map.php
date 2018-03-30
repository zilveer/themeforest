<?php

if(!function_exists('hue_mikado_sidebar_options_map')) {

    function hue_mikado_sidebar_options_map() {

        $panel_widgets = hue_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_widgets',
                'title' => esc_html__('Widgets', 'hue')
            )
        );

        /**
         * Navigation style
         */
        hue_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'sidebar_background_color',
            'default_value' => '',
            'label'         => esc_html__('Sidebar Background Color', 'hue'),
            'description'   => esc_html__('Choose background color for sidebar', 'hue'),
            'parent'        => $panel_widgets
        ));

        $group_sidebar_padding = hue_mikado_add_admin_group(array(
            'name'   => 'group_sidebar_padding',
            'title'  => esc_html__('Padding', 'hue'),
            'parent' => $panel_widgets
        ));

        $row_sidebar_padding = hue_mikado_add_admin_row(array(
            'name'   => 'row_sidebar_padding',
            'parent' => $group_sidebar_padding
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_top',
            'default_value' => '',
            'label'         => esc_html__('Top Padding', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_right',
            'default_value' => '',
            'label'         => esc_html__('Right Padding', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_bottom',
            'default_value' => '',
            'label'         => esc_html__('Bottom Padding', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_left',
            'default_value' => '',
            'label'         => esc_html__('Left Padding', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'select',
            'name'          => 'sidebar_alignment',
            'default_value' => '',
            'label'         => esc_html__('Text Alignment', 'hue'),
            'description'   => esc_html__('Choose text aligment', 'hue'),
            'options'       => array(
                'left'   => esc_html__('Left', 'hue'),
                'center' => esc_html__('Center', 'hue'),
                'right'  => esc_html__('Right', 'hue')
            ),
            'parent'        => $panel_widgets
        ));

    }

    add_action('hue_mikado_options_map', 'hue_mikado_sidebar_options_map');

}