<?php

// =============================================================================
// VIEWS/ICON/WP-SINGLE-X-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Single portfolio post output for Icon.
// =============================================================================

?>

<?php get_header(); ?>
  
  <div class="x-main full" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( 'icon', 'content', 'portfolio' ); ?>
      <?php x_get_view( 'global', '_comments-template' ); ?>
    <?php endwhile; ?>

  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>