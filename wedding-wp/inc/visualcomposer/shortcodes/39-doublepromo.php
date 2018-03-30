<?php

vc_map( array(
        'name' =>'Webnus DoublePromo',
        'base' => 'doublepromo',
		"description" => "2 text box + image",
        "icon" => "webnus_doublepromo",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'title',
							'value'=>'Title',
							'description' => __( 'Enter the Title', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Link Text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'link_text',
							'value'=>'LinkText',
							'description' => __( 'Enter the link text', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Link URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'link_link',
							'value'=>'#',
							'description' => __( 'Enter the link url Example: http://domain.com', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'attach_image',
							'heading' => __( 'Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'',
							'description' => __( 'Enter the image url', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Image alt', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img_alt',
							'value'=>'Alt text',
							'description' => __( 'Enter the image alt Text', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'dropdown',
							'heading' => __( 'Is Last Column?', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'last',
							'value'=>array('Yes'=>'true', 'No'=> 'false'),
							'description' => __( 'Is this second promobox?', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea_html',
							'heading' => __( 'Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'text',
							'value' => 'Doublepromo content text goes here',
							'description' => __( 'Enter the Doublepromo content text', 'WEBNUS_TEXT_DOMAIN')
					),
		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );


?>