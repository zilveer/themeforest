<?php
/**
 * Cross-sells
 *
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $porto_settings;

$crosssells = WC()->cart->get_cross_sells();

if ( 0 === sizeof( $crosssells ) || !$porto_settings['product-crosssell']) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $porto_settings['product-crosssell-count'] ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">

        <h2 class="slider-title"><span class="inline-title"><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></span><span class="line"></span></h2>

        <div class="slider-wrapper">

            <?php
            global $woocommerce_loop, $porto_layout;
            $woocommerce_loop['view'] = 'products-slider';
            if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') {
                $woocommerce_loop['columns'] = 3;
            } else {
                $woocommerce_loop['columns'] = 4;
            }
            $woocommerce_loop['widget'] = true;

            woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

            <?php
            woocommerce_product_loop_end();
            ?>

        </div>

	</div>

<?php endif;

wp_reset_query();