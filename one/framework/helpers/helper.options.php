<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Options helpers.
 *
 * This file contains options-related utility functions.
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

/**
 * Get an option.
 *
 * @param string $key The option key.
 * @return string/array/false
 */
if( !function_exists('thb_get_option') ) {
	function thb_get_option( $key ) {
		// $theme = thb_theme();
		// $options = $theme->getOptions();
		$options = get_option( THB_OPTIONS_KEY );

		if( isset($options[$key]) ) {
			return $options[$key];
		}

		return false;
	}
}

/**
 * Save an option.
 *
 * @param string $key The option key.
 * @param string $value The option value.
 */
if( !function_exists('thb_save_option') ) {
	function thb_save_option( $key, $value ) {
		thb_theme()->saveOptions( array(
			$key => $value
		) );
	}
}