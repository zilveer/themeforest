<?php

// =============================================================================
// VIEWS/RENEW/WOOCOMMERCE.PHP
// -----------------------------------------------------------------------------
// WooCommerce page output for Renew.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width offset">
    <div class="<?php x_main_content_class(); ?>" role="main">

      <?php woocommerce_content(); ?>

    </div>

    <?php get_sidebar(); ?>

  </div>

<?php get_footer(); ?>