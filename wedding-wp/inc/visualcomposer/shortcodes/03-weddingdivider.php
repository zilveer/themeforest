<?php

vc_map( array(
        "name" =>"Wedding Divider",
        "base" => "wedding-divider",
		"description" => "Divider Images",
		"icon" => "icon-wpb-wdivider",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "params" => array(
           	
             array(
                "type" => "dropdown",
                "heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "type",
                "value" => array(
				"Bottom Floral"=>'1',
				"Golden Ring"=>'2',
				"Blue Heart"=>'3',
				),
                "description" => __( "Select Image", 'WEBNUS_TEXT_DOMAIN')
            ),  
        ),
		
    ) );
	
?>