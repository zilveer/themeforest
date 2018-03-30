<?php

// =============================================================================
// WOOCOMMERCE/CART/CROSS-SELLS.PHP
// -----------------------------------------------------------------------------
// @version 1.6.4
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

global $product, $woocommerce, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$enable  = x_get_option( 'x_woocommerce_cart_cross_sells_enable' );
$count   = x_get_option( 'x_woocommerce_cart_cross_sells_count' );
$columns = x_get_option( 'x_woocommerce_cart_cross_sells_columns' );

$args = array(
  'post_type'           => 'product',
  'ignore_sticky_posts' => 1,
  'no_found_rows'       => 1,
  'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $count ),
  'orderby'             => $orderby,
  'post__in'            => $crosssells,
  'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() && $enable == '1' ) : ?>

  <div class="cross-sells cols-<?php echo $columns; ?>">
    <h2><?php _e( 'You May Be Interested In&hellip;', '__x__' ) ?></h2>

    <?php woocommerce_product_loop_start(); ?>
      <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php wc_get_template_part( 'content', 'product' ); ?>
      <?php endwhile; ?>
    <?php woocommerce_product_loop_end(); ?>

  </div>

<?php endif;

wp_reset_query();