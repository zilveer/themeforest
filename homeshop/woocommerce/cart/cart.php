<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce;
wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>




<form   id="cart_form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

  <div class="row">
                    	
						
	<div class="col-lg-12 col-md-12 col-sm-12">
		
		<div class="carousel-heading">
			<h4><?php _e( 'Shopping Cart', 'homeshop' ) ?></h4>
		</div>





<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table shop_table_responsive cart shopping-table" cellspacing="0">

    <tr>
		<th colspan="2"><?php _e( 'Product Image and Name', 'homeshop' ); ?></th>
		<th><?php _e( 'SKU', 'homeshop' ); ?></th>
		<th><?php _e( 'Price', 'homeshop' ); ?></th>
		<th><?php _e( 'Quanitity', 'homeshop' ); ?></th>
		<th><?php _e( 'Discount', 'homeshop' ); ?></th>
		<th colspan="2" ><?php _e( 'Total', 'homeshop' ); ?></th>
	</tr>

	
	<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				
				
			<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				<td class="image-column">
				<?php
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $_product->is_visible() )
						echo $thumbnail;
					else
						printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
				?>
				</td>
				
				<td>
				<?php
					if ( ! $_product->is_visible() )
						echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					else
						echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

					// Meta data
					echo WC()->cart->get_item_data( $cart_item );

					// Backorder notification
					if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
						echo '<p class="backorder_notification">' . __( 'Available on backorder', 'homeshop' ) . '</p>';
				?>
				</td>
				
				<td>
				<?php 
				
				if ( wc_product_sku_enabled() && ( $_product->get_sku() || $_product->is_type( 'variable' ) ) ) { ?>
				<p>
					<?php echo ( $sku = $_product->get_sku() ) ? $sku : __( 'n/a', 'homeshop' ); ?>
				</p>
				<?php } ?>
				</td>
				
				<td class="product-price" >
					<p><?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</p>
				</td>
				
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
					<p>
					
					<?php 

	$product_delete = __( 'Delete', 'homeshop' );				
					
					
					 
					?>	
						
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="red-hover" title="%s"><i class="icons icon-cancel-3"></i> %s</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'homeshop' ), $product_delete ), $cart_item_key );
						?>
					</p>
				</td>
				
				

				
				
				<td><p>
				<?php if ($woocommerce->cart->get_total_discount()) : ?>
                    <dd>
                        <span class="label"><?php _e('Cart Discount', 'homeshop'); ?> </span>
                        <span>-<?php echo $woocommerce->cart->get_total_discount(); ?></span>
                    </dd>
                <?php endif; ?>
				</p></td>
				
				<td colspan="2" >
				<p>
				<?php
					echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
				?>
				</p>
				</td>
				
			</tr> 	
	
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		

		
		
		<tr>
			<td class="align-right" colspan="5"><?php _e('Product prices result', 'homeshop'); ?></td>
			<td></td>
			<td></td>
			<td class="product-subtotal" ><strong>
			<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
						</strong></td>	
		</tr>

		
		
		
		
		<tr>
			<td colspan="8" class="actions">

				<input type="submit" class="big green" name="update_cart" value="<?php _e('Update Cart', 'homeshop'); ?>" /> 
				
				<?php do_action( 'woocommerce_cart_actions' ); ?>
				
				<input type="submit" class="big green" name="proceed" value="<?php _e('Proceed to Checkout', 'homeshop'); ?>" />

				<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php wp_nonce_field('woocommerce-cart'); ?>
				

			</td>
		</tr>
<?php do_action( 'woocommerce_after_cart_contents' ); ?>
</table>




<?php if ( WC()->cart->coupons_enabled() ) { ?>
	<div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Coupon code', 'homeshop' ); ?></h4>
			</div>
			
			<div class="page-content">
				
				<div class="row">
				
					<div class="col-lg-12 col-md-12 col-sm-12">
						
						<table class="coupon-table">
							<tr>
								<td><input type="text" id="coupon_code" name="coupon_code" value="" placeholder="<?php _e( 'Enter your coupon code', 'homeshop' ); ?>"></td>
								<td class="fit-cell"><input type="submit" name="apply_coupon" class="big green" value="<?php _e( 'Save', 'homeshop' ); ?>"></td>
								
						<?php do_action('woocommerce_cart_coupon'); ?>
							</tr>
						</table>
					</div>
				</div>
				
			</div>
			
		</div>
		  
	</div>
<?php } ?>


	</div>                     
</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>






<?php woocommerce_cross_sell_display(); ?>






<div class="row cart-collaterals">
    <?php 	
	if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) {
	?>	
	
	<div class="col-lg-12 col-md-12 col-sm-12 w_cart_totals">
		<div class="carousel-heading">
			<h4><?php _e( 'Cart Totals', 'homeshop' ); ?></h4>
		</div>
		
		
		
		<?php 
		remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
		
		do_action( 'woocommerce_cart_collaterals' ); ?>   
	</div>	
	
	
	<?php 	
	} else {
	?>	             	

	<div class="col-lg-6 col-md-6 col-sm-6 w_cart_totals2">
		<div class="carousel-heading">
			<h4><?php _e( 'Cart Totals', 'homeshop' ); ?></h4>
		</div>

		
		<?php 
		remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
		
		do_action( 'woocommerce_cart_collaterals' ); ?>   
	</div>	

	<div class="col-lg-6 col-md-6 col-sm-6">
		<div class="carousel-heading">
			<h4><?php _e( 'Calculate Shipping', 'homeshop' ); ?></h4>
		</div>
		<?php woocommerce_shipping_calculator(); ?>
	</div>	
	
	<?php } ?>							
							
</div>							
							

<?php do_action( 'woocommerce_after_cart' ); ?>