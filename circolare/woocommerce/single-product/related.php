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

$posts_per_page = 3;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>
	<div class="clear"></div>
	<div class="block-separator-top-homepage"></div>
	<div class="related products">
		<div class="grid-view">
		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
			<ul class="products">
			<?php woocommerce_product_loop_start(); ?>
	
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
	
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	
				<?php endwhile; // end of the loop. ?>
	
			<?php woocommerce_product_loop_end(); ?>
		</ul>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
