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
<table class="shop_table woocommerce-checkout-review-order-table">
	<thead></thead>
	<tfoot>

		<tr class="cart-subtotal">
            <td class="empty-cell"></td>
			<th><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
            <td>&nbsp;</td>
			<td class="number-value"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
                <td class="empty-cell"></td>
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td>&nbsp;</td>
				<td class="number-value"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php
        if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :
            global $a13_from_review_order;
            $a13_from_review_order = true;

			do_action( 'woocommerce_review_order_before_shipping' );

			wc_cart_totals_shipping_html();

			do_action( 'woocommerce_review_order_after_shipping' );

        endif;
        ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
                <td class="empty-cell"></td>
				<th><?php echo esc_html( $fee->name ); ?></th>
                <td>&nbsp;</td>
				<td class="number-value"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->tax_display_cart === 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                        <td class="empty-cell"></td>
						<th><?php echo esc_html( $tax->label ); ?></th>
                        <td>&nbsp;</td>
						<td class="number-value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
                    <td class="empty-cell"></td>
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                    <td>&nbsp;</td>
					<td class="number-value"><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
            <td class="empty-cell"></td>
			<th><?php _e( 'Order Total', 'woocommerce' ); ?></th>
            <td>&nbsp;</td>
			<td class="number-value"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>