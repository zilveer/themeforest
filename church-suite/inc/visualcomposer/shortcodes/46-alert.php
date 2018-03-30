<?php

vc_map( array(
        "name" =>"Webnus Alert",
        "base" => "alert",
		"description" => "Alert box",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_alert",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"Info"=>"info",
								"Success"=>"success",
								"Warning"=>"warning",
								"Danger"=>"danger",
								
						),
						"description" => esc_html__( "Alert Type", 'webnus_framework')
						),
						array(
							"type" => "checkbox",
							"heading" => esc_html__( "Has Close?", 'webnus_framework' ),
							"param_name" => "close",
							"value" => array('Yes please'=>'true'),
							"description" => esc_html__( "Has Close Button?", 'webnus_framework')
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Alert Content", 'webnus_framework' ),
							"param_name" => "content",
							"value"=>"Content goes here",
							"description" => esc_html__( "Contet Goes Here", 'webnus_framework')
						),
						
           
        ),
		
        
    ) );


?>