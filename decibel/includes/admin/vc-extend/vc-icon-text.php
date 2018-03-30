<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $icons_inverted_array, $animations;

// Icon with Text
$args = array(
	'name' => 'Icon with text',
	'base' => 'wolf_icon_with_text',
	'icon' => 'wolf-vc-icon wolf-vc-icon-text',
	'category' => 'by WolfThemes',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'searchable',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Icon', 'wolf' ),
			'param_name' => 'icon',
			'value' => $icons_inverted_array,
			'description' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Title', 'wolf' ),
			'param_name' => 'title',
			'value' => ''
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Title tag', 'wolf' ),
			'param_name' => 'title_tag',
			'value' => array(
				'h3' => 'h3',
				'h1' => 'h1',
				'h2' => 'h2',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
		),

		array(
			'type' => 'textarea',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Text', 'wolf' ),
			'param_name' => 'text',
			'value' => ''
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Type', 'wolf' ),
			'param_name' => 'icon_type',
			'value' => array(
				__( 'Normal', 'wolf' ) => 'normal',
				__( 'Circle', 'wolf' ) => 'circle',
				__( 'Square', 'wolf' ) => 'square',
				__( 'Ban', 'wolf' ) => 'ban',
			),
			'description' => ''
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Position', 'wolf' ),
			'param_name' => 'icon_position',
			'value' => array(
				__( 'Top', 'wolf' ) => 'top',
				__( 'Left', 'wolf' ) => 'left',
				__( 'Left from Title', 'wolf' ) => 'left_from_title',
				__( 'Right', 'wolf' ) => 'right',
				__( 'Right from Title', 'wolf' ) => 'right_from_title'
			),
			'description' => '',
			'dependency' => array( 'element' => 'box_type', 'value' => array( 'normal' ) ),
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Size', 'wolf' ),
			'param_name' => 'icon_size',
			'value' => array(
			//	__( 'Tiny', 'wolf' ) => 'fa-lg',
				__( 'Small', 'wolf' ) => 'fa-2x',
				__( 'Medium', 'wolf' ) => 'fa-3x',
				__( 'Large', 'wolf' ) => 'fa-4x',
				__( 'Very Large', 'wolf' ) => 'fa-5x'
			),
			'description' => ''
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
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
			'heading' => __( 'Icon animation', 'wolf' ),
			'param_name' => 'icon_animation',
			'value' => array(
				__( 'No', 'wolf' ) => '',
				__( 'Yes', 'wolf' ) => 'yes'
			),
			'description' => ''
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Icon animation delay (ms)', 'wolf' ),
			'param_name' => 'icon_animation_delay',
			'value' => '',
			'description' => '',
			'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
		),


		// array(
		// 	'type' => 'colorpicker',
		// 	'holder' => 'div',
		// 	'class' => '',
		// 	'heading' => __( 'Text Color', 'wolf' ),
		// 	'param_name' => 'text_color',
		// 	'description' => ''
		// ),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Link', 'wolf' ),
			'param_name' => 'icon_link',
			'value' => '',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Target', 'wolf' ),
			'param_name' => 'icon_link_target',
			'value' => array(
				''   => '',
				'Self' => '_self',
				'Blank' => '_blank',
				'Parent' => '_parent',
			),
			'description' => '',
		),

		array(
			'type' => 'checkbox',
			'class' => '',
			'show_settings_on_create' => true,
			'heading' => '',
			'param_name' => 'icon_link_title',
			'value' => array( __( 'Link title as well', 'wolf' ) => true ),
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Container animation', 'wolf' ),
			'description' => '',
			'param_name' => 'animation',
			'value' => $animations,
			'description' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Container animation delay (in ms)', 'wolf' ),
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