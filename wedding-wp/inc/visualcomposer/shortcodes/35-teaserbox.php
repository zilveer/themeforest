<?php

vc_map( array(
        'name' =>'Webnus Teaser Box',
        'base' => 'teaserbox',
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
		"description" => "Image and icon with text article",
        "icon" => "webnus_teaserbox",
        'params'=>array(
			array(
				"type" => "dropdown",
				"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
				"param_name" => "type",
				"value" => array(
					"Type 1"=>"1",
					"Type 2"=>"2",
				),
				"description" => __( "TeaserBox Type", 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'img',
				'value'=>'',
				'description' => __( 'TeaserBox Image', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image alt', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'img_alt',
				'value'=>'',
				'description' => __( 'Enter the image alt Text', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Subtitle', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'subtitle',
				'value'=>'',
				'description' => __( 'Enter the Subtitle', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				"type"=>'colorpicker',
				"heading"=>__('Subtitle background color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "subtitle_bg",
				"value"=>"",
				"description" => __( "Select background color for subtitle", 'WEBNUS_TEXT_DOMAIN')
				
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'title',
				'value'=>'',
				'description' => __( 'Enter the Title', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Link URL', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'link_url',
				'value'=>'#',
				'description' => __( 'Enter the link url Example: http://domain.com', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Description Text', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'text',
				'value'=>'',
				'description' => __( 'Enter the description text', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				"type"=>'colorpicker',
				"heading"=>__('Icon background color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "icon_bg",
				"value"=>"",
				"description" => __( "Select background color for icon", 'WEBNUS_TEXT_DOMAIN')
				
			),
			array(
                "type" => "iconfonts",
                "heading" => __( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "icon",
                'value'=>'',
                "description" => __( "Select Icon", 'WEBNUS_TEXT_DOMAIN')
            )					
		),
        
    ) );


?>