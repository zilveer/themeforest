<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * General.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\General
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enable the copyright text.
	 */
	'copyright' => true,

	/**
	 * Add the custom RSS feed.
	 */
	'rss' => true,

	/**
	 * Add the Google Analytics tracking code.
	 */
	'analytics' => true,

	/**
	 * Enable the logo.
	 */
	'logo' => true,

	/**
	 * Enable the site favicon and touch icons.
	 */
	'icons' => true,

	/**
	 * Text box block icon styles enabled for builder blocks
	 */
	'builder_text_box_icon_styles' => array(
		'icon-style-a' => __('Simple icon', 'thb_text_domain'),
		'icon-style-b' => __('Round bordered icon', 'thb_text_domain'),
		'icon-style-c' => __('Round filled icon', 'thb_text_domain'),
		'icon-style-d' => __('Squared filled icon', 'thb_text_domain'),
		'icon-style-e' => __('Squared bordered icon', 'thb_text_domain')
	),

	/**
	 * Progress bar block styles enabled for builder blocks
	 */
	'builder_progress_bar_styles' => array(
		'progress-style-a' => __( 'Text outside bar', 'thb_text_domain' ),
		'progress-style-b' => __( 'Text inside bar', 'thb_text_domain' )
	),

	/**
	 * Divider block styles enabled for builder blocks
	 */
	'builder_divider_styles' => array(
		'divider-style-a' => __( 'Invisible', 'thb_text_domain' ),
		'divider-style-b' => __( 'Simple thin line', 'thb_text_domain' ),
		'divider-style-c' => __( 'Simple fat line', 'thb_text_domain' )
	),

	/**
	 * Counter block styles
	 */
	'builder_counter_styles' => array(
		'counter-style-a' => __( 'Small text', 'thb_text_domain' ),
		'counter-style-b' => __( 'Normal text', 'thb_text_domain' ),
		'counter-style-c' => __( 'Medium text', 'thb_text_domain' ),
		'counter-style-d' => __( 'Big text', 'thb_text_domain' )
	)

);
$thb_theme->setConfig('backpack/general', thb_array_asum($thb_config, $config));

/**
 * Frontend helpers
 * -----------------------------------------------------------------------------
 */
require_once 'helpers.php';

/**
 * Builder blocks
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_module_general_builder_blocks') ) {
	function thb_module_general_builder_blocks() {
		if ( function_exists( 'thb_builder_instance' ) ) {
			require_once 'fields/class.tabfield.php';
			require_once 'fields/class.pricingtablefield.php';
			require_once 'builder_blocks.php';
		}
	}

	add_action( 'wp_loaded', 'thb_module_general_builder_blocks' );
}

 /**
* Frontend scripts
* -----------------------------------------------------------------------------
*/
if ( ! function_exists( 'thb_module_general_builder_scripts' ) ) {
	function thb_module_general_builder_scripts( $scripts ) {
		if ( function_exists( 'thb_builder_instance' ) ) {
			$scripts[] = thb_get_module_path( 'backpack/general' ) . '/js/odometer.min.js';
			$scripts[] = thb_get_module_path( 'backpack/general' ) . '/js/jquery.easypiechart.min.js';
			$scripts[] = thb_get_module_path( 'backpack/general' ) . '/js/general_module_lib.js';
		}

		return $scripts;
	}
}

add_filter( 'thb_frontend_scripts', 'thb_module_general_builder_scripts' );

if ( ! thb_compress_frontend_scripts() ) {
	if( ! function_exists( 'thb_module_general_builder_scripts_not_compact' ) ) {
		function thb_module_general_builder_scripts_not_compact() {
			if ( function_exists( 'thb_builder_instance' ) ) {
				thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/general') . '/js/jquery.easypiechart.min.js', array(
					'name' => 'builder-easypiechart'
				) );
				thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/general') . '/js/odometer.min.js', array(
					'name' => 'builder-odometer'
				) );
				thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/general') . '/js/general_module_lib.js', array(
					'name' => 'builder-general'
				) );
			}
		}
	}

	add_action( 'init', 'thb_module_general_builder_scripts_not_compact' );
}

