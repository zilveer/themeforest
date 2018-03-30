<?php

// =============================================================================
// VIEWS/INTEGRITY/CONTENT-AUDIO.PHP
// -----------------------------------------------------------------------------
// Audio post output for Integrity.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( has_post_thumbnail() ) : ?>
  <div class="entry-featured">
    <div class="entry-thumb">
      <?php echo get_the_post_thumbnail( get_the_ID(), 'entry', NULL ); ?>
    </div>
    <?php x_featured_audio(); ?>
  </div>
  <?php endif; ?>
  <div class="entry-wrap">
    <?php if ( ! has_post_thumbnail() ) : ?>
    <div class="entry-featured">
      <?php x_featured_audio(); ?>
    </div>
    <?php endif; ?>
    <?php x_get_view( 'integrity', '_content', 'post-header' ); ?>
    <?php x_get_view( 'global', '_content' ); ?>
  </div>
  <?php x_get_view( 'integrity', '_content', 'post-footer' ); ?>
</article>