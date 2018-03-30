<?php

vc_map( array(
        "name" =>"Webnus Icon",
        "base" => "icon",
		"description" => "Vector font icon",
        
		"icon" => "webnus_icon",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "params" => array(
           
             array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Size', 'webnus_framework'),
				"param_name"=> "size",
				"value"=>"",
				"description" => esc_html__( "Icon size in px format, Example: 16px", 'webnus_framework')
				
			),
			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon color', 'webnus_framework'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select icon color", 'webnus_framework')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Link URL', 'webnus_framework'),
				"param_name"=> "link",
				"value"=>"",
				"description" => esc_html__( "Icon link URL http:// ", 'webnus_framework')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Link Class', 'webnus_framework'),
				"param_name"=> "link_class",
				"value"=>"",
				"description" => esc_html__( "Icon link Class ", 'webnus_framework')
				
			),
			
           array(
                "type" => "iconfonts",
                "heading" => esc_html__( "Icon", 'webnus_framework' ),
                "param_name" => "name",
                'value'=>'',
                "description" => esc_html__( "Select Icon", 'webnus_framework')
            ),
           
        ),
		
        
    ) );


?>