<?php
/**
 * Evential Wordpress Theme functions and definitions
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */
//==============================
// WP Title
//==============================
function evential_wp_title( $title, $sep ) 
{
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'rms' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'evential_wp_title', 10, 2 );

//=====================================
// TMG Plugin Hook
//=====================================
if (!function_exists('evential_plugin_load')) {

    function evential_plugin_load() {
        // Load TGM plugin activation
        load_template(get_template_directory() . '/includes/admin/Plugin/class-tgm-plugin-activation.php');
    }

}
add_action('after_setup_theme', 'evential_plugin_load');

//=====================================
// TGM plugin activation
//=====================================
if (!function_exists('evential_theme_plugins')) {

    function evential_theme_plugins() {
        // Add the following plugins
        $plugins = array(
			// Redux Framework
            array(
                'name' => 'Redux Framework',
                'slug' => 'redux-framework',
                'source' => get_template_directory() . '/includes/admin/Plugin/plugins/redux-framework.zip',
                'required' => true,
            ),
			// Subscribe 2 
			array(
                'name' => 'Subscribe2',
                'slug' => 'subscribe2',
                'source' => get_template_directory() . '/includes/admin/Plugin/plugins/subscribe2.zip',
                'required' => true,
            ),
			// Contact Form 7
			array(
				'name' 				=> 'Contact Form 7',
				'slug' 				=> 'contact-form-7',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			// RMS Custom Post Type
            array(
                'name' => 'Rmsit Custom Post',
                'slug' => 'Rmsit-Custom-Post',
                'source' => get_template_directory() . '/includes/admin/Plugin/plugins/Rmsit-Custom-Post.zip',
                'required' => true,
            )
        );
        tgmpa($plugins);
    }

}
add_action('tgmpa_register', 'evential_theme_plugins');
//=====================================
// Redux Fremawork Hook
//=====================================
if (!class_exists('theme-option') && file_exists(dirname(__FILE__) . '/theme-option/ReduxCore/framework.php')) {
    require_once( dirname(__FILE__) . '/theme-option/ReduxCore/framework.php' );
}
if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/theme-option/sample/sample-config.php')) {
    require_once( dirname(__FILE__) . '/theme-option/sample/sample-config.php' );
}
if (!function_exists('redux_disable_dev_mode_plugin')) {

    function redux_disable_dev_mode_plugin($redux) {
        if ($redux->args['opt_name'] != 'redux_demo') {
            $redux->args['dev_mode'] = false;
        }
    }

    add_action('redux/construct', 'redux_disable_dev_mode_plugin');
}
//=====================================
// After Theme Setup Function
//=====================================
if (!function_exists('evential_theme_setup')) :
    /**
     * Evential Theme setup.
     *
     * Set up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support post thumbnails.
     *
     * @since Evential 1.0
     */
    function evential_theme_setup() {
		global $content_width;
		// Set Content Width
		if (!isset($content_width))
			$content_width = 900;
			
		// Add theme support for automatic feed links.
		add_theme_support('automatic-feed-links');
		
		// Set Post Thumbnail
        add_theme_support('post-thumbnails');
		
		// Add your nav menus function to the 'init' action hook.
		add_action( 'init', 'evential_register_menus' );
		
		// Add your sidebars function to the 'widgets_init' action hook.
		add_action( 'widgets_init', 'evential_register_sidebars' );
		
		// Load JavaScript files on the 'wp_enqueue_scripts' action hook.
		add_action( 'wp_enqueue_scripts', 'evential_all_default_script' );
		
		// Load Stylesheet files on the 'wp_enqueue_scripts' action hook.
		add_action( 'wp_enqueue_scripts', 'evential_all_default_style' );
		
		// Load Google Font on the 'wp_enqueue_scripts' action hook.
		add_action( 'wp_enqueue_scripts', 'evential_google_fonts' );
		
		// Load Editor Style on the 'wp_enqueue_scripts' action hook.
		add_action( 'wp_enqueue_scripts', 'evential_add_editor_styles' );
		
		// Custom Header and Background
		add_theme_support('custom-header', array(
			// Header image default
			'default-image' => ''
		));
		add_theme_support('custom-background', array(
			// Background color default
			'default-color' => '000',
			// Background image default
			'default-image' => ''
		));
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
        add_theme_support('post-formats', array(
            'image', 'video', 'audio',
        ));

        // Add support for featured content.
        add_theme_support('featured-content', array(
            'featured_content_filter' => 'evential_get_featured_posts',
            'max_posts' => 6,
        ));

        // This theme uses its own gallery styles.
        add_filter('use_default_gallery_style', '__return_false');
    }

