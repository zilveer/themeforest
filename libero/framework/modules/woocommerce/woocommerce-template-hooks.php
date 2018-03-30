<?php

if (!function_exists('libero_mikado_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function libero_mikado_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (libero_mikado_options()->getOptionValue('mkd_woo_products_per_page')) {
			$products_per_page = libero_mikado_options()->getOptionValue('mkd_woo_products_per_page');
		}

		return $products_per_page;

	}

}

if (!function_exists('libero_mikado_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function libero_mikado_woocommerce_related_products_args($args) {

		if (libero_mikado_options()->getOptionValue('mkd_woo_product_list_columns')) {

			$related = libero_mikado_options()->getOptionValue('mkd_woo_product_list_columns');
			switch ($related) {
				case 'mkd-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'mkd-woocommerce-columns-3':
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

if (!function_exists('libero_mikado_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function libero_mikado_woocommerce_template_loop_product_title() {
		if(libero_mikado_options()->getOptionValue('mkd_products_list_title_tag')){
			$tag = libero_mikado_options()->getOptionValue('mkd_products_list_title_tag');
		}
		else{
			$tag = 'h4';
		}
		the_title('<' . $tag . ' class="mkd-product-list-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('libero_mikado_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function libero_mikado_woocommerce_template_single_title() {

		the_title('<h1  itemprop="name" class="mkd-single-product-title">', '</h1>');

	}

}

if (!function_exists('libero_mikado_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function libero_mikado_woocommerce_sale_flash() {
		global $product;
		$html = '';

		if ($product->is_on_sale()){
			$html = '<span class="mkd-onsale"><span class="mkd-onsale-inner">' . esc_html__('Sale!', 'libero') . '</span></span>';
		}
		elseif (!$product->is_in_stock()){
			$html = '<span class="mkd-out-of-stock"><span class="mkd-out-of-stock-inner">' . esc_html__('Out of stock', 'libero') . '</span></span>';
		}
		return $html;
	}

}

if (!function_exists('libero_mikado_custom_override_checkout_fields')) {
	/**
	 * Overrides placeholder values for checkout fields
	 * @param array all checkout fields
	 * @return array checkout fields with overriden values
	 */
	function libero_mikado_custom_override_checkout_fields($fields) {
		//billing fields
		$args_billing = array(
			'first_name'	=> esc_html__('First name','libero'),
			'last_name'		=> esc_html__('Last name','libero'),
			'company'		=> esc_html__('Company name','libero'),
			'address_1'		=> esc_html__('Address','libero'),
			'email'			=> esc_html__('Email','libero'),
			'phone'			=> esc_html__('Phone','libero'),
			'postcode'		=> esc_html__('Postcode / ZIP','libero'),
			'state'			=> esc_html__('State / County', 'libero'),
		);

		//shipping fields
		$args_shipping = array(
			'first_name' => esc_html__('First name','libero'),
			'last_name'  => esc_html__('Last name','libero'),
			'company'    => esc_html__('Company name','libero'),
			'address_1'  => esc_html__('Address','libero'),
			'postcode'   => esc_html__('Postcode / ZIP','libero')
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

if (!function_exists('libero_mikado_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from mkd_button
	 *
	 * @return mixed|string
	 */
	function libero_mikado_woocommerce_loop_add_to_cart_link() {

		global $product;

        $classes = '';
		$classes .= $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ' : 'mkd-read-more';
		$classes .= $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart ' : ' ';
		
		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s',
			$classes,
			esc_attr( $product->product_type )
		);
		$button_text = $product->add_to_cart_text();
		if (!$product->is_in_stock()){
			$button_text = 'View Product';
		}
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->id ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);
		$icon_class = 'icon-handbag';
		$icon_pack = 'simple_line_icons';
		if (!$product->is_in_stock()){
			$icon_class = 'arrow_carrot-right';
			$icon_pack = 'font_elegant';
		}


		$add_to_cart_button = libero_mikado_get_button_html(
			array(
				'link'			=> $button_url,
				'custom_class'	=> $button_classes,
				'text'			=> $button_text,
				'custom_attrs'	=> $button_attrs,
				'size'			=> 'small',
				'icon_pack'		=> $icon_pack,
				'simple_line_icons'	=> $icon_class,
				'fe_icon'	=> $icon_class,
			)
		);

		return $add_to_cart_button;

	}

}

if (!function_exists('libero_mikado_get_woocommerce_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on simple and grouped product single template
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_get_woocommerce_add_to_cart_button() {

		global $product;

		$add_to_cart_button = libero_mikado_get_button_html(
			array(
				'custom_class'	=> 'single_add_to_cart_button alt',
				'text'			=> $product->single_add_to_cart_text(),
				'html_type'		=> 'button',
				'size'			=> 'medium',
				'icon_pack'		=> 'font_elegant',
				'fe_icon'	=> 'arrow_carrot-right',
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('libero_mikado_get_woocommerce_add_to_cart_button_external')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_get_woocommerce_add_to_cart_button_external() {

		global $product;

		$add_to_cart_button = libero_mikado_get_button_html(
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

if ( ! function_exists('libero_mikado_woocommerce_single_variation_add_to_cart_button') ) {
	/**
	 * Function that overrides default woocommerce add to cart button on variable product single template
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_woocommerce_single_variation_add_to_cart_button() {
		global $product;

		$html = '<div class="variations_button">';
		woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );

		$button = libero_mikado_get_button_html(array(
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

if (!function_exists('libero_mikado_get_woocommerce_apply_coupon_button')) {
	/**
	 * Function that overrides default woocommerce apply coupon button
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_get_woocommerce_apply_coupon_button() {

		$coupon_button = libero_mikado_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'apply_coupon',
			'text'			=> esc_html__( 'Apply Coupon', 'libero' )
		));

		print $coupon_button;

	}

}

if (!function_exists('libero_mikado_get_woocommerce_update_cart_button')) {
	/**
	 * Function that overrides default woocommerce update cart button
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_get_woocommerce_update_cart_button() {

		$update_cart_button = libero_mikado_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'update_cart',
			'text'			=> esc_html__( 'Update Cart', 'libero' )
		));

		print $update_cart_button;

	}

}

if (!function_exists('libero_mikado_woocommerce_button_proceed_to_checkout')) {
	/**
	 * Function that overrides default woocommerce proceed to checkout button
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_woocommerce_button_proceed_to_checkout() {

		$proceed_to_checkout_button = libero_mikado_get_button_html(array(
			'link'			=> WC()->cart->get_checkout_url(),
			'custom_class'	=> 'checkout-button alt wc-forward',
			'text'			=> esc_html__( 'Proceed to Checkout', 'libero' ),
			'size'			=> 'large',
			'icon_pack'		=> 'simple_line_icons',
			'simple_line_icons'	=> 'icon-arrow-right-circle',
		));

		print $proceed_to_checkout_button;

	}

}

if (!function_exists('libero_mikado_get_woocommerce_update_totals_button')) {
	/**
	 * Function that overrides default woocommerce update totals button
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_get_woocommerce_update_totals_button() {

		$update_totals_button = libero_mikado_get_button_html(array(
			'html_type'		=> 'button',
			'custom_class'	=> 'mkd-update-totals',
			'text'			=> esc_html__( 'Update Totals', 'libero' ),
			'custom_attrs'	=> array(
				'value'		=> 1,
				'name'		=> 'calc_shipping'
			),
			'size'			=> 'large',
			'icon_pack'		=> 'simple_line_icons',
			'simple_line_icons'	=> 'icon-plus',
		));

		print $update_totals_button;

	}

}

if (!function_exists('libero_mikado_woocommerce_pay_order_button_html')) {
	/**
	 * Function that overrides default woocommerce pay order button on checkout page
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_woocommerce_pay_order_button_html() {

		$pay_order_button_text = esc_html__('Pay for order', 'libero');

		$place_order_button = libero_mikado_get_button_html(array(
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

if (!function_exists('libero_mikado_woocommerce_order_button_html')) {
	/**
	 * Function that overrides default woocommerce place order button on checkout page
	 * Uses HTML from mkd_button
	 */
	function libero_mikado_woocommerce_order_button_html() {

		$pay_order_button_text = esc_html__('Place Order', 'libero');

		$place_order_button = libero_mikado_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'woocommerce_checkout_place_order',
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

if (!function_exists('libero_mikado_woocommerce_share_like_html')){

	function libero_mikado_woocommerce_share_like_html(){
		libero_mikado_get_module_template_part('parts/shareprint', 'woocommerce','');
	}

	add_action('woocommerce_after_single_product_summary','libero_mikado_woocommerce_share_like_html',17);
}