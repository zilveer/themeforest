<?php

// =============================================================================
// VIEWS/RENEW/CONTENT-VIDEO.PHP
// -----------------------------------------------------------------------------
// Video post output for Renew.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php x_get_view( 'renew', '_content', 'post-header' ); ?>
    <div class="entry-featured">
      <?php x_featured_video(); ?>
    </div>
    <?php if ( is_single() ) : ?>
      <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      <?php x_get_view( 'renew', '_content', 'post-footer' ); ?>
    <?php endif; ?>
  </div>
</article>