endif; // evential_setup
add_action('after_setup_theme', 'evential_theme_setup');

//==============================================================================================
// Load Enqueue JS, CSS and Nav Walker
//==============================================================================================
require dirname(__FILE__) . '/includes/admin/enqueue.php';
require dirname(__FILE__) . '/includes/admin/meta-box.php';
require dirname(__FILE__) . '/includes/NavWalker.php';

//=================================================
// Add Menu
//=================================================
function evential_register_menus() {
	register_nav_menus(array(
		'primary' => __('Top primary menu', 'Evential'),
	));
}

//=================================================
// Add Sidebar Support
//=================================================
function evential_register_sidebars() {
    if (function_exists('register_sidebar')) {

        register_sidebar(
                array(
                    'name' => __('Main Sidebar', 'evential'),
                    'id' => 'main-sidebar',
                    'description' => __('Appears on posts and pages, which has its own widgets', 'evential'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h4>',
                    'after_title' => '</h4>'
                )
        );
    }
}

//=================================================
// Enable Page excerpt
//=================================================
function enable_page_excerpt() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_page_excerpt');

//=================================================
// Pagination
//=================================================
function pagination($pages = '', $range = 1) {
    $rms_showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged))
        $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<ul class=\"pagination blog2\">";
        if ($paged > 2 && $paged > $range + 1 && $rms_showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'><img style='margin-right: 15px;' src='" . get_template_directory_uri() . "/images/arrow.png' alt='left-arrow'/></a>";
        if ($paged > 1 && $rms_showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'> <i class='fa fa-angle-left'></i></a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $rms_showitems )) {
                echo ($paged == $i) ? "<li><a class=\"cur-page\">" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a></li>";
            }
        }

        if ($paged < $pages && $rms_showitems < $pages)
            echo "</li><a href=\"" . get_pagenum_link($paged + 1) . "\">
		 <img src='" . get_template_directory_uri() . "/images/arrow2.png' alt='right-arrow'/></a></li>";
        echo "</ul>\n";
    }
}


//======================================
// Activate Shortcode
//======================================
$ThemePageShortcode = array('section', 'heading', 'columns', 'textblock', 'team', 'fun', 'googlemap', 'testimonial', 'countdown', 'pricing', 'faq', 'event', 'mybtn', 'venue', 'hurryup', 'schedule', 'partner');

//==============================================================================================
// Load Evential options
//==============================================================================================
require dirname(__FILE__) . '/includes/evential-bootstrap.php';
//==============================================================================================
// inner page script
//==============================================================================================
function evential_inner_scripts() {
        wp_enqueue_script( 'evential-inner', get_template_directory_uri().'/js/inner.js', array('nicescroll-js'), '', true  );
}
function evential_front_scripts() {
        wp_enqueue_script( 'evential-front', get_template_directory_uri().'/js/main.js', array('nicescroll-js'), '', true  );
}
function script_check_loading()
{
    if( is_front_page() )
    {
        add_action( 'wp_enqueue_scripts', 'evential_front_scripts' );
    }
	elseif ( is_home() )
    {
        add_action( 'wp_enqueue_scripts', 'evential_inner_scripts' );
    } 
    else
    {
        add_action( 'wp_enqueue_scripts', 'evential_inner_scripts' );
    }
}
add_action( 'wp', 'script_check_loading' );