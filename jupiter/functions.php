<?php
$theme = new Theme(true);
$theme->init(array(
    "theme_name" => "Jupiter",
    "theme_slug" => "JP",
));

if (!isset($content_width))
{
    $content_width = 1140;
}

class Theme
{

    public function __construct($check = false)
    {
        if ($check)
        {
            $this->theme_requirement_check();
        }
    }

    public function init($options)
    {
        $this->constants($options);
        $this->post_types();
        $this->functions();
        $this->helpers();
        $this->menu_walkers();
        $this->admin();
        $this->theme_activated();

        add_action('admin_menu', array(&$this,
            'admin_menus',
        ));

        add_action('init', array(&$this,
            'language',
        ));

        add_action('init', array(&$this,
            'add_metaboxes',
        ));

        add_action('after_setup_theme', array(&$this,
            'supports',
        ));

        add_action('after_setup_theme', array(&$this,
            'mk_theme_setup',
        ));

        add_action('widgets_init', array(&$this,
            'widgets',
        ));

    }

    public function constants($options)
    {
        define("THEME_DIR", get_template_directory());
        define("THEME_DIR_URI", get_template_directory_uri());
        define("THEME_NAME", $options["theme_name"]);

        $unify_theme_option = get_option('mk_unify_theme_options');

        if (defined("ICL_LANGUAGE_CODE") && !$unify_theme_option)
        {
            $lang = "_" . ICL_LANGUAGE_CODE;
        }
        else
        {
            $lang = "";
        }

        /* Use this constant in child theme functions.php to unify theme options across all languages in WPML
         *  add define('WPML_UNIFY_THEME_OPTIONS', true);
         */
        if (defined('WPML_UNIFY_THEME_OPTIONS'))
        {
            $lang = "";
        }

        define("THEME_OPTIONS", $options["theme_name"] . '_options' . $lang);

        define("THEME_OPTIONS_BUILD", $options["theme_name"] . '_options_build' . $lang);
        define("IMAGE_SIZE_OPTION", THEME_NAME . '_image_sizes');
        define("THEME_SLUG", $options["theme_slug"]);
        define("THEME_STYLES_SUFFIX", "/assets/stylesheet");
        define("THEME_STYLES", THEME_DIR_URI . THEME_STYLES_SUFFIX);
        define("THEME_JS", THEME_DIR_URI . "/assets/js");
        define("THEME_IMAGES", THEME_DIR_URI . "/assets/images");
        define('FONTFACE_DIR', THEME_DIR . '/fontface');
        define('FONTFACE_URI', THEME_DIR_URI . '/fontface');
        define("THEME_FRAMEWORK", THEME_DIR . "/framework");
        define("THEME_COMPONENTS", THEME_DIR_URI . "/components");
        define("THEME_ACTIONS", THEME_FRAMEWORK . "/actions");
        define("THEME_INCLUDES", THEME_FRAMEWORK . "/includes");
        define("THEME_INCLUDES_URI", THEME_DIR_URI . "/framework/includes");
        define("THEME_WIDGETS", THEME_FRAMEWORK . "/widgets");
        define("THEME_HELPERS", THEME_FRAMEWORK . "/helpers");
        define("THEME_FUNCTIONS", THEME_FRAMEWORK . "/functions");
        define("THEME_PLUGIN_INTEGRATIONS", THEME_FRAMEWORK . "/plugin-integrations");
        define('THEME_METABOXES', THEME_FRAMEWORK . '/metaboxes');
        define('THEME_POST_TYPES', THEME_FRAMEWORK . '/custom-post-types');

        define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
        define('THEME_FIELDS', THEME_ADMIN . '/theme-options/builder/fields');
        define('THEME_CONTROL_PANEL', THEME_ADMIN . '/control-panel');
        define('THEME_CONTROL_PANEL_ASSETS', THEME_DIR_URI . '/framework/admin/control-panel/assets');
        define('THEME_GENERATORS', THEME_ADMIN . '/generators');
        define('THEME_ADMIN_URI', THEME_DIR_URI . '/framework/admin');
        define('THEME_ADMIN_ASSETS_URI', THEME_DIR_URI . '/framework/admin/assets');
    }
    public function widgets()
    {
        include_once THEME_FUNCTIONS . '/widgets-filter.php';
        require_once locate_template("views/widgets/widgets-contact-form.php");
        require_once locate_template("views/widgets/widgets-contact-info.php");
        require_once locate_template("views/widgets/widgets-gmap.php");
        require_once locate_template("views/widgets/widgets-popular-posts.php");
        require_once locate_template("views/widgets/widgets-related-posts.php");
        require_once locate_template("views/widgets/widgets-recent-posts.php");
        require_once locate_template("views/widgets/widgets-social-networks.php");
        require_once locate_template("views/widgets/widgets-subnav.php");
        require_once locate_template("views/widgets/widgets-testimonials.php");
        require_once locate_template("views/widgets/widgets-twitter-feeds.php");
        require_once locate_template("views/widgets/widgets-video.php");
        require_once locate_template("views/widgets/widgets-flickr-feeds.php");
        require_once locate_template("views/widgets/widgets-instagram-feeds.php");
        require_once locate_template("views/widgets/widgets-news-slider.php");
        require_once locate_template("views/widgets/widgets-recent-portfolio.php");
        require_once locate_template("views/widgets/widgets-slideshow.php");
    }

