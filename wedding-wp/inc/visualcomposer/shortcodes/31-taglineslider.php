<?php

vc_map( array(
        "name" =>"Webnus TaglineSlider",
        "base" => "taglineslider",
		"description" => "Taglines for MaxSlider",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "icon-wpb-taglineslider",
        "params" => array(
						
						array(
							"type" => "textarea_html",
							"heading" => __( "Taglines", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "content",
							"value" => '[tagline]We are [span]creative[/span][/tagline][tagline]We are [span]smart[/span][/tagline]',
							"description" => __( "Enter the taglines", 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
    ) );


?>