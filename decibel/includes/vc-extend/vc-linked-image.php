<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

$args = array(

	'name' => __( 'Linked image', 'wolf' ),
	'base' => 'wolf_linked_image',
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
			'heading' => __( 'Text alignment', 'wolf' ),
			'param_name' => 'text_alignment',
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
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Text', 'wolf' ),
			'param_name' => 'text',
			'value' => '',
			'description' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Tagline', 'wolf' ),
			'param_name' => 'secondary_text',
			'value' => '',
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Tag', 'wolf' ),
			'param_name' => 'text_tag',
			'value' => array(
				'span' => 'span',
				'h5' => 'h5',
				'h4' => 'h4',
				'h3' => 'h3',
				'h2' => 'h2',
				'h1' => 'h1',
			),
			// 'description' => '',
		),

		array(
			'type' => 'colorpicker',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Text color', 'wolf' ),
			'param_name' => 'text_color',
			'value' => '',
			'description' => '',
		),

		array(
			'type' => 'colorpicker',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Overlay color', 'wolf' ),
			'param_name' => 'overlay_color',
			'value' => '',
			'description' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Overlay opacity in percent', 'wolf' ),
			'param_name' => 'overlay_opacity',
			'value' => '',
			'description' => '',
		),

		array(
			'type' => 'vc_link',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Link', 'wolf' ),
			'param_name' => 'link',
			'value' => '',
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
