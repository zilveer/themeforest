<?php

// =============================================================================
// VIEWS/ETHOS/WP-SINGLE.PHP
// -----------------------------------------------------------------------------
// Single post output for Ethos.
// =============================================================================

$fullwidth = get_post_meta( get_the_ID(), '_x_post_layout', true );

?>

<?php get_header(); ?>
  
  <div class="x-container max width main">
    <div class="offset cf">
      <div class="<?php x_main_content_class(); ?>" role="main">

        <?php while ( have_posts() ) : the_post(); ?>
          <?php x_get_view( 'ethos', 'content', get_post_format() ); ?>
          <?php x_get_view( 'global', '_comments-template' ); ?>
        <?php endwhile; ?>

      </div>

      <?php if ( $fullwidth != 'on' ) : ?>
        <?php get_sidebar(); ?>
      <?php endif; ?>

    </div>
  </div>

<?php get_footer(); ?>