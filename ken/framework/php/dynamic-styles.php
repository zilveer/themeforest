<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * This file is responsible from all dynamic css and js proccess and minification
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 3.4
 * @package     artbees
 */

class Mk_Static_Files
{
    const THEME_OPTIONS_CSS = 'theme-options.css';
    function __construct($with_actions = true) {
        global $mk_dev;
        require_once THEME_INCLUDES . '/minify/src/Minifier.php';
        require_once THEME_INCLUDES . '/minify/src/SimpleCssMinifier.php';

        $mk_dev = (defined('MK_DEV') ? constant("MK_DEV") : false);

        add_action('wp_head', array(&$this, 'init_global_vars'),2);

        add_action('wp_enqueue_scripts', array(&$this,
            'process_global_styles'
        ), 30);

        add_action('wp_enqueue_scripts', array(&$this,
            'addThemeOptionsCSSToEnqueue'
        ) , 20);
    }



    static function is_referer_admin_ajax()
    {
        global $pagenow;

        $result = in_array($pagenow, array(
            'admin-ajax.php'
        ));

        if($result) {
            return true;
        }
    }


        static function is_page_backend()
    {
        $is_admin = !(!is_numeric(strpos($_SERVER["REQUEST_URI"],"?wc-ajax")) and !is_admin() and !( in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php','admin-ajax.php')) and !is_numeric(strpos($_SERVER["REQUEST_URI"],"/wp-admin")) and !is_numeric(strpos($_SERVER["REQUEST_URI"],"wc-ajax"))   ));

        if($is_admin) {
            return true;
        }
    }

     /**
     * Append global styles that set in theme options into app_global_dynamic_styles global variable.
     * @param string $styles
     *
     */
    static function addGlobalStyle($styles) {
        global $app_global_dynamic_styles;
        
        $app_global_dynamic_styles.= $styles;
    }
    
    /**
     * Append local styles that set in post meta options into app_local_dynamic_styles global variable.
     * @param string $styles
     *
     */
    static function addLocalStyle($styles) {
        global $app_local_dynamic_styles;
        
        $app_local_dynamic_styles.= $styles;
    }


    /**
     * Load the dynamic files. these files can be overrided in child themes if needed.
     *
     */
    public function include_files() {
        $styles_dir = get_template_directory() . '/dynamic-styles/*/*.php';
        
        $styles = glob($styles_dir);
        
        foreach ($styles as $style) {
            include_once ($style);
        }
    }

    /**
     * Define the global variables for dynamic shortcode styles, global and posts dynamic styles.
     *
     */
    public function init_globals() {
        
        $app_dynamic_styles = array();
        $app_global_dynamic_styles = $app_local_dynamic_styles = '';
        
        global $app_dynamic_styles, $app_global_dynamic_styles, $app_local_dynamic_styles;
    }

    /**
     * Initialize global variables in wp_head.
     *
     */
    function init_global_vars() {
        global $mk_shortcode_order;

        $mk_shortcode_order = 0;
    }
    
    /**
     * Append shortcode css files into app_dynamic_styles global variable.
     * @param string $app_styles
     * @param int $id
     *
     */
    static function shortcode_id() {
        global $mk_shortcode_order;
        
        $mk_shortcode_order++;
        return $mk_shortcode_order;
    }


    /**
     * Append shortcode css files into app_dynamic_styles global variable.
     * @param string $app_styles
     * @param int $id
     */
    static function addCSS($app_styles, $id) {
        global $app_dynamic_styles;
        
        $app_dynamic_styles[] = array(
            'id' => $id,
            'inject' => $app_styles
        );

        if(self::is_referer_admin_ajax()) {
            echo '<style type="text/css">'.$app_styles.'</style>';  
        }

    }


     /**
     * Inset dynamic styles retrived from post meta options
     * @param int $id
     * @return string $css
     */
    function insert_shortcode_styles($id) {
        if (!$id) return;
        $css = '';
        $styles = unserialize(base64_decode(get_post_meta($id, '_dynamic_styles', true)));
        if (!empty($styles)) {
            foreach ($styles as $style) {
                $css.= $style['inject'];
            }
        }
        return $css;
    }

    /**
     * Enqueues Theme Options CSS File
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0
     * @last_update Version 5.0.5
     */
    static function addThemeOptionsCSSToEnqueue() {
        global $mk_dev;
        global $dynamic_theme_options_css;

        if (get_option("global_theme_options") == "" or $mk_dev or !file_exists(self::get_global_asset_upload_folder("directory") . get_option("global_theme_options"))) {
            $dynamic_theme_options_css = true;
        }

        if ((get_option("global_theme_options") != "" and file_exists(self::get_global_asset_upload_folder("directory") . get_option("global_theme_options")))) {
            $dynamic_theme_options_css = false;
            $theme_options_css = self::get_global_asset_upload_folder("url") . get_option("global_theme_options");
            if ($theme_options_css) {
                if ($mk_dev == false) wp_enqueue_style('theme-options', $theme_options_css, array(), self::global_assets_timestamp());
            }
        }
    }

    function process_global_styles() {

        // theme style file should be loaded first
        wp_enqueue_style('mk-style', get_stylesheet_uri() , false, false, 'all');

        // declaring the globals
        global $mk_settings, $app_local_dynamic_styles, $app_global_dynamic_styles;

        $this->init_globals();
        $this->include_files();

        $output  = $app_local_dynamic_styles;
        if(!get_option('global_theme_options')) {
            $output .= $app_global_dynamic_styles;
        }
        //   $output .= $app_global_dynamic_styles;
        // test
        $output.= mk_enqueue_font_icons();

        $output.= $this->insert_shortcode_styles(global_get_post_id());

        $output.= $mk_settings['custom-css'];

        $minifier = new SimpleCssMinifier();
        $output = $minifier->minify($output);


        $time = "production";
        $filename = str_replace(".css", "-" . $time . ".css", self::THEME_OPTIONS_CSS);
        $folder = self::get_global_asset_upload_folder("directory");
        self::StoreAsset($folder, $filename, $app_global_dynamic_styles);
        update_option("global_theme_options", $filename, true);


        wp_enqueue_style('theme-dynamic-styles', get_template_directory_uri() . '/custom.css');
        wp_add_inline_style('theme-dynamic-styles', $output);
    }

    /**
     * Stores the asset and updates the option if specified.
     *
     * @param $folder
     * @param $filename
     * @param $file_content
     */
    static function StoreAsset($folder, $filename, $file_content) {
        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        self::createPath($folder);
        $sha1_concat_string = sha1($file_content);
        $file_path = path_convert($folder . '' . $filename);
        if (get_option($filename . "_sha1") != $sha1_concat_string or !file_exists($file_path)) {
            $comment = "/* ".time()." */";
            $minifier = new SimpleCssMinifier();
            $file_content = $minifier->minify($file_content);
            $wp_filesystem->put_contents($file_path, $comment . $file_content, FS_CHMOD_FILE);
            update_option($filename . "_sha1", $sha1_concat_string);
        }
    } 
 
    /**
     * If the path is already exists returns true.
     * If it doesn't creates the path.
     * When something goes wrong returns false.
     * @param $path
     * @return bool
     *
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0
     */
    static function createPath($path) {
        if (is_dir($path)) return true;
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
        $return = self::createPath($prev_path);
        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

    /**
     * Gets the upload folder address by the specified type.
     * Type variable should be passed as "directory" or "url"
     *
     * Usage Example:
     * $type = "directory";
     *
     * @param $type
     * @return string
     *
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0
     */
    static function get_global_asset_upload_folder($type) {
        $upload_folder_name = "mk_assets";
        $wp_upload_dir = wp_upload_dir();
        if ($type == "directory") {
            $upload_dir = $wp_upload_dir['basedir'] . '/' . $upload_folder_name . '/';
        }
        else if ($type == "url") {
            $upload_dir = $wp_upload_dir['baseurl'] . '/' . $upload_folder_name . '/';
        }
        else {
            return "";
        }

        return $upload_dir;
    }


    /**
     * If the file is not exists or deleted successfully returns true.
     * When something goes wrong returns false.
     * @param $path
     * @return bool
     *
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0
     */
    static function deleteFile($filename) {
        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        if (!$wp_filesystem->exists($filename)) return true;

        return $wp_filesystem->delete($filename);
    }

    /**
     * Deletes the the mk_assets/theme_options-time.css file
     *
     * @param bool|true $minify
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0
     */
    public function DeleteThemeOptionStyles() {
        $filename = get_option('global_theme_options');
        $folder = $this->get_global_asset_upload_folder("directory");

        if ($this->deleteFile($folder . '' . $filename) != true and $filename != "") {
            die("A problem occurred while trying to delete theme-options css file");
        }
        else {
            update_option("global_theme_options", "", true);
            return true;
        }
    }

    /**
     * Takes the timestamp of the global assets. Creates if it's not yet created.
     *
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.5
     * @last_update Version 5.0.5
     */
    static function global_assets_timestamp() {

        $timestamp = get_option('global_assets_timestamp');

        if(!is_numeric($timestamp)) {
            $timestamp = time();
            update_option('global_assets_timestamp',$timestamp);
        }

        return $timestamp;
    }

}
new Mk_Static_Files();

