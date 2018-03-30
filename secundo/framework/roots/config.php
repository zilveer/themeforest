<?php
/**
 * Roots configuration and constants
 */
add_theme_support('root-relative-urls'); // Enable relative URLs
add_theme_support('bootstrap-top-navbar'); // Enable Bootstrap's fixed navbar

//use sidebar on the blog index page?
function ct_use_blog_index_sidebar() {


	if (function_exists('ct_get_context_option')){
		if (ct_get_context_option('posts_index_sidebar', 1) == 0) {
			return false;
		}
	}else{
		if (ct_get_option('posts_index_sidebar', 1) == 0) {
			return false;
		}
	}




	return true;
}

//span class for blog index main content
function ct_blog_index_class() {
	if (ct_use_blog_index_sidebar()) {
		echo 'col-md-9 span9';
	} else {
		echo 'col-md-12 span12';
	}
}

//use sidebar on the blog single post page?
function ct_use_blog_post_sidebar() {


	if (function_exists('ct_get_context_option')){
		if (ct_get_context_option('posts_single_sidebar', 1) == 0) {
			return apply_filters('ct_force_roots_sidebar',false);
		}
	}else{
		if (ct_get_option('posts_single_sidebar', 1) == 0) {
			return apply_filters('ct_force_roots_sidebar',false);
		}
	}

	return true;
}

//span class for blog single post main content
function ct_blog_post_class() {
	if (ct_use_blog_post_sidebar()) {
		echo 'col-md-9 span9';
	} else {
		echo 'col-md-12 span12';
	}
}

// Define which pages shouldn't have the sidebar
function roots_sidebar($forceNoSidebar = false) {
	if (is_404() || is_page_template('page.php') || $forceNoSidebar) {
		return false;
	} else {
		return true;
	}
}

// #main CSS classes
function roots_main_class($forceNoSidebar = false) {
	if (roots_sidebar($forceNoSidebar)) {
		echo 'col-md-9 span9';
	} else {
		echo 'col-md-12 span12';
	}
}

// #sidebar CSS classes
function roots_sidebar_class() {
	echo 'col-md-3 span3';
}

// footer column CSS classes
function roots_footer_column_class() {
	return 'col-md-3 span3';
}

$get_theme_name = explode('/themes/', get_template_directory());
define('GOOGLE_ANALYTICS_ID', ''); // UA-XXXXX-Y
define('POST_EXCERPT_LENGTH', 40);
define('WP_BASE', wp_base_dir());
define('THEME_NAME', next($get_theme_name));
define('RELATIVE_PLUGIN_PATH', str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH', str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH', RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);

// Set the content width based on the theme's design and stylesheet
if (!isset($content_width)) {
	$content_width = 940;
}
