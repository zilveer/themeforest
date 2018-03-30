<?php

vc_map( array(
        'name' =>'Wedding Box',
        'base' => 'weddingbox',
        "icon" => "icon-wpb-weddingbox",
		"description" => "Wedding-box",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params' => array(
						
			array(
				"type" => "textfield",
				"heading" => __( "Title", 'WEBNUS_TEXT_DOMAIN' ),
				"param_name" => "title",
				"value" => '',
				"description" => __( "Enter the title", 'WEBNUS_TEXT_DOMAIN')
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Detail', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'detail',
				'value'=>'',
				'description' => __( 'Detail', 'WEBNUS_TEXT_DOMAIN')
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Description Text', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'desc',
				'value'=>'',
				'description' => __( 'description text', 'WEBNUS_TEXT_DOMAIN')
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Mirror', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'mirror',
				'value' => array( __( 'Yes', 'js_composer' ) => ' w-mirror' ),
				'description' => __( 'Flip content', 'WEBNUS_TEXT_DOMAIN'),
			),

        )
        
    ) );

?>