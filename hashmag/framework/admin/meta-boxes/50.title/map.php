<?php

$title_meta_box = hashmag_mikado_add_meta_box(
    array(
        'scope' => array('page', 'post', 'forum', 'topic'),
        'title' => 'Title',
        'name' => 'title_meta'
    )
);

    hashmag_mikado_add_meta_box_field(
        array(
            'name' => 'mkdf_show_title_area_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Show Title Area',
            'description' => 'Disabling this option will turn off page title area',
            'parent' => $title_meta_box,
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "",
                    "no" => "#mkdf_mkdf_show_title_area_meta_container",
                    "yes" => ""
                ),
                "show" => array(
                    "" => "#mkdf_mkdf_show_title_area_meta_container",
                    "no" => "",
                    "yes" => "#mkdf_mkdf_show_title_area_meta_container"
                )
            )
        )
    );

    $show_title_area_meta_container = hashmag_mikado_add_admin_container(
        array(
            'parent' => $title_meta_box,
            'name' => 'mkdf_show_title_area_meta_container',
            'hidden_property' => 'mkdf_show_title_area_meta',
            'hidden_value' => 'no'
        )
    );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Title Area Type',
                'description' => 'Choose title type',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'standard' => 'Standard',
                    'breadcrumb' => 'Breadcrumb'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "standard" => "",
                        "breadcrumb" => "#mkdf_mkdf_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#mkdf_mkdf_title_area_type_meta_container",
                        "standard" => "#mkdf_mkdf_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = hashmag_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkdf_title_area_type_meta_container',
                'hidden_property' => 'mkdf_title_area_type_meta',
                'hidden_value' => '',
                'hidden_values' => array('breadcrumb'),
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_area_enable_breadcrumbs_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Enable Breadcrumbs',
                'description' => 'This option will display Breadcrumbs in Title Area',
                'parent' => $title_area_type_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Content Alignment',
                'description' => 'Specify title content alignment',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
                )
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_color_meta',
                'type' => 'color',
                'label' => 'Title Color',
                'description' => 'Choose a color for title text',
                'parent' => $show_title_area_meta_container
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_breadcrumb_color_meta',
                'type' => 'color',
                'label' => 'Title Breadcrumbs Color',
                'description' => 'Choose a color for breadcrumb text',
                'parent' => $show_title_area_meta_container
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_info_color_meta',
                'type' => 'color',
                'label' => 'Title Info Color',
                'description' => 'Choose a color for title info text (only for posts)',
                'parent' => $show_title_area_meta_container
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_area_background_color_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for Title Area',
                'parent' => $show_title_area_meta_container
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Hide Background Image',
                'description' => 'Enable this option to hide background image in Title Area',
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkdf_mkdf_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = hashmag_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkdf_hide_background_image_meta_container',
                'hidden_property' => 'mkdf_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_area_background_image_meta',
                'type' => 'image',
                'label' => 'Background Image',
                'description' => 'Choose an Image for Title Area',
                'parent' => $hide_background_image_meta_container
            )
        );

        hashmag_mikado_add_meta_box_field(
            array(
                'name' => 'mkdf_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Background Responsive Image',
                'description' => 'Enabling this option will make Title background image responsive',
                'parent' => $hide_background_image_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#mkdf_mkdf_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#mkdf_mkdf_title_area_height_meta",
                        "no" => "#mkdf_mkdf_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        hashmag_mikado_add_meta_box_field(array(
            'name' => 'mkdf_title_area_height_meta',
            'type' => 'text',
            'label' => 'Height',
            'description' => 'Set a height for Title Area',
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

    hashmag_mikado_add_meta_box_field(
        array(
            'name' => 'mkdf_title_area_border_color_meta',
            'type' => 'color',
            'label' => 'Bottom Border Color',
            'description' => 'Choose a bottom border color for Title Area',
            'parent' => $show_title_area_meta_container
        )
    );