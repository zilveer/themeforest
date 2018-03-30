<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="page-padding">
	<div class="row">
		<div class="text-center"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="back_to_account"><?php _e("<small>Back to</small> My Account", 'north'); ?></a></div>
		<div class="small-12 columns">
	<form id="order_review" method="post">
		<div class="largetitle"><?php _e( 'Your Order', 'north' ); ?></div>
		<table class="shop_table order_table">
			<thead>
				<tr>
					<th class="product-name"><?php _e( 'Product', 'north' ); ?></th>
					<th class="product-quantity"><?php _e( 'Qty', 'north' ); ?></th>
					<th class="product-total text-right"><?php _e( 'Totals', 'north' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( sizeof( $order->get_items() ) > 0 ) : ?>
					<?php foreach ( $order->get_items() as $item ) : ?>
						<tr>
							<td class="product-name">
								<h6><?php echo esc_html( $item['name'] ); ?></h6>
								<?php $order->display_item_meta( $item ); ?>
							</td>
							<td class="product-quantity"><?php echo esc_html( $item['qty'] ); ?></td>
							<td class="product-subtotal text-right"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
			<tfoot>
			<?php if ( $totals = $order->get_order_item_totals() ) : ?>
				<?php foreach ( $totals as $total ) : ?>
					<tr>
						<th scope="row" colspan="2"><?php echo $total['label']; ?></th>
						<td class="product-total"><?php echo $total['value']; ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			
			</tfoot>
		</table>
	
		<div id="payment" class="cf">
			<?php if ( $order->needs_payment() ) : ?>
			<div class="largetitle"><?php _e( 'Payment', 'north' ); ?></div>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}
					} else {
						echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'north' ) ) . '</li>';
					}
				?>
			</ul>
			<?php endif; ?>
	
			<div class="form-row text-center">
				<input type="hidden" name="woocommerce_pay" value="1" />
				
				<?php wc_get_template( 'checkout/terms.php' ); ?>
	
				<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>
	
				<?php echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>
	
				<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>
	
				<?php wp_nonce_field( 'woocommerce-pay' ); ?>
			</div>
	
		</div>
	
	</form>
		</div>
	</div>
</div>