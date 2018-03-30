<?php

vc_map( array(
        'name' =>'Webnus Dropcap',
        'base' => 'dropcap',
		"description" => "Dropcap",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
         "icon" => "webnus_dropcap",
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Dropcap Type', 'webnus_framework' ),
							'param_name' => 'type',
							'value' => array(
											'Dropcap 1'=>'1',
											'Dropcap 2'=>'2',
											'Dropcap 3'=>'3',
											
							
										),
							'description' => esc_html__( 'Specify the Dropcap type', 'webnus_framework')
						),
						
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Dropcap Character', 'webnus_framework' ),
							'param_name' => 'dropcap_content',
							'value' => 'A',
							'description' => esc_html__( 'Specify the Dropcap Text', 'webnus_framework')
						),
						
           
        ),
		
        
    ) );


?>