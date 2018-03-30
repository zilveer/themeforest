<?php

// =============================================================================
// FUNCTIONS/GLOBAL/HELPER.PHP
// -----------------------------------------------------------------------------
// Helper functions for various tasks.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Get View
//   02. X Is Validated
//   03. Make Protocol Relative
//   04. Get Featured Image URL
//   05. Get Social Fallback Image URL
//   06. Output Style Block
//   07. Return an Array of Integer Values from String
//   08. Get The ID
//   09. Get Post by Title
//   10. Get Page by Title
//   11. Get Portfolio Item by Title
//   12. Get Slider Shortcode
//   13. Array to Object
//   14. Object to Array
// =============================================================================

// Get View
// =============================================================================

if ( ! function_exists( 'x_get_view' ) ) :
  function x_get_view( $stack, $base, $extension = '' ) {

    $file = $stack . '_' . $base . ( ( empty( $extension ) ) ? '' : '-' . $extension );

    do_action( 'x_before_view_' . $file );

    get_template_part( 'framework/views/' . $stack . '/' . $base, $extension );

    do_action( 'x_after_view_' . $file );

  }
endif;



// X Is Validated
// =============================================================================

function x_is_validated() {

  if ( get_option( 'x_product_validation_key' ) != false ) {
    return true;
  } else {
    return false;
  }

}



// Make Protocol Relative
// =============================================================================

//
// Accepts a string and replaces any instances of "http://" and "https://" with
// the protocol relative "//" instead.
//

function x_make_protocol_relative( $string ) {

  $output = str_replace( array( 'http://', 'https://' ), '//', $string );

  return $output;

}



// Get Featured Image URL
// =============================================================================

if ( ! function_exists( 'x_get_featured_image_url' ) ) :
  function x_get_featured_image_url( $size = 'full' ) {

    $featured_image     = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
    $featured_image_url = $featured_image[0];

    return $featured_image_url;

  }
endif;



// Get Social Fallback Image URL
// =============================================================================

if ( ! function_exists( 'x_get_featured_image_with_fallback_url' ) ) :
  function x_get_featured_image_with_fallback_url( $size = 'full' ) {

    $featured_image_url        = x_get_featured_image_url( $size );
    $social_fallback_image_url = get_option( 'x_social_fallback_image' );

    if ( $featured_image_url != NULL ) {
      $image_url = $featured_image_url;
    } else {
      $image_url = $social_fallback_image_url;
    }

    return $image_url;

  }
endif;



// Output Style Block
// =============================================================================

if ( ! function_exists( 'x_output_style_block' ) ) :
  function x_output_style_block( $css = array() ) {

    echo '<style scoped>';
      foreach ( $css as $selector => $styles ) {
        echo $selector . '{';
          foreach ( $styles as $property => $value ) {
            echo $property . ':' . $value . ';';
          }
        echo '}';
      }
    echo '</style>';

  }
endif;



// Return an Array of Integer Values from String
// =============================================================================

//
// Removes all whitespace from the provided string, separates values delimited
// by comma, and returns an array of integer values.
//

function x_intval_explode( $string ) {

  $output = array_map( 'intval', explode( ',', preg_replace( '/\s+/', '', $string ) ) );

  return $output;

}



// Get The ID
// =============================================================================

//
// Gets the ID of the current page, post, et cetera. Can be used outside of the
// loop and also returns the ID for blog and shop index pages.
//

function x_get_the_ID() {

  GLOBAL $post;

  if ( is_home() ) {
    $id = get_option( 'page_for_posts' );
  } elseif ( x_is_shop() ) {
    $id = woocommerce_get_page_id( 'shop' );
  } elseif ( is_404() ) {
    $id = NULL;
  } else {
    $id = $post->ID;
  }

  return $id;

}



// Get Post by Title
// =============================================================================

function x_get_post_by_title( $title ) {

  return get_page_by_title( $title, 'ARRAY_A', 'post' );

}



// Get Page by Title
// =============================================================================

function x_get_page_by_title( $title ) {

  return get_page_by_title( $title, 'ARRAY_A', 'page' );

}



// Get Portfolio Item by Title
// =============================================================================

function x_get_portfolio_item_by_title( $title ) {

  return get_page_by_title( $title, 'ARRAY_A', 'x-portfolio' );

}



// Get Slider Shortcode
// =============================================================================

//
// Accepts an identifier string to determine which shortcode should be output.
// These strings are generated by default in the slider meta options and look
// something like "x-slider-ls-2", which explains that this is a slider from
// the LayerSlider plugin with an ID of 2. If a string not beginning with
// "x-slider" is input, it is assumed to be a slug for Revolution Slider and
// is output using that shortcode.
//

function x_get_slider_shortcode( $string ) {

  //
  // Conditionals.
  //

  $is_new_slug             = strpos( $string, 'x-slider-' ) !== false;
  $is_new_layerslider_slug = strpos( $string, 'x-slider-ls-' ) !== false;


  //
  // Get shortcode.
  //

  $shortcode = ( $is_new_layerslider_slug ) ? 'layerslider' : 'rev_slider';


  //
  // Get shortcode parameter.
  //

  $parameter = ( $is_new_layerslider_slug ) ? 'id' : 'alias';


  //
  // Get shortcode parameter value.
  //

  if ( $is_new_slug ) {
    $string_pieces   = explode( '-', $string );
    $slider_id       = end( $string_pieces );
    $parameter_value = $slider_id;
  } else {
    $parameter_value = $string;
  }


  //
  // Return shortcode format.
  //

  return "[{$shortcode} {$parameter}=\"{$parameter_value}\"]";

}



// Array to Object
// =============================================================================

//
// Type cast an array as an object when returning it.
//

function x_array_to_object( $array ) {
  return (object) $array;
}



// Object to Array
// =============================================================================

//
// Type cast an object as an array when returning it.
//

function x_object_to_array( $object ) {
  return (array) $object;
}

