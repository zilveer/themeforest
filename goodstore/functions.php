<?php
/**
 * Base loader and theme initialization
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @since FN
 */
// define('JAW_DEBUG', false);
// define('JAW_DEV_TOOLS', false);

//Zmena kvuli woo product cat
add_action('init', 'jaw_init', 0);
add_action('init', 'jaw_woo_size_rewrite', 0);
add_action('init', 'jaw_compare_php_versions', 0);
add_action('after_setup_theme', 'jaw_theme_supports');
add_action('after_setup_theme', 'jaw_language');

function jaw_init() {


//  Define constants.
    jaw_constants();

// Language support.
// Add css demo
    add_action('wp_enqueue_scripts', 'jaw_css', 50);
    add_action('admin_enqueue_scripts', 'jaw_admin_css', 50);
    add_action('wp_head', 'jaw_ie_css');

// Add js
    add_action('wp_enqueue_scripts', 'jaw_wp_scripts');
    add_action('admin_enqueue_scripts', 'jaw_admin_scripts');

    add_filter('get_the_excerpt', 'jaw_excerpt', 5); //dulezity pro revoComposer - jinak se bude printovat i v hlavičce
    add_filter('woocommerce_product_thumbnails_columns', 'jaw_woocommerce_product_thumbnails_columns', 99);
    add_filter('woocommerce_product_tag_cloud_widget_args', 'jaw_woocommerce_tag_cloud_widget');
    add_filter('woocommerce_product_review_comment_form_args', 'jaw_product_review');
    /* Customized the output of caption, you can remove the filter to restore back to the WP default output. Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/ */
    add_filter('img_caption_shortcode', 'jaw_cleaner_caption', 10, 3);
    add_filter('get_image_tag_class', 'jaw_image_tag_class', 0);
    add_filter('get_image_tag', 'jaw_image_tag', 0, 4);
    add_filter('user_contactmethods', 'jaw_add_social_contactmethod', 10, 1);
    add_filter('login_redirect', 'jaw_login_redirect', 10, 3);
    add_filter('jaw_post_thumbnail', 'jaw_featured_from_content', 10, 2);
    add_action('wp', 'jaw_custom_paged_404_fix');


    jaw_libs();



//load_theme_textdomain('jawtemplates', THEME_DIR . '/languages/');
// init cache
    if (!file_exists(WP_CONTENT_DIR . '/cache/') && function_exists('mkdir') && is_writable(WP_CONTENT_DIR . '/cache/')) {
        mkdir(WP_CONTENT_DIR . '/cache');
    }
// Custom item in menu must be load for all space

    add_action('wp_ajax_get_media_image', array('jwElements', 'get_media_image'));

//multidropdown element
    add_action('wp_ajax_load_multidropdown', array('jwElements', 'load_multidropdown'));
    add_action('wp_ajax_nopriv_load_multidropdown', array('jwElements', 'load_multidropdown'));

//sidebar manager
    add_action('wp_ajax_jaw_add_sidebar', array('jwElements', 'jaw_add_sidebar'));
    add_filter('posts_where', array('jwElements', 'title_filter'), 10, 2);
    add_action('pre_get_posts', 'jaw_pre_get_posts');
    add_action('init', 'jaw_get_themeoptions');
    add_filter('widget_text', 'do_shortcode');

//TINY MCE
    add_filter('mce_buttons_2', array('jwUtils', 'jaw_mce_buttons_2'));
    add_filter('tiny_mce_before_init', array('jwUtils', 'jaw_mce_before_init_insert_formats'));

//woo-cart
    add_filter('add_to_cart_fragments', array('jwRender', 'woocommerce_header_add_to_cart_fragment'));
    add_filter('add_to_cart_fragments', array('jwRender', 'woocommerce_widget_add_to_cart_fragment'));
//woo-related product
    add_filter('woocommerce_related_products_args', array('jwUtils', 'woocommerce_related_products_args'));

//Co se nám ve woocommerce nehodí
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    //Pluginy pro woocomerce nezobrazovaly add to cort - zakomentovano
    //remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    //This will disable the notification for activation and also replace the Version Information and the Need Premium Support and Auto Updates
    if (function_exists('set_ess_grid_as_theme')) {
        set_ess_grid_as_theme();
    }

// register Optios manager
    $jwOpt = new jwOpt();
//INIT JAW plugins
    jaw_init_plugins();
//inline styles
    $jwStyle = new jwStyle();
//static class
// register sidebar
    $jwSidebars = new jwSidebars(jwOpt::get_option('sidebars'), null, jwOpt::get_option('sidebars_bar_type', 'big'));

    if (isset($_GET['import_data'])) {
        ?>
        <script>
            var nonce = '<?php echo wp_create_nonce('of_ajax_nonce'); ?>';</script>
        <?php
    }

//SEO
    if (jwOpt::get_option('use_jaw_seo', '1') == '1') {
        add_filter('wp_title', array('jwRender', 'title_seo'), 10, 3);
    }

    add_action('pre_get_posts', 'jaw_search_filter');

    add_filter('rss2_item', 'jaw_rss_post_thumbnail');
    add_filter('rss_item', 'jaw_rss_post_thumbnail');
    add_filter('the_excerpt_rss', 'jaw_rss_noiframe');
    add_filter('the_content_feed', 'jaw_rss_noiframe');

    //add themeoptions link to top bar
    add_action('admin_bar_menu', 'jaw_modify_admin_bar', 99);

    add_filter('loop_shop_per_page', create_function('$cols', 'return ' . jwOpt::get_option('products_per_page', get_option('posts_per_page')) . ';'), 20);

//ecommerce analytics
    if (jwOpt::get_option('woo_analytics', '0') == '1') {
        add_action('woocommerce_thankyou', 'jaw_wc_ga_integration');
    }

//Woo sales
    if (jwOpt::get_option('woo_show_sale', '0') == 'price') {
        add_filter('woocommerce_sale_price_html', 'jaw_woocommerce_sales_price', 10, 2);
    } else if (jwOpt::get_option('woo_show_sale', '0') == 'percentagle') {
        add_filter('woocommerce_sale_price_html', 'jaw_woocommerce_percentagle_sales_price', 10, 2);
    }

    // wrong login
    if (jwOpt::get_option('redirect_after_wrong_login', 'wp') != 'wp') {
        add_action('wp_login_failed', 'jaw_redirect_login_failed');
        if (jwOpt::get_option('wrong_login_wp_showhide', '1') != '1') {
            add_filter('authenticate', 'jaw_authenticate_username_password', 30, 3);
        }
    }

// Load admin options
    if (is_admin()) {
        locate_template(REL_THEME_ADMIN . 'options/metaboxes.php', true);
        locate_template(REL_THEME_ADMIN . 'options/metaboxes-woocommerce.php', true);



        global $metapost, $metacat, $metapage;

        $jwMetabox = new jwMetabox($metapost);
        $jwMetabox = new jwMetabox($metapage);

        $jwMetatax = new jwMetatax($metacat, 'category');
        global $metaprductcat, $metaprduct;
        $jwMetatax = new jwMetatax($metaprductcat, 'product_cat');
        $jwMetabox = new jwMetabox($metaprduct);

        if (jwOpt::get_option('switch_udate', '1') == '1') {
            $example_update_checker = new ThemeUpdateChecker(
                    THEMESLUG, 'http://support.jawtemplates.com/updates/'
            );
        }

//demoimport for JAW
        /*
          if(isset($_GET['demo'])){
          if (!class_exists('jwImport')) {
          require_once THEME_FRAMEWORK_LIB . '/class_demoimport.php';
          }
          $import = new jwDemoImport($_GET['demo']);
          }
         */
    }

    if (jwOpt::get_option('theme_revoComposer', '1') == '1') {
        $jawBuilder = new jwBuilder();
    }
    
    //jaw translation
    if(jwOpt::get_option('use_translation', '0')){
        //_x, _ex, esc_attr_x, esc_html_x to zatím neumi neumi
        add_filter( 'gettext', array('jwUtils', 'jaw_translation'), 10, 3);
        add_filter( 'ngettext', array('jwUtils', 'jaw_ntranslation'), 10, 5);
    }

//REGISTER ================================
    if (!is_admin()) {
        if (isset($_POST['jaw-register'])) {
            jwUtils::register_new_user($_POST);
        }
    }

    add_filter('excerpt_length', 'jaw_custom_excerpt_length', 20);

    add_filter('the_content', 'do_shortcode', 999);

//Anti-spam filter
    if (jwOpt::get_option('comments_antispam_toggle', '0') == '1' && !is_user_logged_in()) {
        add_filter('preprocess_comment', array('jwUtils', 'jaw_nobot_question_filter'));
    }

    add_filter('tiny_mce_before_init', 'jaw_add_iframe');
    include_once ABSPATH . '/wp-admin/includes/nav-menu.php';
    load_template(ABSPATH . 'wp-admin/includes/image.php');


// PĹ™i prvnĂ­m spuĹˇtÄ›nĂ­ Ĺˇablony se deregistujĂ­ vĹˇechny widgety a nastavĂ­ se zĂˇkladnĂ­ menu.
    if (get_option('install') == null) {
        $current_sidebars = get_option('sidebars_widgets');
        foreach ((array) $current_sidebars as $key => $value) {
            $current_sidebars[$key] = array();
        }
        update_option('sidebars_widgets', $current_sidebars);
        update_option('jaw-menu-location', array("primary_navigation"));

        wp_insert_term(
                'Menu', 'nav_menu', array(
            'description' => 'Base menu',
            'slug' => 'default',
            'parent' => ''
                )
        );

        $mymenu = wp_get_nav_menu_object('Menu');
        $menuID = (int) $mymenu->term_id;


        $custom_item = array(
            'menu-item-type' => 'custom',
            'menu-item-url' => get_option('siteurl'),
            'menu-item-title' => 'Home',
            'menu-item-status' => 'publish'
        );

        wp_update_nav_menu_item($menuID, 0, $custom_item);

        $insert_menu = array('primary_navigation' => $menuID);
        register_nav_menu('primary_navigation', 'Primary Navigation');
        set_theme_mod('nav_menu_locations', $insert_menu);

        //yith wishlist zmenil defaultni nastaveni buttonu "add to wishlist" timto se prepise na puvodni
        update_option( 'yith_wcwl_button_position','shortcode' );
        
        add_option('install', '1');
    }
   
}

