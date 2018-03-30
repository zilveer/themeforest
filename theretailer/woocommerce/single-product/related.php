<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $theretailer_theme_options;

$related_products_per_page = 4;

if ( is_product() &&  (isset($theretailer_theme_options['products_layout'])) && ($theretailer_theme_options['products_layout'] == "1")) {
	$related_products_per_page =3 ;
}

if ((!isset($theretailer_theme_options['related_products_on_product_page'])) || ($theretailer_theme_options['related_products_on_product_page'] == "1")) {

	$related = $product->get_related(12);
	
	if ( sizeof($related) == 0 ) return;
	
	$args = apply_filters('woocommerce_related_products_args', array(
		'post_type'				=> 'product',
		'ignore_sticky_posts'	=> 1,
		'no_found_rows' 		=> 1,
		'posts_per_page' 		=> $posts_per_page,
		'orderby' 				=> $orderby,
		'post__in' 				=> $related
	) );
	
	$products = new WP_Query( $args );
	
	$woocommerce_loop['columns'] 	= $columns;
	
	if ( $products->have_posts() ) : ?>
	
		<?php $sliderrandomid = rand() ?>
		
	<script>
	jQuery(document).ready(function($) {
		
		var related_products_slider = $("#related-products-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			up_sells_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			related_products_slider.owlCarousel({
				items:<?php echo $related_products_per_page; ?>,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
		
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			related_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			related_products_slider.trigger('owl.next');
		})
		
	});
	</script>
		
		<div class="grid_12">
		
			<div class="slider-master-wrapper related_products_section gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
				
				<div class="gbtr_items_sliders_header">
					<div class="gbtr_items_sliders_title">
						<div class="gbtr_featured_section_title"><strong><?php _e('Related Products', 'woocommerce'); ?></strong></div>
					</div>
					<div class="gbtr_items_sliders_nav">                        
						<a class='big_arrow_right'></a>
						<a class='big_arrow_left'></a>
						<div class='clr'></div>
					</div>
				</div>
				
				<div class="gbtr_bold_sep"></div>   
			
				<div class="slider-wrapper">
					<div class="slider" id="related-products-<?php echo $sliderrandomid ?>">
					
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
							<ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
			
						<?php endwhile; // end of the loop. ?>
					
					</div><!--.slider-->
				</div><!--.slider-wrapper-->
			
			</div>
		
		</div>
	
	<?php endif;
	
	wp_reset_postdata();

}
