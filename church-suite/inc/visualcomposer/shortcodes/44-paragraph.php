<?php

vc_map( array(
        'name' =>'Webnus Paragraph',
        'base' => 'p',
		"description" => "P tag",
        "icon" => "webnus_paragraph",
        'params'=>array(


					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Paragraph', 'webnus_framework' ),
							'param_name' => 'content',
							'value' => 'Paragraph content goes here',
							'description' => esc_html__( 'Paragraph', 'webnus_framework')
					),

		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );


?>