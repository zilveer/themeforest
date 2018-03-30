<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$my_orders_columns = apply_filters( 'woocommerce_my_account_my_orders_columns', array(
	'order-number'  => __( 'Order', 'woocommerce' ),
	'order-date'    => __( 'Date', 'woocommerce' ),
	'order-status'  => __( 'Status', 'woocommerce' ),
	'order-total'   => __( 'Total', 'woocommerce' ),
	'order-actions' => '&nbsp;',
) );

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => $order_count,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => array_keys( wc_get_order_statuses() )
) ) );

if ( $customer_orders ) : ?>

	<h2 class="recent-order-title"><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent Orders', 'wpdance' ) ); ?></h2>

	<table class="shop_table shop_table_responsive my_account_orders">

		<thead>
			<tr>
				<th class="order-number first"><span class="nobr"><?php _e( 'Order', 'wpdance' ); ?></span></th>
				<th class="order-date"><span class="nobr"><?php _e( 'Date', 'wpdance' ); ?></span></th>
				<th class="order-status"><span class="nobr"><?php _e( 'Status', 'wpdance' ); ?></span></th>
				<th class="order-total"><span class="nobr"><?php _e( 'Total', 'wpdance' ); ?></span></th>
				<th class="order-actions last">&nbsp;</th>
			</tr>
		</thead>

		<tbody><?php
			$number_customer_order = count($customer_orders);
			foreach ( $customer_orders as $key=>$customer_order ) {
				$order = wc_get_order( $customer_order );

				$order->populate( $customer_order );

				$item_count = $order->get_item_count();
				$class_tr = "";
				if($key == 0)
					$class_tr .= " first";
				if($key == ($number_customer_order-1))
					$class_tr .= " last";
			    
				?><tr class="order <?php echo $class_tr; ?>">
					<td class="order-number" data-title="<?php _e( 'Order Number', 'wpdance' ); ?>">
						<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
							<?php echo $order->get_order_number(); ?>
						</a>
					</td>
					<td class="order-date" data-title="<?php _e( 'Date', 'wpdance' ); ?>">
						<time datetime="<?php echo date('Y-m-d', strtotime( $order->order_date ) ); ?>" title="<?php echo esc_attr( strtotime( $order->order_date ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></time>
					</td>
					<td class="order-status" data-title="<?php _e( 'Status', 'wpdance' ); ?>" style="text-align:left; white-space:nowrap;">
						<?php echo wc_get_order_status_name( $order->get_status() ); ?>
					</td>
					<td class="order-total" data-title="<?php _e( 'Total', 'wpdance' ); ?>">
						<?php echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'wpdance' ), $order->get_formatted_order_total(), $item_count ); ?>
					</td>
					<td class="order-actions">
						<?php
							$actions = array();

							if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_payment', array( 'pending', 'failed' ), $order ) ) )
								$actions['pay'] = array(
									'url'  => $order->get_checkout_payment_url(),
									'name' => __( 'Pay', 'wpdance' )
								);

							if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) )
								$actions['cancel'] = array(
									'url'  => $order->get_cancel_order_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ),
									'name' => __( 'Cancel', 'wpdance' )
								);
								
							$actions['view'] = array(
								'url'  => $order->get_view_order_url(),
								'name' => __( 'View', 'wpdance' )
							);

							$actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );
							if ($actions) {
								foreach( $actions as $key => $action ) {
									echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
								}
							}
						?>
					</td>
				</tr><?php
			}
		?></tbody>
	</table>
<?php endif; ?>
