<?php

// =============================================================================
// VIEWS/ICON/WP-SINGLE.PHP
// -----------------------------------------------------------------------------
// Single post output for Icon.
// =============================================================================

$fullwidth = get_post_meta( get_the_ID(), '_x_post_layout', true );

?>

<?php get_header(); ?>
  
  <div class="x-main full" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( 'icon', 'content', get_post_format() ); ?>
      <?php x_get_view( 'global', '_comments-template' ); ?>
    <?php endwhile; ?>

  </div>

  <?php if ( $fullwidth != 'on' ) : ?>
    <?php get_sidebar(); ?>
  <?php endif; ?>
<?php get_footer(); ?>