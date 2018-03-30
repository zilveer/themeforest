<?php

vc_map( array(
        "name" =>"Webnus Alert",
        "base" => "alert",
		"description" => "Alert box",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_alert",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Info"=>"info",
								"Success"=>"success",
								"Warning"=>"warning",
								"Danger"=>"danger",	
							),
							"description" => __( "Alert Type", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "checkbox",
							"heading" => __( "Has Close?", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "close",
							"value" => array('Yes please'=>'true'),
							"description" => __( "Has Close Button?", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textarea',
							"heading" => __( 'Alert Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'alert_content',
							'value'=>'Content goes here',
							'description' => __( 'Contet Goes Here', 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>