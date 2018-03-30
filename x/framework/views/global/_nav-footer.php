<?php

// =============================================================================
// VIEWS/GLOBAL/_NAV-FOOTER.PHP
// -----------------------------------------------------------------------------
// Outputs the footer nav.
// =============================================================================

?>

<?php

if ( has_nav_menu( 'footer' ) ) :
  wp_nav_menu( array(
    'theme_location' => 'footer',
    'container'      => false,
    'menu_class'     => 'x-nav',
    'depth'          => 1
  ) );
else :
  echo '<ul class="x-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';
endif;

?>