<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $custom_colors;

$custom_colors = array(

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Custom', 'wolf' ),
		'param_name' => 'custom_style',
		'value' => array(
			__( 'No', 'wolf' ) => 'no',
			__( 'Yes', 'wolf' ) => 'yes',
		),
		'description' => '',
	),

	array(
		'type' => 'colorpicker',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Background Color', 'wolf' ),
		'param_name' => 'bg_color',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Icon Color', 'wolf' ),
		'param_name' => 'icon_color',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Border Color', 'wolf' ),
		'param_name' => 'border_color',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Background Color on Hover', 'wolf' ),
		'param_name' => 'bg_color_hover',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Icon Color on Hover', 'wolf' ),
		'param_name' => 'icon_color_hover',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Border Color on Hover', 'wolf' ),
		'param_name' => 'border_color_hover',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	)
);