<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


/**
 * YIT Plugin Sidebar
 *
 * Manage Sidebars in the YIT Framework
 *
 * @class      YIT_Plugin_Sidebar
 * @package    Yitheme
 * @since      1.0
 * @author     Your Inspiration Themes
 */


class YIT_Plugin_Sidebar {

    /**
     * @var string
     */
    public $version = YIT_SIDEBARS_VERSION;

    /**
     * @var string
     */
    public $plugin_url;

    /**
     * @var string
     */
    public $plugin_path;

    /**
     * @var string
     */
    public $plugin_assets_url;

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;


    /**
     * @var string the name of options for save custom sidebars in db
     */
    public $plugin_options = 'yit_sidebar_options';

    /**
     * @var array the list of custom sidebars
     */
    public $custom_sidebars = array();

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
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

        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/sidebar' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/sidebar' );
	    $this->plugin_assets_url = $this->plugin_url . '/assets';

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        add_action( 'widgets_init', array( &$this, 'register_sidebars' ) );
        add_action( 'admin_menu', array( &$this, 'add_setting_page' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

        add_action( 'wp_ajax_yit-add-sidebar', array( $this, 'ajax_add_sidebar' ) );
        add_action( 'wp_ajax_yit-delete-sidebar', array( $this, 'ajax_delete_sidebar' ) );

        $this->custom_sidebars = get_option( $this->plugin_options );
        $this->custom_sidebars = ( ! empty( $this->custom_sidebars ) ) ? $this->custom_sidebars : array();

    }

	/**
	 * Fix the base path and base url of plugin
	 *
	 * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
	 * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
	 */
	public function set_path_and_url_by_plugin() {
        if ( file_exists( get_template_directory() . '/theme/plugins/yit-framework/' ) ) {
            return;
        }

		$this->plugin_url        = untrailingslashit( plugins_url( '/', __FILE__ ) );
		$this->plugin_path       = untrailingslashit( plugin_dir_path( __FILE__ ) );
		$this->plugin_assets_url = $this->plugin_url. '/assets' ;
	}

    /**
     * Ajax Add Sidebar
     *
     * add a new sidebar at the end of custom sidebar list
     *
     * @return   void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function ajax_add_sidebar() {

        if ( ! isset( $_POST['wpnonce-sidebar'] ) || ! wp_verify_nonce( $_POST['wpnonce-sidebar'], 'yit-add-sidebar' ) ) {
            return;
        }

        $new_sidebar = ( isset( $_POST['add-sidebar-name'] ) ) ? trim( $_POST['add-sidebar-name'] ) : false;

        $data['message'] = '<div id="message" class="error fade"><p><strong>' . __( 'An error has occurred. Please reload the page and try again.', 'yit' ) . '</strong></p></div>';

        if ( $new_sidebar ) {
            if ( ! in_array( $new_sidebar, $this->custom_sidebars ) ) {
                $this->custom_sidebars[] = trim( $_POST['add-sidebar-name'] );
                if ( update_option( $this->plugin_options, $this->custom_sidebars ) ) {
                    $data['message'] = '<div id="message" class="updated fade"><p><strong>' . __( 'Element updated correctly.', 'yit' ) . '</strong></p></div>';
                }
            }
            else {
                $data['message'] = '<div id="message" class="error fade"><p><strong>' . __( 'The element you have written is already exists. Please, add another name', 'yit' ) . '</strong></p></div>';
            }
        }

        $data['sidebars'] = $this->custom_sidebars;
        $data['nonce']    = wp_create_nonce( 'delete-sidebar' );
        echo json_encode( $data );

        die();

    }


    /**
     * Ajax Delete Sidebar
     *
     * delete a sidebar from custom sidebar list
     *
     * @return   void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function ajax_delete_sidebar() {

        if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'delete-sidebar' ) ) {
            return;
        }

        $data['message'] = '<div id="message" class="error fade"><p><strong>' . __( 'An error has occurred. Please reload the page and try again.', 'yit' ) . '</strong></p></div>';
        if ( isset( $_POST['id'] ) && isset( $this->custom_sidebars[$_POST['id']] ) ) {
            unset( $this->custom_sidebars[$_POST['id']] );

            if ( update_option( $this->plugin_options, $this->custom_sidebars ) ) {
                $data['message'] = '<div id="message" class="updated fade"><p><strong>' . __( 'Element deleted correctly.', 'yit' ) . '</strong></p></div>';
            }

        }

        $data['sidebars'] = $this->custom_sidebars;
        $data['nonce']    = wp_create_nonce( 'delete-sidebar' );
        echo json_encode( $data );
        die();
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
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style( 'yit-layout', $this->plugin_assets_url . '/css/yit-layout.css', $this->version );
        wp_enqueue_style( 'jquery-ui-overcast', YIT_CORE_PLUGIN_URL . '/assets/css/overcast/jquery-ui-1.8.9.custom.css', false, '1.8.9', 'all' );
        wp_enqueue_script( 'yit-spinner', YIT_CORE_PLUGIN_URL . '/assets/js/panel.spinner.js', array( 'jquery' ), '0.0.1', true );
        wp_enqueue_script( 'yit-layout-admin', $this->plugin_assets_url . '/js/yit-layout-admin.js', array( 'jquery','postbox' ), $this->version, true );
        wp_localize_script( 'yit-layout-admin', 'yit_layout_loc', array(
            'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
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
        global $admin_page_hooks;
        if( ! isset( $admin_page_hooks['yit_plugin_panel'] ) ){
            $position = apply_filters( 'yit_plugins_menu_item_position', '62.32' );
            add_menu_page( 'yit_plugin_panel', __( 'YIT Plugins', 'yit' ), 'nosuchcapability', 'yit_plugin_panel', NULL, $this->plugin_url  . '/assets/images/yithemes-icon.png', $position );
        }
        add_submenu_page( 'yit_plugin_panel', __( 'YIT Sidebars', 'yit' ), __( 'YIT Sidebars', 'yit' ), 'manage_options', 'yit_sidebar_panel', array( $this, 'yit_sidebar_panel' ) );
    }


    /**
     * Yit Sidebar Panel
     *
     * print HTML code to sidebar panel
     *
     * @return   void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function yit_sidebar_panel() {
        yit_plugin_get_template( $this->plugin_path, '/admin/sidebar-panel.php', array( 'plugin_path' => $this->plugin_path ) );
        ?>

    <?php
    }


    public function register_sidebars(){
        if( !empty($this->custom_sidebars)){
            foreach($this->custom_sidebars as $sidebar){
                register_sidebar( array(
                    'name' => $sidebar,
                    'id' => strtolower( str_replace( ' ', '-', $sidebar ) ),
                    'description' => '',
                    'class' => apply_filters('yit_sidebar_class', ''),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ) );
            }
        }
    }

}


/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Plugin_Sidebar() {
    return YIT_Plugin_Sidebar::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Plugin_Sidebar();
