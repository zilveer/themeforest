<?php

vc_map( array(
        "name" =>"Process Item",
        "base" => "process",
        "description" => "Process item",
		"icon" => "webnus_process",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "params" => array(
           
           
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Process  Title', 'webnus_framework'),
				"param_name"=> "proc_title",
				"value"=>"",
				"description" => esc_html__( "Process Item 1 Title ", 'webnus_framework')
				
			),
			 
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Process  Text', 'webnus_framework'),
				"param_name"=> "proc_text",
				"value"=>"",
				"description" => esc_html__( "Process Item 1 Text ", 'webnus_framework')
				
			),
			 array(
				"type"=>'iconfonts',
				"heading"=>esc_html__('Process  Icon', 'webnus_framework'),
				"param_name"=> "proc_icon",
				"value"=>"",
				"description" => esc_html__( "Process Item 1 Icon ", 'webnus_framework')
				
			),
			
        ),
		
        
    ) );


?>