<?php

/*** Link Post Format ***/

$link_post_format_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Link Post Format', 'hue'),
        'name'  => 'post_format_link_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_link_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Link', 'hue'),
        'description' => esc_html__('Enter link', 'hue'),
        'parent'      => $link_post_format_meta_box,

    )
);

