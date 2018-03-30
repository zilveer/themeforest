<?php
if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array( 'link', 'quote' ) );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'grandportfolio-gallery-grid', 705, 529, true );
	add_image_size( 'grandportfolio-gallery-grid-large', 1024, 768, true );
	add_image_size( 'grandportfolio-gallery-thumb', 705, 705, true );
	add_image_size( 'grandportfolio-gallery-masonry', 705, 9999, false );
	add_image_size( 'grandportfolio-gallery-striped', 300, 690, true );
	add_image_size( 'grandportfolio-blog', 960, 636, true );
}

add_action( 'after_setup_theme', 'grandportfolio_woocommerce_support' );
	function grandportfolio_woocommerce_support() {
    	add_theme_support( 'woocommerce' );
}

add_filter('wp_get_attachment_image_attributes', 'grandportfolio_responsive_image_fix');

function grandportfolio_responsive_image_fix($attr) {
    if (isset($attr['sizes'])) unset($attr['sizes']);
    if (isset($attr['srcset'])) unset($attr['srcset']);
    return $attr;
}

add_filter('wp_calculate_image_sizes', '__return_false', PHP_INT_MAX);
add_filter('wp_calculate_image_srcset', '__return_false', PHP_INT_MAX);
remove_filter('the_content', 'wp_make_content_images_responsive');

/* Flush rewrite rules for custom post types. */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
?>