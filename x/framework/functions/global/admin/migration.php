<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/MIGRATION.PHP
// -----------------------------------------------------------------------------
// Handles theme migration.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Version Migration
//   02. Version Migration Notice
//   03. Theme Migration
//   04. Term Splitting Migration (WordPress 4.2 Breaking Change)
// =============================================================================

// Version Migration
// =============================================================================

function x_version_migration() {

  $prior = get_option( 'x_version', false );

  //
  // Store the version on first install
  //

  if ( false === $prior ) {
    update_option( 'x_version', X_VERSION );
    update_option( 'x_dismiss_update_notice', true );
    return;
  }

  if ( version_compare( $prior, X_VERSION, '<' ) ) {

    //
    // If $prior is less than 2.2.0.
    //

    if ( version_compare( $prior, '2.2.0', '<' ) ) {

      $mods = get_theme_mods();

      foreach( $mods as $key => $value ) {
        update_option( $key, $value );
      }

    }


    //
    // If $prior is less than 3.1.0.
    //

    if ( version_compare( $prior, '3.1.0', '<' ) ) {

      $stack      = get_option( 'x_stack' );
      $design     = ( $stack == 'integrity' ) ? '_' . get_option( 'x_integrity_design' ) : '';
      $stack_safe = ( $stack == 'icon' ) ? 'integrity' : $stack;

      $updated = array(
        'x_layout_site'               => get_option( 'x_' . $stack . '_layout_site' ),
        'x_layout_site_max_width'     => get_option( 'x_' . $stack . '_sizing_site_max_width' ),
        'x_layout_site_width'         => get_option( 'x_' . $stack . '_sizing_site_width' ),
        'x_layout_content'            => get_option( 'x_' . $stack . '_layout_content' ),
        'x_layout_content_width'      => get_option( 'x_' . $stack_safe . '_sizing_content_width' ),
        'x_layout_sidebar_width'      => get_option( 'x_icon_sidebar_width' ),
        'x_design_bg_color'           => get_option( 'x_' . $stack . $design . '_bg_color' ),
        'x_design_bg_image_pattern'   => get_option( 'x_' . $stack . $design . '_bg_image_pattern' ),
        'x_design_bg_image_full'      => get_option( 'x_' . $stack . $design . '_bg_image_full' ),
        'x_design_bg_image_full_fade' => get_option( 'x_' . $stack . $design . '_bg_image_full_fade' )
      );

      foreach ( $updated as $key => $value ) {
        update_option( $key, $value );
      }

    }


    //
    // If $prior is less than 4.0.0.
    //

    if ( version_compare( $prior, '4.0.0', '<' ) ) {

      $updated = array(
        'x_pre_v4' => true
      );

      foreach ( $updated as $key => $value ) {
        update_option( $key, $value );
      }

    }


    //
    // If $prior is less than 4.0.4.
    //

    if ( version_compare( $prior, '4.0.4', '<' ) ) {

      $stack            = get_option( 'x_stack' );
      $navbar_font_size = get_option( 'x_navbar_font_size', 12 );

      if ( $stack == 'integrity' ) {
        $link_spacing        = round( intval( $navbar_font_size ) * 1.429 );
        $link_letter_spacing = 2;
      } else if ( $stack == 'renew' ) {
        $link_spacing        = intval( $navbar_font_size );
        $link_letter_spacing = 1;
      } else if ( $stack == 'icon' ) {
        $link_spacing        = 5;
        $link_letter_spacing = 1;
      } else if ( $stack == 'ethos' ) {
        $link_spacing        = get_option( 'x_ethos_navbar_desktop_link_side_padding' );
        $link_letter_spacing = 1;
      }

      $updated = array(
        'x_navbar_adjust_links_top_spacing' => $link_spacing,
        'x_navbar_letter_spacing'           => $link_letter_spacing
      );

      foreach ( $updated as $key => $value ) {
        update_option( $key, $value );
      }

    }


    //
    // If $prior is less than 4.2.0.
    //

    if ( version_compare( $prior, '4.2.0', '<' ) ) {

      $stack        = get_option( 'x_stack' );
      $design       = get_option( 'x_integrity_design' );
      $h_base       = ( intval( get_option( 'x_body_font_size', 14 ) ) + intval( get_option( 'x_content_font_size', 14 ) ) ) / 2;
      $h1_font_size = $h_base * 4;
      $h2_font_size = $h_base * 2.857;
      $h3_font_size = $h_base * 2.285;
      $h4_font_size = $h_base * 1.714;
      $h5_font_size = $h_base * 1.5;
      $h6_font_size = $h_base * 1;

      if ( $stack == 'integrity' && $design == 'dark' ) {
        $logo_font_color     = '#ffffff';
        $headings_font_color = '#ffffff';
        $body_font_color     = '#666666';
      } else if ( $stack == 'renew' ) {
        $logo_font_color     = '#ffffff';
        $headings_font_color = '#2c3e50';
        $body_font_color     = '#28323f';
      } else if ( $stack == 'icon' ) {
        $logo_font_color     = '#566471';
        $headings_font_color = '#566471';
        $body_font_color     = '#566471';
      } else if ( $stack == 'ethos' ) {
        $logo_font_color     = '#ffffff';
        $headings_font_color = '#333333';
        $body_font_color     = '#7a7a7a';
      } else {
        $logo_font_color     = '#272727';
        $headings_font_color = '#272727';
        $body_font_color     = '#7a7a7a';
      }

      $logo_font_color                = ( get_option( 'x_logo_font_color_enable' ) == '1' ) ? get_option( 'x_logo_font_color' ) : $logo_font_color;
      $headings_font_color            = ( get_option( 'x_headings_font_color_enable' ) == '1' ) ? get_option( 'x_headings_font_color' ) : $headings_font_color;
      $body_font_color                = ( get_option( 'x_body_font_color_enable' ) == '1' ) ? get_option( 'x_body_font_color' ) : $body_font_color;
      $px_to_em_letter_spacing_logo   = round( intval( get_option( 'x_logo_letter_spacing', 1 ) ) / intval( get_option( 'x_logo_font_size', 54 ) ), 3 );
      $px_to_em_letter_spacing_navbar = round( intval( get_option( 'x_navbar_letter_spacing', 1 ) ) / intval( get_option( 'x_navbar_font_size', 12 ) ), 3 );
      $px_to_em_letter_spacing_h1     = round( intval( get_option( 'x_headings_letter_spacing', 1 ) ) / $h1_font_size, 3 );
      $px_to_em_letter_spacing_h2     = round( intval( get_option( 'x_headings_letter_spacing', 1 ) ) / $h2_font_size, 3 );
      $px_to_em_letter_spacing_h3     = round( intval( get_option( 'x_headings_letter_spacing', 1 ) ) / $h3_font_size, 3 );
      $px_to_em_letter_spacing_h4     = round( intval( get_option( 'x_headings_letter_spacing', 1 ) ) / $h4_font_size, 3 );
      $px_to_em_letter_spacing_h5     = round( intval( get_option( 'x_headings_letter_spacing', 1 ) ) / $h5_font_size, 3 );
      $px_to_em_letter_spacing_h6     = round( intval( get_option( 'x_headings_letter_spacing', 1 ) ) / $h6_font_size, 3 );

      $updated = array(
        'x_google_fonts_subsets'           => get_option( 'x_custom_font_subsets' ),
        'x_google_fonts_subset_cyrillic'   => get_option( 'x_custom_font_subset_cyrillic' ),
        'x_google_fonts_subset_greek'      => get_option( 'x_custom_font_subset_greek' ),
        'x_google_fonts_subset_vietnamese' => get_option( 'x_custom_font_subset_vietnamese' ),
        'x_logo_font_color'                => $logo_font_color,
        'x_logo_letter_spacing'            => $px_to_em_letter_spacing_logo,
        'x_navbar_letter_spacing'          => $px_to_em_letter_spacing_navbar,
        'x_headings_font_color'            => $headings_font_color,
        'x_h1_letter_spacing'              => $px_to_em_letter_spacing_h1,
        'x_h2_letter_spacing'              => $px_to_em_letter_spacing_h2,
        'x_h3_letter_spacing'              => $px_to_em_letter_spacing_h3,
        'x_h4_letter_spacing'              => $px_to_em_letter_spacing_h4,
        'x_h5_letter_spacing'              => $px_to_em_letter_spacing_h5,
        'x_h6_letter_spacing'              => $px_to_em_letter_spacing_h6,
        'x_body_font_color'                => $body_font_color
      );

      foreach ( $updated as $key => $value ) {
        update_option( $key, $value );
      }

    }


    //
    // Update stored version number.
    //

    update_option( 'x_version', X_VERSION );


    //
    // Turn on the version migration notice.
    //

    delete_option( 'x_dismiss_update_notice' );


    //
    // Enable validation reminder
    //

    delete_option( 'x_dismiss_validation_notice' );

    //
    // Bust caches.
    //

    x_bust_google_fonts_cache();

  }

}

