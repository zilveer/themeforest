<?php

vc_map( array(
        'name' =>'Webnus MaxCounter',
        'base' => 'maxcounter',
        "icon" => "icon-wpb-maxcounter",
		"description" => "MaxCounter",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'Type', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'type',
							'value' => array(
							'Type 1'=>'1',
							'Type 2'=>'2',
							),
							'description' => __( 'Select MaxCounter Type', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Count', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'count',
							'value' => '',
							'description' => __( 'Enter counter count', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Prefix', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'prefix',
							'value' => '',
							'description' => __( 'Enter the prefix, $ for example', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Suffix', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'suffix',
							'value' => '',
							'description' => __( 'Enter the suffix, % for example', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'title',
							'value' => '',
							'description' => __( 'Enter the title', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Color', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'color',
							'value' => '',
							'description' => __( 'Please select icon color', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'iconfonts',
							'heading' => __( 'Icon', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'icon',
							'value' => '',
							'description' => __( 'Please select counter icon', 'WEBNUS_TEXT_DOMAIN')
						),
						
        ),
		
        
    ) );


?>