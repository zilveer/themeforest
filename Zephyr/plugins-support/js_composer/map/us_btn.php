<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_btn
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_btn.php';

vc_update_shortcode_param( 'us_btn', array(
	'param_name' => 'style',
	'value' => array(
		__( 'Raised', 'us' ) => 'raised',
		__( 'Flat', 'us' ) => 'flat',
	),
) );
vc_update_shortcode_param( 'us_btn', array(
	'param_name' => 'color',
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
	'param_name' => 'bg_color',
	'heading' => __( 'Background Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['bg_color'],
	'class' => '',
	'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
	'weight' => 80,
) );
vc_add_param( 'us_btn',	array(
	'param_name' => 'text_color',
	'heading' => __( 'Text Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['text_color'],
	'class' => '',
	'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
	'weight' => 70,
) );
