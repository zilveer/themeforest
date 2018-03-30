<?php

vc_map( array(
        "name" =>"Video Play Button",
        "base" => "videoplay",
		"description" => "Video Play Button",
		"icon" => "webnus_videoplay",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "params" => array(
		
  			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Video URL', 'webnus_framework' ),
							'param_name' => 'link',
							'value' => '#',
							'description' => esc_html__( 'YouTube/Vimeo URL', 'webnus_framework')
					),
					
             array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Size', 'webnus_framework'),
				"param_name"=> "size",
				"value"=>"",
				"description" => esc_html__( "Icon size in px format, Example: 80px", 'webnus_framework')
				
			),
			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon color', 'webnus_framework'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select icon color", 'webnus_framework')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Extra Class', 'webnus_framework'),
				"param_name"=> "link_class",
				"value"=>"",
				"description" => esc_html__( "Extra Class ", 'webnus_framework')
				
			),
           
        ),
		
        
    ) );


?>