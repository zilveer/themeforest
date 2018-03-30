<?php

if(!function_exists('hue_mikado_map_portfolio_settings')) {
    function hue_mikado_map_portfolio_settings() {
        $meta_box = hue_mikado_add_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'hue'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        hue_mikado_add_meta_box_field(array(
            'name'        => 'mkd_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'hue'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'hue'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'hue'),
                'small-images'      => esc_html__('Portfolio small images', 'hue'),
                'small-slider'      => esc_html__('Portfolio small slider', 'hue'),
                'big-images'        => esc_html__('Portfolio big images', 'hue'),
                'big-slider'        => esc_html__('Portfolio big slider', 'hue'),
                'custom'            => esc_html__('Portfolio custom', 'hue'),
                'full-width-custom' => esc_html__('Portfolio full width custom', 'hue'),
                'masonry'           => esc_html__('Portfolio masonry', 'hue'),
                'gallery'           => esc_html__('Portfolio gallery', 'hue')
            )
        ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        hue_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'hue'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'hue'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        $group_portfolio_external_link = hue_mikado_add_admin_group(array(
            'name'        => 'group_portfolio_external_link',
            'title'       => esc_html__('Portfolio External Link', 'hue'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'hue'),
            'parent'      => $meta_box
        ));

        $row_portfolio_external_link = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_overlay',
            'parent' => $group_portfolio_external_link
        ));

        hue_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'textsimple',
            'label'       => esc_html__('Link', 'hue'),
            'description' => '',
            'parent'      => $row_portfolio_external_link,
            'args'        => array(
                'col_width' => 3
            )
        ));

        hue_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_external_link_target',
            'type'        => 'selectsimple',
            'label'       => esc_html__('Target', 'hue'),
            'description' => '',
            'parent'      => $row_portfolio_external_link,
            'options'     => array(
                '_self'  => esc_html__('Same Window', 'hue'),
                '_blank' => esc_html__('New Window', 'hue')
            )
        ));


        hue_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_masonry_dimenisions',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Masonry', 'hue'),
            'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists', 'hue'),
            'parent'      => $meta_box,
            'options'     => array(
                'default'            => esc_html__('Default', 'hue'),
                'large_width'        => esc_html__('Large width', 'hue'),
                'large_height'       => esc_html__('Large height', 'hue'),
                'large_width_height' => esc_html__('Large width/height', 'hue')
            )
        ));
    }

    add_action('hue_mikado_meta_boxes_map', 'hue_mikado_map_portfolio_settings');
}