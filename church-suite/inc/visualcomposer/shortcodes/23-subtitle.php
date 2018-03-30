<?php

vc_map( array(
        "name" =>"Subtitle",
        "base" => "subtitle",
		"description" => "SubTitle",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_subtitle1",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"Subtitle 1"=>"1",
								"Subtitle 2"=>"2",
								"Subtitle 3"=>"3",									
								"Subtitle 4"=>"4",
								"Subtitle 5"=>"5",
							),
						"description" => esc_html__( "Title Type", 'webnus_framework')
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Title", 'webnus_framework' ),
							"param_name" => "subtitle_content",
							"value" => array('Title'),
							"description" => esc_html__( "Enter the title", 'webnus_framework')
						),
						
           
        ),
		
        
    ) );


?>