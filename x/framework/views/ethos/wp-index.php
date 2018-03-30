<?php

// =============================================================================
// VIEWS/ETHOS/WP-INDEX.PHP
// -----------------------------------------------------------------------------
// Index page output for Ethos.
// =============================================================================

$is_filterable_index = is_home() && x_get_option( 'x_ethos_filterable_index_enable' ) == '1';

?>

<?php get_header(); ?>

  <div class="x-container max width main">

    <?php x_get_view( 'ethos', '_post', 'slider' ); ?>

    <div class="offset cf">
      <div class="<?php x_main_content_class(); ?>" role="main">

        <?php if ( $is_filterable_index ) : ?>
          <?php x_get_view( 'ethos', '_index' ); ?>
        <?php else : ?>
          <?php x_get_view( 'global', '_index' ); ?>
        <?php endif; ?>

      </div>

      <?php get_sidebar(); ?>

    </div>
  </div>

<?php get_footer(); ?>