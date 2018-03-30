<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_person
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_person.php';

vc_update_shortcode_param( 'us_person', array(
	'param_name' => 'layout',
	'value' => array(
		__( 'Card Style', 'us' ) => 'card',
		__( 'Flat Style', 'us' ) => 'flat',
	),
) );
