<?php

// =============================================================================
// VIEWS/RENEW/WP-404.PHP
// -----------------------------------------------------------------------------
// Handles output for when a page does not exist.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width offset">
    <div class="x-main full" role="main">
      <div class="entry-404">

        <?php x_get_view( 'global', '_content-404' ); ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>