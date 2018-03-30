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
if(empty($product)){
	return '';
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

	<div class="related products">
		<div class="related-title">
			<h3><span><?php esc_html_e( 'Related Products', 'jakiro' ); ?></span></h3>
		</div>
		<div class="<?php if($products->post_count > 4){?>caroufredsel<?php }?> product-slider" data-visible-min="1" data-scroll-item="1"  data-responsive="1" data-infinite="1">
			<div class="caroufredsel-wrap">
				<?php woocommerce_product_loop_start(); ?>
		
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
						<?php wc_get_template_part( 'content', 'product' ); ?>
		
					<?php endwhile; // end of the loop. ?>
					
				<?php woocommerce_product_loop_end(); ?>
				<a href="#" class="caroufredsel-prev"></a>
				<a href="#" class="caroufredsel-next"></a>
			</div>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
