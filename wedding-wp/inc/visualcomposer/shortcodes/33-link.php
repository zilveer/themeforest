<?php

vc_map( array(
        'name' =>'Webnus Link',
        'base' => 'link',
		"description" => "Learn more link",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_link",
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