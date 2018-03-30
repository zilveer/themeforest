<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $slider_settings;

$slider_settings = array(

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Autoplay', 'wolf' ),
		'param_name' => 'autoplay',
		'value' => array(
			__( 'Yes', 'wolf' ) => 'true',
			__( 'No', 'wolf' ) => 'false',
		),
		'description' => '',
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Pause on hover (if autoplay)', 'wolf' ),
		'param_name' => 'pause_on_hover',
		'value' => array(
			__( 'Yes', 'wolf' ) => 'true',
			__( 'No', 'wolf' ) => 'false',
		),
		'description' => '',
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Transition', 'wolf' ),
		'param_name' => 'transition',
		'value' => array(
			__( 'Auto (fade by default and slide on touchable devices)', 'wolf' ) => 'auto',
			__( 'Slide', 'wolf' ) => 'slide',
			__( 'Fade', 'wolf' ) => 'fade',
		),
		'description' => '',
	),

	array(
		'type' => 'textfield',
		'class' => '',
		'heading' => __( 'Slideshow Speed in ms', 'wolf' ),
		'param_name' => 'slideshow_speed',
		'value' => 6000,
		'description' => '',
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Show navigation bullets', 'wolf' ),
		'param_name' => 'nav_bullets',
		'value' => array(
			__( 'Yes', 'wolf' ) => 'true',
			__( 'No', 'wolf' ) => 'false',
		),
		'description' => '',
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Show arrows', 'wolf' ),
		'param_name' => 'nav_arrows',
		'value' => array(
			__( 'Yes', 'wolf' ) => 'true',
			__( 'No', 'wolf' ) => 'false',
		),
		'description' => '',
	),
);