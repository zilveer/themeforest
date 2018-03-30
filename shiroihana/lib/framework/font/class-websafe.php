<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Websafe
 *
 * This class provides helper methods to ease working with Websafe Fonts
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

final class Youxi_Websafe {

	/**
	 * Return available websafe font families
	 */
	public static function get_families() {
		
		return apply_filters( 'youxi_websafe_font_families', array(
			'arial'         => 'Arial, Helvetica, sans-serif', 
			'arialblack'    => '"Arial Black", Gadget, sans-serif', 
			'impact'        => 'Impact, Charcoal, sans-serif', 
			'lucidasans'    => '"Lucida Sans Unicode", "Lucida Grande", sans-serif', 
			'tahoma'        => 'Tahoma, Geneva, sans-serif', 
			'trebuchetms'   => '"Trebuchet MS", Helvetica, sans-serif', 
			'verdana'       => 'Verdana, Geneva, sans-serif', 

			'georgia'       => 'Georgia, serif', 
			'palatino'      => '"Palatino Linotype", "Book Antiqua", Palatino, serif', 
			'timesnewroman' => '"Times New Roman", Times, serif', 

			'couriernew'    => '"Courier New", Courier, monospace', 
			'lucidaconsole' => '"Lucida Console", Monaco, monospace'
		));
	}

	/**
	 * Return available websafe font variations
	 */
	public static function get_variations() {

		static $variations = null;
		if( is_array( $variations ) ) {
			return $variations;
		}

		return ( $variations = array(
			'n4' => Youxi_FVD::humanize( 'n4' ), 
			'n7' => Youxi_FVD::humanize( 'n7' ), 
			'i4' => Youxi_FVD::humanize( 'i4' ), 
			'i7' => Youxi_FVD::humanize( 'i7' )
		));
	}

	/**
	 * Convert a string containing family ID and FVD to CSS properties
	 */
	public static function to_css( $str ) {

		$object   = Youxi_FVD::extract( $str );
		$families = self::get_families();

		if( isset( $object['id'], $families[ $object['id'] ], $object['font-style'], $object['font-weight'] ) ) {

			return array(
				'font-family' => $families[ $object['id'] ], 
				'font-style'  => $object['font-style'], 
				'font-weight' => $object['font-weight']
			);
		}

		return null;
	}
}