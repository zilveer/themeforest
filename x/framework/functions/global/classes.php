<?php

// =============================================================================
// FUNCTIONS/GLOBAL/CLASSES.PHP
// -----------------------------------------------------------------------------
// Outputs custom classes for various elements, sometimes depending on options
// selected in the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Body Class
//   02. Post Class
//   03. Brand Class
//   04. Masthead Class
//   05. Navbar Class
//   06. Navigation Item Class
//   07. Main Content Class
//   08. Sidebar Class
//   09. Portfolio Entry Class
// =============================================================================

// Body Class
// =============================================================================

if ( ! function_exists( 'x_body_class' ) ) :
  function x_body_class( $output ) {

    $stack                            = x_get_stack();
    $entry_id                         = get_the_ID();

    $is_blog                          = is_home();
    $blog_style_masonry               = x_get_option( 'x_blog_style' ) == 'masonry';
    $post_meta_disabled               = x_get_option( 'x_blog_enable_post_meta' ) == '';

    $is_archive                       = is_archive();
    $archive_style_masonry            = x_get_option( 'x_archive_style' ) == 'masonry';
    $is_shop                          = x_is_shop();

    $is_page                          = is_page();
    $page_title_disabled              = get_post_meta( $entry_id, '_x_entry_disable_page_title', true ) == 'on';

    $is_portfolio                     = is_page_template( 'template-layout-portfolio.php' );
    $portfolio_meta_disabled          = x_get_option( 'x_portfolio_enable_post_meta' ) == '';

    $integrity_design_dark            = x_get_option( 'x_integrity_design' ) == 'dark';
    $icon_blank_sidebar_active        = $stack == 'icon' && get_post_meta( $entry_id, '_x_icon_blank_template_sidebar', true ) == 'Yes'; 
    $ethos_post_slider_blog_active    = $stack == 'ethos' && is_home() && x_get_option( 'x_ethos_post_slider_blog_enable' ) == 1;
    $ethos_post_slider_archive_active = $stack == 'ethos' && ( is_category() || is_tag() ) && x_get_option( 'x_ethos_post_slider_archive_enable' ) == 1;

    $custom_class                     = get_post_meta( $entry_id, '_x_entry_body_css_class', true );


    //
    // Stack.
    //

    $output[] .= 'x-' . $stack;

    if ( $stack == 'integrity' ) {
      if ( $integrity_design_dark ) {
        $output[] .= 'x-integrity-dark';
      } else {
        $output[] .= 'x-integrity-light';
      }
    }


    //
    // Navbar.
    //

    switch ( x_get_navbar_positioning() ) {
      case 'static-top' :
        $output[] .= 'x-navbar-static-active';
        break;
      case 'fixed-top' :
        $output[] .= 'x-navbar-fixed-top-active';
        break;
      case 'fixed-left' :
        $output[] .= 'x-navbar-fixed-left-active';
        break;
      case 'fixed-right' :
        $output[] .= 'x-navbar-fixed-right-active';
        break;
    }

    if ( x_is_one_page_navigation() ) {
      $output[] .= 'x-one-page-navigation-active';
    }


    //
    // Site layout.
    //

    switch ( x_get_site_layout() ) {
      case 'boxed' :
        $output[] .= 'x-boxed-layout-active';
        break;
      case 'full-width' :
        $output[] .= 'x-full-width-layout-active';
        break;
    }


    //
    // Content layout.
    //

    switch ( x_get_content_layout() ) {
      case 'content-sidebar' :
        $output[] .= 'x-content-sidebar-active';
        break;
      case 'sidebar-content' :
        $output[] .= 'x-sidebar-content-active';
        break;
      case 'full-width' :
        $output[] .= 'x-full-width-active';
        break;
    }


    //
    // Blog and posts.
    //

    if ( $is_blog ) {
      if ( $blog_style_masonry ) {
        $output[] .= 'x-masonry-active x-blog-masonry-active';
      } else {
        $output[] .= 'x-blog-standard-active';
      }
    }

    if ( $post_meta_disabled ) {
      $output[] .= 'x-post-meta-disabled';
    }


    //
    // Archives.
    //

    if ( $is_archive && ! $is_shop ) {
      if ( $archive_style_masonry ) {
        $output[] .= 'x-masonry-active x-archive-masonry-active';
      } else {
        $output[] .= 'x-archive-standard-active';
      }
    }


    //
    // Pages.
    //

    if ( $is_page ) {
      if ( $page_title_disabled ) {
        $output[] .= 'x-page-title-disabled';
      }
    }


    //
    // Portfolio.
    //

    if ( $is_portfolio ) {
      $output[] .= 'x-masonry-active x-portfolio-masonry-active';
    }

    if ( $portfolio_meta_disabled ) {
      $output[] .= 'x-portfolio-meta-disabled';
    }


    //
    // Icon.
    //

    if ( $icon_blank_sidebar_active ) {
      $output[] .= 'x-blank-template-sidebar-active';
    }


    //
    // Ethos.
    //

    if ( $ethos_post_slider_blog_active ) {
      $output[] .= 'x-post-slider-blog-active';
    }

    if ( $ethos_post_slider_archive_active ) {
      $output[] .= 'x-post-slider-archive-active';
    }


    //
    // Custom.
    //

    if ( $custom_class != '' ) {
      $output[] .= $custom_class;
    }

    return $output;

  }
  add_filter( 'body_class', 'x_body_class' );
