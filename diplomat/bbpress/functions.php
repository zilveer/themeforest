<?php

/**
 *  bbPress init
 */
if ( !function_exists('tmm_bbpress_init') ) {
	function tmm_bbpress_init() {
		add_filter('nav_menu_css_class', 'tmm_bbpress_menu_blog_item_css_class', 10, 2);
		//add_filter('bbp_get_breadcrumb', 'tmm_bbpress_remove_default_breadcrumbs', 10, 3);
		add_filter('tmm_breadcrumbs_custom_items', 'tmm_bbpress_breadcrumbs_items', 10, 1);
		add_filter('tmm_custom_sidebar_page', 'tmm_bbpress_custom_sidebar_page');
		add_filter('bbp_title', 'tmm_bbpress_title', 10, 3);
	}
}

add_action('init', 'tmm_bbpress_init', 1);

/**
 *  Navigation menu fix with adding current page class to 'page_for_posts' on custom posts
 */
if (!function_exists('tmm_bbpress_menu_blog_item_css_class')) {
	function tmm_bbpress_menu_blog_item_css_class($classes, $item) {
		if ( is_singular( 'forum' ) || is_singular( 'reply' ) || is_singular( 'topic' )  || is_post_type_archive( 'forum' ) || bbp_is_single_user() ||  bbp_is_topic_tag()) {

			if ( $item->object_id == get_option('page_for_posts') ) {
				$key = array_search( 'current_page_parent', $classes );
				if ( false !== $key )
					unset( $classes[ $key ] );
			}
		}

		if ( (get_permalink($item->object_id) == get_site_url().'/'.bbp_get_root_slug().'/') && is_post_type_archive( 'forum' ) ){
			array_push($classes, "current_page_item", "current-menu-item");
		}

		if (is_singular( 'topic' ) && (get_permalink($item->object_id) == get_site_url().'/'.bbp_get_root_slug().'/') ||
		    (bbp_is_topic_tag() && (get_permalink($item->object_id) == get_site_url().'/'.bbp_get_root_slug().'/')) ||
		    (is_singular( 'reply' ) && (get_permalink($item->object_id) == get_site_url().'/'.bbp_get_root_slug().'/'))||
		    (is_singular( 'forum' ) && (get_permalink($item->object_id) == get_site_url().'/'.bbp_get_root_slug().'/'))
		){
			array_push($classes, "current_page_item", "current-menu-item");
		}

		return $classes;
	}
}

/**
 *  Remove default breadcrumbs
 */
if (!function_exists('tmm_bbpress_remove_default_breadcrumbs')) {
	function tmm_bbpress_remove_default_breadcrumbs($trail, $crumbs, $r) {

		if (isset($r['tmm_custom']) && $r['tmm_custom']) {
			return $trail;
		}

		return '';
	}
}

/**
 *  Change meta title
 */
if (!function_exists('tmm_bbpress_title')) {
	function tmm_bbpress_title($title, $sep, $seplocation) {
		$sitename = get_bloginfo('name', 'display');

		if (strpos($title, $sitename) === false) {
			$title .= get_bloginfo('name', 'display');
		}

		return $title;
	}
}

/**
 * 	Breadcrumbs item
 */
if (!function_exists('tmm_bbpress_breadcrumbs_items')) {
	function tmm_bbpress_breadcrumbs_items($breadcrumbs) {
		if (is_bbpress()) {
			$args = array(
				// HTML
				'before'          => '',
				'after'           => '',
				// Separator
				'sep'             => ' ',
				'pad_sep'         => 0,
				'sep_before'      => '',
				'sep_after'       => '',
				// Crumbs
				'crumb_before'    => '',
				'crumb_after'     => '',
				// Current
				'current_before'  => '',
				'current_after'   => '',
				// Custom breadcrumbs (default will be removed)
				'tmm_custom'   => true,
			);
			return bbp_get_breadcrumb($args);
		}

		return $breadcrumbs;
	}
}

/**
 * 	Custom sidebar page id
 */
if ( !function_exists('tmm_bbpress_custom_sidebar_page') ) {
	function tmm_bbpress_custom_sidebar_page( $id ) {

		if (bbp_is_custom_post_type() || bbp_is_single_user() ||  bbp_is_topic_tag()) {
			$page = get_page_by_path(bbp_show_on_root());

			if (!empty($page->ID)) {
				$id = $page->ID;
			}
		}

		return $id;
	}
}

