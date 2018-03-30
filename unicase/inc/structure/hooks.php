<?php
/**
 * unicase hooks
 *
 * @package unicase
 */

/**
 * General
 * @see  unicase_setup()
 * @see  unicase_widgets_init()
 * @see  unicase_scripts()
 * @see  unicase_header_widget_region()
 * @see  unicase_get_sidebar()
 */
add_action( 'after_setup_theme',			'unicase_setup',						10 );
add_action( 'after_setup_theme', 			'unicase_template_debug_mode', 			20 );
add_action( 'widgets_init',					'unicase_widgets_init',					10 );
add_action( 'wp_enqueue_scripts',			'unicase_scripts',						10 );
add_action( 'tgmpa_register', 				'unicase_register_required_plugins',	10 );
add_action( 'admin_init', 					'unicase_add_editor_styles',			10 );
add_action( 'after_setup_theme',			'unicase_add_retina_filters',			10 );
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	add_action( 'wp_head',					'unicase_site_favicon',					10 );
}

/**
 * Layout
 */
add_filter( 'unicase_site_content_classes',		'unicase_apply_site_content_classes' );
add_filter( 'unicase_container_classes',		'unicase_apply_container_classes' );
add_filter( 'unicase_content_area_classes',		'unicase_apply_content_area_classes' );
add_filter( 'unicase_sidebar_area_classes',		'unicase_apply_sidebar_area_classes' );
add_filter( 'unicase_site_main_classes',		'unicase_apply_site_main_classes' );
add_filter( 'unicase_show_page_header',			'unicase_toggle_page_header' );
add_filter( 'unicase_show_breadcrumb',			'unicase_toggle_breadcrumb' );
add_action( 'unicase_sidebar',					'unicase_get_sidebar',		10 );

add_action( 'unicase_before_content',			'unicase_hook_jumbotron',			5 );
add_action( 'unicase_before_content', 			'unicase_breadcrumb', 				10 );

/**
 * Header
 * @see  unicase_skip_links()
 * @see  unicase_top_bar()
 * @see  unicase_main_header()
 * @see  unicase_primary_navigation()
 */
add_action( 'unicase_header', 					'unicase_skip_links', 					0 );
add_action( 'unicase_header',					'unicase_top_bar',						10 );
add_action( 'unicase_header',					'unicase_main_header',					20 );
add_action( 'unicase_header',					'unicase_primary_navigation',			30 );

add_action( 'unicase_main_header_content', 		'unicase_site_branding',				10 );
add_action( 'unicase_main_header_content', 		'unicase_top_search_holder',			20 );
add_action( 'unicase_main_header_content', 		'unicase_header_cart',					30 );

/**
 * Footer
 * @see  unicase_footer_content_top()
 * @see  unicase_footer_content_middle()
 * @see  unicase_footer_content_bottom()
 */
add_action( 'unicase_footer', 'unicase_footer_content_top',				10 );
add_action( 'unicase_footer', 'unicase_footer_content_middle',			20 );
add_action( 'unicase_footer', 'unicase_footer_content_bottom',			30 );

/**
 * Homepage
 * @see  unicase_homepage_content()
 * @see  unicase_product_categories()
 * @see  unicase_recent_products()
 * @see  unicase_featured_products()
 * @see  unicase_popular_products()
 * @see  unicase_on_sale_products()
 */
add_action( 'homepage', 'unicase_homepage_content',		10 );
add_action( 'homepage', 'unicase_product_categories',	20 );
add_action( 'homepage', 'unicase_recent_products',		30 );
add_action( 'homepage', 'unicase_featured_products',	40 );
add_action( 'homepage', 'unicase_popular_products',		50 );
add_action( 'homepage', 'unicase_on_sale_products',		60 );

/**
 * Posts
 * @see  unicase_post_header()
 * @see  unicase_post_meta()
 * @see  unicase_post_content()
 * @see  unicase_paging_nav()
 * @see  unicase_single_post_header()
 * @see  unicase_post_nav()
 * @see  unicase_display_comments()
 */

add_action( 'unicase_loop_post',			'unicase_post_media_attachment', 	10 );
add_action( 'unicase_loop_post',			'unicase_post_header',				20 );
add_action( 'unicase_loop_post',			'unicase_post_loop_description',	30 );

add_action( 'unicase_loop_after',			'unicase_paging_nav',		10 );


add_action( 'unicase_single_post',			'unicase_post_media_attachment',	10 );
add_action( 'unicase_single_post',			'unicase_post_header',				20 );
add_action( 'unicase_single_post',			'unicase_post_content',			30 );
add_action( 'unicase_single_post',			'unicase_post_meta',				40 );
add_action( 'unicase_single_post',			'unicase_single_post_social_icons',	50 );
add_action( 'unicase_single_post',			'unicase_author_info',	60 );
add_action( 'unicase_single_post_after',	'unicase_post_nav',				10 );
add_action( 'unicase_single_post_after',	'unicase_display_comments',		10 );

/**
 * Pages
 * @see  unicase_page_header()
 * @see  unicase_page_content()
 * @see  unicase_display_comments()
 */
add_action( 'unicase_page', 			'unicase_page_header',		10 );
add_action( 'unicase_page', 			'unicase_page_content',		20 );
add_action( 'unicase_page_after', 		'unicase_display_comments',	10 );

/**
 * Extras
 * @see  unicase_setup_author()
 * @see  unicase_body_classes()
 * @see  unicase_page_menu_args()
 */
add_filter( 'body_class',						'unicase_body_classes' );
add_filter( 'wp_page_menu_args',				'unicase_page_menu_args' );
add_filter( 'excerpt_more',						'unicase_excerpt_more');
add_filter( 'unicase_nav_menu_link_attributes',	'unicase_add_data_hover_attribute',		10, 4 );
add_filter( 'unicase_nav_menu_start_lvl',		'unicase_animate_dropdown_menu',		10, 3 );