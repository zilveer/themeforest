<?php

// =============================================================================
// HEADER.PHP
// -----------------------------------------------------------------------------
// The site header. Variable output across different stacks.
//
// Content is output based on which Stack has been selected in the Customizer.
// To view and/or edit the markup of your Stack's index, first go to "views"
// inside the "framework" subdirectory. Once inside, find your Stack's folder
// and look for a file called "wp-header.php," where you'll be able to find the
// appropriate output.
// =============================================================================

?>

<?php x_get_view( x_get_stack(), 'wp', 'header' ); ?>