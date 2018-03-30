<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

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

$products = new WP_Query( $args );

//$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );


$g5plus_woocommerce_loop = &G5Plus_Global::get_woocommerce_loop();
$g5plus_woocommerce_single = G5Plus_Global::get_woocommerce_single();
$g5plus_options = &G5Plus_Global::get_options();


$has_sidebar =  $g5plus_woocommerce_single['has_sidebar'];
$related_product_display_columns = 3;
if ($has_sidebar) {
	$related_product_display_columns = 2;
}

$related_product_display_columns = apply_filters('related_product_display_columns',$related_product_display_columns);

$g5plus_woocommerce_loop['rating'] = 0;
$g5plus_woocommerce_loop['columns'] = $related_product_display_columns;
$g5plus_woocommerce_loop['layout'] = 'slider';

if ( $products->have_posts() ) : ?>
	<div class="container">
		<div class="cross-sells">

			<div class="heading color-dark text-center mg-bottom-60">
				<span class="s-color"><i class="fa fa-star"></i></span>
				<h2 class="heading-color fs-38"><?php esc_html_e('YOU MAY BE INTERESTED IN','g5plus-academia') ?></h2>
				<p class="fs-14"></php esc_html_e('RELATED PRODUCTS','g5plus-academia') ?></p>
			</div>

			<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>
	</div>

<?php endif;

wp_reset_query();
