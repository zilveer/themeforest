<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/DEMO/HELPER.PHP
// -----------------------------------------------------------------------------
// Demo content helper functions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Demo Content Page: Home
//   02. Demo Content Page: Blog
//   03. Demo Content Page: Portfolio
//   04. Demo Content Categories
//   05. Demo Content Menu
//   06. Demo Content Image Downloader
// =============================================================================

// Demo Content Page: Home
// =============================================================================

function x_demo_content_home_page() {

  $page = x_get_page_by_title( 'Demo: Home' );

  if ( $page != NULL ) {
    return $page['ID'];
  } else {
    return false;
  }

}



// Demo Content Page: Blog
// =============================================================================

function x_demo_content_blog_page() {

  $page = x_get_page_by_title( 'Demo: Blog' );

  if ( $page != NULL ) {
    return $page['ID'];
  } else {
    return false;
  }

}



// Demo Content Page: Portfolio
// =============================================================================

function x_demo_content_portfolio_page() {

  $page = x_get_page_by_title( 'Demo: Portfolio' );

  if ( $page != NULL ) {
    return $page['ID'];
  } else {
    return false;
  }

}



// Demo Content Categories
// =============================================================================

function x_demo_content_add_categories( $categories, $taxonomy ) {

  $category_ids = array();

  foreach ( $categories as $key => $value ) {

    $t = wp_insert_term( $value, $taxonomy );

    if ( is_wp_error( $t ) ) {
      $category_ids[$key] = intval( $t->get_error_data() );
    } else {
      $category_ids[$key] = intval( $t['term_id'] );
    }

  }

  return $category_ids;

}



// Demo Content Menu
// =============================================================================

function x_demo_content_create_nav_menu( $menu_id, $front_page_is_page, $front_page_is_blog, $front_page_is_portfolio, $include_posts, $include_portfolio_items ) {

  if ( $front_page_is_page ) {

    wp_update_nav_menu_item( $menu_id, 0, array(
      'menu-item-title'     =>  __( 'Home', '__x__' ),
      'menu-item-object-id' => x_demo_content_home_page(),
      'menu-item-object'    => 'page',
      'menu-item-type'      => 'post_type',
      'menu-item-status'    => 'publish'
    ) );

    if ( $include_posts ) {

      wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     =>  __( 'Blog', '__x__' ),
        'menu-item-object-id' => x_demo_content_blog_page(),
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish'
      ) );

    }

    if ( $include_portfolio_items ) {

      wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     =>  __( 'Portfolio', '__x__' ),
        'menu-item-object-id' => x_demo_content_portfolio_page(),
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish'
      ) );

    }


  //
  // If front page is blog.
  //

  } elseif ( $front_page_is_blog ) {

    wp_update_nav_menu_item( $menu_id, 0, array(
      'menu-item-title'  =>  __( 'Home', '__x__' ),
      'menu-item-url'    => home_url( '/' ),
      'menu-item-status' => 'publish'
    ) );

    if ( $include_portfolio_items ) {

      wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     =>  __( 'Portfolio', '__x__' ),
        'menu-item-object-id' => x_demo_content_portfolio_page(),
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish'
      ) );

    }


  //
  // If front page is portfolio.
  //

  } elseif ( $front_page_is_portfolio ) {

    wp_update_nav_menu_item( $menu_id, 0, array(
      'menu-item-title'     =>  __( 'Home', '__x__' ),
      'menu-item-object-id' => x_demo_content_portfolio_page(),
      'menu-item-object'    => 'page',
      'menu-item-type'      => 'post_type',
      'menu-item-status'    => 'publish'
    ) );

    if ( $include_posts ) {

      wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'     =>  __( 'Blog', '__x__' ),
        'menu-item-object-id' => x_demo_content_blog_page(),
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish'
      ) );

    }

  }

}



// Demo Content Image Downloader
// =============================================================================

function x_demo_content_sideload_img( $img_url, $entry_id, $use_cache = true ) {

  //
  // If this image has already been downloaded, we can just reuse the ID.
  //

  $cache = wp_cache_get( 'x_demo_content_images' );

  if ( isset( $cache[$img_url] ) && $use_cache ) {
    return $cache[$img_url];
  }


  //
  // 1. Setup $file_array parameter for media_handle_sideload(), which is
  //    an array similar to a $_FILES upload array.
  // 2. Check for download errors.
  // 3. Creates the attachment post in the database.
  // 4. Check for media_handle_sideload() errors.
  //

  $tmp        = download_url( $img_url ); // 1
  $file_array = array(
    'name'     => basename( $img_url ),
    'tmp_name' => $tmp
  );

  if ( is_wp_error( $tmp ) ) { // 2
    unlink( $file_array['tmp_name'] );
    return $tmp;
  }

  $img_id = media_handle_sideload( $file_array, $entry_id, 'Demo Image' ); // 3

  if ( is_wp_error( $img_id ) ) { // 4
    unlink( $file_array['tmp_name'] );
    return $img_id;
  }


  //
  // Pair the image URL and attachement ID in the cache.
  //

  $cache[$img_url] = $img_id;
  $cache           = wp_cache_set( 'x_demo_content_images', $cache );

  return $img_id;

}