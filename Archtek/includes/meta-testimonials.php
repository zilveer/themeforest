<?php

add_action('admin_init', 'uxbarn_create_testimonial_meta_boxes');

if( ! function_exists('uxbarn_create_testimonial_meta_boxes')) {

	function uxbarn_create_testimonial_meta_boxes() {
		
		uxbarn_create_testimonial_text();
		
	}
	
}


if( ! function_exists('uxbarn_create_testimonial_text')) {
    
    function uxbarn_create_testimonial_text() {
        $args = array(
            'id'          => 'uxbarn_testimonial_text_meta_box',
            'title'       => __('Testimonial Text Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'testimonials' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_testimonial_text',
                    'label'       => __('Testimonial Text', 'uxbarn'),
                    'desc'        => __('Enter your testimonial text here. Note that the post title will be used as cite.', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'textarea-simple',
                    'section'     => 'uxbarn_sec_testimonial',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
            )
        );
        
        ot_register_meta_box($args);
    }

}

?>