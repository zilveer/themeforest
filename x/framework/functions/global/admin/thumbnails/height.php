<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/THUMBNAILS/HEIGHT.PHP
// -----------------------------------------------------------------------------
// Sets up entry thumbnail sizes based on Customizer options.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Cropped Entry Thumbnail Height
//   02. Fullwidth Cropped Entry Thumbnail Height
// =============================================================================

// Cropped Entry Thumbnail Height
// =============================================================================

if ( ! function_exists( 'x_post_thumbnail_cropped_height' ) ) :
  function x_post_thumbnail_cropped_height() {

    $stack = x_get_stack();

    switch ( $stack ) {
      case 'integrity' :
        $output = round( x_post_thumbnail_width() * 0.558823529 );
        break;
      case 'renew' :
        $output = round( x_post_thumbnail_width() * 0.558823529 );
        break;
      case 'icon' :
        $output = round( x_post_thumbnail_width() * 0.558823529 );
        break;
      case 'ethos' :
        $output = round( x_post_thumbnail_width() * 0.558823529 );
        break;
    }

    return intval( $output );

  }
  add_action( 'customize_save', 'x_post_thumbnail_cropped_height' );
endif;



// Fullwidth Cropped Entry Thumbnail Height
// =============================================================================

if ( ! function_exists( 'x_post_thumbnail_cropped_height_full' ) ) :
  function x_post_thumbnail_cropped_height_full() {

    $stack = x_get_stack();

    switch ( $stack ) {
      case 'integrity' :
        $output = round( x_post_thumbnail_width_full() * 0.558823529 );
        break;
      case 'renew' :
        $output = round( x_post_thumbnail_width_full() * 0.558823529 );
        break;
      case 'icon' :
        $output = round( x_post_thumbnail_width_full() * 0.558823529 );
        break;
      case 'ethos' :
        $output = round( x_post_thumbnail_width_full() * 0.558823529 );
        break;
    }

    return intval( $output );

  }
  add_action( 'customize_save', 'x_post_thumbnail_cropped_height_full' );
endif;