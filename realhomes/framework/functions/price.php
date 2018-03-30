<?php
/**
 * This file contains price related functions
 */


if ( ! function_exists( 'get_theme_currency' ) ) {
	/**
	 * Get Currency
	 *
	 * @return mixed|string|void
	 */
	function get_theme_currency() {
		$currency = get_option( 'theme_currency_sign' );
		if ( ! empty( $currency ) ) {
			return $currency;
		}
		return __( '$', 'framework' );
	}
}


if ( ! function_exists( 'get_property_price' ) ) {
	/**
	 * Returns property price in configured format
	 *
	 * @return mixed|string|void
	 */
	function get_property_price() {
		global $post;

		// get property price
		$price_digits = doubleval( get_post_meta( $post->ID, 'REAL_HOMES_property_price', true ) );

		if ( $price_digits ) {
			// get price postfix
			$price_post_fix = get_post_meta( $post->ID, 'REAL_HOMES_property_price_postfix', true );

			// if wp-currencies plugin installed and current currency cookie is set
			if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "current_currency" ] ) ) {
				$current_currency = $_COOKIE[ "current_currency" ];
				if ( currency_exists( $current_currency ) ) {    // validate current currency
					$base_currency = inspiry_get_base_currency();
					$converted_price = convert_currency( $price_digits, $base_currency, $current_currency );
					return format_currency( $converted_price, $current_currency ) . ' ' . $price_post_fix;
				}
			}

			// otherwise go with default approach.
			$currency = get_theme_currency();
			$decimals = intval( get_option( 'theme_decimals' ) );
			$decimal_point = get_option( 'theme_dec_point' );
			$thousands_separator = get_option( 'theme_thousands_sep' );
			$currency_position = get_option( 'theme_currency_position' );
			$formatted_price = number_format( $price_digits, $decimals, $decimal_point, $thousands_separator );
			if ( $currency_position == 'after' ) {
				return $formatted_price . $currency . ' ' . $price_post_fix;
			} else {
				return $currency . $formatted_price . ' ' . $price_post_fix;
			}
		} else {
			return no_price_text();
		}
	}
}


if ( ! function_exists( 'property_price' ) ) {
	/**
	 * Output property price
	 */
	function property_price() {
		echo get_property_price();
	}
}


if ( ! function_exists( 'get_custom_price' ) ) {
	/**
	 * Return custom price in configured format
	 *
	 * @param $amount
	 * @return bool|string
	 */
	function get_custom_price( $amount ) {
		$amount = doubleval( $amount );
		if ( $amount ) {

			// if wp-currencies plugin is installed and current currency cookie is set
			if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "current_currency" ] ) ) {
				$current_currency = $_COOKIE[ "current_currency" ];
				if ( currency_exists( $current_currency ) ) {    // validate current currency
					$base_currency = inspiry_get_base_currency();
					$converted_price = convert_currency( $amount, $base_currency, $current_currency );
					return format_currency( $converted_price, $current_currency );
				}
			}

			// otherwise default approach
			$currency = get_theme_currency();
			$decimals = intval( get_option( 'theme_decimals' ) );
			$decimal_point = get_option( 'theme_dec_point' );
			$thousands_separator = get_option( 'theme_thousands_sep' );
			$currency_position = get_option( 'theme_currency_position' );
			$formatted_price = number_format( $amount, $decimals, $decimal_point, $thousands_separator );
			if ( $currency_position == 'after' ) {
				return $formatted_price . $currency;
			} else {
				return $currency . $formatted_price;
			}
		} else {
			return false;
		}
	}
}


if ( ! function_exists( 'no_price_text' ) ) {
	/**
	 * Returns text to display in case of empty price
	 *
	 * @return mixed|void
	 */
	function no_price_text() {
		/* You can modify text to display when no price is provided, From Theme Options > Price Format */
		$no_price_text = get_option( 'theme_no_price_text' );
		return $no_price_text;
	}
}


if ( ! function_exists( 'get_property_floor_price' ) ) {
	/**
	 * Returns floor price in configured format
	 *
	 * @param   Array $floor Floor details
	 * @return  string  Floor price
	 */
	function get_property_floor_price( $floor ) {
		global $post;

		// get property price
		$price_digits = doubleval( $floor[ 'inspiry_floor_plan_price' ] );

		if ( $price_digits ) {
			// get price postfix
			$price_post_fix = $floor[ 'inspiry_floor_plan_price_postfix' ];

			// if wp-currencies plugin installed and current currency cookie is set
			if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "current_currency" ] ) ) {
				$current_currency = $_COOKIE[ "current_currency" ];
				if ( currency_exists( $current_currency ) ) {    // validate current currency
					$base_currency = inspiry_get_base_currency();
					$converted_price = convert_currency( $price_digits, $base_currency, $current_currency );
					return format_currency( $converted_price, $current_currency ) . ' ' . $price_post_fix;
				}
			}

			// otherwise go with default approach.
			$currency = get_theme_currency();
			$decimals = intval( get_option( 'theme_decimals' ) );
			$decimal_point = get_option( 'theme_dec_point' );
			$thousands_separator = get_option( 'theme_thousands_sep' );
			$currency_position = get_option( 'theme_currency_position' );
			$formatted_price = number_format( $price_digits, $decimals, $decimal_point, $thousands_separator );
			if ( $currency_position == 'after' ) {
				return '<span class="floor-price-value">' . $formatted_price . $currency . '</span>' . ' ' . $price_post_fix;
			} else {
				return '<span class="floor-price-value">' . $currency . $formatted_price . '</span>' . ' ' . $price_post_fix;
			}

		} else {
			return no_price_text();
		}
	}
}


if ( ! function_exists( 'property_floor_price' ) ) {
	/**
	 * Output floor price
	 *
	 * @param   Array $floor Floor details
	 */
	function property_floor_price( $floor ) {
		echo get_property_floor_price( $floor );
	}
}
