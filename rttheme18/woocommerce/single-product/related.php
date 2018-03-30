<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post_count;

$related = $product->get_related( get_option(RT_THEMESLUG."_woo_related_product_list_pager") );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> get_option(RT_THEMESLUG."_woo_related_product_list_pager"),
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );
$post_count = $products->post_count;

$woocommerce_loop['columns'] = get_option(RT_THEMESLUG."_woo_related_products_layout") ? get_option(RT_THEMESLUG."_woo_related_products_layout") : 3;

if ( $products->have_posts() ) : 
		//js script to run
		printf('
			<script type="text/javascript">
			 /* <![CDATA[ */ 
				// run carousel
					jQuery(document).ready(function() { 
						 jQuery("#%1$s").rt_start_carousels(%2$s);
					}); 
			/* ]]> */	
			</script>
		',"woo-related-products",$woocommerce_loop['columns'],"");		
	
?>

	<div class="related products"> 

		<?php echo do_shortcode('[heading_bar heading="'.__( 'Related Products', 'woocommerce' ).'" icon="icon-link"]');?>

		<?php 
			echo '<div id="woo-related-products" class="carousel-holder clearfix margin-b20">';
			echo '<section class="carousel_items"><div class="owl-carousel">';
		?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product-carousel' ); ?>			 
 
			<?php endwhile; // end of the loop. ?>

		<?php 
			echo '</div></section></div>';
		?>

	</div>

<?php 
endif;

wp_reset_postdata();
