<?php

vc_map( array(
        'name' =>'Webnus Big Title',
        'base' => 'big_title',
		"description" => "Bordered title",
        "icon" => "webnus_big_title",
        'params'=>array(
					
					array(
							'type' => 'textarea',
							'heading' => __( 'BigTitle Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'bigtitle_content',
							'value' => 'Bigtitle text',
							'description' => __( 'Enter the Bigtitle content', 'WEBNUS_TEXT_DOMAIN')
					),
		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>