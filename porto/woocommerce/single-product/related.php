<?php
/**
 * Related Products
 *
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $porto_settings, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $porto_settings['product-related-count'] );

if ( sizeof( $related ) === 0 || !$porto_settings['product-related'] ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $porto_settings['product-related-count'],
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = isset($porto_settings['product-related-cols']) ? $porto_settings['product-related-cols'] : $porto_settings['product-cols'];

if (!$woocommerce_loop['columns']) $woocommerce_loop['columns'] = 4;

if ( $products->have_posts() ) : ?>

	<div class="related products">

		<h2 class="slider-title"><span class="inline-title"><?php _e( 'Related Products', 'woocommerce' ) ?></span><span class="line"></span></h2>

        <div class="slider-wrapper">

            <?php
            global $woocommerce_loop;

            $woocommerce_loop['view'] = 'products-slider';

            woocommerce_product_loop_start();
            ?>

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

            <?php
            woocommerce_product_loop_end();
            ?>
        </div>

	</div>

<?php endif;

wp_reset_postdata();
