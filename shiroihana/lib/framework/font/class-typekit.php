<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Typekit
 *
 * This class provides helper methods to ease working with Google Fonts
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

final class Youxi_Typekit {

	private static $kit_cache = array();

	private static $invalid_kit_id = array();

	/**
	 * Convert a string containing Typekit family ID and FVD to CSS properties
	 */
	public static function to_css( $str ) {

		$object = Youxi_FVD::extract( $str );

		if( isset( $object['id'], $object['font-style'], $object['font-weight'] ) && 
			( $family = self::get_family( $object['id'] ) ) ) {

			return array(
				'font-family' => $family['css_stack'], 
				'font-style'  => $object['font-style'], 
				'font-weight' => $object['font-weight']
			);
		}

		return null;
	}

	/**
	 * Get Typekit family variations from the current kit
	 */
	public static function get_family_variations( $family_id, $humanize = false ) {

		$family = self::get_family( $family_id );

		if( isset( $family['variations'] ) ) {

			if( ! $humanize ) {
				return $family['variations'];
			}

			$variations = array();
			foreach( $family['variations'] as $fvd ) {

				if( $humanized = Youxi_FVD::humanize( $fvd ) ) {
					$variations[ $fvd ] = $humanized;
				}
			}

			return $variations;
		}

		return null;
	}

	/**
	 * Get Typekit font families from the current kit
	 */
	public static function get_families( $humanize = false ) {

		$kit = wp_parse_args( (array) self::get_kit(), array(
			'families' => array()
		));

		$families = $kit['families'];

		if( ! $humanize ) {
			return $families;
		}

		foreach( $families as &$family ) {
			$variations = array();
			foreach( $family['variations'] as $variation ) {
				if( $humanized = Youxi_FVD::humanize( $variation ) ) {
					$variations[ $variation ] = $humanized;
				}
			}
			$family['variations'] = $variations;
		}

		return $families;
	}

	/**
	 * Try getting a Typekit font family from the current kit
	 */
	public static function get_family( $family_id ) {

		$kit = wp_parse_args( (array) self::get_kit(), array(
			'families' => array()
		));

		foreach( $kit['families'] as $family ) {
			if( $family_id == $family['id'] ) {
				return $family;
			}
		}

		return null;
	}

	/**
	 * Get a kit from Typekit API, cached for one hour
	 */
	public static function get_kit() {

		/* Get the kit ID */
		$kit_id = apply_filters( 'youxi_typekit_kit_id', '' );

		/* Sanity check */
		if( ! is_string( $kit_id ) || empty( $kit_id ) || in_array( $kit_id, self::$invalid_kit_id ) ) {
			return null;
		}

		/* Look in local cache */
		if( isset( self::$kit_cache[ $kit_id ]['id'] ) && $kit_id == self::$kit_cache[ $kit_id ]['id'] ) {
			return self::$kit_cache[ $kit_id ];
		}

		/* Prepare transient */
		$kit_transient_prefix = apply_filters( 'youxi_typekit_transient_prefix', 'youxi_typekit_' );
		$transient_key = $kit_transient_prefix . $kit_id;

		/* Provide a way to turn off caching */
		$cache_enabled = apply_filters( 'youxi_typekit_enable_cache', true );

		/* A valid cache found */
		if( $cache_enabled && false !== ( $kit = get_transient( $transient_key ) ) && isset( $kit['id'] ) && $kit_id == $kit['id'] ) {
			return ( self::$kit_cache[ $kit_id ] = $kit );
		}

		/* Initiate API request */
		$api_url = esc_url_raw( 'https://typekit.com/api/v1/json/kits/' . $kit_id . '/published'  );
		$typekit_response = wp_safe_remote_get( $api_url, array( 'sslverify' => false, 'timeout' => 15 ) );

		/* Retrieve response code */
		$response_code = wp_remote_retrieve_response_code( $typekit_response );

		/* Handle response codes */
		switch( $response_code ):

			case 200:

				/* Retrieve the response body */
				if( $response_body = wp_remote_retrieve_body( $typekit_response ) ) {

					/* Retrieve the kit */
					$data = json_decode( $response_body, true );

					/* Validate the kit */
					if( isset( $data, $data['kit']['id'] ) && $kit_id == $data['kit']['id'] ) {

						/* Get the kit and keep in local cache */
						self::$kit_cache[ $kit_id ] = $kit = $data['kit'];

						/* We got the kit, cache it for one hour */
						set_transient( $transient_key, $kit, HOUR_IN_SECONDS );

						return $kit;
					}
				}
				break;

			case 400:
			case 401:
			case 403:
			case 404:

				/* Do not try again for these response codes */
				self::$invalid_kit_id[] = $kit_id;

			default:
				break;

		endswitch;

		return null;
	}
}