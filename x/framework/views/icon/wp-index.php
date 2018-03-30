<?php

// =============================================================================
// VIEWS/ICON/WP-INDEX.PHP
// -----------------------------------------------------------------------------
// Index page output for Icon.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main full" role="main">
    <div class="x-container offset-bottom">

      <?php x_get_view( 'global', '_index' ); ?>

    </div>
  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>