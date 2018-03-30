<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/ESSENTIAL-GRID.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Theme Setup
// =============================================================================

// Theme Setup
// =============================================================================

if ( ! function_exists( 'x_essential_grid_theme_setup' ) ) :

  function x_essential_grid_theme_setup() {

    GLOBAL $EssentialAsTheme;

    $EssentialAsTheme = true;
    
  }

  add_action( 'admin_init', 'x_essential_grid_theme_setup' );

endif;