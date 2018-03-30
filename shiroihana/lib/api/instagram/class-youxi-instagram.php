<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );
}

if( ! function_exists( 'Youxi_Instagram' ) ):

class Youxi_Instagram {

	private static function get_response_error( $response ) {

		$body = wp_remote_retrieve_body( $response );
		$body = json_decode( $body, true );
		if( isset( $body['meta'], $body['meta']['code'], $body['meta']['error_message'] ) ) {
			return new WP_Error( $body['meta']['code'], $body['meta']['error_message'], $response );
		}

		return new WP_Error( 'unknown', __( 'An unknown error has occured.', 'youxi' ), $response );
	}

	public static function sanitize( &$value, $key ) {
		if( 'text' == $key || 'full_name' == $key || 'bio' == $key ) {
			$value = preg_replace( '/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $value );
		}
	}

	public static function get( $count, $access_token ) {

		/* Transient key */
		$prefix = apply_filters( 'youxi_instagram_transient_prefix', 'youxi_instagram_' );
		$cache_key = $prefix . implode( '_', array( $access_token, $count ) );

		/* Attempt to get the data from cache */
		$data = get_transient( $cache_key );

		/* Connect to Instagram if cache is invalid */
		if( ! is_array( $data ) || empty( $data ) ) {

			/* Get the access token owner's most recent media */
			$url = 'https://api.instagram.com/v1/users/self/media/recent/';
			$url = add_query_arg( compact( 'count', 'access_token' ), $url );
			$url = esc_url_raw( $url );

			$response = wp_remote_get( $url, array(
				'timeout' => 10, 
				'sslverify' => false
			));

			if( 200 == wp_remote_retrieve_response_code( $response ) ) {

				$body = wp_remote_retrieve_body( $response );
				$body = json_decode( $body, true );

				/* Found the result */
				if( ! is_null( $body ) && isset( $body['data'] ) ) {
					
					$data = $body['data'];

					/* Sanitize instagram feed (remove Emojis) */
					if( ! function_exists( 'wp_encode_emoji' ) ) {

						/* Only proceed when WordPress is lower than than 4.2 */
						array_walk_recursive( $data, array( get_class(), 'sanitize' ) );
					}
					set_transient( $cache_key, $data, HOUR_IN_SECONDS );

					return $data;
				}

			} else {
				return self::get_response_error( $response );
			}

		} else {
			return $data;
		}

		return new WP_Error( 'unknown', __( 'An unknown error has occured.', 'youxi' ) );
	}
}
endif;
