<?php

$title_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Title', 'hue'),
        'name'  => 'title_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_show_title_area_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Show Title Area', 'hue'),
        'description'   => esc_html__('Disabling this option will turn off page title area', 'hue'),
        'parent'        => $title_meta_box,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html__('Yes', 'hue')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "",
                "no"  => "#mkd_mkd_show_title_area_meta_container",
                "yes" => ""
            ),
            "show"       => array(
                ""    => "#mkd_mkd_show_title_area_meta_container",
                "no"  => "",
                "yes" => "#mkd_mkd_show_title_area_meta_container"
            )
        )
    )
);

$show_title_area_meta_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $title_meta_box,
        'name'            => 'mkd_show_title_area_meta_container',
        'hidden_property' => 'mkd_show_title_area_meta',
        'hidden_value'    => 'no'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_type_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Title Area Type', 'hue'),
        'description'   => esc_html__('Choose title type', 'hue'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''           => '',
            'standard'   => esc_html__('Standard', 'hue'),
            'breadcrumb' => esc_html__('Breadcrumb', 'hue')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                "standard"   => "",
                "standard"   => "",
                "breadcrumb" => "#mkd_mkd_title_area_type_meta_container"
            ),
            "show"       => array(
                ""           => "#mkd_mkd_title_area_type_meta_container",
                "standard"   => "#mkd_mkd_title_area_type_meta_container",
                "breadcrumb" => ""
            )
        )
    )
);

$title_area_type_meta_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'mkd_title_area_type_meta_container',
        'hidden_property' => 'mkd_title_area_type_meta',
        'hidden_value'    => '',
        'hidden_values'   => array('breadcrumb'),
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_enable_breadcrumbs_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Enable Breadcrumbs', 'hue'),
        'description'   => esc_html__('This option will display Breadcrumbs in Title Area', 'hue'),
        'parent'        => $title_area_type_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html('Yes', 'hue')
        ),
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_gradient_overaly_animation_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Animated Gradient Overlay', 'hue'),
        'description'   => esc_html__('Show animated gradient overlay for Title Area', 'hue'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html('Yes', 'hue')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "#mkd_title_area_gradient_overaly_animation_container",
                "no"  => "#mkd_title_area_gradient_overaly_animation_container",
                "yes" => ""
            ),
            "show"       => array(
                ""    => "",
                "no"  => "",
                "yes" => "#mkd_title_area_gradient_overaly_animation_container"
            )
        )
    )
);

$title_area_gradient_overaly_animation_container_meta = hue_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'title_area_gradient_overaly_animation_container',
        'hidden_property' => 'mkd_title_area_gradient_overaly_animation_meta',
        'hidden_value'    => 'no'
    )
);

$group_title_area_gradient_overlay = hue_mikado_add_admin_group(array(
    'name'        => 'group_page_title_styles',
    'title'       => esc_html__('Animated Gradient Overlay Colors', 'hue'),
    'description' => esc_html__('Define colors for gradient overlay', 'hue'),
    'parent'      => $title_area_gradient_overaly_animation_container_meta
));

$row_gradient_overlay = hue_mikado_add_admin_row(array(
    'name'   => 'row_gradient_overlay',
    'parent' => $group_title_area_gradient_overlay
));

hue_mikado_add_meta_box_field(array(
    'type'          => 'colorsimple',
    'name'          => 'mkd_title_gradient_overlay_color1_meta',
    'default_value' => '',
    'label'         => esc_html__('Color 1', 'hue'),
    'parent'        => $row_gradient_overlay
));

hue_mikado_add_meta_box_field(array(
    'type'          => 'colorsimple',
    'name'          => 'mkd_title_gradient_overlay_color2_meta',
    'default_value' => '',
    'label'         => esc_html__('Color 2', 'hue'),
    'parent'        => $row_gradient_overlay
));

hue_mikado_add_meta_box_field(array(
    'type'          => 'colorsimple',
    'name'          => 'mkd_title_gradient_overlay_color3_meta',
    'default_value' => '',
    'label'         => esc_html__('Color 3', 'hue'),
    'parent'        => $row_gradient_overlay
));

