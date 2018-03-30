<?php

vc_map( array(
        "name" =>"Webnus SubTitle",
        "base" => "subtitle",
		"description" => "SubTitle",
        "category" => esc_html__( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_subtitle1",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Subtitle 1"=>"1",
								"Subtitle 2"=>"2",
								"Subtitle 3"=>"3",									
						),
						"description" => esc_html__( "Title Type", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Title", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "subtitle_content",
							"value" => array('Title'),
							"description" => esc_html__( "Enter the title", 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>