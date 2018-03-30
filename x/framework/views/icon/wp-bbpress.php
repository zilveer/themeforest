<?php

// =============================================================================
// VIEWS/ICON/WP-BBPRESS.PHP
// -----------------------------------------------------------------------------
// bbPress output for Icon.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main full" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( 'global', '_content', 'bbpress' ); ?>
    <?php endwhile; ?>

  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>