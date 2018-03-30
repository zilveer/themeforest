<?php

vc_map( array(
        'name' =>'Webnus Paragraph',
        'base' => 'p',
		"description" => "P tag",
        "icon" => "webnus_paragraph",
        'params'=>array(


					array(
							'type' => 'textarea_html',
							'heading' => __( 'Paragraph', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'content',
							'value' => 'Paragraph content goes here',
							'description' => __( 'Paragraph', 'WEBNUS_TEXT_DOMAIN')
					),

		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>