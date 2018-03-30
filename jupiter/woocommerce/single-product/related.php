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



if(isset($_GET['testing'])) {
	// in order to prevent random related products, we are getting all related products and ordering it by id
	// You can increase parameter for get related 50 will be enough for a long time
	$related = $product->get_related( 50 );
	$orderby="ID";
} else {
	$related = $product->get_related( $posts_per_page );
}


if ( sizeof( $related ) == 0 ) return;

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

	<div class="related products compact-layout grid--float">
	<h4><?php _e( 'Related Products', 'mk_framework' ); ?></h4>	
		<section class=" mk--row">
		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>
		</section>
	</div>

<?php endif;

wp_reset_postdata();
