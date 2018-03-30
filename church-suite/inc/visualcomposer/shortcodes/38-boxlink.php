<?php

vc_map( array(
        'name' =>'Box Link',
        'base' => 'boxlink',
		"description" => "Orange box link",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_boxlink",
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
							'param_name' => 'boxlink_content',
							'value' => 'Link Text',
							'description' => esc_html__( 'Link Text (Content)', 'webnus_framework')
					),
		)
        
    ) );


?>