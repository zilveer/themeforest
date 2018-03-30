<?php
/**
 * unicase WooCommerce hooks
 *
 * @package unicase
 */

/**
 * Styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_action( 'wp_head', 'unicase_product_label_style', 100 );

/**
 * Layout
 * @see  unicase_before_content()
 * @see  unicase_after_content()
 * @see  woocommerce_breadcrumb()
 */
remove_action( 'woocommerce_before_main_content', 	'woocommerce_breadcrumb', 					20, 0 );
remove_action( 'woocommerce_before_main_content', 	'woocommerce_output_content_wrapper', 		10 );
remove_action( 'woocommerce_after_main_content', 	'woocommerce_output_content_wrapper_end', 	10 );
remove_action( 'woocommerce_sidebar', 				'woocommerce_get_sidebar', 					10 );
remove_action( 'woocommerce_after_shop_loop', 		'woocommerce_pagination', 					10 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 			30 );

add_action( 'woocommerce_before_main_content', 		'unicase_before_wc_content', 				10 );
add_action( 'woocommerce_after_main_content', 		'unicase_after_wc_content', 				10 );

add_action( 'unicase_shop_sidebar',					'unicase_shop_sidebar',						10 );

/**
 * Products
 */
add_filter( 'woocommerce_sale_flash',				'unicase_product_sale_flash',				10 );

add_action( 'woocommerce_before_shop_loop',			'unicase_loop_page_jumbotron',				1 );
add_action( 'woocommerce_before_shop_loop',			'unicase_sorting_top_wrapper',				9 );
add_action( 'woocommerce_before_shop_loop', 		'unicase_shop_tab_pane', 					11 );
add_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 			15 );
add_action( 'woocommerce_before_shop_loop', 		'unicase_wc_pagination', 					30 );
add_action( 'woocommerce_before_shop_loop',			'unicase_sorting_wrapper_close',			31 );

add_action( 'woocommerce_before_shop_loop',			'unicase_loop_view_wrap_start',				PHP_INT_MAX );
add_action( 'woocommerce_after_shop_loop',			'unicase_loop_view_wrap_end',				1 );

add_action( 'woocommerce_after_shop_loop',			'unicase_sorting_wrapper',					9 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_pagination', 					29 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_result_count', 				30 );
add_action( 'woocommerce_after_shop_loop',			'unicase_sorting_wrapper_close',			31 );

