<?php

/*** Gallery Post Format ***/

$gallery_post_format_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Gallery Post Format', 'hue'),
        'name'  => 'post_format_gallery_meta'
    )
);

hue_mikado_add_multiple_images_field(
    array(
        'name'        => 'mkd_post_gallery_images_meta',
        'label'       => esc_html__('Gallery Images', 'hue'),
        'description' => esc_html__('Choose your gallery images', 'hue'),
        'parent'      => $gallery_post_format_meta_box,
    )
);
