<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */
  
# Constants
define('THEMEDIR', 		get_template_directory() . '/');
define('THEMEURL', 		get_template_directory_uri() . '/');
define('THEMEASSETS',	THEMEURL . 'assets/');
define('TD', 			'aurum');
define('TS', 			microtime(true));


# Theme Content Width
$content_width = ! isset($content_width) ? 1170 : $content_width;


# Initial Actions
add_action('after_setup_theme', 	'laborator_after_setup_theme');
add_action('init', 					'laborator_init');

add_action('widgets_init', 			'laborator_widgets_init');

add_action('wp_head', 				'laborator_favicon');
add_action('wp_enqueue_scripts', 	'laborator_wp_enqueue_scripts');
add_action('wp_enqueue_scripts', 	'laborator_wp_head');
add_action('wp_print_scripts', 		'laborator_wp_print_scripts');

add_action('admin_print_styles', 	'laborator_admin_print_styles');
add_action('admin_menu', 			'laborator_menu_page');
add_action('admin_menu', 			'laborator_menu_documentation', 100);
add_action('admin_enqueue_scripts', 'laborator_admin_enqueue_scripts');

add_action('wp_footer', 			'laborator_wp_footer');


# Core Files
require 'inc/lib/smof/smof.php';
require locate_template( 'inc/laborator_actions.php' );
require locate_template( 'inc/laborator_filters.php' );
require locate_template( 'inc/laborator_functions.php' );

if(file_exists(THEMEDIR . 'theme-demo/theme-demo.php') && is_readable(THEMEDIR . 'theme-demo/theme-demo.php'))
{
	require 'theme-demo/theme-demo.php';
}

require 'inc/laborator_woocommerce.php';
require 'inc/acf-fields.php';


# Library
require 'inc/lib/laborator/laborator_gallerybox.php';
require 'inc/lib/laborator/laborator_custom_css.php';
require 'inc/lib/class-tgm-plugin-activation.php';

if(is_admin())
{
	require 'inc/lib/laborator/laborator-demo-content-importer/laborator_demo_content_importer.php';
}


# Thumbnails
$blog_thumbnail_height      = get_data('blog_thumbnail_height');
$blog_thumbnail_height      = is_numeric($blog_thumbnail_height) && $blog_thumbnail_height > 100 ? $blog_thumbnail_height : 640;

add_image_size('post-thumb-big', 1140, $blog_thumbnail_height, true);


# Catalog Image Size
$shop_catalog_image_size            = get_data( 'shop_catalog_image_size' );
$shop_catalog_image_size_default    = array(290, 370);
$shop_catalog_image_crop            = true;

if( preg_match( "/^[0-9]+x[0-9]+(x0)?$/", $shop_catalog_image_size, $matches ) ) {
	$shop_catalog_image_size = explode("x", $shop_catalog_image_size);

	if( isset( $matches[1] ) && $matches[1] == 'x0' ) {
		$shop_catalog_image_crop = false;
	}
} 
else
{
	if( ! empty( $shop_catalog_image_size ) && is_string( $shop_catalog_image_size ) ) {
		add_filter( 'laborator_wc_product_loop_thumb_size', create_function( '', 'return "'.$shop_catalog_image_size.'";') );
	}
	
	$shop_catalog_image_size = $shop_catalog_image_size_default;
}

if( $shop_catalog_image_size[0] == 0 || $shop_catalog_image_size[1] == 0 ) {
	$shop_catalog_image_crop = false;
}

add_image_size('shop-thumb', $shop_catalog_image_size[0], $shop_catalog_image_size[1], $shop_catalog_image_crop);


# Single Product Image Size
$shop_single_image_size            = get_data( 'shop_single_image_size' );
$shop_single_image_size_default    = array(555, 710);
$shop_single_image_crop            = true;

if( preg_match( "/^[0-9]+x[0-9]+(x0)?$/", $shop_single_image_size, $matches ) ) {
	$shop_single_image_size = explode("x", $shop_single_image_size);

	if( isset( $matches[1] ) && $matches[1] == 'x0' ) {
		$shop_single_image_crop = false;
	}
} 
else
{
	if( ! empty( $shop_single_image_size ) && is_string( $shop_single_image_size ) ) {
		add_filter( 'single_product_large_thumbnail_size', create_function( '', 'return "'.$shop_single_image_size.'";') );
	}
	
	$shop_single_image_size = $shop_single_image_size_default;
}

if( $shop_single_image_size[0] == 0 || $shop_single_image_size[1] == 0 ) {
	$shop_single_image_crop = false;
}

add_image_size('shop-thumb-main', $shop_single_image_size[0], $shop_single_image_size[1], $shop_single_image_crop);


# Other Image Sizes
add_image_size('shop-thumb-2', 70, 90, true);
add_image_size('shop-category-thumb', 320, 256, true);
