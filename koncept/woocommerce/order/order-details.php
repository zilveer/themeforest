<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$order = wc_get_order( $order_id );

$show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();

?>
<div class="krown-column-row wooc clearfix" style="margin-top:50px">

	<div class="krown-column-container span6 clearfix" style="padding-right:40px">

		<h3><?php _e( 'Order Details', 'krown' ); ?></h3>

		<table class="shop_table order_details">
			<thead>
				<tr>
					<th class="product-name"><?php _e( 'Product', 'krown' ); ?></th>
					<th class="product-total"><?php _e( 'Total', 'krown' ); ?></th>
				</tr>
			</thead>

			<tfoot>
				<?php
					foreach ( $order->get_order_item_totals() as $key => $total ) {
						?>
						<tr>
							<th scope="row"><?php echo $total['label']; ?></th>
							<td><?php echo $total['value']; ?></td>
						</tr>
						<?php
					}
				?>
			</tfoot>

			<tbody>
				<?php
					foreach( $order->get_items() as $item_id => $item ) {
						
						$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );

						wc_get_template( 'order/order-details-item.php', array(
							'order'					=> $order,
							'item_id'				=> $item_id,
							'item'					=> $item,
							'show_purchase_note'	=> $show_purchase_note,
							'purchase_note'			=> $product ? get_post_meta( $product->id, '_purchase_note', true ) : '',
							'product'				=> $product,
						) );

					}
				?>
				<?php do_action( 'woocommerce_order_items_table', $order ); ?>
			</tbody>

		</table>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

	</div>

	<?php if ( $show_customer_details ) : ?>
		<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
	<?php endif; ?>