endif;


if ( ! function_exists( 'x_body_class_info' ) ) :
  function x_body_class_info( $output ) {

    $version  = str_replace( '.', '_', X_VERSION );
    $is_child = is_child_theme();

    $output[] = 'x-v' . $version;

    if ( $is_child ) {
      $output[] = 'x-child-theme-active';
    }

    return $output;

  }
  add_filter( 'body_class', 'x_body_class_info', 10000 );
endif;


if ( ! function_exists( 'x_admin_body_class' ) ) :
  function x_admin_body_class( $classes ) {

    $screen = get_current_screen();

    $classes .= ' x-theme-active';
    $classes .= ' x-' . x_get_stack();

    if ( $screen->base == 'widgets' ) {
      $classes .= ' x-header-widgets-' . x_header_widget_areas_count();
      $classes .= ' x-footer-widgets-' . x_footer_widget_areas_count();
    }

    return $classes;

  }
  add_filter( 'admin_body_class', 'x_admin_body_class' );
endif;



// Post Class
// =============================================================================

if ( ! function_exists( 'x_post_class' ) ) :
  function x_post_class( $output ) {

    switch ( has_post_thumbnail() ) {
      case true :
        $output[] = 'has-post-thumbnail';
        break;
      case false :
        $output[] = 'no-post-thumbnail';
        break;
    }

    return $output;

  }
  add_filter( 'post_class', 'x_post_class' );
endif;



// Brand Class
// =============================================================================

if ( ! function_exists( 'x_brand_class' ) ) :
  function x_brand_class() {

    switch ( x_get_option( 'x_logo' ) ) {
      case '' :
        $output = 'x-brand text';
        break;
      default :
        $output = 'x-brand img';
        break;
    }

    echo $output;

  }
endif;



// Masthead Class
// =============================================================================

if ( ! function_exists( 'x_masthead_class' ) ) :
  function x_masthead_class() {

    $navbar_positioning = x_get_navbar_positioning();
    $logo_nav_layout    = x_get_logo_navigation_layout();

    if ( $logo_nav_layout == 'stacked' && ( $navbar_positioning == 'static-top' || $navbar_positioning == 'fixed-top' ) ) :
      $output = 'masthead masthead-stacked';
    else :
      $output = 'masthead masthead-inline';
    endif;

    echo $output;

  }
endif;



// Navbar Class
// =============================================================================

if ( ! function_exists( 'x_navbar_class' ) ) :
  function x_navbar_class() {

    switch ( x_get_navbar_positioning() ) {
      case 'fixed-left' :
        $output = 'x-navbar x-navbar-fixed-left';
        break;
      case 'fixed-right' :
        $output = 'x-navbar x-navbar-fixed-right';
        break;
      default :
        $output = 'x-navbar';
        break;
    }

    echo $output;

  }
endif;



// Navigation Item Class
// =============================================================================

if ( ! function_exists( 'x_navigation_item_class' ) ) :
  function x_navigation_item_class( $classes, $item ) {

    if ( $item->type == 'taxonomy' ) {
      $classes[] = 'tax-item tax-item-' . $item->object_id;
    }

    return $classes;

  }
  add_filter( 'nav_menu_css_class', 'x_navigation_item_class', 10, 2 );
endif;



// Main Content Class
// =============================================================================

if ( ! function_exists( 'x_main_content_class' ) ) :
  function x_main_content_class() {

    switch ( x_get_content_layout() ) {
      case 'content-sidebar' :
        $output = 'x-main left';
        break;
      case 'sidebar-content' :
        $output = 'x-main right';
        break;
      case 'full-width' :
        $output = 'x-main full';
        break;
    }

    echo $output;

  }
endif;



// Sidebar Class
// =============================================================================

if ( ! function_exists( 'x_sidebar_class' ) ) :
  function x_sidebar_class() {

    switch ( x_get_content_layout() ) {
      case 'content-sidebar' :
        $output = 'x-sidebar right';
        break;
      case 'sidebar-content' :
        $output = 'x-sidebar left';
        break;
      default :
        $output = 'x-sidebar right';
    }

    echo $output;

  }
endif;



// Portfolio Entry Class
// =============================================================================

if ( ! function_exists( 'x_portfolio_entry_classes' ) ) :
  function x_portfolio_entry_classes( $classes ) {

    GLOBAL $post;
    $terms = wp_get_object_terms( $post->ID, 'portfolio-category' );
    foreach ( $terms as $term ) {
      $classes[] = 'x-portfolio-' . md5( $term->slug );
    }
    return $classes;

  }
  add_filter( 'post_class', 'x_portfolio_entry_classes' );
endif;