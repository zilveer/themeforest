<?php
namespace Handyman\Core;

use \Handyman\Front as F;

/**
 * Class Assets
 * @package Handyman\Core
 */
class Assets
{

    public static $instance;
    public static $use_min_css;
    public static $use_min_js;

    public static $is_popup;


    public function __construct()
    {
        self::$instance =& $this;

        add_action('wp_enqueue_scripts', array($this, 'enqueueCssStyles'),99);
        add_action('wp_enqueue_scripts', array($this, 'enqueueJsScripts'));
        add_action('wp_enqueue_scripts', array($this, 'removeScripts'), 100);

        self::$is_popup = isset($_REQUEST['tl_popup']) ? true : false;
    }


    /**
     * Enqueue CSS styles
     */
    public function enqueueCssStyles()
    {
        self::$use_min_css = F\tl_copt('min-css');

        wp_enqueue_style('normalize', self::assetPath('css/vendor/vendor.css')); // Components

        if (!self::$is_popup) {
            wp_enqueue_style(TL_THEME_SLUG . 'tl-page-loader', self::assetPath('css/tl-page-loader.css'), array(), TL_THEME_VER);
            wp_enqueue_style('flex-nav', self::assetPath('js/vendor/flexnav/css/flexnav.css'), array(), TL_THEME_VER);
        }
        //LAYERS_THEME_SLUG . '-icon-fonts'
        // Parent Css
        // Make sure to load child Css last. It is to say re-enqueue parent CSS scripts
        wp_dequeue_style('layers-components');
        wp_enqueue_style('layers-components', self::assetPath('css/components.css', true), array('layers-framework')); // Components
        wp_dequeue_style('layers-responsive');
        wp_enqueue_style('layers-responsive', self::assetPath('css/responsive.css', true), array('layers-framework')); // Components
        wp_dequeue_style('layers-icon-fonts');
        wp_enqueue_style('layers-icon-fonts', self::assetPath('css/layers-icons.css', true), array('layers-framework')); // Components

        // Child Css
        wp_enqueue_style(TL_THEME_SLUG . 'ie', self::assetPath('css/partials/ie.css'), array(), TL_THEME_VER);
        wp_style_add_data(TL_THEME_SLUG . 'ie', 'conditional', 'IE ');


        if (!self::$is_popup) {
            wp_enqueue_style('pretty-photo', self::assetPath('js/vendor/pretty-photo/css/prettyPhoto.css'), false, TL_THEME_VER);
        }

        //wp_enqueue_style(TL_THEME_SLUG . 'animate', self::assetPath('css/vendor/animate.css/animate.min.css'), false, TL_THEME_VER);
        //@todo this should be added ONLY if needed
        wp_enqueue_style(TL_THEME_SLUG . 'magnific-popup', self::assetPath('js/vendor/magnific-popup/magnific-popup.css'), false, TL_THEME_VER);

        wp_enqueue_style(TL_THEME_SLUG . 'responsive', self::assetPath('css/partials/_responsive.css'), array(TL_THEME_SLUG . 'theme'), TL_THEME_VER);
        wp_enqueue_style(TL_THEME_SLUG . 'theme', self::assetPath('css/theme.css'), array(), TL_THEME_VER);
        wp_enqueue_style('theme-flaticons', Assets::assetPath('css/themify-icons.css'), array(), TL_THEME_VER);
        wp_enqueue_style(TL_THEME_SLUG . '-font-awesome', Assets::assetPath('css/font-awesome.css'), array(), TL_THEME_VER);
    }


