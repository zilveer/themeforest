<?php

vc_map( array(
        'name' =>'Bride or Groom',
        'base' => 'brideorgroom',
		"description" => "Bride or groom",
        "icon" => "webnus_brideorgroom",
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
						"description" => __( "Type", 'WEBNUS_TEXT_DOMAIN')
					),
					
					array(
							"type" => "dropdown",
							"heading" => __( "Bride or Groom?", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "gender",
							"value" => array(
								"Bride"=>"bride",
								"Groom"=>"groom",	
						),
						"description" => __( "Type", 'WEBNUS_TEXT_DOMAIN')
					),
					
					array(
							'type' => 'attach_image',
							'heading' => __( 'Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'',
							'description' => __( 'Bride or Groom image', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name',
							'value'=>'',
							'description' => __( 'Bride or Groom name', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea',
							'heading' => __( 'Description Text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'text',
							'value'=>'',
							'description' => __( 'Bride or Groom description text', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'dropdown',
							'heading' => __( 'First Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'first_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
									),
								'std' => 'twitter',
							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'First Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'first_url',
							'value'=>'',
							'description' => __( 'First social URL', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'dropdown',
							'heading' => __( 'Second Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'second_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
								),
								'std' => 'facebook',

							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'Second Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'second_url',
							'value'=>'',
							'description' => __( 'Second social URL', 'WEBNUS_TEXT_DOMAIN')
					),


					array(
							'type' => 'dropdown',
							'heading' => __( 'Third Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'third_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
								),
								'std' => 'google-plus',
							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'Third Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'third_url',
							'value'=>'',
							'description' => __( 'Third social URL', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'dropdown',
							'heading' => __( 'Fourth Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'fourth_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
								),
								'std' => 'linkedin',
							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'Fourth Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'fourth_url',
							'value'=>'',
							'description' => __( 'Fourth social URL', 'WEBNUS_TEXT_DOMAIN')
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

		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>