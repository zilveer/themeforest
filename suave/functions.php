<?php

/**
 * CommerceGurus functions and definitions
 * Maybe your best course would be to tread lightly.
 *
 * @package commercegurus
 */
global $cg_options;


/**
 * Global Paths
 */
define( 'CG_FILEPATH', get_template_directory() );
define( 'CG_THEMEURI', get_template_directory_uri() );
define( 'CG_BOOTSTRAP_JS', get_template_directory_uri() . '/inc/core/bootstrap/dist/js' );
define( 'CG_JS', get_template_directory_uri() . '/js' );
define( 'CG_CORE', get_template_directory() . '/inc/core' );


/**
 * Constants for Plugins
 */
define( 'ULTIMATE_USE_BUILTIN', true );


/**
 * Load Globals
 */
require_once(CG_CORE . '/functions/javascript.php');
require_once(CG_CORE . '/functions/get-the-image.php');
require_once(CG_CORE . '/menus/wp_bootstrap_navwalker.php');
require_once(CG_CORE . '/menus/megadropdown.php');


/**
 * TGM Plugin Activation
 */
require_once (CG_CORE . '/functions/class-tgm-plugin-activation-enhanced.php');
//require_once (CG_CORE . '/functions/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'cg_register_required_plugins' );

function cg_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'Advanced Custom Fields', // The plugin name
            'slug' => 'advanced-custom-fields', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'Advanced Sidebar Menu', // The plugin name
            'slug' => 'advanced-sidebar-menu', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'Redux Framework', // The plugin name
            'slug' => 'redux-framework', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),        
        array(
            'name' => 'CommerceGurus Toolkit', // The plugin name
            'slug' => 'commercegurus-toolkit', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/commercegurus-toolkit.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Contact Form 7', // The plugin name
            'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'Layer Slider', // The plugin name
            'slug' => 'LayerSlider', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/layersliderwp-5.6.9.installable.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '5.6.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Regenerate Thumbnails', // The plugin name
            'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'required' => true,
        ),
        array(
            'name' => 'WooCommerce Quantity Increment',
            'slug' => 'woocommerce-quantity-increment',
            'required' => true,
        ),
        array(
            'name' => 'WooSidebars', // The plugin name
            'slug' => 'woosidebars', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'WPBakery Visual Composer', // The plugin name
            'slug' => 'js_composer', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/js_composer.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'YITH WooCommerce Ajax Navigation', // The plugin name
            'slug' => 'yith-woocommerce-ajax-navigation', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'YITH WooCommerce Ajax Search', // The plugin name
            'slug' => 'yith-woocommerce-ajax-search', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'YITH WooCommerce Wishlist', // The plugin name
            'slug' => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => 'commercegurus', // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug' => 'themes.php', // Default parent menu slug
        'parent_url_slug' => 'themes.php', // Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __( 'Install Required Plugins', '' ),
            'menu_title' => __( 'Install Plugins', 'commercegurus' ),
            'installing' => __( 'Installing Plugin: %s', 'commercegurus' ), // %1$s = plugin name
            'oops' => __( 'Something went wrong with the plugin API.', 'commercegurus' ),
            'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return' => __( 'Return to Required Plugins Installer', 'commercegurus' ),
            'plugin_activated' => __( 'Plugin activated successfully.', 'commercegurus' ),
            'complete' => __( 'All plugins installed and activated successfully. %s', 'commercegurus' ), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );
}


/**
 * Demo Data Installer
 */
require get_template_directory() . '/inc/radium-one-click-demo-install/init.php';


/**
 * Live Preview
 */
//$cg_live_preview = true;

if ( isset( $cg_live_preview ) ) {

    add_action( 'after_setup_theme', 'start_live_session', 1 );
    add_action( 'wp_logout', 'end_live_session' );
    add_action( 'wp_login', 'end_live_session' );

    //start live session
    if ( !function_exists( 'start_live_session' ) ) {

        function start_live_session() {
            if ( !session_id() ) {
                session_start();
            }
        }

    }

    //end live session 
    if ( !function_exists( 'end_live_session' ) ) {

        function end_live_session() {
            session_destroy();
        }

    }
}


/**
 * Load CSS
 */
