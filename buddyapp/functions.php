<?php
/**
 * @package WordPress
 * @subpackage Next
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Next 1.0
 */

/***************************************************
:: Load Kleo framework
***************************************************/

define( 'KLEO_THEME_VERSION', '1.2.3' );

if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

require_once( trailingslashit( get_template_directory() ) . 'kleo-framework/kleo.php' );

//set some theme configuration options
Kleo::init_config( array(
    'styling_variables' => array(
        'background-color' => esc_html__( 'Background color', 'buddyapp' ),
        'border-color' => esc_html__( 'Border color', 'buddyapp' ),
        'heading-color' => esc_html__( 'Heading color', 'buddyapp' ),
        'text-color' =>     esc_html__( 'Text color', 'buddyapp' ),
        'link-color' => esc_html__( 'Link color', 'buddyapp' ),
        'hover-link-color' => esc_html__( 'Hover Link color', 'buddyapp' ),
        'accent-color' => esc_html__( 'Accent color', 'buddyapp' )
    ),
    //Post image sizes for carousels and galleries
    'post_gallery_img_width' => 600,
    'post_gallery_img_height' => 400,

    //page templates
    'tpl_map' => array(
        'page-templates/full-width.php' => 'full',
        'page-templates/left-sidebar.php' => 'left',
        'page-templates/right_sidebar.php' => 'right',
    ),
    'container_class' => 'container-fluid',
    'menu_icon_default' => 'buddyapp-default',
    'footer_text' => 'Proudly powered by WordPress. Developed by <a target="_blank" href="http://7thqueen.com">SeventhQueen</a>',
    'default_font_headings' => 'Montserrat',
    'default_font_text' => 'Open Sans'

));




/***************************************************
:: Theme Required plugins
 ***************************************************/

add_action( 'tgmpa_register', 'kleo_required_plugins' );

function kleo_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'BuddyPress', // The plugin name
            'slug' => 'buddypress', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '2.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),

        /*array(
            'name' => 'BuddyPress Cover Photo', // The plugin name
            'slug' => 'buddypress-cover-photo', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),*/
        array(
            'name' => 'bbPress', // The plugin name
            'slug' => 'bbpress', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Envato Toolkit - Auto Theme Updates', // The plugin name
            'slug' => 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/lib/inc/envato-wordpress-toolkit.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Visual Composer', // The plugin name
            'slug' => 'js_composer', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/lib/inc/js_composer.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '4.11.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Restrict my Site', // The plugin name
            'slug' => 'restrict-my-site', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/lib/inc/restrict-my-site.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Easy Knowledge Base', // The plugin name
            'slug' => 'easy-kb', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/lib/inc/easy-kb.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'rtMedia', // The plugin name
            'slug' => 'buddypress-media', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Contact Form 7', // The plugin name
            'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Charts and Graphs', // The plugin name
            'slug' => 'visualizer', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Wise Chat', // The plugin name
            'slug' => 'wise-chat', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name' => 'BuddyDrive - File sharing', // The plugin name
            'slug' => 'buddydrive', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'WP Polls', // The plugin name
            'slug' => 'wp-polls', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Events Manager', // The plugin name
            'slug' => 'events-manager', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Cleverness To-Do List', // The plugin name
            'slug' => 'cleverness-to-do-list', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     */
    $config = array(
        'id'                => 'tgmpa-kleo-' . KLEO_THEME_VERSION,
        //'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        //'parent_slug'  => '',         // Default parent menu slug
        //'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => true,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required Plugins', 'buddyapp' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'buddyapp' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'buddyapp' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'buddyapp' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','buddyapp' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','buddyapp' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','buddyapp' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','buddyapp' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','buddyapp' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','buddyapp' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','buddyapp' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','buddyapp' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'buddyapp' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'buddyapp' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'buddyapp', 'buddyapp' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'buddyapp' ),
            'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'buddyapp' ) // %1$s = dashboard link
        )
    );

    tgmpa( $plugins, $config );

}



