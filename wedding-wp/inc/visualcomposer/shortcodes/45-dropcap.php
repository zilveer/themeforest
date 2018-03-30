<?php

vc_map( array(
        'name' =>'Webnus Dropcap',
        'base' => 'dropcap',
		"description" => "Dropcap",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
         "icon" => "webnus_dropcap",
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'Dropcap Type', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'type',
							'value' => array(
											'Dropcap 1'=>'1',
											'Dropcap 2'=>'2',
											'Dropcap 3'=>'3',
											
							
										),
							'description' => __( 'Specify the Dropcap type', 'WEBNUS_TEXT_DOMAIN')
						),
						
						array(
							'type' => 'textfield',
							'heading' => __( 'Dropcap Character', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'dropcap_content',
							'value' => '',
							'description' => __( 'Specify the Dropcap Text', 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>