function load_cg_styles() {
    global $cg_live_preview, $cg_options;

    $cg_responsive_status = '';

    if ( isset( $cg_options['cg_responsive'] ) ) {
        $cg_responsive_status = $cg_options['cg_responsive'];
    }

    wp_register_style( 'cg-bootstrap', get_template_directory_uri() . '/inc/core/bootstrap/dist/css/bootstrap.min.css' );
    wp_register_style( 'cg-commercegurus', get_template_directory_uri() . '/css/commercegurus.css' );

    if ( $cg_responsive_status !== 'disabled' ) {
        wp_register_style( 'cg-responsive', get_template_directory_uri() . '/css/responsive.css' );
    }
 
    if ( $cg_responsive_status == 'disabled' ) {
        wp_register_style( 'cg-non-responsive', get_template_directory_uri() . '/css/non-responsive.css' );
    }

    wp_enqueue_style( 'cg-style', get_stylesheet_uri() );
    wp_enqueue_style( 'cg-font-awesome', get_template_directory_uri() . '/css/font-awesome/font-awesome.min.css' );
    wp_enqueue_style( 'cg-bootstrap' );
    wp_enqueue_style( 'cg-commercegurus' );

    if ( $cg_responsive_status !== 'disabled' ) {
        wp_enqueue_style( 'cg-responsive' );
    }

    if ( $cg_responsive_status == 'disabled' ) {
        wp_enqueue_style( 'cg-non-responsive' );
    }
        
    if ( isset( $cg_live_preview ) ) {
        wp_enqueue_style( 'cg-livepreviewcss', get_template_directory_uri() . '/css/livepreview.css' );
    }

    $vc_plugin_version =  get_plugin_version( 'WPBakery Visual Composer' );

    if ( version_compare( $vc_plugin_version , "4.8.1", ">")) { 
        wp_enqueue_style( 'cg-vccss', get_template_directory_uri() . '/css/vc.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'load_cg_styles' );

// Load css from theme options.
require_once( CG_CORE . '/css/custom-css.php' );


/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
    vc_set_as_theme( $disable_updater = true );

    // Disable frontend editor by default - to re-enable just comment out the next line
    vc_disable_frontend();
}

// Initialising Shortcodes
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

    function requireVcExtend() {
        require_once locate_template( '/customvc/vc_extend.php' );
    }

    add_action( 'init', 'requireVcExtend', 2 );

    // Set VC tpl override directory
    $vcdir = get_stylesheet_directory() . '/customvc/vc_templates/';
    vc_set_shortcodes_templates_dir( $vcdir );

    // Remove VC nag looking for key - CommerceGurus has an extended lic.
    if ( is_admin() ) {
            function cg_remove_vc_nag() {
                setcookie( 'vchideactivationmsg_vc11', ( defined( 'WPB_VC_VERSION' ) ? WPB_VC_VERSION : '1' ), strtotime( '+3 years' ), '/' );
            }
            add_action( 'init', 'cg_remove_vc_nag' );
    }
}

// Remove certain custom post types from the CG Toolkit
if ( ! function_exists( 'cg_unregister_projects' ) ) :
function cg_unregister_projects() {
    global $wp_post_types;
    if ( isset( $wp_post_types[ 'project' ] ) ) {
        unset( $wp_post_types[ 'project' ] );
        return true;
    }
    return false;
}
endif;

add_action( 'init', 'cg_unregister_projects', 100 );


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
if ( !function_exists( 'cg_setup' ) ) :

    function cg_setup() {

        /**
         * Translations can be filed in the /languages/ directory
         * If you're building a theme based on a commercegurus theme, use a find and replace
         * to change 'commercegurus' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'commercegurus', get_template_directory() . '/languages' );
        
        /**
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support( 'automatic-feed-links' );

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'commercegurus' ),
            'mobile' => __( 'Mobile Menu', 'commercegurus' ),
        ) );

        /**
         * Custom Thumbnails
         */
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-thumbnails' );
            add_image_size( 'hp-latest-posts', 380, 160, true );
            add_image_size( 'showcase-page', 750, 450, true ); // Showcase Page thumbnail
            add_image_size( 'showcase-4col', 293, 186, true ); // Showcase 4Col thumbnail
            add_image_size( 'showcase-3col', 360, 234, true ); // Showcase 3Col thumbnail
            add_image_size( 'showcase-2col', 585, 431, true ); // Showcase 2Col thumbnail
            add_image_size( 'product-category-banner', 1200, 300, true );
        }

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
    
        /**
         * Enable support for Post Formats
         */
        add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link' ) );

        /**
         * Setup the WordPress core custom background feature.
         */
        //add_theme_support( 'custom-background', apply_filters( 'cg_custom_background_args', array(
        //  'default-color' => 'ffffff',
        //  'default-image' => '',
        //) ) );
    }

