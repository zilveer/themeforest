<?php
/**
 * Morning records Framework: ini-files manipulations
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//  Get value by name from .ini-file
if (!function_exists('morning_records_ini_get_value')) {
	function morning_records_ini_get_value($file, $name, $defa='') {
		if (!is_array($file)) {
			if (file_exists($file)) {
				$file = morning_records_fga($file);
			} else
				return $defa;
		}
		$name = morning_records_strtolower($name);
		$rez = $defa;
		for ($i=0; $i<count($file); $i++) {
			$file[$i] = trim($file[$i]);
			if (($pos = morning_records_strpos($file[$i], ';'))!==false)
				$file[$i] = trim(morning_records_substr($file[$i], 0, $pos));
			$parts = explode('=', $file[$i]);
			if (count($parts)!=2) continue;
			if (morning_records_strtolower(trim(chop($parts[0])))==$name) {
				$rez = trim(chop($parts[1]));
				if (morning_records_substr($rez, 0, 1)=='"')
					$rez = morning_records_substr($rez, 1, morning_records_strlen($rez)-2);
				else
					$rez *= 1;
				break;
			}
		}
		return $rez;
	}
}

//  Retrieve all values from .ini-file as assoc array
if (!function_exists('morning_records_ini_get_values')) {
	function morning_records_ini_get_values($file) {
		$rez = array();
		if (!is_array($file)) {
			if (file_exists($file)) {
				$file = morning_records_fga($file);
			} else
				return $rez;
		}
		for ($i=0; $i<count($file); $i++) {
			$file[$i] = trim(chop($file[$i]));
			if (($pos = morning_records_strpos($file[$i], ';'))!==false)
				$file[$i] = trim(morning_records_substr($file[$i], 0, $pos));
			$parts = explode('=', $file[$i]);
			if (count($parts)!=2) continue;
			$key = trim(chop($parts[0]));
			$rez[$key] = trim($parts[1]);
			if (morning_records_substr($rez[$key], 0, 1)=='"')
				$rez[$key] = morning_records_substr($rez[$key], 1, morning_records_strlen($rez[$key])-2);
			else
				$rez[$key] *= 1;
		}
		return $rez;
	}
}
?>