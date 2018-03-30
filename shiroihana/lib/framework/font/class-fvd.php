<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Font Variant Description
 *
 * This class is a PHP port of Typekit FVD
 * https://github.com/typekit/fvd/
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

final class Youxi_FVD {

	public static $properties = array(
		'font-style', 
		'font-weight'
	);

	public static $values = array(
		'font-style' => array(
			array( 'n', 'normal' ), 
			array( 'i', 'italic' ), 
			array( 'o', 'oblique' )
		), 
		'font-weight' => array( 
			array( '1', '100' ), 
			array( '2', '200' ), 
			array( '3', '300' ), 
			array( '4', '400' ), 
			array( '5', '500' ), 
			array( '6', '600' ), 
			array( '7', '700' ), 
			array( '8', '800' ), 
			array( '9', '900' )
		)
	);

	public static function compact( $input ) {
		$result = array( 'n', '4' );
		$descriptors = explode( ';', $input );

		foreach( $descriptors as $descriptor ) {
			$descriptor = preg_replace( '/\s+/', '', $descriptor );
			$pair = explode( ':', $descriptor );

			if( 2 == count( $pair ) ) {
				$property = $pair[0];
				$value    = $pair[1];
				$item     = self::get_item( $property );
				if( $item ) {
					$item->compact( $result, $value );
				}
			}
		}

		return $result;
	}

	public static function expand( $input ) {

		if( is_string( $input ) && 2 == strlen( $input ) ) {

			$result = array( null, null );

			foreach( self::$properties as $index => $property ) {
				$key    = $input[ $index ];
				$values = self::$values[ $property ];

				$item = new Youxi_FVD_Item( $index, $property, $values );
				$item->expand( $result, $key );
			}

			$result = array_filter( $result );
			if( $result ) {
				return implode( ';', $result );
			}
		}

		return null;
	}

	public static function parse( $input ) {

		if( is_string( $input ) && 2 == strlen( $input ) ) {

			$result = array( null, null );

			foreach( self::$properties as $index => $property ) {
				$key    = $input[ $index ];
				$values = self::$values[ $property ];

				$item = new Youxi_FVD_Item( $index, $property, $values );
				$item->expand( $result, $key, false );
			}

			$result = array_filter( $result );
			if( $result ) {
				$return = array();
				foreach( $result as $r ) {
					$return[ $r[0] ] = $r[1];
				}
				return $return;
			}
		}

		return null;
	}

	protected static function get_item( $property ) {
		if( false !== ( $index = array_search( $property, self::$properties ) ) ) {
			$values = self::$values[ $property ];
			return new Youxi_FVD_Item( $index, $property, $values );
		}
	}

	/**
	 * Extract properties from `id:fvd` formatted string
	 */
	public static function extract( $str ) {

		static $cache = array();

		if( is_string( $str ) ) {

			if( isset( $cache[ $str ] ) ) {
				return $cache[ $str ];
			}

			$pair = explode( ':', $str );
			if( is_array( $pair ) && count( $pair ) > 0 ) {

				$result = array();

				if( isset( $pair[0] ) ) {
					$result['id'] = $pair[0];
				}

				if( isset( $pair[1] ) ) {
					$result['fvd'] = $pair[1];
				} else {
					$result['fvd'] = 'n4';
				}

				if( $parsed = self::parse( $result['fvd'] ) ) {
					$result['font-style']  = $parsed['font-style'];
					$result['font-weight'] = $parsed['font-weight'];
				}

				return ( $cache[ $str ] = $result );
			}
		}

		return null;
	}

	/**
	 * Convert a FVD to human readable string
	 */
	public static function humanize( $fvd ) {

		if( $parsed = self::parse( $fvd ) ) {
			return str_replace( 'normal', '', $parsed['font-weight'] . $parsed['font-style'] );
		}
		return '';
	}
}

final class Youxi_FVD_Item {

	public function __construct( $index, $property, $values ) {
		$this->index    = $index;
		$this->property = $property;
		$this->values   = $values;
	}

	public function compact( &$output, $value ) {
		foreach( $this->values as $v ) {
			if( $value == $v[1] ) {
				$match = $v;
			}
		}
		if( isset( $match ) ) {
			$output[ $this->index ] = $match[0];
		}
	}

	public function expand( &$output, $value, $join_property = true ) {
		foreach( $this->values as $v ) {
			if( $value == $v[0] ) {
				$match = $v;
			}
		}
		if( isset( $match ) ) {
			if( $join_property ) {
				$output[ $this->index ] = $this->property . ':' . $match[1];
			} else {
				$output[ $this->index ] = array( $this->property, $match[1] );
			}
		}
	}
}
