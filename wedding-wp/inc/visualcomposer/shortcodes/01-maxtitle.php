<?php

vc_map( array(
        "name" =>"Webnus MaxTitle",
        "base" => "maxtitle",
		"description" => "MaxTitle",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "icon-wpb-maxtitle",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Rose (small)"=>"rose1",
								"Rose (big)"=>"rose2",
								"Jasmine"=>"jasmine",
								"Violet"=>"violet",
								"Orchid"=>"orchid",							
							),
							"description" => __( "Title Type", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Heading", 'WEBNUS_TEXT_DOMAIN' ),
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
						"description" => __( "Just for SEO", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "textfield",
							"heading" => __( "Title", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "maxtitle_content",
							"value" => array('Title'),
							"description" => __( "Enter the title", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type"=>'colorpicker',
							"heading"=>__('Title color', 'WEBNUS_TEXT_DOMAIN'),
							"param_name"=> "color",
							"value"=>"",
							"description" => __( "Select title color (leave blank for default color)", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "textfield",
							"heading" => __( "Title - second part", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "secondtitle",
							"value" => "",
							"description" => __( "Enter the title second part", 'WEBNUS_TEXT_DOMAIN'),
							'dependency'=>array('element'=>'type','value'=>'jasmine')
						),
						array(
							"type"=>'colorpicker',
							"heading"=>__('Title - second part color', 'WEBNUS_TEXT_DOMAIN'),
							"param_name"=> "secondcolor",
							"value"=>"",
							"description" => __( "Select second part color (leave blank for default color)", 'WEBNUS_TEXT_DOMAIN'),
							'dependency'=>array('element'=>'type','value'=>'jasmine')
						),
						array(
							"type" => "textarea",
							"heading" => __( "Description", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "description",
							"value" => "",
							"description" => __( "MaxTitle description goes here", 'WEBNUS_TEXT_DOMAIN')
						),
           
        ),
		
        
    ) );


?>