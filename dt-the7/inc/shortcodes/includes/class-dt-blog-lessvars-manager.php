<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class DT_Blog_LessVars_Manager
 */
class DT_Blog_LessVars_Manager extends Presscore_Lib_LessVars_Manager {

	/**
	 * Register less vars for paddings.
	 *
	 * @param array  $vars
	 * @param string $value
	 * @param string|null $wrap
	 * @param string $units
	 */
	public function add_paddings( $vars, $value, $units = 'px', $wrap = null ) {
		if ( ! is_array( $value ) ) {
			$value = explode( ' ', $value );
		}

		for ( $i = 0; $i < 4;  $i++ ) {
			$value[ $i ] = ( isset( $value[ $i ] ) ? $value[ $i ] : '0' );
		}

		$value = array_slice( $value, 0, 4 );

		foreach ( $vars as $i => $var ) {
			if ( ! isset( $value[ $i ] ) ) {
				$this->add_keyword( $var, '~""', $wrap );
			}

			switch ( $units ) {
				case '%|px':
				case 'px|%':
					$this->add_pixel_or_percent_number( $var, $value[ $i ], $wrap );
					break;
				case '%':
					$this->add_percent_number( $var, $value[ $i ], $wrap );
					break;
				case 'px':
				default:
					$this->add_pixel_number( $var, $value[ $i ], $wrap );
			}
		}
	}

	/**
	 * Register font style less vars.
	 *
	 * @param array       $vars
	 * @param string      $value
	 * @param string|null $wrap
	 */
	public function add_font_style( $vars, $value, $wrap = null ) {
		$value = array_map( 'trim', explode( ':', $value ) );
		$defaults = array( '~""', '~""', '~""' );
		foreach ( $defaults as $i => $default ) {
			if ( empty( $value[ $i ] ) ) {
				$value[ $i ] = $default;
			}
		}

		foreach ( $vars as $i => $var ) {
			$_value = '~""';
			if ( isset( $value[ $i ] ) && ! in_array( $value[ $i ], array( 'normal', 'none' ) ) ) {
				$_value = $value[ $i ];
			}

			$this->add_keyword( $var, $_value, $wrap );
		}
	}

	/**
	 * Register less var in pixels or percents.
	 *
	 * @param string      $var
	 * @param string      $value
	 * @param string|null $wrap
	 */
	public function add_pixel_or_percent_number( $var, $value, $wrap = null ) {
		$number_obj = $this->factory->number( $value )->wrap( $wrap );
		if ( preg_match( '/(%|px)/', $number_obj->get_units() ) ) {
			$number = $number_obj->get();
		} else {
			$number = $number_obj->get_pixels();
		}

		$this->storage->set( $var, $number );
	}

	/**
	 * Register less var in pixels.
	 *
	 * @param string      $var
	 * @param string      $value
	 * @param string|null $wrap
	 */
	public function add_pixel_number( $var, $value, $wrap = null ) {
		if ( '' === $value ) {
			$this->add_keyword( $var, '~""' );
		} else {
			parent::add_pixel_number( $var, $value, $wrap );
		}
	}
}