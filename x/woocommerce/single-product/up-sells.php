<?php

// =============================================================================
// WOOCOMMERCE/SINGLE-PRODUCT/UP-SELLS.PHP
// -----------------------------------------------------------------------------
// @version 1.6.4
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

GLOBAL $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
  'post_type'           => 'product',
  'ignore_sticky_posts' => 1,
  'no_found_rows'       => 1,
  'posts_per_page'      => $posts_per_page,
  'orderby'             => $orderby,
  'post__in'            => $upsells,
  'post__not_in'        => array( $product->id ),
  'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

$enable  = x_get_option( 'x_woocommerce_product_upsells_enable' );
$columns = x_get_option( 'x_woocommerce_product_upsell_columns' );

if ( $products->have_posts() && $enable == '1' ) : ?>

  <div class="upsells products cols-<?php echo $columns; ?>">

    <h2><?php _e( 'You may also like&hellip;', '__x__' ) ?></h2>

    <?php woocommerce_product_loop_start(); ?>
      <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php wc_get_template_part( 'content', 'product' ); ?>
      <?php endwhile; ?>
    <?php woocommerce_product_loop_end(); ?>

  </div>

<?php endif;

wp_reset_postdata();