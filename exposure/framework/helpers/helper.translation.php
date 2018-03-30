<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Translation helpers.
 *
 * Utility functions to translate text.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Fetch the translated string in the current language.
 *
 * @param string $key The string key to look for.
 * @return string
 */
if( !function_exists('thb_lang') ) {
	function thb_lang( $key ) {
		global $thb_lang;
		$translation = $key;

		if( isset($thb_lang[$key]) && $thb_lang[$key] != '' ) {
			$translation = $thb_lang[$key];
		}
		else {
			if( defined('THB_DEBUG') && THB_DEBUG === true || thb_is_super_user() ) {
				$translation = '<span style="background: red; color: white;">' . $translation . '</span>';
			}
		}

		return $translation;
	}
}

/**
 * Return the translation for the given key.
 *
 * @param string $key The string key.
 * @param array $params Sprintf additional params.
 * @return string
 */
if( !function_exists('_t') ) {
	function _t( $key, $params=array() ) {
		$translation = thb_lang($key);

		$sprintf_params = array($translation);
		foreach( $params as $param ) {
			$sprintf_params[] = $param;
		}

		return call_user_func_array('sprintf', $sprintf_params);
	}
}

/**
 * Echo the translation for the given key.
 *
 * @param string $key The string key.
 * @param array $params Sprintf additional params.
 * @return void
 */
if( !function_exists('_te') ) {
	function _te( $key, $params=array() ) {
		echo _t($key, $params);
	}
}

/**
 * Load the administration translation.
 *
 * @return void
 */
if( !function_exists('thb_load_admin_translation') ) {
	function thb_load_admin_translation() {
		global $thb_lang;

		$thb_theme = thb_theme();
		$thb_admin = $thb_theme->getAdmin();
		$thb_admin_language = $thb_admin->getLanguage();
		$thb_admin_default_language = $thb_admin->getDefaultLanguage();

		// Strings translation
		$file = 'strings.php';	
		$strings = THB_LANGUAGES_DIR . '/' . $thb_admin_language . '/' . $file;
		if( !file_exists($strings) ) {
			$strings = THB_LANGUAGES_DIR . '/' . $thb_admin_default_language . '/' . $file;
		}

		include $strings;

		// JavaScript translation
		$file = 'strings.js';
		$strings = THB_LANGUAGES_DIR . '/' . $thb_admin_language . '/' . $file;
		$strings_url = THB_LANGUAGES_URL . '/' . $thb_admin_language . '/' . $file;
		if( !file_exists($strings) ) {
			$strings = THB_LANGUAGES_DIR . '/' . $thb_admin_default_language . '/' . $file;
			$strings_url = THB_LANGUAGES_URL . '/' . $thb_admin_default_language . '/' . $file;
		}

		$thb_admin->addScript($strings_url);
	}
}