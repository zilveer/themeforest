<?php

// =============================================================================
// VIEWS/ICON/_TEMPLATE-BLANK-SIDEBAR.PHP
// -----------------------------------------------------------------------------
// Display of the sidebar for blank templates.
// =============================================================================

$sidebar = get_post_meta( get_the_ID(), '_x_icon_blank_template_sidebar', true );

?>

<?php

if ( $sidebar == 'Yes' ) :

  get_sidebar();

endif;

?>