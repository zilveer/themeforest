<?php

// =============================================================================
// VIEWS/ICON/CONTENT-VIDEO.PHP
// -----------------------------------------------------------------------------
// Video post output for Icon.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php x_icon_comment_number(); ?>
    <div class="x-container max width">
      <?php x_get_view( 'icon', '_content', 'post-header' ); ?>
      <div class="entry-featured">
        <?php x_featured_video(); ?>
      </div>
      <?php if ( is_single() ) : ?>
        <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      <?php endif; ?>
    </div>
  </div>
</article>