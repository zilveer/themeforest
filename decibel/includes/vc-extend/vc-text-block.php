<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

// Text Block
vc_add_param( 'vc_column_text', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Animation', 'wolf' ),
	'param_name' => 'animation',
	'value' => $animations
) );

vc_add_param( 'vc_column_text', array(
	'type' => 'textfield',
	'holder' => 'div',
	'class' => '',
	'heading' => __( 'Animation delay (in ms)', 'wolf' ),
	'param_name' => 'animation_delay',
	'value' => '',
	'description' => '',
) );

vc_add_param( 'vc_column_text', array(
	'type' => 'textfield',
	'holder' => 'div',
	'class' => '',
	'heading' => __( 'Inline style', 'wolf' ),
	'param_name' => 'inline_style',
	'value' => '',
	'description' => sprintf( __( 'e.g: %s', 'wolf' ), 'margin-bottom:150px;' ),
) );
