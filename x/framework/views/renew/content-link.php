<?php

// =============================================================================
// VIEWS/RENEW/CONTENT-LINK.PHP
// -----------------------------------------------------------------------------
// Link post output for Renew.
// =============================================================================

$link = get_post_meta( get_the_ID(), '_x_link_url',  true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <header class="entry-header">
      <?php if ( is_single() ) : ?>
      <div class="x-hgroup">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <span class="entry-title-sub"><a href="<?php echo $link; ?>" title="<?php echo esc_attr( sprintf( __( 'Shared link from post: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>" target="_blank"><?php echo $link; ?></a></span>
      </div>
      <?php else : ?>
      <div class="x-hgroup">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php x_the_alternate_title(); ?></a></h2>
        <span class="entry-title-sub"><a href="<?php echo $link; ?>" title="<?php echo esc_attr( sprintf( __( 'Shared link from post: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>" target="_blank"><?php echo $link; ?></a></span>
      </div>
      <?php endif; ?>
      <?php x_renew_entry_meta(); ?>
    </header>
    <?php if ( is_single() ) : ?>
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-featured">
          <?php x_featured_image(); ?>
        </div>
      <?php endif; ?>
      <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      <?php x_get_view( 'renew', '_content', 'post-footer' ); ?>
    <?php endif; ?>
  </div>
</article>