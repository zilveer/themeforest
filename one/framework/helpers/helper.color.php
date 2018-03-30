<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Color helpers.
 *
 * This file contains utility functions concerning color manipulation.
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

if( ! function_exists( 'thb_color_darken' ) ) {
	/**
	 * Darkens a color.
	 *
	 * @param string $color A string representing the hex color.
	 * @param int $dif The percentage representing the amount of light to be subtracted to the $color.
	 * @return string
	 **/
	function thb_color_darken($color, $dif=20) {
		if( !thb_text_startsWith($color, "#") ) $color = "#" . $color;

		if( $color == "#" )
			return "";

		$dif = $dif / 100;

		$colorRgb = thb_color_hexToRgb($color);
		$colorHsl =  thb_color_rgbToHsl($colorRgb);

		// Lightness
		$colorHsl[2] -= $dif;
		if( $colorHsl[2] < 0 )
			$colorHsl[2] = 0;

		$colorRgb = thb_color_hslToRgb($colorHsl);
		return thb_color_rgbToHex($colorRgb);
	}
}

if( !function_exists('thb_color_desaturate') ) {
	/**
	 * Desaturates a color.
	 *
	 * @param string $color A string representing the hex color.
	 * @param int $dif The percentage representing the amount of saturation to be subtracted to the $color.
	 * @return string
	 **/
	function thb_color_desaturate($color, $dif=20) {
		if( !thb_text_startsWith($color, "#") ) $color = "#" . $color;

		if( $color == "#" )
			return "";

		$dif = $dif / 100;

		$colorRgb = thb_color_hexToRgb($color);
		$colorHsl =  thb_color_rgbToHsl($colorRgb);

		// Saturation
		$colorHsl[1] -= $dif;
		if( $colorHsl[1] < 0 )
			$colorHsl[1] = 0;

		$colorRgb = thb_color_hslToRgb($colorHsl);
		return thb_color_rgbToHex($colorRgb);
	}
}

if( !function_exists('thb_color_lighten') ) {
	/**
	 * Lightens a color.
	 *
	 * @param string $color A string representing the hex color.
	 * @param int $dif The percentage representing the amount of light to be added to the $color.
	 * @return string
	 **/
	function thb_color_lighten($color, $dif=20) {
		if( !thb_text_startsWith($color, "#") ) $color = "#" . $color;

		if( $color == "#" )
			return "";

		$dif = $dif / 100;

		$colorRgb = thb_color_hexToRgb($color);
		$colorHsl =  thb_color_rgbToHsl($colorRgb);

		// Lightness
		$colorHsl[2] += $dif;
		if( $colorHsl[2] > 1 )
			$colorHsl[2] = 1;

		$colorRgb = thb_color_hslToRgb($colorHsl);
		return thb_color_rgbToHex($colorRgb);
	}
}

if( !function_exists('thb_color_hexToRgb') ) {
	/**
	 * Convert a color from Hex to RGB.
	 *
	 * @param string $hex The hex color code.
	 * @return array
	 */
	function thb_color_hexToRgb( $hex ) {
		$hex = substr( $hex, 1 );

		// Handle shortened format
		if ( strlen( $hex ) === 3 ) {
			$long_hex = array();
			foreach ( str_split( $hex ) as $val ) {
				$long_hex[] = $val . $val;
			}
			$hex = $long_hex;
		}
		else {
			$hex = str_split( $hex, 2 );
		}
		return array_map( 'hexdec', $hex );
	}
}

if( !function_exists('thb_color_rgbToHsl') ) {
	/**
	 * Converts an RGB color value to HSL. Conversion formula
	 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
	 * Assumes r, g, and b are contained in the set [0, 255] and
	 * returns h, s, and l in the set [0, 1].
	 *
	 * @param array $rgb
	 * @return array
	 */
	function thb_color_rgbToHsl( array $rgb ) {

		list( $r, $g, $b ) = $rgb;
		$r /= 255;
		$g /= 255;
		$b /= 255;
		$max = max( $r, $g, $b );
		$min = min( $r, $g, $b );
		$h;
		$s;
		$l = ( $max + $min ) / 2;

		if ( $max == $min ) {
			$h = $s = 0;
		}
		else {
			$d = $max - $min;
			$s = $l > 0.5 ? $d / ( 2 - $max - $min ) : $d / ( $max + $min );
			switch( $max ) {
				case $r:
					$h = ( $g - $b ) / $d + ( $g < $b ? 6 : 0 );
					break;
				case $g:
					$h = ( $b - $r ) / $d + 2;
					break;
				case $b:
					$h = ( $r - $g ) / $d + 4;
					break;
			}
			$h /= 6;
		}

	    return array( $h, $s, $l );
	}
}

