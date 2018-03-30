<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function flow_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on this theme, use a find and replace
	 * to change 'flowthemes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'flowthemes', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 825, 510, true ); // Disabled because there is no limit.

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 'main_menu' => 'Main Menu' ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	/*
	 * This theme does not support post formats by default.
	 *
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	//add_theme_support( 'post-formats', array(
	//	'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	//) );
	
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background' );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'flow_setup' );
