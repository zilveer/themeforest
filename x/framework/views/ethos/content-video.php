<?php

// =============================================================================
// VIEWS/ETHOS/CONTENT-VIDEO.PHP
// -----------------------------------------------------------------------------
// Video post output for Ethos.
// =============================================================================

$is_index_featured_layout = get_post_meta( get_the_ID(), '_x_ethos_index_featured_post_layout', true ) == 'on' && ! is_single();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( $is_index_featured_layout ) : ?>
    <?php x_ethos_featured_index(); ?>
  <?php else : ?>
    <?php if ( has_post_thumbnail() && ! is_single() ) : ?>
      <div class="entry-featured">
        <?php x_ethos_featured_index(); ?>
      </div>
    <?php elseif ( is_single() ) : ?>
      <div class="entry-featured">
        <?php x_featured_video(); ?>
      </div>
    <?php endif; ?>
    <div class="entry-wrap">
      <?php x_get_view( 'ethos', '_content', 'post-header' ); ?>
      <?php x_get_view( 'global', '_content' ); ?>
    </div>
  <?php endif; ?>
</article>