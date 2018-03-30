<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/FONTS.PHP
// -----------------------------------------------------------------------------
// Fonts data, handling, and Customizer helpers.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Path
//   02. Require Files
// =============================================================================

// Set Path
// =============================================================================

$font_path = X_TEMPLATE_PATH . '/framework/functions/global/admin/customizer/fonts';



// Require Files
// =============================================================================

require_once( $font_path . '/data.php' );
require_once( $font_path . '/handling.php' );
require_once( $font_path . '/google-fonts.php' );
require_once( $font_path . '/control-values.php' );