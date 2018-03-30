<?php

vc_map( array(
        "name" =>"Icon Divider",
        "base" => "icon-divider",
		"description" => "Vector font icon",
        
		"icon" => "icon-wpb-wicon",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "params" => array(
           
             array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon color', 'webnus_framework'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select icon color", 'webnus_framework')
				
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