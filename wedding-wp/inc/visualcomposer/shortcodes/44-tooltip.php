<?php

vc_map( array(
        "name" =>"Webnus Tooltip",
        "base" => "tooltip",
		"description" => "Tooltip",
        "category" => esc_html__( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_tooltip",
        "params" => array(
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Tooltip Text", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "tooltiptext",
							"value" => 'Tooltip Text',
							"description" => esc_html__( "Tooltip text goes here", 'WEBNUS_TEXT_DOMAIN')
						),
						
						array(
							'type' => "textarea_html",
							"heading" => esc_html__( 'Tooltip Content', 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => 'tooltip_content',
							"value"=>'Content goes here',
							"description" => esc_html__( "Contet Goes Here", 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>