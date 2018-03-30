<?php

// =============================================================================
// VIEWS/ETHOS/CONTENT-PAGE.PHP
// -----------------------------------------------------------------------------
// Standard page output for Ethos.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-featured">
      <?php if ( ! is_page() ) : ?>
        <?php x_ethos_featured_index(); ?>
      <?php else : ?>
        <?php x_featured_image(); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <div class="entry-wrap">
    <?php x_get_view( 'global', '_content' ); ?>
  </div>
</article>