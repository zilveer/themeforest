<?php

// =============================================================================
// VIEWS/ETHOS/WP-404.PHP
// -----------------------------------------------------------------------------
// Handles output for when a page does not exist.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width main">
    <div class="offset cf">
      <div class="x-main full" role="main">
        <div class="entry-404">

          <?php x_get_view( 'global', '_content-404' ); ?>

        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>