<?php

// =============================================================================
// FUNCTIONS/GLOBAL/NAVBAR.PHP
// -----------------------------------------------------------------------------
// Handles all custom functionality for the navbar.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Get One Page Navigation Menu
//   02. Is One Page Navigation
//   03. Output Primary Navigation
//   04. Get Navbar Positioning
//   05. Get Logo and Navigation Layout
//   06. Navbar Searchform Popup
//   07. Navbar Search Navigation Item
// =============================================================================

// Get One Page Navigation Menu
// =============================================================================

if ( ! function_exists( 'x_get_one_page_navigation_menu' ) ) :
  function x_get_one_page_navigation_menu() {

    $meta = get_post_meta( get_the_ID(), '_x_page_one_page_navigation', true );
    $menu = ( $meta == '' ) ? 'Deactivated' : $meta;

    return $menu;

  }
endif;



// Is One Page Navigation
// =============================================================================

if ( ! function_exists( 'x_is_one_page_navigation' ) ) :
  function x_is_one_page_navigation() {

    $one_page_navigation = x_get_one_page_navigation_menu();

    if ( $one_page_navigation == 'Deactivated' ) {
      $output = false;
    } else {
      $output = true;
    }

    return $output;

  }
endif;



// Output Primary Navigation
// =============================================================================

if ( ! function_exists( 'x_output_primary_navigation' ) ) :
  function x_output_primary_navigation() {

    if ( x_is_one_page_navigation() ) {

      wp_nav_menu( array(
        'menu'           => x_get_one_page_navigation_menu(),
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'x-nav x-nav-scrollspy',
        'link_before'    => '<span>',
        'link_after'     => '</span>'
      ) );

    } elseif ( has_nav_menu( 'primary' ) ) {

      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'x-nav',
        'link_before'    => '<span>',
        'link_after'     => '</span>'
      ) );

    } else {

      echo '<ul class="x-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';

    }

  }
endif;



// Get Navbar Positioning
// =============================================================================

if ( ! function_exists( 'x_get_navbar_positioning' ) ) :
  function x_get_navbar_positioning() {

    if ( x_is_one_page_navigation() ) {
      $output = 'fixed-top';
    } else {
      $output = x_get_option( 'x_navbar_positioning' );
    }

    return $output;

  }
  add_action( 'customize_save', 'x_get_navbar_positioning' );
endif;



// Get Logo and Navigation Layout
// =============================================================================

if ( ! function_exists( 'x_get_logo_navigation_layout' ) ) :
  function x_get_logo_navigation_layout() {

    return x_get_option( 'x_logo_navigation_layout' );

  }
endif;



// Navbar Searchform Popup
// =============================================================================

if ( ! function_exists( 'x_navbar_searchform_overlay' ) ) :
  function x_navbar_searchform_overlay() {

    if ( x_get_option( 'x_header_search_enable' ) == '1' ) :

      ?>

      <div class="x-searchform-overlay">
        <div class="x-searchform-overlay-inner">
          <div class="x-container max width">
            <form method="get" id="searchform" class="form-search center-text" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <label for="s" class="cfc-h-tx tt-upper"><?php _e( 'Type and Press &ldquo;enter&rdquo; to Search', '__x__' ); ?></label>
              <input type="text" id="s" class="search-query cfc-h-tx center-text tt-upper" name="s">
            </form>
          </div>
        </div>
      </div>

      <?php

    endif;

  }
  add_action( 'x_before_site_end', 'x_navbar_searchform_overlay' );
endif;



// Navbar Search Navigation Item
// =============================================================================

if ( ! function_exists( 'x_navbar_search_navigation_item' ) ) :
  function x_navbar_search_navigation_item( $items, $args ) {

    if ( x_get_option( 'x_header_search_enable' ) == '1' ) {
      if ( $args->theme_location == 'primary' ) {
        $items .= '<li class="menu-item x-menu-item x-menu-item-search">'
                  . '<a href="#" class="x-btn-navbar-search">'
                    . '<span><i class="x-icon-search" data-x-icon="&#xf002;" aria-hidden="true"></i><span class="x-hidden-desktop"> ' . __( 'Search', '__x__' ) . '</span></span>'
                  . '</a>'
                . '</li>';
      }
    }

    return $items;

  }
  add_filter( 'wp_nav_menu_items', 'x_navbar_search_navigation_item', 9998, 2 );
endif;