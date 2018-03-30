<?php

// =============================================================================
// VIEWS/ICON/TEMPLATE-LAYOUT-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Portfolio page output for Icon.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main full" role="main">
    <div class="x-container offset-bottom">
      
      <?php x_portfolio_filters(); ?>
      <?php x_get_view( 'global', '_portfolio' ); ?>

    </div>
  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>