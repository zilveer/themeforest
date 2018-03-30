<?php
/**
 * humbleshop functions and definitions
 *
 * @package humbleshop
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'humbleshop_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function humbleshop_setup() {

	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	add_filter( 'ot_show_new_layout', '__return_false' );

	require_once ('framework/option-tree/ot-loader.php');
	include_once( 'framework/option-tree/theme-options.php' );

	require_once ('framework/edd_templates/edd_shortcodes.php');
	

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on humbleshop, use a find and replace
	 * to change 'humbleshop' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'humbleshop', get_template_directory() . '/framework/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'humbleshop' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'chat' , 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background');

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
}
endif; // humbleshop_setup
add_action( 'after_setup_theme', 'humbleshop_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function humbleshop_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'humbleshop' ),
		'id'            => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'humbleshop' ),
		'id'            => 'footer',
		'before_widget' => '<aside id="%1$s" class="widget col-sm-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop', 'humbleshop' ),
		'id'            => 'shop',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
}
add_action( 'widgets_init', 'humbleshop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function humbleshop_scripts() {
	
	wp_enqueue_style( 'font', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .  '/framework/css/bootstrap.css' );
	wp_enqueue_style( 'edd', get_template_directory_uri() . '/framework/edd_templates/edd.min.css' );
	wp_enqueue_style( 'mediaelement', get_template_directory_uri() . '/framework/inc/mediaelement/mediaelementplayer.min.css' );
	wp_enqueue_style( 'mediaelementplayer', get_template_directory_uri() . '/framework/inc/mediaelement/mejs-skins.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'gmap', '//maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), '20140625', true );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/framework/js/humbleshop.js', array( 'jquery' ), '20140625', true );
	wp_enqueue_script( 'mediaelementplayer', get_template_directory_uri() . '/framework/inc/mediaelement/mediaelement-and-player.min.js', array( 'jquery' ), '20140625', true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/framework/js/script.js', array( 'jquery' ), '20140625', true );

	if ( is_singular() && comments_open() && get_theme_mod( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'humbleshop_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/framework/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/framework/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/framework/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/framework/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/framework/inc/jetpack.php';

/* EDD functions */
if( function_exists( 'EDD' ))   :
	require get_template_directory() . '/framework/edd_templates/edd_functions.php';
endif;

/**
 * Load the TGM Plugin Activator class to notify the user
 * to install the Envato WordPress Toolkit Plugin
 */
require_once dirname( __FILE__ ) . '/framework/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
 
    // Specify the Envato Toolkit plugin
    $plugins = array(
        array(
            'name'                  => 'Easy Digital Downloads',
            'slug'                  => 'easy-digital-downloads',
            'source'                => 'http://downloads.wordpress.org/plugin/easy-digital-downloads.2.0.4.zip',
            'required'              => true,
            'version'               => '2.2.2',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        array(
            'name'                  => 'Easy Digital Downloads Related Downloads',
            'slug'                  => 'easy-digital-downloads-related-downloads',
            'source'                => 'http://downloads.wordpress.org/plugin/easy-digital-downloads-related-downloads.1.5.1.zip',
            'required'              => true,
            'version'               => '1.6.1',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        array(
            'name'                  => 'EDD Download Images',
            'slug'                  => 'edd-download-images',
            'source'                => 'http://downloads.wordpress.org/plugin/edd-download-images.1.1.2.zip',
            'required'              => true,
            'version'               => '1.1.3',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
    );

	// i18n text domain used for translation purposes
	$theme_text_domain = 'default';
	 
	// Configuration of TGM
	$config = array(
	    'domain'           => $theme_text_domain,
	    'default_path'     => '',
	    'parent_menu_slug' => 'admin.php',
	    'parent_url_slug'  => 'admin.php',
	    'menu'             => 'install-required-plugins',
	    'has_notices'      => true,
	    'is_automatic'     => true,
	    'message'          => '',
	    'strings'          => array(
	        'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),
	        'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),
	        'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ),
	        'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
	        'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
	        'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
	        'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
	        'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
	        'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
	        'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
	        'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
	        'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
	        'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
	        'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
	        'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),
	        'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),
	        'complete'                        => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
	        'nag_type'                        => 'updated'
	    )
	);

	tgmpa( $plugins, $config );
 
}

function modify_edd_product_supports($supports) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter('edd_download_supports', 'modify_edd_product_supports');