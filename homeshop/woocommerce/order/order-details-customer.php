<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Customer details', 'homeshop' ); ?></h4>
			</div>

			<div class="page-content">

			<table class="shop_table customer_details">
				<?php if ( $order->customer_note ) : ?>
					<tr>
						<th><?php _e( 'Note:', 'homeshop' ); ?></th>
						<td><?php echo wptexturize( $order->customer_note ); ?></td>
					</tr>
				<?php endif; ?>

				<?php if ( $order->billing_email ) : ?>
					<tr>
						<th><?php _e( 'Email:', 'homeshop' ); ?></th>
						<td><?php echo esc_html( $order->billing_email ); ?></td>
					</tr>
				<?php endif; ?>

				<?php if ( $order->billing_phone ) : ?>
					<tr>
						<th><?php _e( 'Telephone:', 'homeshop' ); ?></th>
						<td><?php echo esc_html( $order->billing_phone ); ?></td>
					</tr>
				<?php endif; ?>

				<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
			</table>


		</div>
			
	</div>
                          
</div>


 <div class="row">
                    	
	<div class="col-lg-6 col-md-6 col-sm-6">
		
		<div class="carousel-heading">
			<h4><?php _e( 'Billing Address', 'homeshop' ); ?></h4>
		</div>

		<div class="page-content">
			<address>
				<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'homeshop' ); ?>
			</address>
		</div>
	</div>
	
	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
	
	<div class="col-lg-6 col-md-6 col-sm-6">
                        	
		<div class="carousel-heading">
			<h4><?php _e( 'Shipping Address', 'homeshop' ); ?></h4>
		</div>
		
		<div class="page-content">
			<address>
				<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'homeshop' ); ?>
			</address>
		</div>
		
	</div>
	<?php endif; ?>
	
</div>
