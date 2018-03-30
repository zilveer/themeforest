<?php

/**
 * Basic wrappers around WP core functions
 *
 * This file is loaded early by the theme
 *
 * @package wpv
 */

/**
 * get_option wrapper
 *
 * @uses   get_option()
 *
 * @param  string $name option   name
 * @param  mixed  $default       default value
 * @param  bool   $stripslashes  whether to filter the result with stripslashes()
 *
 * @return mixed                 option value
 */

function wpv_get_option($name, $default = null, $stripslashes = true) {
	global $wpv_defaults;

	$default_arg = $default;
	if($default === null) {
		$default = isset($wpv_defaults[$name]) ? $wpv_defaults[$name] : false;
	}

	$option = get_option('wpv_'.$name, $default);

	if(is_string($option)) {
		if($option === 'true')
			return true;

		if($option === 'false')
			return false;

		if ( $stripslashes && $option !== $default_arg )
			return stripslashes($option);
	}

	return $option;
}

/**
 * Same as wpv_get_option, but converts '1' and '0' to booleans
 *
 * @uses   wpv_get_option()
 *
 * @param  string $name option   name
 * @param  mixed  $default       default value
 * @param  bool   $stripslashes  whether to filter the result with stripslashes()
 *
 * @return mixed                 option value
 */
function wpv_get_optionb($name, $default = null, $stripslashes = true) {
	$value = wpv_get_option($name, $default, $stripslashes);

	if($value === '1' || $value === 'true')
		return true;

	if($value === '0' || $value === 'false')
		return false;

	return $value;
}

/**
 * Same as wpv_get_option, but echoes the value instead of returning it
 *
 * @uses   wpv_get_option()
 *
 * @param  string $name option   name
 * @param  mixed  $default       default value
 * @param  bool   $stripslashes  whether to filter the result with stripslashes()
 * @param  boolean $boolean      whether to cast the value to bool
 */
function wpvge($name, $default = null, $stripslashes = true, $boolean = false) {
	$opt = wpv_get_option($name, $default, $stripslashes);

	if($boolean === true) {
		$opt = (bool)$opt;
	}

	echo $opt;
}

/**
 * update_option() wrapper
 *
 * @uses   update_option()
 *
 * @param  string $name      option name
 * @param  mixed  $new_value option value
 */
function wpv_update_option($name, $new_value) {
	update_option('wpv_' . $name, $new_value);
}

/**
 * delete_option wrapper
 *
 * @uses   delete_option()
 *
 * @param  string $name option name
 */
function wpv_delete_option($name) {
	delete_option('wpv_' . $name);
}

/**
 * Converts '1', '0', 'true' and 'false' to booleans, otherwise returns $value
 * @param  mixed $value original value
 * @return mixed        sanitized value
 */
function wpv_sanitize_bool($value) {
	if($value === '1' || $value === 'true')
		return true;

	if($value === '0' || $value === 'false')
		return false;

	return $value;
}
