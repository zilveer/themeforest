<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/REVOLUTION-SLIDER.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Remove Meta Boxes
//   02. Remove Notices
//   02. Get Slider Meta
//   03. Add Slider Meta
// =============================================================================

// Remove Meta Boxes
// =============================================================================

if ( ! function_exists( 'x_revolution_slider_remove_meta_boxes' ) ) :

  function x_revolution_slider_remove_meta_boxes() {

    if ( is_admin() ) {
      foreach ( get_post_types() as $post_type ) {
        remove_meta_box( 'mymetabox_revslider_0', $post_type, 'normal' );
      }
    }

  }

  add_action( 'do_meta_boxes', 'x_revolution_slider_remove_meta_boxes' );

endif;



// Remove Notices
// =============================================================================

function x_revolution_slider_remove_plugin_row_notices() {
  remove_action( 'after_plugin_row_revslider/revslider.php', array('RevSliderAdmin', 'show_purchase_notice') );
  remove_action( 'after_plugin_row_revslider/revslider.php', array('RevSliderAdmin', 'show_update_notice') );
}

add_action( 'admin_notices', 'x_revolution_slider_remove_plugin_row_notices' );



// Get Slider Data
// =============================================================================

//
// Refines slider information to be filtered into page meta options.
//

function x_revolution_slider_get_slider_meta() {

  $rs      = new RevSlider();
  $sliders = $rs->getArrSliders();
  $data    = array();

  foreach ( $sliders as $s ) {

    $key                  = 'x-slider-rs-' . $s->getID();
    $data[$key]['id']     = $s->getID();
    $data[$key]['slug']   = $s->getAlias();
    $data[$key]['name']   = $s->getTitle();
    $data[$key]['source'] = 'Revolution Slider';

  }

  return $data;

}



// Add Slider Meta
// =============================================================================

function x_revolution_slider_add_slider_meta( $meta ) {

  return array_merge( $meta, x_revolution_slider_get_slider_meta() );

}

add_filter( 'x_sliders_meta', 'x_revolution_slider_add_slider_meta' );