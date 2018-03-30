<?php
/**
* Support Desk Functions and definitions
* by HeroThemes (http://herothemes.com)
*/



/**
* Set the content width based on the theme's design and stylesheet.
*/
if ( ! isset( $content_width ) ) $content_width = 700;

if ( ! function_exists( 'st_theme_setup' ) ):
/**
* Sets up theme defaults and registers support for various WordPress features.
*/
function st_theme_setup() {

	/**
	* If BBPress is active, add theme support
	*/
	if ( class_exists( 'bbPress' ) ) {
		add_theme_support( 'bbpress' );
	}
	
	/**
	* Custom Theme Options
	*/
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/framework/admin/' );
		require_once dirname( __FILE__ ) . '/framework/admin/options-framework.php';
	}
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'framework', get_template_directory() . '/languages' );
	
	
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 60, 60, true );
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
			'primary-nav' => __( 'Primary Navigation', 'framework' ),
			'footer-nav' => __( 'Footer Navigation', 'framework' )
	));
	
	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();

	
}
endif; // st_theme_setup
add_action( 'after_setup_theme', 'st_theme_setup' );


/**
 * Thumbnail Sizes
 */

if ( function_exists( 'add_theme_support' ) ) {
	add_image_size( 'post', 700, '300', true ); // Post thumbnail	
}


/**
 * Add theme customizer
 */
 
require("framework/theme-customizer.php");


/**
 * Enqueues scripts and styles for front-end.
 */
 
require("framework/scripts.php");
require("framework/styles.php");

/**
* If BBPress is active, load functions
*/
if ( class_exists( 'bbPress' ) ) {
require_once (get_template_directory() . '/bbpress/bbpress-functions.php');
}

/**
 * Register widgetized area and update sidebar with default widgets
 */

require("framework/register-sidebars.php");

/**
 * Add Template Navigation Functions
 */
 
require("framework/template-navigation.php");


/**
 * Comment Functions
 */
 
require("framework/comment-functions.php");


/**
 * Add class if post has thumbnail
 */

function st_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }

		return $classes;
}
add_filter('post_class', 'st_thumb_class');



/**
 * Add post types
 */
require("framework/post-types.php");


/**
 * Add metabox library
 */

function st_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'framework/post-meta/library/init.php' );
	}
}
add_action( 'init', 'st_initialize_cmb_meta_boxes', 9999 );

/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}

// Add Meta Box Componenets
require("framework/post-meta/page-meta.php");
require("framework/post-meta/faq-meta.php");
require("framework/post-meta/hpblock-meta.php");

/**
 * Add Widget Functions
 */ 
require("framework/widgets/widget-functions.php");

/**
 * Adds theme shortcodes
 * (will be mvoed to plugin soon)
 */
 
require("framework/shortcodes/shortcodes.php");

// Add shortcode manager
require("framework/shortcodes/wysiwyg/wysiwyg.php");


/**
 * Removes inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Skeleton's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 */
add_filter( 'use_default_gallery_style', '__return_false' );



/**
 * KB Pagination
 */ 
function change_posttype() {
  if( is_tax('st_kb_category') && !is_admin() ) {
    set_query_var( 'post_type', array( 'post', 'st_kb' ) );
  }
  return;
}
add_action( 'parse_query', 'change_posttype' );

function my_post_queries( $query ) {
$st_kb_ppp = of_get_option('st_kb_articles_per_page');
if ( !is_admin() && $query->is_main_query() ) {
	if(is_tax('st_kb_category')){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $st_kb_ppp);
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );


/**
 * Root search queries to seperate templates
 */ 
function st_search_template_chooser($template)
{
  global $wp_query;
  $post_type = get_query_var('post_type');
  
  // If posts
  if( $wp_query->is_search && $post_type == 'post' )
  {
    return locate_template('search-posts.php');
  }
  // If KB
  elseif( $wp_query->is_search && $post_type == 'st_kb' )
  {
    return locate_template('search-st_kb.php');
  }
  // If Forum
  elseif ( class_exists( 'bbPress' ) ) {
		if ( bbp_is_search() ) {
			return locate_template('search-topics.php'); 
		}
  } 
  return $template;
}
add_filter('template_include', 'st_search_template_chooser');


/**
 * Add post views
 */
 
function st_set_post_views($postID) {
    $count_key = '_st_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 1;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function st_get_post_views($postID){
    $count_key = '_st_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
        return "1 View";
    }
    return $count.' Views';
}

// Add post views column to KB admin
add_filter('manage_edit-st_kb_columns', 'st_kb_admin_columns');
    function st_kb_admin_columns($columns) {
		$new_columns = array(
		'views' => __('Views', 'framework'),
	);
	
    return array_merge($columns, $new_columns);

}
add_action('manage_posts_custom_column', 'st_show_kb_admin_columns');
	function st_show_kb_admin_columns($name) {
		global $post;
		switch ($name) {
		case 'views':
			$views = get_post_meta($post->ID, '_st_post_views_count', true);
			if ($views) {
				echo $views .__(' View', 'framework');
			} else {
				echo __('No Views', 'framework');
			}
		}
}


//add_filter('parse_query', 'st_kb_tag_query');
function st_kb_tag_query( $q ) {
       query_posts('post_type=st_kb&taxonomy=st_kb_tag');
}

function st_kb_tag_taxonomy( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_tax( 'st_kb_tag' )  ) {
        $query->set('post_type', 'st_kb');
    }
}
add_action( 'pre_get_posts', 'st_kb_tag_taxonomy' );