<?php
/**
 * berg-wp functions and definitions
 *
 * @package berg-wp
 */

if (!defined("THEME_PRETTY")) {
   define("THEME_PRETTY", "<strong>Berg</strong> - WordPress Theme");
}

define("THEME_NAME", 'BERG');
define("THEME_DIR", get_template_directory());
define("THEME_DIR_URI", get_template_directory_uri());
define("THEME_STYLES", THEME_DIR_URI . "/css");
define("THEME_POST_TYPES", THEME_DIR . "/inc/post-types");
define("THEME_PLUGINS", THEME_DIR . "/plugins");
define("THEME_INCLUDES", THEME_DIR . "/inc");
define("THEME_INCLUDES_URI", THEME_DIR_URI . "/inc");

if(!is_admin()) {
	define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
	define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
}

if (!defined("THEME_PROTOCOL")) {
	define("THEME_PROTOCOL", is_ssl() ? 'https' : 'http');
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';

/*
** includes
*/
include_once THEME_INCLUDES . '/sidebar/custom-sidebar.php';
include_once THEME_INCLUDES . '/sidebar/sidebar.php';

include_once THEME_INCLUDES . '/functions_def.php';
/* redux framework */
function init_redux_framework() {
	if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/redux-yo/ReduxCore/framework.php')) {
		require_once(THEME_INCLUDES . '/redux/redux_metaboxes.php');
		require_once(dirname(__FILE__) . '/redux-yo/ReduxCore/framework.php');
	}

	if (!isset($redux) && file_exists(THEME_INCLUDES . '/redux/redux_global.php')) {
		require_once(THEME_INCLUDES . '/redux/redux_global.php');
	}
}
include_once THEME_POST_TYPES . '/post-type-berg-menu.php';
include_once THEME_POST_TYPES . '/post-type-berg-restaurant.php';
include_once THEME_POST_TYPES . '/post-type-berg-portfolio.php';
include_once THEME_POST_TYPES . '/post-type-berg-footer.php';
include_once THEME_INCLUDES . '/custom-menu.php';
include_once THEME_INCLUDES . '/shortcodes.php';
include_once THEME_INCLUDES . '/widgets.php';

include_once THEME_INCLUDES . '/menu-icons/menu-icons.php';
include_once THEME_INCLUDES . '/migrate.php';


add_action('template_redirect', 'init_redux_framework');

if (is_admin()) {
	init_redux_framework();
}


//include_once THEME_INCLUDES . '/activation.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require THEME_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require THEME_DIR . '/inc/extras.php';

/**
 * Customizer additions.
 */
require THEME_DIR . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require THEME_DIR . '/inc/jetpack.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'berg_wp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function berg_wp_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on berg-wp, use a find and replace
		 * to change THEME_NAME to the name of your theme in all the template files
		 */
		load_theme_textdomain( THEME_NAME, THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		$arrMenus = array(
			'primary' => __( 'Primary Menu', 'BERG'),
			'mobile' => __( 'Mobile Menu', 'BERG'),
			'woocommerce' => __( 'WooCommerce Menu', 'BERG')
		);
		register_nav_menus($arrMenus);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		));

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

		// Setup the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('berg_wp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		/* Woocommerce compatibility */
		add_theme_support('woocommerce');

		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			require_once(THEME_INCLUDES . '/woocommerce.php');
			require_once(THEME_INCLUDES . '/woocommerce_walker.php');
		}

		add_action('wp_ajax_save_custom_css', 'berg_saveCustomCss');
		add_action('wp_ajax_berg_load_more_posts', 'berg_loadPosts');
		add_action('wp_ajax_nopriv_berg_load_more_posts', 'berg_loadPosts');
		add_action('wp_ajax_berg_load_more_posts_masonry', 'berg_loadPostsMasonry');
		add_action('wp_ajax_nopriv_berg_load_more_posts_masonry', 'berg_loadPostsMasonry');
		add_action('wp_ajax_berg_load_more_portfolio', 'berg_loadPortfolio');
		add_action('wp_ajax_nopriv_berg_load_more_portfolio', 'berg_loadPortfolio');
		add_action('wp_ajax_berg_load_more_portfolio_masonry', 'berg_loadPortfolioMasonry');
		add_action('wp_ajax_nopriv_berg_load_more_portfolio_masonry', 'berg_loadPortfolioMasonry');		
		add_action('wp_ajax_berg_load_single_portfolio', 'berg_loadSinglePortfolio');
		add_action('wp_ajax_nopriv_berg_load_single_portfolio', 'berg_loadSinglePortfolio');
		add_action('wp_ajax_food_menu_order', 'berg_saveFoodMenuOrder');
		add_action('wp_ajax_get_map_template', 'berg_getMapTemplate');

		/* Scripts and styles */
		add_action('wp_enqueue_scripts', 'berg_wp_scripts');

		/* Admin styles and scripts*/
		add_action('admin_enqueue_scripts', 'berg_registerAdminScripts');
		add_action('admin_enqueue_scripts', 'my_admin_script');

		/* Register widget area */
		add_action('widgets_init', 'berg_wp_widgets_init');

		/* initialize VC as "built into the theme" */
		add_action('vc_before_init', 'berg_vcSetAsTheme');

		/* vc plugin install */
		add_action('tgmpa_register', 'berg_register_plugins');

		/* food menu sorting */
		add_action('admin_menu' , 'food_menu_sort');

		/* Send all comment submissions through my "berg_ajaxComment" method */
		add_action('comment_post', 'berg_ajaxComment', 20, 2);

		/* theme image sizes */
		add_image_size('blog_thumb', 1000, 600, true);
		add_image_size('blog_thumb2', 1000, 400, true);
		add_image_size('blog_thumb_small', 500, 300, true);
		add_image_size('menu_thumb', 400, 400, true);
		add_image_size('large_bg', 1440, 900, true);

		/* the excerpt length*/
		add_filter('excerpt_length', 'custom_excerpt_length', 999);


		/* the excerpt more*/
		add_filter('excerpt_more', 'new_excerpt_more');

		/* disable auto wrapping in paragraph the excerpt*/
		// remove_filter('the_excerpt', 'wpautop');

		/* Custom nav menu */
		add_action('wp_update_nav_menu_item', 'berg_custom_nav_update', 10, 3);
		add_filter('wp_setup_nav_menu_item', 'berg_custom_nav_item');
		add_filter('wp_edit_nav_menu_walker', 'berg_custom_nav_edit_walker', 10, 2);


		/* includes shortcodes and vc_maps */

		if (defined('WPB_VC_VERSION')) {
			add_action('init', 'berg_shortcodes');
		}

	}
endif; // berg_wp_setup

add_action('after_setup_theme', 'berg_wp_setup');
