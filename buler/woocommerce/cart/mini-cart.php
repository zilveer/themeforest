<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     99.99
 */

global $woocommerce;
?>	
				<ul class="cart_list product_list_widget  ">
					


					<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

						<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

							$_product = $cart_item['data'];
							// Only display if allowed
							if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
								continue;

							// Get price
							$product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price() ;
							
							$product_price = $product_price * $cart_item['quantity'];
							
							$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
							global $wpdb;
							$count = $wpdb->get_var("
								SELECT COUNT(meta_value) FROM $wpdb->commentmeta
								LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
								WHERE meta_key = 'rating'
								AND comment_post_ID = ".$cart_item['product_id']."
								AND comment_approved = '1'
								AND meta_value > 0
							");
							$rating = $wpdb->get_var("
								SELECT SUM(meta_value) FROM $wpdb->commentmeta
								LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
								WHERE meta_key = 'rating'
								AND comment_post_ID = ".$cart_item['product_id']."
								AND comment_approved = '1'
							");

							?>

							<li>
								<div class="cartImage">
									<?php
									$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), '', $cart_item_key );
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $cart_item['product_id'] ) ) ), $thumbnail );
									?>
								</div>
								<div class="cartTitleRating">
									<div class="cartTitle">
										<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

											
											<?php echo $cart_item['quantity'] ?> x <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>

										</a>
									</div>
										
									<div class="cartRating">
										<?php 
										if ( $count > 0 ) :
											$average = number_format($rating / $count, 2);
											echo '<div class="star-rating" title="'.sprintf(__('Rated 0 out of 5', 'buler'), $average).'"><span style="width:'.($average*16).'px"></div>';
										endif;


										?>
									</div>
								</div>
								<div class="cartPrice">
									<span class="quantity"><?php printf( '%s',  $product_price ); ?></span>
								</div>
							</li>

						<?php endforeach; ?>

					<?php else : ?>

						<li class="fa fa-empty cart"><?php _e('No products in the cart.', 'buler'); ?></li>

					<?php endif; ?>
				<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
						<p class="total top"><strong><?php _e('Subtotal', 'buler'); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></p>
					
					<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

					<p class="buttons">
					<?php 
						$check_out = '';
						if($woocommerce->cart->get_cart_url() != ''){ 
						if (function_exists('icl_object_id')) {
							$cart= get_permalink(icl_object_id(woocommerce_get_page_id( 'cart' ), 'page', false));
							$check_out = get_permalink(icl_object_id(woocommerce_get_page_id( 'checkout' ), 'page', false));
							}
						else {
							$cart=$woocommerce->cart->get_cart_url();
							$check_out = $woocommerce->cart->get_checkout_url(); 
						}
						}
						else {$cart = home_url().'cart/';};
					?>
						<a href="<?php echo $cart ; ?>" class="button"><?php _e('View Cart', 'buler'); ?></a>
						<a href="<?php echo $check_out; ?>" class="button checkout"><?php _e('Checkout', 'buler'); ?></a>
					</p>

			<?php endif; ?>


			</ul>	
