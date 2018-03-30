<?php

// =============================================================================
// VIEWS/ETHOS/CONTENT-QUOTE.PHP
// -----------------------------------------------------------------------------
// Quote post output for Ethos.
// =============================================================================

$is_index_featured_layout = get_post_meta( get_the_ID(), '_x_ethos_index_featured_post_layout', true ) == 'on' && ! is_single();
$quote                    = get_post_meta( get_the_ID(), '_x_quote_quote', true );
$cite                     = get_post_meta( get_the_ID(), '_x_quote_cite',  true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( $is_index_featured_layout ) : ?>
    <?php x_ethos_featured_index(); ?>
  <?php else : ?>
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="entry-featured">
        <?php if ( ! is_single() ) : ?>
          <?php x_ethos_featured_index(); ?>
        <?php else : ?>
          <?php x_featured_image(); ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <div class="entry-wrap">
      <?php x_get_view( 'ethos', '_content', 'post-header' ); ?>
      <?php if ( is_single() ) : ?>
        <div class="x-hgroup">
          <p class="quote"><?php echo $quote; ?></p>
          <cite class="cite"><?php echo $cite; ?></cite>
        </div>
        <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      <?php else : ?>
        <?php x_get_view( 'global', '_content' ); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</article>