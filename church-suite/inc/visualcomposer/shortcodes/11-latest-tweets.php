<?php
vc_map( array(
        'name' =>'Twitter Feed',
        'base' => 'twitterfeed',
		"description" => "Twitter feed",
        "icon" => "webnus_twitterfeed",
        'params'=>array(
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'webnus_framework' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => esc_html__( 'Twitter title', 'webnus_framework')
					),

					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Twitter User Name', 'webnus_framework' ),
							'param_name' => 'username',
							'value'=>'',
							'description' => esc_html__( 'Twitter twitter id', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Feed Count', 'webnus_framework' ),
							'param_name' => 'count',
							'value'=>'',
							'description' => esc_html__( 'Twitter count', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Access Token', 'webnus_framework' ),
							'param_name' => 'access_token',
							'value'=>'',
							'description' => esc_html__( 'Twitter access token', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Access Token Secret', 'webnus_framework' ),
							'param_name' => 'access_token_secret',
							'value'=>'',
							'description' => esc_html__( 'Twitter access token secret', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Consumer Key', 'webnus_framework' ),
							'param_name' => 'consumer_key',
							'value'=>'',
							'description' => esc_html__( 'Twitter consumer key', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Consumer Secret', 'webnus_framework' ),
							'param_name' => 'consumer_secret',
							'value'=>'',
							'description' => esc_html__( 'Twitter consumer secret', 'webnus_framework')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );
?>