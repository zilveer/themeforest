<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Array helpers.
 *
 * This file contains utility functions concerning array manipulation.
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

if( ! function_exists( 'thb_array_explode' ) ) {
	/**
	 * Explode an array.
	 * @param  array $arr
	 * @param  string $delimiter
	 * @return array
	 */
	function thb_array_explode( $arr, $delimiter = ',' ) {
		$exploded = (array) explode( $delimiter, $arr );

		if ( $exploded[0] == '' ) {
			return array();
		}

		return $exploded;
	}
}

if( ! function_exists( 'thb_array_is_assoc' ) ) {
	/**
	 * Check if an array is associative.
	 *
	 * @param array $array
	 * @return boolean
	 */
	function thb_array_is_assoc( $array ) {
		return (bool) count( array_filter( array_keys( $array ), 'is_string' ) );
	}
}

if( ! function_exists( 'thb_array_remove' ) ) {
	/**
	 * Remove an array of elements from an array.
	 *
	 * @param array &$array The original array.
	 * @param array $value The elements about to be inserted.
	 * @return array
	 */
	function thb_array_remove( &$arr, $value=array() ) {
		foreach( $value as $val ) {
			$i = array_search($val, $arr);

			if( $i != -1 ) {
				unset($arr[$i]);
			}
		}

		return $arr;
	}
}

if( ! function_exists( 'thb_array_insert' ) ) {
	/**
	 * Insert an element into an array at a specific position.
	 *
	 * @param array &$array The original array.
	 * @param Mixed $element The element about to be inserted.
	 * @param int $position The insertion index.
	 * @return array
	 */
	function thb_array_insert( &$array, $element, $position=null ) {
		if (count($array) == 0) {
			$array[] = $element;
		}
		elseif (is_numeric($position) && $position < 0) {
			if((count($array)+$position) < 0) {
				$array = array_insert($array,$element,0);
			}
			else {
				$array[count($array)+$position] = $element;
			}
		}
		elseif (is_numeric($position) && isset($array[$position])) {
			$part1 = array_slice($array,0,$position,true);
			$part2 = array_slice($array,$position,null,true);
			$array = array_merge($part1,array($position=>$element),$part2);
			foreach($array as $key=>$item) {
				if (is_null($item)) {
					unset($array[$key]);
				}
			}
		}
		elseif (is_null($position)) {
			$array[] = $element;
		}
		elseif (!isset($array[$position])) {
			$array[$position] = $element;
		}

		$array = array_merge($array);

		return $array;
	}
}

if( ! function_exists( 'thb_array_contains' ) ) {
	/**
	 * Check if the $arr array contains the $needle element.
	 *
	 * @param mixed $needle The needle element to search for
	 * @param array $arr The haystack array
	 * @return boolean
	 **/
	function thb_array_contains( $needle, $arr ) {
		return array_search($needle, $arr) !== false;
	}
}

if( ! function_exists( 'thb_array_depth' ) ) {
	/**
	 * Get the depth level of a given array.
	 *
	 * @param array $array
	 * @return integer
	 */
	function thb_array_depth( $array ) {
		$max_depth = 1;

		if( ! is_array($array) ) {
			return (int) $max_depth;
		}

		foreach( $array as $value ) {
			if( is_array( $value ) ) {
				$depth = thb_array_depth($value) + 1;

				if( $depth > $max_depth ) {
					$max_depth = $depth;
				}
			}
		}

		return (int) $max_depth;
	}
}

if( !function_exists('thb_array_asum') ) {
	/**
	 * Sum two associative arrays. Elements from the first array are overwritten by the
	 * corresponding elements of the second array, and the remaining elements of
	 * the second array will also be included in the returned array.
	 *
	 * @param array $arr The starting array.
	 * @param array $extend The extending array.
	 * @param boolean $exclude_empty True if empty values should be excluded.
	 * @return array
	 */
	function thb_array_asum( $arr, $extend, $exclude_empty=false ) {
		$return = array();

		foreach( $arr as $k => $v ) {
			$value = $arr[$k];

			if( isset($extend[$k]) ) {
				if( $extend[$k] !== '' || !$exclude_empty ) {
					$value = $extend[$k];
				}
			}

			$return[$k] = $value;
		}

		foreach( $extend as $k => $v ) {
			if( !isset($return[$k]) ) {
				if( $v !== '' || !$exclude_empty ) {
					$return[$k] = $v;
				}
			}
		}

		return $return;
	}
}

if ( ! function_exists( 'thb_sanitize' ) ) {
	/**
	 * Sanitize a value according to the specified sanitization method.
	 *
	 * @param mixed $value
	 * @param string $method
	 * @return mixed
	 */
	function thb_sanitize( $value, $method ) {
		switch ( $method ) {
			case 'integer':
				$value = (int) intval( $value );
				break;
			case 'absint':
				$value = (int) absint( $value );
				break;
			case 'string':
				$value = sanitize_text_field( $value );
				break;
			default:
				if ( is_string( $method ) && is_callable( $method ) ) {
					$value = call_user_func( $method, $value );
				}
				break;
		}

		return $value;
	}
}

if ( ! function_exists( 'thb_isset' ) ) {
	/**
	 * Check if a variable exists, or return a default value.
	 *
	 * @param array $array
	 * @param mixed $key
	 * @param mixed $default
	 * @param boolean|string $sanitize False, or "integer"/"absint"/"string"
	 * @return mixed
	 */
	function thb_isset( $array, $key, $default, $sanitize = false ) {
		$value = $default;

		if ( isset( $array[$key] ) ) {
			$value = $array[$key];

			if ( $sanitize !== false ) {
				$value = thb_sanitize( $value, $sanitize );
			}
		}

		return $value;
	}
}

if ( ! function_exists( 'thb_input_get' ) ) {
	/**
	 * Get a value from the GET input array.
	 *
	 * @param string $key
	 * @param string $sanitize
	 * @param mixed $default
	 */
	function thb_input_get( $key, $sanitize = 'string', $default = false ) {
		return thb_isset( $_GET, $key, $default, $sanitize );
	}
}

if ( ! function_exists( 'thb_input_post' ) ) {
	/**
	 * Get a value from the POST input array.
	 *
	 * @param string $key
	 * @param string $sanitize
	 * @param mixed $default
	 */
	function thb_input_post( $key, $sanitize = 'string', $default = false ) {
		return thb_isset( $_POST, $key, $default, $sanitize );
	}
}