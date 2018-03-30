<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $data, $post, $wp_query;

$permlink = get_permalink($post->ID); 

if(($term_id = get_brands_term_by_product_id($product->id)) > 0):

?>

<div class="right-sm-manufacturer-logo visible-desktop">
<div class="product-manufacturer-logo-block">

	<?php 
	
	$attach_id = wcm_sds_brands_thumbnail_id($term_id);
	
	$image = wp_get_attachment_url($attach_id);
	
	$term = get_term($term_id,'brands');
		
	?>
     <a href="<?php echo get_term_link($term_id,'brands');?>"><img title="<?php echo $term->name?>" src="<?php echo $image?>"></a>
</div>    
</div>

<?php
endif;


if($data['sellya_cblcok_status'] != '0'):
	
?>	

<div class="right-sm-custom-tab visible-desktop">

    <div class="right-sm-custom-tab-content">
    	<?php echo $data['sellya_custom_block'];?>
    </div>

</div>

<?php

endif;


$related = $product->get_related();



if ( sizeof($related) == 0 || $data['sellya_related_pro'] == 0):
	
	if($data['sellya_product_share']):
	?>
    
	<div class="right-sm-share hidden-phone">
		<div class="product-share">
			<div class="share">
			<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_1"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_2"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_3"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_4"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_5"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_6"></a><br />
					<div>
						<a href="<?php echo $permlink?>" class="addthis_counter addthis_pill_style"></a>
					</div>
				</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
			<!-- AddThis Button END -->
			</div>         
		</div> 
	</div>
	
<?php
	endif;

else:
	
	
	if($data['sellya_related_product_pos'] == 'right'):
	
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
			<div class="right-sm-related visible-desktop">
			
				<div class="product-related">
			
					<h5><?php _e('Related Products', 'woocommerce'); ?></h5>
					<script type="text/javascript">
					(function($){	
						$(function(){
							$('#slider1').bxSlider();
						});	
					}(jQuery))
					</script>
					 <ul id="slider1" >
			
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<li>
			
							
								
								 <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
							
								<div class="image">
									<a href="<?php the_permalink(); ?>">
										<?php
											/**
											 * woocommerce_before_shop_loop_item_title hook
											 *
											 * @hooked woocommerce_show_product_loop_sale_flash - 10
											 * @hooked woocommerce_template_loop_product_thumbnail - 10
											 */
											do_action( 'woocommerce_before_shop_loop_item_title' );
										?>
									</a>
								</div>
								
								
								<div class="description-r hidden-phone hidden-tablet">
									
								</div>
								
								<div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								<div class="price">
								  <?php
									  /**
									   * woocommerce_after_shop_loop_item_title hook
									   *
									   * @hooked woocommerce_template_loop_price - 10
									   */
									  do_action( 'woocommerce_after_shop_loop_item_title' );
								  ?>
								
									
								  </div>
						
										  
								
						</li>
			
						<?php endwhile; // end of the loop. ?>
			
					</ul>
			
				</div>
			</div>
			
			<?php endif;
		
			wp_reset_postdata();
	endif;
	
	
	
	if($data['sellya_product_share']):
	
	?>
	<div class="right-sm-share hidden-phone">
		<div class="product-share">
			<div class="share">
			<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style ">
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_1"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_2"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_3"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_4"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_5"></a>
					<a href="<?php echo $permlink?>" class="addthis_button_preferred_6"></a><br />
					<div>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
				</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
			<!-- AddThis Button END -->
			</div>         
		</div> 
	</div>
	
<?php
	endif;
endif;	
?>
