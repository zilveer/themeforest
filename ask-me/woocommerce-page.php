<?php get_header();
	$woo_page_id = '';
	if (is_shop()) {
		$woo_page_id = get_option('woocommerce_shop_page_id');
	}elseif (is_cart()) {
		$woo_page_id = get_option('woocommerce_cart_page_id');
	}elseif (is_checkout()) {
		$woo_page_id = get_option('woocommerce_checkout_page_id');
	}elseif (is_account_page()) {
		$woo_page_id = get_option('woocommerce_myaccount_page_id');
	}else {
		$woo_page_id = get_option('woocommerce_shop_page_id');
	}
	woocommerce_content();
get_footer();?>