/**
 * Sets up theme defaults and registers the various WordPress features
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Kleo Framework 1.0
 */
function kleo_setup() {

	/*
	 * Makes theme available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'buddyapp', get_template_directory() . '/languages' );

	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'status', 'quote', 'video'
	) );

	/* This theme uses wp_nav_menu() in two locations. */
	register_nav_menu( 'primary', esc_html__( 'Main Menu (Side)', 'buddyapp' ) );
    register_nav_menu( 'top-left', esc_html__( 'Top Left Header Menu', 'buddyapp' ) );
    register_nav_menu( 'top-right', esc_html__( 'Top Right Header Menu', 'buddyapp' ) );


    /* This theme uses a custom image size for featured images, displayed on "standard" posts. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 9999 ); // Unlimited height, soft crop
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/* Specific framework functionality */
	add_theme_support( 'kleo-sidebar-generator' );
    add_theme_support( 'kleo-menu-custom' );
    add_theme_support( 'kleo-menu-items' );

	/* Third-party plugins */
	add_theme_support( 'bbpress' );
    add_theme_support( 'woocommerce' );

    add_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'kleo_setup' );



/***************************************************
:: Load Theme files
 ***************************************************/

add_action( 'after_setup_theme', 'kleo_theme_functions', 12 );

function kleo_theme_functions() {

    // Resize on the fly
    require_once( KLEO_LIB_DIR . '/inc/aq_resizer.php' );

    // Menu structure
    require_once( KLEO_LIB_DIR . '/menu.php' );

    /* Custom menu */
    require_if_theme_supports('kleo-menu-custom', KLEO_LIB_DIR . '/menu-custom.php');

    /* Custom menu items */
    require_if_theme_supports('kleo-menu-items', KLEO_LIB_DIR . '/menu-items.php');

    /* Include admin customizations */
    if ( is_customize_preview() ) {
        require_once( KLEO_LIB_DIR . '/customizer/setup.php' );
    }

    //Meta Boxes
    if ( is_admin() ) {
        require_once(KLEO_LIB_DIR . '/metaboxes.php');
    }

    //Dynamic CSS generation
    require_once( KLEO_LIB_DIR . '/dynamic-css/dynamic-css.php' );

    /* BuddyPress compatibility */
    if ( function_exists( 'bp_is_active' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/buddypress/buddypress.php' );
    }

    /* bbPress compatibility */
    if ( class_exists( 'bbPress' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/bbpress/bbpress.php' );
    }

    /* Woocommerce compatibility */
    if (  class_exists( 'WooCommerce' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/woocommerce.php' );
    }


    /* WPML compatibility */
    if ( function_exists( 'icl_get_languages' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/wpml.php' );
    }

    /* Visual composer compatibility */
    if ( function_exists( 'vc_set_as_theme' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/visual-composer.php' );
    }

    /* Cleverness TodoList compatibility */
    if ( class_exists('CTDL_Widget')) {
        require_once( KLEO_LIB_DIR . '/plugins/ctdl.php' );
    }

    /* Easy Knowledge Base compatibility */
    if ( function_exists( 'sq_kb_setup_post_type' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/easy-kb/easy-kb.php' );
    }

    // menu-items-visibility-control plugin compatibility
    if ( class_exists( 'Boom_Walker_Nav_Menu_Edit' ) ) {
        require_once( KLEO_LIB_DIR . '/plugins/menu-items-visibility-control.php' );
    }

}



/***************************************************
:: Load Theme specific functions
 ***************************************************/

require_once( trailingslashit( KLEO_LIB_DIR ) . 'theme-functions.php' );



/***************************************************
:: Load Theme Panel
 ***************************************************/

if( is_admin() ) {
    require_once( trailingslashit(KLEO_LIB_DIR) . 'theme-panel/init.php' );
}



/***************************************************
:: 1 Click Install
 ***************************************************/
if ( is_admin() ) {
    require_once( trailingslashit(KLEO_LIB_DIR) . '/importer/import.php' );
}



/***************************************************
:: Load components
 ***************************************************/

$kleo_components = array(
    'base.php',
    'page-title.php',
    'extras.php',
);

$kleo_components = apply_filters( 'kleo_components', $kleo_components );

foreach ( $kleo_components as $component ) {
    $file_path = trailingslashit( KLEO_LIB_DIR ) . 'components/' . $component;
    include_once $file_path;
}



/***************************************************
:: Load modules
 ***************************************************/

$kleo_modules = array(
    'facebook-login.php'
);

$kleo_modules = apply_filters( 'kleo_modules', $kleo_modules );

foreach ( $kleo_modules as $module ) {
    $file_path = trailingslashit( KLEO_LIB_DIR ) . 'modules/' . $module;
    include_once $file_path;
}



/***************************************************
:: Include widgets
 ***************************************************/

$kleo_widgets = array(
    'recent_posts.php'
);

$kleo_widgets = apply_filters( 'kleo_widgets', $kleo_widgets );

foreach ( $kleo_widgets as $widget ) {
    $file_path = trailingslashit( KLEO_LIB_DIR ) . 'widgets/' . $widget;

    if ( file_exists( $file_path ) ) {
        require_once( $file_path );
    }
}


if ( ! function_exists( 'kleo_widgets_init' ) ) {
    /**
     * Registers our main widget area and the front page widget areas.
     *
     * @since Kleo 1.0
     */
    function kleo_widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Main Sidebar', 'buddyapp'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Main Sidebar', 'buddyapp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Side menu Area', 'buddyapp'),
            'id' => 'side',
            'description' => esc_html__('Side Menu Area', 'buddyapp'),
            'before_widget' => '<div id="%1$s" class="menu-section widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<p class="menu-section-header"><span>',
            'after_title' => '</span></p>',
        ));

    }
}
add_action( 'widgets_init', 'kleo_widgets_init' );



/***************************************************
:: Scripts/Styles load
***************************************************/

add_action( 'wp_enqueue_scripts', 'kleo_frontend_files' );
if ( ! function_exists( 'kleo_frontend_files' ) ) :
	// Register some javascript files
	function kleo_frontend_files()
	{

        $min = '';
        if ( sq_option( 'dev_mode', false ) == false )  {
            $min = '.min';
        }
		//head scripts
		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.92164.js', array(),KLEO_THEME_VERSION, false );

		/* Footer scripts */
		wp_register_script( 'kleo-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'),KLEO_THEME_VERSION, true );
		wp_register_script( 'kleo-app', get_template_directory_uri() . '/assets/js/functions' . $min . '.js', array('jquery', 'kleo-plugins' ),KLEO_THEME_VERSION, true );

		//enqueue them
		wp_enqueue_script('modernizr');
		wp_enqueue_script('kleo-plugins');

		wp_enqueue_script('kleo-app');

		$obj_array = array(
            'ajaxurl' =>  admin_url('admin-ajax.php'),
            'loadingMessage' => '<i class="icon-refresh animate-spin"></i> ' . esc_html__( 'Sending info, please wait...', 'buddyapp' ),
            'errorMessage' => esc_html__('Sorry, an error occurred. Try again later.', 'buddyapp')
        );
        $obj_array = apply_filters( 'kleo_localize_app', $obj_array );

		wp_localize_script( 'kleo-app', 'KLEO', $obj_array );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

        if ( is_child_theme() && file_exists( get_stylesheet_directory_uri() . '/assets/fonts/style.css' )) {
            $fonts_path = get_stylesheet_directory_uri() . '/assets/fonts/style.css';
        } else {
            $fonts_path = get_template_directory_uri() . '/assets/fonts/style.css';
        }

		// Register the styles
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), KLEO_THEME_VERSION, 'all' );
		wp_register_style( 'buddyapp', get_template_directory_uri() . '/assets/less/theme' . $min . '.css', array(), KLEO_THEME_VERSION, 'all' );
		wp_register_style( 'kleo-font-icons', $fonts_path , array(), KLEO_THEME_VERSION, 'all' );
		wp_register_style( 'kleo-animate', get_template_directory_uri() . '/assets/css/animate.css', array(), KLEO_THEME_VERSION, 'all' );
		wp_register_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), KLEO_THEME_VERSION, 'all' );
		wp_register_style( 'outdatedbrowser', get_template_directory_uri() . '/assets/js/3rd-plugins/outdatedbrowser/outdatedbrowser.min.css', array(), KLEO_THEME_VERSION, 'all' );

        wp_register_style( 'kleo-style', CHILD_THEME_URI . '/style.css', array(), KLEO_THEME_VERSION, 'all' );

		//enqueue required styles
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'buddyapp' );
		wp_enqueue_style( 'kleo-font-icons' );
		wp_enqueue_style( 'kleo-animate' );
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'outdatedbrowser' );

	} // end kleo_frontend_files()
