<?php

// =============================================================================
// VIEWS/GLOBAL/_CONTENT-BUDDYPRESS.PHP
// -----------------------------------------------------------------------------
// Output for BuddyPress pages.
// =============================================================================

$stack           = x_get_stack();
$container_begin = ( $stack == 'icon' ) ? '<div class="x-container max width">' : '';
$container_end   = ( $stack == 'icon' ) ? '</div>' : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php echo $container_begin; ?>
      <?php x_get_view( 'global', '_content', 'the-content' ); ?>
    <?php echo $container_end; ?>
  </div>
</article>