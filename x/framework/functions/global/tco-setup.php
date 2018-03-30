<?php

// =============================================================================
// FUNCTIONS/GLOBAL/TCO-SETUP.PHP
// -----------------------------------------------------------------------------
// Load our common library shared between products.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Load Class
//   02. Accessor
//   03. Initialization
//   04. Localization
// =============================================================================


// Load Class
// =============================================================================

require_once( X_TEMPLATE_PATH . '/framework/tco/tco.php' );


// Accessor
// =============================================================================

function x_tco() {
  return TCO_1_0::instance();
}


// Initialization
// =============================================================================

function x_tco_init() {

  //
  // Init
  //

  $tco = x_tco();

  $tco->init( array(
    'url' => X_TEMPLATE_URL . '/framework/tco/'
  ) );

  //
  // Attach Localization Filters
  //

  add_filter( 'tco_localize_' . $tco->handle( 'admin-js' ), 'x_tco_localize_admin_js' );
  add_filter( 'tco_localize_' . $tco->handle( 'updates' ), 'x_tco_localize_updates' );

}

add_action( 'init', 'x_tco_init' );
add_action( 'admin_init', 'x_tco_init' );


// Localization
// =============================================================================

function x_tco_localize_admin_js( $strings ) {

  $strings = array_merge( $strings, array(
    'details' => __( 'Details', '__x__' ),
    'back'    => __( 'Back', '__x__' ),
    'yep'     => __( 'Yep', '__x__' ),
    'nope'    => __( 'Nope', '__x__' )
  ) );

  return $strings;

}

function x_tco_localize_updates( $strings ) {

  $strings = array_merge( $strings, array(
    'connection-error' => __( 'Could not establish connection. For assistance, please start by reviewing our article on troubleshooting <a href="https://community.theme.co/kb/connection-issues/">connection issues.</a>', '__x__' )
  ) );

  return $strings;

}
