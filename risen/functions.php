<?php
/**
 * Risen Theme Setup
 *
 * This loads includes with various functions as well as needed libraries. It also sets theme features, actions and filters.
 * If you want to change anything, it's best to use a child theme (see Documentation) so you don't lose changes after a theme update.
 */

// Constants
$risen_theme_data = $wp_version >= 3.4 ? wp_get_theme() : get_theme( get_current_theme() ); // wp_get_theme() new in WP 3.4, get_theme()/get_current_theme() deprecated
define( 'RISEN_VERSION', $risen_theme_data['Version'] );				// used for cache-busing CSS/JS
define( 'RISEN_THEME_DIR', get_template_directory() );					// parent theme path
define( 'RISEN_THEME_URI', get_template_directory_uri() );				// parent theme URI
define( 'RISEN_CHILD_DIR', get_stylesheet_directory() );				// child theme path
define( 'RISEN_CHILD_URI', get_stylesheet_directory_uri() );			// child theme URI
define( 'RISEN_INC_REL', 'includes' );									// includes relative path
define( 'RISEN_INC_DIR', RISEN_THEME_DIR . '/' . RISEN_INC_REL );		// includes absolute path
define( 'RISEN_INC_URI', RISEN_THEME_URI . '/' . RISEN_INC_REL );		// includes URI

// Includes
$risen_includes = array(
	'options.php',  				// prepare Options Framework, default options (even if not installed)
	'admin.php',					// theme activation, enqueue admin JS/CSS, admin menu, etc.
	'media.php', 					// custom image sizes, video embed code, etc.
	'enqueue.php', 					// enqueue front-end styles and JavaScript
	'posts.php', 					// helper functions shared by different post types (including pages)
	'pages.php', 					// page functions, meta boxes
	'meta-boxes.php', 				// meta box helper functions
	'slider.php',					// slide post type, meta boxes, etc.
	'home-boxes.php',				// homepage image boxes (post type)
	'multimedia.php',				// multimedia (sermons) post type, taxonomies, meta boxes, widgets, etc.
	'gallery.php',					// gallery (image/video) post type, taxonomy, meta boxes, admin columns, widgets
	'events.php',					// event post type, taxonomy, meta boxes, admin columns, widgets
	'staff.php',					// staff post type, taxonomy, meta boxes, admin columns, widgets
	'locations.php',				// location post type, taxonomy, meta boxes, admin columns, widgets
	'blog.php', 					// functions specific to the blog features
	'comments.php', 				// comment functions
	'sidebars.php', 				// register sidebars, setup "Show Sidebar" meta boxes for posts/pages
	'widgets.php', 					// general widgets (specific widgets are in their respective files)
	'shortcodes.php', 				// various shortcodes
	'contact-form.php', 			// contact form AJAX processing, optional reCAPTCHA
	'customizations.php', 			// apply colors, fonts, background, social icons, favicon, analytics, etc.
	'navigation.php',				// custom menus and breadcrumbs
	'files.php', 					// file/download related functions
	'maps.php', 					// Google Maps helper functions
	'helper-functions.php',			// miscellaneous helper functions
	'recaptcha/recaptchalib.php'	// Google's reCAPTCHA library
);

// Prevent double-loading reCAPTCHA library - fatal PHP error with plugin conflicts
if ( class_exists( 'ReCaptchaResponse' ) || class_exists( 'ReCaptcha' ) || function_exists( '_recaptcha_qsencode' ) ) {
	$risen_includes = array_diff( $risen_includes, array( 'recaptcha/recaptchalib.php' ) ); // remove
}

// Load includes
foreach ( $risen_includes as $include ) { // loop to load each
	require_once RISEN_INC_DIR . '/' . $include;
}

