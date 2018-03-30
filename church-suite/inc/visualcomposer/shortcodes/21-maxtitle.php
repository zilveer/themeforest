<?php

vc_map( array(
        "name" =>"Max Title",
        "base" => "maxtitle",
		"description" => "MaxTitle",
        "category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "icon-wpb-maxtitle",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"Maxtitle 1"=>"1",
								"Maxtitle 2"=>"2",
								"Maxtitle 3"=>"3",
								"Maxtitle 4"=>"4",
								"Maxtitle 5"=>"5",
								"Maxtitle 6"=>"6",
								"Maxtitle 7"=>"7",
								
						),
						"description" => esc_html__( "Title Type", 'webnus_framework')
						),
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Heading", 'webnus_framework' ),
							"param_name" => "heading",
							"value" => array(
								"h1"=>"1",
								"h2"=>"2",
								"h3"=>"3",
								"h4"=>"4",
								"h5"=>"5",
								"h6"=>"6",			
						),
						'std' => '2',
						"description" => wp_kses( __( "Just for SEO<br>Note: it doesn\'t change the size of the max title in the page.", 'webnus_framework'), array( 'br' => array() ) )
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__( "Title", 'webnus_framework' ),
							"param_name" => "maxtitle_content",
							"value" => array('Title'),
							"description" => esc_html__( "Enter the title", 'webnus_framework')
						),
						
           
        ),
		
        
    ) );


?>