    public function supports()
    {

        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('automatic-feed-links');
        add_theme_support('editor-style');
        add_theme_support('post-thumbnails');
        add_theme_support('yoast-seo-breadcrumbs');

        register_nav_menus(array(
            'primary-menu' => __('Primary Navigation', "mk_framework"),
            'second-menu' => __('Second Navigation', "mk_framework"),
            'third-menu' => __('Third Navigation', "mk_framework"),
            'fourth-menu' => __('Fourth Navigation', "mk_framework"),
            'fifth-menu' => __('Fifth Navigation', "mk_framework"),
            'sixth-menu' => __('Sixth Navigation', "mk_framework"),
            "seventh-menu" => __('Seventh Navigation', "mk_framework"),
            "eighth-menu" => __('Eighth Navigation', "mk_framework"),
            "ninth-menu" => __('Ninth Navigation', "mk_framework"),
            "tenth-menu" => __('tenth Navigation', "mk_framework"),
            'footer-menu' => __('Footer Navigation', "mk_framework"),
            'toolbar-menu' => __('Header Toolbar Navigation', "mk_framework"),
            'side-dashboard-menu' => __('Side Dashboard Navigation', "mk_framework"),
            'fullscreen-menu' => __('Full Screen Navigation', "mk_framework"),
        ));

    }
    public function post_types()
    {
        require_once THEME_POST_TYPES . '/custom_post_types.helpers.class.php';
        require_once THEME_POST_TYPES . '/register_post_type.class.php';
        require_once THEME_POST_TYPES . '/register_taxonomy.class.php';
        require_once THEME_POST_TYPES . '/config.php';
    }
    public function functions()
    {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        include_once THEME_ADMIN . '/general/general-functions.php';

        if (!class_exists('phpQuery'))
        {
            require_once THEME_INCLUDES . "/phpquery/phpQuery.php";
        }

        require_once THEME_INCLUDES . "/otf-regen-thumbs/otf-regen-thumbs.php";

        require_once THEME_FUNCTIONS . "/general-functions.php";
        require_once THEME_FUNCTIONS . "/ajax-search.php";
        require_once THEME_FUNCTIONS . "/post-pagination.php";

        require_once THEME_FUNCTIONS . "/enqueue-front-scripts.php";
        require_once THEME_GENERATORS . '/sidebar-generator.php';
        require_once THEME_FUNCTIONS . "/dynamic-styles.php";

        require_once THEME_PLUGIN_INTEGRATIONS . "/woocommerce/init.php";
        require_once THEME_PLUGIN_INTEGRATIONS . "/visual-composer/init.php";

        require_once locate_template("framework/helpers/love-post.php");
        require_once locate_template("framework/helpers/load-more.php");
        require_once locate_template("components/shortcodes/mk_portfolio/ajax.php");
        require_once locate_template("components/shortcodes/mk_subscribe/ajax.php");
        require_once locate_template("components/shortcodes/mk_products/quick-view-ajax.php");
    }
    public function helpers()
    {
        require_once THEME_HELPERS . "/svg-icons.php";
        require_once THEME_HELPERS . "/image-resize.php";
        require_once THEME_HELPERS . "/template-part-helpers.php";
        require_once THEME_HELPERS . "/global.php";
        require_once THEME_HELPERS . "/wp_head.php";
        require_once THEME_HELPERS . "/wp_footer.php";
        require_once THEME_HELPERS . "/schema-markup.php";
        require_once THEME_HELPERS . "/wp_query.php";
        require_once THEME_HELPERS . "/send-email.php";
        require_once THEME_HELPERS . "/captcha.php";
    }

