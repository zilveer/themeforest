<?php

$header_meta_box = flow_elated_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);
    flow_elated_add_meta_box_field(
        array(
            'name' => 'eltd_header_style_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Header Skin',
            'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'light-header' => 'Light',
                'dark-header' => 'Dark'
            )
        )
    );

    flow_elated_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'eltd_enable_header_style_on_scroll_meta',
            'default_value' => '',
            'label' => 'Enable Header Style on Scroll',
            'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );

    switch (flow_elated_options()->getOptionValue('header_type')) {
        case 'header-standard':

            flow_elated_add_meta_box_field(
                array(
                    'name' => 'eltd_menu_area_background_color_header_standard_meta',
                    'type' => 'color',
                    'label' => 'Background Color',
                    'description' => 'Choose a background color for header area',
                    'parent' => $header_meta_box
                )
            );

            flow_elated_add_meta_box_field(
                array(
                    'name' => 'eltd_menu_area_background_transparency_header_standard_meta',
                    'type' => 'text',
                    'label' => 'Transparency',
                    'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
                    'parent' => $header_meta_box,
                    'args' => array(
                        'col_width' => 2
                    )
                )
            );

            break;

        case 'header-vertical':

            flow_elated_add_meta_box_field(array(
                'name'        => 'eltd_vertical_header_background_color_meta',
                'type'        => 'color',
                'label'       => 'Background Color',
                'description' => 'Set background color for vertical menu',
                'parent'      => $header_meta_box
            ));

            flow_elated_add_meta_box_field(array(
                'name'        => 'eltd_vertical_header_transparency_meta',
                'type'        => 'text',
                'label'       => 'Transparency',
                'description' => 'Enter transparency for vertical menu (value from 0 to 1)',
                'parent'      => $header_meta_box,
                'args'        => array(
                    'col_width' => 1
                )
            ));

            flow_elated_add_meta_box_field(
                array(
                    'name'          => 'eltd_vertical_header_background_image_meta',
                    'type'          => 'image',
                    'default_value' => '',
                    'label'         => 'Background Image',
                    'description'   => 'Set background image for vertical menu',
                    'parent'        => $header_meta_box
                )
            );

            flow_elated_add_meta_box_field(
                array(
                    'name' => 'eltd_disable_vertical_header_background_image_meta',
                    'type' => 'yesno',
                    'default_value' => 'no',
                    'label' => 'Disable Background Image',
                    'description' => 'Enabling this option will hide background image in Vertical Menu',
                    'parent' => $header_meta_box
                )
            );

            break;
    }

    if(flow_elated_options() -> getOptionValue('header_type') != 'header-vertical') {
        flow_elated_add_meta_box_field(
            array(
                'name'            => 'eltd_scroll_amount_for_sticky_meta',
                'type'            => 'text',
                'label'           => 'Scroll amount for sticky header appearance',
                'description'     => 'Define scroll amount for sticky header appearance',
                'parent'          => $header_meta_box,
                'args'            => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                ),
                'hidden_property' => 'eltd_header_behaviour',
                'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
            )
        );
    }
