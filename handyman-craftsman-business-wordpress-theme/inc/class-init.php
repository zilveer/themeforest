<?php
namespace Handyman;

use Handyman\Core as C;

/**
 * Class Init
 * @package Handyman
 */
class Init
{

    public static $instance;


    /**
     * Unique theme key
     *
     * @var string
     */
    public static $theme_name;


    /**
     * Theme Option group key in DB
     *
     * @var string
     */
    public static $option_group;


    /**
     * List of loaded core files/classes
     *
     * @var
     */
    public $core;


    /**
     * Are we in customizer flag
     *
     * @var bool
     */
    public $is_customizing = false;


    /**
     * Loaded Classes
     *
     * @var bool
     */
    protected $_loaded = false;



    public function __construct()
    {
        self::$instance =& $this;

        // Get data from style.css
        $theme = wp_get_theme();

        // Define constants
        if (!defined('TL_THEME_SLUG')) {
            define('TL_THEME_SLUG', sanitize_file_name(strtolower($theme->name)));
            define('TL_DBKEY', TL_THEME_SLUG . '_db_key');
            self::$theme_name = TL_THEME_SLUG;
        }

        if (!defined('TL_DOMAIN')) { // Theme's text domain
            define('TL_DOMAIN', self::$theme_name);
        }

        if (!defined('TL_THEMENAME')) // TL_THEMENAME contains the Name of the currently loaded theme
            define('TL_THEMENAME', $theme->name);

        if (!defined('TL_THEME_VER')) // TL_THEME_VER is the Version
            define('TL_THEME_VER', $theme->version);

        if (!defined('TL_BASE')) // TL_BASE is the root server path of the parent theme
            define('TL_BASE', get_template_directory());

        if (!defined('TL_BASE_CHILD')) // TL_BASE_CHILD is the root server path of the child theme
            define('TL_BASE_CHILD', get_stylesheet_directory());

        if (!defined('TL_BASE_URL')) // TL_BASE_URL http url of the loaded parent theme
            define('TL_BASE_URL', get_template_directory_uri());

        if (!defined('TL_BASE_URL_CHILD')) // TL_BASE_URL_CHILD http url of the loaded child theme
            define('TL_BASE_URL_CHILD', get_stylesheet_directory_uri());

        if (!defined('TL_ASSET_DIR')) // Path to the build directory for front-end assets
            define('TL_ASSET_DIR', '/assets/');

        if(!defined('TL_COMPANY_URL')){
            define('TL_COMPANY_URL', 'http://themelaboratory.com/');
        }

        if(!defined('TL_REQ_WP_VERSION')){
            define('TL_REQ_WP_VERSION', '4.3');
        }

        if(!defined('TL_REQ_PHP_VERSION')){
            define('TL_REQ_PHP_VERSION', '5.4');
        }

        if(!defined('TL_REQ_LAYERS_VERSION')){
            define('TL_REQ_LAYERS_VERSION', '1.5');
        }

        $checker = new C\Environment_Checker(array(
            'php'       => TL_REQ_PHP_VERSION,
            'wp'        => TL_REQ_WP_VERSION,
            'layers'    => TL_REQ_LAYERS_VERSION,
            'mbstring'  => 'mbstring'
        ));

        /**
         * Only if all theme requirements are OK proceed with theme loading
         */
        if ($checker->checkCoreRequirements()) {
            // Core staff to load. List of all Classes
            $this->core = array(
                'incommon' => array( // Should execute in front and admin side if proper hook called
                    'Handyman\Core\Mobile_Detect',
                    'Handyman\Core\Theme_Init',
                    'Handyman\Core\Customizer',
                    'Handyman\Core\Assets',
                    'Handyman\Core\Sidebars',
                ),
                'front' => array( // Should execute on front only
                    'Handyman\Core\Comments',
                    'Handyman\Core\Colors',
                ),
                'admin' => array( // Should execute on admin side only
                    'Handyman\Admin\Admin_Init',
                    'Handyman\Admin\Admin_Ajax',
                    'Handyman\Admin\Theme_Activation'
                )
            );

            $this->_loaded = $this->tl__($this->core);
            $this->setupGlobals();

            /**
             * Include additional libraries
             */
            $this->_additional_libraries();
        }
    }



    /**
     * Additional staff required by the theme
     */
    protected function _additional_libraries()
    {
        $addition_libraries = array(
            'inc/core/class-util.php' , // Utility/Helpers function & classes
            'inc/core/class-custom-menu-walker.php'     , // Main navigation Walker
            'inc/vendor/class-tgm-plugin-activation.php', // Prepacked plugins required for this theme
            'inc/front-fnc.php'       , // Template functions
            'inc/content-filters.php' , // Content filters
            'inc/extras.php'          , // Custom functions
        );

        foreach($addition_libraries as $file){
            if (!$filepath = locate_template($file)) {
                trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);
            }
            require_once $filepath;
        }
    }



    /**
     * Class instanciation with a singleton factory :
     * Thanks to Ben Doherty (https://github.com/bendoh) for the great programming approach
     *
     * @param $load
     */
    public function tl__($load = array())
    {
        static $instances;

        $this->is_customizing = self::isCustomizing();
        self::$option_group = self::$theme_name;

        foreach ($load as $group => $classes) {
            if (!is_admin() && !$this->is_customizing) {
                if ($group == 'admin') continue;
            }
            if (is_admin() && !$this->is_customizing) {
                if ($group == 'front') continue;
            }
            foreach ($classes as $c) {
                if (!isset($instances[$c])) $instances[$c] = new $c;
            }
        }
        return $instances;
    }


    /**
     *
     */
    public function setupGlobals()
    {
        global $tl_glob_mobile;
        $tl_glob_mobile = $this->_loaded['Handyman\Core\Mobile_Detect'];
    }


    /**
     * @return mixed
     */
    public function mobile()
    {
        return self::$instances['Handyman\Core\Mobile_Detect'];
    }


    /**
     * Returns a boolean on the customizer's state
     */
    public static function isCustomizing()
    {
        //checks if is customizing : two contexts, admin and front (preview frame)
        global $pagenow;
        $bool = false;
        if (is_admin() && isset($pagenow) && 'customize.php' == $pagenow)
            $bool = true;
        if (!is_admin() && isset($_REQUEST['wp_customize']))
            $bool = true;
        if (self::doingCustomizerAjax())
            $bool = true;
        return $bool;
    }


    /**
     * Returns a boolean
     */
    public static function doingCustomizerAjax()
    {
        return isset($_POST['customized']) && (defined('DOING_AJAX') && DOING_AJAX);
    }
}

new Init();