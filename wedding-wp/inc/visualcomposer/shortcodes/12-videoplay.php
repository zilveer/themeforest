<?php

vc_map( array(
        "name" =>"Webnus Video Play Button",
        "base" => "videoplay",
		"description" => "Video Play Button",
		"icon" => "webnus_videoplay",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "params" => array(
		
  			array(
							'type' => 'textfield',
							'heading' => __( 'Video URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'link',
							'value' => '#',
							'description' => __( 'YouTube/Vimeo URL', 'WEBNUS_TEXT_DOMAIN')
					),
					
             array(
				"type"=>'textfield',
				"heading"=>__('Icon Size', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "size",
				"value"=>"",
				"description" => __( "Icon size in px format, Example: 80px", 'WEBNUS_TEXT_DOMAIN')
				
			),
			array(
				"type"=>'colorpicker',
				"heading"=>__('Icon color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "color",
				"value"=>"",
				"description" => __( "Select icon color", 'WEBNUS_TEXT_DOMAIN')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>__('Extra Class', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "link_class",
				"value"=>"",
				"description" => __( "Extra Class ", 'WEBNUS_TEXT_DOMAIN')
				
			),
           
        ),
		
        
    ) );


?>