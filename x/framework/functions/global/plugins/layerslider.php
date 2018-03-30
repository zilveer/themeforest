<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/LAYERSLIDER.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Theme Setup
//   02. Get Slider Meta
//   03. Add Slider Meta
// =============================================================================

// Theme Setup
// =============================================================================

if ( ! function_exists( 'x_layerslider_theme_setup' ) ) :

  function x_layerslider_theme_setup() {

    $GLOBALS['lsAutoUpdateBox'] = false;

    remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice' );

  }

  add_action( 'layerslider_ready', 'x_layerslider_theme_setup' );

endif;



// Get Slider Meta
// =============================================================================

//
// Refines slider information to be filtered into page meta options.
//

function x_layerslider_get_slider_meta() {

  $sliders = LS_Sliders::find( array( 'order' => 'ASC', 'limit' => 100 ) );
  $data    = array();

  foreach ( $sliders as $s ) {

    $key                  = 'x-slider-ls-' . $s['id'];
    $data[$key]['id']     = $s['id'];
    $data[$key]['slug']   = $s['slug'];
    $data[$key]['name']   = $s['name'];
    $data[$key]['source'] = 'LayerSlider';

  }

  return $data;

}



// Add Slider Meta
// =============================================================================

function x_layerslider_add_slider_meta( $meta ) {

  return array_merge( $meta, x_layerslider_get_slider_meta() );

}

add_filter( 'x_sliders_meta', 'x_layerslider_add_slider_meta' );