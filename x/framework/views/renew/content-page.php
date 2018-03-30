<?php

// =============================================================================
// VIEWS/RENEW/CONTENT-PAGE.PHP
// -----------------------------------------------------------------------------
// Standard page output for Renew.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="entry-featured mtn">
        <?php x_featured_image(); ?>
      </div>
    <?php endif; ?>
    <?php if ( ! is_singular() ) : ?>
    <header class="entry-header">
      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php x_the_alternate_title(); ?></a>
      </h2>
    </header>
    <?php endif; ?>
    <?php x_get_view( 'global', '_content' ); ?>
  </div>
</article>