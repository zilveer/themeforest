<?php

// =============================================================================
// FUNCTIONS/GLOBAL/BREADCRUMBS.PHP
// -----------------------------------------------------------------------------
// Sets up the breadcrumb navigation for the theme.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Breadcrumbs
// =============================================================================

// Breadcrumb Delimiter
// =============================================================================

if ( ! function_exists( 'x_get_breadcrumb_delimiter' ) ) :
  function x_get_breadcrumb_delimiter() {

    $is_ltr = ! is_rtl();

    return ' <span class="delimiter"><i class="x-icon-angle-' . ( ( $is_ltr ) ? 'right' : 'left' ) . '" data-x-icon="&#x' . ( ( $is_ltr ) ? 'f105' : 'f104' ) . ';"></i></span> ';

  }
endif;



// Breadcrumb Home Text
// =============================================================================

if ( ! function_exists( 'x_get_breadcrumb_home_text' ) ) :
  function x_get_breadcrumb_home_text() {

    return '<span class="home"><i class="x-icon-home" data-x-icon="&#xf015;"></i></span>';

  }
endif;



// Breadcrumb Current Before
// =============================================================================

if ( ! function_exists( 'x_get_breadcrumb_current_before' ) ) :
  function x_get_breadcrumb_current_before() {

    return '<span class="current">';

  }
endif;



// Breadcrumb Current After
// =============================================================================

if ( ! function_exists( 'x_get_breadcrumb_current_after' ) ) :
  function x_get_breadcrumb_current_after() {

    return '</span>';

  }
endif;



// Breadcrumbs
// =============================================================================

