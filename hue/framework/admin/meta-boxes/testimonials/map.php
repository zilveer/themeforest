<?php

//Testimonials

$testimonial_meta_box = hue_mikado_add_meta_box(
    array(
        'scope' => array('testimonials'),
        'title' => esc_html__('Testimonial', 'hue'),
        'name'  => 'testimonial_meta'
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_title',
        'type'        => 'text',
        'label'       => esc_html__('Title', 'hue'),
        'description' => esc_html__('Enter testimonial title', 'hue'),
        'parent'      => $testimonial_meta_box,
    )
);


hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_author',
        'type'        => 'text',
        'label'       => esc_html__('Author', 'hue'),
        'description' => esc_html__('Enter author name', 'hue'),
        'parent'      => $testimonial_meta_box,
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_author_position',
        'type'        => 'text',
        'label'       => esc_html__('Job Position', 'hue'),
        'description' => esc_html__('Enter job position', 'hue'),
        'parent'      => $testimonial_meta_box,
    )
);

hue_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_text',
        'type'        => 'text',
        'label'       => esc_html__('Text', 'hue'),
        'description' => esc_html__('Enter testimonial text', 'hue'),
        'parent'      => $testimonial_meta_box,
    )
);