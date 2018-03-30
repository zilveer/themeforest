<?php

/**
 * Class and Function List:
 * Function list:
 * - init()
 * - constants()
 * - widgets()
 * - supports()
 * - functions()
 * - language()
 * - add_metaboxes()
 * - admin()
 * - admin_menus()
 * - _load_demo_content_page()
 * - post_types()
 * - theme_enqueue_scripts()
 * - mk_preloader_script()
 * Classes list:
 * - Theme
 */
$theme = new Theme();
$theme->init(array(
    "theme_name" => "Ken",
    "theme_slug" => "TK",
));

class Theme
{
    function init($options) {
        $this->constants($options);
        $this->functions();
        $this->post_types();
        $this->admin();
        
        add_action('init', array(&$this,
            'language'
        ));
        
        add_action('init', array(&$this,
            'add_metaboxes',
        ));
        
        add_action('after_setup_theme', array(&$this,
            'supports',
        ));
        add_action('widgets_init', array(&$this,
            'widgets',
        ));
        
        add_action('admin_menu', array(&$this,
            'admin_menus'
        ));
    }
    
    function constants($options) {
        define("THEME_DIR", get_template_directory());
        define("THEME_DIR_URI", get_template_directory_uri());
        define("THEME_NAME", $options["theme_name"]);

        define("THEME_OPTIONS_BUILD", $options["theme_name"] . '_options_build');
        define("THEME_SLUG", $options["theme_slug"]);
        define("THEME_STYLES", THEME_DIR_URI . "/stylesheet/css");
        define("THEME_IMAGES", THEME_DIR_URI . "/images");
        define("THEME_JS", THEME_DIR_URI . "/js");
        define("THEME_FRAMEWORK", THEME_DIR . "/framework");
        define("THEME_CONTROL_PANEL", THEME_FRAMEWORK . "/control-panel");
        define('THEME_CONTROL_PANEL_ASSETS', THEME_DIR_URI . '/framework/control-panel/assets');
        define("THEME_PHP", THEME_FRAMEWORK . "/php");
        define("THEME_ACTIONS", THEME_FRAMEWORK . "/actions");
        define("THEME_INCLUDES", THEME_FRAMEWORK . "/includes");
        define("THEME_INCLUDES_URI", THEME_DIR_URI . "/framework/includes");
        define('THEME_METABOXES', THEME_PHP . '/metaboxes');
        define('THEME_POST_TYPES', THEME_PHP . '/post-types');
        define('THEME_ADMIN_URI', THEME_DIR_URI . '/framework');
        define('THEME_ADMIN_ASSETS_URI', THEME_DIR_URI . '/framework/assets');
    }
    
    function widgets() {
        
        require_once locate_template("widgets/widgets-contact-form.php");
        require_once locate_template("widgets/widgets-contact-info.php");
        require_once locate_template("widgets/widgets-gmap.php");
        require_once locate_template("widgets/widgets-popular-posts.php");
        require_once locate_template("widgets/widgets-related-posts.php");
        require_once locate_template("widgets/widgets-recent-posts.php");
        require_once locate_template("widgets/widgets-social-networks.php");
        require_once locate_template("widgets/widgets-subnav.php");
        require_once locate_template("widgets/widgets-testimonials.php");
        require_once locate_template("widgets/widgets-twitter-feeds.php");
        require_once locate_template("widgets/widgets-video.php");
        require_once locate_template("widgets/widgets-flickr-feeds.php");
        require_once locate_template("widgets/widgets-recent-portfolio.php");
        require_once locate_template("widgets/widgets-comments.php");
        require_once locate_template("widgets/widgets-tiny-slider.php");
        require_once locate_template("widgets/widgets-instagram.php");
        require_once locate_template("widgets/widgets-login-form.php");
        require_once locate_template("widgets/widgets-blog-tab.php");
        require_once locate_template("widgets/widgets-custom-menu.php");
        require_once locate_template("widgets/widgets-subscription.php");
        
        register_widget("Artbees_Widget_Popular_Posts");
        register_widget("Artbees_Widget_Recent_Posts");
        register_widget("Artbees_Widget_Related_Posts");
        register_widget("Artbees_Widget_Twitter");
        register_widget("Artbees_Widget_Contact_Form");
        register_widget("Artbees_Widget_Contact_Info");
        register_widget("Artbees_Widget_Social");
        register_widget("Artbees_Widget_Sub_Navigation");
        register_widget("Artbees_Widget_Google_Map");
        register_widget("Artbees_Widget_Testimonials");
        register_widget("Artbees_Widget_Video");
        register_widget("Artbees_Widget_Flickr_Feeds");
        register_widget("Artbees_Widget_Recent_Portfolio");
        register_widget("Artbees_WP_Widget_Recent_Comments");
        register_widget("Artbees_Widget_Tiny_Slider");
        register_widget("Artbees_Widget_Instagram_Feeds");
        register_widget("Artbees_Widget_Login_Form");
        register_widget("Artbees_Widget_Blog_Tab");
        register_widget("Artbees_WP_Nav_Menu_Widget");
        register_widget("Artbees_Widget_Subscription_Form");
    }
    
