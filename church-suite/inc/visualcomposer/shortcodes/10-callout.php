<?php

vc_map( array(
        'name' =>'Webnus Callout',
        'base' => 'callout',
		"description" => "Call to action + button",
        "icon" => "webnus_callout",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'webnus_framework' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => esc_html__( 'Enter the Callout title', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button Text', 'webnus_framework' ),
							'param_name' => 'button_text',
							'value'=>'',
							'description' => esc_html__( 'Callout Button text', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button Link', 'webnus_framework' ),
							'param_name' => 'button_link',
							'value'=>'',
							'description' => esc_html__( 'Button Link URL', 'webnus_framework')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content Text', 'webnus_framework' ),
							'param_name' => 'text',
							'value' => '',
							'description' => esc_html__( 'Enter the Callout content text', 'webnus_framework')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );


?>