remove_action( 'woocommerce_before_shop_loop_item', 	'woocommerce_template_loop_product_link_open', 		10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_template_loop_product_thumbnail',	10 );

add_action( 'woocommerce_before_shop_loop_item_title',	'unicase_product_image_action_wrapper',			1 );
add_action( 'woocommerce_before_shop_loop_item_title',	'unicase_product_labels',						11 );
add_action( 'woocommerce_before_shop_loop_item_title',	'unicase_quick_view_link',						15 );
add_action( 'woocommerce_before_shop_loop_item_title', 	'unicase_template_loop_product_thumbnail',		20 );
add_action( 'woocommerce_before_shop_loop_item_title',	'unicase_product_image_action_wrapper_close',	30 );

add_action( 'woocommerce_shop_loop_item_title',			'woocommerce_template_loop_product_link_open',		5 );

add_action( 'woocommerce_before_shop_loop_item',	'unicase_add_animation_to_product_start',	0 );
add_action( 'woocommerce_after_shop_loop_item',		'unicase_product_action_buttons',			20 );
add_action( 'woocommerce_after_shop_loop_item',		'unicase_add_animation_to_product_end',		PHP_INT_MAX );

// List View
add_action( 'woocommerce_list_after_shop_loop_item',	'woocommerce_template_loop_product_link_close',	5 );
add_action( 'woocommerce_list_after_shop_loop_item',	'woocommerce_template_single_excerpt',			7 );
add_action( 'woocommerce_list_after_shop_loop_item',	'woocommerce_template_loop_add_to_cart',		10 );
add_action( 'woocommerce_list_after_shop_loop_item',	'unicase_product_action_buttons',				20 );
add_action( 'woocommerce_list_after_shop_loop_item',	'unicase_add_animation_to_product_end',			PHP_INT_MAX );

/**
 * Single Product
 */
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_add_to_cart', 30 );

add_action( 'woocommerce_single_product_summary',           'woocommerce_template_single_excerpt', 10 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

add_action( 'woocommerce_before_single_product_summary',	'unicase_wrap_product_images', 				10 );
add_action( 'woocommerce_before_single_product_summary',	'unicase_wrap_product_detail', 				PHP_INT_MAX );

add_action( 'woocommerce_single_product_summary',           'unicase_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary',			'unicase_single_product_add_to_cart', 30 );
add_action( 'woocommerce_share',							'unicase_single_product_share_icons', 10 );
add_action( 'woocommerce_after_single_product_summary',		'unicase_wrap_product_item_row',	0);

/**
 * Filters
 * @see  unicase_woocommerce_body_class()
 * @see  unicase_cart_link_fragment()
 * @see  unicase_thumbnail_columns()
 * @see  unicase_products_per_page()
 * @see  unicase_loop_columns()
 */
add_filter( 'body_class', 									'unicase_woocommerce_body_class' );
add_filter( 'woocommerce_product_thumbnails_columns', 		'unicase_thumbnail_columns' );
add_filter( 'loop_shop_per_page', 							'unicase_products_per_page' );
add_filter( 'loop_shop_columns', 							'unicase_loop_columns' );
add_filter( 'woocommerce_product_get_rating_html',			'unicase_wrap_star_rating' );
add_filter( 'woocommerce_breadcrumb_defaults',				'unicase_breadcrumb_defaults' );
add_filter( 'woocommerce_add_to_cart_fragments',			'unicase_cart_link_fragment' );
add_filter( 'woocommerce_show_page_title',					'unicase_show_wc_page_title' );
add_filter( 'woocommerce_get_price_html_from_to',			'unicase_product_get_price_html_from_to', 10, 4 );
add_filter( 'woocommerce_variation_sale_price_html',		'unicase_product_variation_sale_price_html', 10, 2 );
add_filter( 'unicase_before_footer',						'unicase_footer_brands_carousel' );
add_action( 'unicase_after_footer',							'unicase_quick_view_wrapper',	50 );

// Ajax Product Quick View Actions
add_action( 'wp_ajax_nopriv_product_quick_view',			'unicase_product_quick_view' );
add_action( 'wp_ajax_product_quick_view',					'unicase_product_quick_view' );

/**
 * Checkout
 * @see unicase_customer_wrapper_start()
 * @see unicase_customer_wrapper_end()
 * @see unicase_review_wrapper_start()
 * @see unicase_review_wrapper_end()
 * @see unicase_payment_wrapper_start()
 * @see woocommerce_checkout_payment()
 * @see unicase_payment_wrapper_end()
 */

add_filter( 'woocommerce_checkout_login_message',					'unicase_checkout_login_message',				10 );
add_filter( 'woocommerce_checkout_coupon_message',					'unicase_checkout_coupon_message',				10 );

add_action( 'woocommerce_checkout_billing', 		    			'unicase_customer_billing_wrapper_start', 		5 );
add_action( 'woocommerce_checkout_billing', 						'unicase_customer_billing_wrapper_end', 		15 );

add_action( 'woocommerce_checkout_shipping', 						'unicase_customer_shipping_wrapper_start', 		5 );
add_action( 'woocommerce_checkout_shipping', 						'unicase_customer_shipping_wrapper_end', 		15 );

add_action( 'woocommerce_checkout_order_review', 					'unicase_review_wrapper_start', 				5 );
add_action( 'woocommerce_checkout_order_review', 					'unicase_review_wrapper_end', 					15 );

add_action( 'woocommerce_checkout_order_review', 					'unicase_payment_wrapper_start', 				16 );
add_action( 'woocommerce_checkout_order_review', 					'unicase_payment_wrapper_end', 					25 );

/**
 * Cart
 */
remove_action( 'woocommerce_cart_collaterals',						'woocommerce_cross_sell_display' );

add_action( 'woocommerce_before_shipping_calculator',				'unicase_cart_shipping_calculator_wrapper_start', 0 );
add_action( 'woocommerce_after_shipping_calculator',				'unicase_cart_shipping_calculator_wrapper_end', 0 );

add_action( 'woocommerce_cart_collaterals',							'unicase_cart_coupon_display',		20 );
add_action( 'woocommerce_cart_collaterals',							'woocommerce_shipping_calculator',	30 );
add_action( 'woocommerce_after_cart', 								'woocommerce_cross_sell_display',	10 );

add_filter( 'woocommerce_cross_sells_columns',						'unicase_cross_sells_products_args', 10 );
add_filter( 'woocommerce_cross_sells_total',						'unicase_cross_sells_products_args', 10 );

add_filter( 'woocommerce_stock_html',								'unicase_stock_html');
add_filter( 'woocommerce_add_to_cart_fragments',					'unicase_mini_cart_add_to_cart_fragment' );

/**
 * Product Taxonomies
 */
add_action( 'after_setup_theme', 'taxonomy_form_fields_actions' );

/**
 * Products Live Search
 */
add_action( 'wp_ajax_nopriv_products_live_search',					'unicase_products_live_search' );
add_action( 'wp_ajax_products_live_search',							'unicase_products_live_search' );
