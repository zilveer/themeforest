<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations, $slider_settings;

$args = array(
	'name' => __( 'Image slider', 'wolf' ),
	'base' => 'wolf_images_slider',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-images-slider',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'attach_images',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Images', 'wolf' ),
			'param_name' => 'ids',
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Layout', 'wolf' ),
			'param_name' => 'layout',
			'value' => array(
				__( 'None', 'wolf' ) => 'default',
				__( 'Desktop Screen', 'wolf' ) => 'desktop',
				__( 'Laptop Screen', 'wolf' ) => 'laptop',
				__( 'Tablet Screen', 'wolf' ) => 'tablet',
				__( 'Mobile Screen', 'wolf' ) => 'mobile',
			),
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Animation', 'wolf' ),
			'description' => __( 'How the slider will appear on your page', 'wolf' ),
			'param_name' => 'animation',
			'value' => $animations,
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
vc_map( wolf_inject_vc_params( $slider_settings, $args ) );
