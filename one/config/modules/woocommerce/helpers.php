<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Is WooCommerce check.
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_is_woocommerce' ) ) {
	function thb_is_woocommerce(  ) {
		return function_exists( 'is_woocommerce' );
	}
}

/**
 * Return the WooCommerce version number.
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_get_woocommerce_version' ) ) {
	function thb_get_woocommerce_version() {
		return get_option( 'woocommerce_version', null );
	}
}

/**
 * WooCommerce and framework check.
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_woocommerce_check' ) ) {
	function thb_woocommerce_check() {
		if ( thb_is_woocommerce() ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Return the page title without markup.
 *
 * @return string
 */
if ( ! function_exists( 'thb_woo_get_page_title' ) ) {
	function thb_woo_get_page_title() {
		if ( ! thb_woocommerce_check() ) {
			return '';
		}

		ob_start();
		woocommerce_page_title();
		$woo_title = ob_get_contents();
		ob_end_clean();
		return $woo_title;
	}
}