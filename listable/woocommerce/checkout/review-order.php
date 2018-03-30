<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="cart">
<table class="table--checkout">
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>

					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart__item', $cart_item, $cart_item_key ) ); ?>">
						<td>
							<div class="product__details">
								<div class="product__thumbnail">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $_product->is_visible() ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
									}
									?>
								</div>
								<div class="product__content">
									<h3 class="product__title">
										<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
										<span class="product__quantity">
											<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
										</span>
									</h3>
									<?php
									$meta = WC()->cart->get_item_data( $cart_item );
									if ( !empty( $meta ) ): ?>
										<div class="product__metadata">
											<?php echo WC()->cart->get_item_data( $cart_item ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</td>
						<td class="product__subtotal">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
</table>
</div>
<div class="cart__footer">
	<div class="cart__subtotal">
		<div><?php _e( 'Subtotal', 'woocommerce' ); ?></div>
		<div><?php wc_cart_totals_subtotal_html(); ?></div>
	</div>

	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class="cart__discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<div><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
			<div><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
		</div>
	<?php endforeach; ?>

	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

		<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

		<?php wc_cart_totals_shipping_html(); ?>

		<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<div class="cart__fee">
			<div><?php echo esc_html( $fee->name ); ?></div>
			<div><?php wc_cart_totals_fee_html( $fee ); ?></div>
		</div>
	<?php endforeach; ?>

	<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart === 'excl' ) : ?>
		<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
				<div class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
					<div><?php echo esc_html( $tax->label ); ?></div>
					<div><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="tax-total">
				<div><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
				<div><?php wc_cart_totals_taxes_total_html(); ?></div>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

	<div class="cart__total">
		<div class="total__label"><?php _e( 'Total', 'woocommerce' ); ?></div>
		<div class="total__value"><?php wc_cart_totals_order_total_html(); ?></div>
	</div>

	<div class="cart__after-total">
		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	</div>

</div>