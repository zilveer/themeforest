<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/FONTS/GOOGLE.PHP
// -----------------------------------------------------------------------------
// Google Fonts handling.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Is Google Fonts Used
//   02. Get Family Query
//   03. Get Request
//   04. Cache Request
//   05. Enqueue
// =============================================================================

// Is Google Fonts Used
// =============================================================================

function x_is_google_fonts_used() {

  $google_body     = x_get_font_data( x_get_option( 'x_body_font_family' ), 'source' ) == 'google';
  $google_headings = x_get_font_data( x_get_option( 'x_headings_font_family' ), 'source' ) == 'google';
  $google_logo     = x_get_font_data( x_get_option( 'x_logo_font_family' ), 'source' ) == 'google';
  $google_navbar   = x_get_font_data( x_get_option( 'x_navbar_font_family' ), 'source' ) == 'google';

  if ( $google_body || $google_headings || $google_logo || $google_navbar ) {
    return true;
  } else {
    return false;
  }

}



// Get Family Query
// =============================================================================

function x_get_google_fonts_family_query( $font_family ) {

  $font_family_query = str_replace( ' ', '+', $font_family );

  return $font_family_query;

}



// Get Request
// =============================================================================

function x_get_google_fonts_request() {

  //
  // Raw data.
  //

  $body_family           = x_get_google_fonts_family_query( x_get_option( 'x_body_font_family' ) );
  $body_weight_style     = x_get_option( 'x_body_font_weight' );
  $body_weight           = x_get_font_weight( $body_weight_style );
  $body_key              = sanitize_key( $body_family );

  $headings_family       = x_get_google_fonts_family_query( x_get_option( 'x_headings_font_family' ) );
  $headings_weight_style = x_get_option( 'x_headings_font_weight' );
  $headings_weight       = x_get_font_weight( $headings_weight_style );
  $headings_key          = sanitize_key( $headings_family );

  $logo_family           = x_get_google_fonts_family_query( x_get_option( 'x_logo_font_family' ) );
  $logo_weight_style     = x_get_option( 'x_logo_font_weight' );
  $logo_weight           = x_get_font_weight( $logo_weight_style );
  $logo_key              = sanitize_key( $logo_family );

  $navbar_family         = x_get_google_fonts_family_query( x_get_option( 'x_navbar_font_family' ) );
  $navbar_weight_style   = x_get_option( 'x_navbar_font_weight' );
  $navbar_weight         = x_get_font_weight( $navbar_weight_style );
  $navbar_key            = sanitize_key( $navbar_family );


  //
  // Refined data.
  //

  $fonts = array();

  $fonts[$body_key]     = array( 'name' => $body_family,     'weights' => array(), 'source' => x_get_font_data( $body_family, 'source' ) );
  $fonts[$headings_key] = array( 'name' => $headings_family, 'weights' => array(), 'source' => x_get_font_data( $headings_family, 'source' ) );
  $fonts[$logo_key]     = array( 'name' => $logo_family,     'weights' => array(), 'source' => x_get_font_data( $logo_family, 'source' ) );
  $fonts[$navbar_key]   = array( 'name' => $navbar_family,   'weights' => array(), 'source' => x_get_font_data( $navbar_family, 'source' ) );

  array_push( $fonts[$body_key]['weights'],     $body_weight, $body_weight . 'italic', '700', '700italic' );
  array_push( $fonts[$headings_key]['weights'], $headings_weight_style );
  array_push( $fonts[$logo_key]['weights'],     $logo_weight_style );
  array_push( $fonts[$navbar_key]['weights'],   $navbar_weight_style );

  $fonts[$body_key]['weights']     = array_unique( $fonts[$body_key]['weights'] );
  $fonts[$headings_key]['weights'] = array_unique( $fonts[$headings_key]['weights'] );
  $fonts[$logo_key]['weights']     = array_unique( $fonts[$logo_key]['weights'] );
  $fonts[$navbar_key]['weights']   = array_unique( $fonts[$navbar_key]['weights'] );



  //
  // Families.
  //

  $families = '';

  foreach ( $fonts as $slug => $data ) {
    if ( $data['source'] != 'google' ) {
      continue;
    }
    $families .= $data['name'] . ':';
    foreach ( $data['weights'] as $weight ) {
      $families .= $weight . ',';
    }
    $families = rtrim( $families, ',' ) . '|';
  }

  $families = rtrim( $families, '|' );


  //
  // Subsets.
  //

  $subsets = 'latin,latin-ext';

  if ( x_get_option( 'x_google_fonts_subsets' ) == '1' ) {
    if ( x_get_option( 'x_google_fonts_subset_cyrillic' ) == '1'   ) { $subsets .= ',cyrillic,cyrillic-ext'; }
    if ( x_get_option( 'x_google_fonts_subset_greek' ) == '1'      ) { $subsets .= ',greek,greek-ext';       }
    if ( x_get_option( 'x_google_fonts_subset_vietnamese' ) == '1' ) { $subsets .= ',vietnamese';            }
  }


  //
  // Request (returns and empty string if Google Fonts are not used).
  //

  $args = array(
    'family' => $families,
    'subset' => $subsets
  );

  $request = ( x_is_google_fonts_used() ) ? add_query_arg( $args, '//fonts.googleapis.com/css' ) : '';

  return $request;

}



// Cache Request
// =============================================================================

//
// Cache Google Fonts request.
//

function x_cache_google_fonts_request() {

  $cached_request = get_option( 'x_cache_google_fonts_request', false );

  if ( $cached_request == false ) {

    $cached_request = x_get_google_fonts_request();

    update_option( 'x_cache_google_fonts_request', $cached_request );

  }

  return $cached_request;

}


//
// Cache bust.
//

function x_bust_google_fonts_cache() {

  delete_option( 'x_cache_google_fonts_request' );

}

add_action( 'customize_save_after', 'x_bust_google_fonts_cache' );



// Enqueue
// =============================================================================

function x_enqueue_google_fonts() {

  $google_fonts_request = x_cache_google_fonts_request();

  if ( $google_fonts_request != '' ) {
    wp_enqueue_style( 'x-google-fonts', $google_fonts_request, NULL, X_VERSION, 'all' );
  }

}