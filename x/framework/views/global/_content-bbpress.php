<?php

// =============================================================================
// VIEWS/GLOBAL/_CONTENT-BBPRESS.PHP
// -----------------------------------------------------------------------------
// Output for bbPress pages.
// =============================================================================

$stack           = x_get_stack();
$container_begin = ( $stack == 'icon' ) ? '<div class="x-container max width">' : '';
$container_end   = ( $stack == 'icon' ) ? '</div>' : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php if ( $stack == 'integrity' || $stack == 'icon' ) : ?>
      <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
    <?php endif; ?>
    <?php echo $container_begin; ?>
      <?php x_get_view( 'global', '_content', 'the-content' ); ?>
    <?php echo $container_end; ?>
  </div>
</article>