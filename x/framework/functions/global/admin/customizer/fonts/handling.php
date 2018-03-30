<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/FONTS/HANDLING.PHP
// -----------------------------------------------------------------------------
// Fonts handling.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Get Font Data
//   02. Is Font Italic
//   03. Get Font Weight
// =============================================================================

// Get Font Data
// =============================================================================

function x_get_font_data( $font_family, $font_family_data_key ) {

  $fonts_data  = x_fonts_data();
  $font_family = sanitize_key( $font_family );
  $font_data   = $fonts_data[$font_family][$font_family_data_key];

  return $font_data;

}



// Is Font Italic
// =============================================================================

function x_is_font_italic( $font_weight_and_style ) {

  if ( strpos( $font_weight_and_style, 'italic' ) ) {
    return true;
  } else {
    return false;
  }

}



// Get Font Weight
// =============================================================================

function x_get_font_weight( $font_weight_and_style ) {

  $font_weight = ( x_is_font_italic( $font_weight_and_style ) ) ? str_replace( 'italic', '', $font_weight_and_style ) : $font_weight_and_style;

  return $font_weight;

}