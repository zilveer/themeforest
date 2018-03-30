<?php

vc_map( array(
        "name" =>"Webnus Tooltip",
        "base" => "tooltip",
		"description" => "Tooltip",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_tooltip",
        "params" => array(
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Tooltip Text", 'webnus_framework' ),
							"param_name" => "tooltiptext",
							"value" => 'Tooltip Text',
							"description" => esc_html__( "Tooltip text goes here", 'webnus_framework')
						),
						
						array(
							'type' => "textarea",
							"heading" => esc_html__( 'Tooltip Content', 'webnus_framework' ),
							"param_name" => 'tooltip_content',
							"value"=>'Content goes here',
							"description" => esc_html__( "Contet Goes Here", 'webnus_framework')
						),
						
           
        ),
		
        
    ) );


?>