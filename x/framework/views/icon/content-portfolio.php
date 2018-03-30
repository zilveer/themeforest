<?php

// =============================================================================
// VIEWS/ICON/CONTENT-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Portfolio post output for Icon.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <div class="x-container max width">

      <?php if ( x_is_portfolio_item() ) : ?>

        <header class="entry-header">
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <?php x_icon_entry_meta(); ?>
        </header>

      <?php endif; ?>

      <div class="entry-featured">
        <?php x_portfolio_item_featured_content(); ?>
      </div>

      <?php if ( is_singular() ) : ?>

        <?php x_get_view( 'global', '_content', 'the-content' ); ?>
        <div class="entry-extra">
          <?php x_portfolio_item_tags(); ?>
          <?php x_portfolio_item_project_link(); ?>
          <?php x_portfolio_item_social(); ?>
        </div>

      <?php endif; ?>

    </div>
  </div>
</article>