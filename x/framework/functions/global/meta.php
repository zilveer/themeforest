<?php

// =============================================================================
// FUNCTIONS/GLOBAL/META.PHP
// -----------------------------------------------------------------------------
// Additions and alterations to site headers and <head> meta data.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Add Headers
//   02. Filter <title> Output
//   03. Generic <head> Meta Data
//   04. Site Icons <head> Meta Data
// =============================================================================

// Add Headers
// =============================================================================

if ( ! function_exists( 'x_add_headers' ) ) :
  function x_add_headers( $headers ) {

    if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) {
      $headers['X-UA-Compatible'] = 'IE=edge';
    }

    return $headers;

  }
  add_filter( 'wp_headers', 'x_add_headers' );
endif;



// Filter <title> Output
// =============================================================================

if ( ! function_exists( 'x_wp_title' ) ) :
  function x_wp_title( $title ) {

    if ( is_front_page() ) {
      return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
    } elseif ( is_feed() ) {
      return ' | RSS Feed';
    } else {
      return trim( $title ) . ' | ' . get_bloginfo( 'name' ); 
    }

  }
  add_filter( 'wp_title', 'x_wp_title' );
endif;



// Generic <head> Meta Data
// =============================================================================

if ( ! function_exists( 'x_head_meta' ) ) :
  function x_head_meta() {

    x_get_view( 'global', '_meta' );

  }
  add_action( 'wp_head', 'x_head_meta', 0 );
endif;



// Site Icons <head> Meta Data
// =============================================================================

if ( ! function_exists( 'x_site_icons' ) ) :
  function x_site_icons() {

    $icon_favicon       = x_get_option( 'x_icon_favicon' );
    $icon_touch         = x_get_option( 'x_icon_touch' );
    $icon_tile          = x_get_option( 'x_icon_tile' );
    $icon_tile_bg_color = x_get_option( 'x_icon_tile_bg_color' );

    if ( $icon_favicon != '' ) {
      echo '<link rel="shortcut icon" href="' . x_make_protocol_relative( $icon_favicon ) . '">';
    }

    if ( $icon_touch != '' ) {
      echo '<link rel="apple-touch-icon-precomposed" href="' . x_make_protocol_relative( $icon_touch ) . '">';
    }

    if ( $icon_tile != '' ) {
      echo '<meta name="msapplication-TileColor" content="' . $icon_tile_bg_color . '">';
      echo '<meta name="msapplication-TileImage" content="' . x_make_protocol_relative( $icon_tile ) . '">';
    }

  }
  add_action( 'wp_head', 'x_site_icons', 0 );
endif;