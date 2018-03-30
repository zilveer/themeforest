<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Include all the needed files
 *
 * (!) Note for Clients: please, do not modify this or other theme's files. Use child theme instead!
 */

//add_filter( 'us_blog_listing_classes', 'zephyr_listing_classes' );
add_filter( 'us_portfolio_listing_classes', 'zephyr_listing_classes' );
add_filter( 'us_gallery_listing_classes', 'zephyr_listing_classes' );
function zephyr_listing_classes( $classes ) {
	if ( strpos($classes, 'ratio_initial') !== FALSE ) {
		return $classes;
	} else {
		return $classes . ' animate_revealgrid';
	}

}

//add_filter( 'us_blog_listing_item_classes', 'zephyr__listing_item_classes' );
add_filter( 'us_portfolio_listing_item_classes', 'zephyr_listing_item_classes' );
add_filter( 'us_gallery_listing_item_classes', 'zephyr_listing_item_classes' );
function zephyr_listing_item_classes( $classes ) {
	return $classes . ' animate_reveal';
}

// Using labels instead of placeholders in comments form
add_filter( 'us_comment_form_fields', 'zephyr_comment_form_fields' );
function zephyr_comment_form_fields( $fields ) {
	foreach ( $fields as &$field ) {
		$field['title'] = $field['placeholder'];
		unset( $field['placeholder'] );
	}

	return $fields;
}

$us_theme_supports = array(
	'plugins' => array(
		'js_composer' => '/framework/plugins-support/js_composer/js_composer.php',
		'Ultimate_VC_Addons' => '/framework/plugins-support/Ultimate_VC_Addons.php',
		'revslider' => '/framework/plugins-support/revslider.php',
		'contact-form-7' => NULL,
		'woocommerce' => '/framework/plugins-support/woocommerce/woocommerce.php',
		'codelights' => '/framework/plugins-support/codelights.php',
		'wpml' => NULL,
	),
);

require dirname( __FILE__ ) . '/framework/framework.php';
