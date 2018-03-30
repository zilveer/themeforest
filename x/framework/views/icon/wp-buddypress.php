<?php

// =============================================================================
// VIEWS/ICON/WP-BUDDYPRESS.PHP
// -----------------------------------------------------------------------------
// BuddyPress output for Icon.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main full" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( 'global', '_content', 'buddypress' ); ?>
    <?php endwhile; ?>

  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>