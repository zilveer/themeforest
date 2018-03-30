<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) return;

$woo_related_n=esc_attr(get_option('cb5_woo_related_n'));
$woo_related_c=esc_attr(get_option('cb5_woo_related_c'));

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $woo_related_n,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $woo_related_c;

if ( $products->have_posts() ) : ?>
</div>
<div class="cl"></div>
<section class="section-related-products single-product-page">

	<h2>
			<span class="divider_h"></span>
	<?php _e( 'Related Products', 'cb-modello' ); ?>
	</h2>
<div class="product-grid no-move-down"><div class="tab-pane active">
	<?php woocommerce_product_loop_start(); ?>

	<?php while ( $products->have_posts() ) : $products->the_post(); ?>

	<?php woocommerce_get_template_part( 'content', 'product' ); ?>

	<?php endwhile; // end of the loop. ?>

	<?php woocommerce_product_loop_end(); ?>
    </div></div>
</section>
<div>
	<?php endif;

	wp_reset_postdata();
