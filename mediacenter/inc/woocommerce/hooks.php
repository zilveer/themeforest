<?php
/**
 * WooCommerce Hooks
 */

/**
 * Styles
 */
add_action( 'wp_head', 'media_center_product_label_style', 100 );

/** 
 * Dequeue Woocmmerce styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 *  After theme Setup
 */
add_action( 'after_switch_theme', 'mc_woocommerce_image_dimensions', 1 );

/**
 * Widgets
 */
add_filter( 'woocommerce_add_to_cart_fragments', 	'mc_add_to_cart_fragments' );

/**
 * Archive Product
 */
remove_action( 'woocommerce_before_shop_loop',		'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_before_shop_loop',		'woocommerce_catalog_ordering', 			30 );
remove_action( 'woocommerce_before_main_content', 	'woocommerce_output_content_wrapper', 		10 );
remove_action( 'woocommerce_before_main_content', 	'woocommerce_breadcrumb', 					20 );
remove_action( 'woocommerce_after_main_content', 	'woocommerce_output_content_wrapper_end', 	10 );
remove_action( 'woocommerce_sidebar', 				'woocommerce_get_sidebar', 					10 );
remove_action( 'woocommerce_after_shop_loop',		'woocommerce_pagination',					10 );


add_action( 'woocommerce_before_shop_loop',			'mc_control_bar',						10 );
add_action( 'woocommerce_before_shop_loop',			'mc_output_loop_wrapper',				30 );

add_action( 'woocommerce_after_shop_loop',			'mc_output_loop_wrapper_end',			10 );
add_action( 'woocommerce_after_shop_loop',			'mc_loop_list_view',					20 );
add_action( 'woocommerce_after_shop_loop',			'woocommerce_result_count',				30 );
add_action( 'woocommerce_after_shop_loop',			'woocommerce_pagination',				40 );

add_action( 'mc_control_bar',						'woocommerce_catalog_ordering', 		10 );
add_action( 'mc_control_bar',						'mc_shop_view_switcher',				20 );

add_action( 'woocommerce_before_main_content', 		'mc_output_content_wrapper', 			10 );
add_action( 'woocommerce_before_main_content', 		'mc_output_primary_wrapper', 			20 );

add_action( 'woocommerce_after_main_content', 		'mc_output_primary_wrapper_end', 		10 );

add_action( 'woocommerce_sidebar', 					'mc_output_secondary_wrapper', 			10 );
add_action( 'woocommerce_sidebar', 					'woocommerce_get_sidebar', 				20 );
add_action( 'woocommerce_sidebar', 					'mc_output_secondary_wrapper_end', 		PHP_INT_MAX );
add_action( 'woocommerce_sidebar', 					'mc_output_content_wrapper_end', 		PHP_INT_MAX );

/**
 * Product Loop
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 	'woocommerce_template_loop_rating', 			5 );
remove_action( 'woocommerce_after_shop_loop_item', 			'woocommerce_template_loop_add_to_cart', 		10 );
remove_action( 'woocommerce_shop_loop_item_title',			'woocommerce_template_loop_product_title', 		10 );
remove_action( 'woocommerce_before_shop_loop_item_title',	'woocommerce_template_loop_product_thumbnail', 	10 );
remove_action( 'woocommerce_before_subcategory_title',		'woocommerce_subcategory_thumbnail',			10 );

add_action( 'woocommerce_before_shop_loop_item',			'mc_output_loop_product_inner', 			5 );
add_action( 'woocommerce_after_shop_loop_item',				'mc_output_loop_product_inner_end', 		PHP_INT_MAX );

add_filter( 'loop_shop_columns', 							'mc_loop_shop_columns' );
add_action( 'woocommerce_shop_loop_item_title', 			'mc_shop_loop_item_title' );

add_action( 'woocommerce_before_shop_loop_item_title',		'mc_template_loop_product_labels',	20 );
add_action( 'woocommerce_before_shop_loop_item_title',		'mc_loop_product_thumbnail',		30 );

add_action( 'woocommerce_before_subcategory_title',			'mc_subcategory_thumbnail',	10 );

add_action( 'woocommerce_after_shop_loop_item', 			'mc_shop_loop_hover_area' );

add_action( 'mc_shop_loop_hover_area', 						'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'mc_shop_loop_hover_area', 						'mc_loop_action_buttons', 20 );

add_action( 'loop_shop_per_page',							'mc_loop_shop_per_page' );

add_action( 'post_class',	'mc_add_loop_product_animation_classes' );

add_filter( 'woocommerce_get_price_html', 'mc_wrap_price_html' );

add_filter( 'woocommerce_loop_add_to_cart_link', 'mc_loop_add_to_cart_link', 10, 2 );

/**
 * Product List View Loop
 */