add_action( 'admin_init', 'x_version_migration' );



// Version Migration Notice
// =============================================================================

//
// 1. Output notice.
// 2. Dismiss notice.
//

function x_version_migration_notice() { // 1

  if ( false === get_option( 'x_dismiss_update_notice', false ) ) {

    x_tco()->admin_notice( array(
      'message' => __( 'Congratulations, you&apos;ve successfully updated X! Be sure to <a href="//theme.co/changelog/" target="_blank">check out the release notes and changelog</a> to see all that has changed, especially if you&apos;re utilizing any additional plugins or have made modifications to your website via a child theme.', '__x__' ),
      'dismissible' => true,
      'ajax_dismiss' => 'x_dismiss_update_notice'
    ) );

  }

}

add_action( 'admin_notices', 'x_version_migration_notice' );


function x_version_migration_notice_dismiss() { // 2

  update_option( 'x_dismiss_update_notice', true );
  wp_send_json_success();

}

add_action( 'wp_ajax_x_dismiss_update_notice', 'x_version_migration_notice_dismiss' );




// Theme Migration
// =============================================================================

function x_theme_migration( $new_name, $new_theme ) {

  if ( $new_theme == 'X' || $new_theme->get( 'Template' ) == 'x' ) {
    return false;
  }

  include_once( ABSPATH . '/wp-admin/includes/plugin.php' );

  $plugins   = get_plugins();
  $x_plugins = array();

  foreach ( (array) $plugins as $plugin => $headers ) {
    if ( ! empty( $headers['X Plugin'] ) ) {
      $x_plugins[] = $plugin;
    }
  }

  deactivate_plugins( $x_plugins );

}

