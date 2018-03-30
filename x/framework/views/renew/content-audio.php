<?php

// =============================================================================
// VIEWS/RENEW/CONTENT-AUDIO.PHP
// -----------------------------------------------------------------------------
// Audio post output for Renew.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php x_get_view( 'renew', '_content', 'post-header' ); ?>
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-featured">
      <div class="entry-thumb">
        <?php echo get_the_post_thumbnail( get_the_ID(), 'entry', NULL ); ?>
      </div>
      <?php x_featured_audio(); ?>
    </div>
    <?php else : ?>
    <div class="entry-featured">
      <?php x_featured_audio(); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_single() ) : ?>
      <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      <?php x_get_view( 'renew', '_content', 'post-footer' ); ?>
    <?php endif; ?>
  </div>
</article>