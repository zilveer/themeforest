<?php

//Carousels

$carousel_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('carousels'),
        'title' => esc_html__('Carousel', 'hue'),
        'name'  => 'carousel_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_image',
        'type'        => 'image',
        'label'       => esc_html__('Carousel Image', 'hue'),
        'description' => esc_html__('Choose carousel image (min width needs to be 215px)', 'hue'),
        'parent'      => $carousel_meta_box
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_hover_image',
        'type'        => 'image',
        'label'       => esc_html__('Carousel Hover Image', 'hue'),
        'description' => esc_html__('Choose carousel hover image (min width needs to be 215px)', 'hue'),
        'parent'      => $carousel_meta_box
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_item_link',
        'type'        => 'text',
        'label'       => esc_html__('Link', 'hue'),
        'description' => esc_html__('Enter the URL to which you want the image to link to (e.g. http://www.example.com)', 'hue'),
        'parent'      => $carousel_meta_box
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_item_target',
        'type'        => 'selectblank',
        'label'       => esc_html__('Target', 'hue'),
        'description' => esc_html__('Specify where to open the linked document', 'hue'),
        'parent'      => $carousel_meta_box,
        'options'     => array(
            '_self'  => esc_html__('Self', 'hue'),
            '_blank' => esc_html__('Blank', 'hue')
        )
    )
);