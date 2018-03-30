<?php global $product; 
$num_rating = (int) $product->get_average_rating();
$image_src = get_the_post_thumbnail( $product->id, 'th-shop' );

?>


<!-- Slide -->
	<div>
		<!-- Carousel Item -->
		<div class="product">
			
			<div class="product-image">
			
			
			<?php 
			if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'show') {
			echo '<a href="' . esc_url(get_permalink()) . '" class="img-product-hover">';
			} ?>
			
				<?php echo $image_src; ?>
				
			<?php 	
			if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'show') {
			echo '</a>';
			}
			?>	
				
				<?php if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') { ?>
				<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" class="product-hover">
					<i class="icons icon-eye-1"></i> <?php _e('Quick View', 'homeshop'); ?>
				</a>
				<?php } ?>
			
			
			</div>
			
			<div class="product-info">
				<h5><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo product_max_charlength_text($product->get_title(), (int) get_option('sense_num_product_title')); ?></a></h5>
				<span class="price"><?php echo $product->get_price_html(); ?></span>
				
				 <?php if (  get_option('woocommerce_enable_review_rating') != 'no'  ){ ?>
				<div class="rating readonly-rating" data-score="<?php echo $num_rating; ?>"></div>
				 <?php } ?>
				
				
			</div>
			
			<div class="product-actions">
				<?php
	
				woocommerce_template_loop_add_to_cart();
				
				if( class_exists( 'YITH_WCWL_Shortcode' ) ) {
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
				}
				
				?>
				
				
					<?php if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button() != '' ) { ?>
					<span class="add-to-compare">
						<span class="action-wrapper">
							<i class="icons icon-docs"></i>
							<span class="action-name"><?php if ( function_exists('woo_add_compare_button' ) ) echo woo_add_compare_button(); ?></span>
						</span>
					</span>
					<?php } ?>	
			</div>
			
		</div>
		<!-- /Carousel Item -->
	</div>
	<!-- /Slide -->



