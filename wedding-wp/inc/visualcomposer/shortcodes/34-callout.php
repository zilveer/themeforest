<?php

vc_map( array(
        'name' =>'Webnus Callout',
        'base' => 'callout',
		"description" => "Call to action + button",
        "icon" => "webnus_callout",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'title',
							'value'=>'Title',
							'description' => __( 'Enter the Callout title', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Button Text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'button_text',
							'value'=>'Button Text',
							'description' => __( 'Callout Button text', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Button Link', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'button_link',
							'value'=>'#',
							'description' => __( 'Button Link URL', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea_html',
							'heading' => __( 'Content Text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'text',
							'value' => 'Callout text goes here',
							'description' => __( 'Enter the Callout content text', 'WEBNUS_TEXT_DOMAIN')
					),
		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>