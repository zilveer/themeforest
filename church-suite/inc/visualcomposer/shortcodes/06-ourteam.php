<?php

vc_map( array(
        'name' =>'Our Team',
        'base' => 'ourteam',
		"description" => "Team member",
        "icon" => "webnus_ourteam",
        'params'=>array(
			
        	array(
					"type" => "dropdown",
					"heading" => esc_html__( "Type", 'webnus_framework' ),
					"param_name" => "type",
					"value" => array(
						"Type 1"=>"1",
						"Type 2"=>"2",
						"Type 3"=>"3",						
				),
				"description" => esc_html__( "You can choose among these pre-designed types.", 'webnus_framework')
			),

			array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Team Image', 'webnus_framework' ),
					'param_name' => 'img',
					'value'=>'',
					'description' => esc_html__( 'Team member image', 'webnus_framework')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Team Memeber Name', 'webnus_framework' ),
					'param_name' => 'name',
					'value'=>'',
					'description' => esc_html__( 'Team member name', 'webnus_framework')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link URL', 'webnus_framework' ),
					'param_name' => 'link',
					'value'=>'',
					'description' => esc_html__( 'Team member link url', 'webnus_framework')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Team Memeber Title', 'webnus_framework' ),
					'param_name' => 'title',
					'value'=>'',
					'description' => esc_html__( 'Team member title', 'webnus_framework')
			),
			array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Team Memeber Description Text', 'webnus_framework' ),
					'param_name' => 'text',
					'value'=>'',
					'description' => esc_html__( 'Team member description text', 'webnus_framework')
			),
			array(
				'heading' => esc_html__('Social Icons', 'webnus_framework') ,
				'description' => wp_kses( __('By enabling this option, Member social networks links will appear.<br/><br/>', 'webnus_framework'), array( 'br' => array() ) ),
				'param_name' => 'social',
				'value' => array( esc_html__( 'Enable', 'webnus_framework' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
			) ,
			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'First Social Name', 'webnus_framework' ),
					'param_name' => 'first_social',
					 'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
							),
						'std' => 'twitter',
					'description' => esc_html__( 'Select Social Name', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'First Social URL', 'webnus_framework' ),
					'param_name' => 'first_url',
					'value'=>'',
					'description' => esc_html__( 'First social URL', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Second Social Name', 'webnus_framework' ),
					'param_name' => 'second_social',
					 'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
							),
						'std' => 'facebook',

					'description' => esc_html__( 'Select Social Name', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Second Social URL', 'webnus_framework' ),
					'param_name' => 'second_url',
					'value'=>'',
					'description' => esc_html__( 'Second social URL', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),


			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Third Social Name', 'webnus_framework' ),
					'param_name' => 'third_social',
					 'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
							),
						'std' => 'google-plus',
					'description' => esc_html__( 'Select Social Name', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Third Social URL', 'webnus_framework' ),
					'param_name' => 'third_url',
					'value'=>'',
					'description' => esc_html__( 'Third social URL', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Fourth Social Name', 'webnus_framework' ),
					'param_name' => 'fourth_social',
					 'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
							),
						'std' => 'linkedin',
					'description' => esc_html__( 'Select Social Name', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Fourth Social URL', 'webnus_framework' ),
					'param_name' => 'fourth_url',
					'value'=>'',
					'description' => esc_html__( 'Fourth social URL', 'webnus_framework'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),


		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );


?>