<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_iconbox
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 * @param $config ['content'] string Shortcode's default content
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_iconbox.php';

vc_update_shortcode_param( 'us_iconbox', array(
	'param_name' => 'style',
	'value' => array(
		__( 'Simple', 'us' ) => 'default',
		__( 'Inside the Solid circle', 'us' ) => 'circle',
	),
) );