    function supports() {
        global $mk_settings;
        
        if (!isset($content_width)) {
            $content_width = isset($mk_settings['grid-width']) ? $mk_settings['grid-width'] : 1140;
        }
        
        if (function_exists('add_theme_support')) {
            add_theme_support('menus');
            add_theme_support('automatic-feed-links');
            add_theme_support('editor-style');
            
            /* Add Woocmmerce support */
            add_theme_support('woocommerce');
            
            add_theme_support('post-formats', array(
                'image',
                'gallery',
                'video',
                'audio',
                'quote',
                'link'
            ));
            register_nav_menus(array(
                'primary-menu' => 'Primary Navigation',
                'second-menu' => 'Second Navigation',
                'third-menu' => 'Third Navigation',
                'fourth-menu' => 'Fourth Navigation',
                'fifth-menu' => 'Fifth Navigation',
                'sixth-menu' => 'Sixth Navigation',
                'seventh-menu' => 'Seventh Navigation',
            ));
            
            add_theme_support('post-thumbnails');
        }
    }
    
    function functions() {
        require_once (THEME_PHP . '/ReduxCore/framework.php');
        require_once (THEME_PHP . '/ReduxCore/options-config.php');
        
        require_once THEME_PHP . "/general.php";
        require_once THEME_PHP . "/schema-markup.php";
        require_once THEME_PHP . "/send-mail.php";
        require_once THEME_PHP . "/helper.php";
        require_once THEME_PHP . "/woocommerce.php";
        require_once THEME_INCLUDES . "/ajax-search.php";
        
        require_once (THEME_INCLUDES . "/vc-integration.php");
        
        require_once THEME_INCLUDES . "/wp-nav-custom-walker.php";
        require_once THEME_PHP . '/sidebar-generator.php';
        require_once THEME_INCLUDES . "/pagination.php";
        require_once THEME_INCLUDES . "/image-cropping.php";
        require_once THEME_INCLUDES . "/tgm-plugin-activation/request-plugins.php";
        
        require_once THEME_INCLUDES . "/love-this.php";
        require_once THEME_PHP . "/dynamic-styles.php";
        //require_once THEME_PHP . "/theme-skin.php";
        
        require_once THEME_DIR . "/wpml-fix/mk-wpml.php";
        require_once THEME_POST_TYPES . '/portfolio.php';
        
        /*
        Theme elements hooks
        */
        require_once locate_template("framework/actions/header.php");
        require_once locate_template("framework/actions/posts.php");
        require_once locate_template("framework/actions/general.php");
        
        /* Portfolio styles */
        require_once locate_template("portfolio-styles/masonry.php");
        require_once locate_template("portfolio-styles/grid.php");
        require_once locate_template("portfolio-styles/flip.php");
        require_once locate_template("portfolio-styles/scroller.php");
        require_once locate_template("portfolio-styles/standard.php");
        require_once locate_template("portfolio-styles/ajax-portfolio.php");
        
        /* Blog Styles @since V1.0 */
        require_once locate_template("blog-styles/classic.php");
        require_once locate_template("blog-styles/masonry.php");
        
        /* Blog Styles @since V1.4 */
        require_once locate_template("blog-styles/list.php");
        require_once locate_template("blog-styles/magazine.php");
        require_once locate_template("blog-styles/thumb.php");
        require_once locate_template("blog-styles/tile.php");
        require_once locate_template("blog-styles/scroller.php");
        require_once locate_template("blog-styles/slideshow.php");
        require_once locate_template("blog-styles/modern.php");

    }
    
