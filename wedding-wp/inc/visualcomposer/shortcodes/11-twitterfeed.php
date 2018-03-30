<?php

vc_map( array(
        'name' =>'Webnus Twitterfeed',
        'base' => 'twitterfeed',
		"description" => "Twitter feed",
        "icon" => "webnus_twitterfeed",
        'params'=>array(
					
					array(
						"type" => "dropdown",
						"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
						"param_name" => "type",
						"value" => array(
							"Jasmine"	=>"jasmine",
							"Violet"	=>"violet"
						),
						"description" => __( "Twitter Type", 'WEBNUS_TEXT_DOMAIN')
					),
					
					array(
							'type' => 'attach_image',
							'heading' => __( 'Twitter Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'',
							'description' => __( 'Twitter image', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => __( 'Twitter title', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Twitter User Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'username',
							'value'=>'',
							'description' => __( 'Twitter twitter id', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Feed Count', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'count',
							'value'=>'',
							'description' => __( 'Twitter count', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Access Token', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'access_token',
							'value'=>'',
							'description' => __( 'Twitter access token', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Access Token Secret', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'access_token_secret',
							'value'=>'',
							'description' => __( 'Twitter access token secret', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Consumer Key', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'consumer_key',
							'value'=>'',
							'description' => __( 'Twitter consumer key', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Consumer Secret', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'consumer_secret',
							'value'=>'',
							'description' => __( 'Twitter consumer secret', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Mirror', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'mirror',
						'value' => array( __( 'Yes', 'js_composer' ) => ' w-mirror' ),
						'description' => __( 'Flip content', 'WEBNUS_TEXT_DOMAIN'),
						'dependency'=>array('element'=>'type','value'=>'2')
					),
					array(
						"type"=>'textfield',
						"heading"=>__('Follow Text', 'WEBNUS_TEXT_DOMAIN'),
						"param_name"=> "follow_text",
						"value"=>"",
						"description" => __( "Twitter follow text", 'WEBNUS_TEXT_DOMAIN'),	
					)

		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>