    public function menu_walkers()
    {
        require_once locate_template("framework/custom-nav-walker/fallback-navigation.php");
        require_once locate_template("framework/custom-nav-walker/main-navigation.php");
        require_once locate_template("framework/custom-nav-walker/menu-with-icon.php");
        require_once locate_template("framework/custom-nav-walker/responsive-navigation.php");
    }

    public function add_metaboxes()
    {
        include_once THEME_GENERATORS . '/metabox-generator.php';
    }

    public function theme_activated()
    {
        if ('themes.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['activated']) && $_GET['activated'] == 'true')
        {
            update_option('woocommerce_enable_lightbox', "no");

            flush_rewrite_rules();

            update_option(THEME_OPTIONS_BUILD, uniqid());

            wp_redirect(admin_url('admin.php?page=' . THEME_NAME));
        }
    }

    public function admin()
    {
        if (is_admin())
        {
            require_once THEME_CONTROL_PANEL . "/logic/compatibility.php";
            require_once THEME_CONTROL_PANEL . "/logic/functions.php";
            require_once THEME_CONTROL_PANEL . "/logic/updates-class.php";
            require_once THEME_ADMIN . "/menus-custom-fields/menu-item-custom-fields.php";
            include_once THEME_ADMIN . '/general/mega-menu.php';
            include_once THEME_ADMIN . '/general/enqueue-assets.php';
            include_once THEME_ADMIN . '/theme-options/options-save.php';
            require_once THEME_INCLUDES . "/tgm-plugin-activation/request-plugins.php";
        }
        require_once THEME_CONTROL_PANEL . "/logic/tracking.php";
    }
    public function language()
    {

        load_theme_textdomain('mk_framework', get_stylesheet_directory() . '/languages');
    }

    public function admin_menus()
    {
        $theme_options_menu_text = '<span class="menu-theme-options"><span class="dashicons-before dashicons-admin-generic"></span>' . __('Theme Options', 'mk_framework') . '</span>';
        add_menu_page(THEME_NAME, THEME_NAME, 'edit_posts', THEME_NAME, array(&$this,
            'theme_register',
        ), 'dashicons-star-filled', 3);
        add_submenu_page(THEME_NAME, __('Register Product', 'mk_framework'), __('Register Product', 'mk_framework'), 'edit_theme_options', THEME_NAME, array(&$this,
            'theme_register',
        ));
        add_submenu_page(THEME_NAME, __('Support', 'mk_framework'), __('Support', 'mk_framework'), 'edit_posts', 'theme-support', array(&$this,
            'theme_support',
        ));
        add_submenu_page(THEME_NAME, __('Install Templates', 'mk_framework'), __('Install Templates', 'mk_framework'), 'edit_theme_options', 'theme-templates', array(&$this,
            'theme_templates',
        ));

        add_submenu_page(THEME_NAME, __('Image Sizes', 'mk_framework'), __('Image Sizes', 'mk_framework'), 'edit_posts', 'theme-image-size', array(&$this,
            'image_size',
        ));
        add_submenu_page(THEME_NAME, __('System Status', 'mk_framework'), __('System Status', 'mk_framework'), 'edit_theme_options', 'theme-status', array(&$this,
            'theme_status',
        ));
        add_submenu_page(THEME_NAME, __('Icon Library', 'mk_framework'), __('Icon Library', 'mk_framework'), 'edit_posts', 'icon-library', array(&$this,
            'icon_library',
        ));
        add_submenu_page(THEME_NAME, __('Updates', 'mk_framework'), __('Updates', 'mk_framework'), 'edit_posts', 'theme-updates', array(&$this,
            'theme_updates',
        ));
        add_submenu_page(THEME_NAME, __('Announcements', 'mk_framework'), __('Announcements', 'mk_framework'), 'edit_posts', 'theme-announcements', array(&$this,
            'theme_annoucements',
        ));
        add_submenu_page(THEME_NAME, __('Theme Options', 'mk_framework'), __($theme_options_menu_text, 'mk_framework'), 'edit_theme_options', 'theme_options', array(&$this,
            'theme_options',
        ));
    }

    public function theme_options()
    {
        $page = include_once THEME_ADMIN . '/theme-options/masterkey.php';
        new Mk_Options_Framework($page['options']);
    }
    public function icon_library()
    {
        include_once THEME_ADMIN . '/general/icon-library.php';
    }

    public function theme_status()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-status.php';
    }

