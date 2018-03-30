<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * bbPress.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\bbPress
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0.2
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enable the creation of an option tab in the main options page.
	 */
	'options' => true,

	/**
	 * Enable the THB custom skin
	 */
	'skin' => false
);

$thb_theme->setConfig( 'bbpress', thb_array_asum( $thb_config, $config ) );

if ( ! function_exists( 'thb_is_bbpress' ) ) {
	/**
	 * Check if the bbPress plugin is active
	 * @return boolean
	 */
	function thb_is_bbpress() {
		return class_exists( 'bbPress' );
	}
}

if ( thb_is_bbpress() ) {

/**
 * Helpers
 * -----------------------------------------------------------------------------
 */
require dirname( __FILE__ ) . '/helpers.php';

/**
 * bbPress general options
 * -----------------------------------------------------------------------------
 */
require dirname( __FILE__ ) . '/bbpress_options.php';

}

/**
 * Include the theme-bbpress file
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_include_theme_bbpress' ) ) {
	function thb_include_theme_bbpress(  ) {
		if ( thb_is_bbpress() ) {
			if( file_exists( THB_TEMPLATE_DIR . '/bbpress/theme-bbpress.php' )) {
				include THB_TEMPLATE_DIR . '/bbpress/theme-bbpress.php';
			}
		}
	}

	add_action( 'init', 'thb_include_theme_bbpress' );
}