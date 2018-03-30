<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/FONTS/CONTROL-VALUES.PHP
// -----------------------------------------------------------------------------
// Fonts control values.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. All Families
//   02. All Weights
// =============================================================================

// All Families
// =============================================================================

function x_font_control_values_all_families() {

  $data = array();

  foreach ( x_fonts_data() as $slug => $font ) {

    $data[$font['family']] = $font['family'] . ' (' . ucwords( $font['source'] ) . ')';

  }

  return $data;

}



// All Weights
// =============================================================================

function x_font_control_values_all_weights() {

  $data = array(
    '100'       => __( '100 &ndash; Ultra Light', '__x__' ),
    '100italic' => __( '100 &ndash; Ultra Light (Italic)', '__x__' ),
    '200'       => __( '200 &ndash; Light', '__x__' ),
    '200italic' => __( '200 &ndash; Light (Italic)', '__x__' ),
    '300'       => __( '300 &ndash; Book', '__x__' ),
    '300italic' => __( '300 &ndash; Book (Italic)', '__x__' ),
    '400'       => __( '400 &ndash; Regular', '__x__' ),
    '400italic' => __( '400 &ndash; Regular (Italic)', '__x__' ),
    '500'       => __( '500 &ndash; Medium', '__x__' ),
    '500italic' => __( '500 &ndash; Medium (Italic)', '__x__' ),
    '600'       => __( '600 &ndash; Semi-Bold', '__x__' ),
    '600italic' => __( '600 &ndash; Semi-Bold (Italic)', '__x__' ),
    '700'       => __( '700 &ndash; Bold', '__x__' ),
    '700italic' => __( '700 &ndash; Bold (Italic)', '__x__' ),
    '800'       => __( '800 &ndash; Extra Bold', '__x__' ),
    '800italic' => __( '800 &ndash; Extra Bold (Italic)', '__x__' ),
    '900'       => __( '900 &ndash; Ultra Bold', '__x__' ),
    '900italic' => __( '900 &ndash; Ultra Bold (Italic)', '__x__' )
  );

  return $data;

}