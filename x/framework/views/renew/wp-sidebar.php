<?php

// =============================================================================
// VIEWS/RENEW/WP-SIDEBAR.PHP
// -----------------------------------------------------------------------------
// Sidebar output for Renew.
// =============================================================================

?>

<?php if ( x_get_content_layout() != 'full-width' ) : ?>

  <aside class="<?php x_sidebar_class(); ?>" role="complementary">
    <?php if ( get_option( 'ups_sidebars' ) != array() ) : ?>
      <?php dynamic_sidebar( apply_filters( 'ups_sidebar', 'sidebar-main' ) ); ?>
    <?php else : ?>
      <?php dynamic_sidebar( 'sidebar-main' ); ?>
    <?php endif; ?>
  </aside>

<?php endif; ?>