    function language() {
        load_theme_textdomain('mk_framework', get_stylesheet_directory() . '/languages');
    }
    
    function add_metaboxes() {
        require_once THEME_PHP . '/metabox-generator.php';
        require_once THEME_METABOXES . '/metabox-layout.php';
        require_once THEME_METABOXES . '/metabox-posts.php';
        require_once THEME_METABOXES . '/metabox-portfolios.php';
        require_once THEME_METABOXES . '/metabox-testimonials.php';
        require_once THEME_METABOXES . '/metabox-employee.php';
        require_once THEME_METABOXES . '/metabox-pages.php';
        require_once THEME_METABOXES . '/metabox-clients.php';
        require_once THEME_METABOXES . '/metabox-pricing.php';
        require_once THEME_METABOXES . '/metabox-edge.php';
        require_once THEME_METABOXES . '/metabox-tab-slider.php';
        include_once THEME_METABOXES . '/metabox-skinning.php';
        include_once THEME_METABOXES . '/metabox-animated-columns.php';
        include_once THEME_METABOXES . '/metabox-footer-widgets.php';
    }
    
    function admin() {
        if (is_admin()) {
            
            require_once THEME_PHP . '/admin.php';
            require_once THEME_INCLUDES . '/mega-menu.php';
            
            require_once (THEME_CONTROL_PANEL . "/logic/functions.php");
        }
    }


    function admin_menus() {

        add_menu_page(THEME_NAME, THEME_NAME, 'edit_posts', THEME_NAME, array(&$this,
            'theme_register'
        ) , 'dashicons-star-filled', 3);
        add_submenu_page(THEME_NAME, __('Register Product', 'mk_framework') , __('Register Product', 'mk_framework') , 'edit_theme_options', THEME_NAME, array(&$this,
            'theme_register'
        ));
        add_submenu_page(THEME_NAME, __('Support', 'mk_framework') , __('Support', 'mk_framework') , 'edit_posts', 'theme-support', array(&$this,
            'theme_support'
        ));
        add_submenu_page(THEME_NAME, __('Install Templates', 'mk_framework') , __('Install Templates', 'mk_framework') , 'edit_theme_options', 'theme-templates', array(&$this,
            'theme_templates'
        ));
        add_submenu_page(THEME_NAME, __('System Status', 'mk_framework') , __('System Status', 'mk_framework') , 'edit_theme_options', 'theme-status', array(&$this,
            'theme_status'
        ));
        add_submenu_page(THEME_NAME, __('Icon Library', 'mk_framework') , __('Icon Library', 'mk_framework') , 'edit_posts', 'icon-library', array(&$this,
            'icon_library'
        ));
    }
    
    function theme_options() {
        $page = include_once (THEME_ADMIN . '/theme-options/masterkey.php');
        new Mk_Options_Framework($page['options']);
    }
    function icon_library() {
        require_once THEME_PHP . '/icon-library.php';
    }
    
    function theme_status() {
        include_once (THEME_CONTROL_PANEL . '/logic/theme-status.php');
    }
    
    
    function theme_templates() {
        include_once (THEME_CONTROL_PANEL . '/logic/theme-templates.php');
    }
    
