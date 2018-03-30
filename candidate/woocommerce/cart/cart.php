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

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shopping-cart-table shop_table shop_table_responsive cart animate-onscroll" cellspacing="0">

		<tr>
			<th class="shopping-cart-item"><?php _e( 'Product', 'candidate' ); ?></th>
			<th class="price"><?php _e( 'Price', 'candidate' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'candidate' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'candidate' ); ?></th>
			<th class="product-remove"></th>
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

					<td class="shopping-cart-item">
					
						<div class="product-thumbnail">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if( has_post_thumbnail($product_id) ) {
							echo get_the_post_thumbnail( $product_id, 'thumbnail' ); 
							} else {
							echo woocommerce_placeholder_img( 'shop_thumbnail' );
							} ?>
						</div>
					
						<h6>
						<?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );	
						?>
						</h6>
						
						<?php  // Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'candidate' ) . '</p>'; 
						?>
						
						
					</td>

					<td class="product-price price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
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
					</td>

					<td class="price product-subtotal">
						<strong>
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</strong>
					</td>
					
					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="icons remove-shopping-item icon-cancel-circled"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'candidate' ) ), $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		
		
		<tr>
			<td class="actions apply-coupon">

				<?php if ( WC()->cart->coupons_enabled() ) { ?>

						<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'candidate' ); ?>" /><input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply coupon', 'candidate' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

				<?php } ?>

			</td>
			
			
			<td colspan="4" class="align-right">
			<input type="submit" class="button" name="update_cart" value="<?php _e( 'Update Cart', 'candidate' ); ?>" /> 
			<input type="submit" class="checkout-button button button-arrow donate alt wc-forward" name="proceed" value="<?php _e( 'Proceed to checkout', 'candidate' ); ?>" />

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>	
				
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>




<div class="row shopping-cart-forms">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php woocommerce_shipping_calculator(); ?>

</div>
	
	
	

<?php do_action( 'woocommerce_after_cart' ); ?>




<?php 
wp_reset_postdata();

$posts_per_page = 3;




$args = array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => 'date'
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = 3;

if ( $products->have_posts() ) : ?>

	<div class="row related-products">
		<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
			<h3><?php _e( 'You may be interested in...', 'candidate' ); ?></h3>
		</div>
							
							
		

		<?php //woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php //woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();



?>