    public function theme_annoucements()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-announcements.php';
    }

    public function theme_updates()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-updates.php';
    }

    public function image_size()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-image-size.php';
    }

    public function theme_addons()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-addons.php';
    }

    public function theme_templates()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-templates.php';
    }

    public function theme_support()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-support.php';
    }

    public function theme_register()
    {
        include_once THEME_CONTROL_PANEL . '/logic/theme-register.php';
    }

    /**
     * This function maintains the table for actively used theme components.
     *
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0
     */
    public function mk_theme_setup()
    {
        global $wpdb;
        global $jupiter_db_version;
        global $jupiter_table_name;

        $wp_get_theme = wp_get_theme();
        $current_theme_version = $wp_get_theme->get('Version');
        $jupiter_db_version = $current_theme_version;
        $jupiter_table_name = $wpdb->prefix . "mk_components";

        if ($jupiter_db_version != get_option('jupiter_db_version'))
        {
            $charset_collate = $wpdb->get_charset_collate();
            $sql = " CREATE TABLE $jupiter_table_name (id bigint(20) NOT NULL primary key AUTO_INCREMENT,
                type varchar(20) NOT NULL,
                status tinyint(1) NOT NULL,
                name varchar(40) NOT NULL,
                added_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                last_update datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                KEY {$jupiter_table_name}_type (type),
                KEY {$jupiter_table_name}_status (status),
                KEY {$jupiter_table_name}_name (name)
                ) $charset_collate;";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
            update_option('jupiter_db_version', $jupiter_db_version);
        }
    }

    /**
     * Compatibility check for hosting php version.
     * Returns error if php version is below v5.4
     * @author      Bob ULUSOY & Ugur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.5
     * @last_update Version 5.0.7
     */
    public function theme_requirement_check()
    {
        if (!in_array($GLOBALS['pagenow'], array('admin-ajax.php')))
        {
            if (version_compare(phpversion(), '5.4', '<'))
            {
                echo '<h2>As stated in <a href="http://demos.artbees.net/jupiter5/jupiter-v5-migration/">Jupiter V5.0 Migration Note</a> your PHP version must be above V5.4. We no longer support php legacy versions (v5.2.X, v5.3.X).</h2>';
                echo 'Read more about <a href="https://wordpress.org/about/requirements/">WordPress environment requirements</a>. <br><br> Please contact with your hosting provider or server administrator for php version update. <br><br> Your current PHP version is <b>' . phpversion() . '</b>';
                wp_die();
            }
        }
    }
}
