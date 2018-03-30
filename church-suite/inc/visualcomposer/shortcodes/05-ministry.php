<?php
vc_map( array(
        'name' =>'Webnus Ministry',
        'base' => 'ministry',
		'description' => 'Introduce Ministries',
		'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ), 
        'icon' => 'ministry',
        'params'=>array(

        	array(
					"type" => "dropdown",
					"heading" => esc_html__( "Type", 'webnus_framework' ),
					"param_name" => "type",
					"value" => array(
						"Type 1"=>"1",
						"Type 2"=>"2",						
				),
				"description" => esc_html__( "Select style type", 'webnus_framework')
			),		
		
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Ministry Name', 'webnus_framework' ),
					'param_name' => 'ministry_name',
					'value'=>'',
					'description' => esc_html__( 'Ministry name', 'webnus_framework')
			),		
			array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Ministry Image', 'webnus_framework' ),
					'param_name' => 'ministry_img',
					'value'=>'',
					'description' => esc_html__( 'Ministry image', 'webnus_framework')
			),
			array(
					"type"=>'colorpicker',
					"heading"=>esc_html__('Main color (leave bank for default color)', 'webnus_framework'),
					"param_name"=> "color",
					"value"=>"",
					"dependency" => array('element'=>'type','value'=>array('1')),
					"description" => esc_html__( "Select title color", 'webnus_framework')
			),
			array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Ministry Description Text', 'webnus_framework' ),
					'param_name' => 'text',
					'value'=>'',
					'description' => esc_html__( 'Ministry description text', 'webnus_framework')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Ministry Director Name', 'webnus_framework' ),
					'param_name' => 'director_name',
					'value'=>'',
					"dependency" => array('element'=>'type','value'=>array('1')),
					'description' => esc_html__( 'Ministry director name', 'webnus_framework')
			),
			array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Ministry Director Image', 'webnus_framework' ),
					'param_name' => 'director_img',
					'value'=>'',
					"dependency" => array('element'=>'type','value'=>array('1')),
					'description' => esc_html__( 'Ministry director image', 'webnus_framework')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Ministry Link URL', 'webnus_framework' ),
					'param_name' => 'link',
					'value'=>'',
					'description' => esc_html__( 'Ministry link url', 'webnus_framework')
			),
		),
    ) );
?>