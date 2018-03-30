<?php

// =============================================================================
// VIEWS/GLOBAL/_INDEX.PHP
// -----------------------------------------------------------------------------
// Includes the index output.
// =============================================================================

$stack = x_get_stack();

if ( is_home() ) :
  $style     = x_get_option( 'x_blog_style' );
  $cols      = x_get_option( 'x_blog_masonry_columns' );
  $condition = is_home() && $style == 'masonry';
elseif ( is_archive() ) :
  $style     = x_get_option( 'x_archive_style' );
  $cols      = x_get_option( 'x_archive_masonry_columns' );
  $condition = is_archive() && $style == 'masonry';
elseif ( is_search() ) :
  $condition = false;
endif;

?>

<?php if ( $condition ) : ?>

  <?php x_get_view( 'global', '_script', 'isotope-index' ); ?>

  <div id="x-iso-container" class="x-iso-container x-iso-container-posts cols-<?php echo $cols; ?>">

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php if ( $stack != 'ethos' ) : ?>
          <?php x_get_view( $stack, 'content', get_post_format() ); ?>
        <?php else : ?>
          <?php x_ethos_entry_cover( 'main-content' ); ?>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php else : ?>
      <?php x_get_view( 'global', '_content-none' ); ?>
    <?php endif; ?>

  </div>

<?php else : ?>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( $stack, 'content', get_post_format() ); ?>
    <?php endwhile; ?>
  <?php else : ?>
    <?php x_get_view( 'global', '_content-none' ); ?>
  <?php endif; ?>

<?php endif; ?>

<?php pagenavi(); ?>