endif;



add_action( 'wp_enqueue_scripts', 'kleo_load_files_plugin_compat', 1000 );

function kleo_load_files_plugin_compat()
{
	//enqueue child theme style only if activated
	if (is_child_theme()) {
		wp_enqueue_style( 'kleo-style' );
	}


} // kleo_load_css_files_plugin_compat()



/***************************************************
:: ADMIN CSS
***************************************************/
function kleo_admin_styles() {
    wp_register_style( "kleo-admin", KLEO_LIB_URI . "/assets/admin-custom.css", false, "1.0", "all" );
    wp_enqueue_style( 'kleo-admin' );
}
add_action( 'admin_enqueue_scripts', 'kleo_admin_styles' );



/***************************************************
:: Customize wp-login.php
***************************************************/
function custom_login_css() {
	echo "\n<style>";

	echo '.login h1 a { background-image: url("'.sq_option('logo','none').'");background-size: contain;min-height: 88px;width:auto;}';
	echo '#login {padding: 20px 0 0;}';
	echo '.login #nav a, .login #backtoblog a {color:'.sq_option('header_primary_color').'!important;text-shadow:none;}';

	echo "</style>\n";
}
add_action( 'login_enqueue_scripts', 'custom_login_css' );

function kleo_new_wp_login_url() { return home_url(); }
add_filter('login_headerurl', 'kleo_new_wp_login_url');

