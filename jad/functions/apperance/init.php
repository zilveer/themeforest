<?php

define('SG_SLUG', 'ae-');

if (get_option('page_for_posts') != 0) {
	update_option('page_for_posts', 0);
	wp_redirect($_SERVER['REQUEST_URI']); exit;
}

if (!isset($content_width)) $content_width = 1172;

add_action('after_setup_theme', 'sg_user_theme_setup');
add_action('after_setup_theme', 'sg_theme_setup');
add_filter('excerpt_length', 'sg_custom_excerpt_length');
add_filter('get_the_excerpt', 'sg_excerpt_replace');

function sg_theme_setup()
{
	/* Add theme-supported features. */
	add_theme_support('nav-menus');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/* Add post thumbnail size */
	set_post_thumbnail_size(260, 180, true);
	/* Add images sizes */
	add_image_size('sg_post', 839, 391, true);
	add_image_size('sg_post_small', 506, 236, true);
	add_image_size('sg_portfolio', 325, 375, true);
	add_image_size('sg_portfolio_large', 650, 750, true);
	add_image_size('sg_our_team', 478, 390, true);
	add_image_size('sg_extra_icons', 36, 36, true);
	add_image_size('sg_page_icons', 35, 70, true);

	/* Localization */
	load_theme_textdomain(SG_TDN, SG_TEMPLATEPATH . '/languages');
}

function sg_custom_excerpt_length() {
	return 500;
}

function sg_excerpt_replace($text)
{
	return str_replace('[...]', '...', $text);
}