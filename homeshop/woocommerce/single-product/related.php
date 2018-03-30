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
$posts_per_page1 = -1;
$related = $product->get_related( 100 );



if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page1,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>
	<!-- Carousel Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="carousel-heading">
			<h4><?php _e( 'Related Products', 'homeshop' ); ?></h4>
			<div class="carousel-arrows">
				<i class="icons icon-left-dir"></i>
				<i class="icons icon-right-dir"></i>
			</div>
		</div>
	</div>
	<!-- /Carousel Heading -->
	
	<!-- Carousel -->
	<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
		
		<div class="owl-carousel" data-max-items="3">


		<?php //woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product-related' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php //woocommerce_product_loop_end(); ?>

		</div>
	</div>

<?php endif;

wp_reset_postdata();
