<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_blog
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
 
global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_blog.php';

vc_remove_param( 'us_blog', 'filter_style' );
vc_update_shortcode_param( 'us_blog', array(
	'param_name' => 'layout',
	'value' => array(
		__( 'Classic', 'us' ) => 'classic',
		__( 'Cards', 'us' ) => 'flat',
		__( 'Tiles', 'us' ) => 'tiles',
		__( 'Small Circle Image', 'us' ) => 'smallcircle',
		__( 'Small Square Image', 'us' ) => 'smallsquare',
		__( 'Latest Posts', 'us' ) => 'latest',
		__( 'Compact', 'us' ) => 'compact',
	),
) );