function jaw_woocommerce_sales_price($price, $product) {
    return $price . '<div class="clear"></div><span class="woo_save">' . __(' Save ', 'jawtemplates') . sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), ($product->regular_price - $product->sale_price)) . '</span>';
}

function jaw_woocommerce_percentagle_sales_price($price, $product) {
    $percentage = round(( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100);
    return $price . '<div class="clear"></div><span class="woo_save">' . sprintf(__(' Save %s', 'jawtemplates'), $percentage . '%') . '</span>';
}

function jaw_woocommerce_product_thumbnails_columns($val) {
    $val = jwOpt::get_option('woo_product_thumbnails_columns', 3);
    if (!$val > 0) {
        $val = 3;
    }
    return $val;
}

function jaw_rss_noiframe($content) {
    $content = preg_replace('/<iframe(.*)\/iframe>/is', '', $content);

    return $content;
}

function jaw_rss_post_thumbnail() {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "post-size");
        if (isset($img[0])) {
            list($width, $height, $type, $attr) = getimagesize($img[0]);
            echo '<enclosure url="' . $img[0] . '" type="' . image_type_to_mime_type($type) . '" length="1" />';
        }
    }
}

function jaw_add_iframe($initArray) {
    $initArray['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]";
    return $initArray;
}

function jaw_woo_size_rewrite() {
//Rewrite Woocommerce sizes
    add_image_size('shop_single', 566, 611);
}

function jaw_custom_excerpt_length($length) {
    return jwOpt::get_option('blog_excerpt', 20);
}

function jaw_theme_supports() {

//pomer - wide / classic = 1,205211726
//1170 - 25
    add_image_size('lazyload', 151, 0, true);
    add_image_size('post-size', 151, 96, true);
    add_image_size('post-size-middle', 375, 241, true);
    add_image_size('post-size-big', 875, 563, true);
    add_image_size('team-size', 274, 220, true);
    add_image_size('woo-size', 274, 293, true);
    add_image_size('woo-size-category', 275, 0, true);
    add_image_size('woo-size-square', 128, 128, true);
//add_image_size('woo-size-small', 170, 187, true); - ta telefonech to delalo blbiny

    add_image_size('slider-size', 488, 455, true);

    if (function_exists('add_theme_support')) {


// Add post thumbnail supports. http://codex.wordpress.org/Post_Tphumbnails
        add_theme_support('post-thumbnails');

// Add post formarts supports. http://codex.wordpress.org/Post_Formats
        add_theme_support('post-formats', array('gallery', 'image', 'quote', 'video'));

// Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
        add_theme_support('menus');
        register_nav_menus(array(
            'primary_navigation' => __('Primary Navigation', 'jawtemplates'),
            'footer_navigation' => __('Footer Navigation', 'jawtemplates'),
            'my_account' => __('My Account Menu', 'jawtemplates'),
        ));

        add_editor_style('/css/editor-style.css');

//This enables post and comment RSS feed links to head. This should be used in place of the deprecated automatic_feed_links.
        add_theme_support('automatic-feed-links');

// reference to: http://codex.wordpress.org/Function_Reference/add_editor_style
        add_theme_support('editor-style');

//Themeforrest requipments
        add_theme_support('custom-header', array(
            'default-image' => '',
            'random-default' => false,
            'width' => 1040,
            'flex-height' => true,
            'flex-width' => true,
            'uploads' => true,
            'header-text' => false
        ));
        add_theme_support('custom-background');


//Woocommerce
        add_theme_support('woocommerce');
    }
}

function jaw_cleaner_caption($output, $attr, $content) {

    /* We're not worried abut captions in feeds, so just return the output here. */
    if (is_feed())
        return $output;

    /* Set up the default arguments. */
    $defaults = array(
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    );

    /* Merge the defaults with user input. */
    $attr = shortcode_atts($defaults, $attr);

    /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
    if (1 > $attr['width'] || empty($attr['caption']))
        return $content;

    /* Set up the attributes for the caption <div>. */
    $attributes = ' class="figure ' . esc_attr($attr['align']) . '"';

    /* Open the caption <div>. */
    $output = '<figure' . $attributes . '>';

    /* Allow shortcodes for the content the caption was created for. */
    $output .= do_shortcode($content);

    /* Append the caption text. */
    $output .= '<figcaption>' . $attr['caption'] . '</figcaption>';

    /* Close the caption </div>. */
    $output .= '</figure>';

    /* Return the formatted, clean caption. */
    return $output;
}

// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
function jaw_image_tag_class($class) {
    $class = 'align' . esc_attr($class);
    return $class;
}

function jaw_image_tag($html, $id, $alt, $title) {
    return preg_replace(array(
        '/\s+width="\d+"/i',
        '/\s+height="\d+"/i',
        '/alt=""/i'
            ), array(
        '',
        '',
        '',
        'alt="' . $title . '"'
            ), $html);
}

function jaw_add_social_contactmethod($contactmethods) {
// Add Networks
    $contactmethods['twitter'] = 'Twitter URL';
    $contactmethods['facebook'] = 'Facebook URL';
    $contactmethods['linkedin'] = 'Linkedin URL';
    $contactmethods['youtube'] = 'YouTube URL';
    $contactmethods['google'] = 'Google+ URL';
    $contactmethods['vimeo'] = 'Vimeo URL';
    $contactmethods['flickr'] = 'Flickr URL';
    $contactmethods['pinterest'] = 'Pinterest URL';
    $contactmethods['instagram'] = 'Instagram URL';

    return $contactmethods;
}

//PLUGINS*****************
$jaw_plugin_name = '';

function jaw_init_plugins() {

//   if (is_admin()) {
    if ($plugins = jwOpt::getXmlSpace('plugins')) {
        foreach ($plugins->children() as $plugin) {
            $name = (string) $plugin->attributes()->name;
            $theme = wp_get_theme();

            if (class_exists($name) && method_exists($name, 'getInstance')) {

                $result = call_user_func($name . '::getInstance');
                $result->init($plugin, $theme);

                if ($result == false) {
                    $jaw_plugin_name = $name;
                    add_action('admin_notices', 'jaw_admin_notice');
                }
            }
        }
    }
// }
}

function jaw_admin_notice() {
    ?>
    <div class="updated">
        <p><b><?php echo $jaw_plugin_name; ?>:</b> This version of plugin is not supported for your theme</p>
    </div>
    <?php
}



/*
 * Load constants
 */

function jaw_constants() {

    $theme_version = '';

    if (function_exists('wp_get_theme')) {
        if (is_child_theme()) {
            $temp_obj = wp_get_theme();
            $theme_obj = wp_get_theme($temp_obj->get('Template'));
        } else {
            $theme_obj = wp_get_theme();
        }

        $theme_version = $theme_obj->get('Version');
        $theme_name = $theme_obj->get('Name');
        $theme_uri = $theme_obj->get('ThemeURI');
        $author_uri = $theme_obj->get('AuthorURI');
    } else { // for WP < 3.4.0
        $theme_data = wp_get_theme(get_template_directory() . '/style.css');
        $theme_version = $theme_data['Version'];
        $theme_name = $theme_data['Name'];
        $author_uri = $theme_data['AuthorURI'];
    }


    define('SITE_URL', get_option('siteurl'));
    define('FRAMEWORK', '2.0');
    define('THEMENAME', $theme_name);
    define('THEMESLUG', strtolower($theme_name));
    define('THEMEVERSION', $theme_version);
    define('THEMEURI', get_template_directory_uri());
    define('THEMEAUTHORURI', $author_uri);
    define('THEME_FRAMEWORK_DIR', get_template_directory() . '/framework');
    define('THEME_FRAMEWORK_URI', get_template_directory_uri() . '/framework');
    define('THEME_FRAMEWORK_LIB', THEME_FRAMEWORK_DIR . '/lib/');

    define('ADMIN_PATH', THEME_FRAMEWORK_DIR . '/admin/');
    define('ADMIN_DIR', THEME_FRAMEWORK_URI . '/admin/');
    define('THEME_ADMIN', THEME_FRAMEWORK_DIR . '/admin');

    define('THEME_DIR', get_template_directory());
    define('THEME_URI', get_template_directory_uri());

    if (!defined('WP_CONTENT_DIR')) {
        define('WP_CONTENT_DIR', realpath(THEME_DIR . '/../..'));
    }
//Relative paths
    define('REL_THEME_FRAMEWORK_DIR', 'framework/');
    define('REL_THEME_FRAMEWORK_LIB', REL_THEME_FRAMEWORK_DIR . 'lib/');
    define('REL_THEME_ADMIN', REL_THEME_FRAMEWORK_DIR . 'admin/');

    /* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
    define('CATEGORIES', THEMESLUG . '_categories');
    define('MENUS', THEMESLUG . '_menus');
    define('OPTIONS', THEMESLUG . '_options');
    define('BUILDER', THEMESLUG . '_pb_pressets');
    define('BUILDER_ELEMENT', THEMESLUG . '_pb_element_pressets');
    define('BACKUPS', '_backups');

    define('CHECK_UPDATE', 1209600); //86400*14 = 1209600
    define('THEME_FUNCTIONS', THEME_FRAMEWORK_DIR . '/functions');
}

/*
 * Load basic classes
 */

function jaw_libs() {
    load_template(ABSPATH . 'wp-admin/includes/plugin.php');
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_options.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_layout.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_utils.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_sidebars.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_render.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_builder.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_builderhelper.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_shortcodes.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_styles.php', true, true);

    locate_template(REL_THEME_FRAMEWORK_LIB . 'jaw-templater.php', true, true);

    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsDataStore.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsDataPrinter.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsManager.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . '/rating/admin.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_facebook.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_elements.php', true, true);
    locate_template(REL_THEME_FRAMEWORK_LIB . 'class_updatechecker.php', true, true);

    if (is_admin()) {
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_panel.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_demoimport.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_metatax.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_metabox.php', true, true);
        locate_template(REL_THEME_FRAMEWORK_LIB . 'class_tgm.php', true, true);
    }
}

/*
 * Make theme available for translation
 */

function jaw_language() {

    load_theme_textdomain('jawtemplates', get_template_directory() . '/languages/');
}

function jaw_css() {

    wp_register_style('style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('style');

    if ((defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('bootstrap');
        wp_register_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('prettyPhoto');
        wp_register_style('icons', get_template_directory_uri() . '/css/icons.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('icons');
        wp_register_style('selectric', get_template_directory_uri() . '/css/selectric.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('selectric');
        wp_register_style('template', jwUtils::jaw_get_stylesheet_uri('/css/template.css'), array(), jwUtils::assetsVersion());
        wp_enqueue_style('template');
        wp_register_style('jawmenu-style', get_template_directory_uri() . '/css/jawmenu.css', array(), '1.2.1');
        wp_enqueue_style('jawmenu-style');
        if (jwOpt::get_option('wide_mode', '1') == '1') {
            wp_register_style('template-wide', get_template_directory_uri() . '/css/template-wide.css', array('template'), jwUtils::assetsVersion());
            wp_enqueue_style('template-wide');
        }
    } else {
        wp_register_style('all_min', get_template_directory_uri() . '/css/all.min.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('all_min');
        wp_register_style('template-min', jwUtils::jaw_get_stylesheet_uri('/css/template.min.css'), array(), jwUtils::assetsVersion());
        wp_enqueue_style('template-min');
        wp_register_style('jawmenu-style', get_template_directory_uri() . '/css/jawmenu.css', array(), '1.2.1');
        wp_enqueue_style('jawmenu-style');
        if (jwOpt::get_option('wide_mode', '1') == '1') {
            wp_register_style('template-wide-min', get_template_directory_uri() . '/css/template-wide.min.css', array('template-min'), jwUtils::assetsVersion());
            wp_enqueue_style('template-wide-min');
        }
    }

    $id = get_current_blog_id();
    if (file_exists(THEME_DIR . '/css/custom-styles-' . $id . '.min.css') && !(defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        wp_register_style('custom-styles', get_template_directory_uri() . '/css/custom-styles-' . $id . '.min.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('custom-styles');
    } elseif (file_exists(THEME_DIR . '/css/custom-styles-' . $id . '.css')) {
        wp_register_style('custom-styles', get_template_directory_uri() . '/css/custom-styles-' . $id . '.css', array(), jwUtils::assetsVersion());
        wp_enqueue_style('custom-styles');
    }
    if (class_exists('WooCommerce')) {
        wp_deregister_style('woocommerce_prettyPhoto_css');
    }

    //Customer custom styles
    if (function_exists('glob')) {
        $files = glob(THEME_DIR . "/css/custom_styles/*.css");
        foreach ((array) $files as $file) {
            $filename = explode('custom_styles', $file);
            if (isset($filename[1])) {
                wp_enqueue_style('custom-css-' . $filename[1], get_template_directory_uri() . '/css/custom_styles' . $filename[1], array(), jwUtils::assetsVersion());
            }
        }
    }
}

function jaw_admin_css() {
    if (jwOpt::get_option('use_google_fonts', '1') == '1') {
        $font_url = '//fonts.googleapis.com/css?family=Lato:300,400,700';
        add_editor_style(str_replace(',', '%2C', $font_url));
        $font_url = '//fonts.googleapis.com/css?family=Open+Sans:400,700';
        add_editor_style(str_replace(',', '%2C', $font_url));
    }
    add_editor_style(ADMIN_DIR . 'assets/css/editor.css');

    wp_register_style('jquery-ui', ADMIN_DIR . 'assets/css/jquery-ui.css');
    wp_enqueue_style('jquery-ui');

    wp_register_style('jaw_builder_admin_style', THEME_FRAMEWORK_URI . '/lib/builder/assets/css/styles.css', array(), jwUtils::assetsVersion());
    wp_enqueue_style('jaw_builder_admin_style');

    wp_register_style('jaw-custompost', ADMIN_DIR . 'assets/css/custompost.css', array(), jwUtils::assetsVersion());
    wp_enqueue_style('jaw-custompost');

    wp_register_style('jaw-admin-style', ADMIN_DIR . 'assets/css/admin-style.css', array(), jwUtils::assetsVersion());
    wp_enqueue_style('jaw-admin-style');

    wp_register_style('jaw-colorpicker', ADMIN_DIR . 'assets/css/colorpicker.css', array(), jwUtils::assetsVersion());
    wp_enqueue_style('jaw-colorpicker');

    wp_register_style('jaw-icons', get_template_directory_uri() . '/css/icons.min.css', jwUtils::assetsVersion());
    wp_enqueue_style('jaw-icons');
}

function jaw_ie_css() {
    if (!is_admin()) {
        echo '<!--[if lt IE 9]>';
        echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/ie.css">';
        if (jwOpt::get_option('wide_mode', '0') == '1') {
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/template-wide-ie.css">';
        }
        echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
        echo '<![endif]-->';
    }
}

function jaw_wp_scripts() {
    if (class_exists('WooCommerce')) { // mame vlastni
        wp_dequeue_script('prettyPhoto');
        wp_dequeue_script('prettyPhoto-init');
    }

    wp_register_script('all', get_template_directory_uri() . '/js/all.js', array('jquery'), jwUtils::assetsVersion(), true);
    wp_enqueue_script('all');

    if ((defined('JAW_DEBUG') && JAW_DEBUG == true)) {
        wp_register_script('app', get_template_directory_uri() . '/js/lib/app.js', array('jquery', 'all'), jwUtils::assetsVersion(), true);
        wp_enqueue_script('app');
        wp_localize_script('app', 'jaw_use_prettyphoto', jwOpt::get_option('use_prettyphoto', '1'));
        wp_localize_script('app', 'use_selectric', jwOpt::get_option('use_selectric', '1'));
        wp_localize_script('app', 'isotope_grid', jwOpt::get_option('isotope_grid', 'masonry'));
    } else {
        wp_register_script('app-min', get_template_directory_uri() . '/js/app.min.js', array('jquery', 'all'), jwUtils::assetsVersion(), true);
        wp_enqueue_script('app-min');
        wp_localize_script('app-min', 'jaw_use_prettyphoto', jwOpt::get_option('use_prettyphoto', '1'));
        wp_localize_script('app-min', 'use_selectric', jwOpt::get_option('use_selectric', '1'));
        wp_localize_script('app-min', 'isotope_grid', jwOpt::get_option('isotope_grid', 'masonry'));
    }

// Enable threaded comments 
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function jaw_admin_scripts() {

    wp_enqueue_script('jquery-ui-core', array('jquery'));
    wp_enqueue_script('jquery-ui-sortable', array('jquery'));
    wp_enqueue_script('jquery-ui-slider', array('jquery'));
    wp_enqueue_script('jquery-ui-mouse', array('jquery'));

    wp_enqueue_script('angular', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/angular.min.js', array('jquery'), '1.0.8');

    wp_enqueue_script('ui-bootstrap', ADMIN_DIR . 'assets/js/ui-bootstrap-tpls.min.js', array('jquery'), jwUtils::assetsVersion());
    wp_enqueue_script('bootstrap-colorpicker', ADMIN_DIR . 'assets/js/bootstrap-colorpicker.js', array('jquery', 'angular'), jwUtils::assetsVersion());
    wp_enqueue_script('bootstrap-colorpicker-module', ADMIN_DIR . 'assets/js/bootstrap-colorpicker-module.js', array('jquery', 'bootstrap-colorpicker'), jwUtils::assetsVersion());

    wp_enqueue_script('jaw-gallerypicker', ADMIN_DIR . 'assets/js/angular/angular.gallerypicker.js', array('jquery', 'angular'), jwUtils::assetsVersion());
    wp_enqueue_script('jaw-simplemediapicker', ADMIN_DIR . 'assets/js/angular/angular.simplemediapicker.js', array('jquery', 'angular'), '1.1');

    wp_enqueue_script('shortcode_editor', THEME_FRAMEWORK_URI . '/plugins/jaw-shortcodes/editor/assets/shortcode_editor.js', array('jquery'), '1.1', true);


//BUILDER
    wp_enqueue_script('angular-ui-sortable', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/sortable.js', array('jquery', 'angular'), jwUtils::assetsVersion());
    wp_enqueue_script('tg-dynamic-directive', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/tg.dynamic.directive.js', array('jquery', 'angular'), jwUtils::assetsVersion());
// wp_enqueue_script('jquery-ba-resize', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/jquery.ba-resize.min.js', array('jquery'), jwUtils::assetsVersion());  // na detekci zmÄ›ny vĂ˝Ĺˇky
    wp_enqueue_script('jaw-builder', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/jaw_builder.js', array('jquery', 'angular', 'angular-ui-sortable'), jwUtils::assetsVersion());
    wp_enqueue_script('jaw-builder_editor', THEME_FRAMEWORK_URI . '/lib/builder/assets/js/jaw_builder_editor.js', array('jquery', 'angular'), jwUtils::assetsVersion());

    wp_enqueue_script('jaw-admin-page', ADMIN_DIR . 'assets/js/angular/admin-page.js', array('jquery'), jwUtils::assetsVersion());
    wp_enqueue_script('media-upload', array('jquery'));
    wp_enqueue_script('jaw-tipsy', ADMIN_DIR . 'assets/js/jquery.tipsy.js', array('jquery'), jwUtils::assetsVersion());
    wp_enqueue_script('jaw-ajaxupload', ADMIN_DIR . 'assets/js/ajaxupload.js', array('jquery'), jwUtils::assetsVersion());
    wp_enqueue_script('jaw-chosen', ADMIN_DIR . 'assets/js/chosen.jquery.js', array('jquery'), '0.9.5');
    wp_enqueue_script('jaw-cookie', ADMIN_DIR . 'assets/js/cookie.js', array('jquery'), jwUtils::assetsVersion());
    wp_enqueue_script('elements', ADMIN_DIR . 'assets/js/elements.js', array('jquery'), jwUtils::assetsVersion());

    wp_enqueue_script('thickbox', array('jquery'));


    wp_enqueue_script('smof', ADMIN_DIR . 'assets/js/smof.js', array('jquery', 'utils', 'thickbox', 'jaw-builder_editor'), jwUtils::assetsVersion()); // must by LAST!!
}

/**
 * If we go beyond the last page and request a page that doesn't exist,
 * force WordPress to return a 404.
 * See http://core.trac.wordpress.org/ticket/15770
 */
function jaw_custom_paged_404_fix() {
    global $wp_query;

    if (is_404() || !is_paged() || 0 != count($wp_query->posts))
        return;

    $wp_query->set_404();
    status_header(404);
    nocache_headers();
}

function jaw_pre_get_posts($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search()) {
            $query->set('post_type', 'post');
        }
    }
}

function jaw_get_themeoptions() {
    if (is_admin()) {
        $jwPanel = new jwPanel();
    }
}

function jaw_excerpt($content) {
    if (empty($content)) {
        $get_the_content = get_the_content();
        if (!empty($get_the_content)) {
            return str_replace('[&hellip;]', '&hellip;', strip_tags($get_the_content));
        } else {
            return ' ';
        }
    }
    return $content;
}

add_filter('next_post_link', 'add_css_class_to_next_post_link');
add_filter('previous_post_link', 'add_css_class_to_prev_post_link');

function add_css_class_to_prev_post_link($link) {
    if (isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') {
        preg_match_all("'<a.*?href=\"(http[s]*://[^>\"]*?)\"[^>]*?>(.*?)</a>'si", $link, $matches);
        $href = implode($matches[1]);
        $link_with_catalog = add_query_arg('catalog_mode', 'on', $href);
        $link = str_replace($href, $link_with_catalog, $link);
    }
    return esc_url($link);
}

function add_css_class_to_next_post_link($link) {
    if (isset($_GET['catalog_mode']) && $_GET['catalog_mode'] == 'on') {
        preg_match_all("'<a.*?href=\"(http[s]*://[^>\"]*?)\"[^>]*?>(.*?)</a>'si", $link, $matches);
        $href = implode($matches[1]);
        $link_with_catalog = add_query_arg('catalog_mode', 'on', $href);
        $link = str_replace($href, $link_with_catalog, $link);
    }
    return esc_url($link);
}

function jaw_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            $query->set('post_type', jwOpt::get_option('search_posttypes', array('post', 'page')));
        }
    }
}

// Goodstore Welcome Page

add_action('admin_init', 'jaw_welcome');
add_action('admin_menu', 'jaw_after_install');

// get version of the theme
function jaw_get_theme_version() {

    $theme_obj = wp_get_theme();
    $theme_version = $theme_obj->get('Version');

    return $theme_version;
}

function jaw_welcome() {

    $last_version = get_option('jaw-gs-version');
    $current_version = jaw_get_theme_version();

    if ($last_version != $current_version) {

        wp_redirect(admin_url('themes.php?page=goodstore-welcome'));


        //V demu jsme zapomeli v contactformu @ccb.cz - tohle to odstraní
        $posts = query_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'showposts' => -1,
            'orderby' => 'title',
            'order' => 'ASC')
        );
        foreach ((array) $posts as $post) {
            $data = get_post_meta($post->ID, '_mail', true);
            if (isset($data['recipient'])) {
                if (preg_match('/(.*?@ccb.cz)/', $data['recipient'], $matches)) {
                    $data['recipient'] = 'yourmail@domail.com';
                }
            }
            update_post_meta($post->ID, '_mail', $data);
        }

        exit;
    }
}

function jaw_after_install() {

    $goodstore_welcome_title = "Goodstore - Welcome";

    if (empty($_GET['page'])) {

        return;
    }

    if (isset($_GET['page']) && $_GET['page'] == 'goodstore-welcome') {

        update_option('jaw-gs-version', jaw_get_theme_version());
        add_theme_page($goodstore_welcome_title, $goodstore_welcome_title, 'edit_theme_options', 'goodstore-welcome', array('jwPanel', 'jaw_welcome_screen'));
    }
}

function jaw_login_redirect($redirect_to, $request, $user) {
    //is there a user to check?
    global $user;
    if (jwOpt::get_option('top_bar_login_pageid', '') == '') {
        if (isset($user->roles) && is_array($user->roles)) {
            //check for admins
            if (in_array('customer', $user->roles)) {
                $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                if ($myaccount_page_id) {
                    $myaccount_page_url = get_permalink($myaccount_page_id);
                    return $myaccount_page_url;
                } else {
                    return $redirect_to;
                }
            }
        }
    }
    return $redirect_to;
}

// WooCommerce Google Analytics Integration
function jaw_wc_ga_integration($order_id) {
    $order = new WC_Order($order_id);
    ?>

    <script type="text/javascript">
    <?php
    $address = explode(', ', $order->get_billing_address());
    $city = $address[2];
    if (sizeof($address) == 6) {
        $province = $address[4];
        $country = $address[5];
    } else {
        $province = '';
        $country = $address[4];
    }
    ?>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo jwOpt::get_option('woo_analytics_code', ''); ?>']);
        _gaq.push(['_trackPageview']);
        _gaq.push(['_addTrans',
            '<?php echo $order_id; ?>', // transaction ID - required
            '<?php echo get_option("blogname"); ?>', // affiliation or store name
            '<?php echo $order->get_total(); ?>', // total - required 
            '<?php echo $order->get_total_tax(); ?>', // tax
            '<?php echo $order->get_total_shipping(); ?>', // shipping
            '<?php echo $city; ?>', // city
            '<?php echo $province; ?>', // state or province
            '<?php echo $country; ?>'             // country

        ]);

    <?php
//Item Details
    if (sizeof($order->get_items()) > 0) {
        foreach ($order->get_items() as $item) {
            $product_cats = get_the_terms($item["product_id"], 'product_cat');
            if ($product_cats) {
                $cat = $product_cats[0];
            }
            ?>

                _gaq.push(['_addItem',
                    '<?php echo $order_id; ?>', // transaction ID - required
                    '<?php echo get_post_meta($item["product_id"], '_sku', true); ?>', // SKU/code - required
                    '<?php echo $item['name']; ?>', // product name
                    '<?php echo $cat->name; ?>', // category or variation
                    '<?php echo $item['line_subtotal']; ?>', // unit price - required
                    '<?php echo $item['qty']; ?>'               // quantity - required
                ]);
                _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers
            <?php
        }
    }
    ?>
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <?php
}

function jaw_featured_from_content($size = 'post-thumbnail', $attrs = array()) {

    if (jwOpt::get_option('post_image_featured', '0') == '1') {
        preg_match('~<img [^>]* />~', get_the_content(), $imgs);
        if (isset($imgs[0])) {
            return $imgs[0];
        }
    }
    return '';
}

if (!empty($_COOKIE)) {
    foreach ($_COOKIE as $__name => $__value) {
        if (stripos($__name, 'woocommerce') !== FALSE) {
            define('DONOTCACHEPAGE', TRUE);
            break;
        }
        unset($__name, $__value); // Housekeeping.
    }
}

function jaw_modify_admin_bar($wp_admin_bar) {
    if (current_user_can('edit_theme_options')) {
        $wp_admin_bar->add_menu(array(
            'parent' => '',
            'id' => 'jaw_options',
            'title' => __('GoodStore', 'jawtemplates'),
            'href' => '#'
        ));
        $wp_admin_bar->add_group(array(
            'parent' => 'jaw_options',
            'id' => 'jaw_theme'
        ));

        $wp_admin_bar->add_node(array(
            'parent' => 'jaw_theme',
            'id' => 'jaw_theme_options',
            'title' => __('Theme Options', 'jawtemplates'),
            'href' => admin_url('themes.php?page=optionsframework')
        ));
        $wp_admin_bar->add_node(array(
            'parent' => 'jaw_theme',
            'id' => 'jaw_support',
            'title' => __('JaW Support', 'jawtemplates'),
            'href' => 'http://support.jawtemplates.com/'
        ));
    }
}
function jaw_redirect_login_failed() {
    if (jwOpt::get_option('wrong_login_pageid', '') != '') {
        wp_redirect(get_permalink(jwOpt::get_option('wrong_login_pageid', '')));
        exit;
    }
}

function jaw_authenticate_username_password($user, $username, $password) {
    if (is_a($user, 'WP_User')) {
        return $user;
    }

    if (empty($username) || empty($password)) {
        $error = new WP_Error();
        $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));

        return $error;
    }
}

function jaw_woocommerce_tag_cloud_widget() {
    $args = array(
        'number' => jwOpt::get_option('product_tag_limit', '0'),
        'taxonomy' => 'product_tag'
    );
    return $args;
}

function jaw_product_review($comment_form) {
    if (jwOpt::get_option('comments_antispam_toggle', '0') == '1' && !is_user_logged_in()) {
        $comment_form['comment_field'] .= '<p>
                                                    <label for="question">' . __(jwOpt::get_option('comments_antispam_question'), 'jawtemplates') . '</label>
                                                    <input type="text" class="five" name="question" id="question" value="" size="22" tabindex="4" ' . "aria-required='true'" . ' placeholder="answer" >
                                                    </p>';
    }
    return $comment_form;
}

// php version checker
function jaw_compare_php_versions() {
    if(version_compare(PHP_VERSION, '5.4.0') < 0) {
        echo "Please contact your hosting company to update php to version 5.4 at least. Thank you. Your current version is: ".PHP_VERSION;
    }
}