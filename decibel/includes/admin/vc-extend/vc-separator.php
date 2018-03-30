<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Separator
vc_add_param( 'vc_separator', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Width', 'wolf' ),
	'param_name' => 'width',
	'description' => '',
	'value' => '100%',
) );

vc_add_param( 'vc_separator', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Aligment', 'wolf' ),
	'param_name' => 'alignment',
	'value' => array(
		__( 'Center', 'wolf' ) => 'center',
		__( 'Left', 'wolf' ) => 'left',
		__( 'Right', 'wolf' ) => 'right',
	)
) );

vc_add_param( 'vc_separator', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Margin top', 'wolf' ),
	'param_name' => 'margin_top',
	'description' => '',
	'value' => '',
) );

vc_add_param( 'vc_separator', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Margin bottom', 'wolf' ),
	'param_name' => 'margin_bottom',
	'description' => '',
	'value' => '',
) );

vc_add_param( 'vc_separator', array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => __( 'Color', 'wolf' ),
	'param_name' => 'color',
	'description' => '',
	'value' => '',
) );