// Setup theme features, actions, filters, etc.
add_action( 'after_setup_theme', 'risen_setup' ); // perform setup on after_setup_theme hook
function risen_setup() {

	global $content_width;

	// Localization
	// See the sample child theme's functions.php file if you want to keep your language files there
	load_theme_textdomain( 'risen', RISEN_THEME_DIR . '/languages' );

	// Images & Video
	add_theme_support( 'post-thumbnails' ); // enable support for "Featured Image"
	add_action( 'init', 'risen_image_sizes' ); // set custom image sizes
	add_filter( 'img_caption_shortcode', 'risen_cleaner_caption', 10, 3 ); // fix an issue with WordPress adding 10px to caption shortcode
	add_filter( 'embed_oembed_html', 'risen_responsive_embeds', 10, 4 ); // make WordPress video embeds responsive by giving container to style
	$content_width = isset( $content_width ) ? $content_width : 880; // keep embeded videos within width of design

	// After Activation
	add_action( 'load-themes.php', 'risen_after_activate' ); // delete sample post/page/comment, prepare empty menus, prompt XML Import

	// Theme Options
	add_filter( 'options_framework_location', 'options_framework_location_override' ); // tell Options Framework plugin we use non-default location for options.php
	add_action( 'admin_menu', 'risen_options_inactive' ); // show message asking to install plugin

	// Enqueue CSS
	add_action( 'wp_enqueue_scripts', 'risen_css' ); // front-end only
	add_action( 'admin_enqueue_scripts', 'risen_admin_css' ); // admin-end only
	add_filter( 'admin_body_class', 'risen_admin_body_classes' ); // add helper classes to admin <body> for easier style tweaks (hiding "Preview" button per post type)

	// Enqueue JavaScript
	add_action( 'wp_enqueue_scripts', 'risen_js' ); // front-end only
	add_action( 'admin_enqueue_scripts', 'risen_admin_js' ); // admin-end only

	// Posts & Pages
	add_theme_support( 'automatic-feed-links' );
	add_filter( 'admin_post_thumbnail_html', 'risen_featured_image_note'); // add note below Featured Image

	// Pages Only
	add_action( 'load-post-new.php', 'risen_page_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_page_meta_boxes_setup' ); // setup meta boxes on edit page

	// Slider
	add_action( 'init', 'risen_slide_post_type' ); // register post type
	add_action( 'load-post-new.php', 'risen_slide_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_slide_meta_boxes_setup' ); // setup meta boxes on edit page
	add_action( 'do_meta_boxes', 'risen_slide_image_box' ); // move Featured Image meta box beneath editor
	add_filter( 'admin_post_thumbnail_html', 'risen_slide_featured_image_note'); // add note below Featured Image
	add_filter( 'manage_risen_slide_posts_columns' , 'risen_slide_columns' ); // add and manipulate columns
	add_filter( 'manage_edit-risen_slide_sortable_columns', 'risen_slide_columns_sorting' ); // make columns sortable
	add_filter( 'request', 'risen_slide_columns_sorting_request' ); // set how to sort columns (default sorting, custom fields)
	add_action( 'manage_posts_custom_column' , 'risen_slide_columns_content' ); // add content to the new columns

	// Home Image Boxes
	add_action( 'init', 'risen_home_box_post_type' ); // register post type
	add_action( 'load-post-new.php', 'risen_home_box_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_home_box_meta_boxes_setup' ); // setup meta boxes on edit page
	add_action( 'do_meta_boxes', 'risen_home_box_image_box' ); // move Featured Image meta box beneath editor
	add_filter( 'admin_post_thumbnail_html', 'risen_home_box_featured_image_note'); // add note below Featured Image
	add_filter( 'manage_risen_home_box_posts_columns' , 'risen_home_box_columns' ); // add and manipulate columns
	add_filter( 'manage_edit-risen_home_box_sortable_columns', 'risen_home_box_columns_sorting' ); // make columns sortable
	add_filter( 'request', 'risen_home_box_columns_sorting_request' ); // set how to sort columns (default sorting, custom fields)
	add_action( 'manage_posts_custom_column' , 'risen_home_box_columns_content' ); // add content to the new columns

	// Multimedia (Sermons)
	add_action( 'init', 'risen_multimedia_post_type' ); // register post type
	add_action( 'init', 'risen_multimedia_category_taxonomy' ); // category taxonomy
	add_action( 'init', 'risen_multimedia_tag_taxonomy' ); // tag taxonomy
	add_action( 'init', 'risen_multimedia_speaker_taxonomy' ); // speaker taxonomy
	add_action( 'load-post-new.php', 'risen_multimedia_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_multimedia_meta_boxes_setup' ); // setup meta boxes on edit page
	add_filter( 'manage_risen_multimedia_posts_columns' , 'risen_multimedia_columns' ); // add columns for thumbnail, categories, etc.
	add_action( 'manage_posts_custom_column' , 'risen_multimedia_columns_content' ); // add content to the new columns
	add_action( 'generate_rewrite_rules', 'risen_multimedia_date_archive' ); // enable date archive for multimedia post type
	add_filter( 'option_posts_per_page', 'risen_multimedia_archive_posts_per_page' ); // correct posts_per_page for multimedia archives (date, category, tag, speaker)

	// Gallery (Images & Videos)
	add_action( 'init', 'risen_gallery_post_type' ); // register post type
	add_action( 'init', 'risen_gallery_taxonomy' ); // category taxonomy
	add_action( 'load-post-new.php', 'risen_gallery_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_gallery_meta_boxes_setup' ); // setup meta boxes on edit page
	add_filter( 'admin_post_thumbnail_html', 'risen_gallery_featured_image_note'); // add note below Featured Image
	add_filter( 'manage_risen_gallery_posts_columns' , 'risen_gallery_columns' ); // add columns for thumbnail, media type, categories
	add_action( 'manage_posts_custom_column' , 'risen_gallery_columns_content' ); // add content to the new columns
	add_filter( 'option_posts_per_page', 'risen_gallery_archive_posts_per_page' ); // correct posts_per_page for multimedia archives (category)

	// Events
	add_action( 'init', 'risen_event_post_type' ); // register post type
	add_action( 'load-post-new.php', 'risen_event_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_event_meta_boxes_setup' ); // setup meta boxes on edit page
	add_filter( 'admin_post_thumbnail_html', 'risen_staff_featured_image_note'); // add note below Featured Image
	add_filter( 'manage_risen_event_posts_columns' , 'risen_event_columns' ); // add columns for meta values
	add_action( 'manage_posts_custom_column' , 'risen_event_columns_content' ); // add content to the new columns
	add_filter( 'manage_edit-risen_event_sortable_columns', 'risen_event_columns_sorting' ); // make columns sortable
	add_filter( 'request', 'risen_event_columns_sorting_request' ); // set how to sort columns

	// Staff
	add_action( 'init', 'risen_staff_post_type' ); // register post type
	add_action( 'load-post-new.php', 'risen_staff_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_staff_meta_boxes_setup' ); // setup meta boxes on edit page
	add_filter( 'manage_risen_staff_posts_columns' , 'risen_staff_columns' ); // add columns
	add_action( 'manage_posts_custom_column' , 'risen_staff_columns_content' ); // add content for columns
	add_filter( 'manage_edit-risen_staff_sortable_columns', 'risen_staff_columns_sorting' ); // make columns sortable
	add_filter( 'request', 'risen_staff_columns_sorting_request' ); // set how to sort columns

	// Locations
	add_action( 'init', 'risen_location_post_type' ); // register post type
	add_action( 'load-post-new.php', 'risen_location_meta_boxes_setup' ); // setup meta boxes on add page
	add_action( 'load-post.php', 'risen_location_meta_boxes_setup' ); // setup meta boxes on edit page
	add_filter( 'manage_risen_location_posts_columns' , 'risen_location_columns' ); // add columns for meta values
	add_action( 'manage_posts_custom_column' , 'risen_location_columns_content' ); // add content to the new columns
	add_filter( 'manage_edit-risen_location_sortable_columns', 'risen_location_columns_sorting' ); // make columns sortable
	add_filter( 'request', 'risen_location_columns_sorting_request' ); // set how to sort columns

	// Custom Menus
	add_action( 'init', 'risen_register_menus' ); // register header/footer menu locations
	add_filter( 'import_end', 'risen_import_correct_menu_urls' ); // correct custom menu URLs from sample XML content to use actual site's home URL

	// Sidebars
	add_action( 'widgets_init', 'risen_register_sidebars' ); // see includes/sidebars.php
	add_action( 'load-post-new.php', 'risen_sidebar_meta_box_setup' ); // setup "Show Sidebar" meta box on add
	add_action( 'load-post.php', 'risen_sidebar_meta_box_setup' ); // setup "Show Sidebar" meta box on edit

	// Widgets
	add_action( 'widgets_init', 'risen_register_widgets' ); // register custom widgets
	add_action( 'widgets_init', 'risen_unregister_widgets' ); // remove widgets not used or that are replaced with "Enhanced" version
	add_action( 'template_redirect', 'risen_redirect_taxonomy' ); // uses with Categories widget dropdown redirects

	// Shortcodes
	add_action( 'init', 'risen_shortcodes' ); // see includes/shortcodes.php

	// Title Tag (<title>)
	add_theme_support( 'title-tag' );
	//add_filter( 'wp_title', 'risen_title', 10, 3 ); // add_theme_support( 'title-tag' ) is used now

	// Process Contact Form via AJAX
	add_action( 'wp_ajax_nopriv_risen-contact-form-submit', 'risen_contact_form_submit' ); // not logged in
	add_action( 'wp_ajax_risen-contact-form-submit', 'risen_contact_form_submit' ); // logged in

	// Manipulate Admin Menu
	add_action( 'admin_menu', 'risen_admin_menu' ); // remove and rename admin menu items
	add_filter( 'custom_menu_order', 'risen_custom_menu_order' ); // enable custom menu order
	add_filter( 'menu_order', 'risen_menu_order' ); // change menu order

	// Custom Styles from Theme Options
	add_action( 'wp_head', 'risen_styles' ); // add style to <head>

	// Favicon (if uploaded)
	add_action( 'wp_head', 'risen_favicon' ); // add to bottom of <head>

	// Google Analytics
	add_action( 'wp_head', 'risen_google_analytics' ); // add to bottom of <head>

	// Force download of certain files
	add_action( 'template_redirect', 'risen_force_download' );

	// Prevent automatic updates from wordpress.org
	add_filter( 'http_request_args', 'risen_prevent_wrong_update', 5, 2 );

}
