<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/order/order-details.php
 * @sub-package WooCommerce/Templates/order/order-details.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php $order = new WC_Order( $order_id ); ?>

<h4><em class="icon-edit"></em> <?php _e('Order Details', 'woocommerce'); ?></h4>
<table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
			<th class="product-quantity"><?php _e('Qty', 'woocommerce'); ?></th>
			<th class="product-total"><?php _e('Totals', 'woocommerce'); ?></th>
		</tr>
	</thead>
	<tfoot>
	<?php
		if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
			?>
			<tr>
				<th scope="row" colspan="2"><?php echo $total['label']; ?></th>
				<td><?php echo $total['value']; ?></td>
			</tr>
			<?php
		endforeach;
	?>
	</tfoot>
	<tbody>
		<?php
		if (sizeof($order->get_items())>0) :

			foreach($order->get_items() as $item) :

				if (isset($item['variation_id']) && $item['variation_id'] > 0) :
					$_product = new WC_Product_Variation( $item['variation_id'] );
				else :
					$_product = new WC_Product( $item['id'] );
				endif;

				echo '
					<tr class = "' . esc_attr( apply_filters('woocommerce_order_table_item_class', 'order_table_item', $item, $order ) ) . '">
						<td class="product-name">';

				echo '<a href="'.get_permalink( $item['id'] ).'">' . $item['name'] . '</a>';

				$item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
				$item_meta->display();

				if ( $_product->exists() && $_product->is_downloadable() && $_product->has_file() && ( $order->status=='completed' || ( get_option( 'woocommerce_downloads_grant_access_after_payment' ) == 'yes' && $order->status == 'processing' ) ) ) :

					echo '<br/><small><a href="' . $order->get_downloadable_file_url( $item['id'], $item['variation_id'] ) . '">' . __('Download file &rarr;', 'woocommerce') . '</a></small>';

				endif;

				echo '</td><td class="product-quantity">'.$item['qty'].'</td><td class="product-total">' . $order->get_formatted_line_subtotal($item) . '</td></tr>';

				// Show any purchase notes
				if ($order->status=='completed' || $order->status=='processing') :
					if ($purchase_note = get_post_meta( $_product->id, '_purchase_note', true)) :
						echo '<tr class="product-purchase-note"><td colspan="3">' . apply_filters('the_content', $purchase_note) . '</td></tr>';
					endif;
				endif;

			endforeach;
		endif;

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
</table>

<?php if ( get_option('woocommerce_allow_customers_to_reorder') == 'yes' && $order->status=='completed' ) : ?>
	<p class="order-again submit-changes text-center">
		<a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button large"><em class="icon-cw"></em> <?php _e('Order Again', 'woocommerce'); ?></a>
	</p>
<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<header>
	<h4 class="sub-title"><em class="icon-user"></em> <?php _e('Customer details', 'woocommerce'); ?></h4>
</header>
<div class="row container">
	<div class="twelve columns">
		<dl class="customer_details">
		<?php
			if ($order->billing_email) echo '<dt>'.__('Email:', 'woocommerce').'</dt><dd>'.$order->billing_email.'</dd>';
			if ($order->billing_phone) echo '<dt>'.__('Telephone:', 'woocommerce').'</dt><dd>'.$order->billing_phone.'</dd>';
		?>
		</dl>
	</div>
</div>
<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

<div class="panel">
<div class="col2-set addresses">

	<div class="six columns">

<?php endif; ?>

		<header class="title">
			<h4 class="sub-title"><em class="icon-dollar"></em> <?php _e('Billing Address', 'woocommerce'); ?></h4>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_billing_address()) _e('N/A', 'woocommerce'); else echo $order->get_formatted_billing_address();
			?>
		</p></address>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

	</div><!-- /.col-1 -->

	<div class="six columns end clearfix">

		<header class="title">
			<h4 class="sub-title"><em class="icon-address"></em> <?php _e('Shipping Address', 'woocommerce'); ?></h4>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_shipping_address()) _e('N/A', 'woocommerce'); else echo $order->get_formatted_shipping_address();
			?>
		</p></address>
		<div class="clear"></div>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->
</div>

<?php endif; ?>

<div class="clear"></div>