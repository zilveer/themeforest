<?php

// =============================================================================
// VIEWS/RENEW/CONTENT.PHP
// -----------------------------------------------------------------------------
// Standard post output for Renew.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php x_get_view( 'renew', '_content', 'post-header' ); ?>
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="entry-featured">
        <?php x_featured_image(); ?>
      </div>
    <?php endif; ?>
    <?php x_get_view( 'global', '_content' ); ?>
  </div>
</article>