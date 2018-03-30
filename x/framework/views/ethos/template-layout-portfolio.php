<?php

// =============================================================================
// VIEWS/ETHOS/TEMPLATE-LAYOUT-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Portfolio page output for Ethos.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width main">
    <div class="offset cf">
      <div class="<?php x_main_content_class(); ?>" role="main">

        <?php x_portfolio_filters(); ?>
        <?php x_get_view( 'global', '_portfolio' ); ?>

      </div>

      <?php get_sidebar(); ?>

    </div>
  </div>

<?php get_footer(); ?>