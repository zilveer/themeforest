<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Easy Digital Download.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\EDD
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enable the THB custom skin
	 */
	'skin' => false
);

$thb_theme->setConfig( 'edd', thb_array_asum( $thb_config, $config ) );

if ( ! function_exists( 'thb_is_edd' ) ) {
	/**
	 * Check if the Easy Digital Downloads plugin is active
	 * @return boolean
	 */
	function thb_is_edd() {
		return class_exists( 'Easy_Digital_Downloads' );
	}
}

if ( thb_is_edd() ) {

	/**
	 * Custom EDD skin.
	 */
	function thb_edd_skin() {
		if ( file_exists( THB_TEMPLATE_DIR . '/css/thb-edd-skin.css' ) ) {

			thb_theme()->getFrontend()->addStyle( THB_TEMPLATE_URL . '/css/thb-edd-skin.css', array(
				'deps' => array(),
				'name' => 'thb_edd_skin'
			));

		}
	}

	add_action( 'init', 'thb_edd_skin' );

	/**
	 * Disable the default EDD Skin
	 */

	if ( thb_config( 'edd', 'skin') ) {
		remove_action( 'wp_enqueue_scripts', 'edd_register_styles' );
	}

}