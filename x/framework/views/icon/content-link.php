<?php

// =============================================================================
// VIEWS/ICON/CONTENT-LINK.PHP
// -----------------------------------------------------------------------------
// Link post output for Icon.
// =============================================================================

$link = get_post_meta( get_the_ID(), '_x_link_url',  true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php x_icon_comment_number(); ?>
    <div class="x-container max width">
      <header class="entry-header">
        <?php if ( is_single() ) : ?>
        <h1 class="entry-title">
          <a href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( sprintf( __( 'Shared link from post: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>" target="_blank" class="entry-external-link"><i class="x-icon-paperclip" data-x-icon="&#xf0c6;"></i></a>
          <?php echo $link; ?>
        </h1>
        <?php else : ?>
        <h2 class="entry-title">
          <a href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( sprintf( __( 'Shared link from post: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>" target="_blank" class="entry-external-link"><i class="x-icon-paperclip" data-x-icon="&#xf0c6;"></i></a>
          <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php echo $link; ?></a>
        </h2>
        <?php endif; ?>
        <?php x_icon_entry_meta(); ?>
      </header>
      <?php if ( is_single() ) : ?>
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-featured">
          <?php x_featured_image(); ?>
        </div>
        <?php endif; ?>
      <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      <?php endif; ?>
    </div>
  </div>
</article>