function kleo_new_wp_login_title() { return get_option('blogname'); }
add_filter('login_headertitle', 'kleo_new_wp_login_title');





if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function kleo_slug_render_title() {
        ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
    }
    add_action( 'wp_head', 'kleo_slug_render_title' );
}



if (!function_exists('kleo_wp_title')):
    /**
     * Creates a nicely formatted and more specific title element text
     * for output in head of document, based on current view.
     *
     * @since Kleo Framework 1.0
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string Filtered title.
     */
    function kleo_wp_title( $title, $sep )
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
            $title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'buddyapp' ), max( $paged, $page ) );
        }

        return $title;
    }
    if ( ! function_exists( '_wp_render_title_tag' ) ) {
        add_filter('wp_title', 'kleo_wp_title', 10, 2);
    }
endif;




if ( ! function_exists( 'kleo_the_attached_image' ) ) :
    /**
     * Print the attached image with a link to the next attached image.
     *
     * @since Kleo 1.0
     *
     * @return void
     */
    function kleo_the_attached_image() {
        $post = get_post();
        /**
         * Filter the default attachment size.
         *
         * @since Kleo 1.0
         *
         * @param array $dimensions {
         *     An array of height and width dimensions.
         *
         *     @type int $height Height of the image in pixels. Default 810.
         *     @type int $width  Width of the image in pixels. Default 810.
         * }
         */
        $attachment_size     = apply_filters( 'kleo_attachment_size', array( 810, 810 ) );
        $next_attachment_url = wp_get_attachment_url();

        /*
         * Grab the IDs of all the image attachments in a gallery so we can get the URL
         * of the next adjacent image in a gallery, or the first image (if we're
         * looking at the last image in a gallery), or, in a gallery of one, just the
         * link to that image file.
         */
        $attachment_ids = get_posts( array(
            'post_parent'    => $post->post_parent,
            'fields'         => 'ids',
            'numberposts'    => -1,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'ASC',
            'orderby'        => 'menu_order ID',
        ) );

        // If there is more than 1 attachment in a gallery...
        if ( count( $attachment_ids ) > 1 ) {
            foreach ( $attachment_ids as $attachment_id ) {
                if ( $attachment_id == $post->ID ) {
                    $next_id = current( $attachment_ids );
                    break;
                }
            }

            // get the URL of the next image attachment...
            if ( $next_id ) {
                $next_attachment_url = get_attachment_link( $next_id );
            }

            // or get the URL of the first image attachment.
            else {
                $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
            }
        }

        printf( '<a href="%1$s" rel="attachment">%2$s</a>',
            esc_url( $next_attachment_url ),
            wp_get_attachment_image( $post->ID, $attachment_size )
        );
    }
