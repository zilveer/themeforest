<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-setup.php
 * @file	 	1.1
 *
 */
?>
<?php
	if ( ! function_exists( 'prostore_setup' ) ){

		function prostore_setup() {

			// Define directory constant
				define('PARENT_DIR', get_template_directory());

			// Make theme available for translation
			// Translations can be filed in the /languages/ directory
				load_theme_textdomain( 'prostore-theme', get_template_directory() . '/languages' );
				$locale = get_locale();
				$locale_file = get_template_directory() . "/languages/$locale.php";
				if ( is_readable( $locale_file ) ) require_once( $locale_file );

			// This theme styles the visual editor with editor-style.css to match the theme style.
			add_editor_style('editor-style.css');

			// Add default posts and comments RSS feed links to <head>.
			add_theme_support( 'automatic-feed-links' );

			// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 200, 200, true);
			add_image_size( 'edit-screen-thumbnail', 100, 75, true );
			add_image_size( 'featured', 400, 225, true );
			add_image_size( 'relatedp', 400, 400, true );

			// Set content width
			if ( ! isset( $content_width ) ) $content_width = 940;

			add_theme_support( 'custom-background' );   // wp custom background
			// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
			// adding post format support
			add_theme_support( 'post-formats',      // post formats
				array(
					'aside',   // title less blurb
					'gallery', // gallery of images
					'link',    // quick link to other site
					'image',   // an image
					'quote',   // a quick quote
					'status',  // a Facebook like status update
					'video',   // video
					'audio'   // audio
				)
			);
			add_theme_support( 'menus' );            // wp menus
			register_nav_menus(                      // wp3+ menus
				array(
					'helper_nav' => 'Helper Menu (Above Main Menu)',
					'main_nav' => 'The Main Menu',   // main nav in header
					'footer_links' => 'Footer Links' // secondary nav in footer
				)
			);

			// Remove Twenty Eleven Options page
			remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );

		}

		add_action( 'after_setup_theme', 'prostore_setup' );

	}