add_action( 'mc_before_loop_list_view_body',	'woocommerce_show_product_loop_sale_flash',	10 );
add_action( 'mc_before_loop_list_view_body',	'mc_template_loop_product_labels',			20 );
add_action( 'mc_before_loop_list_view_body', 	'mc_loop_product_thumbnail_with_link',				30 );

add_action( 'mc_loop_list_view_body',			'woocommerce_template_loop_rating',			10 );
add_action( 'mc_loop_list_view_body',			'mc_shop_loop_item_title', 					20 );
add_action( 'mc_loop_list_view_body', 			'mc_loop_product_excerpt', 					30 );

add_action( 'mc_after_loop_list_view_body',		'mc_output_list_view_footer_start',			10 );
add_action( 'mc_after_loop_list_view_body',		'woocommerce_template_loop_price',			20 );
add_action( 'mc_after_loop_list_view_body',		'mc_loop_stock_availability',				30 );
add_action( 'mc_after_loop_list_view_body',		'woocommerce_template_loop_add_to_cart',	40 );
add_action( 'mc_after_loop_list_view_body',		'mc_loop_action_buttons', 					50 );
add_action( 'mc_after_loop_list_view_body',		'mc_output_list_view_footer_end',			60 );

/**
 * Single Product
 */
add_filter( 'woocommerce_sale_flash',						'mc_sale_flash' );

add_action( 'woocommerce_before_single_product_summary',	'mc_product_summary_wrapper_start',			1 );
add_action( 'woocommerce_after_single_product_summary',		'mc_product_summary_wrapper_end',			1 );

add_action( 'woocommerce_before_single_product_summary',	'mc_product_images_wrapper_start',			2 );
add_action( 'woocommerce_before_single_product_summary',	'mc_product_images_wrapper_end',			PHP_INT_MAX );

add_action( 'woocommerce_before_single_product_summary',	'mc_template_loop_product_labels',			15 );

remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_title', 		5 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_rating', 		10 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_price', 		10 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_excerpt', 		20 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_add_to_cart', 	30 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_meta', 		40 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_sharing', 		50 );

add_action( 'woocommerce_single_product_summary',			'woocommerce_template_single_rating',		5 );
add_action( 'woocommerce_single_product_summary',			'mc_template_single_title',					10 );
add_action( 'woocommerce_single_product_summary',			'mc_single_product_action_buttons',			20 );
add_action( 'woocommerce_single_product_summary',			'woocommerce_template_single_excerpt',		30 );
add_action( 'woocommerce_single_product_summary',			'woocommerce_template_single_price',		40 );
add_action( 'woocommerce_single_product_summary',			'mc_template_single_add_to_cart',			50 );
add_action( 'woocommerce_single_product_summary',			'woocommerce_template_single_meta', 		60 );
add_action( 'woocommerce_single_product_summary',			'woocommerce_template_single_sharing', 		70 );

/**
 * Cart Page
 */
add_action( 'woocommerce_before_cart',				'mc_display_cart_page_title' );
add_action( 'woocommerce_cart_actions',				'mc_proceed_to_checkout' );
add_action( 'woocommerce_after_cart_totals',		'woocommerce_shipping_calculator' );

/**
 * Checkout Page
 */
add_action( 'woocommerce_checkout_shipping',			'mc_checkout_shipping_fields_title',	1 );
add_filter( 'woocommerce_checkout_cart_item_quantity',	'mc_review_order_cart_item_quantity',	10, 3 );
add_filter( 'woocommerce_cart_item_name',				'mc_wrap_cart_item_name',				10, 3 );

/**
 * My Account Page
 */
add_action( 'woocommerce_login_form_start',					'mc_login_form_welcome_text' );
add_action( 'woocommerce_register_form_start',				'mc_registration_form_intro_text' );
add_action( 'woocommerce_register_form_end',				'mc_list_signup_benefits' );
add_action( 'woocommerce_edit_account_form_end', 			'mc_display_goto_my_account_link' );

add_action( 'woocommerce_before_customer_login_form',		'mc_wrap_login_form_start', 0 );
add_action( 'woocommerce_after_customer_login_form',		'mc_wrap_login_form_end',	PHP_INT_MAX );

add_action( 'woocommerce_account_navigation',				'mc_my_account_page_title', 9 );

/**
 * Structured Data
 *
 * @see mc_woocommerce_init_structured_data()
 */
add_action( 'woocommerce_before_shop_loop_item',			'mc_woocommerce_init_structured_data' );

/**
 * AJAX Hooks
 */
add_action( 'wp_ajax_refresh_cart_info', 			'mc_refresh_cart_info' );
add_action( 'wp_ajax_nopriv_cart_info', 			'mc_refresh_cart_info' );