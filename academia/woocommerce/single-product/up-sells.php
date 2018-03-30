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


$g5plus_woocommerce_loop = G5Plus_Global::get_woocommerce_loop();
$g5plus_woocommerce_single = G5Plus_Global::get_woocommerce_single();
$g5plus_options = &G5Plus_Global::get_options();

$has_sidebar =  $g5plus_woocommerce_single['has_sidebar'];
$related_product_display_columns = 4;
if ($has_sidebar) {
	$related_product_display_columns = 3;
}

$related_product_display_columns = apply_filters('related_product_display_columns',$related_product_display_columns);

$g5plus_woocommerce_loop['rating'] = 1;
$g5plus_woocommerce_loop['columns'] = $related_product_display_columns;
$g5plus_woocommerce_loop['layout'] = 'slider';


if ( $products->have_posts() ) : ?>

	<div class="upsells products">

		<h4 class="sc-title p-font"><span><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ) ?></span></h4>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
