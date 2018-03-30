<?php

/*
 * Theme Support
 */
function barcelona_theme_support() {

	/*
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'barcelona', BARCELONA_SERVER_PATH .'/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * Declare thumbnail sizes
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'barcelona-sq', 400, 400, true );
	add_image_size( 'barcelona-xs', 294, 194, true );
	add_image_size( 'barcelona-sm', 384, 253, true );
	add_image_size( 'barcelona-md', 768, 506, true );
	add_image_size( 'barcelona-lg', 1152, 759, true );
	add_image_size( 'barcelona-md-vertical', 336, 450, true );
	add_image_size( 'barcelona-full', 1440 );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * This theme allows users to set a custom background
	 */
	add_theme_support( 'custom-background' );

	/*
	 * Declare WooCommerce support
	 */
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'gallery', 'video'
	) );

	/*
	 * Switch default core markup for search form, comment form, comments
	 * and gallery to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'comment-form', 'search-form', 'gallery'
	) );

	/*
	 * This theme uses wp_nav_menu() in one locations.
	 */
	register_nav_menus( array(
		'main'      => esc_html__( 'Main Navigation Menu', 'barcelona' ),
		'top'       => esc_html__( 'Top Bar Menu', 'barcelona' ),
		'footer'    => esc_html__( 'Footer Menu', 'barcelona' )
	) );

}
add_action( 'after_setup_theme', 'barcelona_theme_support' );

/*
 * Remove entry views support for other post types
 */
function barcelona_remove_ev_post_type_support() {

	$barcelona_pt = array( 'attachment', 'literature', 'portfolio_item', 'recipe', 'restaurant_item' );

	foreach ( $barcelona_pt as $k ) {
		remove_post_type_support( $k, 'entry-views' );
	}

}
add_action( 'init', 'barcelona_remove_ev_post_type_support', 99 );