<?php

class X_Addons_Demo_Content {

	public static $instance;

	public function __construct() {
		X_Demo_Import_Session::instance();
		X_Addons_Home::add_script_data( 'x-demo-content', array( $this, 'script_data' ) );
	}

	public function script_data() {

		return array(
      'strings' => array(
        'yep'            => __( 'Yes, Proceed', '__x__' ),
        'nope'           => __( 'No, Take me back', '__x__' ),
        'start'          => __( 'Let&apos;s get started!', '__x__' ),
        'complete'       => __( 'Have fun!', '__x__' ),
        'simulated'      => __( 'Working on it...', '__x__' ),
        'confirm'        => $this->get_confirm_message(),
        'timeout1'       => __( 'Working on it...', '__x__' ),
        'timeout2'       => __( 'Hang in there, trying to reconnect...', '__x__' ),
        'timeout3'       => __( 'Experiencing technical difficulties...', '__x__' ),
        'failure'        => __( 'We&apos;re sorry, the demo failed to finish importing.', '__x__' ),
        'buttonStandard' => __( 'Setup Standard Demo: %s', '__x__' ),
        'buttonExpanded' => __( 'Setup Expanded Demo: %s', '__x__' ),
      ),
      'demos' => $this->get_demo_data()
    );

  }

  public function get_confirm_message() {

    $extra = '';

    if ( ! is_plugin_active( 'revslider/revslider.php' ) ) {
      $extra = __( 'Note: Revolution Slider is not active. Activate it from the plugins page, as Expanded Demos use it to import sliders.', '__x__' );
      $extra .= '<br/><br/>';
    }

    return sprintf( __( '%sInstalling demo content will not alter any of your pages or posts, but it will overwrite your Customizer settings. This is not reversible unless you have previously made a backup of your settings. Are you sure you want to proceed?', '__x__' ), $extra );

  }

  public function get_demo_data() {

    $data = array();

    if ( isset( $_GET['x-clean-demo-content-cache'] ) ) {
      delete_option( 'x_demo_importer_registry' );
      delete_transient( 'x_demo_listing' );
    }

    //
    // Try restoring from transient first
    //

    $transient = get_transient( 'x_demo_listing' );
    if ( false !== $transient )
      return $transient;


    //
    // Get Remote demo list
    //

    $request = wp_remote_get( 'http://themeco-demo-content.s3.amazonaws.com/x/' . apply_filters( 'x_demo_listing_index', 'index' ) . '.json' );


    //
    // Check if request returns an error.
    //

    if ( is_wp_error( $request ) ) {
      $data['error_verbose'] = $request->get_error_message();
      $data['error'] = __( 'Unable to retrieve demo content. Your WordPress install may be having issues making outbound HTTP requests. For more information, please review the <a href="https://theme.co/community/kb/connection-issues/">connection issues</a> article in our Knowledge Base.', '__x__' );
      return $data;
    }

    $response = json_decode( $request['body'], true );

    if ( is_array($response) && isset( $response['standard'] ) && isset( $response['expanded'] ) && !empty( $response['standard'] ) && !empty( $response['expanded'] ) ) {
      $data['standard_demos'] = $response['standard'];
      $data['expanded_demos'] = $response['expanded'];
      set_transient( 'x_demo_listing', $data, 12 * HOUR_IN_SECONDS );
    } else {
      $data['standard_demos'] = array( 'undefined' => array( 'title' => '', 'url' => '' ) );
      $data['expanded_demos'] = $data['standard_demos'];
      $data['error'] = __( 'No demos found. Refreshing this page may resolve the issue. If it persists, please review the <a href="https://theme.co/community/kb/connection-issues/">connection issues</a> article in our Knowledge Base.', '__x__' );
    }

    return $data;
  }

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

}