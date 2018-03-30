<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Client Carousel Container
$args = array(
	'name' => __( 'Clients carousel', 'wolf' ),
	'base' => 'wolf_clients_carousel',
	'as_parent' => array('only' => 'wolf_clients_carousel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'content_element' => true,
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-columns',
	'show_settings_on_create' => true,
	'params' => array(
		// array(
		// 	'type' => 'textfield',
		// 	'class' => '',
		// 	'heading' => __( 'Title', 'wolf' ),
		// 	'param_name' => 'title',
		// 	'value' => '',
		// ),

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

// Client Item
vc_map(
	array(
		'name' => __( 'Client', 'wolf' ),
		'base' => 'wolf_clients_carousel_item',
		'icon' => 'wolf-vc-icon wolf-vc-posts-columns',
		'category' => 'by WolfThemes',
		'allowed_container_element' => 'vc_row',
		'as_child' => array('only' => 'wolf_clients_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		'params' => array(
			array(
				'type' => 'single_image',
				//'holder' => 'div',
				'class' => '',
				'heading' => __( 'Image', 'wolf' ),
				'param_name' => 'image',
				'value' => '',
				'description' => ''
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Link', 'wolf' ),
				'param_name' => 'link',
				'value' => '',
				'description' => ''
			),
		),
	)
);

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Wolf_Clients_Carousel extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Wolf_Clients_Carousel_Item extends WPBakeryShortCode {}
}