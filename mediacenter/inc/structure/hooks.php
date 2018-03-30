<?php

add_action( 'body_class', 'mc_apply_body_class' );

if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	add_action( 'wp_head',						'media_center_site_favicon',			10 );
}

/**
 * Page Hooks and Actions
 */

add_filter( 'mc_should_hide_page_title', 'mc_should_hide_page_header' );
add_filter( 'mc_nav_menu_link_attributes', 'media_center_add_data_hover_attribute',		10, 4 );

add_action( 'mc_page',	'mc_display_page_header', 	10 );
add_action( 'mc_page',	'mc_page_content', 			20 );
add_action( 'mc_page',	'mc_init_structured_data', 	30 );