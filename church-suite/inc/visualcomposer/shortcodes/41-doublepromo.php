<?php

vc_map( array(
        'name' =>'Double Promo',
        'base' => 'doublepromo',
		"description" => "2 text box + image",
        "icon" => "webnus_doublepromo",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'webnus_framework' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => esc_html__( 'Enter the Title', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Link Text', 'webnus_framework' ),
							'param_name' => 'link_text',
							'value'=>'',
							'description' => esc_html__( 'Enter the link text', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Link URL', 'webnus_framework' ),
							'param_name' => 'link_link',
							'value'=>'',
							'description' => esc_html__( 'Enter the link url Example: http://domain.com', 'webnus_framework')
					),
					array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'webnus_framework' ),
							'param_name' => 'img',
							'value'=>'',
							'description' => esc_html__( 'Enter the image url', 'webnus_framework')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Image alt', 'webnus_framework' ),
							'param_name' => 'img_alt',
							'value'=>'Alt text',
							'description' => esc_html__( 'Enter the image alt Text', 'webnus_framework')
					),
					array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Is Last Column?', 'webnus_framework' ),
							'param_name' => 'last',
							'value'=>array('Yes'=>'true', 'No'=> 'false'),
							'description' => esc_html__( 'Is this second promobox?', 'webnus_framework')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'webnus_framework' ),
							'param_name' => 'text',
							'value' => '',
							'description' => esc_html__( 'Enter the Doublepromo content text', 'webnus_framework')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        
    ) );


?>