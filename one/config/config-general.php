<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme config.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Config
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * APPEARANCE
 * -----------------------------------------------------------------------------
 */

// Scripts and styles

// $thb_theme->getFrontend()->addStyle(get_template_directory_uri() . '/css/royalslider.css', array(
// 	'name' => 'royalslider'
// ));

// $thb_theme->getFrontend()->addStyle(get_template_directory_uri() . '/css/rs-skins/rs-thb.css', array(
// 	'name' => 'royalslider-skin'
// ));

$thb_theme->getFrontend()->addStyle(get_template_directory_uri() . '/css/theme-fonts.css', array(
	'name' => 'thb_theme_fonts'
));
$thb_theme->getFrontend()->addStyle(get_template_directory_uri() . '/css/layout.css', array(
	'name' => 'thb_layout'
));

if ( ! function_exists( 'thb_one_frontend_scripts' ) ) {
	function thb_one_frontend_scripts( $scripts ) {
		$scripts[] = THB_FRONTEND_JS_PATH . '/filter.js';
		$scripts[] = THB_FRONTEND_JS_PATH . '/isotope.js';
		$scripts[] = get_template_directory() . '/js/modernizr.min.js';
		$scripts[] = get_template_directory() . '/js/jquery.royalslider.min.js';
		$scripts[] = get_template_directory() . '/js/jquery.scrollTo.min.js';
		$scripts[] = get_template_directory() . '/js/isotope.pkgd.min.js';
		$scripts[] = get_template_directory() . '/js/jquery.fitvids.js';
		$scripts[] = get_template_directory() . '/js/jquery.fittext.js';
		$scripts[] = get_template_directory() . '/js/60fps-scroll.js';
		$scripts[] = get_template_directory() . '/js/nprogress.min.js';
		// $scripts[] = get_template_directory() . '/js/fastclick.js';
		$scripts[] = get_template_directory() . '/js/jquery.parallax.js';
		$scripts[] = get_template_directory() . '/js/slideshow.js';
		$scripts[] = get_template_directory() . '/js/script.js';

		return $scripts;
	}
}

add_filter( 'thb_frontend_scripts', 'thb_one_frontend_scripts' );

if ( thb_compress_frontend_scripts() ) {
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/script.compact.js' );
}
else {
	$thb_theme->getFrontend()->addScript( THB_FRONTEND_JS_URL . '/filter.js' );
	$thb_theme->getFrontend()->addScript( THB_FRONTEND_JS_URL . '/isotope.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/modernizr.min.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/jquery.royalslider.min.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/jquery.scrollTo.min.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/isotope.pkgd.min.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/jquery.fitvids.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/jquery.fittext.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/60fps-scroll.js', array(
		'name' => 'thb-60fps-scroll'
	) );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/nprogress.min.js' );
	// $thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/fastclick.js', array(
	// 	'name' => 'thb-fastclick'
	// ) );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/jquery.parallax.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/slideshow.js' );
	$thb_theme->getFrontend()->addScript( get_template_directory_uri() . '/js/script.js' );
}

// Responsive

if( !function_exists('thb_html_class_filter') ) {
	function thb_html_class_filter( $classes ) {
		if( thb_get_option('enable_responsive_768') == 1 ) {
			$classes[] = 'responsive_768';
		}

		if( thb_get_option('enable_responsive_480') == 1 ) {
			$classes[] = 'responsive_480';
		}

		return $classes;
	}

	add_filter('thb_html_class', 'thb_html_class_filter');
}

// Editor style

function thb_one_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'init', 'thb_one_add_editor_styles' );

// Theme meta data

if( !function_exists('thb_theme_meta') ) {
	function thb_theme_meta() {
		thb_meta('viewport', 'width=device-width, initial-scale=1');
	}

	add_action( 'thb_head_meta', 'thb_theme_meta' );
}

if( !function_exists('thb_ie_fixes') ) {
	// IE Fix
	function thb_ie_fixes() {
		thb_ie();
	}

	add_action( 'wp_head', 'thb_ie_fixes', 9998 );
}

// The image sizes

add_image_size( 'micro', 80, 80, true );
add_image_size( 'thumbnail', 150, 150, true );
add_image_size( 'large', 930, null, true );
add_image_size( 'large-cropped', 930, 523, true );
add_image_size( 'medium', 610, null, true );
add_image_size( 'medium-cropped', 610, 343, true );
add_image_size( 'full-width', 1600, null, true );

add_image_size( 'grid-large', 400, null, true );
add_image_size( 'grid-large-cropped', 400, 400, true );
add_image_size( 'grid-small', 300, null, true );
add_image_size( 'grid-small-cropped', 300, 300, true );

// Menus

register_nav_menus(array(
	'primary' => __( 'Primary navigation', 'thb_text_domain' )
));

register_nav_menus(array(
	'mobile' => __( 'Mobile navigation', 'thb_text_domain' )
));

if( ! function_exists( 'thb_get_theme_templates' ) ) {
	/**
	 * Return the theme templates.
	 *
	 * @param boolean|string $key
	 * @return array
	 */
	function thb_get_theme_templates( $key = false ) {
		$templates = array(
			'*' => array(
				'default',
				'template-blog.php',
				'template-blog-grid.php',
				'template-portfolio.php',
				'template-archives.php',
				'template-photogallery.php',
				'single.php',
				'template-blank.php'
			),
			'templates' => array(
				'default',
				'template-blog.php',
				'template-blog-grid.php',
				'template-portfolio.php',
				'template-archives.php',
				'template-photogallery.php',
				'template-blank.php'
			)
		);

		if ( $key && isset( $templates[$key] ) ) {
			return $templates[$key];
		}

		$return = array();

		foreach ( $templates as $key => $tpls ) {
			foreach ( $tpls as $tpl ) {
				$return[] = $tpl;
			}
		}

		return array_unique( $return );
	}
}

if ( function_exists( 'is_woocommerce' ) ) {
	/**
	 * Define image sizes
	 * -------------------------------------------------------------------------
	 */

	if( !function_exists('thb_woocommerce_image_size_shop_single') ) {
		function thb_woocommerce_image_size_shop_single( $size ) {
			return array(
				'width' => 610,
				'height' => 610,
				'crop' => true
			);
		}
	}

	if( !function_exists('thb_woocommerce_image_size_shop_catalog') ) {
		function thb_woocommerce_image_size_shop_catalog( $size ) {
			return array(
				'width' => 400,
				'height' => 400,
				'crop' => true
			);
		}
	}

	if( !function_exists('thb_woocommerce_image_size_shop_thumbnail') ) {
		function thb_woocommerce_image_size_shop_thumbnail( $size ) {
			return array(
				'width' => 80,
				'height' => 80,
				'crop' => true
			);
		}
	}

	add_filter('woocommerce_get_image_size_shop_thumbnail', 'thb_woocommerce_image_size_shop_thumbnail', 999);
	add_filter('woocommerce_get_image_size_shop_catalog', 'thb_woocommerce_image_size_shop_catalog', 999);
	add_filter('woocommerce_get_image_size_shop_single', 'thb_woocommerce_image_size_shop_single', 999);
}