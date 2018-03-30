<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Lightbox.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Lightbox
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
	 * Lightbox adapter.
	 */
	'library' => 'magnificpopup',

	/**
	 * Options
	 */
	'options' => true,

	/**
	 * Style
	 */
	'css' => true
);
$thb_theme->setConfig( 'backpack/lightbox', thb_array_asum($thb_config, $config) );

/**
 * Theme options
 */
if ( thb_config( 'backpack/lightbox', 'options' ) ) {
	$thb_page = $thb_theme->getAdmin()->getMainPage();

		$thb_tab = new THB_Tab( __( 'Lightbox', 'thb_text_domain' ), 'lightbox' );
			$thb_container = $thb_tab->createContainer( '', 'lightbox_options' );
			// $thb_container->setIntroText( __('Powered by Magnific Popup. If you mind to use another plugin, you might want to disable this feature.', 'thb_text_domain') );

			$thb_field = new THB_CheckboxField( 'enable_lightbox' );
				$thb_field->setLabel( __('Enable lightbox', 'thb_text_domain') );
				$thb_field->setHelp( __( 'The functionality will be active on images and galleries.', 'thb_text_domain' ) );
			$thb_container->addField($thb_field);

	$thb_page->addTab($thb_tab, 40);
}

/**
 * Helpers
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_is_lightbox_enabled' ) ) {
	/**
	 * Check if the lightbox functionality is currently enabled for the theme.
	 *
	 * @return boolean
	 */
	function thb_is_lightbox_enabled() {
		$enabled = thb_get_option( 'enable_lightbox' ) == '1';

		return apply_filters( 'thb_is_lightbox_enabled', $enabled );
	}
}

/**
 * Scripts and styles
 * -----------------------------------------------------------------------------
 */
$thb_lightbox_enabled = thb_is_lightbox_enabled();

if ( ! function_exists( 'thb_lightbox_scripts' ) ) {
	function thb_lightbox_scripts( $scripts ) {
		$lightbox_config = thb_config( 'backpack/lightbox' );
		$library = $lightbox_config['library'];
		$base_path = thb_get_module_path('backpack/lightbox') . '/' . $library;

		$scripts[] = $base_path . '/js/' . $library . '.js';
		$scripts[] = thb_get_module_path('backpack/lightbox') . '/js/lightbox.js';
		$scripts[] = $base_path . '/js/lightbox.js';

		return $scripts;
	}
}

add_filter( 'thb_frontend_scripts', 'thb_lightbox_scripts' );

/**
 * Lightbox body class.
 *
 * @param  array $class
 * @return array
 */
function thb_lightbox_body_class( $class ) {
	if ( thb_is_lightbox_enabled() ) {
		$class[] = 'thb-lightbox-enabled';
	}

	return $class;
}

add_filter( 'body_class', 'thb_lightbox_body_class' );

if ( empty( $thb_lightbox_enabled ) ) {
	return;
}

$lightbox_config = thb_config( 'backpack/lightbox' );
$library = $lightbox_config['library'];
$base_url = thb_get_module_url('backpack/lightbox') . '/' . $library;

if ( thb_config( 'backpack/lightbox', 'css' ) ) {
	$thb_theme->getFrontend()->addStyle( $base_url . '/css/' . $library . '.css', array(
		'name' => $library
	));
}

if ( ! thb_compress_frontend_scripts() ) {
	$lightbox_config = thb_config( 'backpack/lightbox' );
	$library = $lightbox_config['library'];
	$base_url = thb_get_module_url('backpack/lightbox') . '/' . $library;

	$thb_theme->getFrontend()->addScript( $base_url . '/js/' . $library . '.js', array(
		'name' => $library
	));

	$thb_theme->getFrontend()->addScript( thb_get_module_url('backpack/lightbox') . '/js/lightbox.js', array(
		'name' => 'lightbox'
	));

	$thb_theme->getFrontend()->addScript( $base_url . '/js/lightbox.js', array(
		'name' => 'lightbox-' . $library
	));
}

/**
 * Image link class
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_lightbox_image_link_class') ) {
	function thb_lightbox_image_link_class( $class ) {
		$lightbox_class = apply_filters( 'thb_lightbox_class', 'thb-lightbox' );

		return trim( $class . ' ' . $lightbox_class );
	}

	add_filter( 'thb_image_link_class', 'thb_lightbox_image_link_class' );
}