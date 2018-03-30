<?php
/**
 * Decibel WooCommerce functions
 *
 * @package WordPress
 * @subpackage Decibel
 * @since Decibel 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_theme_support( 'woocommerce' ); // add Woocommerce support
add_filter( 'woocommerce_enqueue_styles', '__return_false' ); // disable Woocommerce CSS

if ( ! function_exists( 'wolf_products_per_page' ) ) {
	/**
	 * Set products per page
	 *
	 * @access public
	 * @return int
	 */
	function wolf_products_per_page() {

		// Display 12 products per page by default
		$products_per_page = 12;

		if ( wolf_get_theme_option( 'products_per_page' ) )
			$products_per_page = wolf_get_theme_option( 'products_per_page' );

		return $products_per_page;

	}
	add_filter( 'loop_shop_per_page', 'wolf_products_per_page', 20 );
}



if ( ! function_exists( 'loop_columns' ) ) {
	/**
	 * Number of product per row
	 */
	function loop_columns() {

		return 99999; // set inifinite number to handle this with CSS
	}
	add_filter( 'loop_shop_columns', 'loop_columns' );
}

if ( ! function_exists( 'wolf_get_woocommerce_shop_page_id' ) ) {
	/**
	 * Get WooCommerce shop page id
	 *
	 * @return int
	 */
	function wolf_get_woocommerce_shop_page_id() {

		$page_id = null;

		if ( class_exists( 'Woocommerce' ) )
			$page_id = get_option( 'woocommerce_shop_page_id' );

		return $page_id;
	}
}

/**
 * Remove add to cart function from woocommerce_after_shop_loop_item_title hook
 * and hook it in wolf_woocommerce_after_product_image
 */
function remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
// add_action( 'init', 'remove_loop_button' );
// add_action( 'wolf_woocommerce_after_product_image', 'woocommerce_template_loop_add_to_cart', 10 );

// The following goes in functions.php
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10);
function woocommerce_template_loop_stock() {
	global $product;
	if ( ! $product->managing_stock() && ! $product->is_in_stock() ) {
		echo '<span class="soldout">' . esc_html__( 'Sold out!', 'wolf' ) .  '</span>';
	}
}

/**
 * Move the woocomerce pagination outside the loop
 */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

if ( ! function_exists( 'wolf_woocomerce_before' ) ) {
	/**
	 * Add wrapper opening tag before woocommerce content
	 *
	 * @access public
	 * @return void
	 */
	function wolf_woocomerce_before() {

		echo '<div class="wolf-woocomerce-wrapper clearfix">';

	}
	add_action( 'wolf_woocommerce_page_before', 'wolf_woocomerce_before' );
}

if ( ! function_exists( 'wolf_woocomerce_after' ) ) {
	/**
	 * Add wrapper closing tag after woocommerce content
	 * then add woo pagination
	 *
	 * @access public
	 * @return void
	 */
	function wolf_woocomerce_after() {

		echo '</div><!-- .wolf-woocomerce-wrapper -->';

	}
	add_action( 'wolf_woocommerce_page_after', 'wolf_woocomerce_after' );
	add_action( 'wolf_woocommerce_page_after', 'woocommerce_pagination' );
}

if ( ! function_exists( 'wolf_custom_woocomerce_placeholder' ) ) {
	/**
	 * Replace the Woocommerce placeholder image
	 *
	 * @param
	 * @return
	 */
	function wolf_custom_woocomerce_placeholder() {

		add_filter( 'woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src' );

		function custom_woocommerce_placeholder_img_src( $src ) {

			$src = wolf_get_theme_uri( '/images/woocommerce/placeholder.jpg' );

			return $src;
		}
	}
	add_action( 'init', 'wolf_custom_woocomerce_placeholder' );
}
