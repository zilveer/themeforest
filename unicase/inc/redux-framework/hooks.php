<?php

add_action( 'init', 										'redux_remove_demo_mode' );
add_action( 'redux/page/unicase_options/enqueue', 			'redux_queue_font_awesome' );

/**
 * General Filters
 */
add_filter( 'unicase_enable_scrollup',						'redux_toggle_scrollup',					10 );
add_filter( 'unicase_enable_pace',							'redux_toggle_pace',						10 );

/**
 * Layout
 */
add_filter( 'unicase_layout_style',							'redux_apply_layout_style',					10 );

/**
 * Header Filters
 */
add_filter( 'unicase_site_logo',							'redux_apply_logo',							10 );
add_filter( 'unicase_header_style',							'redux_apply_header_style',					10 );

add_filter( 'unicase_enable_sticky_header',					'redux_toggle_sticky_header',				10 );
add_filter( 'unicase_enable_live_search',					'redux_apply_enable_live_search',			10 );
add_filter( 'unicase_live_search_template',					'redux_apply_live_search_template',			10 );
add_filter( 'unicase_live_search_empty_msg',				'redux_apply_live_search_empty_msg',		10 );
add_filter( 'unicase_enable_search_categories_filter',		'redux_apply_enable_search_categories',		10 );
add_filter( 'unicase_search_categories_filter_args',		'redux_apply_search_categories_args',		10 );
add_filter( 'unicase_header_contact_info',					'redux_apply_header_contact_info',			10 );
add_filter( 'unicase_top_cart_text',						'redux_apply_top_cart_text',				10 );
add_filter( 'unicase_top_cart_dropdown_trigger',			'redux_apply_top_cart_dropdown_trigger',	10 );
add_filter( 'unicase_top_cart_dropdown_animation',			'redux_apply_top_cart_dropdown_animation',	10 );

/**
 * Footer Filters
 */
add_filter( 'unicase_footer_classes', 						'redux_apply_footer_bg', 					10 );
add_filter( 'unicase_footer_contact_info',					'redux_apply_footer_contact_info',			10 );
add_filter( 'unicase_footer_copyright_text',				'redux_apply_copyright_text',				10 );
add_filter( 'unicase_footer_payment_logo',					'redux_apply_footer_logo',					10 );
add_filter( 'unicase_footer_social_icons_args',				'redux_apply_social_icons_url',				10 );

/**
 * Navigation Filters
 */
add_filter( 'unicase_primary_dropdown_style',						'redux_apply_dropdown_style',		10 );

add_filter( 'unicase_primary_dropdown_trigger',						'redux_apply_dropdown_trigger',		10, 2 );
add_filter( 'unicase_topbar-left_dropdown_trigger',					'redux_apply_dropdown_trigger',		10, 2 );
add_filter( 'unicase_topbar-right_dropdown_trigger',				'redux_apply_dropdown_trigger',		10, 2 );
add_filter( 'unicase_custom-menu-widget_dropdown_trigger',			'redux_apply_dropdown_trigger',		10, 2 );

add_filter( 'unicase_primary_dropdown_animation',					'redux_apply_dropdown_animation',	10, 2 );
add_filter( 'unicase_topbar-left_dropdown_animation',				'redux_apply_dropdown_animation',	10, 2 );
add_filter( 'unicase_topbar-right_dropdown_animation',				'redux_apply_dropdown_animation',	10, 2 );
add_filter( 'unicase_custom-menu-widget_dropdown_animation',		'redux_apply_dropdown_animation',	10, 2 );

add_filter( 'unicase_primary_show_dropdown_indicator',				'redux_toggle_dropdown_indicator',	10, 2 );
add_filter( 'unicase_topbar-left_show_dropdown_indicator',			'redux_toggle_dropdown_indicator',	10, 2 );
add_filter( 'unicase_custom-menu-widget_show_dropdown_indicator',	'redux_toggle_dropdown_indicator',	10, 2 );

/**
 * Shop Filters
 */
add_filter( 'unicase_is_catalog_mode_disabled',				'redux_is_catalog_mode_disabled',			10 );
add_filter( 'woocommerce_loop_add_to_cart_link',			'redux_apply_catalog_mode_for_product_loop',10, 2 );
add_filter( 'unicase_product_brand_taxonomy',				'redux_apply_product_brand_taxonomy',		10 );
add_filter( 'unicase_enable_footer_brands_carousel',		'redux_toggle_footer_brands_carousel',		10 );
add_filter( 'unicase_compare_page_url',						'redux_apply_compare_page_url',				10 );

/**
 * Shop Catalog Pages
 */
add_filter( 'unicase_shop_jumbotron_id',						'redux_apply_shop_jumbotron',				10 );
add_filter( 'unicase_page_layout_args_shop-page',				'redux_apply_shop_page_layout',				10 );
add_filter( 'unicase_page_layout_args_product-category-page',	'redux_apply_shop_page_layout',				10 );
add_filter( 'loop_shop_columns',								'redux_apply_loop_shop_columns',			PHP_INT_MAX );
add_filter( 'unicase_default_shop_view',						'redux_apply_shop_view',					10 );
add_filter( 'unicase_products_per_page',						'redux_apply_products_per_page',			10 );

/**
 * Product Item Filters
 */
add_filter( 'unicase_product_animation',						'redux_apply_product_animation',		10 );
add_filter( 'unicase_should_product_animation_delay',			'redux_apply_product_animation_delay',	10 );
add_filter( 'unicase_enable_echo',								'redux_toggle_echo',					10 );
add_filter( 'unicase_enable_shop_quick_view',					'redux_apply_enable_shop_quick_view',	10 );

/**
 * Single Product Filters
 */
add_filter( 'unicase_page_layout_args_woocommerce-single-product',	'redux_apply_shop_page_layout',			10 );
add_filter( 'unicase_single_product_style',							'redux_apply_product_single_style',		10 );
add_filter( 'unicase_show_single_product_share',					'redux_toggle_single_product_share',	10 );

/**
 * Blog Page Filters
 */
add_filter( 'unicase_page_layout_args_blog-page',			'redux_apply_blog_layout',					10 );
add_filter( 'unicase_page_layout_args_archive-page',		'redux_apply_blog_layout',					10 );
add_filter( 'unicase_page_layout_args_blog-single',			'redux_apply_blog_layout',					10 );

add_filter( 'unicase_force_excerpt',						'redux_toggle_force_excerpt',				10 );
add_filter( 'unicase_post_placeholder_img',					'redux_toggle_post_placeholder_img',		10 );
add_filter( 'unicase_additional_post_classes',				'redux_apply_post_item_animation',			10 );
add_filter( 'unicase_show_single_post_share',				'redux_toggle_single_post_share',			10 );

/**
 * Styling
 */
add_action( 'unicase_colors_url',							'redux_apply_primary_color', 				10 );
add_filter( 'unicase_google_fonts',							'redux_load_addtional_google_fonts',		10 );
add_filter( 'body_class',									'redux_apply_body_classes',					10 );

/**
 * Typography
 */
add_filter( 'unicase_load_default_fonts',					'redux_has_google_fonts',					10 );
add_action( 'wp_head',										'redux_apply_custom_fonts',					100 );

/**
 * Custom Code
 */
add_action( 'wp_head',										'redux_apply_custom_css', 					200 );
