<?php

if (!function_exists('qode_startit_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function qode_startit_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (qode_startit_options()->getOptionValue('qodef_woo_products_per_page')) {
			$products_per_page = qode_startit_options()->getOptionValue('qodef_woo_products_per_page');
		}

		return $products_per_page;

	}

}

if (!function_exists('qode_startit_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function qode_startit_woocommerce_related_products_args($args) {

		if (qode_startit_options()->getOptionValue('qodef_woo_product_list_columns')) {

			$related = qode_startit_options()->getOptionValue('qodef_woo_product_list_columns');
			switch ($related) {
				case 'qodef-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'qodef-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;

	}

}

if (!function_exists('qode_startit_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function qode_startit_woocommerce_template_loop_product_title() {

		$tag = qode_startit_options()->getOptionValue('qodef_products_list_title_tag');
		the_title('<' . $tag . ' class="qodef-product-list-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('qode_startit_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function qode_startit_woocommerce_template_single_title() {

		$tag = qode_startit_options()->getOptionValue('qodef_single_product_title_tag');
		the_title('<' . $tag . '  itemprop="name" class="qodef-single-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('qode_startit_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function qode_startit_woocommerce_sale_flash() {

		return '<span class="qodef-onsale"><span class="qodef-onsale-inner">' . esc_html__('Sale!', 'startit') . '</span></span>';

	}

}

if (!function_exists('qode_startit_custom_override_checkout_fields')) {
	/**
	 * Overrides placeholder values for checkout fields
	 * @param array all checkout fields
	 * @return array checkout fields with overriden values
	 */
	function qode_startit_custom_override_checkout_fields($fields) {
		//billing fields
		$args_billing = array(
			'first_name'	=> esc_html__('First name','startit'),
			'last_name'		=> esc_html__('Last name','startit'),
			'company'		=> esc_html__('Company name','startit'),
			'address_1'		=> esc_html__('Address','startit'),
			'email'			=> esc_html__('Email','startit'),
			'phone'			=> esc_html__('Phone','startit'),
			'postcode'		=> esc_html__('Postcode / ZIP','startit'),
			'state'			=> esc_html__('State / County', 'startit')
		);

		//shipping fields
		$args_shipping = array(
			'first_name' => esc_html__('First name','startit'),
			'last_name'  => esc_html__('Last name','startit'),
			'company'    => esc_html__('Company name','startit'),
			'address_1'  => esc_html__('Address','startit'),
			'postcode'   => esc_html__('Postcode / ZIP','startit')
		);

		//override billing placeholder values
		foreach ($args_billing as $key => $value) {
			$fields["billing"]["billing_{$key}"]["placeholder"] = $value;
		}

		//override shipping placeholder values
		foreach ($args_shipping as $key => $value) {
			$fields["shipping"]["shipping_{$key}"]["placeholder"] = $value;
		}

		return $fields;
	}

}

if (!function_exists('qode_startit_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from qodef_button
	 *
	 * @return mixed|string
	 */
	function qode_startit_woocommerce_loop_add_to_cart_link() {

		global $product;

		$classes = '';
		$classes .= $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ' : ' ';
		$classes .= $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart ' : ' ';

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s',
			$classes,
			esc_attr( $product->product_type )
		);
		$button_text = $product->add_to_cart_text();
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->id ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);


		$add_to_cart_button = qode_startit_get_button_html(
			array(
				'link'			=> $button_url,
				'custom_class'	=> $button_classes,
				'text'			=> $button_text,
				'custom_attrs'	=> $button_attrs
			)
		);

		return $add_to_cart_button;

	}

}

if (!function_exists('qode_startit_get_woocommerce_out_of_stock')) {
	/**
	 * Function that prints html with out of stock text if product is out of stock
	 */
	function qode_startit_get_woocommerce_out_of_stock(){

		global $product;

		if (!$product->is_in_stock()) {
			print '<span class="qodef-out-of-stock-button"><span class="qodef-out-of-stock-button-inner">' . esc_html__("Out of stock", "startit") . '</span></span>';
		}


	}
}

if (!function_exists('qode_startit_get_woocommerce_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on simple and grouped product single template
	 * Uses HTML from qodef_button
	 */
	function qode_startit_get_woocommerce_add_to_cart_button() {

		global $product;

		$add_to_cart_button = qode_startit_get_button_html(
			array(
				'custom_class'	=> 'single_add_to_cart_button alt',
				'text'			=> $product->single_add_to_cart_text(),
				'html_type'		=> 'button',
				'type'			=> 'default',
				'size'			=> 'small'
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('qode_startit_get_woocommerce_add_to_cart_button_external')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from qodef_button
	 */
	function qode_startit_get_woocommerce_add_to_cart_button_external() {

		global $product;

		$add_to_cart_button = qode_startit_get_button_html(
			array(
				'link'			=> $product->add_to_cart_url(),
				'custom_class'	=> 'single_add_to_cart_button alt',
				'text'			=> $product->single_add_to_cart_text(),
				'custom_attrs'	=> array(
					'rel' 		=> 'nofollow'
				)
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('qode_startit_get_woocommerce_product_link_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from qodef_button
	 */
	function qode_startit_get_woocommerce_product_link_button() {

		global $product;

		$product_link_button = qode_startit_get_button_html(
			array(
				'link'			=> $product->get_permalink(),
				'custom_class'	=> 'single_view_product_button alt',
				'text'			=> 	esc_html__("Details", "startit"),
				'custom_attrs'	=> array(
					'rel' 		=> 'nofollow'
				)
			)
		);

		print $product_link_button;

	}

}

if ( ! function_exists('qode_startit_woocommerce_single_variation_add_to_cart_button') ) {
	/**
	 * Function that overrides default woocommerce add to cart button on variable product single template
	 * Uses HTML from qodef_button
	 */
	function qode_startit_woocommerce_single_variation_add_to_cart_button() {
		global $product;

		$html = '<div class="variations_button">';
		woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );

		$button = qode_startit_get_button_html(array(
			'html_type'		=> 'button',
			'custom_class'	=> 'single_add_to_cart_button alt',
			'text'			=> $product->single_add_to_cart_text()
		));

		$html .= $button;

		$html .= '<input type="hidden" name="add-to-cart" value="' . absint( $product->id ) . '" />';
		$html .= '<input type="hidden" name="product_id" value="' . absint( $product->id ) . '" />';
		$html .= '<input type="hidden" name="variation_id" class="variation_id" value="" />';
		$html .= '</div>';

		print $html;

	}

}

if (!function_exists('qode_startit_get_woocommerce_apply_coupon_button')) {
	/**
	 * Function that overrides default woocommerce apply coupon button
	 * Uses HTML from qodef_button
	 */
	function qode_startit_get_woocommerce_apply_coupon_button() {

		$coupon_button = qode_startit_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'apply_coupon',
			'text'			=> esc_html__( 'Apply Coupon', 'startit' )
		));

		print $coupon_button;

	}

}

if (!function_exists('qode_startit_get_woocommerce_update_cart_button')) {
	/**
	 * Function that overrides default woocommerce update cart button
	 * Uses HTML from qodef_button
	 */
	function qode_startit_get_woocommerce_update_cart_button() {

		$update_cart_button = qode_startit_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'update_cart',
			'text'			=> esc_html__( 'Update Cart', 'startit' )
		));

		print $update_cart_button;

	}

}

if (!function_exists('qode_startit_woocommerce_button_proceed_to_checkout')) {
	/**
	 * Function that overrides default woocommerce proceed to checkout button
	 * Uses HTML from qodef_button
	 */
	function qode_startit_woocommerce_button_proceed_to_checkout() {

		$proceed_to_checkout_button = qode_startit_get_button_html(array(
			'link'			=> WC()->cart->get_checkout_url(),
			'custom_class'	=> 'checkout-button alt wc-forward',
			'text'			=> esc_html__( 'Proceed to Checkout', 'startit' )
		));

		print $proceed_to_checkout_button;

	}

}

if (!function_exists('qode_startit_get_woocommerce_update_totals_button')) {
	/**
	 * Function that overrides default woocommerce update totals button
	 * Uses HTML from qodef_button
	 */
	function qode_startit_get_woocommerce_update_totals_button() {

		$update_totals_button = qode_startit_get_button_html(array(
			'html_type'		=> 'button',
			'text'			=> esc_html__( 'Update Totals', 'startit' ),
			'custom_attrs'	=> array(
				'value'		=> 1,
				'name'		=> 'calc_shipping'
			)
		));

		print $update_totals_button;

	}

}

if (!function_exists('qode_startit_woocommerce_pay_order_button_html')) {
	/**
	 * Function that overrides default woocommerce pay order button on checkout page
	 * Uses HTML from qodef_button
	 */
	function qode_startit_woocommerce_pay_order_button_html() {

		$pay_order_button_text = esc_html__('Pay for order', 'startit');

		$place_order_button = qode_startit_get_button_html(array(
			'html_type'		=> 'input',
			'custom_class'	=> 'alt',
			'custom_attrs'	=> array(
				'id'			=> 'place_order',
				'data-value'	=> $pay_order_button_text
			),
			'text'			=> $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if (!function_exists('qode_startit_woocommerce_order_button_html')) {
	/**
	 * Function that overrides default woocommerce place order button on checkout page
	 * Uses HTML from qodef_button
	 */
	function qode_startit_woocommerce_order_button_html() {

		$pay_order_button_text = esc_html__('Place Order', 'startit');

		$place_order_button = qode_startit_get_button_html(array(
			'html_type'		=> 'input',
			'custom_class'	=> 'alt',
			'custom_attrs'	=> array(
				'id'			=> 'place_order',
				'data-value'	=> $pay_order_button_text,
				'name'			=> 'woocommerce_checkout_place_order'
			),
			'text'			=> $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if (!function_exists('qode_startit_woocommerce_loop_pagination')) {
	/**
	 * Function that overrides default woocommerce pagination in loop
	 *
	 */
	function qode_startit_woocommerce_loop_pagination() {
		$args = array();

		$args['prev_text'] = '<i class="fa fa-chevron-left"></i>';
		$args['next_text'] = '<i class="fa fa-chevron-right"></i>';
		$args['type'] = 'list';

		return $args;
	}
}
