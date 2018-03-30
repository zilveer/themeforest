<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

$args = array(

	'name' => __( 'Services table', 'wolf' ),
	'base' => 'wolf_services_table',
	'icon' => 'wolf-vc-icon wolf-vc-services-table',
	'category' => 'by WolfThemes',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'colorpicker',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Background color', 'wolf' ),
			'param_name' => 'bg_color',
			'description' => '',
		),

		array(
			'type' => 'colorpicker',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Font color', 'wolf' ),
			'param_name' => 'font_color',
			'description' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Title', 'wolf' ),
			'param_name' => 'title',
			'description' => '',
			'value' => '',
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
			'type' => 'colorpicker',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Title color', 'wolf' ),
			'param_name' => 'title_color',
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Add icon', 'wolf' ),
			'param_name' => 'add_icon',
			'value' => array(
				__( 'No', 'wolf' ) => 'no',
				__( 'Yes', 'wolf' ) => 'yes'
			),
			'description' => __( 'Select Yes if you want to add an icon in your button', 'wolf' ),
		),

		array(
			'type' => 'searchable',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Icon', 'wolf' ),
			'param_name' => 'icon',
			'value' => $icons_inverted_array,
			'description' => '',
			'dependency' => array( 'element' => 'add_icon', 'value' => array( 'yes' ) ),
		),

		array(
			'type' => 'colorpicker',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Icon color', 'wolf' ),
			'param_name' => 'icon_color',
			'description' => '',
			'dependency' => array( 'element' => 'add_icon', 'value' => array( 'yes' ) ),
		),


		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Services', 'wolf' ),
			'param_name' => 'services',
			'value' => '<li>content content content</li><li>content content content</li><li>content content content</li>',
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
	)
);

vc_map( $args );
