<?php

// =============================================================================
// VIEWS/ICON/TEMPLATE-FULL-WIDTH.PHP
// -----------------------------------------------------------------------------
// Fullwidth page output for Icon.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main full x-container" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( 'icon', 'content', 'page' ); ?>
      <?php x_get_view( 'global', '_comments-template' ); ?>
    <?php endwhile; ?>

  </div>

<?php get_footer(); ?>