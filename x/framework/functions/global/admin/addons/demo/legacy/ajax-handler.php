<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/DEMO/AJAX-HANDLER.PHP
// -----------------------------------------------------------------------------
// AJAX handler for the demo content setup.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register Demo Content Setup Handler
//   02. Stage Tracking Functions
// =============================================================================

// Register Demo Content Setup Handler
// =============================================================================

function x_demo_content_setup_ajax_callback() {


  // Uncomment to simulate a timeout
  // header("HTTP/1.0 408 Request Timeout"); die();

  //
  // Get API data.
  //

  $errorMessage = __( 'We&apos;re sorry, the demo failed to finish importing.', '__x__' );

  if ( ! x_tco()->check_ajax_referer( false ) || ! current_user_can( 'manage_options' ) ) {
    wp_send_json_error( array( 'message' => $errorMessage ) );
  }

  if ( !isset( $_POST['demo'] ) ) {
    wp_send_json_error( array( 'message' => $errorMessage, 'debug_message' => 'POST data missing demo.' ) );
  }

  $request = wp_remote_get( $_POST['demo'] );

  if ( is_wp_error( $request ) )
    wp_send_json_error( array( 'message' => $errorMessage, 'debug_message' => $request->get_error_message() ) );

  //
  // API data.
  //

  $data = json_decode( $request['body'], true );

  if ( !is_array( $data ) )
    wp_send_json_error( array( 'message' => $errorMessage, 'debug_message' => 'Requested demo is improperly formatted.' ) );


  //
  // Run demo setup.
  //

  $error = false;

  ob_start();

  include_once( 'setup.php' );

  if ( $error !== false )
    wp_send_json_error( array( 'message' => $errorMessage, 'debug_message' => $error, 'buffer' => ob_get_clean() ) );

  ob_clean();

  wp_send_json_success();

}

add_action( 'wp_ajax_x_demo_content_setup', 'x_demo_content_setup_ajax_callback' );



// Stage Tracking Functions
// =============================================================================

//
// Clear stages.
//

function x_demo_content_clear_stages() {
  delete_transient( 'x_demo_content_stage' );
}


//
// Stage completed.
//

function x_demo_content_set_stage_completed( $stage ) {
  $transient      = get_transient( 'x_demo_content_stage' );
  $stages         = ( is_array( $transient ) ) ? $transient : array();
  $stages[$stage] = true;
  set_transient( 'x_demo_content_stage', $stages );
}


//
// Stage not completed.
//

function x_demo_content_stage_not_completed( $stage ) {
  $stages = get_transient( 'x_demo_content_stage' );
  return ! ( isset( $stages[$stage] ) && $stages[$stage] );
}