<?php

vc_map( array(
	'name' =>'Pricing Tables',
	'base' => 'pricing-tables',
	'description' => 'Pricing Tables',
	'icon' => 'webnus_pricingtable',
	'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),       
	'params'=>array(

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'webnus_framework' ),
			'param_name' => 'title',
			'value' => '',
			'description' => esc_html__( 'Pricing Table Title', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Price', 'webnus_framework' ),
			'param_name' => 'price',
			'value' => '$10',
			'description' => esc_html__( 'Pricing Table Price', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Period', 'webnus_framework' ),
			'param_name' => 'period',
			'value' => 'Month',
			'description' => esc_html__( 'Pricing Table Period', 'webnus_framework'),
		),

		array(
			"type"=>'textfield',
			"heading"=>esc_html__('Link Text', 'webnus_framework'),
			"param_name"=> "link_text",
			"value"=>"",
			"description" => esc_html__( "Link Text", 'webnus_framework'),	
		),

		array(
			"type"=>'textfield',
			"heading"=>esc_html__('Link URL', 'webnus_framework'),
			"param_name"=> "link_url",
			"value"=>"",
			"description" => esc_html__( "Link URL (http://example.com)", 'webnus_framework'),	
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Featured Plan', 'webnus_framework' ),
			'param_name' => 'featured',
			'value' => array( esc_html__( 'Yes', 'js_composer' ) => ' w-featured' ),
			'description' => esc_html__( 'Pricing Tables Featured Plan', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 1', 'webnus_framework' ),
			'param_name' => 'row1',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 1', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 2', 'webnus_framework' ),
			'param_name' => 'row2',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 2', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 3', 'webnus_framework' ),
			'param_name' => 'row3',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 3', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 4', 'webnus_framework' ),
			'param_name' => 'row4',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 4', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 5', 'webnus_framework' ),
			'param_name' => 'row5',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 5', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 6', 'webnus_framework' ),
			'param_name' => 'row6',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 6', 'webnus_framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Row 7', 'webnus_framework' ),
			'param_name' => 'row7',
			'value' => '',
			'description' => esc_html__( 'Pricing Tables Row 7', 'webnus_framework'),
		),

)));
?>