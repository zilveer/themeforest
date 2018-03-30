<?php

/*------------------------------------------------------------
 * Define Sidebars
 *------------------------------------------------------------*/

if (function_exists('register_sidebar')) {

	register_sidebar(array(
		'name' => __('Sidebar Area', 'sleek'),
		'description' => __('Sidebar Area for widgets is located in sidebar.', 'sleek'),
		'id' => 'sidebar-area',
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer Area', 'sleek'),
		'description' => __('Footer Area for widgets is located on bottom of header.', 'sleek'),
		'id' => 'footer-area',
		'before_widget' => '<div id="%1$s" class="widget widget--footer %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('404 Area', 'sleek'),
		'description' => __('404 Area is used as main content on 404 Error Page.', 'sleek'),
		'id' => 'page-404-area',
		'before_widget' => '<div id="%1$s" class="widget widget--404 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Search Results Area', 'sleek'),
		'description' => __('This area is used as main content if search provides 0 results.', 'sleek'),
		'id' => 'search-results',
		'before_widget' => '<div id="%1$s" class="widget widget--search-results %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>'
	));

}