<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/THUMBNAILS/WIDTH.PHP
// -----------------------------------------------------------------------------
// Sets up entry thumbnail sizes based on Customizer options.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Standard Entry Thumbnail Width
//   02. Fullwidth Entry Thumbnail Width
// =============================================================================

// Standard Entry Thumbnail Width
// =============================================================================

if ( ! function_exists( 'x_post_thumbnail_width' ) ) :
  function x_post_thumbnail_width() {

    //
    // Get the active Stack.
    //

    $stack = x_get_stack();


    //
    // 1. Subtract half of the span margin setup by the grid.
    // 2. Subtract due to padding and border around featured image.
    //

    switch ( $stack ) {
      case 'integrity' :
        $m = 2.463055; // 1
        $p = 0;        // 2
        break;
      case 'renew' :
        $m = 3.20197;
        $p = 16;
        break;
      case 'icon' :
        $m = 0;
        $p = 16;
        break;
      case 'ethos' :
        $m = 0;
        $p = 0;
        break;
    }


    //
    // Get settings.
    //

    $a = x_get_option( 'x_layout_site' );
    $b = x_get_option( 'x_layout_content' );
    $c = x_get_option( 'x_layout_site_width' );
    $d = x_get_option( 'x_layout_site_max_width' );
    $e = x_get_option( 'x_layout_content_width' );
    $f = x_get_option( 'x_layout_sidebar_width' );


    //
    // Adjust settings.
    //

    $site_layout    = ( $a == '' ) ? 'full-width'      : $a;
    $content_layout = ( $b == '' ) ? 'content-sidebar' : $b;
    $site_width     = ( $c == '' ) ? 88 / 100          : $c / 100;
    $site_max_width = ( $d == '' ) ? 1200              : $d;
    $content_width  = ( $e == '' ) ? 72 - $m           : $e - $m;


    //
    // Perform calculations.
    //

    if ( $content_layout == 'full-width' ) {
      if ( $site_layout == 'full-width' ) {
        $output = $site_max_width - $p;
      } elseif ( $site_layout == 'boxed' ) {
        $output = $site_max_width * $site_width - $p;
      }
    } else {
      if ( $site_layout == 'full-width' ) {
        if ( $stack == 'icon' ) {
          $output = round( $site_max_width - $p );
        } else {
          $output = round( $site_max_width * ( $content_width / 100 ) - $p );
        }
      } elseif ( $site_layout == 'boxed' ) {
        if ( $stack == 'icon' ) {
          $output = round( $site_max_width * $site_width - $p );
        } else {
          $output = round( $site_max_width * ( $content_width / 100 ) * $site_width - $p );
        }
      }
    }


    //
    // Perform calculations if site max width is less than 979px.
    //

    if ( $site_layout == 'full-width' ) {
      if ( $site_max_width < 979 * $site_width ) {
        $output = $site_max_width - $p;
      } else {
        if ( $output < ( 979 * $site_width ) ) {
          $output = round( 979 * $site_width - $p );
        }
      }
    } elseif ( $site_layout == 'boxed' ) {
      if ( $site_max_width * $site_width < 979 * $site_width * $site_width ) {
        $output = $site_max_width * $site_width - $p;
      } else {
        if ( $output < ( 979 * $site_width * $site_width ) ) {
          $output = round( 979 * $site_width * $site_width - $p );
        }
      }
    }
    
    return intval( $output );

  }
  add_action( 'customize_save', 'x_post_thumbnail_width' );
endif;



// Fullwidth Entry Thumbnail Width
// =============================================================================

if ( ! function_exists( 'x_post_thumbnail_width_full' ) ) :
  function x_post_thumbnail_width_full() {

    //
    // Get the active Stack.
    //

    $stack = x_get_stack();


    //
    // 1. Subtract due to padding and border around featured image.
    //

    switch ( $stack ) {
      case 'integrity' :
        $p = 0; // 1
        break;
      case 'renew' :
        $p = 16;
        break;
      case 'icon' :
        $p = 16;
        break;
      case 'ethos' :
        $p = 0;
        break;
    }


    //
    // Get settings.
    //

    $a = x_get_option( 'x_layout_site' );
    $b = x_get_option( 'x_layout_site_width' );
    $c = x_get_option( 'x_layout_site_max_width' );


    //
    // Adjust settings.
    //

    $site_layout    = ( $a == '' ) ? 'full-width' : $a;
    $site_width     = ( $b == '' ) ? 88 / 100     : $b / 100;
    $site_max_width = ( $c == '' ) ? 1200         : $c;


    //
    // Perform calculations.
    //

    if ( $site_layout == 'full-width' ) {
      $output = $site_max_width - $p;
    } elseif ( $site_layout == 'boxed' ) {
      $output = $site_max_width * $site_width - $p;
    }
    
    return intval( $output );

  }
  add_action( 'customize_save', 'x_post_thumbnail_width_full' );
endif;