<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-script.php
 * @file	 	1.0
 *
 *	1. CSS
 *	1.1 Foundation
 *	1.2 Custom
 *	2. JS
 *	2.1 Modernizr
 *	2.2 Foundation
 *	2.3 Theme
 *	2.4 Plugins
 *	2.5 WordPress
 *
 */
?>
<?php
/**
 * ------------------------------------------------------------------------
 * 1.	CSS
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'foundation_styles' ) ) {
		function foundation_styles() {
		    wp_register_style( 'foundation-app', get_template_directory_uri() . '/css/app.css', array(), '3.0', 'all' );
		    wp_enqueue_style( 'foundation-app' );
		}
		add_action('wp_enqueue_scripts', 'foundation_styles');
	}

	if ( ! function_exists( 'custom_styles' ) ) {
		function custom_styles() {
		    wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array(), '1.6.5.2', 'all' );
		    wp_enqueue_style( 'woocommerce' );
		    wp_register_style( 'icons', get_template_directory_uri() . '/css/icons.css', array(), '3.0', 'all' );
		    wp_enqueue_style( 'icons' );
		    wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '2.0', 'all' );
		    wp_enqueue_style( 'flexslider' );
		    wp_register_style( 'pageslide', get_template_directory_uri() . '/css/pageslide.css', array(), '2.0', 'all' );
		    wp_enqueue_style( 'pageslide' );
			wp_enqueue_style( 'custom_chosen_styles', get_template_directory_uri() . '/css/chosen.css' );
		}
		add_action('wp_enqueue_scripts', 'custom_styles');
	}

	if ( ! function_exists( 'default_styles' ) ) {
		function default_styles() {
			global $data, $prefix;
			if (is_printversion()) {
		    	wp_register_style( 'stylesheet', get_template_directory_uri() . '/print-style.css', array(), '1.0', 'all' );

			} else {
		    	wp_register_style( 'stylesheet', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
			}
		    wp_enqueue_style( 'stylesheet' );
		    if($data[$prefix.'optimize_styling']=="1") {
				wp_enqueue_style( 'default_style', get_template_directory_uri() . '/css/default-style.css' );
				wp_enqueue_style( 'default_style' );
		    }
		}
		add_action('wp_enqueue_scripts', 'default_styles');
	}


/**
 * ------------------------------------------------------------------------
 * 2.	JS
 * ------------------------------------------------------------------------
 */

    /*-------------------------------------
    //  2.1	Modernizr
    ---------------------------------------*/
	/* load modernizr from foundation */
	if ( ! function_exists( 'modernize_it' ) ) {
		function modernize_it(){
		    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr.foundation.js', array('jquery'), '2.6.2', true );
		    wp_enqueue_script( 'modernizr' );
		}
		add_action( 'wp_enqueue_scripts', 'modernize_it' );
	}

    /*-------------------------------------
    //  2.2	Foundation
    ---------------------------------------*/
	if ( ! function_exists( 'foundation_js' ) ) {
		function foundation_js(){
			global $data, $prefix;
		    if($data[$prefix.'optimize_ftooltip']!="1") {
				wp_register_script( 'foundation-tooltips', get_template_directory_uri() . '/js/foundation/tooltips.js', array('jquery'), '2.0.2', true );
			    wp_enqueue_script( 'foundation-tooltips');
		   	}
		   	if($data[$prefix.'optimize_freveal']!="1") {
				wp_register_script( 'foundation-reveal', get_template_directory_uri() . '/js/foundation/reveal.js', array('jquery'), '1.1', true );
			    wp_enqueue_script( 'foundation-reveal');
		    }
		    if($data[$prefix.'optimize_fmagellan']!="1") {
			    wp_register_script( 'foundation-magellan', get_template_directory_uri() . '/js/foundation/magellan.js', array('jquery'), '0.0.1', true );
			    wp_enqueue_script( 'foundation-magellan');
		    }
		    wp_register_script( 'foundation-plugins', get_template_directory_uri() . '/js/foundation/foundation-plugins.js', array('jquery'), '1.0', true );
		    wp_enqueue_script( 'foundation-plugins');
		}
		add_action('wp_enqueue_scripts', 'foundation_js');
	}

    /*-------------------------------------
    //  2.3	Theme
    ---------------------------------------*/
	if ( ! function_exists( 'theme_js' ) ) {
		function theme_js(){
		    wp_register_script( 'theme-js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
		    wp_enqueue_script( 'theme-js' );
		}
		add_action('wp_enqueue_scripts', 'theme_js');
	}

    /*-------------------------------------
    //  2.4	Plugins
    ---------------------------------------*/
	if ( ! function_exists( 'plugins_js' ) ) {
		function plugins_js(){
			global $data, $prefix;

		    if($data[$prefix.'optimize_preload']!="1") {
			    wp_register_script( 'activity', get_template_directory_uri() . '/js/activity.js', array('jquery'), '1.0', 	true);
			    wp_enqueue_script( 'activity' );
		    }
		    if($data[$prefix.'optimize_autosize']!="1") {
		   		wp_register_script( 'autosize', get_template_directory_uri() . '/js/autosize.js', array('jquery'), '1.13', true);
		   		wp_enqueue_script( 'autosize' );
		    }
		    if($data[$prefix.'optimize_fittext']!="1") {
		    	wp_register_script( 'fittext', get_template_directory_uri() . '/js/fittext.js', array('jquery'), '1.0', true);
		    	wp_enqueue_script( 'fittext' );
		    }
		    if($data[$prefix.'optimize_idle']!="1") {
			    wp_register_script( 'idle-timer', get_template_directory_uri() . '/js/idle-timer.js', array('jquery'), '0.9.100511', true);
			    wp_enqueue_script( 'idle-timer' );
			}
		    if($data[$prefix.'optimize_md5']!="1") {
		    	wp_register_script( 'md5', get_template_directory_uri() . '/js/md5.js', array('jquery'), '1.0', true);
		    	wp_enqueue_script( 'md5' );
		    }
			if($data[$prefix.'optimize_gmap']!="1" && is_page_template('template-contact.php')) {
		   		wp_enqueue_script( 'gmap-api', 'http://maps.google.com/maps/api/js?sensor=false');
		   		wp_enqueue_script( 'contact', get_template_directory_uri() . '/js/contact.js');
		    }
		    if($data[$prefix.'optimize_zoom']!="1") {
			    wp_register_script( 'zoom', get_template_directory_uri() . '/js/zoom.js', array('jquery'), '1.4', true);
			    wp_enqueue_script( 'zoom' );
			}
		    wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1.0', true);
		    wp_enqueue_script( 'plugins' );

		    if(wp_script_is('chosen',$list = 'registered')) {
				wp_deregister_script( 'chosen' );
		    }
			wp_register_script( 'chosen', get_template_directory_uri() . '/js/chosen.js', array('jquery'), '1.0', true);
			wp_enqueue_script( 'chosen' );

		}
		add_action('wp_enqueue_scripts', 'plugins_js');
	}

    /*-------------------------------------
    //  2.5	WordPress
    ---------------------------------------*/
	if ( ! function_exists( 'wordpress_js' ) ) {
		// loading jquery reply elements on single pages automatically
		function wordpress_js() {
			if (!is_admin()) {
				if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)){
					wp_enqueue_script( 'comment-reply' );
				}
			}
		}
		// reply on comments script
		add_action('wp_print_scripts', 'wordpress_js');
	}