/**
 * Options tab
 * -----------------------------------------------------------------------------
 */
$thb_page = $thb_theme->getAdmin()->getMainPage();

/**
 * General
 */
$thb_tab = new THB_Tab( __('General', 'thb_text_domain'), 'general' );

	$thb_container = $thb_tab->createContainer( __('General options', 'thb_text_domain'), 'general_options' );

		if ( thb_config( 'backpack/general', 'copyright' ) ) {
			$thb_field = new THB_TextField('copyright');
			$help = __( 'The copyright text will be displayed at the bottom of the site (Note: accepts basic HTML).', 'thb_text_domain' );

			if ( defined( 'QT_SUPPORTED_WP_VERSION' ) ) {
				$thb_field = new THB_TextareaField('copyright');
				$help = __( 'The copyright text will be displayed at the bottom of the site (Note: accepts basic HTML).<br><br>To translate the message, one per line, prepend the locale of the language. E.g. <code>de_DE:your translated string</code>.', 'thb_text_domain' );
			}

			$thb_field->setLabel( __( 'Copyright text', 'thb_text_domain' ) );
			$thb_field->setHelp( $help );
			$thb_container->addField($thb_field);
		}

		if ( thb_config( 'backpack/general', 'rss' ) === true ) {
			$thb_field = new THB_TextField('rss_alternate');
				$thb_field->setLabel( __('Alternate RSS feed URL', 'thb_text_domain') );
				$thb_field->setHelp( __('If you want to use a custom feed service, like Feedburner or others, enter your preferred RSS feed URL. Otherwise the default WordPress RSS feed will be used.', 'thb_text_domain') );
			$thb_container->addField($thb_field);
		}

		$thb_field = new THB_TextField('google_maps_api_key');
			$thb_field->setLabel( __('Google Maps API Key', 'thb_text_domain') );
			$thb_field->setHelp( __('Head over to the <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">API console</a> to get your key. Make sure that the generated key is valid for your domain.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		if ( thb_config( 'backpack/general', 'analytics' ) ) {
			$thb_field = new THB_TextareaField('analytics');
				$thb_field->setLabel( __('Google Analytics tracking code', 'thb_text_domain') );
				$thb_field->setHelp( sprintf( __('Paste your Google Analytics code here to enable statistics tracking for this site. For more info <a href="%s">read this article</a>.', 'thb_text_domain'), 'http://support.google.com/analytics/bin/answer.py?hl=en&topic=1006226&answer=1008080' ) );
			$thb_container->addField($thb_field);
		}

$thb_page->addTab($thb_tab);

/**
 * Images
 */
if ( thb_config( 'backpack/general', 'logo' ) || thb_config( 'backpack/general', 'icons' ) ) {

	$thb_tab = new THB_Tab( __('Logo & Images', 'thb_text_domain'), 'general_images' );

	$thb_container = $thb_tab->createContainer( '', 'general_images_options' );

		if ( thb_config( 'backpack/general', 'logo' ) ) {
			$thb_field = new THB_UploadField('main_logo');
			$thb_field->setLabel( __('Logo', 'thb_text_domain') );
			$thb_field->setHelp( __('Upload an image to be used as a logo for your site. If this field is left empty, a simple text logo will be used. Please remember to load a properly dimensioned logo.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_UploadField('main_logo_retina');
				$thb_field->setLabel( __('Retina logo', 'thb_text_domain') );
				$thb_field->setHelp( __('Upload an image to be used as a logo for your site for high definition screens. Please remember to load a properly dimensioned logo (usually you can double the size of the regular logo).', 'thb_text_domain') );
			$thb_container->addField($thb_field);
		}

		if ( thb_config( 'backpack/general', 'icons' ) ) {
			$thb_field = new THB_TextField('favicon');
				$thb_field->setLabel( __('Favicon', 'thb_text_domain') );
				$thb_field->setHelp( __('Paste here the URL of your custom favicon.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_TextField('touch_icon_57');
				$thb_field->setLabel( __('Apple Touch Icon 57&times;57', 'thb_text_domain') );
				$thb_field->setHelp( __('Paste here the URL of your custom 57&times;57px Apple Touch Icon. <a href="http://developer.apple.com/library/ios/#documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html">What\'s an Apple Touch Icon</a>?', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_TextField('touch_icon_72');
				$thb_field->setLabel( __('Apple Touch Icon 72&times;72', 'thb_text_domain') );
				$thb_field->setHelp( __('Paste here the URL of your custom 72&times;72px Apple Touch Icon.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_TextField('touch_icon_114');
				$thb_field->setLabel( __('Apple Touch Icon 114&times;114', 'thb_text_domain') );
				$thb_field->setHelp( __('Paste here the URL of your custom 114&times;114px Apple Touch Icon.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_TextField('touch_icon_144');
				$thb_field->setLabel( __('Apple Touch Icon 144&times;144', 'thb_text_domain') );
				$thb_field->setHelp( __('Paste here the URL of your custom 144&times;144px Apple Touch Icon.', 'thb_text_domain') );
			$thb_container->addField($thb_field);
		}

	$thb_page->addTab($thb_tab);
}

/**
 * Bootstrap.
 * -----------------------------------------------------------------------------
 */

if( ! function_exists( 'thb_feed' ) ) {
	/**
	 * Print the RSS feed tag in header.
	 */
	function thb_feed() {
		$feed = thb_get_option( 'rss_alternate' );
		$feed = esc_attr( $feed );

		if( $feed != '' ) {
			thb_link( 'alternate', $feed, 'application/rss+xml', array(), get_bloginfo('name') . ' ' . __('RSS Feed', 'thb_text_domain') );
		}
	}

	add_action( 'wp_head', 'thb_feed' );
}


if( !function_exists('thb_icons') ) {
	/**
	 * Print favicon and touch icons in header.
	 */
	function thb_icons() {
		$favicon = thb_get_option('favicon');
		$touch_icon_57 = thb_get_option('touch_icon_57');
		$touch_icon_72 = thb_get_option('touch_icon_72');
		$touch_icon_114 = thb_get_option('touch_icon_114');
		$touch_icon_144 = thb_get_option('touch_icon_144');

		$favicon        = esc_attr( $favicon );
		$touch_icon_57  = esc_attr( $touch_icon_57 );
		$touch_icon_72  = esc_attr( $touch_icon_72 );
		$touch_icon_114 = esc_attr( $touch_icon_114 );
		$touch_icon_144 = esc_attr( $touch_icon_144 );

		if( !empty( $favicon ) ) {
			thb_link('Shortcut Icon', $favicon, 'image/x-icon');
		}

		if( !empty( $touch_icon_57 ) ) {
			thb_link('apple-touch-icon', $touch_icon_57, null, array('sizes' => '57x57'));
		}

		if( !empty( $touch_icon_72 ) ) {
			thb_link('apple-touch-icon', $touch_icon_72, null, array('sizes' => '72x72'));
		}

		if( !empty( $touch_icon_114 ) ) {
			thb_link('apple-touch-icon', $touch_icon_114, null, array('sizes' => '114x114'));
		}

		if( !empty( $touch_icon_144 ) ) {
			thb_link('apple-touch-icon', $touch_icon_144, null, array('sizes' => '144x144'));
		}
	}

	add_action( 'wp_head', 'thb_icons' );
}

if( ! function_exists('thb_google_analytics') ) {
	/**
	 * Print the Google Analytics tracking code in footer.
	 */
	function thb_google_analytics() {
		if ( thb_config( 'backpack/general', 'analytics' ) ) {
			$analytics = stripslashes( thb_get_option('analytics') );
			if( !empty($analytics) ) {
				echo $analytics;
			}
		}
	}

	add_action('wp_footer', 'thb_google_analytics');
}