<?php

/**
 * Class DT_LessPHP_Functions
 */

class DT_LessPHP_Functions {

	/**
	 * Escape function.
	 *
	 * @param array $arg
	 *
	 * @return array
	 */
	public static function escape( $arg ) {
		$v = &$arg[2][1][1];
		$v = rawurlencode( $v );

		return $arg;
	}

	/**
	 * Min function.
	 *
	 * @param array $arg
	 *
	 * @return array
	 */
	public static function min( $arg ) {
		list( $type, $sp, $values ) = $arg;

		$unit = '';
		$_values = array();
		foreach ( $values as $value ) {
			$unit = $value[2];
			$_values[] = intval( $value[1] );
		}

		$min = call_user_func_array( 'min', $_values );
		return array( 'number', $min, $unit );
	}

	/**
	 * Register lessc functions.
	 *
	 * @param lessc|null $less
	 */
	public static function register_functions( lessc $less = null ) {
		if ( is_null( $less ) && class_exists( 'WPLessPlugin' ) ) {
			$less = WPLessPlugin::getInstance();
		}

		if ( is_null( $less ) ) {
			return;
		}

		$less->registerFunction( 'escape', array( __CLASS__, 'escape' ) );
		$less->registerFunction( 'min', array( __CLASS__, 'min' ) );
	}
}
