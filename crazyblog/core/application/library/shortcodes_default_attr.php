<?php

$shortcode_section = array();
//start title settings

$shortcode_section[] = array(
	"type" => "dropdown",
	"class" => "",
	'group' => esc_html__( 'Section Settings', 'crazyblog' ),
	"heading" => esc_html__( "Show Title", 'crazyblog' ),
	"param_name" => "show_title",
	"value" => array( esc_html__( 'False', 'crazyblog' ) => 'false', esc_html__( 'True', 'crazyblog' ) => 'true' ),
	"description" => esc_html__( "Make this section with title then true.", 'crazyblog' ),
);



$shortcode_section[] = array(
	"type" => "dropdown",
	"class" => "",
	'group' => esc_html__( 'Section Settings', 'crazyblog' ),
	"heading" => esc_html__( "Heading Styles", 'crazyblog' ),
	"param_name" => "col_heading",
	"description" => esc_html__( "Select Heading Style.", 'crazyblog' ),
	"value" => array(
		esc_html__( 'Simple Title', 'crazyblog' ) => '1',
		esc_html__( 'Side Title', 'crazyblog' ) => '2',
		esc_html__( 'Fancy Title', 'crazyblog' ) => '3',
		esc_html__( 'Center Title', 'crazyblog' ) => '4'
	),
	'dependency' => array(
		'element' => 'show_title',
		'value' => array( 'true' )
	),
);



$shortcode_section[] = array(
	"type" => "textfield",
	"class" => "",
	'group' => esc_html__( 'Section Settings', 'crazyblog' ),
	"heading" => esc_html__( "Enter the Title", 'crazyblog' ),
	"param_name" => "col_title",
	"description" => esc_html__( "Enter the title of this section.", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_title',
		'value' => array( 'true' )
	),
);



$shortcode_section[] = array(
	"type" => "textfield",
	"class" => "",
	'group' => esc_html__( 'Section Settings', 'crazyblog' ),
	"heading" => esc_html__( "Enter the Sub Title", 'crazyblog' ),
	"param_name" => "col_sub_title",
	"description" => esc_html__( "Enter the sub title of this section.", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_title',
		'value' => array( 'true' )
	),
);



