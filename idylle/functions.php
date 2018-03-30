<?php
/**
 * Idylle functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Idylle
 */

if ( ! function_exists( 'idylle_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function idylle_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Idylle, use a find and replace
	 * to change 'idylle' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'idylle', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	if ( function_exists( 'add_image_size') ) add_theme_support( 'post-thumbnails');
	if( function_exists( 'add_image_size') ) {
		add_image_size( 'idylle-mini-thumb', 400, 400, true);
		add_image_size( 'idylle-blog-thumb', 1000, 700, true);
		add_image_size( 'idylle-slider-image', 1900, 9999, true );
	}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'idylle' ),
		'onepage' => esc_html__( 'One Page', 'idylle' ),
	) );

	/*
	 * HTML in Title
	 */
	function idylle_modified_post_title ($title) {
	  if( $title == '' ){
	    $title = esc_html__( get_the_date( 'm/d/Y' ), 'idylle' );
	  }
	  return $title;
	}
	add_filter( 'the_title', 'idylle_modified_post_title');




	/*
	 * Excerpt length
	 */
	function idylle_excerpt_length($length) {
		return 20;
	}
	add_filter('excerpt_length', 'idylle_excerpt_length');

	/*
	 * Editor Style
	 */
	add_editor_style(array( 'css/editor-style.css' ));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'idylle_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // idylle_setup
add_action( 'after_setup_theme', 'idylle_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function idylle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'idylle_content_width', 940 );
}
add_action( 'after_setup_theme', 'idylle_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function idylle_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'idylle' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'idylle'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'idylle_widgets_init' );




/**
 * Load CSS
 */
function idylle_theme_styles()  {  
	wp_enqueue_style( 'library', get_template_directory_uri() . '/css/idy_lib.css', array(), '1.0');
	wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/fonts/themify-icons.css', array());
  	
  	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'woo-commerce', get_template_directory_uri() . '/css/woo-commerce.css', array());
	}
	
  	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/css/idy_style.css', array(), '1.0');
}
add_action( 'wp_enqueue_scripts', 'idylle_theme_styles' );

/**
 * Enqueue scripts and styles.
 */
function idylle_scripts() {
	wp_enqueue_style( 'idylle-style', get_stylesheet_uri() );
	wp_enqueue_script( 'idylle-lib', get_template_directory_uri() . '/js/idy_lib.js', array('jquery'), '1.0', true );
	
	if( function_exists('fw_get_db_settings_option') && !is_admin() ) { 
		wp_enqueue_script(
	        'fw-form-helpers',
	        fw_get_framework_directory_uri('/static/js/fw-form-helpers.js')
	    );
	    wp_localize_script('fw-form-helpers', 'fwAjaxUrl', admin_url( 'admin-ajax.php', 'relative' ));
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'idylle-main-scripts', get_template_directory_uri() . '/js/idy_script.js', array(), '1.2', true );
	
}
add_action( 'wp_enqueue_scripts', 'idylle_scripts' );

/**
* Admin styles.
*/
function idylle_load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'idylle_load_custom_wp_admin_style' );


/*
Register Fonts
*/
function idylle_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'idylle' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Unica One|Vollkorn:400,400italic,700,400italic&subset=latin,latin-ext' ), "http://fonts.googleapis.com/css" );
    }
    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function idylle_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', idylle_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'idylle_studio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/*TGM Plugin*/
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'idylle_require_plugins' );
 
function idylle_require_plugins() {
    $dir = get_template_directory() . '/framework-customizations/plugins/';
    $plugins = array(     
          array(
            'name'      => esc_html__( 'Unyson', 'idylle' ),
            'slug'      => 'unyson',
            'required'  => true,
          ),
          array(
            'name'      => esc_html__( 'WP Editor', 'idylle' ),
            'slug'      => 'wp-editor',
            'required'  => true,
          ),
          array(
            'name'      => esc_html__( 'RSVP and Event Management Plugin', 'idylle' ),
            'slug'      => 'rsvp',
            'required'  => true,
          )
    );
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'idylle' ),
            'menu_title'                      => __( 'Install Plugins', 'idylle' ),
            'installing'                      => __( 'Installing Plugin: %s', 'idylle' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'idylle' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'idylle' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'idylle' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'idylle' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'idylle' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'idylle'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'idylle' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'idylle' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'idylle' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'idylle' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'idylle' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'idylle' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'idylle' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'idylle' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
}
