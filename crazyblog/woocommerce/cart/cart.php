<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-bootstrap-number', 'df-userincr' ) );
wc_print_notices();

do_action( 'woocommerce_before_cart' );
?>
<section class="block">
	<div class="container">
		<div class="row">
			<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<div class="col-md-12">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>
					<ul class="cart">
						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								?>
								<li>
									<div class="cart-list-thumb">
										<span>
											<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

											if ( !$_product->is_visible() ) {
												echo $thumbnail;
											} else {
												printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
											}
											?>
										</span>
										<?php
										if ( !$_product->is_visible() ) {
											echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
										} else {
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<h3><a href="%s">%s</a></h3>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
										}

										// Meta data
										echo WC()->cart->get_item_data( $cart_item );

										// Backorder notification
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'crazyblog' ) . '</p>';
										}
										?>
									</div>
									<div class="cart-list-price">
										<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</div>

									<div class="cart-list-quantity">
										<div class="c-input-number">
											<span>
												<?php
												if ( $_product->is_sold_individually() ) {
													$product_quantity = sprintf( '1 <input class="manual-adjust" type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
												} else {
													$product_quantity = woocommerce_quantity_input( array(
														'input_name' => "cart[{$cart_item_key}][qty]",
														'input_value' => $cart_item['quantity'],
														'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
														'min_value' => '0'
															), $_product, false );
												}

												echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
												?>

											</span>
										</div>
									</div>
									<div class="total-quantity">
										<div class="quantity-area">
											<i class="fa fa-shopping-bag"></i>
											<?php esc_html_e( 'Quantity:', 'crazyblog' ) ?>
											<span><?php echo esc_html( $cart_item['quantity'] ) ?></span>
										</div>
									</div>
									<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
													'<a href="%s" class="delete-cart" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'crazyblog' ), esc_attr( $product_id ), esc_attr( $_product->get_sku() )
											), $cart_item_key );
									?>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
				<div class="col-md-12">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon', 'crazyblog' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'crazyblog' ); ?>" /> 
							<input type="submit" class="dark-btns" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'crazyblog' ); ?>" />
						</div>
					<?php } ?>
					<div class="cart-collaterals">
						<?php do_action( 'woocommerce_cart_collaterals' ); ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php do_action( 'woocommerce_after_cart' ); ?>
<?php 
    $custom_script = 'jQuery(document).ready(function ($) {
        $(".manual-adjust").userincr({
            buttonlabels: {"dec": "-", "inc": "+"},
        }).data({"min": 0, "max": 20, "step": 1});
    });';
    wp_add_inline_script('crazyblog_df-userincr', $custom_script);
</script>