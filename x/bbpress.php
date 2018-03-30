<?php

// =============================================================================
// BBPRESS.PHP
// -----------------------------------------------------------------------------
// Handles output of bbPress pages.
//
// Content is output based on which Stack has been selected in the Customizer.
// To view and/or edit the markup of your Stack's pages, first go to "views"
// inside the "framework" subdirectory. Once inside, find your Stack's folder
// and look for a file called "wp-bbpress.php," where you'll be able to find
// the appropriate output.
// =============================================================================

?>

<?php x_get_view( x_get_stack(), 'wp', 'bbpress' ); ?>