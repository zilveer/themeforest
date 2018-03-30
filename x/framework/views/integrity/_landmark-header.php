<?php

// =============================================================================
// VIEWS/INTEGRITY/_LANDMARK-HEADER.PHP
// -----------------------------------------------------------------------------
// Handles content output of large headers for key pages such as the blog or
// search results.
// =============================================================================

$disable_page_title = get_post_meta( get_the_ID(), '_x_entry_disable_page_title', true );
$disable_filters    = get_post_meta( get_the_ID(), '_x_portfolio_disable_filtering', true );

?>

<?php if ( is_home() && x_get_option( 'x_integrity_blog_header_enable' ) == '1' ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php echo x_get_option( 'x_integrity_blog_title' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php echo x_get_option( 'x_integrity_blog_subtitle' ); ?></span></p>
  </header>

<?php elseif ( is_search() ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php _e( 'Search Results', '__x__' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php _e( "Below you'll see everything we could locate for your search of ", '__x__' ); echo '<strong>&ldquo;'; the_search_query(); echo '&rdquo;</strong>'; ?></span></p>
  </header>

<?php elseif ( is_category() || x_is_portfolio_category() ) : ?>

  <?php

  $meta     = x_get_taxonomy_meta();
  $title    = ( $meta['archive-title']    != '' ) ? $meta['archive-title']    : __( 'Category Archive', '__x__' );
  $subtitle = ( $meta['archive-subtitle'] != '' ) ? $meta['archive-subtitle'] : __( "Below you'll find a list of all posts that have been categorized as ", '__x__' ) . '<strong>&ldquo;' . single_cat_title( '', false ) . '&rdquo;</strong>';

  ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php echo $title ?></span></h1>
    <p class="p-landmark-sub"><span><?php echo $subtitle ?></span></p>
  </header>

<?php elseif ( x_is_product_category() ) : ?>

  <?php

  $meta     = x_get_taxonomy_meta();
  $title    = ( $meta['archive-title']    != '' ) ? $meta['archive-title']    : __( 'Category Archive', '__x__' );
  $subtitle = ( $meta['archive-subtitle'] != '' ) ? $meta['archive-subtitle'] : __( "Below you'll find a list of all items that have been categorized as ", '__x__' ) . '<strong>&ldquo;' . single_cat_title( '', false ) . '&rdquo;</strong>';

  ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php echo $title ?></span></h1>
    <p class="p-landmark-sub"><span><?php echo $subtitle ?></span></p>
  </header>

<?php elseif ( is_tag() || x_is_portfolio_tag() ) : ?>

  <?php

  $meta     = x_get_taxonomy_meta();
  $title    = ( $meta['archive-title']    != '' ) ? $meta['archive-title']    : __( 'Tag Archive', '__x__' );
  $subtitle = ( $meta['archive-subtitle'] != '' ) ? $meta['archive-subtitle'] : __( "Below you'll find a list of all posts that have been tagged as ", '__x__' ) . '<strong>&ldquo;' . single_tag_title( '', false ) . '&rdquo;</strong>';

  ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php echo $title; ?></span></h1>
    <p class="p-landmark-sub"><span><?php echo $subtitle; ?></span></p>
  </header>

<?php elseif ( x_is_product_tag() ) : ?>

  <?php

  $meta     = x_get_taxonomy_meta();
  $title    = ( $meta['archive-title']    != '' ) ? $meta['archive-title']    : __( 'Tag Archive', '__x__' );
  $subtitle = ( $meta['archive-subtitle'] != '' ) ? $meta['archive-subtitle'] : __( "Below you'll find a list of all items that have been tagged as ", '__x__' ) . '<strong>&ldquo;' . single_tag_title( '', false ) . '&rdquo;</strong>';

  ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php echo $title; ?></span></h1>
    <p class="p-landmark-sub"><span><?php echo $subtitle; ?></span></p>
  </header>

<?php elseif ( is_404() ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php _e( 'Oops!', '__x__' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php _e( "You blew up the Internet. ", '__x__' ); ?></span></p>
  </header>

<?php elseif ( is_year() ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php _e( 'Post Archive by Year', '__x__' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php _e( "Below you'll find a list of all posts from ", '__x__' ); echo '<strong>'; echo get_the_date( 'Y' ); echo '</strong>'; ?></span></p>
  </header>

<?php elseif ( is_month() ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php _e( 'Post Archive by Month', '__x__' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php _e( "Below you'll find a list of all posts from ", '__x__' ); echo '<strong>'; echo get_the_date( 'F, Y' ); echo '</strong>'; ?></span></p>
  </header>

<?php elseif ( is_day() ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php _e( 'Post Archive by Day', '__x__' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php _e( "Below you'll find a list of all posts from ", '__x__' ); echo '<strong>'; echo get_the_date( 'F j, Y' ); echo '</strong>'; ?></span></p>
  </header>

<?php elseif ( x_is_portfolio() ) : ?>
  <?php if ( $disable_page_title != 'on' || $disable_filters != 'on' ) : ?>

    <header class="x-header-landmark x-container max width">
      <?php if ( $disable_page_title != 'on' ) : ?>
        <h1 class="h-landmark"><span><?php the_title(); ?></span></h1>
      <?php endif; ?>
      <?php x_portfolio_filters(); ?>
    </header>

  <?php endif; ?>
<?php elseif ( x_is_shop() && x_get_option( 'x_integrity_shop_header_enable' ) == '1' ) : ?>

  <header class="x-header-landmark x-container max width">
    <h1 class="h-landmark"><span><?php echo x_get_option( 'x_integrity_shop_title' ); ?></span></h1>
    <p class="p-landmark-sub"><span><?php echo x_get_option( 'x_integrity_shop_subtitle' ); ?></span></p>
  </header>

<?php elseif ( x_is_buddypress() ) : ?>
  <?php if ( x_buddypress_is_component_with_landmark_header() ) : ?>

    <header class="x-header-landmark x-container max width">
      <h1 class="h-landmark"><span><?php echo x_buddypress_get_the_title(); ?></span></h1>
      <p class="p-landmark-sub"><span><?php echo x_buddypress_get_the_subtitle(); ?></span></p>
    </header>

  <?php endif; ?>
<?php endif; ?>