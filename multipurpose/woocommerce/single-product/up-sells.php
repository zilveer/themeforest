<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

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

if ( $products->have_posts() ) : ?>
	<section class="columns product-slider content-slider">
		<nav class="controls"><a href="#" class="prev">previous</a><a href="#" class="next">next</a></nav>
		<h2 class="underline"><span><?php _e( 'You may also like&hellip;', 'woocommerce' ); ?></span></h2>
		<div class="slider-box"><div>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?><?php woocommerce_get_template_part( 'content', 'product-slider-item' ); ?><?php endwhile; // end of the loop. ?>
		</div></div>
	</section>
<?php endif;

wp_reset_postdata();
