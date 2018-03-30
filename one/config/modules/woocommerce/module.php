<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * WooCommerce.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\WooCommerce
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
	 * Enable the creation of the shop sidebar options
	 */
	'sidebar_shop' => true,

	/**
	 * Enable the creation of the single product sidebar options
	 */
	'sidebar_product' => true,

	/**
	 * Enable the THB custom skin
	 */
	'skin' => false,

	/**
	 * Enable the hide cart option.
	 */
	'hide_cart_option' => false
);
$thb_theme->setConfig( 'woocommerce', thb_array_asum( $thb_config, $config ) );

/**
 * Helpers
 * -----------------------------------------------------------------------------
 */
require dirname( __FILE__ ) . '/helpers.php';

/**
 * WooCommerce general options
 * -----------------------------------------------------------------------------
 */
require dirname( __FILE__ ) . '/woo_options.php';

/**
 * Include the theme-woocommerce file
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_include_theme_woocommerce' ) ) {
	function thb_include_theme_woocommerce(  ) {
		if ( thb_woocommerce_check() ) {
			if( file_exists( THB_TEMPLATE_DIR . '/woocommerce/theme-woocommerce.php' )) {
				include THB_TEMPLATE_DIR . '/woocommerce/theme-woocommerce.php';
			}
		}
	}

	add_action( 'init', 'thb_include_theme_woocommerce' );
}

/**
 * Add theme support for WooCommerce
 * -----------------------------------------------------------------------------
 */
add_theme_support( 'woocommerce' );