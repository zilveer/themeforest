<?php
if ( ! function_exists( 'wd_tini_cart' ) ) {
	function wd_tini_cart(){
		
		if ( !wd_is_woocommerce() ) {
			return '';
		}
		global $smof_data;
		if( isset($smof_data['wd_enable_catalog_mod']) && $smof_data['wd_enable_catalog_mod'] == 1 ){
			return '';
		}
		$_cart_empty = sizeof( WC()->cart->get_cart() ) > 0 ? false : true ;
		$_cart_size_id = "cart_size_value_head-".rand();
		ob_start();
		
		?>
		<?php do_action( 'wd_before_tini_cart' ); ?>
		<div class="wd_tini_cart_wrapper">
			<div class="wd_tini_cart_control ">
				
				<span class="cart_size">
					<a href="<?php echo WC()->cart->get_cart_url();?>" title="<?php _e('View your shopping bag','wpdance');?>">
						<span class="ic-bag"></span>
					
					<!--<span class="cart_division">/</span>-->
					<span class="cart_size_value_head" id="<?php echo $_cart_size_id; ?>">
						<span class="cart_text">
							<span class="text"><?php _e('My cart','wpdance');?></span>
							<span class="total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
						</span>
						<span class="cart_item">
							<span class="num_item">
							<?php 
							$number = WC()->cart->cart_contents_count;
							if( $number < 10 && $number != 0 )
								echo '0'.$number;
							else
								echo $number;
							?>
							</span>
						</span>
					</span>
					</a>
				</span>
				
			</div>
			
			<div class="cart_dropdown drop_down_container">
				<?php if($_cart_empty): ?>
				<div class="dropdown_header">
					<h4><a href="<?php echo WC()->cart->get_cart_url();?>"><?php _e('shopping bag','wpdance');?></a></h4>
						<span class="cart_dropdown_size <?php if( $_cart_empty ) echo "size_empty";?>">
							<label>	
								<?php if ( !$_cart_empty ) : ?>
									<?php //_e('there are','wpdance');?> 
									<!--<span id="cart_size_value"><?php //echo WC()->cart->cart_contents_count;?></span>-->
									<?php// _e('items in your shopping bag','wpdance');?>
								<?php else : ?>
									<?php _e('You have no items in your shopping cart.','wpdance');?>
								<?php endif;?>
							</label>
						</span>
				</div>
				<?php endif; ?>
				<?php if ( !$_cart_empty ) : ?>
				<div class="dropdown_body">
					<span class="head_msg"><?php _e('Shopping cart','wpdance');?></span>
					<ul class="cart_list product_list_widget">
							
							<?php
								$_cart_array = WC()->cart->get_cart();
								$_index = 0;
							?>
							
							<?php foreach ( $_cart_array as $cart_item_key => $cart_item ) :
								
								$_product = $cart_item['data'];

								// Only display if allowed
								if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
									continue;

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								$product_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key );
								?>

								<li class="<?php echo $_cart_li_class = ($_index == 0 ? "first" : ($_index == count($_cart_array) - 1 ? "last" : "")) ?>">
									<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
										<?php echo $_product->get_image(); ?>
									</a>
									<div class="cart_item_wrapper">	
										<div class="wd_cart_item_categories">
										<?php //echo $_product->get_categories();?>	
										</div>
										<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
											<?php echo $_product->get_title(); ?>
											<?php //echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
										</a>
											<?php //echo WC()->cart->get_item_data( $cart_item ); ?>
											<?php //echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . sprintf( '%s', $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
											<?php
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'wpdance' ) ), $cart_item_key );
										?>
									</div>
								</li>

								<?php $_index++; ?>
								
							<?php endforeach; ?>
					</ul><!-- end product list -->
				</div>
				<?php endif; ?>		
				<?php if ( !$_cart_empty ) : ?>				
				<div class="dropdown_footer">
					

						<p class="total"><span class="title"><?php _e( 'Subtotal :', 'wpdance' ); ?></span> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

						<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

						<p class="buttons">
							<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout"><?php _e( 'Checkout', 'wpdance' ); ?></a>
						</p>
						
				</div>
				<?php endif; ?>
			</div>
		</div>
		<span class="visible-phone cart-drop-icon"></span>
		<?php do_action( 'wd_after_tini_cart' ); ?>
<?php
		$tini_cart = ob_get_clean();
		return $tini_cart;
	}
}

if ( ! function_exists( 'wd_update_tini_cart' ) ) {
	function wd_update_tini_cart() {
		die($_tini_cart_html = wd_tini_cart());
	}
}

/* Support WooCommerce Multilingual */
function wd_tiny_cart_add_ajax_action($actions){
	$actions[] = 'update_tini_cart';
	return $actions;
}

add_action('init', 'wd_tiny_cart_add_filter', 1);
function wd_tiny_cart_add_filter(){
	add_filter( 'wcml_multi_currency_is_ajax', 'wd_tiny_cart_add_ajax_action');
}

add_action('wp_ajax_update_tini_cart', 'wd_update_tini_cart');
add_action('wp_ajax_nopriv_update_tini_cart', 'wd_update_tini_cart');

?>