hue_mikado_add_meta_box_field(array(
    'type'          => 'colorsimple',
    'name'          => 'mkd_title_gradient_overlay_color4_meta',
    'default_value' => '',
    'label'         => esc_html__('Color 4', 'hue'),
    'parent'        => $row_gradient_overlay
));

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_animation_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Animations', 'hue'),
        'description'   => esc_html__('Choose an animation for Title Area', 'hue'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''           => '',
            'no'         => esc_html__('No Animation', 'hue'),
            'right-left' => esc_html__('Text right to left', 'hue'),
            'left-right' => esc_html__('Text left to right', 'hue')
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_vertial_alignment_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Vertical Alignment', 'hue'),
        'description'   => esc_html__('Specify title vertical alignment', 'hue'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''              => '',
            'header_bottom' => esc_html__('From Bottom of Header', 'hue'),
            'window_top'    => esc_html__('From Window Top', 'hue')
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_content_alignment_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Horizontal Alignment', 'hue'),
        'description'   => esc_html__('Specify title horizontal alignment', 'hue'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''       => '',
            'left'   => esc_html__('Left', 'hue'),
            'center' => esc_html__('Center', 'hue'),
            'right'  => esc_html__('Right', 'hue')
        )
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_text_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Title Color', 'hue'),
        'description' => esc_html__('Choose a color for title text', 'hue'),
        'parent'      => $show_title_area_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_breadcrumb_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Breadcrumb Color', 'hue'),
        'description' => esc_html__('Choose a color for breadcrumb text', 'hue'),
        'parent'      => $show_title_area_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_area_background_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'hue'),
        'description' => esc_html__('Choose a background color for Title Area', 'hue'),
        'parent'      => $show_title_area_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_hide_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Hide Background Image', 'hue'),
        'description'   => esc_html__('Enable this option to hide background image in Title Area', 'hue'),
        'parent'        => $show_title_area_meta_container,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
            "dependence_show_on_yes" => ""
        )
    )
);

$hide_background_image_meta_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'mkd_hide_background_image_meta_container',
        'hidden_property' => 'mkd_hide_background_image_meta',
        'hidden_value'    => 'yes'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_area_background_image_meta',
        'type'        => 'image',
        'label'       => esc_html__('Background Image', 'hue'),
        'description' => esc_html__('Choose an Image for Title Area', 'hue'),
        'parent'      => $hide_background_image_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_background_image_responsive_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Background Responsive Image', 'hue'),
        'description'   => esc_html__('Enabling this option will make Title background image responsive', 'hue'),
        'parent'        => $hide_background_image_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html__('Yes', 'hue')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "",
                "no"  => "",
                "yes" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta"
            ),
            "show"       => array(
                ""    => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                "no"  => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                "yes" => ""
            )
        )
    )
);

$title_area_background_image_responsive_meta_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $hide_background_image_meta_container,
        'name'            => 'mkd_title_area_background_image_responsive_meta_container',
        'hidden_property' => 'mkd_title_area_background_image_responsive_meta',
        'hidden_value'    => 'yes'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_background_image_parallax_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Background Image in Parallax', 'hue'),
        'description'   => esc_html__('Enabling this option will make Title background image parallax', 'hue'),
        'parent'        => $title_area_background_image_responsive_meta_container,
        'options'       => array(
            ''         => '',
            'no'       => esc_html__('No', 'hue'),
            'yes'      => esc_html__('Yes', 'hue'),
            'yes_zoom' => esc_html__('Yes, with zoom out', 'hue')
        )
    )
);

hue_mikado_add_meta_box_field(array(
    'name'        => 'mkd_title_area_height_meta',
    'type'        => 'text',
    'label'       => esc_html__('Height', 'hue'),
    'description' => esc_html__('Set a height for Title Area', 'hue'),
    'parent'      => $show_title_area_meta_container,
    'args'        => array(
        'col_width' => 2,
        'suffix'    => 'px'
    )
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_disable_title_bottom_border_meta',
    'type'          => 'yesno',
    'label'         => esc_html__('Disable Title Bottom Border', 'hue'),
    'description'   => esc_html__('This option will disable title area bottom border', 'hue'),
    'parent'        => $show_title_area_meta_container,
    'default_value' => 'no'
));

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_title_area_subtitle_meta',
    'type'          => 'text',
    'default_value' => '',
    'label'         => esc_html__('Subtitle Text', 'hue'),
    'description'   => esc_html__('Enter your subtitle text', 'hue'),
    'parent'        => $show_title_area_meta_container,
    'args'          => array(
        'col_width' => 6
    )
));

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_subtitle_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Subtitle Color', 'hue'),
        'description' => esc_html__('Choose a color for subtitle text', 'hue'),
        'parent'      => $show_title_area_meta_container
    )
);