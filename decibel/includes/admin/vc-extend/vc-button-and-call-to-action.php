<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $icons_inverted_array, $animations;

$button_color_array = array(
	__( 'theme color', 'wolf' )  => 'accent-color',
	__( 'theme color black/white on hover', 'wolf' )  => 'accent-color-bnw',
	__( 'black/white', 'wolf' )  => 'border-button',
	__( 'black/white theme color on hover', 'wolf' )  => 'border-button-accent-hover',
);

$button_type_array =  array(
	__( 'Square', 'wolf' ) => 'square',
	__( 'Round', 'wolf' ) => 'round',
);

$button_params = array(
	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Button text', 'wolf' ),
		'param_name' => 'text',
		'description' => '',
		'value' => __( 'My Button', 'wolf' ),
	),

	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Button tagline', 'wolf' ),
		'param_name' => 'tagline',
		'description' => __( 'optional', 'wolf' ),
		'value' => '',
	),

	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => 'URL',
		'param_name' => 'url',
		'description' => 'http://website.com',
		//'value' => 'http://',
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Custom', 'wolf' ),
		'param_name' => 'custom_style',
		'value' => array(
			__( 'No', 'wolf' ) => 'no',
			__( 'Yes', 'wolf' ) => 'yes',
		),
		'description' => '',
	),

	array(
		'type' => 'dropdown',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Color', 'wolf' ),
		'param_name' => 'color',
		'value' => $button_color_array,
		'description' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'no' ) ),
	),

	// Custom

	array(
		'type' => 'colorpicker',
		'holder' => 'div',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Button background color', 'wolf' ),
		'param_name' => 'button_bg_color',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'holder' => 'div',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Button font color', 'wolf' ),
		'param_name' => 'button_font_color',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'holder' => 'div',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Button border color', 'wolf' ),
		'param_name' => 'button_border_color',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'holder' => 'div',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Button background color on hover', 'wolf' ),
		'param_name' => 'button_bg_color_hover',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'holder' => 'div',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Button font color on hover', 'wolf' ),
		'param_name' => 'button_font_color_hover',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'colorpicker',
		'holder' => 'div',
		'class' => '',
		'show_settings_on_create' => true,
		'heading' => __( 'Button border color on hover', 'wolf' ),
		'param_name' => 'button_border_color_hover',
		'value' => '',
		'dependency' => array( 'element' => 'custom_style', 'value' => array( 'yes' ) ),
	),

	// end custom

	array(
		'type' => 'dropdown',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Type', 'wolf' ),
		'param_name' => 'type',
		'value' => $button_type_array,
		'description' => '',
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Add icon', 'wolf' ),
		'param_name' => 'add_button_icon',
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
		'dependency' => array( 'element' => 'add_button_icon', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'dropdown',
		'class' => '',
		'heading' => __( 'Icon position', 'wolf' ),
		'param_name' => 'icon_position',
		'value' => array(
			__( 'After', 'wolf' ) => 'after',
			__( 'Before', 'wolf' ) => 'before'
		),
		'description' => '',
		'dependency' => array( 'element' => 'add_button_icon', 'value' => array( 'yes' ) ),
	),

	array(
		'type' => 'dropdown',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Target', 'wolf' ),
		'param_name' => 'target',
		'value' => array(
			'Self' => '_self',
			'Blank' => '_blank',
			'Parent' => '_parent',
		),
		'description' => '',
	),
);

// Button Shortcode
$button_args = array(
	'name' => __( 'Button', 'wolf' ),
	'base' => 'wolf_button',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-button',
	'allowed_container_element' => 'vc_column',
	'params' => array(

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Size', 'wolf' ),
			'param_name' => 'size',
			'value' => array(
				__( 'Medium', 'wolf' ) => 'medium',
				__( 'Small', 'wolf' ) => 'small',
				__( 'Large', 'wolf' ) => 'large',
				__( 'Very Large', 'wolf' ) => 'very-large',
			),
			// 'description' => '',
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
vc_map( wolf_inject_vc_params( $button_params, $button_args ) );

vc_map( array(
	'name' =>  __( 'Buttons Container', 'wolf' ),
	'base' => 'wolf_buttons_container',
	'as_parent' => array('only' => 'wolf_button'),
	'content_element' => true,
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-button',
	'show_settings_on_create' => true,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Alignment', 'wolf' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'Left', 'wolf' ) => 'left',
				__( 'Center', 'wolf' ) => 'center',
				__( 'Right', 'wolf' ) => 'right',
			),
			'description' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Margin top', 'wolf' ),
			'param_name' => 'margin_top',
			'description' => '',
			'value' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Margin bottom', 'wolf' ),
			'param_name' => 'margin_bottom',
			'description' => '',
			'value' => '',
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
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Wolf_Buttons_Container extends WPBakeryShortCodesContainer {}
}

// Call To Action
$call_to_action_args = array(
	'name' => __( 'Call to action', 'wolf' ),
	'base' => 'wolf_call_to_action',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-action',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Text', 'wolf' ),
			'param_name' => 'main_text',
			'description' => '',
			'value' => __( 'This is your call to action text', 'wolf' ),
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Tagline', 'wolf' ),
			'param_name' => 'main_tagline',
			'description' => '',
			'value' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Size', 'wolf' ),
			'param_name' => 'size',
			'value' => array(
				__( 'Medium', 'wolf' ) => 'medium',
				__( 'Small', 'wolf' ) => 'small',
				__( 'Large', 'wolf' ) => 'large',
			),
			// 'description' => '',
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
vc_map( wolf_inject_vc_params( $button_params, $call_to_action_args ) );