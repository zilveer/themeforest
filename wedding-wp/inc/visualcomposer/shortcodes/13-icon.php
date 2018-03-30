<?php

vc_map( array(
        "name" =>"Webnus Icon",
        "base" => "icon",
		"description" => "Vector font icon",
        
		"icon" => "webnus_icon",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "params" => array(
           
             array(
				"type"=>'textfield',
				"heading"=>__('Icon Size', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "size",
				"value"=>"",
				"description" => __( "Icon size in px format, Example: 16px", 'WEBNUS_TEXT_DOMAIN')
				
			),
			array(
				"type"=>'colorpicker',
				"heading"=>__('Icon color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "color",
				"value"=>"",
				"description" => __( "Select icon color", 'WEBNUS_TEXT_DOMAIN')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>__('Icon Link URL', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "link",
				"value"=>"",
				"description" => __( "Icon link URL http:// ", 'WEBNUS_TEXT_DOMAIN')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>__('Icon Link Class', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "link_class",
				"value"=>"",
				"description" => __( "Icon link Class ", 'WEBNUS_TEXT_DOMAIN')
				
			),
			
           array(
                "type" => "iconfonts",
                "heading" => __( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "name",
                'value'=>'',
                "description" => __( "Select Icon", 'WEBNUS_TEXT_DOMAIN')
            ),
           
        ),
		
        
    ) );


?>