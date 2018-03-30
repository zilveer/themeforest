<?php

vc_map( array(
        'name' =>'Webnus Quote',
        'base' => 'quote',
		"description" => "Quote",
        "icon" => "webnus_quote",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => __( 'Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name',
							'value'=>'Name',
							'description' => __( 'Enter the Name', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Name Subtitle', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name_sub',
							'value'=>'Name Subtitle',
							'description' => __( 'Enter the Name Subtitle', 'WEBNUS_TEXT_DOMAIN')
					),
					
					
					
					array(
							'type' => 'textarea_html',
							'heading' => __( 'Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'text',
							'value' => 'Quote content text goes here',
							'description' => __( 'Enter the Quote of the Week content text', 'WEBNUS_TEXT_DOMAIN')
					),
		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>