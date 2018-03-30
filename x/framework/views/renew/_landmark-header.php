<?php

// =============================================================================
// VIEWS/RENEW/_LANDMARK-HEADER.PHP
// -----------------------------------------------------------------------------
// Handles content output of large headers for key pages such as the blog or
// search results.
// =============================================================================

$disable_page_title = get_post_meta( get_the_ID(), '_x_entry_disable_page_title', true );
$breadcrumbs        = x_get_option( 'x_breadcrumb_display' );

?>

<?php if ( ! x_is_blank( 1 ) && ! x_is_blank( 2 ) && ! x_is_blank( 4 ) && ! x_is_blank( 5 ) ) : ?>
  <?php if ( is_page() && $disable_page_title == 'on' ) : ?>

  <?php else : ?>

    <header class="x-header-landmark">
      <div class="x-container max width">
        <div class="x-landmark-breadcrumbs-wrap">
          <div class="x-landmark">

          <?php if ( x_is_shop() || x_is_product() ) : ?>

            <h1 class="h-landmark"><span><?php echo x_get_option( 'x_renew_shop_title' ); ?></span></h1>

          <?php elseif ( x_is_bbpress() ) : ?>

            <h1 class="h-landmark"><span><?php echo get_the_title(); ?></span></h1>

          <?php elseif ( x_is_buddypress() ) : ?>
            <?php if ( x_buddypress_is_component_with_landmark_header() ) : ?>

              <h1 class="h-landmark"><span><?php echo x_buddypress_get_the_title(); ?></span></h1>

            <?php endif; ?>
          <?php elseif ( is_page() ) : ?>

            <h1 class="h-landmark entry-title"><span><?php the_title(); ?></span></h1>

          <?php elseif ( is_home() || is_single() ) : ?>
            <?php if ( x_is_portfolio_item() ) : ?>

              <h1 class="h-landmark"><span><?php echo x_get_parent_portfolio_title(); ?></span></h1>

            <?php else : ?>

              <h1 class="h-landmark"><span><?php echo x_get_option( 'x_renew_blog_title' ); ?></span></h1>

            <?php endif; ?>
          <?php elseif ( is_search() ) : ?>

            <h1 class="h-landmark"><span><?php _e( 'Search Results', '__x__' ); ?></span></h1>

          <?php elseif ( is_category() || x_is_portfolio_category() || x_is_product_category() ) : ?>

            <?php

            $meta  = x_get_taxonomy_meta();
            $title = ( $meta['archive-title'] != '' ) ? $meta['archive-title'] : __( 'Category Archive', '__x__' );

            ?>

            <h1 class="h-landmark"><span><?php echo $title; ?></span></h1>

          <?php elseif ( is_tag() || x_is_portfolio_tag() || x_is_product_tag() ) : ?>

            <?php

            $meta  = x_get_taxonomy_meta();
            $title = ( $meta['archive-title'] != '' ) ? $meta['archive-title'] : __( 'Tag Archive', '__x__' );

            ?>

            <h1 class="h-landmark"><span><?php echo $title ?></span></h1>

          <?php elseif ( is_404() ) : ?>

            <h1 class="h-landmark"><span><?php _e( 'Oops!', '__x__' ); ?></span></h1>

          <?php elseif ( is_year() ) : ?>

            <h1 class="h-landmark"><span><?php _e( 'Post Archive by Year', '__x__' ); ?></span></h1>

          <?php elseif ( is_month() ) : ?>

            <h1 class="h-landmark"><span><?php _e( 'Post Archive by Month', '__x__' ); ?></span></h1>

          <?php elseif ( is_day() ) : ?>

            <h1 class="h-landmark"><span><?php _e( 'Post Archive by Day', '__x__' ); ?></span></h1>

          <?php elseif ( x_is_portfolio() ) : ?>

            <h1 class="h-landmark"><span><?php the_title(); ?></span></h1>

          <?php endif; ?>

          </div>

          <?php if ( $breadcrumbs == '1' ) : ?>
            <?php if ( ! is_front_page() && ! x_is_portfolio() ) : ?>
              <div class="x-breadcrumbs-wrap">
                <?php x_breadcrumbs(); ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ( x_is_portfolio() ) : ?>
            <div class="x-breadcrumbs-wrap">
              <?php x_portfolio_filters(); ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </header>

  <?php endif; ?>
<?php endif; ?>