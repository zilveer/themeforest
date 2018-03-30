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

$sidebar_position1 = get_meta_option('sidebar_position_meta_box', $product->id);


$posts_per_page = 3;
if( $sidebar_position1 == 'full' ) {
$posts_per_page = 4;
}


$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="row related-products">
		<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
			<h3><?php _e( 'Related Products', 'candidate' ); ?></h3>
		</div>
							
							
		

		<?php //woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php 
				if( $sidebar_position1 == 'full' ) {
				wc_get_template_part( 'content', 'product4' ); 
				} else {
				wc_get_template_part( 'content', 'product' ); 
				}
				?>

			<?php endwhile; // end of the loop. ?>

		<?php //woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
