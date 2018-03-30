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
 * @package 	proStore/woocommerce/checkout/form-pay.php
 * @sub-package WooCommerce/Templates/checkout/form-pay.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>
<form id="order_review" method="post">

	<table class="shop_table">
		<thead>
			<tr>
				<th><?php _e('Product', 'woocommerce'); ?></th>
				<th><?php _e('Qty', 'woocommerce'); ?></th>
				<th><?php _e('Totals', 'woocommerce'); ?></th>
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
				foreach ($order->get_items() as $item) :
					echo '
						<tr>
							<td>'.$item['name'].'</td>
							<td>'.$item['qty'].'</td>
							<td>' . $order->get_formatted_line_subtotal($item) . '</td>
						</tr>';
				endforeach;
			endif;
			?>
		</tbody>
	</table>

	<div id="payment">
		<?php if ($order->order_total > 0) : ?>
		<div class="payment_methods methods">
			<?php
				$available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
				if ($available_gateways) :
					// Chosen Method
					if (sizeof($available_gateways)) :
						$default_gateway = get_option('woocommerce_default_gateway');
						if (isset($_SESSION['_chosen_payment_method']) && isset($available_gateways[$_SESSION['_chosen_payment_method']])) :
							$available_gateways[$_SESSION['_chosen_payment_method']]->set_current();
						elseif (isset($available_gateways[$default_gateway])) :
							$available_gateways[$default_gateway]->set_current();
						else :
							current($available_gateways)->set_current();
						endif;
					endif;
					$i = count($available_gateways);
					$k = 1;
					foreach ($available_gateways as $gateway ) :
						/* Add  style="background:none !important" below if necessary */
						?>
						<div class="method <?php if ($i==$k) { echo"last";} elseif($k==1) {echo"first";} ?>">
							<input type="radio" id="payment_method_<?php echo $gateway->id; ?>" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php if ($gateway->chosen) echo 'checked="checked"'; ?> />
							<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?></label>
						</div>
						<?php
						$k++;
					endforeach;
					echo '<div class="clear"></div>';
					foreach ($available_gateways as $gateway ) :
						if ( $gateway->has_fields() || $gateway->get_description() ) :
							echo '<div class="payment_box payment_method_'.$gateway->id.'" style="display:none;">';
							$gateway->payment_fields();
							echo '</div>';
						endif;
					endforeach;
				else :

					echo '<p>'.__('Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce').'</p>';

				endif;
			?>
			<div class="form-row place-order clearfix"><?php $woocommerce->nonce_field('pay')?><input type="submit" class="button alt large" id="place_order" value="<?php _e('Pay for order', 'woocommerce'); ?>" /><input type="hidden" name="woocommerce_pay" value="1" /></div></div><?php endif; ?><div class="clear"></div></div>

</form>