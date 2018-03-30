<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// message box
vc_map(
	array(
		'name' => __( 'Message box', 'wolf' ),
		'base' => 'wolf_alert_message',
		'category' => 'by WolfThemes',
		'icon' => 'wolf-vc-icon wolf-vc-message-box',
		'allowed_container_element' => 'vc_row',
		'params' => array(

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Type', 'wolf' ),
				'param_name' => 'type',
				'value' => array(
					__( 'Info', 'wolf' ) => 'info',
					__( 'Alert', 'wolf' ) => 'alert',
					__( 'Success', 'wolf' ) => 'success',
					__( 'Error', 'wolf' ) => 'error',
				),
				'description' => '',
			),

			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Message', 'wolf' ),
				'param_name' => 'message',
				'description' => '',
				'value' => '',
			),

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Display icon', 'wolf' ),
				'param_name' => 'display_icon',
				'value' => array(
					__( 'Yes', 'wolf' ) => 'yes',
					__( 'No', 'wolf' ) => 'no',
				),
				'description' => '',
			),

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Allow the visitor to dismiss the message', 'wolf' ),
				'param_name' => 'close',
				'value' => array(
					__( 'No', 'wolf' ) => '',
					__( 'Yes', 'wolf' ) => 'yes',
				),
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