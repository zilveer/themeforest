<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Reset customizer panels since things were modified
delete_option( 'wpex_customizer_panels' );

// Reset CSS and typography cache
remove_theme_mod( 'wpex_customizer_css_cache' );
remove_theme_mod( 'wpex_customizer_typography_cache' ); // no longer used, lets trim things down

// Get mods
global $wpex_theme_mods;

// Make sure blog entry builder has a title and meta
if ( isset( $wpex_theme_mods['blog_entry_composer'] ) ) {
	$blocks = $wpex_theme_mods['blog_entry_composer'];
	$blocks = str_replace( 'title_meta', 'title,meta', $blocks );
	$blocks = str_replace( 'title_excerpt_content', 'title,meta,excerpt_content', $blocks );
	set_theme_mod( 'blog_entry_composer', $blocks );
}

// Disable entry meta if was previously disabled
if ( isset( $wpex_theme_mods['blog_entry_meta'] ) && ! $wpex_theme_mods['blog_entry_meta'] ) {
	// MUST USE THEME MOD SINCE IT GRABS FROM ABOVE
	if ( $blocks = get_theme_mod( 'blog_entry_composer' ) ) {
		$blocks = str_replace( 'meta,', '', $blocks );
		set_theme_mod( 'blog_entry_composer', $blocks );
	}
	remove_theme_mod( 'blog_entry_meta' );
}

// Make sure blog single builder has a title and meta
if ( isset( $wpex_theme_mods['blog_single_composer'] ) ) {
	$blocks = $wpex_theme_mods['blog_single_composer'];
	$blocks = str_replace( 'title_meta', 'title,meta', $blocks );
	$blocks = str_replace( 'title_post_series', 'title,meta', $blocks );
	set_theme_mod( 'blog_single_composer', $blocks );
}

// Disable single meta if was previously disabled
if ( isset( $wpex_theme_mods['blog_post_meta'] ) && ! $wpex_theme_mods['blog_post_meta'] ) {
	// MUST USE THEME MOD SINCE IT GRABS FROM ABOVE
	if ( $blocks = get_theme_mod( 'blog_single_composer' ) ) {
		$blocks = str_replace( 'meta,', '', $blocks );
		set_theme_mod( 'blog_single_composer', $blocks );
	}
	remove_theme_mod( 'blog_post_meta' );
}

// Move tracking to options
if ( isset( $wpex_theme_mods['tracking'] ) ) {
	$actions     = get_option( 'wpex_custom_actions' );
	$head_action = $actions['wp_head']['action'];
	$head_action .= $wpex_theme_mods['tracking'];
	$actions['wp_head']['action'] = $head_action;
	update_option( 'wpex_custom_actions', $actions );
	remove_theme_mod( 'tracking' );
}

// Update user license
if ( isset( $wpex_theme_mods['envato_license_key'] ) ) {
	update_option( 'wpex_product_license', $wpex_theme_mods['envato_license_key'] );
	remove_theme_mod( 'envato_license_key' );
}

// Menu Search
if ( isset( $wpex_theme_mods['main_search'] ) ) {
	if ( ! $wpex_theme_mods['main_search'] ) {
		set_theme_mod( 'menu_search_style', 'disabled' ); // set correct menu style
		set_theme_mod( 'header_aside_search', 'disabled' ); // disable header 2 search
	} else {
		set_theme_mod( 'menu_search_style', $wpex_theme_mods['main_search'] );
	}
	remove_theme_mod( 'main_search' );
}

// Update social style
if ( isset( $wpex_theme_mods['top_bar_social_style'] ) && 'font_icons' == $wpex_theme_mods['top_bar_social_style'] ) {
	set_theme_mod( 'top_bar_social_style', 'none' );
}