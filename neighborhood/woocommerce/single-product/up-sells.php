<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop, $sf_carouselID;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

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

//$woocommerce_loop['columns'] 	= $columns;
$woocommerce_loop['columns'] = 4;


if ($sf_carouselID == "") {
$sf_carouselID = 1;
} else {
$sf_carouselID++;
}


if ( $products->have_posts() ) : ?>

	<div class="product-carousel spb_content_element">

		<h4 class="lined-heading"><span><?php _e( 'You may also like&hellip;', 'swiftframework' ) ?></span></h4>
		
		<div class="carousel-wrap">
		
			<ul class="upsells products carousel-items" id="carousel-<?php echo esc_attr($sf_carouselID); ?>" data-columns="<?php echo esc_attr($woocommerce_loop['columns']); ?>>">
				
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
	
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	
				<?php endwhile; // end of the loop. ?>
	
			</ul>
	
			<a href="#" class="carousel-prev"><i class="fa-chevron-left"></i></a><a href="#" class="carousel-next"><i class="fa-chevron-right"></i></a>
		
		</div>

	</div>

<?php endif;

global $include_carousel, $include_isotope;
$include_carousel = true;
$include_isotope = true;

wp_reset_postdata();
