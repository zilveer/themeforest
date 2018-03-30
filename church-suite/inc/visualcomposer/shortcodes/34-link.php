<?php

vc_map( array(
        'name' =>'Webnus Link',
        'base' => 'link',
		"description" => "Learn more link",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_link",
		'params'=>array(
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Link URL', 'webnus_framework' ),
							'param_name' => 'url',
							'value' => '#',
							'description' => esc_html__( 'Link URL, Example: http://domain.com', 'webnus_framework')
					),
					
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Link Text', 'webnus_framework' ),
							'param_name' => 'content',
							'value' => 'Link Text',
							'description' => esc_html__( 'Link Text (Content)', 'webnus_framework')
					),
		)
        
    ) );


?>