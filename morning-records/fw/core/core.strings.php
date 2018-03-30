<?php
/**
 * Morning records Framework: strings manipulations
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Check multibyte functions
if ( ! defined( 'MORNING_RECORDS_MULTIBYTE' ) ) define( 'MORNING_RECORDS_MULTIBYTE', function_exists('mb_strpos') ? 'UTF-8' : false );

if (!function_exists('morning_records_strlen')) {
	function morning_records_strlen($text) {
		return MORNING_RECORDS_MULTIBYTE ? mb_strlen($text) : strlen($text);
	}
}

if (!function_exists('morning_records_strpos')) {
	function morning_records_strpos($text, $char, $from=0) {
		return MORNING_RECORDS_MULTIBYTE ? mb_strpos($text, $char, $from) : strpos($text, $char, $from);
	}
}

if (!function_exists('morning_records_strrpos')) {
	function morning_records_strrpos($text, $char, $from=0) {
		return MORNING_RECORDS_MULTIBYTE ? mb_strrpos($text, $char, $from) : strrpos($text, $char, $from);
	}
}

if (!function_exists('morning_records_substr')) {
	function morning_records_substr($text, $from, $len=-999999) {
		if ($len==-999999) { 
			if ($from < 0)
				$len = -$from; 
			else
				$len = morning_records_strlen($text)-$from;
		}
		return MORNING_RECORDS_MULTIBYTE ? mb_substr($text, $from, $len) : substr($text, $from, $len);
	}
}

if (!function_exists('morning_records_strtolower')) {
	function morning_records_strtolower($text) {
		return MORNING_RECORDS_MULTIBYTE ? mb_strtolower($text) : strtolower($text);
	}
}

if (!function_exists('morning_records_strtoupper')) {
	function morning_records_strtoupper($text) {
		return MORNING_RECORDS_MULTIBYTE ? mb_strtoupper($text) : strtoupper($text);
	}
}

if (!function_exists('morning_records_strtoproper')) {
	function morning_records_strtoproper($text) { 
		$rez = ''; $last = ' ';
		for ($i=0; $i<morning_records_strlen($text); $i++) {
			$ch = morning_records_substr($text, $i, 1);
			$rez .= morning_records_strpos(' .,:;?!()[]{}+=', $last)!==false ? morning_records_strtoupper($ch) : morning_records_strtolower($ch);
			$last = $ch;
		}
		return $rez;
	}
}

if (!function_exists('morning_records_strrepeat')) {
	function morning_records_strrepeat($str, $n) {
		$rez = '';
		for ($i=0; $i<$n; $i++)
			$rez .= $str;
		return $rez;
	}
}

if (!function_exists('morning_records_strshort')) {
	function morning_records_strshort($str, $maxlength, $add='...') {
	//	if ($add && morning_records_substr($add, 0, 1) != ' ')
	//		$add .= ' ';
		if ($maxlength < 0) 
			return $str;
		if ($maxlength == 0) 
			return '';
		if ($maxlength >= morning_records_strlen($str)) 
			return strip_tags($str);
		$str = morning_records_substr(strip_tags($str), 0, $maxlength - morning_records_strlen($add));
		$ch = morning_records_substr($str, $maxlength - morning_records_strlen($add), 1);
		if ($ch != ' ') {
			for ($i = morning_records_strlen($str) - 1; $i > 0; $i--)
				if (morning_records_substr($str, $i, 1) == ' ') break;
			$str = trim(morning_records_substr($str, 0, $i));
		}
		if (!empty($str) && morning_records_strpos(',.:;-', morning_records_substr($str, -1))!==false) $str = morning_records_substr($str, 0, -1);
		return ($str) . ($add);
	}
}

// Clear string from spaces, line breaks and tags (only around text)
if (!function_exists('morning_records_strclear')) {
	function morning_records_strclear($text, $tags=array()) {
		if (empty($text)) return $text;
		if (!is_array($tags)) {
			if ($tags != '')
				$tags = explode($tags, ',');
			else
				$tags = array();
		}
		$text = trim(chop($text));
		if (is_array($tags) && count($tags) > 0) {
			foreach ($tags as $tag) {
				$open  = '<'.esc_attr($tag);
				$close = '</'.esc_attr($tag).'>';
				if (morning_records_substr($text, 0, morning_records_strlen($open))==$open) {
					$pos = morning_records_strpos($text, '>');
					if ($pos!==false) $text = morning_records_substr($text, $pos+1);
				}
				if (morning_records_substr($text, -morning_records_strlen($close))==$close) $text = morning_records_substr($text, 0, morning_records_strlen($text) - morning_records_strlen($close));
				$text = trim(chop($text));
			}
		}
		return $text;
	}
}

// Return slug for the any title string
if (!function_exists('morning_records_get_slug')) {
	function morning_records_get_slug($title) {
		return morning_records_strtolower(str_replace(array('\\','/','-',' ','.'), '_', $title));
	}
}

// Replace macros in the string
if (!function_exists('morning_records_strmacros')) {
	function morning_records_strmacros($str) {
		return str_replace(array("{{", "}}", "((", "))", "||"), array("<i>", "</i>", "<b>", "</b>", "<br>"), $str);
	}
}

// Unserialize string (try replace \n with \r\n)
if (!function_exists('morning_records_unserialize')) {
	function morning_records_unserialize($str) {
		if ( is_serialized($str) ) {
			try {
				$data = unserialize($str);
			} catch (Exception $e) {
				dcl($e->getMessage());
				$data = false;
			}
			if ($data===false) {
				try {
					$data = @unserialize(str_replace("\n", "\r\n", $str));
				} catch (Exception $e) {
					dcl($e->getMessage());
					$data = false;
				}
			}
			//if ($data===false) $data = @unserialize(str_replace(array("\n", "\r"), array('\\n','\\r'), $str));
			return $data;
		} else
			return $str;
	}
}
?>