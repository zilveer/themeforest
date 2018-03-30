<?php

if (!function_exists('suprema_qodef_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function suprema_qodef_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (suprema_qodef_options()->getOptionValue('qodef_woo_products_per_page')) {
			$products_per_page = suprema_qodef_options()->getOptionValue('qodef_woo_products_per_page');
		}

		return $products_per_page;

	}

}

if (!function_exists('suprema_qodef_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function suprema_qodef_woocommerce_related_products_args($args) {

		if (suprema_qodef_options()->getOptionValue('qodef_woo_product_list_columns')) {

			$related = suprema_qodef_options()->getOptionValue('qodef_woo_product_list_columns');
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

if (!function_exists('suprema_qodef_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function suprema_qodef_woocommerce_template_loop_product_title() {

		$tag = suprema_qodef_options()->getOptionValue('qodef_products_list_title_tag');
		the_title('<' . $tag . ' class="qodef-product-list-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('suprema_qodef_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function suprema_qodef_woocommerce_template_single_title() {

		$tag = suprema_qodef_options()->getOptionValue('qodef_single_product_title_tag');
		the_title('<' . $tag . '  itemprop="name" class="qodef-single-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('suprema_qodef_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function suprema_qodef_woocommerce_sale_flash() {

		return '<span class="qodef-onsale"><span class="qodef-onsale-inner">' . esc_html__('Sale!', 'suprema') . '</span></span>';

	}

}

if (!function_exists('suprema_qodef_custom_override_checkout_fields')) {
	/**
	 * Overrides placeholder values for checkout fields
	 * @param array all checkout fields
	 * @return array checkout fields with overriden values
	 */
	function suprema_qodef_custom_override_checkout_fields($fields) {
		//billing fields
		$args_billing = array(
			'first_name'	=> esc_html__('First name','suprema'),
			'last_name'		=> esc_html__('Last name','suprema'),
			'company'		=> esc_html__('Company name','suprema')
		);

		//shipping fields
		$args_shipping = array(
			'first_name' => esc_html__('First name','suprema'),
			'last_name'  => esc_html__('Last name','suprema'),
			'company'    => esc_html__('Company name','suprema'),
			'address_1'  => esc_html__('Address','suprema'),
			'postcode'   => esc_html__('Postcode / ZIP','suprema')
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

if (!function_exists('suprema_qodef_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from qodef_button
	 *
	 * @return mixed|string
	 */
	function suprema_qodef_woocommerce_loop_add_to_cart_link() {

		global $product;

		$classes = '';
		$classes .= $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ' : 'out_of_stock_button ';
		$classes .= $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart ' : ' ';

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s',
			$classes,
			esc_attr( $product->product_type )
		);
		$button_text = $product->add_to_cart_text();
		if($product->is_type( 'variable' )) {
			$button_text = esc_html__( 'Options', 'suprema' );
		}
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->id ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);

		if($product->is_type( 'variable' )) {
			$icon_params = array(
				'icon_pack'		=> 'linear_icons',
				'linear_icon'	=> 'lnr-list'
			);
		}
		else if (!$product->is_in_stock()) {
			$icon_params = array(
				'icon_pack'		=> 'linear_icons',
				'linear_icon'	=> 'lnr-cross'
			);
		}
		else {
			$icon_params = array(
				'icon_pack'	=> 'linear_icons',
				'linear_icon'	=> 'lnr-cart'
			);
		}
		$button_params = array(
			'link'			=> $button_url,
			'custom_class'	=> $button_classes,
			'text'			=> $button_text,
			'custom_attrs'	=> $button_attrs
		);

		$add_to_cart_button = suprema_qodef_get_button_html(
			array_merge($button_params, $icon_params)
		);

		return $add_to_cart_button;

	}

}

if (!function_exists('suprema_qodef_get_woocommerce_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on simple and grouped product single template
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_get_woocommerce_add_to_cart_button() {

		global $product;

		$add_to_cart_button = suprema_qodef_get_button_html(
			array(
				'custom_class'	=> 'single_add_to_cart_button alt',
				'text'			=> $product->single_add_to_cart_text(),
				'html_type'		=> 'button',
				'icon_pack' => 'linear_icons',
				'linear_icon' => 'lnr-cart'
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('suprema_qodef_get_woocommerce_add_to_cart_button_external')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_get_woocommerce_add_to_cart_button_external() {

		global $product;

		$add_to_cart_button = suprema_qodef_get_button_html(
			array(
				'link'			=> $product->add_to_cart_url(),
				'custom_class'	=> 'single_add_to_cart_button alt',
				'text'			=> $product->single_add_to_cart_text(),
				'custom_attrs'	=> array(
					'rel' 		=> 'nofollow'
				),
				'target'		=> '_blank',
				'icon_pack' => 'linear_icons',
				'linear_icon' => 'lnr-cart'
			)
		);

		print $add_to_cart_button;

	}

}

if ( ! function_exists('suprema_qodef_woocommerce_single_variation_add_to_cart_button') ) {
	/**
	 * Function that overrides default woocommerce add to cart button on variable product single template
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_woocommerce_single_variation_add_to_cart_button() {
		global $product;

		$html = '<div class="variations_button">';
		woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );

		$button = suprema_qodef_get_button_html(array(
			'html_type'		=> 'button',
			'custom_class'	=> 'single_add_to_cart_button alt',
			'text'			=> $product->single_add_to_cart_text(),
			'icon_pack' => 'linear_icons',
			'linear_icon' => 'lnr-cart'
		));

		$html .= $button;

		$html .= '<input type="hidden" name="add-to-cart" value="' . absint( $product->id ) . '" />';
		$html .= '<input type="hidden" name="product_id" value="' . absint( $product->id ) . '" />';
		$html .= '<input type="hidden" name="variation_id" class="variation_id" value="" />';
		$html .= '</div>';

		print $html;

	}

}

if (!function_exists('suprema_qodef_get_woocommerce_apply_coupon_button')) {
	/**
	 * Function that overrides default woocommerce apply coupon button
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_get_woocommerce_apply_coupon_button() {

		$coupon_button = suprema_qodef_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'apply_coupon',
			'text'			=> esc_html__( 'Apply Coupon', 'suprema' )
		));

		print $coupon_button;

	}

}

if (!function_exists('suprema_qodef_get_woocommerce_update_cart_button')) {
	/**
	 * Function that overrides default woocommerce update cart button
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_get_woocommerce_update_cart_button() {

		$update_cart_button = suprema_qodef_get_button_html(array(
			'html_type'		=> 'input',
			'input_name'	=> 'update_cart',
			'text'			=> esc_html__( 'Update Cart', 'suprema' )
		));

		print $update_cart_button;

	}

}

if (!function_exists('suprema_qodef_woocommerce_button_proceed_to_checkout')) {
	/**
	 * Function that overrides default woocommerce proceed to checkout button
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_woocommerce_button_proceed_to_checkout() {

		$proceed_to_checkout_button = suprema_qodef_get_button_html(array(
			'link'			=> WC()->cart->get_checkout_url(),
			'custom_class'	=> 'checkout-button alt wc-forward',
			'text'			=> esc_html__( 'Proceed to Checkout', 'suprema' )
		));

		print $proceed_to_checkout_button;

	}

}

if (!function_exists('suprema_qodef_get_woocommerce_update_totals_button')) {
	/**
	 * Function that overrides default woocommerce update totals button
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_get_woocommerce_update_totals_button() {

		$update_totals_button = suprema_qodef_get_button_html(array(
			'html_type'		=> 'button',
			'text'			=> esc_html__( 'Update Totals', 'suprema' ),
			'custom_attrs'	=> array(
				'value'		=> 1,
				'name'		=> 'calc_shipping'
			)
		));

		print $update_totals_button;

	}

}

if (!function_exists('suprema_qodef_woocommerce_pay_order_button_html')) {
	/**
	 * Function that overrides default woocommerce pay order button on checkout page
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_woocommerce_pay_order_button_html() {

		$pay_order_button_text = esc_html__('Pay for order', 'suprema');

		$place_order_button = suprema_qodef_get_button_html(array(
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

if (!function_exists('suprema_qodef_woocommerce_order_button_html')) {
	/**
	 * Function that overrides default woocommerce place order button on checkout page
	 * Uses HTML from qodef_button
	 */
	function suprema_qodef_woocommerce_order_button_html() {

		$pay_order_button_text = esc_html__('Place Order', 'suprema');

		$place_order_button = suprema_qodef_get_button_html(array(
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

if (!function_exists('suprema_qodef_get_woocommerce_out_of_stock')) {
	/**
	 * Function that prints html with out of stock text if product is out of stock
	 */
	function suprema_qodef_get_woocommerce_out_of_stock(){

		global $product;

		if (!$product->is_in_stock()) {
			print '<span class="qodef-out-of-stock-button"><span class="qodef-out-of-stock-button-inner">' . esc_html__("Out of stock!", "suprema") . '</span></span>';
		}


	}
}

if (!function_exists('suprema_qodef_woocommerce_shop_loop_categories')) {
	/**
	 * Function that prints html with product categories
	 */
	function suprema_qodef_woocommerce_shop_loop_categories(){

		global $product;

		$html = '<div class="qodef-product-list-categories">';
		$html .= $product->get_categories(', ');
		$html .= '</div>';

		print $html;
	}
}

if (!function_exists('suprema_qodef_woocommerce_shop_loop_hover_image')) {
	/**
	 * Function that prints html with out of stock text if product is out of stock
	 */
	function suprema_qodef_woocommerce_shop_loop_hover_image(){

		global $product;

		$product_gallery_ids = $product->get_gallery_attachment_ids();
		if (!empty($product_gallery_ids)) {
			//get product image url, shop catalog size
			$product_hover_image = wp_get_attachment_image( $product_gallery_ids[0], 'shop_catalog' );
		}

		print $product_hover_image;
	}
}

if (!function_exists('suprema_qodef_woocommerce_loop_pagination')) {
	/**
	 * Function that overrides default woocommerce pagination in loop
	 *
	 */
	function suprema_qodef_woocommerce_loop_pagination() {
		$args = array();

		$args['prev_text'] = '<span class="arrow_left"></span>';
		$args['next_text'] = '<span class="arrow_right"></span>';
		$args['type'] = 'list';

		return $args;
	}
}

if (!function_exists('suprema_qodef_woocommerce_shop_loop_load_style_based_hooks')) {
	/**
	 * Function that loads template hooks based on product list style
	 */
	function suprema_qodef_woocommerce_shop_loop_load_style_based_hooks(){

		$tag = suprema_qodef_options()->getOptionValue('qodef_products_list_style');
		$display_categories = suprema_qodef_options()->getOptionValue('qodef_products_list_display_categories');
		switch($tag) {
			case 'standard':
				//Add Product Categories On Product List
				if($display_categories == 'yes') {
					add_action('suprema_qodef_woocommerce_shop_loop_item_categories', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
				}

				//Remove default close link wrapped arround image because of hover image
				remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);
				remove_action('woocommerce_before_shop_loop_item_title', 'suprema_qodef_get_woocommerce_out_of_stock', 5);
				remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

				add_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
				add_action('woocommerce_before_shop_loop_item', 'suprema_qodef_get_woocommerce_out_of_stock', 5);


				//Add product hover image
				add_action('suprema_qodef_woocommerce_shop_loop_item_hover_image', 'suprema_qodef_woocommerce_shop_loop_hover_image', 10);

				//Close link wrapped around images
				add_action('suprema_qodef_woocommerce_shop_loop_item_hover_link_close', 'woocommerce_template_loop_product_link_close', 15);

				//Override Product List Button Position
				remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
				add_action('suprema_qodef_woocommerce_shop_loop_product_simple_button', 'woocommerce_template_loop_add_to_cart', 5);

				//Add wishlist button
				if(suprema_qodef_is_wishlist_installed()) {
					add_action('woocommerce_after_shop_loop_item_title', 'suprema_qodef_woocommrece_template_loop_wishlist', 15);
				}
				break;

			case 'simple':
				//Add Product Link Overlay
				add_action('woocommerce_link_overlay','woocommerce_template_loop_product_link_open',5);
				add_action('woocommerce_link_overlay','woocommerce_template_loop_product_link_close',10);
				//Add Product Categories On Product List
				if($display_categories == 'yes') {
					add_action('woocommerce_after_shop_loop_item_title', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
				}
				break;

			case 'boxed':
				//Add Product Link Overlay
				add_action('woocommerce_link_overlay','woocommerce_template_loop_product_link_open',5);
				add_action('woocommerce_link_overlay','woocommerce_template_loop_product_link_close',10);
				//Add Product Categories On Product List
				if($display_categories == 'yes') {
					add_action('woocommerce_shop_loop_item_title', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
				}
				remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);

				//Override title position
				add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10);
				remove_action('woocommerce_shop_loop_item_title', 'suprema_qodef_woocommerce_template_loop_product_title', 10);
				add_action('woocommerce_shop_loop_item_title', 'suprema_qodef_woocommerce_template_loop_product_title', 15);

				//Remove Add to cart button
				remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
				break;

			default:
				//Add Product Categories On Product List
				add_action('suprema_qodef_woocommerce_shop_loop_item_categories', 'suprema_qodef_woocommerce_shop_loop_categories', 5);

				//Override Product List Button Position
				remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
				add_action('suprema_qodef_woocommerce_shop_loop_product_simple_button', 'woocommerce_template_loop_add_to_cart', 5);
		}
	}

	add_action('suprema_qodef_after_options_map', 'suprema_qodef_woocommerce_shop_loop_load_style_based_hooks');
}