<?php

// =============================================================================
// VIEWS/ETHOS/WOOCOMMERCE.PHP
// -----------------------------------------------------------------------------
// WooCommerce page output for Ethos.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width main">
    <div class="offset cf">
      <div class="<?php x_main_content_class(); ?>" role="main">

        <?php if ( x_is_product() ) : ?>
          <?php x_ethos_entry_top_navigation(); ?>
        <?php endif; ?>

        <?php woocommerce_content(); ?>

      </div>

      <?php get_sidebar(); ?>

    </div>
  </div>

<?php get_footer(); ?>