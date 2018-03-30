<?php

// =============================================================================
// VIEWS/INTEGRITY/CONTENT-IMAGE.PHP
// -----------------------------------------------------------------------------
// Image post output for Integrity.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-featured">
    <?php x_featured_image(); ?>
  </div>
  <div class="entry-wrap">
    <?php if ( is_single() ) : ?>
    <header class="entry-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php x_integrity_entry_meta(); ?>
    </header>
    <?php x_get_view( 'global', '_content', 'the-content' ); ?>
    <?php else : ?>
    <header class="entry-header center-text">
      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php x_the_alternate_title(); ?></a>
      </h2>
      <?php x_integrity_entry_meta(); ?>
    </header>
    <?php endif; ?>
  </div>
  <?php x_get_view( 'integrity', '_content', 'post-footer' ); ?>
</article>