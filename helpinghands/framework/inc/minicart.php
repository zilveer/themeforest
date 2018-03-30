<?php 
/**
 * WooCommerce Minicart
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

global $woocommerce, $sd_data;
?>
	<div class="sd-minicart-modal mfp-with-anim mfp-hide">
		<div class="sd-minicart clearfix">
			<ul class="sd-header-cart-list">
				<li>
					<?php if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ) { ?>
						<h4>
							<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php esc_attr_e('View shopping cart', 'sd-framework'); ?>">
								<?php printf( _n( '%d item in the cart', '%d items in the cart', $woocommerce->cart->cart_contents_count, 'sd-framework' ), $woocommerce->cart->cart_contents_count); ?> (<?php echo $woocommerce->cart->get_cart_total(); ?>)
							</a>
						</h4>
		
						<?php foreach ( $woocommerce->cart->cart_contents as $sd_item_key => $sd_item ) { ?>
							
							<?php
								$sd_cart_item = $sd_item['data']; 
								$sd_product_title = $sd_cart_item->get_title(); 
							?>
							
							<?php if ( $sd_cart_item->exists() && $sd_item['quantity'] > 0 ) { ?>
								
								<div class="sd-header-cart-wrapper clearfix">
									<a href="<?php echo get_permalink( $sd_item['product_id'] ); ?>"><?php echo $sd_cart_item->get_image(); ?></a>
									
									<div class="sd-header-cart-content">	
										<h5><a href="<?php echo get_permalink( $sd_item['product_id'] ); ?>"> <?php echo apply_filters( 'woocommerce_cart_widget_product_title', $sd_product_title, $sd_cart_item ); ?></a></h5>
										<span class="sd-top-cart-price">
											<?php _e( 'Price:', 'sd-framework' ); ?>
											<?php echo woocommerce_price( $sd_cart_item->get_price() ); ?>
										</span>
										
										<span class="sd-top-cart-quant">
											<?php _e('Quantity:', 'sd-framework'); ?>
											<?php echo $sd_item['quantity']; ?>
										</span>
				
										<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="sd-remove-from-cart" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $sd_item_key ) ), __( 'Remove item', 'woocommerce' ) ), $sd_item_key ); ?>
									</div>
									<!-- sd-header-cart-content -->
								</div>
								<!-- sd-header-cart-wrapper -->
							<?php } ?>
						<?php } ?>
		
		
						<a class="sd-header-view-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">	<?php _e( 'View cart', 'sd-framework' ); ?>	</a>
						<a class="sd-header-checkout sd-opacity-trans" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>">	<?php _e( 'Go to checkout', 'sd-framework' ); ?></a>
		
		
					<?php } else { ?>
					
						<h4><?php _e('Your shopping cart is empty.', 'sd-framework' ); ?></h4>
					
						<?php $sd_shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
						
						<a class="sd-header-view-cart" href="<?php echo esc_url( $sd_shop_page_url ); ?>"> <?php _e( 'Go to the shop', 'sd-framework' ); ?></a>
					<?php } ?>
				</li>
			</ul>
		</div>
		<!-- sd-minicart -->
		<button class="mfp-close sd-bg-trans" type="button" title="<?php esc_attr_e( 'Close', 'sd-framework' ); ?> (Esc)">×</button>
	</div>
	<!-- sd-minicart-modal -->
