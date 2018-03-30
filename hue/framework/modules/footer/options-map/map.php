<?php

if(!function_exists('hue_mikado_footer_options_map')) {
    /**
     * Add footer options
     */
    function hue_mikado_footer_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '_footer_page',
                'title' => esc_html__('Footer', 'hue'),
                'icon'  => 'icon_cone_alt'
            )
        );

        $footer_panel = hue_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Footer', 'hue'),
                'name'  => 'footer',
                'page'  => '_footer_page'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__('Uncovering Footer', 'hue'),
                'description'   => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'hue'),
                'parent'        => $footer_panel,
            )
        );
        hue_mikado_add_admin_field(
            array(
                'parent'        => $footer_panel,
                'type'          => 'select',
                'name'          => 'footer_style',
                'default_value' => '',
                'label'         => esc_html__('Footer Skin', 'hue'),
                'description'   => esc_html__('Choose Footer Skin for Footer Area', 'hue'),
                'options'       => array(
                    ''             => '',
                    'dark-footer'  => esc_html__('Dark', 'hue'),
                    'light-footer' => esc_html__('Light', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'footer_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'hue'),
                'description' => esc_html__('Choose Background Image for Footer Area', 'hue'),
                'parent'      => $footer_panel
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'footer_in_grid',
                'default_value' => 'yes',
                'label'         => esc_html__('Footer in Grid', 'hue'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'hue'),
                'parent'        => $footer_panel,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_top',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Footer Top', 'hue'),
                'description'   => esc_html__('Enabling this option will show Footer Top area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_top_container'
                ),
                'parent'        => $footer_panel,
            )
        );

        $show_footer_top_container = hue_mikado_add_admin_container(
            array(
                'name'            => 'show_footer_top_container',
                'hidden_property' => 'show_footer_top',
                'hidden_value'    => 'no',
                'parent'          => $footer_panel
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_columns',
                'default_value' => '4',
                'label'         => esc_html__('Footer Top Columns', 'hue'),
                'description'   => esc_html__('Choose number of columns for Footer Top area', 'hue'),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '5' => '3(25%+25%+50%)',
                    '6' => '3(50%+25%+25%)',
                    '4' => '4'
                ),
                'parent'        => $show_footer_top_container,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_columns_alignment',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Columns Alignment', 'hue'),
                'description'   => esc_html__('Text Alignment in Footer Columns', 'hue'),
                'options'       => array(
                    'left'   => esc_html__('Left', 'hue'),
                    'center' => esc_html__('Center', 'hue'),
                    'right'  => esc_html__('Right', 'hue')
                ),
                'parent'        => $show_footer_top_container,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_bottom',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Footer Bottom', 'hue'),
                'description'   => esc_html__('Enabling this option will show Footer Bottom area', 'hue'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_bottom_container'
                ),
                'parent'        => $footer_panel,
            )
        );

        $show_footer_bottom_container = hue_mikado_add_admin_container(
            array(
                'name'            => 'show_footer_bottom_container',
                'hidden_property' => 'show_footer_bottom',
                'hidden_value'    => 'no',
                'parent'          => $footer_panel
            )
        );


        hue_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_columns',
                'default_value' => '3',
                'label'         => esc_html__('Footer Bottom Columns', 'hue'),
                'description'   => esc_html__('Choose number of columns for Footer Bottom area', 'hue'),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3'
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );

    }

    add_action('hue_mikado_options_map', 'hue_mikado_footer_options_map');

}