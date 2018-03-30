<?php

class X_Demo_Import_Session {

  protected static $instance;

  protected $session_id;
  public $session_data;
  protected $registry;
  protected $processor;

  const VERSION = '1.0.0';

  /**
   * Register AJAX Handler and setup components
   */
  public function __construct() {

    add_action( 'save_post', array( $this, 'savePost' ), 10, 3 );
    add_action( 'wp_ajax_x_demo_importer', array( $this, 'ajaxHandler' ) );
    $this->processor = new X_Demo_Import_Processor;
  }

  public function savePost( $post_ID, $post, $update ) {

    if ( false !== get_post_meta( $post_ID, 'x_demo_content', true ) )
      delete_post_meta( $post_ID, 'x_demo_content' );

  }

  /**
   * Respond to AJAX requests.
   * @return none
   */
  public function ajaxHandler() {

    x_tco()->check_ajax_referer();

    if ( ! current_user_can( 'manage_options' ) ) {
      wp_send_json_error( array(
        'message' => __( 'We&apos;re sorry, the demo failed to finish importing.', '__x__' )
      ) );
    }

    // Uncomment to simulate a timeout
    // header("HTTP/1.0 408 Request Timeout"); die();

    $response = @$this->prepareResponse();
    $debug = ( WP_DEBUG ) ? $this->session_data : null;

    if ( is_wp_error( $response ) ) {
      wp_send_json_error( array(
        'message' => __( 'We&apos;re sorry, the demo failed to finish importing.', '__x__' ),
        'debug_message' => $response->get_error_message(),
        'debug' => $debug
      ) );
    }

    $response['debug'] = $debug;
    wp_send_json_success( $response );

  }

  /**
   * Prepare a response to the AJAX request with error handling
   * @return array|WP_Error Response to be sent out, or a WP_Error object.
   */
  public function prepareResponse() {

    if ( !isset( $_POST['demo'] ) )
      return new WP_Error( '__x__', 'POST data missing demo' );

    if ( !isset( $_POST['session'] ) )
      return new WP_Error( '__x__', 'POST data missing session' );

    $transient = get_transient( 'x_demo_listing' );

    if( !$transient || !isset( $transient['expanded_demos'][$_POST['demo']] ) )
      return new WP_Error( '__x__', 'Invalid demo name.' );

    $demo = $transient['expanded_demos'][$_POST['demo']];

    $error = $this->prepareSession( $_POST['session'], $demo );

    if ( is_wp_error( $error ) )
      return $error;

    if ( version_compare( self::VERSION, $this->session_data['xde_version'], '<' ) )
      wp_send_json_error( array( 'message' => __( 'Incompatible demo version. Please update X.', '__x__' ) ) );

    return $this->nextResponse();

  }

  /**
   * Restore a previous import session, or begin a new one.
   * Returns WP_Error on failure
   * @param  string $session_id  A unique ID provided by our javascript
   * @param  string $demo_url   URL to demo content JSON
   * @return true|WP_Error
   */
  public function prepareSession( $session_id, $demo ) {

    $this->session_id = 'xdi_' . substr( md5( $_POST['session'] ) , -16 );

    $session = get_transient( $this->session_id );

    if ( $session === false) {

      $this->session_data = array();
      $demo_data = $this->getDemoData( $demo['url'] );

      if ( is_wp_error( $demo_data ) )
        return $demo_data;

      $this->session_data['sliders'] = $demo['sliders'];
      $this->session_data['demo'] = $demo_data['jobs'];
      $this->session_data['namespace'] = $demo_data['namespace'];
      $this->session_data['xde_version'] = $demo_data['xde_version'];
      $this->save();

    } else {
      $this->session_data = $session;
    }

    $this->processor->setup( $this, $this->registry );

    return true;

  }

  /**
   * Make a remote request to get demo data from a URL
   * @param  string $demo_url URL to demo content JSON
   * @return array           Returns demo data as an array, or WP_Error on failure
   */
  public function getDemoData( $demo_url ) {

    $request = wp_remote_get( $demo_url );

    if ( is_wp_error( $request ) )
      return $request;

    $data = json_decode( $request['body'], true );

    if ( !is_array( $data ) )
      return new WP_Error( '__x__', 'Failed to download demo content from remote location.' );

    if ( !isset( $data['namespace'] ) )
      return new WP_Error( '__x__', 'Demo data missing namespace' );

    if ( !isset( $data['xde_version'] ) )
      return new WP_Error( '__x__', 'Demo data missing version number.' );

    if ( !isset( $data['jobs'] ) || !is_array( $data['jobs'] ) )
      return new WP_Error( '__x__', 'Demo data missing job list.' );

    foreach ( $data['jobs'] as $job ) {
      if ( !isset( $job['task'] ) || !isset( $job['data'] ) )
        return new WP_Error( '__x__', 'Demo data job list is not formatted correctly.' );
    }

    return $data;

  }

  /**
   * Based on our current seesion, come up with the next response
   * to the client.
   * @return array Array containing data for the client.
   */
  public function nextResponse() {

    $job = $this->processor->nextJob();

    if ( is_wp_error( $job ) )
      return $job;

    $response = array(
      'completion' => $this->processor->completion()
    );



    if( $response['completion'] === true ) {
      $this->delete();
    } else {
      $debugMessage = $this->processor->debugMessage();
      if ($debugMessage)
        $response['debug_message'] = $debugMessage;
      $response['message'] = $this->processor->message();
      $this->save();
    }

    return $response;

  }

  public function set( $key, $value ) {
    $this->session_data[$key] = $value;
  }

  public function get( $key ) {
    return (isset($this->session_data[$key])) ? $this->session_data[$key] : null;
  }
  /**
   * Save our session to a transient
   * @return none
   */
  public function save() {
    return set_transient( $this->session_id, $this->session_data , 2 * MINUTE_IN_SECONDS );
  }

  /**
   * Delete the transient associated with this session
   * @return none
   */
  public function delete() {
    delete_transient( $this->session_id );
  }

  /**
   * Get an instance for this singleton.
   * If one does not exist, it will be instantiated
   * @return object  Singleton for this class
   */
  public static function instance() {
    if (!isset(self::$instance))
      self::$instance = new self;

    return self::$instance;
  }
}