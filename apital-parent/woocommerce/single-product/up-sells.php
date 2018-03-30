<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) {
	return;
}

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

if ( $products->have_posts() ) : ?>

	<div class="upsells products">

        <div class="tittle-line">
            <h5><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h5>
            <div class="divider-1 small">
                <div class="divider-small"></div>
            </div>
        </div>

		<?php woocommerce_product_loop_start(); ?>
            <div class="w-row related-posts">
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    <div class="w-col w-col-4">
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    </div>
                <?php endwhile; // end of the loop. ?>
            </div>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
