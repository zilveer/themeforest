<?php

// =============================================================================
// VIEWS/INTEGRITY/CONTENT-QUOTE.PHP
// -----------------------------------------------------------------------------
// Quote post output for Integrity.
// =============================================================================

$quote = get_post_meta( get_the_ID(), '_x_quote_quote', true );
$cite  = get_post_meta( get_the_ID(), '_x_quote_cite',  true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-featured">
    <?php x_featured_image(); ?>
  </div>
  <div class="entry-wrap">
    <header class="entry-header">
      <?php if ( is_single() ) : ?>
      <div class="x-hgroup">
        <h1 class="entry-title"><?php echo $quote; ?></h1>
        <cite class="entry-title-sub"><?php echo $cite; ?></cite>
      </div>
      <?php x_integrity_entry_meta(); ?>
      <?php else : ?>
      <div class="x-hgroup">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php echo $quote; ?></a></h2>
        <cite class="entry-title-sub"><?php echo $cite; ?></cite>
      </div>
      <?php x_integrity_entry_meta(); ?>
      <?php endif; ?>
    </header>
    <?php if ( is_single() ) : ?>
    <?php x_get_view( 'global', '_content', 'the-content' ); ?>
    <?php endif; ?>
  </div>
  <?php x_get_view( 'integrity', '_content', 'post-footer' ); ?>
</article>