if ( ! function_exists( 'x_breadcrumbs' ) ) :
  function x_breadcrumbs() {

    if ( x_get_option( 'x_breadcrumb_display' ) ) {

      GLOBAL $post;

      $is_ltr         = ! is_rtl();
      $stack          = x_get_stack();
      $delimiter      = x_get_breadcrumb_delimiter();
      $home_text      = x_get_breadcrumb_home_text();
      $home_link      = home_url();
      $current_before = x_get_breadcrumb_current_before();
      $current_after  = x_get_breadcrumb_current_after();
      $page_title     = get_the_title();
      $blog_title     = get_the_title( get_option( 'page_for_posts', true ) );

      if ( ! is_404() ) {
        $post_parent = $post->post_parent;
      } else {
        $post_parent = '';
      }

      if ( X_WOOCOMMERCE_IS_ACTIVE ) {
        $shop_url   = x_get_shop_link();
        $shop_title = x_get_option( 'x_' . $stack . '_shop_title' );
        $shop_link  = '<a href="'. $shop_url .'">' . $shop_title . '</a>';
      }

      echo '<div class="x-breadcrumbs"><a href="' . $home_link . '">' . $home_text . '</a>' . $delimiter;

        if ( is_home() ) {

          echo $current_before . $blog_title . $current_after;

        } elseif ( is_category() ) {

          $the_cat = get_category( get_query_var( 'cat' ), false );
          if ( $the_cat->parent != 0 ) echo get_category_parents( $the_cat->parent, TRUE, $delimiter );
          echo $current_before . single_cat_title( '', false ) . $current_after;

        } elseif ( x_is_product_category() ) {

          if ( $is_ltr ) {
            echo $shop_link . $delimiter . $current_before . single_cat_title( '', false ) . $current_after;
          } else {
            echo $current_before . single_cat_title( '', false ) . $current_after . $delimiter . $shop_link;
          }

        } elseif ( x_is_product_tag() ) {

          if ( $is_ltr ) {
            echo $shop_link . $delimiter . $current_before . single_tag_title( '', false ) . $current_after;
          } else {
            echo $current_before . single_tag_title( '', false ) . $current_after . $delimiter . $shop_link;
          }

        } elseif ( is_search() ) {

          echo $current_before . __( 'Search Results for ', '__x__' ) . '&#8220;' . get_search_query() . '&#8221;' . $current_after;

        } elseif ( is_singular( 'post' ) ) {

          if ( get_option( 'page_for_posts' ) == is_front_page() ) {
            echo $current_before . $page_title . $current_after;
          } else {
            if ( $is_ltr ) {
              echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . $blog_title . '</a>' . $delimiter . $current_before . $page_title . $current_after;
            } else {
              echo $current_before . $page_title . $current_after . $delimiter . '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . $blog_title . '</a>';
            }
          }

        } elseif ( x_is_portfolio() ) {

          echo $current_before . get_the_title() . $current_after;

        } elseif ( x_is_portfolio_item() ) {

          $link  = x_get_parent_portfolio_link();
          $title = x_get_parent_portfolio_title();

          if ( $is_ltr ) {
            echo '<a href="' . $link . '">' . $title . '</a>' . $delimiter . $current_before . $page_title . $current_after;
          } else {
            echo $current_before . $page_title . $current_after . $delimiter . '<a href="' . $link . '">' . $title . '</a>';
          }

        } elseif ( x_is_product() ) {

          if ( $is_ltr ) {
            echo $shop_link . $delimiter . $current_before . $page_title . $current_after;
          } else {
            echo $current_before . $page_title . $current_after . $delimiter . $shop_link;
          }

        } elseif ( x_is_buddypress() ) {

          if ( bp_is_group() ) {
            echo '<a href="' . bp_get_groups_directory_permalink() . '">' . x_get_option( 'x_buddypress_groups_title' ) . '</a>' . $delimiter . $current_before . x_buddypress_get_the_title() . $current_after;
          } elseif ( bp_is_user() ) {
            echo '<a href="' . bp_get_members_directory_permalink() . '">' . x_get_option( 'x_buddypress_members_title' ) . '</a>' . $delimiter . $current_before . x_buddypress_get_the_title() . $current_after;
          } else {
            echo $current_before . x_buddypress_get_the_title() . $current_after;
          }

        } elseif ( x_is_bbpress() ) {

          remove_filter( 'bbp_no_breadcrumb', '__return_true' );

          if ( bbp_is_forum_archive() ) {
            echo $current_before . bbp_get_forum_archive_title() . $current_after;
          } else {
            echo bbp_get_breadcrumb();
          }

          add_filter( 'bbp_no_breadcrumb', '__return_true' );

        } elseif ( is_page() && ! $post_parent ) {

          echo $current_before . $page_title . $current_after;

        } elseif ( is_page() && $post_parent ) {

          $parent_id   = $post_parent;
          $breadcrumbs = array();

          if ( is_rtl() ) {
            echo $current_before . $page_title . $current_after . $delimiter;
          }

          while ( $parent_id ) {
            $page          = get_page( $parent_id );
            $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
            $parent_id     = $page->post_parent;
          }

          if ( $is_ltr ) {
            $breadcrumbs = array_reverse( $breadcrumbs );
          }

          for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
            echo $breadcrumbs[$i];
            if ( $i != count( $breadcrumbs ) -1 ) echo $delimiter;
          }

          if ( $is_ltr ) {
            echo $delimiter . $current_before . $page_title . $current_after;
          }

        } elseif ( is_tag() ) {

          echo $current_before . single_tag_title( '', false ) . $current_after;

        } elseif ( is_author() ) {

          GLOBAL $author;
          $userdata = get_userdata( $author );
          echo $current_before . __( 'Posts by ', '__x__' ) . '&#8220;' . $userdata->display_name . $current_after . '&#8221;';

        } elseif ( is_404() ) {

          echo $current_before . __( '404 (Page Not Found)', '__x__' ) . $current_after;

        } elseif ( is_archive() ) {

          if ( x_is_shop() ) {
            echo $current_before . $shop_title . $current_after;
          } else {
            echo $current_before . __( 'Archives ', '__x__' ) . $current_after;
          }

        }

      echo '</div>';

    }

  }
endif;