<?php
/**
 * Morning records Framework: theme variables storage
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('morning_records_storage_get')) {
	function morning_records_storage_get($var_name, $default='') {
		global $MORNING_RECORDS_STORAGE;
		return isset($MORNING_RECORDS_STORAGE[$var_name]) ? $MORNING_RECORDS_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('morning_records_storage_set')) {
	function morning_records_storage_set($var_name, $value) {
		global $MORNING_RECORDS_STORAGE;
		$MORNING_RECORDS_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('morning_records_storage_empty')) {
	function morning_records_storage_empty($var_name, $key='', $key2='') {
		global $MORNING_RECORDS_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($MORNING_RECORDS_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($MORNING_RECORDS_STORAGE[$var_name][$key]);
		else
			return empty($MORNING_RECORDS_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('morning_records_storage_isset')) {
	function morning_records_storage_isset($var_name, $key='', $key2='') {
		global $MORNING_RECORDS_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($MORNING_RECORDS_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($MORNING_RECORDS_STORAGE[$var_name][$key]);
		else
			return isset($MORNING_RECORDS_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('morning_records_storage_inc')) {
	function morning_records_storage_inc($var_name, $value=1) {
		global $MORNING_RECORDS_STORAGE;
		if (empty($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = 0;
		$MORNING_RECORDS_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('morning_records_storage_concat')) {
	function morning_records_storage_concat($var_name, $value) {
		global $MORNING_RECORDS_STORAGE;
		if (empty($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = '';
		$MORNING_RECORDS_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('morning_records_storage_get_array')) {
	function morning_records_storage_get_array($var_name, $key, $key2='', $default='') {
		global $MORNING_RECORDS_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($MORNING_RECORDS_STORAGE[$var_name][$key]) ? $MORNING_RECORDS_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($MORNING_RECORDS_STORAGE[$var_name][$key][$key2]) ? $MORNING_RECORDS_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('morning_records_storage_set_array')) {
	function morning_records_storage_set_array($var_name, $key, $value) {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if ($key==='')
			$MORNING_RECORDS_STORAGE[$var_name][] = $value;
		else
			$MORNING_RECORDS_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('morning_records_storage_set_array2')) {
	function morning_records_storage_set_array2($var_name, $key, $key2, $value) {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if (!isset($MORNING_RECORDS_STORAGE[$var_name][$key])) $MORNING_RECORDS_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$MORNING_RECORDS_STORAGE[$var_name][$key][] = $value;
		else
			$MORNING_RECORDS_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Add array element after the key
if (!function_exists('morning_records_storage_set_array_after')) {
	function morning_records_storage_set_array_after($var_name, $after, $key, $value='') {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if (is_array($key))
			morning_records_array_insert_after($MORNING_RECORDS_STORAGE[$var_name], $after, $key);
		else
			morning_records_array_insert_after($MORNING_RECORDS_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('morning_records_storage_set_array_before')) {
	function morning_records_storage_set_array_before($var_name, $before, $key, $value='') {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if (is_array($key))
			morning_records_array_insert_before($MORNING_RECORDS_STORAGE[$var_name], $before, $key);
		else
			morning_records_array_insert_before($MORNING_RECORDS_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('morning_records_storage_push_array')) {
	function morning_records_storage_push_array($var_name, $key, $value) {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($MORNING_RECORDS_STORAGE[$var_name], $value);
		else {
			if (!isset($MORNING_RECORDS_STORAGE[$var_name][$key])) $MORNING_RECORDS_STORAGE[$var_name][$key] = array();
			array_push($MORNING_RECORDS_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('morning_records_storage_pop_array')) {
	function morning_records_storage_pop_array($var_name, $key='', $defa='') {
		global $MORNING_RECORDS_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($MORNING_RECORDS_STORAGE[$var_name]) && is_array($MORNING_RECORDS_STORAGE[$var_name]) && count($MORNING_RECORDS_STORAGE[$var_name]) > 0) 
				$rez = array_pop($MORNING_RECORDS_STORAGE[$var_name]);
		} else {
			if (isset($MORNING_RECORDS_STORAGE[$var_name][$key]) && is_array($MORNING_RECORDS_STORAGE[$var_name][$key]) && count($MORNING_RECORDS_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($MORNING_RECORDS_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('morning_records_storage_inc_array')) {
	function morning_records_storage_inc_array($var_name, $key, $value=1) {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if (empty($MORNING_RECORDS_STORAGE[$var_name][$key])) $MORNING_RECORDS_STORAGE[$var_name][$key] = 0;
		$MORNING_RECORDS_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('morning_records_storage_concat_array')) {
	function morning_records_storage_concat_array($var_name, $key, $value) {
		global $MORNING_RECORDS_STORAGE;
		if (!isset($MORNING_RECORDS_STORAGE[$var_name])) $MORNING_RECORDS_STORAGE[$var_name] = array();
		if (empty($MORNING_RECORDS_STORAGE[$var_name][$key])) $MORNING_RECORDS_STORAGE[$var_name][$key] = '';
		$MORNING_RECORDS_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('morning_records_storage_call_obj_method')) {
	function morning_records_storage_call_obj_method($var_name, $method, $param=null) {
		global $MORNING_RECORDS_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($MORNING_RECORDS_STORAGE[$var_name]) ? $MORNING_RECORDS_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($MORNING_RECORDS_STORAGE[$var_name]) ? $MORNING_RECORDS_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('morning_records_storage_get_obj_property')) {
	function morning_records_storage_get_obj_property($var_name, $prop, $default='') {
		global $MORNING_RECORDS_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($MORNING_RECORDS_STORAGE[$var_name]->$prop) ? $MORNING_RECORDS_STORAGE[$var_name]->$prop : $default;
	}
}
?>