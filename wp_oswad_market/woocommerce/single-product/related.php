<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop,$smof_data;

do_action('wd_before_single_product_related');
if( !isset($posts_per_page) || $posts_per_page < 10 ){
	$posts_per_page = 10;
}
$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page'        => $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );
	

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;
$is_slider = true;
if ( $products->have_posts() ) : 

	if( $products->post_count <= 1 ){
		$is_slider = false;
	}
?>

	<div class="related products">
		<?php $_random_id = 'related_product_wrapper_'.rand(); ?>
		<div class="related_wrapper <?php echo ($is_slider)?'loading':''; ?>" id="<?php echo $_random_id; ?>">
	
			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
		
			<div class="related_control">
					<a id="product_related_prev" title="<?php _e('Previous','wpdance');?>" class="prev" href="#">&lt;</a>
					<a id="product_related_next" title="<?php _e('Next','wpdance');?>" class="next" href="#">&gt;</a>
	    	</div>
		</div>
	
		<?php
			$_post_count = count($products->posts);
			$_post_count = $_post_count > 5 ? 5 : $_post_count;
		?>
		<?php if( $is_slider ): ?>
		<script type="text/javascript" language="javascript">
		(function($) {
			"use strict";			
			jQuery(document).ready(function() {
				var $_this = jQuery('#<?php echo $_random_id ?>');
				var slide_speed = <?php echo (wp_is_mobile())?200:800; ?>;
				var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
				if( navigator.platform === 'iPod' ){
					slide_speed = 0;
					responsive_refresh_rate = 1000;
				}
				var owl = $_this.find('.products').owlCarousel({
							loop : true
							,nav : false
							,dots : false
							,navSpeed : slide_speed
							,slideBy: 1
							,rtl:jQuery('body').hasClass('rtl')
							,margin:10
							,navRewind: false
							,autoplay: false
							,autoplayTimeout: 5000
							,autoplayHoverPause: false
							,autoplaySpeed: false
							,mouseDrag: true
							,touchDrag: true
							,responsiveBaseElement: $_this
							,responsiveRefreshRate: responsive_refresh_rate
							,responsive:{
								0:{
									items : 1
								},
								361:{
									items : 2
								},
								579:{
									items : 3
								},
								767:{
									items : 4
								},
								1100:{
									items : <?php echo $_post_count;?>
								}
							}
							,onInitialized: function(){
								$_this.addClass('loaded').removeClass('loading');
							}
						});
						$_this.on('click', '.next', function(e){
							e.preventDefault();
							owl.trigger('next.owl.carousel');
						});

						$_this.on('click', '.prev', function(e){
							e.preventDefault();
							owl.trigger('prev.owl.carousel');
						});
			});
		})(jQuery);		
		
		
		</script>	
		<?php endif; ?>
		
	</div>


	
<?php endif;

do_action('wd_after_single_product_related');
wp_reset_postdata();
