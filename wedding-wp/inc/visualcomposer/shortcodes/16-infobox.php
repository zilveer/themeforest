<?php

vc_map( array(
        'name' =>'Infobox',
        'base' => 'infobox',
        "icon" => "icon-wpb-infobox",
		"description" => "Infobox",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params' => array(
						
        	array(
                "type" => "iconfonts",
                "heading" => __( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "icon_name",
                'value'=>'',
                "description" => __( "Select Icon", 'WEBNUS_TEXT_DOMAIN')
            ),

        	array(
				"type" => "textfield",
				"heading" => __( "Title", 'WEBNUS_TEXT_DOMAIN' ),
				"param_name" => "title",
				"value" => '',
				"description" => __( "Enter the title", 'WEBNUS_TEXT_DOMAIN')
			),

            array(
				'type' => 'textarea_html',
				'heading' => __( 'Content', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'content',
				'value' => '',
				'description' => __( 'content', 'WEBNUS_TEXT_DOMAIN')
			),

        )
        
    ) );

?>