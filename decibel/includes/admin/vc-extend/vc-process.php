<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $icons_inverted_array;

// Process Container
$args = array(
	'name' => __( 'Process', 'wolf' ),
	'base' => 'wolf_process',
	'as_parent' => array('only' => 'wolf_process_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'content_element' => true,
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-process',
	'show_settings_on_create' => true,
	'params' => array(

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
	'js_view' => 'VcColumnView',

);
vc_map( $args );

// Process Item
vc_map(
	array(
		'name' => __( 'Process item', 'wolf' ),
		'base' => 'wolf_process_item',
		'icon' => 'wolf-vc-icon wolf-vc-process',
		'category' => 'by WolfThemes',
		'allowed_container_element' => 'vc_row',
		'as_child' => array('only' => 'wolf_process'), // Use only|except attributes to limit parent (separate multiple values with comma)
		'params' => array(

			array(
				'type' => 'searchable',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Icon', 'wolf' ),
				'param_name' => 'icon',
				'value' => $icons_inverted_array,
				'description' => '',
				'dependency' => array( 'element' => 'add_button_icon', 'value' => array( 'yes' ) ),
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Title', 'wolf' ),
				'param_name' => 'title',
				'value' => '',
				'description' => ''
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
				'value' => '',
				'description' => ''
			),
		),
	)
);

//Your 'container' content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Wolf_Process extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Wolf_Process_Item extends WPBakeryShortCode {}
}