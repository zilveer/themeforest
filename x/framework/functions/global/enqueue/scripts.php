<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ENQUEUE/SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Theme scripts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Site Scripts
//   02. Enqueue Admin Scripts
//   03. Enqueue Customizer Scripts
// =============================================================================

// Enqueue Site Scripts
// =============================================================================

if ( ! function_exists( 'x_enqueue_site_scripts' ) ) :
  function x_enqueue_site_scripts() {

    $ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.js' : '.min.js';

    wp_register_script( 'x-site-head', X_TEMPLATE_URL . "/framework/js/dist/site/x-head$ext", array( 'jquery' ), X_VERSION, false );
    wp_register_script( 'x-site-body', X_TEMPLATE_URL . "/framework/js/dist/site/x-body$ext", array( 'jquery' ), X_VERSION, true );
    wp_register_script( 'x-site-icon', X_TEMPLATE_URL . "/framework/js/dist/site/x-icon$ext", array( 'jquery' ), X_VERSION, true );

    wp_enqueue_script( 'x-site-head' );
    wp_enqueue_script( 'x-site-body' );

    if ( x_get_stack() == 'icon' ) {
      wp_enqueue_script( 'x-site-icon' );
    }

    if ( is_singular() ) {
      wp_enqueue_script( 'comment-reply' );
    }

    if ( X_BUDDYPRESS_IS_ACTIVE ) {
      wp_dequeue_script( 'bp-legacy-js' );
      wp_dequeue_script( 'bp-parent-js' );
      wp_enqueue_script( 'x-site-buddypress', X_TEMPLATE_URL . '/framework/js/dist/site/x-buddypress.js', bp_core_get_js_dependencies(), X_VERSION, false );
      wp_localize_script( 'x-site-buddypress', 'BP_DTheme', x_buddypress_core_get_js_strings() );
    }

  }
  add_action( 'wp_enqueue_scripts', 'x_enqueue_site_scripts' );
endif;



// Enqueue Admin Scripts
// =============================================================================

if ( ! function_exists( 'x_enqueue_post_meta_scripts' ) ) :
  function x_enqueue_post_meta_scripts( $hook ) {

    GLOBAL $post;
    GLOBAL $wp_customize;

    if ( isset( $wp_customize ) ) {
      return;
    }

    $ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.js' : '.min.js';

    wp_enqueue_script( 'wp-color-picker' );

    if ( strpos( $hook, 'x-addons' ) !== false ) {
      wp_register_script( 'x-addons-home-js', X_TEMPLATE_URL . "/framework/js/dist/admin/x-addons-home{$ext}", array( x_tco()->handle( 'admin-js' ) ), X_VERSION, true );
      wp_localize_script( 'x-addons-home-js', 'xAddonsHome', apply_filters( '_x_addons_home_data', array() ) );
      wp_enqueue_script( 'x-addons-home-js' );
    }

    if ( $hook == 'widgets.php' ) {
      wp_enqueue_script( 'x-widgets-js', X_TEMPLATE_URL . "/framework/js/dist/admin/x-widgets{$ext}", array( 'jquery' ), X_VERSION, true );
    }

    if ( $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'edit-tags.php' ) {
      wp_enqueue_script( 'x-meta-js', X_TEMPLATE_URL . "/framework/js/dist/admin/x-meta{$ext}", array( 'jquery', 'media-upload', 'thickbox' ), X_VERSION, true );
    }

    if ( $hook == 'post.php' || $hook == 'post-new.php' || strpos( $hook, 'x-extensions' ) != false ) {
      wp_enqueue_script( 'jquery-ui-datepicker' );
    }

  }
  add_action( 'admin_enqueue_scripts', 'x_enqueue_post_meta_scripts' );
endif;



// Enqueue Customizer Scripts
// =============================================================================

//
// Controls.
//

if ( ! function_exists( 'x_enqueue_customizer_controls_scripts' ) ) :
  function x_enqueue_customizer_controls_scripts() {

    $ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.js' : '.min.js';

    wp_register_script( 'x-customizer-controls-js', X_TEMPLATE_URL . "/framework/js/dist/admin/x-customizer-controls$ext", array( 'jquery' ), X_VERSION, true );

    wp_localize_script( 'x-customizer-controls-js', 'x_customizer_controls_data', array(
      'x_fonts_data' => x_fonts_data()
    ) );

    wp_enqueue_script( 'x-customizer-controls-js' );

  }
  add_action( 'customize_controls_print_footer_scripts', 'x_enqueue_customizer_controls_scripts' );
endif;


//
// Preview.
//

if ( ! function_exists( 'x_enqueue_customizer_preview_scripts' ) ) :
  function x_enqueue_customizer_preview_scripts() {

    $ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.js' : '.min.js';

    wp_register_script( 'x-customizer-preview-js', X_TEMPLATE_URL . "/framework/js/dist/admin/x-customizer-preview$ext", array( 'jquery', 'customize-preview', 'heartbeat' ), X_VERSION, true );

    wp_localize_script( 'x-customizer-preview-js', 'x_customizer_preview_data', array(
      'x_woocommerce_is_active' => X_WOOCOMMERCE_IS_ACTIVE
    ) );

    wp_enqueue_script( 'x-customizer-preview-js' );

  }
  add_action( 'customize_preview_init', 'x_enqueue_customizer_preview_scripts' );
endif;