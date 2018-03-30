<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

// Pricing Tables
vc_map(
	array(
		'name' => __( 'Pricing tables', 'wolf' ),
		'base' => 'wolf_pricing_tables',
		'as_parent' => array('only' => 'wolf_pricing_table'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'category' => 'by WolfThemes',
		'icon' => 'wolf-vc-icon wolf-vc-pricing-tables',
		'show_settings_on_create' => true,
		'params' => array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Columns', 'wolf' ),
				'param_name' => 'columns',
				'value' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
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
		'js_view' => 'VcColumnView'
	)
);

// Pricing table shortcode
vc_map(
	array(
		'name' => __( 'Pricing table', 'wolf' ),
		'base' => 'wolf_pricing_table',
		'icon' => 'wolf-vc-icon wolf-vc-pricing-table',
		'category' => 'by WolfThemes',
		'allowed_container_element' => 'vc_row',
		'as_child' => array('only' => 'wolf_pricing_tables'), // Use only|except attributes to limit parent (separate multiple values with comma)
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Title', 'wolf' ),
				'param_name' => 'title',
				'value' => __( 'Basic Plan', 'wolf' ),
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
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Tagline', 'wolf' ),
				'param_name' => 'tagline',
				'value' => '',
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Price', 'wolf' ),
				'param_name' => 'price',
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Currency', 'wolf' ),
				'param_name' => 'currency',
				'description' => ''
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Display currency', 'wolf' ),
				'param_name' => 'display_currency',
				'value' => array(
					__( 'before', 'wolf' ) => 'before',
					__( 'after', 'wolf' ) => 'after'
				),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Offer', 'wolf' ),
				'param_name' => 'offer',
				'value' => array(
					__( 'no', 'wolf' ) => 'no',
					__( 'yes', 'wolf' ) => 'yes',
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Offer price', 'wolf' ),
				'param_name' => 'offer_price',
				'description' => '',
				'dependency' => array('element' => 'offer', 'value' => 'yes')
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Price period (e.g "monthly" or "per month")', 'wolf' ),
				'param_name' => 'price_period',
				'description' => ''
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Show button', 'wolf' ),
				'param_name' => 'show_button',
				'value' => array(
					__( 'yes', 'wolf' ) => 'yes',
					__( 'no', 'wolf' ) => 'no'
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Button text', 'wolf' ),
				'param_name' => 'button_text',
				'description' => __( 'Default label is "Buy Now"', 'wolf' ),
				'dependency' => array('element' => 'show_button', 'value' => 'yes')
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Button link', 'wolf' ),
				'param_name' => 'link',
				'dependency' => array('element' => 'show_button', 'value' => 'yes')
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Button target', 'wolf' ),
				'param_name' => 'target',
				'value' => array(
					'' => '',
					'Self' => '_self',
					'Blank' => '_blank',
					'Parent' => '_parent'
				),
				'dependency' => array('element' => 'show_button', 'value' => 'yes')
			),
			// array(
			// 	'type' => 'dropdown',
			// 	'holder' => 'div',
			// 	'class' => '',
			// 	'heading' => __( 'Button text', 'wolf' ),
			// 	'param_name' => 'button_size',
			// 	'value' => array(
			// 		'' => '',
			// 		'Small' => 'small',
			// 		'Medium' => 'medium',
			// 		'Large' => 'large',
			// 	),
			// 	'dependency' => array('element' => 'show_button', 'value' => 'yes')
			// ),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Featured', 'wolf' ),
				'param_name' => 'active',
				'value' => array(
					__( 'no', 'wolf' ) => 'no',
					__( 'yes', 'wolf' ) => 'yes',
				),
				'description' => '',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Featured text', 'wolf' ),
				'param_name' => 'active_text',
				'dependency' => array('element' => 'active', 'value' => 'yes'),
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Content', 'wolf' ),
				'param_name' => 'content',
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
		),
	)
);

//Your 'container' content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Wolf_Pricing_Tables extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Wolf_Pricing_Table extends WPBakeryShortCode {}
}
