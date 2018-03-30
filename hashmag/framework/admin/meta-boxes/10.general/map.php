<?php

    $general_meta_box = hashmag_mikado_add_meta_box(
        array(
            'scope' => array('page', 'post', 'forum', 'topic'),
            'title' => 'General',
            'name' => 'general_meta'
        )
    );

    hashmag_mikado_add_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'type' => 'select',
            'name' => 'mkdf_header_style_meta',
            'default_value' => '',
            'label' => 'Header Style',
            'description' => 'Choose predefined Header style',
            'options' => array(
                '' => '',
                'dark' => 'Dark',
                'light' => 'Light',
                'transparent' => 'Transparent'
            )
        )
    );

    hashmag_mikado_add_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'name' => 'mkdf_logo_position_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Logo position',
            'description' => 'Choose a logo position',
            'options' => array(
                '' => '',
                'center' => 'Center',
                'left' => 'Left'
            )
        )
    );

    hashmag_mikado_add_meta_box_field(
        array(
            'name' => 'mkdf_page_background_color_meta',
            'type' => 'color',
            'default_value' => '',
            'label' => 'Page Background Color',
            'description' => 'Choose background color for page content',
            'parent' => $general_meta_box
        )
    );

    hashmag_mikado_add_meta_box_field(
        array(
            'name'          => 'mkdf_boxed_meta',
            'type'          => 'select',
            'default_value' => '',
            'label'         => 'Boxed Layout',
            'description'   => '',
            'parent'        => $general_meta_box,
            'options'     => array(
                '' => '',
                'yes' => 'Yes',
                'no' => 'No',
            ),
            'args'          => array(
                "dependence" => true,
                'show' => array(
                    '' => '',
                    'yes' => '#mkdf_mkdf_boxed_container_meta',
                    'no' => '',

                ),
                'hide' => array(
                    '' => '#mkdf_mkdf_boxed_container_meta',
                    'yes' => '',
                    'no' => '#mkdf_mkdf_boxed_container_meta',
                )
            )
        )
    );

        $boxed_container = hashmag_mikado_add_admin_container(
            array(
                'parent'            => $general_meta_box,
                'name'              => 'mkdf_boxed_container_meta',
                'hidden_property'   => 'mkdf_boxed_meta',
                'hidden_values'      => array('','no')
            )
        );

            hashmag_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkdf_page_background_color_in_box_meta',
                    'type'          => 'color',
                    'label'         => 'Page Background Color',
                    'description'   => 'Choose the page background color outside box.',
                    'parent'        => $boxed_container
                )
            );

            hashmag_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkdf_boxed_background_image_meta',
                    'type'          => 'image',
                    'label'         => 'Background Image',
                    'description'   => 'Choose an image to be displayed in background',
                    'parent'        => $boxed_container
                )
            );

            hashmag_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkdf_boxed_pattern_background_image_meta',
                    'type'          => 'image',
                    'label'         => 'Background Pattern',
                    'description'   => 'Choose an image to be used as background pattern',
                    'parent'        => $boxed_container
                )
            );

            hashmag_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkdf_boxed_background_image_attachment_meta',
                    'type'          => 'select',
                    'default_value' => 'fixed',
                    'label'         => 'Background Image Attachment',
                    'description'   => 'Choose background image attachment',
                    'parent'        => $boxed_container,
                    'options'       => array(
                        'fixed'     => 'Fixed',
                        'scroll'    => 'Scroll'
                    )
                )
            );

    hashmag_mikado_add_meta_box_field(
        array(
            'name' => 'mkdf_page_slider_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => 'Slider Shortcode',
            'description' => 'Paste your slider shortcode here',
            'parent' => $general_meta_box
        )
    );

    $mkdf_content_padding_group = hashmag_mikado_add_admin_group(array(
        'name' => 'content_padding_group',
        'title' => 'Content Style',
        'description' => 'Define styles for Content area',
        'parent' => $general_meta_box
    ));
    
    $mkdf_content_padding_row = hashmag_mikado_add_admin_row(array(
        'name' => 'mkdf_content_padding_row',
        'next' => true,
        'parent' => $mkdf_content_padding_group
    ));
    
    hashmag_mikado_add_meta_box_field(
        array(
            'name'          => 'mkdf_page_content_top_padding',
            'type'          => 'textsimple',
            'default_value' => '',
            'label'         => 'Content Top Padding',
            'parent'        => $mkdf_content_padding_row,
            'args'          => array(
                'suffix' => 'px'
            )
        )
    );
    
    hashmag_mikado_add_meta_box_field(
        array(
            'name'        => 'mkdf_page_content_top_padding_mobile',
            'type'        => 'selectblanksimple',
            'label'       => 'Set this top padding for mobile header',
            'parent'      => $mkdf_content_padding_row,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );

    hashmag_mikado_add_meta_box_field(
        array(
            'name'        => 'mkdf_page_comments_meta',
            'type'        => 'selectblank',
            'label'       => 'Show Comments',
            'description' => 'Enabling this option will show comments on your page',
            'parent'      => $general_meta_box,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );

if(hashmag_mikado_options() -> getOptionValue('header_type') != 'header-vertical') {
    hashmag_mikado_add_meta_box_field(
        array(
            'name'            => 'mkdf_scroll_amount_for_sticky_meta',
            'type'            => 'text',
            'label'           => 'Scroll amount for sticky header appearance',
            'description'     => 'Define scroll amount for sticky header appearance',
            'parent'          => $general_meta_box,
            'args'            => array(
                'col_width' => 2,
                'suffix'    => 'px'
            )
        )
    );
}