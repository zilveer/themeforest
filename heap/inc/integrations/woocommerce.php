<?php
/**
 * Woocommerce support
 * If woocommerce is active and is required woo support then load tehm all
 */

add_theme_support( 'woocommerce' );

/**
 * Assets
 */
function heap_callback_load_woocommerce_assets() {
	global $woocommerce;
	if ( ! heap_option( 'enable_woocommerce_support', '1' ) ) {
		return;
	}
//	wp_enqueue_style( 'wpgrade-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array( 'woocommerce-general' ), heap_cachebust_string( get_template_directory() .'/assets/css/woocommerce.css' ) );
}

add_action( 'wp_enqueue_scripts', 'heap_callback_load_woocommerce_assets', 1 );

add_filter( 'term_links-product_cat', 'heap_filter_product_categories', 10, 1 );

function heap_filter_product_categories( $term_links ) {

	if ( ! empty( $term_links ) ) {
		foreach ( $term_links as &$link ) {
			$link = str_replace( '<a ', '<a class="btn  btn--small  btn--tertiary" ', $link );
		}
	}

	return $term_links;
}

add_filter( 'term_links-product_tag', 'heap_filter_product_tags', 10, 1 );

function heap_filter_product_tags( $term_links ) {

	if ( ! empty( $term_links ) ) {
		foreach ( $term_links as &$link ) {
			$link = str_replace( '<a ', '<a class="btn  btn--small  btn--tertiary" ', $link );
		}
	}

	return $term_links;

}

// customize breadcrumb howevah
add_filter( 'woocommerce_breadcrumb_defaults', 'heap_woocommerce_breadcrumbs' );
function heap_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x( 'Shop', 'breadcrumb', 'woocommerce' )
	);
}

// change the "Home" url into the shop's one
add_filter( 'woocommerce_breadcrumb_home_url', 'heap_custom_breadrumb_home_url' );
function heap_custom_breadrumb_home_url() {
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	if ( ! empty( $shop_page_url ) ) {
		return $shop_page_url;
	}

	return get_home_url();
}

// move the breadcrumb before title
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 3, 0 );
