<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2" class="product-thumbnail product-name first"><?php _e( 'Items', 'wpdance' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'wpdance' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'wpdance' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'wpdance' ); ?></th>
			<th class="product-remove last"><?php _e( 'Remove', 'wpdance' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
		
			$showed_item = 0;
			$number_item = count(WC()->cart->get_cart());
		
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$showed_item++;
				if($number_item>1){
					$class_row = ($showed_item==1)?" first":(($showed_item==$number_item)?" last":"");
				}
				else{
					$class_row = " first last";
				}
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); echo $class_row ?>">

						<!-- The thumbnail -->
						<td class="product-thumbnail">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $_product->is_visible() )
									echo $thumbnail;
								else
									printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
							?>
						</td>
						<td class="product-title">
						<?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
								echo '<p class="backorder_notification">' . __( 'Available on backorder', 'wpdance' ) . '</p>';
						
							echo '<span class="wd_product_number"> '.apply_filters( 'woocommerce_checkout_item_quantity', '<span class="product-quantity">&times; ' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key ).'</span>';
							echo ((strlen($_product->post->post_excerpt)>0)?'<p class="wd_product_excerpt">'.string_limit_words(wp_strip_all_tags($_product->post->post_excerpt),10).'...</p>':' ');
						?>
						

						<!-- Product Name -->
								
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
						
						<td class="remove-product">
						<?php 
							//Remove from cart link
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'wpdance' ) ), $cart_item_key );
						?>
						</td>			
						
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">
			<input type="submit" class="button" name="update_cart" value="<?php _e( 'Update Cart', 'wpdance' ); ?>" />
			<a class="button bt_back_to_shop" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Back To Shop', 'wpdance' ) ?></a>
			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
	
	<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">	
		<div class="coupon_wrapper">
		
				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">
						<div class="wd_title_cart"><h2 for="coupon_code" class="heading-title"><?php _e( 'Discount code', 'wpdance' ); ?></h2></div>
						<div class="content_coupon">
							<p><?php _e( 'Enter your coupon code if your have one', 'wpdance' ); ?></p>
							<input name="coupon_code" class="input-text" id="coupon_code" value="" /> 
							<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'wpdance' ); ?>" />
							<?php do_action('woocommerce_cart_coupon'); ?>
						</div>
					</div>
				<?php } ?>

		</div>
	</form>
	
	<?php woocommerce_shipping_calculator(); ?>	
	
	<?php woocommerce_cart_totals(); ?>
	<?php remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );?>
	<?php do_action('woocommerce_cart_collaterals'); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>