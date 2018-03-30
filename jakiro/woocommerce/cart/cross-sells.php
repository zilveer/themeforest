<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();
$crosssells_flag=false;
$cart_rand_id = 0;
if(absint( $woocommerce->cart->cart_contents_count ) && sizeof( $crosssells ) == 0 && apply_filters('dh_use_custom_cross_sell', true)){
	$cart_products_arr = array();
	foreach ( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) {
		$cart_product = $cart_item['data'];
		$cart_products_arr[] = $cart_product->id;
	}
	$cart_rand_id = $cart_products_arr[array_rand($cart_products_arr, 1)];
	$cart_rand_product = get_product($cart_rand_id);
	$crosssells = $cart_rand_product->get_related();
	$crosssells_flag=true;
}
if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);
if($crosssells_flag){
	$args['post__not_in'] = array( $cart_rand_id ); 
}

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">
		<h3 class="woo-cart-cross-sells"><?php esc_html_e( 'You may be interested in&hellip;', 'jakiro' ) ?></h3>
		<ul class="products columns-3">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</ul>
	</div>
<?php endif;

wp_reset_postdata();