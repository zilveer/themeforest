<?php

// =============================================================================
// VIEWS/ETHOS/_BREADCRUMBS.PHP
// -----------------------------------------------------------------------------
// Breadcrumb output for Ethos.
// =============================================================================

?>

<?php if ( ! is_front_page() ) : ?>
  <?php if ( x_get_option( 'x_breadcrumb_display' ) == '1' ) : ?>

    <div class="x-breadcrumb-wrap">
      <div class="x-container max width">
        <?php x_breadcrumbs(); ?>
      </div>
    </div>

  <?php endif; ?>
<?php endif; ?>