endif; // cg_setup
add_action( 'after_setup_theme', 'cg_setup' );


/**
 * Add Redux Framework
 */
require get_template_directory() . '/admin/admin-init.php';


/**
 * Set WooCommerce image dimensions upon activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
    add_action( 'init', 'cg_woocommerce_image_dimensions', 1 );


/**
 * Define image sizes
 */
function cg_woocommerce_image_dimensions() {
    $catalog = array(
        'width' => '220', // px
        'height' => '286', // px
        'crop' => 1        // true
    );

    $single = array(
        'width' => '500', // px
        'height' => '650', // px
        'crop' => 1        // true
    );

    $thumbnail = array(
        'width' => '120', // px
        'height' => '155', // px
        'crop' => 1        // false
    );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    update_option( 'shop_single_image_size', $single );         // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cg_widgets_init() {

    register_sidebar( array(
        'name' => __( 'Sidebar', 'commercegurus' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Top Toolbar - Left', 'commercegurus' ),
        'id' => 'top-bar-left',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Top Toolbar - Right', 'commercegurus' ),
        'id' => 'top-bar-right',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Mobile Search', 'commercegurus' ),
        'id' => 'mobile-search',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Search', 'commercegurus' ),
        'id' => 'header-search',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Shop Sidebar', 'commercegurus' ),
        'id' => 'shop-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Below main body', 'commercegurus' ),
        'id' => 'below-body',
        'before_widget' => '<div class="row"><div id="%1$s" class="col-lg-12 %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'First Footer', 'commercegurus' ),
        'id' => 'first-footer',
        'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-nr-3 %2$s"><div class="inner-widget-wrap">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Second Footer', 'commercegurus' ),
        'id' => 'second-footer',
        'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-nr-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
}

add_action( 'widgets_init', 'cg_widgets_init' );

// Remove Woocommerce prettyPhoto as we use our own responsive lightbox - if this option is enabled in Theme Options

$cg_wc_lightbox = '';

if ( isset( $cg_options['cg_wc_lightbox'] ) ) {
    $cg_wc_lightbox = $cg_options['cg_wc_lightbox'];
}

if ( $cg_wc_lightbox !== 'no' ) {

    add_action( 'wp_enqueue_scripts', 'cg_remove_wc_lightbox', 99 );

    function cg_remove_wc_lightbox() {
        wp_dequeue_script( 'prettyPhoto-init' );
    }
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/* WooCommerce */

/* ----------------------------------------------------------------------------------- */
/* Start WooThemes Functions - Please refrain from editing this section */
/* ----------------------------------------------------------------------------------- */

// Custom function to check if WooCommerce is active - support for WPMU

if ( ! function_exists( 'is_wc_active' ) ) {
    function is_wc_active() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
}

// Custom function to check if WooCommerce is active - support for WPMU

if ( !function_exists( 'is_wc_active' ) ) {

    function is_wc_active() {
        if ( class_exists( 'woocommerce' ) ) {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * Load WooCommerce Config.
 */
if ( is_wc_active() ) {
    require get_template_directory() . '/inc/woocommerce/hooks.php';
    require get_template_directory() . '/inc/woocommerce/functions.php';
}

// Custom function to check if WooCommerce is active and is the shop page

if ( ! function_exists( 'is_wc_shop' ) ) {
    function is_wc_shop() {
        if ( class_exists( 'woocommerce' ) ) { 
            if ( is_shop() ) {
                return true;    
            } else {
                return false;
            }
        } else { 
            return false; 
        }
    }
}


// Register Support
add_theme_support( 'woocommerce' );

// Set path to WooFramework and theme specific functions
$woocommerce_path = get_template_directory() . '/woocommerce/';

// WooCommerce
if ( function_exists( "is_woocommerce" ) ) {
    require_once ( $woocommerce_path . 'woocommerce-config.php' );    //woocommerce shop plugin    
}

/**
 * Change PayPal icon to a png
 */
function cg_custom_paypal_icon( $iconUrl ) {
    return 'https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png'; // change this to your image url or uploaded WordPress image url.
}
 
add_filter('woocommerce_paypal_icon', 'cg_custom_paypal_icon');


/**
 * Remove WooCommerce breadcrumbs and replace with Yoast
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) )
    $content_width = 640; /* pixels */


// get plugin version

function get_plugin_version( $plugin_name ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    $plugins = get_plugins();
    foreach( $plugins as $plugin_info ) {
        if ( $plugin_info['Name'] == $plugin_name ) return $plugin_info['Version'];
    }
    return null;
}

// End of core functions.