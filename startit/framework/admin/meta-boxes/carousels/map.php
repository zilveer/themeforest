<?php

//Carousels

$carousel_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('carousels'),
        'title' => 'Carousel',
        'name' => 'carousel_meta'
    )
);

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_carousel_image',
            'type'        => 'image',
            'label'       => 'Carousel Image',
            'description' => 'Choose carousel image (min width needs to be 215px)',
            'parent'      => $carousel_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_carousel_hover_image',
            'type'        => 'image',
            'label'       => 'Carousel Hover Image',
            'description' => 'Choose carousel hover image (min width needs to be 215px)',
            'parent'      => $carousel_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_carousel_item_link',
            'type'        => 'text',
            'label'       => 'Link',
            'description' => 'Enter the URL to which you want the image to link to (e.g. http://www.example.com)',
            'parent'      => $carousel_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_carousel_item_target',
            'type'        => 'selectblank',
            'label'       => 'Target',
            'description' => 'Specify where to open the linked document',
            'parent'      => $carousel_meta_box,
            'options' => array(
            	'_self' => 'Self',
            	'_blank' => 'Blank'
        	)
        )
    );