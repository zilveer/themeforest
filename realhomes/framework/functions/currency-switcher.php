<?php
/**
 * This file contains functions related to currency switcher
 */


if ( ! function_exists( 'inspiry_get_base_currency' ) ) {
    /**
     * Get Base Currency
     *
     * @return mixed|string|void
     */
    function inspiry_get_base_currency() {

        $base_currency = get_option( 'theme_base_currency' );
        if ( empty( $base_currency ) ) {
            $base_currency = 'USD';
        }

        return $base_currency;
    }
}


if ( ! function_exists( 'inspiry_supported_currencies' ) ) {
	/**
	 * Get Supported Currencies
	 *
	 * @return array
	 */
	function inspiry_supported_currencies() {

		$supported_currencies_array = array();

		$supported_currencies_str = get_option( 'theme_supported_currencies' );
		if ( ! empty( $supported_currencies_str ) ) {
			$supported_currencies_array = explode( ',', $supported_currencies_str );
		}

		// fall back
		if ( empty( $supported_currencies_str ) || empty( $supported_currencies_array ) ) {
			$supported_currencies_array = array(
				'AUD', 'CAD', 'CHF', 'EUR', 'GBP', 'HKD', 'JPY', 'NOK', 'SEK', 'USD'
			);
		}

		return $supported_currencies_array;
	}
}


if ( ! function_exists( 'inspiry_get_current_currency' ) ) {
	/**
	 * Get Current Currency
	 *
	 * @return mixed|string|void
	 */
	function inspiry_get_current_currency() {

		if ( isset( $_COOKIE[ "current_currency" ] ) ) {
			$temp_current_currency = $_COOKIE[ "current_currency" ];
			if ( currency_exists( $temp_current_currency ) ) {    // validate current currency
				$current_currency = $temp_current_currency;
			}
		}

		if ( empty( $current_currency ) ) {
			$current_currency = inspiry_get_base_currency();
		}

		return $current_currency;
	}
}


if ( ! function_exists( 'inspiry_switch_currency' ) ) {
	/**
	 * Ajax Currency Switch
	 */
	function inspiry_switch_currency() {

		// Overall request validation
		if ( isset( $_POST[ 'switch_to_currency' ] ) ):

			// WordPress Nonce
			$nonce = $_POST[ 'nonce' ];
			if ( ! wp_verify_nonce( $nonce, 'switch_currency_nonce' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Unverified Nonce!', 'framework' )
				) );
				die;
			}

			// wp-currencies plugin is required - https://wordpress.org/plugins/wp-currencies/
			if ( class_exists( 'WP_Currencies' ) ) {

				$switch_to_currency = $_POST[ 'switch_to_currency' ];

				// expiry time
				$expiry_period = intval( get_option( 'theme_currency_expiry' ) );
				if ( ! $expiry_period ) {
					$expiry_period = 60 * 60;   // one hour
				}
				$expiry = time() + $expiry_period;

				// save cookie
				if ( currency_exists( $switch_to_currency ) && setcookie( 'current_currency', $switch_to_currency, $expiry, '/' ) ) {
					echo json_encode( array(
						'success' => true
					) );
				} else {
					echo json_encode( array(
						'success' => false,
						'message' => __( "Failed to updated cookie !", 'framework' )
					) );
				}

			} else {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'wp-currencies plugin is missing !', 'framework' )
				) );
			}

		else:
			echo json_encode( array(
					'success' => false,
					'message' => __( "Invalid Request !", 'framework' )
				)
			);
		endif;

		die;

	}

	add_action( 'wp_ajax_nopriv_switch_currency', 'inspiry_switch_currency' );
	add_action( 'wp_ajax_switch_currency', 'inspiry_switch_currency' );
}