<?php

vc_map( array(
        'name' =>'Webnus Testimonial',
        'base' => 'testimonial',
		"description" => "Testimonial",
        "icon" => "webnus_testimonial",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name',
							'value'=>'Name',
							'description' => esc_html__( 'Enter the Testimonial Name', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'http://',
							'description' => esc_html__( 'Testimonial Image', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Subtitle', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'subtitle',
							'value'=>'',
							'description' => esc_html__( 'Testimonial Subtitle', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'testimonial_content',
							'value' => 'Testimonial content text goes here',
							'description' => esc_html__( 'Enter the Testimonial content text', 'WEBNUS_TEXT_DOMAIN')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>