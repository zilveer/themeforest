<?php

// =============================================================================
// CLASS-TCO-VALIDATOR.PHP
// -----------------------------------------------------------------------------
// Shared class to manage interactions with the Themeco Product Validation API
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. TCO_Updates Class
// =============================================================================

// TCO_Updates Class
// =============================================================================

if ( ! class_exists( 'TCO_Validator' ) ) :

class TCO_Validator {

  public static $tco;

  protected $code = '';
  protected $is_valid = false;
  protected $is_verified = false;
  protected $has_site = false;
  protected $site_match = false;
  protected $connection_error = false;

  protected $base_url = 'https://community.theme.co/api-v2/validate/';
  protected $errors = array();

  public function __construct( $code, $product ) {
    $this->code = $code;
    $this->product = $product;
  }

  public function run() {

    $result = $this->request();

    if ( is_wp_error( $result ) ) {
      $this->connection_error = $result;
      return;
    }

    switch ( (int) $result ) {
      case 2:
        $this->is_valid = false;
        break;
      case 3:
        $this->is_valid = true;
        break;
      case 4:
        $this->is_valid = true;
        $this->is_verified = true;
        break;
      case 5:
        $this->is_valid = true;
        $this->is_verified = true;
        $this->has_site = true;
        break;
      case 6:
        $this->is_valid = true;
        $this->is_verified = true;
        $this->has_site = true;
        $this->site_match = true;
        break;
    }

    return true;

  }

  public function request() {

    $args = array(
      'product'  => $this->product,
      'siteurl'  => urlencode( self::$tco->get_site_url() ),
    );

    $request_url = $this->base_url . trailingslashit( ( $this->code ) ? $this->code : 'unverified' );

    $uri = add_query_arg( $args, $request_url );

    $request = wp_remote_get( $uri, array( 'timeout' => 15 ) );

    if ( is_wp_error( $request ) ) {
      return $request;
    }

    if ( ! isset( $request['response'] ) || ! isset( $request['response']['code'] ) || 200 != $request['response']['code'] ) {
      ob_start();
      echo '<pre>';
      var_dump( $request );
      echo '</pre>';
      $error = ob_get_clean();
      return new WP_Error( 'tco_connection_error', $error );
    }

    $data = json_decode( wp_remote_retrieve_body( $request ), true );

    if ( isset( $data['error'] ) ) {
      return new WP_Error( 'tco_connection_error', $data['error'] );
    }

    if ( ! isset( $data['code'] ) ) {
      return new WP_Error( 'tco_connection_error', json_encode( $data ) );
    }

    return $data['code'];

  }

  public function has_connection_error() {
    return is_wp_error( $this->connection_error );
  }

  public function is_valid() {
    return $this->is_valid;
  }

  public function is_verified() {
    return $this->is_verified;
  }

  public function has_site() {
    return $this->has_site;
  }

  public function site_match() {
    return $this->site_match;
  }

  public function connection_error_details() {
    return ( is_wp_error( $this->connection_error ) ) ? $this->connection_error->get_error_message() : '';
  }

}

endif;