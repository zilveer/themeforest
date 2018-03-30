<?php

vc_map( array(
        "name" =>"Webnus Icon Divider",
        "base" => "icon-divider",
		"description" => "Vector font icon",
        
		"icon" => "icon-wpb-wicon",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "params" => array(
           
             array(
				"type"=>'colorpicker',
				"heading"=>__('Icon color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "color",
				"value"=>"",
				"description" => __( "Select icon color", 'WEBNUS_TEXT_DOMAIN')
				
			),
             array(
				"type"=>'colorpicker',
				"heading"=>__('Border color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "border-color",
				"value"=>"",
				"description" => __( "Select border color", 'WEBNUS_TEXT_DOMAIN')
				
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