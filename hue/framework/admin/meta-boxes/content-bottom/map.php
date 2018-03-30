<?php

$content_bottom_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Content Bottom', 'hue'),
        'name'  => 'content_bottom_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_enable_content_bottom_area_meta',
        'type'          => 'selectblank',
        'default_value' => '',
        'label'         => esc_html__('Enable Content Bottom Area', 'hue'),
        'description'   => esc_html__('This option will enable Content Bottom area on pages', 'hue'),
        'parent'        => $content_bottom_meta_box,
        'options'       => array(
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html__('Yes', 'hue')
        ),
        'args'          => array(
            'dependence' => true,
            'hide'       => array(
                ''   => '#mkd_mkd_show_content_bottom_meta_container',
                'no' => '#mkd_mkd_show_content_bottom_meta_container'
            ),
            'show'       => array(
                'yes' => '#mkd_mkd_show_content_bottom_meta_container'
            )
        )
    )
);

$show_content_bottom_meta_container = hue_mikado_add_admin_container(
    array(
        'parent'          => $content_bottom_meta_box,
        'name'            => 'mkd_show_content_bottom_meta_container',
        'hidden_property' => 'mkd_enable_content_bottom_area_meta',
        'hidden_value'    => '',
        'hidden_values'   => array('', 'no')
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_content_bottom_sidebar_custom_display_meta',
        'type'          => 'selectblank',
        'default_value' => '',
        'label'         => esc_html__('Sidebar to Display', 'hue'),
        'description'   => esc_html__('Choose a Content Bottom sidebar to display', 'hue'),
        'options'       => hue_mikado_get_custom_sidebars(),
        'parent'        => $show_content_bottom_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'type'          => 'selectblank',
        'name'          => 'mkd_content_bottom_in_grid_meta',
        'default_value' => '',
        'label'         => esc_html__('Display in Grid', 'hue'),
        'description'   => esc_html__('Enabling this option will place Content Bottom in grid', 'hue'),
        'options'       => array(
            'no'  => esc_html__('No', 'hue'),
            'yes' => esc_html__('Yes', 'hue')
        ),
        'parent'        => $show_content_bottom_meta_container
    )
);

hue_mikado_add_meta_box_field(
    array(
        'type'          => 'color',
        'name'          => 'mkd_content_bottom_background_color_meta',
        'default_value' => '',
        'label'         => esc_html__('Background Color', 'hue'),
        'description'   => esc_html__('Choose a background color for Content Bottom area', 'hue'),
        'parent'        => $show_content_bottom_meta_container
    )
);