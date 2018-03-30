<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_remove_unwanted_plugin_style' ) ) {
	/**
	 * Remove several plugin styles and scripts
	 * Allow an easier customization
	 */
	function wolf_remove_unwanted_plugin_style() {
		wp_dequeue_style( 'wolf-portfolio' );
		wp_deregister_style( 'wolf-portfolio' );
		wp_dequeue_style( 'wolf-videos' );
		wp_deregister_style( 'wolf-videos' );
		wp_dequeue_style( 'wolf-albums' );
		wp_deregister_style( 'wolf-albums' );
		wp_dequeue_style( 'wolf-discography' );
		wp_deregister_style( 'wolf-discography' );
	}
	add_action( 'wp_enqueue_scripts', 'wolf_remove_unwanted_plugin_style' );
}

if ( ! function_exists( 'wolf_enqueue_style' ) ) {
	/**
	 * Enqueue CSS stylsheets
	 * JS scripts are separated and can be found in includes/scripts.php
	 */
	function wolf_enqueue_style() {
		global $wp_styles;
		$theme_slug = wolf_get_theme_slug();

		wp_dequeue_style( 'flexslider' );
		wp_deregister_style( 'flexslider' );
		wp_dequeue_style( 'swipebox' );
		wp_deregister_style( 'swipebox' );
		wp_dequeue_style( 'fancybox' );
		wp_deregister_style( 'fancybox' );

		$lightbox = wolf_get_theme_option( 'lightbox', 'swipebox' );

		if ( 'swipebox' == $lightbox ) {

			wp_enqueue_style( 'swipebox', WOLF_THEME_URI. '/css/lib/swipebox.min.css', array(), '1.3.0' );

		} elseif ( 'fancybox' == $lightbox ) {

			wp_enqueue_style( 'fancybox', WOLF_THEME_URI. '/css/lib/fancybox.css', array(), '2.1.4' );
		}

		// WP icons
		wp_enqueue_style( 'dashicons' );

		// Enqueue scripts conditionaly for the blog
		if ( wolf_get_theme_option( 'blog_infinite_scroll' ) && 'post' == get_post_type() && ! is_single() ) {
			// WP mediaelement
			wp_enqueue_style( 'wp-mediaelement' );
		}

		if ( wolf_get_theme_option( 'css_min' ) ) {

			wp_enqueue_style( wolf_get_theme_slug() . '-style-min', WOLF_THEME_URI. '/css/main.min.css', array(), WOLF_THEME_VERSION );

		} else {
			// normalize
			wp_enqueue_style( 'normalize', WOLF_THEME_URI. '/css/lib/normalize.css', array(), '3.0.0' );

			// Bagpakk
			wp_enqueue_style( 'bagpakk', WOLF_THEME_URI. '/css/lib/bagpakk-wordpress-custom.min.css', array(), '1.0.0' );

			// Flexslider
			wp_enqueue_style( 'flexslider', WOLF_THEME_URI. '/css/lib/flexslider.css', array(), '2.2.0' );

			// Owl Carousel
			wp_enqueue_style( 'owlcarousel', WOLF_THEME_URI. '/css/lib/owl.carousel.min.css', array(), '2.0.0' );

			// Font Awesome
			wp_enqueue_style( 'icon-pack', WOLF_THEME_URI. '/css/icon-pack.min.css', array(), WOLF_THEME_VERSION );

			// Main stylsheet
			wp_enqueue_style( $theme_slug . '-style', WOLF_THEME_URI. '/css/main.css', array(), WOLF_THEME_VERSION );
		}

		// WP default Stylesheet
		wp_enqueue_style( $theme_slug . '-default', get_stylesheet_uri(), array(), WOLF_THEME_VERSION );

		// Loads the Internet Explorer 8 specific stylesheet. */
		wp_enqueue_style( $theme_slug . '-ie8-style', WOLF_THEME_URI . '/css/ie8.css' );
		$wp_styles->add_data( $theme_slug . '-ie8-style', 'conditional', 'lte IE 8' );
	}
	add_action( 'wp_enqueue_scripts', 'wolf_enqueue_style', 1 );
}

if ( ! function_exists( 'wolf_enable_rt_support' ) ) {
	/**
	 * Enable rtl support
	 *
	 * Enqueue rtl.css
	 *
	 * @param
	 * @return
	 */
	function wolf_enable_rt_support() {

		wp_enqueue_style( wolf_get_theme_slug() . '-rtl', WOLF_THEME_URI. '/rtl.css', array(), WOLF_THEME_VERSION );

	}
	//add_action( 'wp_enqueue_scripts', 'wolf_enable_rt_support' );
}