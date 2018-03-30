<?php

vc_map( array(
        'name' =>'Eventbox',
        'base' => 'eventbox',
        "icon" => "icon-wpb-eventbox",
		"description" => "Eventbox",
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
				'type' => 'textarea',
				'heading' => __( 'Date', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'date',
				'value'=>'',
				'description' => __( 'Date (SATURDAY 14 FEBRUARY 2015)', 'WEBNUS_TEXT_DOMAIN')
			),

			array(
				'type' => 'textarea',
				'heading' => __( 'Time', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'time',
				'value'=>'',
				'description' => __( 'Time', 'WEBNUS_TEXT_DOMAIN')
			),

			array(
				'type' => 'textarea',
				'heading' => __( 'Description Text', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'desc',
				'value'=>'',
				'description' => __( 'description text', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				"type"=>'textfield',
				"heading"=>__('Link Text', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "link_text",
				"value"=>"",
				"description" => __( "Link Text", 'WEBNUS_TEXT_DOMAIN'),	
			),
			array(
				"type"=>'textfield',
				"heading"=>__('Link URL', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "link_url",
				"value"=>"",
				"description" => __( "Link URL (http://example.com)", 'WEBNUS_TEXT_DOMAIN'),	
			),

        )
        
    ) );

?>