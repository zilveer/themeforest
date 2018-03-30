<?php

vc_map( array(
        "name" =>"Webnus Highlight",
        "base" => "highlight",
		"description" => "Highlight",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_highlight",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => __( 'Highlight Type', 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
											'Highlight 1'=>'1',
											'Highlight 2'=>'2',
											'Highlight 3'=>'3',
											'Highlight 4'=>'4',
							
										),
							"description" => __( "Specify the Highlight type", 'WEBNUS_TEXT_DOMAIN')
						),
						
						array(
							"type" => "textarea_html",
							"heading" => __( 'Highlight Content', 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "content",
							"value" => 'Content goes here',
							"description" => __( "Specify the Highlight Text", 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>