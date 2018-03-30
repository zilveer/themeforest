<?php

// =============================================================================
// VIEWS/ETHOS/_INDEX-FEATURED.PHP
// -----------------------------------------------------------------------------
// Featured content output for the index pages.
// =============================================================================

$index_layout           = get_post_meta( get_the_ID(), '_x_ethos_index_featured_post_layout',  true );
$class                  = ( $index_layout == 'on' ) ? 'featured' : '';
$background_image_style = x_ethos_entry_cover_background_image_style();
$categories             = x_ethos_post_categories();

?>

<a href="<?php the_permalink(); ?>" class="entry-thumb <?php echo $class; ?>" style="<?php echo $background_image_style; ?>">
  <?php if ( $index_layout == 'on' && ! is_single() ) : ?>  
    <span class="featured-meta"><?php echo $categories; ?> / <?php echo get_the_date( 'F j, Y' ); ?></span>
    <h2 class="h-featured"><span><?php the_title(); ?></span></h2>
    <span class="featured-view"><?php _e( 'View Post', '__x__' ); ?></span>
  <?php else : ?>
    <span class="view"><?php _e( 'View Post', '__x__' ); ?></span>
  <?php endif; ?>
</a>