    /**
     * Enqueue JS scripts
     */
    public function enqueueJsScripts()
    {
        global $wp_scripts, $wp_customize;

        self::$use_min_js = F\tl_copt('min-js');

        wp_enqueue_script('modernizr', self::assetPath('js/vendor/modernizr.js'), array(), TL_THEME_VER);
        wp_enqueue_script('html5shiv_js', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', array(), TL_THEME_VER);
        $wp_scripts->add_data('html5shiv_js', 'conditional', 'lt IE 9');

        if(version_compare(LAYERS_VERSION, '1.2.12', '<')){
            wp_enqueue_script(TL_THEME_SLUG . 'tl-pageloader', self::assetPath('js/tl-page-loader.js'), array(LAYERS_THEME_SLUG.'-plugins-js'), TL_THEME_VER);
        }else{
            wp_enqueue_script(TL_THEME_SLUG . 'tl-pageloader', self::assetPath('js/tl-page-loader.js'), array(LAYERS_THEME_SLUG.'-plugins'), TL_THEME_VER);
        }

        wp_enqueue_script('hoverIntent');

        if (!self::$is_popup) {
            //Waypoints
            wp_enqueue_script('flex-nav', self::assetPath('js/vendor/flexnav/js/jquery.flexnav.js'), array('jquery'), TL_THEME_VER, true);
            wp_enqueue_script('pretty-photo', self::assetPath('js/vendor/pretty-photo/js/jquery.prettyPhoto.js'), array('jquery'), TL_THEME_VER, true);
        }

        //vendor
        //wp_enqueue_script(TL_THEME_SLUG . 'jquery-scrollto', self::assetPath('js/vendor/jquery.scrollTo/jquery.scrollTo.min.js'), array('jquery'), TL_THEME_VER, true);
        //@todo this should be added ONLY if needed //vendor
        //wp_enqueue_script(TL_THEME_SLUG . 'magnific-popup', self::assetPath('js/vendor/magnific-popup/jquery.magnific-popup.js'), array('jquery'), TL_THEME_VER, true);
        //@todo this should be added ONLY if needed //vendor
        //wp_enqueue_script(TL_THEME_SLUG . 'float-label', self::assetPath('js/vendor/floatlabels.js/floatlabels.min.js'), array('jquery'), TL_THEME_VER, true);
        wp_enqueue_script(TL_THEME_SLUG . 'vendors', self::assetPath('js/vendor/vendors.js'), array('jquery'), TL_THEME_VER, true);




        // if(!self::$is_popup) {
        wp_enqueue_script(TL_THEME_SLUG . 'child-theme', self::assetPath('js/theme.js'), array('jquery'), TL_THEME_VER, true);

        // Pass requried data to JavaScript
        wp_localize_script(TL_THEME_SLUG . 'child-theme', 'TL_CONF', $this->generateThemeSettings());
        //}

        if (!self::$is_popup) {
            //@todo this should be inserted ONLY if map widget present or map activated on inner pages
            if (!isset($wp_customize)) {
                // Unregister layers map js
                wp_dequeue_script(LAYERS_THEME_SLUG . "-map-trigger");
                wp_enqueue_script(LAYERS_THEME_SLUG . "-map-trigger", self::assetPath('js/vendor/maps.js'), array('jquery', LAYERS_THEME_SLUG . " -map-api"), LAYERS_VERSION);
                wp_enqueue_script('vendor-infobox', self::assetPath('js/vendor/infobox.js'), array(LAYERS_THEME_SLUG . "-map-trigger", LAYERS_THEME_SLUG . " -map-api"), TL_THEME_VER, true);
            }else{
                wp_dequeue_script(LAYERS_THEME_SLUG . "-map-trigger");
            }
        }
    }


    /**
     * Remove parent's JS scripts
     */
    public function removeScripts()
    {
        $layers_framework_script = LAYERS_THEME_SLUG . '-framework';

        if(version_compare(LAYERS_VERSION, '1.2.12', '<')){
            $layers_framework_script .= '-js';
        }

        wp_dequeue_script($layers_framework_script);
        if (wp_script_is(LAYERS_THEME_SLUG . '-slider-js', $list = 'enqueued')) {
            wp_dequeue_script(LAYERS_THEME_SLUG . '-slider-js');
            wp_enqueue_script(LAYERS_THEME_SLUG . '-slider-js', self::assetPath('/core/widgets/js/swiper.js', true), array('jquery'), LAYERS_VERSION, true);
        }
    }


    /**
     * @return array
     */
    public function generateThemeSettings()
    {
        // Get the protocol of the current page
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $confs = array(
            'ajaxurl' => admin_url('admin-ajax.php', $protocol),
            'baseurl' => site_url(),
            'themeurl' => TL_BASE_URL_CHILD,
            'is_popup' => self::$is_popup ? 1 : 0,
            'contact' => array(
                'txt1' => F\tl_copt('contact-txt1'),
                'txt2' => F\tl_copt('contact-txt2'),
                'phone' => F\tl_copt('contact-phone'),
                'email' => F\tl_copt('contact-email'),
                'company' => F\tl_copt('contact-company'),
                'address' => F\tl_copt('contact-address'),
                'find_us' => F\tl_copt('contact-find-us'),
                'or' => __('or', TL_DOMAIN),
                'fphone' => apply_filters('tl/wrap_nth_word', F\tl_copt('contact-phone')),

                //popup
                'popup_hide_footer' => F\tl_copt('popup-hide-footer'),
                'popup_hide_btn' => F\tl_copt('hide-btn'),
                'btn_label' => F\tl_copt('btn-label'),
                'btn_link' => F\tl_copt('btn-link'),
            ),
        );
        return $confs;
    }


    /**
     * Resolve path to the asset script
     *
     * @param string $filename
     * @param bool $parent if TRUE get file from parent theme
     * @return string
     */
    public static function assetPath($filename, $parent = false, $nomin = false)
    {
        $dist_url = (($parent) ? TL_BASE_URL : TL_BASE_URL_CHILD) . TL_ASSET_DIR;
        $dist_path = (($parent) ? TL_BASE : TL_BASE_CHILD) . TL_ASSET_DIR;
        $directory = dirname($filename) . '/';
        $file = basename($filename);

        $file_parts = explode('.', $file);
        $ext = $file_parts[count($file_parts) - 1];
        $has_min_version = false;

        if ($file_parts[count($file_parts) - 2] != 'min') {
            $file_min = str_replace('.' . $ext, '.min.' . $ext, $file);

            if (file_exists($dist_path . $directory . $file_min)) {
                $has_min_version = true;
            }
        }

        $use_min = false;
        $p = '';
        if ($ext == 'css' || $ext == 'js') {
            $p = 'use_min_' . $ext;
            $use_min = self::$$p;
        }

        if ((!defined('WP_ENV') || WP_ENV !== 'development') && $has_min_version && $use_min && !$nomin) {
            return $dist_url . $directory . $file_min;
        } else {
            return $dist_url . $directory . $file;
        }
    }
}