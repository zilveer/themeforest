<?php

$inc = get_template_directory() . '/inc/';

/**
 * Load Theme Options
 */
require_once( $inc . 'options/general-settings.php' );
require_once( $inc . 'options/site-settings.php' );
require_once( $inc . 'options/styling-options.php' );
require_once( $inc . 'options/sidebar-settings.php' );
require_once( $inc . 'options/static-content.php' );

/**
 * Check if WooCommerce is active. And include WooCommerce dependant options.
 */
if ( stag_is_woocommerce_active() ) {
	// WooCommerce dependant theme options.
	require_once( $inc . 'options/shop-settings.php' );

	// WooCommerce dependant widgets.
	require_once( $inc . 'widgets/widget-woo-featured-products.php' );
	require_once( $inc . 'widgets/widget-woo-latest-products.php' );
	require_once( $inc . 'widgets/widget-woo-best-sellers.php' );
	require_once( $inc . 'widgets/widget-woo-on-sale-products.php' );
	require_once( $inc . 'widgets/widget-woo-top-rated.php' );
}

require_once( $inc . 'meta/layout-meta.php' );
require_once( $inc . 'meta/page-meta.php' );
require_once( $inc . 'meta/slider-meta.php' );

require_once( $inc . 'widgets/widget-static-content.php' );
require_once( $inc . 'widgets/widget-category-box.php' );
require_once( $inc . 'widgets/widget-section-category-boxes.php' );
