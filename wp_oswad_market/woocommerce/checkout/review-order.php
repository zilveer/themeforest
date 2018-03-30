<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<table class="shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
			<th colspan="2" class="product-thumbnail product-name first"><?php _e( 'Items', 'wpdance' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'wpdance' ); ?></th>
			<th class="product-total last"><?php _e( 'Total', 'wpdance' ); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr class="cart-subtotal">
			<th colspan="3"><?php _e( 'Subtotal', 'wpdance' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="discount cart-discount coupon-<?php echo esc_attr( $code ); ?>">
				<th colspan="3"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action('woocommerce_review_order_before_shipping'); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action('woocommerce_review_order_after_shipping'); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>

			<tr class="fee fee-<?php echo $fee->id ?>">
				<th colspan="3"><?php echo esc_html( $fee->name ); ?></th>
				<td><?php
					wc_cart_totals_fee_html( $fee );
				?></td>
			</tr>

		<?php endforeach; ?>

		<?php
			// Show the tax row if showing prices exlcusive of tax only
			if ( WC()->cart->tax_display_cart == 'excl' ) {
				if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ){
					foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
						echo '<tr class="tax-rate tax-rate-' . $code . '">
							<th colspan="3">' . esc_html( $tax->label ) . '</th>
							<td>' . wp_kses_post( $tax->formatted_amount ) . '</td>
						</tr>';
					}
				}
				else{
					echo '<tr class="tax-total">
						<th colspan="3">'. esc_html( WC()->countries->tax_or_vat() ) .'</th>
						<td>'. wc_price( WC()->cart->get_taxes_total() ). '</td>
					</tr>';
				}
			}
		?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="total order-total">
			<th colspan="3"><?php _e( 'Order Total', 'wpdance' ); ?></th>
			<td>
				<?php wc_cart_totals_order_total_html(); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
	<tbody>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			if (sizeof(WC()->cart->get_cart())>0) :
				$number_item = count(WC()->cart->get_cart());
				$showed_item = 0;
				foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$showed_item++;
					if($number_item>1){
						$class_row = ($showed_item==1)?" first":(($showed_item==$number_item)?" last":"");
					}
					else{
						$class_row = " first last";
					}
					$class_row .= " checkout_table_item";
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						echo '
							<tr class="' . esc_attr( apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . $class_row . '">
								<td class="product-thumbnail">' .
									'<a href="'.get_permalink( $cart_item['product_id'] ).'">'
										.$_product->get_image().
									'</a>'.
									
								'</td>
								<td class="product-title">
									<span class="wd_product_title">'.apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) .
									'<span class="wd_product_number">'.apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity"> &times; ' . $cart_item['quantity'] . '</strong>', $cart_item, $cart_item_key ) .'</span></span>'.WC()->cart->get_item_data( $cart_item );
						echo ((strlen($_product->post->post_excerpt)>0)?'<p class="wd_product_excerpt">'.string_limit_words(wp_strip_all_tags($_product->post->post_excerpt),6).'...</p>':' ');
						echo
								'</td>
								<td class="product-price">'.$product_price.'</td>
								<td class="product-total">' . apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) . '</td>
							</tr>';
					endif;
				endforeach;
			endif;
			
			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
</table>
<script type="text/javascript">
	jQuery("#order_review table.shop_table tbody tr:first").addClass("first");
	jQuery("#order_review table.shop_table tbody tr:last").addClass("last");
</script>
