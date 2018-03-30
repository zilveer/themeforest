<?php

$custom_sidebars = hue_mikado_get_custom_sidebars();

$sidebar_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Sidebar', 'hue'),
        'name'  => 'sidebar_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_sidebar_meta',
        'type'        => 'select',
        'label'       => esc_html__('Layout', 'hue'),
        'description' => esc_html__('Choose the sidebar layout', 'hue'),
        'parent'      => $sidebar_meta_box,
        'options'     => array(
            ''                 => esc_html__('Default', 'hue'),
            'no-sidebar'       => esc_html__('No Sidebar', 'hue'),
            'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'hue'),
            'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'hue'),
            'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'hue'),
            'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'hue'),
        )
    )
);

if(count($custom_sidebars) > 0) {
    hue_mikado_add_meta_box_field(array(
        'name'        => 'mkd_custom_sidebar_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Choose Widget Area in Sidebar', 'hue'),
        'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'hue'),
        'parent'      => $sidebar_meta_box,
        'options'     => $custom_sidebars
    ));
}
