<?php

// =============================================================================
// VIEWS/GLOBAL/_COMMENTS-TEMPLATE.PHP
// -----------------------------------------------------------------------------
// Comments output for pages, posts, and portfolio items.
// =============================================================================

$stack           = x_get_stack();
$container_begin = ( $stack == 'icon' ) ? '<div class="x-container max width">' : '';
$container_end   = ( $stack == 'icon' ) ? '</div>' : '';

?>

<?php if ( comments_open() ) : ?>
  <?php echo $container_begin; ?>
    <?php comments_template( '', true ); ?>
  <?php echo $container_end; ?>
<?php endif; ?>