endif;



/***************************************************
:: Modal Ajax login && Modal Lost Password
 ***************************************************/


add_filter( 'kleo_theme_settings', 'kleo_login_settings' );

function kleo_login_settings( $kleo )
{
    //
    // Settings Sections
    //

    $kleo['sec']['kleo_section_login'] = array(
        'title' => esc_html__( 'Login redirect', 'buddyapp' ),
        'priority' => 16
    );

    $kleo['set'][] = array(
        'id' => 'login_redirect',
        'title' => esc_html__('Login page redirect', 'buddyapp'),
        'type' => 'select',
        'default' => 'default',
        'choices' => array( 'default' => 'Default', 'reload' => 'Reload', 'custom' => 'Custom link'),
        'section' => 'kleo_section_login',
        'description' => esc_html__('Default: WordPress default behaviour. Reload: will reload current page.', 'buddyapp'),
    );

    $kleo['set'][] = array(
        'id' => 'login_redirect_custom',
        'title' => esc_html__( 'Custom link redirect', 'buddyapp' ),
        'type' => 'text',
        'default' => '',
        'section' => 'kleo_section_login',
        'description' => wp_kses( __('Set a link like http://yoursite.com/homepage for users to get redirected on login.<br> ' .
            'For more complex redirect logic please set Login redirect to Default WordPress and use Peter\'s redirect plugin or similar.', 'buddyapp'), array( 'br' => array() ) ),
        'condition' => array( 'login_redirect', 'custom' )
    );


    return $kleo;

}

add_action( 'wp_footer', 'kleo_load_popups', 12 );

function kleo_load_popups() {
    get_template_part( 'page-parts/general-popups' );
}

add_action( 'init', 'kleo_ajax_login' );

