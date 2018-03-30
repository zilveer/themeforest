<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/DEMO/SETUP.PHP
// -----------------------------------------------------------------------------
// Setup demo content.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Variables
//   02. Demo Content Helper Functions
//   03. Update Home Content if Page Already Exists
//   04. Update Customizer Settings
//   05. Require Data Files
//   06. Process Data Files
//   07. Clear Image Cache
//   08. Set Page Options
//   09. Create Menu
//   10. Clear Stages
// =============================================================================

// Set Variables
// =============================================================================

//
// Front page.
//

$front_page              = $data['front-page'];
$front_page_is_page      = $front_page == 'Page';
$front_page_is_blog      = $front_page == 'Blog';
$front_page_is_portfolio = $front_page == 'Portfolio';
$front_page_template     = $data['page-template'];
$front_page_meta         = $data['meta'];

$front_page_content      = $data['cs-content'];
$front_page_cs_data      = $data['cs-data'];
$front_page_cs_settings  = $data['cs-settings'];


//
// Miscellaneous.
//

$customizer_settings     = is_array( $data['xcs'] ) ? $data['xcs'] : array();
$include_posts           = $_POST['standard_posts'] == 'yes';
$include_portfolio_items = $_POST['standard_portfolio_items'] == 'yes';
$content_url             = X_TEMPLATE_URL . '/framework/functions/global/admin/addons/demo/standard/content';

// Demo Content Helper Functions
// =============================================================================

require_once( 'helper.php' );



// Update Home Content if Page Already Exists
// =============================================================================

if ( x_demo_content_stage_not_completed( 'update-home-content' ) ) {

  $existing_home_page = x_demo_content_home_page();

  if ( $existing_home_page ) {
    wp_delete_post( $existing_home_page, true );
  }

  x_demo_content_set_stage_completed( 'update-home-content' );

}



// Update Customizer Settings
// =============================================================================

if ( x_demo_content_stage_not_completed( 'xcs-import' ) ) {

  foreach ( $customizer_settings as $key => $value ) {
    update_option( $key, $value );
  }

  require_once( 'xcs.php' );

  x_demo_content_set_stage_completed( 'xcs-import' );

  x_bust_google_fonts_cache();
}



// Require Data Files
// =============================================================================

require_once( 'data-pages.php' );
require_once( 'data-posts.php' );
require_once( 'data-portfolio-items.php' );



// Process Data Files
// =============================================================================

if ( x_demo_content_stage_not_completed( 'process-data-files' ) ) {

  //
  // Form array of all entries to be added and process them if it isn't empty.
  //

  $entries = array_merge( $pages, $posts, $portfolio_items );

  if ( ! empty( $entries ) ) {
    foreach ( $entries as $key => $entry ) {

      if ( $entry['post_type'] == 'page' && x_get_page_by_title( $entry['post_title'] ) ) {
        continue;
      } elseif ( $entry['post_type'] == 'post' && x_get_post_by_title( $entry['post_title'] ) ) {
        continue;
      } elseif ( $entry['post_type'] == 'x-portfolio' && x_get_portfolio_item_by_title( $entry['post_title'] ) ) {
        continue;
      }


      //
      // If 'x_meta' exists in array, store it in a variable for later use then
      // unset it before passing into wp_insert_post().
      //

      if ( array_key_exists( 'x_info', $entry ) ) {
        $x = $entry['x_info']; unset( $entry['x_info'] );
      }


      //
      // Insert entry based on data and store its ID in a variable for later use
      // as it is needed for certain operations like setting the featured image
      // and altering post meta.
      //

      $entry_id = wp_insert_post( $entry, false );


      //
      // Set post format.
      //

      if ( isset( $x['post_format'] ) ) {
        set_post_format( $entry_id, $x['post_format'] ); unset( $x['post_format'] );
      }


      //
      // Set images.
      //

      if ( isset( $x['images'] ) ) {
        foreach ( $x['images'] as $img_role => $img_url ) {

          $use_cache = ( strpos( $img_role, 'gallery' ) === false );
          $img_id    = x_demo_content_sideload_img( $img_url, $entry_id, $use_cache );

          if ( $img_role == 'featured' ) {
            set_post_thumbnail( $entry_id, $img_id );
          }

        }
        unset( $x['images'] );
      }


      //
      // Set meta.
      //

      if ( isset( $x['meta'] ) ) {
        foreach ( $x['meta'] as $key => $value ) {
          update_post_meta( $entry_id, $key, $value );
        }
        unset( $x['meta'] );
      }

      if ( isset( $x['cs_data'] ) ) {
        update_post_meta( $entry_id, '_cornerstone_data', $x['cs_data'] );
      }

      if ( isset( $x['cs_settings'] ) ) {
        update_post_meta( $entry_id, '_cornerstone_settings', $x['cs_settings'] );
      }

    }
  }

  x_demo_content_set_stage_completed( 'process-data-files' );

}



// Clear Image Cache
// =============================================================================

wp_cache_delete( 'x_demo_content_images' );



// Set Page Options
// =============================================================================

if ( x_demo_content_stage_not_completed( 'set-page-options' ) ) {

  if ( $front_page_is_page ) {

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', x_demo_content_home_page() );

    if ( x_demo_content_blog_page() ) {
      update_option( 'page_for_posts', x_demo_content_blog_page() );
    }

  } elseif ( $front_page_is_blog ) {

    update_option( 'show_on_front', 'posts' );

  } elseif ( $front_page_is_portfolio ) {

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', x_demo_content_portfolio_page() );

    if ( x_demo_content_blog_page() ) {
      update_option( 'page_for_posts', x_demo_content_blog_page() );
    }

  }

  x_demo_content_set_stage_completed( 'set-page-options' );

}



// Create Menu
// =============================================================================

if ( x_demo_content_stage_not_completed( 'create-menu' ) ) {

  //
  // Check if the menu exists and delete it if it does.
  //

  $menu_name   = 'X Demo Menu';
  $menu_exists = wp_get_nav_menu_object( $menu_name );

  if ( $menu_exists ) {
    wp_delete_nav_menu( $menu_name );
  }


  //
  // Create a new demo menu.
  //

  $new_menu_id = wp_create_nav_menu( $menu_name );

  x_demo_content_create_nav_menu( $new_menu_id, $front_page_is_page, $front_page_is_blog, $front_page_is_portfolio, $include_posts, $include_portfolio_items );


  //
  // Assign new menu to all available locations.
  //

  $menu_locations = get_theme_mod( 'nav_menu_locations' );

  $menu_locations['primary'] = $new_menu_id;
  $menu_locations['footer']  = $new_menu_id;

  set_theme_mod( 'nav_menu_locations', $menu_locations );

  x_demo_content_set_stage_completed( 'create-menu' );

}



// Clear Stages
// =============================================================================

x_demo_content_clear_stages();