<?php

vc_map( array(
        'name' =>'Max Counter',
        'base' => 'maxcounter',
        "icon" => "icon-wpb-maxcounter",
		"description" => "MaxCounter",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Type', 'webnus_framework' ),
							'param_name' => 'type',
							'value' => array(
							'Type 1'=>'1',
							'Type 2'=>'2',
							'Type 3'=>'3',
							'Type 4'=>'4',
							),
							'description' => esc_html__( 'You can choose among these pre-designed types.', 'webnus_framework')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Count', 'webnus_framework' ),
							'param_name' => 'count',
							'value' => '',
							'description' => esc_html__( 'Enter the number that you want to count.', 'webnus_framework')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Prefix', 'webnus_framework' ),
							'param_name' => 'prefix',
							'value' => '',
							'description' => esc_html__( 'Show the unit content before your counter number., Example: $', 'webnus_framework')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Suffix', 'webnus_framework' ),
							'param_name' => 'suffix',
							'value' => '',
							'description' => esc_html__( 'Show the unit content after your counter number., Example: %', 'webnus_framework')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'webnus_framework' ),
							'param_name' => 'title',
							'value' => '',
							'description' => esc_html__( 'Enter the title', 'webnus_framework')
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Color', 'webnus_framework' ),
							'param_name' => 'color',
							'value' => '',
							'description' => esc_html__( 'Please select icon color', 'webnus_framework'),
							"dependency" => array('element'=>'type','value'=>array('2','3','4')),
						),
						array(
							'type' => 'iconfonts',
							'heading' => esc_html__( 'Icon', 'webnus_framework' ),
							'param_name' => 'icon',
							'value' => '',
							'description' => esc_html__( 'Please select counter icon', 'webnus_framework'),
							"dependency" => array('element'=>'type','value'=>array('2','3','4')),
						),
						
        ),
		
        
    ) );


?>