    function theme_support() {
        include_once (THEME_CONTROL_PANEL . '/logic/theme-support.php');
    }
    
    function theme_register() {
        include_once (THEME_CONTROL_PANEL . '/logic/theme-register.php');
    }
    
    function post_types() {
        require_once THEME_POST_TYPES . '/testimonials.php';
        require_once THEME_POST_TYPES . '/employee.php';
        require_once THEME_POST_TYPES . '/pricing.php';
        require_once THEME_POST_TYPES . '/clients.php';
        require_once THEME_POST_TYPES . '/edge-slider.php';
        require_once THEME_POST_TYPES . '/tab-slider.php';
        require_once THEME_POST_TYPES . '/animated-columns.php';
    }
}

function theme_enqueue_scripts() {
    if (!is_admin()) {
        
        global $mk_settings;
        $theme_data = wp_get_theme("ken");
        
        wp_enqueue_script('jquery-ui-tabs');
        wp_register_script('jquery-jplayer', THEME_JS . '/jquery.jplayer.min.js', array(
            'jquery'
        ) , $theme_data['Version'], true);
        wp_register_script('instafeed', THEME_JS . '/instafeed.min.js', array(
            'jquery'
        ) , $theme_data['Version'], true);
        wp_enqueue_script('skrollr', THEME_JS . '/skrollr-min.js', array(
            'jquery'
        ) , $theme_data['Version'], true);
        
        if ($mk_settings['smooth-scroll']) {
            wp_enqueue_script('smoothScroll', THEME_JS . '/jquery.nicescroll.js', array(
                'jquery'
            ) , $theme_data['Version'], true);
        }
        
        if ($mk_settings['smooth-scroll'] == 1) {
            wp_enqueue_script('SmoothScroll', THEME_JS . '/SmoothScroll.js', array(
                'jquery'
            ) , $theme_data['Version'], true);
        }
        
        if ($mk_settings['minify-js']) {
            wp_enqueue_script('theme-plugins-min', THEME_JS . '/min/plugins-ck.js', array(
                'jquery'
            ) , $theme_data['Version'], true);
            wp_enqueue_script('theme-scripts-min', THEME_JS . '/min/theme-scripts-ck.js', array(
                'jquery'
            ) , $theme_data['Version'], true);
        } 
        else {
            wp_enqueue_script('theme-plugins', THEME_JS . '/plugins.js', array(
                'jquery'
            ) , $theme_data['Version'], true);
            wp_enqueue_script('theme-scripts', THEME_JS . '/theme-scripts.js', array(
                'jquery'
            ) , $theme_data['Version'], true);
        }
        
        $custom_js_file = get_stylesheet_directory() . '/custom.js';
        $custom_js_file_uri = get_stylesheet_directory_uri() . '/custom.js';
        
        if (file_exists($custom_js_file)) {
            wp_enqueue_script('custom-js', $custom_js_file_uri, array(
                'jquery'
            ) , $theme_data['Version'], true);
        }
        
        if (is_singular()) {
            wp_enqueue_script('comment-reply');
        }
        $css_min = (isset($mk_settings['minify-css']) && $mk_settings['minify-css'] == 1) ? '.min' : '';
        wp_enqueue_style('theme-styles', THEME_STYLES . '/styles' . $css_min . '.css', false, $theme_data['Version'], 'all');
        wp_enqueue_style('theme-icons', THEME_STYLES . '/theme-font-icons' . $css_min . '.css', false, $theme_data['Version'], 'all');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts', 1);

function mk_preloader_script() {
    
    if (!global_get_post_id()) {
        return false;
    }
    
    $preloader = get_post_meta(global_get_post_id() , '_preloader', true);
    
    if ($preloader == 'true') {
        wp_enqueue_script('QueryLoader', THEME_JS . '/jquery.queryloader2-min.js', array(
            'jquery'
        ) , false, false);
    }
}

add_action('wp_enqueue_scripts', 'mk_preloader_script', 1);
