<?php

vc_map( array(
        'name' =>'Webnus Testimonial',
        'base' => 'testimonial',
		"description" => "Testimonial",
        "icon" => "webnus_testimonial",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name', 'webnus_framework' ),
							'param_name' => 'name',
							'value'=>'Name',
							'description' => esc_html__( 'Enter the Testimonial Name', 'webnus_framework')
					),
					array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'webnus_framework' ),
							'param_name' => 'img',
							'value'=>'http://',
							'description' => esc_html__( 'Testimonial Image', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Subtitle', 'webnus_framework' ),
							'param_name' => 'subtitle',
							'value'=>'',
							'description' => esc_html__( 'Testimonial Subtitle', 'webnus_framework')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'webnus_framework' ),
							'param_name' => 'testimonial_content',
							'value' => 'Testimonial content text goes here',
							'description' => esc_html__( 'Enter the Testimonial content text', 'webnus_framework')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );


?>