add_action( 'switch_theme', 'x_theme_migration', 10, 2 );



// Term Splitting Migration (WordPress 4.2 Breaking Change)
// =============================================================================

function x_split_shared_term_migration( $term_id, $new_term_id, $term_taxonomy_id, $taxonomy ) {

  //
  // Ethos filterable index categories.
  //

  if ( $taxonomy == 'category' ) {

    $setting = array_map( 'trim', explode( ',', get_option( 'x_ethos_filterable_index_categories' ) ) );

    foreach ( $setting as $index => $old_term ) {
      if ( $old_term == (string) $term_id ) {
        $setting[$index] = (string) $new_term_id;
      }
    }

    update_option( 'x_ethos_filterable_index_categories', implode( ', ', $setting ) );

  }


  //
  // Portfolio categories.
  //

  if ( $taxonomy == 'portfolio-category' ) {

    $post_ids = get_posts( array(
      'fields'       => 'ids',
      'meta_key'     =>  '_x_portfolio_category_filters',
      'meta_value'   => '',
      'meta_compare' => '!='
    ) );

    foreach ( $post_ids as $post_id ) {

      $post_terms = get_post_meta( $post_id, '_x_portfolio_category_filters', true );

      if ( is_array( $post_terms ) ) {
        foreach ( $post_terms as $index => $old_term ) {
          if ( $term_id == $old_term) {
            $post_terms[$index] = $new_term_id;
          }
        }
      }

      update_post_meta( $post_id, '_x_portfolio_category_filters', $post_terms );

    }
  }

}

add_action( 'split_shared_term', 'x_split_shared_term_migration' );