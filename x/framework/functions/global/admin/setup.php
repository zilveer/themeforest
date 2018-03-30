<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/SETUP.PHP
// -----------------------------------------------------------------------------
// Sets up theme defaults and registers various WordPress features.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Content Width
//   02. Theme Setup
//   03. Bust Caches
// =============================================================================

// Content Width
// =============================================================================

if ( ! isset( $content_width ) ) :

  $stack = x_get_stack();

  switch ( $stack ) {
    case 'integrity' :
      $content_width = x_post_thumbnail_width() - 120;
      break;
    case 'renew' :
      $content_width = x_post_thumbnail_width();
      break;
    case 'icon' :
      $content_width = x_post_thumbnail_width();
      break;
    case 'ethos' :
      $content_width = x_post_thumbnail_width();
      break;
  }

endif;



// Theme Setup
// =============================================================================

if ( ! function_exists( 'x_setup_theme' ) ) :
  function x_setup_theme() {

    //
    // Localization.
    //
    // Translations can be added to the /framework/lang/ directory.
    //

    load_theme_textdomain( '__x__', X_TEMPLATE_PATH . '/framework/lang' );


    //
    // Automatic feed links.
    //
    // Adds RSS feed links to <head> for posts and comments.
    //

    add_theme_support( 'automatic-feed-links' );


    //
    // Post formats.
    //
    // Adds support for a variety of post formats.
    //

    add_theme_support( 'post-formats', array( 'link', 'gallery', 'quote', 'image', 'video', 'audio' ) );


    //
    // WordPress menus.
    //
    // This theme uses wp_nav_menu() in two locations.
    //

    register_nav_menus( array(
      'primary' => __( 'Primary Menu', '__x__' ),
      'footer'  => __( 'Footer Menu', '__x__' )
    ) );


    //
    // Featured images.
    //
    // Theme support for featured images and thumbnail sizes.
    //

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 100, 9999 );
    add_image_size( 'entry',                   x_post_thumbnail_width(),      9999,                                   false );
    add_image_size( 'entry-cropped',           x_post_thumbnail_width(),      x_post_thumbnail_cropped_height(),      true  );
    add_image_size( 'entry-fullwidth',         x_post_thumbnail_width_full(), 9999,                                   false );
    add_image_size( 'entry-cropped-fullwidth', x_post_thumbnail_width_full(), x_post_thumbnail_cropped_height_full(), true  );


    //
    // WooCommerce.
    //
    // Theme support for the WooCommerce plugin.
    //

    add_theme_support( 'woocommerce' );


    //
    // Allow shortcodes in widgets.
    //

    add_filter( 'widget_text', 'do_shortcode' );


    //
    // Remove unnecessary stuff.
    //
    // 1. Version number (for security).
    // 2. Really simple discovery.
    // 3. Windows live writer.
    // 4. Post relational links.
    //

    remove_action( 'wp_head', 'wp_generator' );                    // 1
    remove_action( 'wp_head', 'rsd_link' );                        // 2
    remove_action( 'wp_head', 'wlwmanifest_link' );                // 3
    remove_action( 'wp_head', 'start_post_rel_link' );             // 4
    remove_action( 'wp_head', 'index_rel_link' );                  // 4
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ); // 4

  }
  add_action( 'after_setup_theme', 'x_setup_theme' );
endif;



// Bust Caches
// =============================================================================

if ( ! function_exists( 'x_bust_caches' ) ) :
  function x_bust_caches() {

    if ( isset( $_GET['x-bust-caches'] ) ) {
      x_bust_google_fonts_cache();
    }

  }
  add_action( 'admin_init', 'x_bust_caches' );
endif;