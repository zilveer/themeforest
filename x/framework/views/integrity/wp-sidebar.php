<?php

// =============================================================================
// VIEWS/INTEGRITY/WP-SIDEBAR.PHP
// -----------------------------------------------------------------------------
// Sidebar output for Integrity.
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