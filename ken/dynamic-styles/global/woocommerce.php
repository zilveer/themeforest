<?php
if (class_exists('woocommerce')) {

	global $mk_settings;

	$accent_color_90 = mk_convert_rgba($mk_settings['accent-color'], 0.9);

	Mk_Static_Files::addGlobalStyle("

		.woocommerce-page ul.products li.product .product_loop_button i,
		.woocommerce-page .entry-summary .star-rating,
		.woocommerce-page .quantity .plus,
		.woocommerce-page .quantity .minus,
		.product_meta a,
		.sku_wrapper span,
		.order-total,
		ul.cart_list .star-rating,
		ul.product_list_widget .star-rating,
		.mini-cart-remove,
		.product_loop_button i
		{
			color: {$mk_settings['accent-color']};
		}

		.mk-checkout-payement h3,
		.woocommerce-message .button:hover,
		.woocommerce-error .button:hover,
		.woocommerce-info .button:hover,
		.woocommerce.widget_shopping_cart .amount,
		.widget_product_categories .current-cat,
		.widget_product_categories li a:hover
		 {
			color: {$mk_settings['accent-color']} !important;
		}

		.button-icon-holder i,
		.mini-cart-button i,
		.single_add_to_cart_button i,
		.product_loop_button:hover,
		.woocommerce-page ul.products li.product .product_loop_button:hover,
		.widget_price_filter .ui-slider .ui-slider-range,
		.mini-cart-remove:hover,
		.mini-cart-button:hover,
		.widget_product_tag_cloud a:hover,
		.product-single-lightbox:hover,
		span.onsale
		{
			background-color: {$mk_settings['accent-color']} !important;
		}

		.product-loading-icon {
			background-color:{$accent_color_90};
		}

		.mk-cart-link {
			color:{$mk_settings['main-nav-top-color']['regular']};
		}
		.mk-cart-link:hover {
			color:{$mk_settings['main-nav-top-color']['hover']};
		}

		.mini-cart-remove,
		.mini-cart-button {
			border-color: {$mk_settings['accent-color']};
		}

	");

}