if (! function_exists('kleo_ajax_login')){
    function kleo_ajax_login()
    {

        /* If not our action, bail out */
        if (! isset($_POST['action']) || ( isset($_POST['action']) && $_POST['action'] != 'kleoajaxlogin' ) ) {
            return false;
        }

        /* If user is already logged in print a specific message */
        if ( is_user_logged_in() ) {
            $link = "javascript:window.location.reload();return false;";
            echo json_encode(
                array(
                    'loggedin' => false,
                    'message' => '<i class="icon-info-outline"></i> ' .
                        wp_kses(
                            sprintf( __( 'You are already logged in. Please <a href="#" onclick="%s">refresh</a> page', 'buddyapp' ), $link ),
                            array( 'a' => array( 'href' => true, 'onclick' => true ) )
                        )
                )
            );
            die();
        }

        // Check the nonce, if it fails the function will break
        check_ajax_referer( 'kleo-ajax-login-nonce', 'security-login' );

        // Nonce is checked, continue
        $secure_cookie = '';

        // If the user wants ssl but the session is not ssl, force a secure cookie.
        if ( !empty($_POST['log']) && !force_ssl_admin() ) {
            $user_name = sanitize_user($_POST['log']);
            if ( $user = get_user_by('login', $user_name) ) {
                if ( get_user_option('use_ssl', $user->ID) ) {
                    $secure_cookie = true;
                    force_ssl_admin(true);
                }
            }
        }

        if ( isset( $_REQUEST['redirect_to'] ) ) {
            $redirect_to = $_REQUEST['redirect_to'];
            // Redirect to https if user wants ssl
            if ( $secure_cookie && false !== strpos($redirect_to, 'wp-admin') )
                $redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
        } else {
            $redirect_to = '';
        }

        $user_signon = wp_signon( '', $secure_cookie );
        if ( is_wp_error( $user_signon ) ) {
            $error_msg = $user_signon->get_error_message();
            echo json_encode(array( 'loggedin' => false, 'message' => '<span class="wrong-response"><i class="icon-warning"></i> ' . wp_kses_data( $error_msg ) . '</span>' ));
            //echo json_encode(array( 'loggedin' => false, 'message' => '<span class="wrong-response"><i class="icon-warning"></i> ' . esc_html__( 'Wrong username or password. Please try again.', 'buddyapp' ) . '</span>' ));
        } else {
            if ( sq_option( 'login_redirect' , 'default' ) == 'reload' ) {
                $redirecturl = NULL;
            } else {
                $requested_redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
                /**
                 * Filter the login redirect URL.
                 *
                 * @since 3.0.0
                 *
                 * @param string           $redirect_to           The redirect destination URL.
                 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
                 * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
                 */
                $redirecturl = apply_filters( 'login_redirect', $redirect_to, $requested_redirect_to, $user_signon );

            }

            echo json_encode(
                array(
                    'loggedin' => true,
                    'redirecturl' => $redirecturl,
                    'message'=> '<span class="good-response"><i class="icon-check"></i> ' .
                        esc_html__( 'Login successful, redirecting...', 'buddyapp' ) . '</span>'
                )
            );
        }

        die();
    }
}


