<?php

vc_map( array(
        'name' =>'Webnus BoxLink',
        'base' => 'boxlink',
		"description" => "Orange box link",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_boxlink",
		'params'=>array(
					array(
							'type' => 'textfield',
							'heading' => __( 'Link URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'url',
							'value' => '#',
							'description' => __( 'Link URL, Example: http://domain.com', 'WEBNUS_TEXT_DOMAIN')
					),
					
					array(
							'type' => 'textarea_html',
							'heading' => __( 'Link Text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'content',
							'value' => 'Link Text',
							'description' => __( 'Link Text (Content)', 'WEBNUS_TEXT_DOMAIN')
					),
		)
        
    ) );


?>