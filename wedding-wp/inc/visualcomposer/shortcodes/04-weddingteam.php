<?php

vc_map( array(
        'name' =>'WeddingTeam',
        'base' => 'weddingteam',
		"description" => "Groomsmen & Bridesmaids",
        "icon" => "webnus_ourteam",
        'params'=>array(
					array(
							"type" => "dropdown",
							"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Rose"=>"rose",
								"Jasmine"=>"jasmine",
								"Violet"=>"violet",
								"Orchid"=>"orchid",
						),
						"description" => __( "OurTeam Type", 'WEBNUS_TEXT_DOMAIN')
					),
					
					array(
							'type' => 'attach_image',
							'heading' => __( 'Team Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'',
							'description' => __( 'Team member image', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Team Memeber Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name',
							'value'=>'',
							'description' => __( 'Team member name', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Mirror', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'mirror',
						'value' => array( __( 'Yes', 'js_composer' ) => ' w-mirror' ),
						'description' => __( 'Flip content', 'WEBNUS_TEXT_DOMAIN'),
						'dependency'=>array('element'=>'type','value'=>array('1','2'))
					),
					
					array(
							'type' => 'textfield',
							'heading' => __( 'Team Memeber Title', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => __( 'Team member title', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea',
							'heading' => __( 'Team Memeber Description Text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'text',
							'value'=>'',
							'description' => __( 'Team member description text', 'WEBNUS_TEXT_DOMAIN')
					),

		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>