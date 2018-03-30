<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

// mailchimp
vc_map(
	array(
		'name' => __( 'Mailchimp sign up', 'wolf' ),
		'base' => 'wolf_mailchimp',
		'category' => 'by WolfThemes',
		'icon' => 'wolf-vc-icon wolf-vc-mailchimp',
		'allowed_container_element' => 'vc_row',
		'params' => array(

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'List ID', 'wolf' ),
				'param_name' => 'list',
				'description' => __( 'Can be found in your mailchimp account -> Lists -> Your List Name -> Settings -> List Name & default', 'wolf' ),
				'value' => '',
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Size', 'wolf' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Normal', 'wolf' ) => 'normal',
					__( 'Large', 'wolf' ) => 'large',
				),
				'description' => '',
			),

			// array(
			// 	'type' => 'textfield',
			// 	'holder' => 'div',
			// 	'class' => '',
			// 	'heading' => __( 'Title', 'wolf' ),
			// 	'param_name' => 'label',
			// 	'value' => '',
			// ),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Submit text (default is "Subscribe")', 'wolf' ),
				'param_name' => 'submit',
				'value' => '',
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Button style', 'wolf' ),
				'param_name' => 'button_style',
				'value' => array(
					__( 'theme color', 'wolf' )  => 'accent-color',
					__( 'theme color black/white on hover', 'wolf' )  => 'accent-color-bnw',
					__( 'black/white', 'wolf' )  => 'border-button',
					__( 'black/white theme color on hover', 'wolf' )  => 'border-button-accent-hover',
				),
				'description' => '',
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Alignment', 'wolf' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'center', 'wolf' )  => 'center',
					__( 'left', 'wolf' )  => 'left',
					__( 'right', 'wolf' )  => 'right',
				),
				'description' => '',
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Animation', 'wolf' ),
				'description' => '',
				'param_name' => 'animation',
				'value' => $animations,
				'description' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Animation delay (in ms)', 'wolf' ),
				'param_name' => 'animation_delay',
				'value' => '',
				'description' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Inline style', 'wolf' ),
				'param_name' => 'inline_style',
				'description' => __( 'Additional inline CSS style', 'wolf' ),
				'value' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Extra class', 'wolf' ),
				'param_name' => 'class',
				'description' => __( 'Optional additional CSS class to add to the element', 'wolf' ),
				'value' => '',
			),
		),
	)
);