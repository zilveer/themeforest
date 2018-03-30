<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_cform
 *
 * @var $shortcode string Current shortcode name
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_cform.php';

vc_update_shortcode_param( 'us_cform', array(
	'param_name' => 'button_style',
	'value' => array(
		__( 'Raised', 'us' ) => 'raised',
		__( 'Flat', 'us' ) => 'flat',
	),
) );
vc_update_shortcode_param( 'us_cform', array(
	'param_name' => 'button_color',
	'value' => array(
		__( 'Primary (theme color)', 'us' ) => 'primary',
		__( 'Secondary (theme color)', 'us' ) => 'secondary',
		__( 'Light (theme color)', 'us' ) => 'light',
		__( 'Contrast (theme color)', 'us' ) => 'contrast',
		__( 'Black', 'us' ) => 'black',
		__( 'White', 'us' ) => 'white',
		__( 'Custom colors', 'us' ) => 'custom',
	),
) );
vc_add_param( 'us_btn',	array(
	'param_name' => 'button_bg_color',
	'heading' => __( 'Button Background Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['button_bg_color'],
	'class' => '',
	'dependency' => array( 'element' => 'button_color', 'value' => 'custom' ),
	'group' => __( 'Button', 'us' ),
	'weight' => 45,
) );
vc_add_param( 'us_btn',	array(
	'param_name' => 'button_text_color',
	'heading' => __( 'Button Text Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['button_text_color'],
	'class' => '',
	'dependency' => array( 'element' => 'button_color', 'value' => 'custom' ),
	'group' => __( 'Button', 'us' ),
	'weight' => 40,
) );