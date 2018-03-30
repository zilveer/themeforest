<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) exit; // Exit if accessed directly

require_once( YIT_CORE_PATH. '/lib/yit/layout/module/yit-layout-module.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/module/yit-layout-module-post_type.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/module/yit-layout-module-taxonomy.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/module/yit-layout-module-author.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/module/yit-layout-module-static.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/module/yit-layout-module-site.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/panel/yit-layout-panel.php' );
require_once( YIT_CORE_PATH. '/lib/yit/layout/yit-layout-options.php' );

/**
 * YIT Layout
 *
 * Manage Layout Panel in the YIT Framework
 *
 * @class      YIT_Layout
 * @package    Yitheme
 * @since      2.0
 * @author     Your Inspiration Themes
 */

class YIT_Layout {


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var object The instance of the panel
     * @since 1.0
     */
    protected $_panel = null;


    private $prefix = 'yit_lp_';
    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function __construct() {
//        if ( ! defined( 'YIT_CORE_PLUGIN' ) || YIT_CORE_PLUGIN ) {
//            return;
//        }

        // load the core plugins library from an yit-theme

        add_action( 'after_setup_theme', array( $this, 'activate' ) );

        add_action( 'admin_menu', array( &$this, 'add_setting_page' ), 11 );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

    }


    /**
     * Magic method to get value from db, for the current page
     *
     * @use \YIT_Layout_Options\get_option
     *
     * @param $var string The name of variable to get from database
     *
     * @return mixed
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function __get( $var ) {
        return YIT_Layout_Options()->get_option( $var );
    }

    /**
     * Magic method to get value from db, for the current page
     *
     * @use \YIT_Layout_Options\get_option
     *
     * @param string $key   the id of the otpion can be an interger or a string "all","404", "front-page"
     * @param bool   $id    is the id of the page/post/category/taxonomy/format/static page/author
     * @param string $type  is the type of the page/post/category/post_tag/author/
     * @param string $model can be taxonomy, post_type, static, author, site
     *
     * @return mixed
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public function get( $key, $id = false, $type = "post", $model = "post_type" ) {
        return YIT_Layout_Options()->get_option( $key, $id, $type, $model );
    }

    /**
     * Admin Enqueue Script
     *
     * add scripts and styles to sidebar panel
     *
     * @return   void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function admin_enqueue_scripts() {

        wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'accordion' );
        wp_enqueue_script( 'suggest' );
        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_style( 'jquery-ui-overcast', YIT_CORE_ASSETS_URL . '/css/overcast/jquery-ui-1.8.9.custom.css', false, '1.8.9', 'all' );
        wp_enqueue_style( 'yit-layout', YIT_CORE_ASSETS_URL . '/css/yit-layout.css', $this->version );
        wp_enqueue_script( 'yit-spinner', YIT_CORE_ASSETS_URL . '/js/admin/panel.spinner.js', array( 'jquery' ), '0.0.1', true );
        wp_enqueue_script( 'yit-layout-admin', YIT_CORE_ASSETS_URL . '/js/admin/yit-layout-admin.js', array( 'jquery', 'postbox' ), $this->version, true );
        wp_localize_script( 'yit-layout-admin', 'yit_layout_loc', array(
            'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
            'confirm_reset'  => __( 'Are you sure you want to clear all options for this page?', 'yit' ),
            'no_item'        => __( 'No item found.', 'yit' ),
        ) );
    }

    /**
     * Add Setting SubPage
     *
     * add Setting SubPage to wordpress administrator
     *
     * @return array validate input fields
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function add_setting_page() {

        add_submenu_page( 'yit_panel', __( 'Layouts ', 'yit' ), __( 'Layouts ', 'yit' ), 'manage_options', 'yit_layout_panel', array( $this, 'yit_layout_panel' ) );
    }

    /**
     * Yit Layout Panel
     *
     * print HTML code to layout panel
     *
     * @return   void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function yit_layout_panel() {
        yit_get_template( '/admin/layout/panel.php', array( 'options' => YIT_Layout_Panel()->options ) );
    }

    /**
     * Activate
     *
     * Run when the plugin is activated, add a custom options in database
     *
     * @return void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function activate() {
        YIT_Layout_Options()->add_default_options();
    }
}


/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Layout() {
    return YIT_Layout::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout();
