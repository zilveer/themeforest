<?php

// =============================================================================
// VIEWS/ICON/_BREADCRUMBS.PHP
// -----------------------------------------------------------------------------
// Breadcrumb output for Icon.
// =============================================================================

?>

<?php if ( ! is_front_page() ) : ?>
  <?php if ( x_get_option( 'x_breadcrumb_display' ) == '1' ) : ?>

    <div class="x-breadcrumb-wrap">
      <div class="x-container max width">

        <?php x_breadcrumbs(); ?>

        <?php if ( is_single() || x_is_portfolio_item() ) : ?>
          <?php x_entry_navigation(); ?>
        <?php endif; ?>

      </div>
    </div>

  <?php endif; ?>
<?php endif; ?>