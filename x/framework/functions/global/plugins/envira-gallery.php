<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/ENVIRA-GALLERY.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Remove License Functionality
// =============================================================================

// Remove License Functionality
// =============================================================================

if ( ! function_exists( 'x_envira_gallery_remove_license_functionality' ) ) :

  function x_envira_gallery_remove_license_functionality() {

    if ( is_admin() ) {

      //
      // 1. Remove the settings menu.
      // 2. Remove license notices.
      //

      remove_action( 'admin_menu', array( Envira_Gallery_Settings::get_instance(), 'admin_menu' ) ); // 1
      remove_action( 'admin_notices', array( Envira_Gallery_License::get_instance(), 'notices' ) );  // 2

    }
    
  }

  add_action( 'init', 'x_envira_gallery_remove_license_functionality', 9999 );

endif;