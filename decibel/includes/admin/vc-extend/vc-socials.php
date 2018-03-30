<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $custom_colors, $animations;

$args = array(

	'name' => __( 'Social icons', 'wolf' ),
	'base' => 'wolf_theme_socials',
	'icon' => 'wolf-vc-icon wolf-vc-social-icons',
	'category' => 'by WolfThemes',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => __( 'Services', 'wolf' ) . '*',
			'param_name' => 'services',
			'description' => __( 'Enter the service names separated by a comma. e.g "twitter, facebook, instagram".<br>Leave empty to display them all.<br>* See the social networks available in the theme options.', 'wolf' ),
			'value' => '',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Type', 'wolf' ),
			'param_name' => 'type',
			'value' => array(
				__( 'Normal', 'wolf' ) => 'normal',
				__( 'Circle', 'wolf' ) => 'circle',
				__( 'Square', 'wolf' ) => 'square'
			),
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Size', 'wolf' ),
			'param_name' => 'size',
			'value' => array(
				__( 'Medium', 'wolf' ) => '2x',
				__( 'Small', 'wolf' ) => '1x',
				__( 'Large', 'wolf' ) => '3x',
				__( 'Very Large', 'wolf' ) => '4x',
			),
			// 'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Target', 'wolf' ),
			'param_name' => 'target',
			'value' => array(
				''   => '',
				'Self' => '_self',
				'Blank' => '_blank',
				'Parent' => '_parent',
			),
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Hover transition', 'wolf' ),
			'param_name' => 'hover_effect',
			'value' => array(
				__( 'Normal', 'wolf' ) => 'none',
				__( 'Fill in', 'wolf' ) => 'fill-in',
			),
			'description' => __( 'Custom hover effects won\'t apply to icon with custom colors settings', 'wolf' ),
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
	)
);

vc_map( wolf_inject_vc_params( $custom_colors, $args ) );
