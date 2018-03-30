<?php

// =============================================================================
// VIEWS/INTEGRITY/CONTENT-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Portfolio post output for Integrity.
// =============================================================================

$archive_share = x_get_option( 'x_integrity_portfolio_archive_post_sharing_enable' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-featured">
    <?php x_portfolio_item_featured_content(); ?>
  </div>
  <div class="entry-wrap cf">

    <?php if ( x_is_portfolio_item() ) : ?>

      <div class="entry-info">
        <header class="entry-header">
          <h1 class="entry-title entry-title-portfolio"><?php the_title(); ?></h1>
          <?php x_integrity_entry_meta(); ?>
        </header>
        <?php x_get_view( 'global', '_content', 'the-content' ); ?>
      </div>
      <div class="entry-extra">
        <?php x_portfolio_item_tags(); ?>
        <?php x_portfolio_item_project_link(); ?>
        <?php x_portfolio_item_social(); ?>
      </div>

    <?php else : ?>

      <header class="entry-header">
        <h2 class="entry-title entry-title-portfolio">
          <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php x_the_alternate_title(); ?></a>
        </h2>
        <?php if ( $archive_share == '1' ) : ?>
          <?php x_portfolio_item_social(); ?>
        <?php endif; ?>
      </header>

    <?php endif; ?>

  </div>
</article>