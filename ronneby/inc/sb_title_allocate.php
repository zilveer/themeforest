<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class SB_Title_Allocate {

	private static function sb_mb_substr_replace($string, $replacement, $start, $length = null, $encoding = null) {
		if ($encoding == null)
			$encoding = mb_internal_encoding();
		if ($length == null) {
			return mb_substr($string, 0, $start, $encoding) . $replacement;
		} else {
			if ($length < 0)
				$length = mb_strlen($string, $encoding) - $start + $length;
			return
					mb_substr($string, 0, $start, $encoding) .
					$replacement .
					mb_substr($string, $start + $length, mb_strlen($string, $encoding), $encoding);
		}
	}

	private static function sb_strrpos($haystack = '', $needle = '', $need_count = 1) {
		$count = 0;

		if (!empty($haystack) && !empty($needle)) {
			for ($i = mb_strlen($haystack); $i >= 0; $i--) {
				if (mb_substr($haystack, $i, 1) === $needle) {
					$count++;
				}

				if ($count === $need_count) {
					return $i;
				}
			}
		}

		return false;
	}
	
	public static function wrap_last_worlds($text, $wrap_before = '', $wrap_after = '') {
		if (empty($text))
			return $text;
		
		$text = trim(str_replace('  ', '', $text));
		
		$whitespaces = substr_count($text, ' ');
		
		if ($whitespaces > 1) {
			$text = preg_replace('/\s(\S+)\s(\S+)$/', " {$wrap_before}\$1 \$2{$wrap_after}", $text);
		} elseif($whitespaces == 1){
			$text = str_replace(' ', ' '.$wrap_before, $text).$wrap_after;
		}
		
		return $text;
	}
	
	public static function wrap_rand_letter($text, $wrap_before='', $wrap_after='') {
		if (empty($text))
			return $text;
		
		$text = trim(str_replace('  ', '', $text));
		$whitespaces = substr_count($text, ' ');
		$rand_letter = $first_whitespace = 0;
		
		if ($whitespaces == 0) {
			if (mb_strlen($text)>2) {
				$rand_letter = mt_rand(0, mb_strlen($text)-1);

				$text = self::sb_mb_substr_replace($text, $wrap_before.mb_substr($text, $rand_letter, 1).$wrap_after, $rand_letter, 1);
			}
		} elseif($whitespaces == 1) {
			$first_whitespace = mb_strpos($text, ' ');
			$rand_letter = mt_rand($first_whitespace+1, mb_strlen($text)-1);
			
			$text = self::sb_mb_substr_replace($text, $wrap_before.mb_substr($text, $rand_letter, 1).$wrap_after, $rand_letter, 1);
		} else {
			$first_whitespace = self::sb_strrpos($text, ' ', 2);
			$rand_letter = mt_rand($first_whitespace+1, mb_strlen($text)-1);
			
			if (mb_substr($text, $rand_letter, 1) == ' ') {
				$rand_letter++;
			}
			
			$text = self::sb_mb_substr_replace($text, $wrap_before.mb_substr($text, $rand_letter, 1).$wrap_after, $rand_letter, 1);
		}
		
		return $text;
	}

}
