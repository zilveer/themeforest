<?php

// =============================================================================
// VIEWS/ICON/WOOCOMMERCE.PHP
// -----------------------------------------------------------------------------
// WooCommerce page output for Icon.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main full" role="main">
    <div class="x-container max width offset-top offset-bottom">

      <?php if ( x_is_shop() ) : ?>
        <header class="entry-header shop">
          <h1 class="entry-title"><?php echo x_get_option( 'x_icon_shop_title' ); ?></h1>
        </header>
      <?php endif; ?>

      <?php woocommerce_content(); ?>

    </div>
  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>