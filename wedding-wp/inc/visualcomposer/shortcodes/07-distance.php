<?php

vc_map( array(
        'name' =>'Webnus Distance',
        'base' => 'distance',
		"description" => "Vertical Space",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_distance",
		'params'=>array(
					array(
							'type' => 'dropdown',
							'heading' => __( 'Type', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'type',
							'value' => array(
								
								'Distance 1'=>'1',
								'Distance 2'=>'2',
								'Distance 3'=>'3',
								'Distance 4'=>'4',
							),
							'description' => __( 'Distance Type', 'WEBNUS_TEXT_DOMAIN')
					),
					
		)
        
    ) );


?>