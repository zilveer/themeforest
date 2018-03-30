<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

$args = array(

	'name' => __( 'Single image', 'wolf' ),
	'base' => 'wolf_single_image',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-single-image',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'single_image',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Image', 'wolf' ),
			'param_name' => 'image',
			'value' => '',
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Image alignment', 'wolf' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'center', 'wolf' ) => 'center',
				__( 'left', 'wolf' ) => 'left',
				__( 'right', 'wolf' ) => 'right',
			),
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Image style', 'wolf' ),
			'param_name' => 'image_style',
			'value' => array(
				__( 'default', 'wolf' ) => 'default',
				__( 'rounded', 'wolf' ) => 'round',
				__( 'shadow', 'wolf' ) => 'shadow',
			),
		),

		array(
			'type' => 'checkbox',
			'class' => '',
			'show_settings_on_create' => true,
			'heading' => '',
			'param_name' => 'full_size',
			'value' => array( __( 'Link to full size image', 'wolf' ) => true ),
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Image link', 'wolf' ),
			'param_name' => 'link',
			'value' => 'http://',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Link target', 'wolf' ),
			'param_name' => 'target',
			'value' => array(
				'_self' => '_self',
				'_blank' => '_blank',
			),
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Hover effect', 'wolf' ),
			'param_name' => 'hover_effect',
			'value' => array(
				__( 'None', 'wolf' ) => 'none',
				__( 'Default', 'wolf' ) => 'default',
				__( 'Black and white to colored', 'wolf' ) => 'greyscale',
				__( 'Colored to Black and white', 'wolf' ) => 'to-greyscale',
				__( 'Scale + Black and white to colored', 'wolf' ) => 'scale-greyscale',
				__( 'Scale + Colored to Black and white', 'wolf' ) => 'scale-to-greyscale',
			),
			'description' => __( 'Note that not all browser support the black and white effect', 'wolf' ),
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Image size', 'wolf' ),
			'param_name' => 'image_size',
			'value' => array(
				__( 'Large', 'wolf' ) => 'large',
				__( 'Medium', 'wolf' ) => 'medium',
				__( 'Thumbnail', 'wolf' ) => 'thumbnail',
				__( 'Square', 'wolf' ) => '2x2',
				__( 'Portrait', 'wolf' ) => 'portrait',
				__( 'Extra Large', 'wolf' ) => 'extra-large',
			),
			'description' => __( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings ', 'wolf' ),
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
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

vc_map( $args );
