<?php

vc_map( array(
        'name' =>'Webnus Line',
        'base' => 'line',
		"description" => "Horizonal line",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_line",
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'Line Type', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'type',
							'value' => array(
											'Line'=>'1',
											'Tick Line'=>'2',
											
																
										),
							'description' => __( 'Select the Line type', 'WEBNUS_TEXT_DOMAIN')
						),
						
						
           
        ),
		
        
    ) );


?>