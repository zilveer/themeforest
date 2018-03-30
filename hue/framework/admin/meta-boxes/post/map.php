<?php

/*** Post Options ***/

$post_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Post', 'hue'),
        'name'  => 'post-meta'
    )
);

$all_pages = array(
    '' => 'Default'
);

$pages = get_pages();
foreach($pages as $page) {
    $all_pages[$page->ID] = $page->post_title;
}

hue_mikado_add_meta_box_field(array(
    'name'          => 'mkd_blog_masonry_gallery_dimensions',
    'type'          => 'select',
    'label'         => esc_html__('Dimensions for Masonry Gallery', 'hue'),
    'description'   => esc_html__('Choose image layout when it appears in Masonry Gallery list', 'hue'),
    'parent'        => $post_meta_box,
    'options'       => array(
        'square'             => esc_html__('Square', 'hue'),
        'large-width'        => esc_html__('Large width', 'hue'),
        'large-height'       => esc_html__('Large height', 'hue'),
        'large-width-height' => esc_html__('Large width/height', 'hue')
    ),
    'default_value' => 'square'
));
