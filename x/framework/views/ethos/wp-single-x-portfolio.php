<?php

// =============================================================================
// VIEWS/ETHOS/WP-SINGLE-X-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Single portfolio post output for Ethos.
// =============================================================================

?>

<?php get_header(); ?>
  
  <div class="x-container max width main">
    <div class="offset cf">
      <div class="x-main full" role="main">

        <?php while ( have_posts() ) : the_post(); ?>
          <?php x_get_view( 'ethos', 'content', 'portfolio' ); ?>
          <?php x_get_view( 'global', '_comments-template' ); ?>
        <?php endwhile; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>