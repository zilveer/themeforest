<?php

// =============================================================================
// VIEWS/ETHOS/CONTENT-PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Portfolio post output for Ethos.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php x_ethos_entry_top_navigation(); ?>
  <div class="entry-featured">
    <?php x_portfolio_item_featured_content(); ?>
  </div>
  <div class="entry-wrap cf">
    <?php x_get_view( 'global', '_content', 'the-content' ); ?>
    <div class="entry-extra">
      <?php x_portfolio_item_project_link(); ?>
      <?php x_portfolio_item_tags(); ?>
      <?php x_portfolio_item_social(); ?>
    </div>
  </div>
</article>