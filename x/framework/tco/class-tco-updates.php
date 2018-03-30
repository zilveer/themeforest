<?php

// =============================================================================
// CLASS-TCO-UPDATES.PHP
// -----------------------------------------------------------------------------
// Shared class to manage interactions with the Themeco Update API
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. TCO_Updates Class
// =============================================================================

// TCO_Updates Class
// =============================================================================

if ( ! class_exists( 'TCO_Updates' ) ) :

	class TCO_Updates {

		private static $instance;
		public  static $tco;

		private $base_url = 'https://community.theme.co/api-v2/packages/';
		private $errors = array();
		private $updated = false;
		private $strings;

		public function remote_request() {

			$args = apply_filters( 'themeco_update_api', array() );

			$args = wp_parse_args( $args, array(
				'api-key'  => 'unverified',
				'siteurl'  => urlencode( self::$tco->get_site_url() ),
			) );

	    if ( !$args['api-key'] )
	      $args['api-key'] = 'unverified';

	    $request_url = $this->base_url . trailingslashit( $args['api-key'] );

	    unset($args['api-key']);

	    $uri = add_query_arg( $args, $request_url );

	    $request = wp_remote_get( $uri, array( 'timeout' => 15 ) );
	    $connection_error = array( 'code' => 4, 'message' => $this->l18n( 'connection-error' ) );

	    if ( is_wp_error( $request ) || $request['response']['code'] != 200 ) {
	      self::store_error( $request );
	      return $connection_error;
	    }

			$data = json_decode( $request['body'], true );

			if ( defined('THEMECO_PRERELEASES') && THEMECO_PRERELEASES ) {
			$data = $this->edge_filter( $data );
		}

		return $data;

	  }

		public function l18n( $key = '' ) {

			if ( ! isset( $this->strings ) ) {
				$this->strings = apply_filters( 'tco_localize_' . self::$tco->handle( 'updates' ), array() );
			}

			return ( isset( $this->strings[$key] ) ) ? $this->strings[$key] : '';

		}

		//
	  // Save connection errors.
	  //

	  public function store_error( $wp_error ) {

			if ( ! isset( $this->errors ) ) {
				$this->errors = array();
			}

			array_push( $this->errors, (array) $wp_error );

	  }

		public function get_update_cache() {
			return get_site_option( 'themeco_update_cache', array() );
		}

	  //
	  // Return any saved errors.
	  //

	  public function get_errors() {
			return isset( $this->errors ) ? $this->errors : array();
	  }

	  public function edge_filter( $data ) {

		if ( isset( $data['themes'] ) ) {

			foreach ($data['themes'] as $theme => $theme_data ) {

				if ( !isset( $theme_data['edge'] ) ) continue;

					$edge = $theme_data['edge'];
					unset($theme_data['edge']);
				$data['themes'][$theme] = array_merge( $theme_data, $edge );

			}

		}

		if ( isset( $data['plugins'] ) ) {

			foreach ($data['plugins'] as $plugin => $plugin_data ) {

				if ( !isset( $plugin_data['edge'] ) ) continue;

					$edge = $plugin_data['edge'];
					unset($plugin_data['edge']);
				$data['plugins'][$plugin] = array_merge( $theme_data, $edge );

			}

		}

		return $data;

		}

		public function update( $force = false ) {
			if ( $this->updated && !$force ) return;
			$response = $this->remote_request();
			do_action( 'themeco_update_api_response', $response );
			update_site_option( 'themeco_update_cache', apply_filters( 'themeco_update_cache', array(), $response ) );
			$this->updated = true;
		}

		public function refresh( $force = false ) {

			if ( !is_admin() )
				return false;

			$this->update( $force );

			return true;
		}

		public static function instance() {

			if ( !isset( self::$instance ) )
				self::$instance = new self;

			return self::$instance;

		}

	}

endif;