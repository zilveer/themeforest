<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Text helpers.
 *
 * Utility functions to manipulate text.
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
 * Check if the $str string contains the $needle string.
 *
 * @param string $needle The needle string to search for
 * @param string $haystack The haystack string
 * @return boolean
 **/
if( !function_exists('thb_text_contains') ) {
	function thb_text_contains( $needle, $haystack ) {
		return strpos($haystack, $needle) !== false;
	}
}

/**
 * Decode the string for HTML form output
 *
 * @param string $str The string to be decoded
 * @return string
 **/
if( ! function_exists('thb_text_toForm') ) {
	function thb_text_toForm( $str ) {
		$str = htmlspecialchars( $str, ENT_QUOTES );
		return $str;
	}
}

/**
 * Encode the string for DB save
 *
 * @param string $str The string to be decoded
 * @return string
 **/
if( ! function_exists('thb_text_toDB') ) {
	function thb_text_toDB( $str ) {
		$str = stripslashes( $str );
		return $str;
	}
}

/**
 * Check if the $str string ends with the $needle string.
 *
 * @param string $haystack The haystack string
 * @param string $needle The needle string to search in
 * @return boolean
 * @throws Exception
 **/
if( ! function_exists('thb_text_endsWith') ) {
	function thb_text_endsWith( $haystack, $needle ) {
		if( empty($haystack) || empty($needle) ) {
			return false;
		}

		$length = strlen($needle);
		$start = $length * -1;
		return substr($haystack, $start) === $needle;
	}
}

/**
 * Check if the $str string starts with the $needle string.
 *
 * @param string $haystack The haystack string
 * @param string $needle The needle string to search in
 * @return boolean
 * @throws Exception
 **/
if( !function_exists('thb_text_startsWith') ) {
	function thb_text_startsWith( $haystack, $needle ) {
		if( empty($haystack) || empty($needle) ) {
			return false;
		}

		$length = strlen($needle);
		return substr($haystack, 0, $length) === $needle;
	}
}

/**
 * Transform a string into a slug.
 *
 * @param string $str The string to be transformed
 * @return string
 **/
if( !function_exists('thb_text_slugify') ) {
	function thb_text_slugify( $str ) {
		return sanitize_title($str);
	}
}

