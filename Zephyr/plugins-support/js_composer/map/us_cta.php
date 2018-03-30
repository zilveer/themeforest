<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_cta
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_cta.php';

vc_update_shortcode_param( 'us_cta', array(
	'param_name' => 'btn_style',
	'value' => array(
		__( 'Raised', 'us' ) => 'raised',
		__( 'Flat', 'us' ) => 'flat',
	),
) );
vc_update_shortcode_param( 'us_cta', array(
	'param_name' => 'btn_color',
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
vc_add_param( 'us_cta', array(
	'param_name' => 'btn_bg_color',
	'heading' => __( 'Button Background Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['btn_bg_color'],
	'class' => '',
	'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
	'weight' => 160,
) );
vc_add_param( 'us_cta', array(
	'param_name' => 'btn_text_color',
	'heading' => __( 'Button Text Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['btn_text_color'],
	'class' => '',
	'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
	'weight' => 150,
) );
vc_update_shortcode_param( 'us_cta', array(
	'param_name' => 'btn2_style',
	'value' => array(
		__( 'Raised', 'us' ) => 'raised',
		__( 'Flat', 'us' ) => 'flat',
	),
) );
vc_update_shortcode_param( 'us_cta', array(
	'param_name' => 'btn2_color',
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
vc_add_param( 'us_cta', array(
	'param_name' => 'btn2_bg_color',
	'heading' => __( 'Button Background Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['btn_bg_color'],
	'class' => '',
	'dependency' => array( 'element' => 'btn2_color', 'value' => 'custom' ),
	'weight' => 60,
) );
vc_add_param( 'us_cta', array(
	'param_name' => 'btn2_text_color',
	'heading' => __( 'Button Text Color', 'us' ),
	'type' => 'colorpicker',
	'std' => $config['atts']['btn_text_color'],
	'class' => '',
	'dependency' => array( 'element' => 'btn2_color', 'value' => 'custom' ),
	'weight' => 50,
) );
