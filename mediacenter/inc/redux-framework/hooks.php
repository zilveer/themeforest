<?php

add_action( 'init', 											'mc_remove_redux_demo_mode' );
add_action( 'redux/page/media_center_theme_options/enqueue', 	'mc_set_redux_icon_font' );

/**
 * Header Options
 */
add_filter( 'mc_site_favicon_url', 					'rx_apply_site_favicon' );
add_filter( 'media_center_display_logo', 			'rx_apply_header_logo' );
add_filter( 'mc_get_header_style', 					'rx_apply_header_style' );
add_filter( 'mc_enable_search_dropdown_categories', 'rx_toggle_search_dropdown_categories' );
add_filter( 'mc_search_dropdown_categories_args', 	'rx_modify_search_dropdown_categories_args' );
add_filter( 'mc_is_sticky_header', 					'rx_toggle_sticky_header' );
add_filter( 'mc_is_scroll_to_top', 					'rx_toggle_scroll_to_top' );
add_filter( 'mc_is_enable_live_search', 			'rx_toggle_live_search' );
add_filter( 'mc_get_live_search_template', 			'rx_apply_live_search_template' );
add_filter( 'mc_is_enable_top_bar_switch', 			'rx_toggle_top_bar_switch' );
add_filter( 'mc_is_enable_top_bar_left_switch', 	'rx_toggle_top_bar_left_switch' );
add_filter( 'mc_is_enable_top_bar_right_switch', 	'rx_toggle_top_bar_right_switch' );
add_filter( 'mc_is_enable_top_bar_on_mobile', 		'rx_toggle_top_bar_on_mobile' );
add_filter( 'mc_is_top_bar_left_language_switcher', 'rx_toggle_top_bar_left_language_switcher' );
add_filter( 'mc_is_top_bar_right_language_switcher','rx_toggle_top_bar_right_language_switcher' );
add_filter( 'mc_is_top_bar_left_currency_switcher', 'rx_toggle_top_bar_left_currency_switcher' );
add_filter( 'mc_is_top_bar_right_currency_switcher','rx_toggle_top_bar_right_currency_switcher' );
add_filter( 'mc_language_switcher_position', 		'rx_toggle_language_switcher_position' );
add_filter( 'mc_currency_switcher_position', 		'rx_toggle_currency_switcher_position' );
add_filter( 'mc_header_support_phone', 				'rx_header_support_phone' );
add_filter( 'mc_header_support_email', 				'rx_header_support_email' );
add_filter( 'mc_is_breadcrumb_ignore_title', 		'rx_toggle_breadcrumb_ignore_title' );

/**
 * Navigation
 */
add_filter( 'mc_top-left_dropdown_trigger',			'rx_apply_dropdown_trigger',		10, 2 );
add_filter( 'mc_top-right_dropdown_trigger',		'rx_apply_dropdown_trigger',		10, 2 );
add_filter( 'mc_primary_dropdown_trigger',			'rx_apply_dropdown_trigger',		10, 2 );
add_filter( 'mc_departments_dropdown_trigger',		'rx_apply_dropdown_trigger',		10, 2 );

add_filter( 'mc_menu_dropdown_animation',			'rx_apply_dropdown_animation',		10, 2 );

/**
 * Footer Options
 */
add_filter( 'mc_display_footer_logo', 				'rx_apply_header_logo' );
add_filter( 'mc_footer_contact_info_text', 			'rx_footer_contact_info_text' );
add_filter( 'mc_footer_contact_info_address', 		'rx_footer_contact_info_address' );
add_filter( 'mc_footer_copyright_text', 			'rx_footer_copyright_text' );
add_filter( 'mc_credit_card_icons_gallery', 		'rx_credit_card_icons_gallery' );

/**
 * Shop Options
 */
add_filter( 'mc_is_catalog_mode_enabled',			'rx_change_catalog_mode' );
add_filter( 'mc_default_view_switcher_view',		'rx_change_default_view_switcher_view' );
add_filter( 'mc_localize_script_data',				'rx_add_remeber_user_view_to_localize_data' );
add_filter( 'mc_loop_shop_columns',					'rx_apply_product_loop_columns' );
add_filter( 'mc_loop_shop_per_page',				'rx_apply_products_per_page' );
add_filter( 'mc_enable_loop_product_animation',		'rx_toggle_product_animation' );
add_filter( 'mc_loop_product_animation',			'rx_apply_product_animation' );
add_filter( 'wp_get_attachment_image_attributes', 	'rx_apply_lazy_loading', 10, 2 );
add_filter( 'mc_show_rating_in_title',				'rx_toggle_rating_in_title' );
add_filter( 'mc_layout_args_products-archive-page',	'rx_apply_shop_page_layout' );
add_filter( 'mc_layout_args_single-product-page',	'rx_apply_single_product_layout' );
add_filter( 'mc_product_comparison_page_id',		'rx_apply_product_comparison_page_id' );

/**
 * Blog Options
 */
add_filter( 'mc_get_blog_layout',					'rx_apply_blog_layout' );
add_filter( 'mc_blog_fw_density',					'rx_apply_blog_fw_density' );
add_filter( 'mc_get_blog_style',					'rx_apply_blog_style' );
add_filter( 'mc_is_force_excerpt',					'rx_apply_force_excerpt' );
add_filter( 'excerpt_length',						'rx_apply_excerpt_length' );

/**
 * Styling
 */
add_filter( 'mc_main_theme_color',					'rx_apply_main_theme_color' );

/**
 * Typography
 */
add_filter( 'mc_load_default_fonts',				'rx_apply_default_fonts' );
add_action( 'wp_head',								'rx_apply_custom_fonts', 100 );

/**
 * Custom Code
 */
add_action( 'wp_head',								'rx_apply_animation_css', 100 );
add_action( 'wp_head',								'rx_apply_custom_css', 200 );
add_action( 'wp_head',								'rx_apply_custom_header_js', PHP_INT_MAX );
add_action( 'wp_footer',							'rx_apply_custom_footer_js', PHP_INT_MAX );

/**
 * Social Media Options
 */
add_filter( 'mc_set_social_networks',				'rx_set_social_networks_profile' );