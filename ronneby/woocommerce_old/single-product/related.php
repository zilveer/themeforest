<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$unique_id = uniqid('rp_');

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> -1,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<div class="twelve columns related products products-slider-wrap widget">

		<h3 class="widget-title"><?php _e( 'Related products', 'dfd' ); ?></h3>
		
		<div id="<?php echo esc_attr($unique_id); ?>" class="related_products products-slider">
		
			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product-slider' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
			
		</div>

	</div>

	<script type="text/javascript">
	(function($){
		"use strict";
		$(document).ready(function(){

			$('#<?php echo esc_js($unique_id); ?> .products').slick({
				infinite: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				autoplay: false,//true
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 3,
							infinite: true,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							infinite: true,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: true
						}
					}
				]
			});
		});
		$('#<?php echo esc_js($unique_id); ?> .product').on('mousedown select',(function(e){
			e.preventDefault();
		}));
	})(jQuery);
	</script>

<?php endif;

wp_reset_postdata(); wp_reset_query();
