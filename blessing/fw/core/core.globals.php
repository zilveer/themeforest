<?php
/**
 * Ancora Framework: global variables storage
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get global variable
if (!function_exists('ancora_get_global')) {
	function ancora_get_global($var_name) {
		global $ANCORA_GLOBALS;
		return isset($ANCORA_GLOBALS[$var_name]) ? $ANCORA_GLOBALS[$var_name] : '';
	}
}

// Set global variable
if (!function_exists('ancora_set_global')) {
	function ancora_set_global($var_name, $value) {
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS[$var_name] = $value;
	}
}

// Inc/Dec global variable with specified value
if (!function_exists('ancora_inc_global')) {
	function ancora_inc_global($var_name, $value=1) {
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS[$var_name] += $value;
	}
}

// Concatenate global variable with specified value
if (!function_exists('ancora_concat_global')) {
	function ancora_concat_global($var_name, $value) {
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS[$var_name] .= $value;
	}
}

// Get global array element
if (!function_exists('ancora_get_global_array')) {
	function ancora_get_global_array($var_name, $key) {
		global $ANCORA_GLOBALS;
		return isset($ANCORA_GLOBALS[$var_name][$key]) ? $ANCORA_GLOBALS[$var_name][$key] : '';
	}
}

// Set global array element
if (!function_exists('ancora_set_global_array')) {
	function ancora_set_global_array($var_name, $key, $value) {
		global $ANCORA_GLOBALS;
		if (!isset($ANCORA_GLOBALS[$var_name])) $ANCORA_GLOBALS[$var_name] = array();
		$ANCORA_GLOBALS[$var_name][$key] = $value;
	}
}

// Inc/Dec global array element with specified value
if (!function_exists('ancora_inc_global_array')) {
	function ancora_inc_global_array($var_name, $key, $value=1) {
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS[$var_name][$key] += $value;
	}
}

// Concatenate global array element with specified value
if (!function_exists('ancora_concat_global_array')) {
	function ancora_concat_global_array($var_name, $key, $value) {
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS[$var_name][$key] .= $value;
	}
}
?>