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

$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');

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

<div class="products-row row upsells products" >
	

		<!-- Carousel Heading -->
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="carousel-heading">
				<h4><?php _e( 'You may also like&hellip;', 'homeshop'); ?></h4>
				<?php 
				if( count($products->posts) > 3 ) {
				?>
				<div class="carousel-arrows">
					<i class="icons icon-left-dir"></i>
					<i class="icons icon-right-dir"></i>
				</div>
				<?php 
				}
				?>
			</div>
		</div>
		<!-- /Carousel Heading -->		
		

		<!-- Carousel -->
				
		<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
			
				<?php 
				if( $sidebar_position == 'full' ) { 
				echo '<div class="owl-carousel" data-max-items="4">';
				 } else { 
				echo '<div class="owl-carousel" data-max-items="3">';
				 } 

					 while ( $products->have_posts() ) : 
					   $products->the_post(); 
						wc_get_template_part( 'content', 'product-related' ); 

					 endwhile; 
				echo '</div>';
				?>

		</div>
		
		<!-- End Carousel -->


</div>

<?php endif;

wp_reset_postdata();