if( !function_exists('thb_do_shortcode') ) {
	function thb_do_shortcode($str) {

		$str = do_shortcode( shortcode_unautop( $str ) );
		$str = preg_replace('#^<\/p>|<\/p>$|^<br\s?\/?>|<br\s?\/?>$|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $str);
		return $str;

	}
}

/**
 * Format a string.
 *
 * @param string $str The string to be formatted.
 * @param boolean $add_paragraphs True to turn double line breaks into paragraphs.
 * @return string
 */
if( !function_exists('thb_text_format') ) {
	function thb_text_format( $str, $add_paragraphs=false ) {
		$str = wptexturize(thb_do_shortcode($str));

		if( $add_paragraphs ) {
			$str = thb_add_paragraphs($str);
		}

		$str = apply_filters('thb_text_format', $str);

		return $str;
	}
}

if( !function_exists('thb_text_truncate') ) {
	/**
	 * Truncate a string after n characters, ending the resulting string with an ellipsis.
	 *
	 * @param string $str The original string to truncate
	 * @param int $characters The number of character after which the string must be truncated
	 * @param string $end_char The string to be appended upon truncating
	 * @return string
	 * @throws Exception
	 **/
	function thb_text_truncate( $str, $characters, $end_char='&hellip;' ) {
		if( empty($characters) ) {
			wp_die('Empty number of characters');
		}

		$characters = (int) $characters;

		if( !is_numeric($characters) ) {
			wp_die('Wrong characters format');
		}

		$str = strip_tags($str);

		$length = strlen($str);
		if( $length > $characters ) {
			return substr($str, 0, $characters) . $end_char;
		}

		return $str;
	}
}

if( ! function_exists('thb_text_normalize') ) {
	/**
	 * Normalize a string's line breaks.
	 *
	 * @param string $string
	 * @return string
	 */
	function thb_text_normalize( $string ) {
		$string = str_replace("\r\n", "\n", $string);
		$string = str_replace("\r", "\n", $string);
		$string = preg_replace("/\n{2,}/", "\n\n", $string);
		return $string;
	}
}

if( ! function_exists('thb_add_paragraphs') ) {
	/**
	 * Replaces double line-breaks with paragraph elements.
	 *
	 * @param string $original_str The text which has to be formatted.
	 * @param bool $br Optional. If set, this will convert all remaining line-breaks after paragraphing. Default true.
	 * @return string Text which has been converted into correct paragraph tags.
	 */
	function thb_add_paragraphs($original_str, $br = true) {
		$pre_tags = array();

		if ( trim($original_str) === '' )
			return '';

		$original_str = $original_str . "\n"; // just to make things a little easier, pad the end

		if ( strpos($original_str, '<pre') !== false ) {
			$original_str_parts = explode( '</pre>', $original_str );
			$last_original_str = array_pop($original_str_parts);
			$original_str = '';
			$i = 0;

			foreach ( $original_str_parts as $original_str_part ) {
				$start = strpos($original_str_part, '<pre');

				// Malformed html?
				if ( $start === false ) {
					$original_str .= $original_str_part;
					continue;
				}

				$name = "<pre wp-pre-tag-$i></pre>";
				$pre_tags[$name] = substr( $original_str_part, $start ) . '</pre>';

				$original_str .= substr( $original_str_part, 0, $start ) . $name;
				$i++;
			}

			$original_str .= $last_original_str;
		}

		$original_str = preg_replace('|<br />\s*<br />|', "\n\n", $original_str);
		// Space things out a little
		$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|noscript|legend|section|article|aside|hgroup|header|footer|nav|figure|details|menu|summary)';
		$original_str = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $original_str);
		$original_str = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $original_str);
		$original_str = str_replace(array("\r\n", "\r"), "\n", $original_str); // cross-platform newlines

		if ( strpos( $original_str, '</object>' ) !== false ) {
			// no P/BR around param and embed
			$original_str = preg_replace( '|(<object[^>]*>)\s*|', '$1', $original_str );
			$original_str = preg_replace( '|\s*</object>|', '</object>', $original_str );
			$original_str = preg_replace( '%\s*(</?(?:param|embed)[^>]*>)\s*%', '$1', $original_str );
		}

		if ( strpos( $original_str, '<source' ) !== false || strpos( $original_str, '<track' ) !== false ) {
			// no P/BR around source and track
			$original_str = preg_replace( '%([<\[](?:audio|video)[^>\]]*[>\]])\s*%', '$1', $original_str );
			$original_str = preg_replace( '%\s*([<\[]/(?:audio|video)[>\]])%', '$1', $original_str );
			$original_str = preg_replace( '%\s*(<(?:source|track)[^>]*>)\s*%', '$1', $original_str );
		}

		$original_str = preg_replace("/\n\n+/", "\n\n", $original_str); // take care of duplicates
		// make paragraphs, including one at the end
		$original_strs = preg_split('/\n\s*\n/', $original_str, -1, PREG_SPLIT_NO_EMPTY);
		$original_str = '';

		foreach ( $original_strs as $tinkle ) {
			$original_str .= '<p>' . trim($tinkle, "\n") . "</p>\n";
		}

		$original_str = preg_replace('|<p>\s*</p>|', '', $original_str); // under certain strange conditions it could create a P of entirely whitespace
		$original_str = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $original_str);
		$original_str = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $original_str); // don't original_str all over a tag
		$original_str = preg_replace("|<p>(<li.+?)</p>|", "$1", $original_str); // problem with nested lists
		$original_str = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $original_str);
		$original_str = str_replace('</blockquote></p>', '</p></blockquote>', $original_str);
		$original_str = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $original_str);
		$original_str = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $original_str);

		if ( $br ) {
			$original_str = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $original_str);
			$original_str = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $original_str); // optionally make line breaks
			$original_str = str_replace('<WPPreserveNewline />', "\n", $original_str);
		}

		$original_str = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $original_str);
		$original_str = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $original_str);
		$original_str = preg_replace( "|\n</p>$|", '</p>', $original_str );

		if ( !empty($pre_tags) )
			$original_str = str_replace(array_keys($pre_tags), array_values($pre_tags), $original_str);

		return $original_str;
	}
}

/**
 * Split a string by line and return it with each line wrapped in an HTML tag.
 *
 * @param string $string The string.
 * @param string $before The tag to be prepended before each line.
 * @param string $after The tag to be appended after each line.
 * @return string
 */
if( !function_exists('thb_wrap_lines') ) {
	function thb_wrap_lines( $string, $before='', $after='' ) {
		if( empty($string) ) {
			return '';
		}

		$lines = explode("\n", $string);
		$return = '';

		foreach( $lines as $line ) {
			$return .= $before . $line . $after;
		}

		return $return;
	}
}