<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );
}

/*
 * Abraham Williams (abraham@abrah.am) http://abrah.am
 *
 * The first PHP Library to support OAuth for Twitter's REST API.
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
 *
 * Simplified and rewritten for the Youxi Wordpress Framework
 * Uses the Wordpress HTTP API instead of CURL for wider compatibility and WP best practice
 *
 * @author Mairel Theafila
 * @link http://www.themeforest.net/user/nagaemas
 * @version v1.0
 *
 */

if( ! class_exists( 'YTwitterOAuth' ) ):

class YTwitterOAuth {

	private $sha1_method;

	private $consumer;

	private $token;

	private $response_code;

	private $response_headers;

	private $response_errors;


	public function __construct( $consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL ) {

		// Include the OAuth PHP library
		if( ! class_exists( 'OAuthRequest' ) ) {
			require 'OAuth.php';
		}

		$this->sha1_method = new OAuthSignatureMethod_HMAC_SHA1();

		$this->consumer = new OAuthConsumer( $consumer_key, $consumer_secret );

		if( ! empty( $oauth_token ) && ! empty( $oauth_token_secret ) ) {
			$this->token = new OAuthConsumer( $oauth_token, $oauth_token_secret );
		}
	}

	public function fetch( $host, $url, $method, $parameters ) {

		$response = false;

		$cache_transient_key = apply_filters( 'youxi_tweets_transient_key', 'youxi_twitter_cache' );

		/* Get the cache from WordPress transients API */
		$cache = get_transient( $cache_transient_key );

		/* Generate a cache key based on the parameters */
		$cache_key = md5( serialize( $parameters ) );

		/* If the cache is not valid we need to make an API call */
		if( ! $this->cache_valid( $cache, $cache_key ) )  {

			$cache = is_array( $cache ) ? $cache : array();

			$response = $this->request( $this->prepare_url( $host, $url ), $method, $parameters );

			/* Update the cache */
			if( is_array( $response ) && ! isset( $response['errors'] ) ) {
				$cache[ $cache_key ] = $response;
				set_transient( $cache_transient_key, $cache, HOUR_IN_SECONDS );
			} else {
				unset( $cache[ $cache_key ] );
				set_transient( $cache_transient_key, $cache, HOUR_IN_SECONDS );
			}

		} else {

			$response = $cache[ $cache_key ];
		}

		return $response;
	}

	public function get_debug_info() {
		return array(
			'response_code' => $this->response_code, 
			'response_headers' => $this->response_headers, 
			'response_errors' => $this->response_errors
		);
	}

	private function cache_valid( $cache, $cache_key ) {

		if( ! is_array( $cache ) ) {
			return false;
		}

		// If the cache doesn't exists
		if( ! isset( $cache[ $cache_key ] ) ) {
			return false;
		}

		// If the cached tweets contains errors
		$entry = $cache[ $cache_key ];
		if( isset( $entry['errors'] ) ) {
			return false;
		}

		return true;
	}

	private function prepare_url( $host, $url ) {

		/* Cleanup host and URL */
		$host = trim( preg_replace( "#^https?://#", '', $host ), '/\\' );
		$url  = trim( preg_replace( "#^(https?://)?({$host})?|\.json$#", '', $url ), '/\\' );

		return 'https://' . $host . '/' . $url . '.json';
	}

	private function request( $url, $method, $parameters ) {

		$request = OAuthRequest::from_consumer_and_token( $this->consumer, $this->token, $method, $url, $parameters );
		$request->sign_request( $this->sha1_method, $this->consumer, $this->token );

		$args = array(
			'sslverify' => false, 
			'method' => $method, 
			'timeout' => 15
		);

		switch( $method ) {
			case 'GET':
				$url = $request->to_url();
				$response = wp_safe_remote_get( $url, $args );
				break;
			default:
				$url = $request->get_normalized_http_url();
				$args = wp_parse_args( array( 'body' => $request->to_postdata() ), $args );
				$response = wp_safe_remote_request( $url, $args );
				break;
		}

		$this->response_code    = wp_remote_retrieve_response_code( $response );
		$this->response_headers = wp_remote_retrieve_headers( $response );

		/* Check if we have a valid response */
		if( 200 == $this->response_code ) {

			if( $response_body = wp_remote_retrieve_body( $response ) ) {

				/* Decode the response body */
				$result = json_decode( trim( $response_body ), true );

				/* Check if we failed to decode the response, or the response contains errors */
				if( is_null( $result ) || isset( $result['errors'] ) ) {
					$this->response_errors = isset( $result['errors'] ) ? $result['errors'] : null;
					return false;
				}

				return $result;
			}

		}

		return false;
	}
}
endif;