if( !function_exists('thb_color_hslToRgb') ) {
	/**
	 * Converts an HSL color value to RGB. Conversion formula
	 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
	 * Assumes h, s, and l are contained in the set [0, 1] and
	 * returns r, g, and b in the set [0, 255].
	 *
	 * @param array $hsl
	 * @return array
	 */
	function thb_color_hslToRgb( array $hsl ) {
		list( $h, $s, $l ) = $hsl;
		$r;
		$g;
		$b;
		if ( $s == 0 ) {
			$r = $g = $b = $l;
		}
		else {
			$q = $l < 0.5 ? $l * ( 1 + $s ) : $l + $s - $l * $s;
			$p = 2 * $l - $q;
			$r = thb_color_hueToRgb( $p, $q, $h + 1 / 3 );
			$g = thb_color_hueToRgb( $p, $q, $h );
			$b = thb_color_hueToRgb( $p, $q, $h - 1 / 3 );
		}
		return array( round( $r * 255 ), round( $g * 255 ), round( $b * 255 ) );
	}
}

if( !function_exists('thb_color_hueToRgb') ) {
	/**
	 * Convert a color from Hue to RGB.
	 *
	 * @param int $p The hue color coord.
	 * @param int $q The hue color coord.
	 * @param int $t The hue color coord.
	 * @return array
	 */
	function thb_color_hueToRgb( $p, $q, $t ) {
		if ( $t < 0 ) $t += 1;
		if ( $t > 1 ) $t -= 1;
		if ( $t < 1/6 ) return $p + ( $q - $p ) * 6 * $t;
		if ( $t < 1/2 ) return $q;
		if ( $t < 2/3 ) return $p + ( $q - $p ) * ( 2 / 3 - $t ) * 6;

		return $p;
	}
}

if( !function_exists('thb_color_rgbToHex') ) {
	/**
	 * Convert a color from Hex to RGB.
	 *
	 * @param array $rgb The RGB coordinates array.
	 * @return string
	 */
	function thb_color_rgbToHex ( array $rgb ) {
		$hex_out = '#';
		foreach ( $rgb as $val ) {
			$hex_out .= str_pad( dechex( $val ), 2, '0', STR_PAD_LEFT );
		}
		return $hex_out;
	}
}

if( !function_exists('thb_color_getYIQ') ) {
	/**
	 * Get a color YIQ value.
	 *
	 * @param string $hex
	 * @return float
	 */
	function thb_color_getYIQ( $hex ) {
		$rgb = thb_color_hexToRgb( $hex );

		return (($rgb[0]*299)+($rgb[1]*587)+($rgb[2]*114))/1000;
	}
}

if( !function_exists('thb_color_get_opposite_skin') ) {
	/**
	 * Get the opposite skin compared to a color brightness.
	 *
	 * @param string $hex
	 * @return string
	 */
	function thb_color_get_opposite_skin( $hex ) {
		$yiq = thb_color_getYIQ( $hex );
		$threshold = (int) apply_filters( 'thb_color_get_opposite_skin_threshold', 204 ); // Based on #ccc

		if ( $yiq <= $threshold ) {
			return 'light';
		}

		return 'dark';
	}
}

if ( ! function_exists( 'thb_color_get_skin_from_comparison' ) ) {
	/**
	 * Get the opposite skin compared to a series of colors brightness.
	 *
	 * @return string
	 */
	function thb_color_get_skin_from_comparison() {
		$comparison = '';

		foreach ( func_get_args() as $color ) {
			if ( ! empty( $color ) ) {
				$comparison = $color;
				break;
			}
		}

		if ( ! empty( $comparison ) ) {
			return thb_color_get_opposite_skin( $comparison );
		}

		return '';
	}
}