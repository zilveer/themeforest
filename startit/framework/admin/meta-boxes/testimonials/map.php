<?php

//Testimonials

$testimonial_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('testimonials'),
        'title' => 'Testimonial',
        'name' => 'testimonial_meta'
    )
);

    qode_startit_add_meta_box_field(
        array(
            'name'        	=> 'qodef_testimonial_title',
            'type'        	=> 'text',
            'label'       	=> 'Title',
            'description' 	=> 'Enter testimonial title',
            'parent'      	=> $testimonial_meta_box,
        )
    );


    qode_startit_add_meta_box_field(
        array(
            'name'        	=> 'qodef_testimonial_author',
            'type'        	=> 'text',
            'label'       	=> 'Author',
            'description' 	=> 'Enter author name',
            'parent'      	=> $testimonial_meta_box,
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        	=> 'qodef_testimonial_author_position',
            'type'        	=> 'text',
            'label'       	=> 'Job Position',
            'description' 	=> 'Enter job position',
            'parent'      	=> $testimonial_meta_box,
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        	=> 'qodef_testimonial_text',
            'type'        	=> 'text',
            'label'       	=> 'Text',
            'description' 	=> 'Enter testimonial text',
            'parent'      	=> $testimonial_meta_box,
        )
    );