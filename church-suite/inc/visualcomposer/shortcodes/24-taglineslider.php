<?php

vc_map( array(
        "name" =>"Tagline Slider",
        "base" => "taglineslider",
		"description" => "Taglines for MaxSlider",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "icon-wpb-taglineslider",
        "params" => array(
						
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Taglines", 'webnus_framework' ),
							"param_name" => "content",
							"value" => '[tagline]We are [span]creative[/span][/tagline][tagline]We are [span]smart[/span][/tagline]',
							"description" => esc_html__( "Enter the taglines", 'webnus_framework')
						),
						
           
        ),
		
        		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
    ) );


?>