if ( ! function_exists( 'kleo_lost_password_ajax' )) {
    function kleo_lost_password_ajax()
    {
        global $wpdb, $wp_hasher;

        $errors = new WP_Error();

        if ( isset($_POST) ) {

            // Check the nonce, if it fails the function will break
            check_ajax_referer( 'kleo-ajax-lost-pass-nonce', 'security_lost_pass' );

            if ( empty( $_POST['user_login'] ) ) {
                $errors->add(
                    'empty_username',
                    wp_kses_data( __( '<strong>ERROR</strong>: Enter a username or e-mail address.', 'default' ) )
                );
            } else if ( strpos( $_POST['user_login'], '@' ) ) {
                $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
                if ( empty( $user_data ) )
                    $errors->add(
                        'invalid_email',
                        wp_kses_data( __( '<strong>ERROR</strong>: There is no user registered with that email address.', 'default' ) )
                    );
            } else {
                $login = trim($_POST['user_login']);
                $user_data = get_user_by('login', $login);
            }

            /**
             * Fires before errors are returned from a password reset request.
             *
             * @since 2.1.0
             */
            do_action( 'lostpassword_post' );

            if ( $errors->get_error_code() ) {
                echo '<span class="wrong-response">' . $errors->get_error_message() . '</span>';
                die();
            }

            if ( !$user_data ) {
                $errors->add(
                    'invalidcombo', wp_kses_data( __( '<strong>ERROR</strong>: Invalid username or e-mail.', 'default' ) )
                );
                echo '<span class="wrong-response">' . $errors->get_error_message() . '</span>';
                die();
            }

            // Redefining user_login ensures we return the right case in the email.
            $user_login = $user_data->user_login;
            $user_email = $user_data->user_email;

            /**
             * Fires before a new password is retrieved.
             *
             * @since 1.5.0
             * @deprecated 1.5.1 Misspelled. Use 'retrieve_password' hook instead.
             *
             * @param string $user_login The user login name.
             */
            do_action( 'retreive_password', $user_login );

            /**
             * Fires before a new password is retrieved.
             *
             * @since 1.5.1
             *
             * @param string $user_login The user login name.
             */
            do_action( 'retrieve_password', $user_login );

            /**
             * Filter whether to allow a password to be reset.
             *
             * @since 2.7.0
             *
             * @param bool true           Whether to allow the password to be reset. Default true.
             * @param int  $user_data->ID The ID of the user attempting to reset a password.
             */
            $allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

            if ( ! $allow ) {
                echo '<span class="wrong-response">' . esc_html__( 'Password reset is not allowed for this user', 'default' ) . '</span>';
                die();
            }
            else if ( is_wp_error($allow) ) {
                echo '<span class="wrong-response">' . $allow->get_error_message() . '</span>';
                die();
            }

            // Generate something random for a password reset key.
            $key = wp_generate_password( 20, false );

            /**
             * Fires when a password reset key is generated.
             *
             * @since 2.5.0
             *
             * @param string $user_login The username for the user.
             * @param string $key        The generated password reset key.
             */
            do_action( 'retrieve_password_key', $user_login, $key );

            // Now insert the key, hashed, into the DB.
            if ( empty( $wp_hasher ) ) {
                require_once ABSPATH . WPINC . '/class-phpass.php';
                $wp_hasher = new PasswordHash( 8, true );
            }
            $hashed = time() . ':' . $wp_hasher->HashPassword( $key );
            $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

            $message = esc_html__( 'Someone requested that the password be reset for the following account:', 'default' ) . "\r\n\r\n";
            $message .= network_home_url( '/' ) . "\r\n\r\n";
            $message .= sprintf( esc_html__( 'Username: %s', 'default' ), $user_login ) . "\r\n\r\n";
            $message .= esc_html__('If this was a mistake, just ignore this email and nothing will happen.', 'default' ) . "\r\n\r\n";
            $message .= esc_html__('To reset your password, visit the following address:', 'default') . "\r\n\r\n";
            $message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login' ) . ">\r\n";

            if ( is_multisite() )
                $blogname = $GLOBALS['current_site']->site_name;
            else
                /*
                 * The blogname option is escaped with esc_html on the way into the database
                 * in sanitize_option we want to reverse this for the plain text arena of emails.
                 */
                $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

            $title = sprintf( esc_html__('[%s] Password Reset', 'default'), $blogname );

            /**
             * Filter the subject of the password reset email.
             *
             * @since 2.8.0
             *
             * @param string $title Default email title.
             */
            $title = apply_filters( 'retrieve_password_title', $title );
            /**
             * Filter the message body of the password reset mail.
             *
             * @since 2.8.0
             *
             * @param string $message Default mail message.
             * @param string $key     The activation key.
             */
            $message = apply_filters( 'retrieve_password_message', $message, $key );


            if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
                echo '<span class="wrong-response">' . esc_html__( "Failure!", 'buddyapp' );
                echo esc_html__( 'The e-mail could not be sent.', 'default' );
                echo "</span>";
                die();
            } else {
                echo '<span class="good-response">' . esc_html__( "Email successfully sent!", 'buddyapp' )."</span>";
                die();
            }
        }
        die();
    }
}
add_action("wp_ajax_kleo_lost_password","kleo_lost_password_ajax");
add_action('wp_ajax_nopriv_kleo_lost_password', 'kleo_lost_password_ajax');



/***************************************************
:: Custom redirect from Theme options - Login redirect
 ***************************************************/

if ( sq_option( 'login_redirect', 'default' ) == 'custom' && sq_option( 'login_redirect_custom', '' ) != '' ) {
    add_filter( 'login_redirect', 'kleo_custom_redirect', 12, 3 );
}

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $requested_redirect_to URL for redirect
 * @param object $user Logged user's data.
 * @return string
 */
function kleo_custom_redirect( $redirect_to, $requested_redirect_to, $user  ) {
    if ( ($requested_redirect_to == ''|| $requested_redirect_to != home_url() ) && ! is_wp_error( $user ) ) {
        $redirect_to = sq_option( 'login_redirect_custom', '' );
        $redirect_to = str_replace( '##member_name##', $user->user_login, $redirect_to );
    }
    return $redirect_to;
}

// -----------------------------------------------------------------------------
