<?php
/**
 * Cross-sells
 * @version    1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce_loop, $woocommerce, $product;

$crosssells = $woocommerce->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) {
    return;
}

$args = array(
    'post_type'           => 'product',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', 3 ),
    'no_found_rows'       => 1,
    'orderby'             => 'rand',
    'post__in'            => $crosssells,
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', 3 );

if ( $products->have_posts() ) : ?>

    <div class="cross-sells">

        <h2><?php _e( 'You may be interested in&hellip;', 'yiw' ) ?></h2>

        <ul class="products">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

        </ul>

    </div>

<?php endif;

wp_reset_query();
