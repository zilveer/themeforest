<?php

vc_map( array(
        'name' =>'Webnus Quote',
        'base' => 'quote',
		"description" => "Quote",
        "icon" => "webnus_quote",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name', 'webnus_framework' ),
							'param_name' => 'name',
							'value'=>'',
							'description' => esc_html__( 'Enter the Name', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name Subtitle', 'webnus_framework' ),
							'param_name' => 'name_sub',
							'value'=>'',
							'description' => esc_html__( 'Enter the Name Subtitle', 'webnus_framework')
					),
					
					
					
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'webnus_framework' ),
							'param_name' => 'text',
							'value' => '',
							'description' => esc_html__( 'Enter the Quote of the Week content text', 'webnus_framework')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );


?>