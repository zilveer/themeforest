<?php

// =============================================================================
// FUNCTIONS/GLOBAL/DEBUG.PHP
// -----------------------------------------------------------------------------
// Debugging functionality for, well...debugging.
//
// Some of the methods defined below require at least PHP 5.4 due to $this
// being unavailable in anonymous functions before that version. Keep this in
// mind when attempting to utilize x_dump_screen() and x_dump_object(). We do
// provide a fallback for older versions of PHP, but without stylized output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Debug Class
//   02. Helper Functions
// =============================================================================

// Debug Class
// =============================================================================

class X_Debug {

  //
  // General Data Dump
  // ---------------------------------------------------------------------------
  // Dumps any associated data into a styled element that is fixed at the
  // bottom of the page, keeping output easily accessible at all times. Height
  // is adjustable via the second parameter.
  //

  private function x_clean_dump( &$data ) {
    $data = htmlspecialchars( $data, ENT_HTML5 );
  }

  public function x_dump( $data, $height = '250', $function = 'print_r' ) {

    if ( version_compare( PHP_VERSION, '5.4.0' ) >= 0 ) {

      if ( is_array( $data ) ) {
        array_walk_recursive( $data, 'self::x_clean_dump' );
      } elseif ( is_object( $data ) ) {
        $data = (array) $data;
        array_walk_recursive( $data, 'self::x_clean_dump' );
      } else {
        $this->x_clean_dump( $data );
      }

      echo '<pre class="x-dump" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; position: fixed; bottom: 0; left: 0; right: 0; z-index: 999999999; display: block; overflow: auto; max-height: ' . $height . 'px; margin: 36px; border: 0; padding: 23px 25px; font-family: Consolas, Courier, monospace; font-size: 16px; line-height: 1.5; word-wrap: break-word; color: #000; background-color: #fff; border-radius: 0; box-shadow: 0 3px 35px rgba(0, 0, 0, 0.5);">';
        if ( $function == 'print_r' ) {
          print_r( $data );
        } else {
          var_dump( $data );
        }
      echo '</pre>';

    } else {

      echo '<pre class="x-dump" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; position: fixed; bottom: 0; left: 0; right: 0; z-index: 999999999; display: block; overflow: auto; max-height: ' . $height . 'px; margin: 36px; border: 0; padding: 23px 25px; font-family: Consolas, Courier, monospace; font-size: 16px; line-height: 1.5; word-wrap: break-word; color: #000; background-color: #fff; border-radius: 0; box-shadow: 0 3px 35px rgba(0, 0, 0, 0.5);">';
        if ( $function == 'print_r' ) {
          print_r( $data );
        } else {
          var_dump( $data );
        }
      echo '</pre>';

    }

  }


  //
  // Screen Data Dump
  // ---------------------------------------------------------------------------
  // A quick way to output information from the WP_Screen object. Keep in mind
  // that the get_current_screen() function only works in the admin area.
  //

  public function x_get_screen() {
    $this->x_dump( get_current_screen() );
  }

  public function x_dump_screen() {
    add_action( 'admin_footer', array( $this, 'x_get_screen' ) );
  }


  //
  // Object Data Dump
  // ---------------------------------------------------------------------------
  // A quick way to output information from the currently queried object by
  // dumping get_queried_object(). The get_queried_object() function does not
  // output any information for is_date() or is_home(), so at this time we
  // simply display a message to confirm when those pages are being viewed.
  //

  public function x_get_object() {

    if ( is_home() ) {
      $this->x_dump( 'is_home()' );
    } elseif ( is_date() ) {
      $this->x_dump( 'is_date()' );
    } else {
      $this->x_dump( get_queried_object() );
    }

  }

  public function x_dump_object() {
    add_action( 'x_before_site_end', array( $this, 'x_get_object' ) );
  }

}



// Helper Functions
// =============================================================================

//
// These functions serve as helpers to manage the object oriented parts of the
// code and streamline access to the various methods included in the X_Debug
// class. These should be used in place of instantiating the class and then
// calling the method for the sake of brevity.
//

function x_dump( $data, $height = 250, $function = 'print_r' ) {
  $d = new X_Debug(); $d->x_dump( $data, $height, $function );
}

function x_dump_screen() {
  $d = new X_Debug(); $d->x_dump_screen();
}

function x_dump_object() {
  $d = new X_Debug(); $d->x_dump_object();
}