<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( !$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'crazyblog' ) );
	return;
}
?>
<div class="account-billing-sec">
	<div class="row">
		<form id="crazyblog_woo_checkout_form" name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="col-md-8 column">
					<div class="billing-sec">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
					</div>
				</div>

			<?php endif; ?>

			<div class="col-md-4 column">
				<div class="my-order-list">
					<div class="heading7">
						<h3><?php esc_html_e( 'ORDER LIST', 'crazyblog' ) ?></h3>
					</div>
					<ul>
						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								?>
								<li>
									<div class="product-list-box">
										<i><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', sprintf( '%s&times;', $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></i>
										<div class="product-list-thumb">
											<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
										</div>
										<div class="product-list-info">
											<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
										</div>
									</div>
								</li>
								<?php
							}
						}
						?>
					</ul>
					<div class="total-order-box">
						<table>
							<tr>
								<td><strong><?php esc_html_e( 'Subtotal', 'crazyblog' ); ?></strong></td>
								<td><span><?php wc_cart_totals_subtotal_html(); ?></span></td>
							</tr>
							<tr>
								<td><strong><?php esc_html_e( 'Your Shipment', 'crazyblog' ) ?></strong></td>
								<td>
									<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
										<p>
											<?php wc_cart_totals_coupon_label( $coupon ); ?>
											<br />
											<?php echo crazyblog_coupon_html( $coupon ); ?>
										</p>
										<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
											<p>
												<?php wc_cart_totals_shipping_html(); ?>
											</p>
										<?php endif; ?>
										<p>
											<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
												<strong><?php echo esc_html( $fee->name ); ?></strong>
												<br />
												<?php wc_cart_totals_fee_html( $fee ); ?>
											<?php endforeach; ?>
										</p>
										<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
											<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
												<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
													<p>
														<strong><?php echo esc_html( $tax->label ); ?></strong>
														<br />
														<?php echo wp_kses_post( $tax->formatted_amount ); ?>
													</p>
												<?php endforeach; ?>
											<?php else : ?>
												<p>
													<strong><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></strong>
													<br />
													<?php wc_cart_totals_taxes_total_html(); ?>
												</p>
											<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</td>
							</tr>
							<tr>
								<td><strong><?php esc_html_e( 'Odder Total', 'crazyblog' ); ?></strong></td>
								<td><?php crazyblgo_cart_totals_order_total_html(); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-12">

				<div class="payment-options">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
			</div>
		</form>
	</div>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php
    $custom_script = 'jQuery(document).ready(function ($) {
        $("form#crazyblog_woo_checkout_form p > *").unwrap();
        $("form#crazyblog_woo_checkout_form label").each(function () {
            $(this).children("abbr").remove();
        });
        $("select").select2();

    });';
    wp_add_inline_script('crazyblog_select2', $custom_script);

function crazyblog_coupon_html( $coupon ) {
	if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
	}

	$value = array();

	if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->code, WC()->cart->display_cart_ex_tax ) ) {
		$discount_html = '-' . wc_price( $amount );
	} else {
		$discount_html = '';
	}

	$value[] = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_html, $coupon );

	if ( $coupon->enable_free_shipping() ) {
		$value[] = esc_html__( 'Free shipping coupon', 'crazyblog' );
	}

	unset( $value[0] );
	// get rid of empty array elements
	$value = array_filter( $value );
	$value = implode( ', ', $value ) . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', urlencode( $coupon->code ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url()  ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->code ) . '"><i class="fa fa-remove"></i></a>';
	return $value;
}

function crazyblgo_cart_totals_order_total_html() {
	$value = WC()->cart->get_total();

	// If prices are tax inclusive, show taxes here
	if ( wc_tax_enabled() && WC()->cart->tax_display_cart == 'incl' ) {
		$tax_string_array = array();

		if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) {
			foreach ( WC()->cart->get_tax_totals() as $code => $tax )
				$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
		} else {
			$tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
		}

		if ( !empty( $tax_string_array ) ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text = WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping() ? sprintf( ' ' . esc_html__( 'estimated for %s', 'crazyblog' ), WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[$taxable_address[0]] ) : '';
			$value .= '<small class="includes_tax">' . sprintf( esc_html__( '(includes %s)', 'crazyblog' ), implode( ', ', $tax_string_array ) . $estimated_text ) . '</small>';
		}
	}

	echo apply_filters( 'woocommerce_cart_totals_order_total_html', $value );
}
