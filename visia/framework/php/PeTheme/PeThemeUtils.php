<?php

class PeThemeUtils {

	public function truncateString($string, $length = 80, $etc = '', $break_words = false) {
		if ($etc == "break") {
			$break_words = TRUE;
			$etc = "...";
		} 
		$start = 0; 
		// Set the replacement for the "string break" in the wordwrap function
		$cutmarker = "**cut_here**"; 
		// Checking if the given string is longer than $maxlength
		if (strlen($string) > $length) {
			if ($break_words) return substr($string, 0, $length-3) . $etc; 
			// Using wordwrap() to set the cutmarker
			// NOTE: wordwrap (PHP 4 >= 4.0.2, PHP 5)
			$string = wordwrap($string, $length, $cutmarker); 
			// Exploding the string at the cutmarker, set by wordwrap()
			$string = explode($cutmarker, $string); 
			// Adding $extension to the first value of the array $string, returned by explode()
			$string = $string[0] . $etc;
		}
		// returning $string
		return $string;
	}

	public function getAttributes($options) {
		$attr = "";
		if (is_array($options)) {
			foreach ($options as $key => $val) {
				$attr .= sprintf(' data-%s="%s"',esc_attr($key),esc_attr($val));
			}
		}
		return $attr;
	}

	// http://www.bangheadonwall.net/?attachment_id=227
	public static function &fix_serialize($broken) {
		$fixed = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $broken);		
		return $fixed;
	}

	public static function dos2unix(&$value,$key) {
		if (is_string($value)) {
			$value = str_replace("\r\n","\n",$value);
		}
	}


}

?>