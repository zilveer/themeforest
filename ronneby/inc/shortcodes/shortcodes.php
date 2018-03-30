<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

require_once locate_template( '/inc/shortcodes/reveal-shortcode.php' );

require_once locate_template( '/inc/shortcodes/alertbox-shortcode.php' );

require_once locate_template( '/inc/shortcodes/clearing-shortcode.php' );

require_once locate_template( '/inc/shortcodes/theme-shortcodes.php' );

require_once locate_template( '/inc/shortcodes/twitter-shortcode.php' );

require_once locate_template( '/inc/shortcodes/tooltip-shortcode.php' );

require_once locate_template( '/inc/shortcodes/tinymce-shortcodes.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require_once locate_template( '/inc/shortcodes/woocommerce-shortcodes.php' );
}

if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
	require_once locate_template( '/inc/shortcodes/wishlist-shortcode.php' );
}