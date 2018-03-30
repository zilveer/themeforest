<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php # start: modified by Arlind Nushi ?>
<div class="row customer-details-env">
	<div class="col-sm-4">
<?php # end: modified by Arlind Nushi ?>

		<header><h2><?php _e( 'Customer Details', 'aurum' ); ?></h2></header>
		
		<table class="shop_table shop_table_responsive customer_details">
			<?php if ( $order->customer_note ) : ?>
				<tr>
					<th><?php _e( 'Note:', 'aurum' ); ?></th>
					<td><?php echo wptexturize( $order->customer_note ); ?></td>
				</tr>
			<?php endif; ?>
		
			<?php if ( $order->billing_email ) : ?>
				<tr>
					<th><?php _e( 'Email:', 'aurum' ); ?></th>
					<td><?php echo esc_html( $order->billing_email ); ?></td>
				</tr>
			<?php endif; ?>
		
			<?php if ( $order->billing_phone ) : ?>
				<tr>
					<th><?php _e( 'Telephone:', 'aurum' ); ?></th>
					<td><?php echo esc_html( $order->billing_phone ); ?></td>
				</tr>
			<?php endif; ?>
		
			<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
		</table>
		
	</div>
	
	<?php # start: modified by Arlind Nushi ?>
	<div class="col-sm-4">
	<?php # end: modified by Arlind Nushi ?>
	
		<header class="title">
			<h3><?php _e( 'Billing Address', 'aurum' ); ?></h3>
		</header>
		<address>
			<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'aurum' ); ?>
		</address>
	
	<?php # start: modified by Arlind Nushi ?>
	</div>
	<?php # end: modified by Arlind Nushi ?>
	
	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
	
	<div class="col-sm-4"><?php # This line has been modified by Arlind Nushi ?>
		<header class="title">
			<h3><?php _e( 'Shipping Address', 'aurum' ); ?></h3>
		</header>
		<address>
			<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'aurum' ); ?>
		</address>
	</div><?php # This line has been modified by Arlind Nushi ?>
	
	<?php endif; ?>
</div>