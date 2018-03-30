<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Translation helpers.
 *
 * Utility functions to translate text.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( !function_exists('thb_load_admin_translation') ) {
	/**
	 * Load the administration translation.
	 */
	function thb_load_admin_translation() {
		/**
		 * Framework translation
		 */
		if( defined('QT_SUPPORTED_WP_VERSION') ) {
			// qTranslate
			global $q_config;
			$thb_admin_language = $q_config['locale'][$q_config['language']];
		}
		else if( defined('ICL_LANGUAGE_CODE') ) {
			// WPML
			$thb_admin_language = get_locale();
		}
		else {
			$thb_admin_language = defined( 'WPLANG' ) ? WPLANG : 'en_US';
		}

		$thb_admin_default_language = 'en_US';

		$thb_admin = thb_theme()->getAdmin();
		$thb_admin->setLanguage($thb_admin_language);
		$thb_admin->setDefaultLanguage($thb_admin_default_language);
	}
}

if( ! function_exists( 'thb_admin_inline_strings' ) ) {
	/**
	 * Return the translated inline strings.
	 *
	 * @return array
	 */
	function thb_admin_inline_strings() {
		$thb_theme = thb_theme();
		$thb_admin = $thb_theme->getAdmin();
		$thb_admin_language = $thb_admin->getLanguage();
		$thb_admin_default_language = $thb_admin->getDefaultLanguage();

		// JavaScript translation
		$file = 'strings.php';
		$strings = THB_LANGUAGES_DIR . '/' . $thb_admin_language . '/' . $file;

		if( !file_exists($strings) ) {
			$strings = THB_LANGUAGES_DIR . '/' . $thb_admin_default_language . '/' . $file;
		}

		return require_once( $strings );
	}
}