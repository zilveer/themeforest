<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

//Check if user can manage plugins
if( ! current_user_can( 'activate_plugins' ) ){
    return false;
}

require_once ( YIT_CORE_PATH . '/lib/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php' );

/**
 * Add a page option in admin area
 *
 * @class YIT_Plugins
 * @package    Yithemes
 * @since      1.0.0
 * @author     Your Inspiration Themes
 */
class YIT_Plugins {

    /**
     * Plugins List
     *
     * @var array set the list of plugins loaded
     */
    public $plugins = array();

    /**
     * Remote repository xml
     *
     * @var string the url of remote repository
     */
    protected $_plugins_remote_url = 'http://update.yithemes.com/yit-plugins/repository.xml';


    /**
     * Array of remote repository xml
     *
     * @var array plugins of remote repository
     */
    protected $_xml_repository = array();

    /**
     * Constructor
     *
     * The function to be called to output the content for this page.
     *
     * @since  Version 2.0.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     * @return \YIT_Plugins
     */
    function __construct() {

        $this->plugins = include( YIT_THEME_PATH . '/plugins.php' );

        add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
        add_filter( 'tgmpa_message_type_notice_ask_to_update', array( $this, 'message_type_notice_ask_to_update' ) );
        add_action( 'admin_menu', array( $this, 'update_plugins_page' ) );
        add_action( 'yit_theme_updated', array( $this, 'delete_dismissed_notice' ) );

        //Update plugin filter
        add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );
        add_filter( 'plugins_api', array( $this, 'check_info' ), 10, 3 );
    }


    /**
     * Register the plugins needed from the theme
     *
     * @since  Version 2.0.0
     * @return void
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function register_required_plugins() {
        $config = array(
            'domain'           => 'yit', // Text domain - likely want to be the same as your theme.
            'parent_slug' 	=> 'yit_panel', // Default URL slug
            'capability'   => is_multisite() ? 'administrators' : 'edit_theme_options',
            'menu'             => 'install-required-plugins', // Menu slug
            'is_automatic'     => false,
        );

        tgmpa( $this->plugins, $config );
    }


    /**
     * Add a link to update notice string
     *
     * @since  Version 2.0.0
     *
     * @param $string
     *
     * @return void
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function message_type_notice_ask_to_update( $string ) {
        return str_replace( "</p>", sprintf( __( " <a href='%s' class='how_to_update'>Learn how to update</a>", 'yit' ), admin_url( 'options.php?page=update-plugins-page' ) ) . "</p>", $string );
    }

    /**
     * Update the plugin page
     *
     * @since    Version 2.0.0
     *
     * @return void
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function update_plugins_page() {
        add_submenu_page(
            null
            , 'How to update bundled plugins'
            , 'How to update bundled plugins'
            , 'manage_options'
            , 'update-plugins-page'
            , array( $this, 'update_plugins_page_callback' )
        );
    }

    /**
     * Print page with instructions for install bundled plugins
     *
     * @since    Version 2.0.0
     *
     * @return void
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function update_plugins_page_callback() {
        yit_get_template("admin/plugins/instructions.php", false);
    }



    /**
     * Add a link to update notice string
     *
     * @since    Version 2.0.0
     *
     * @return void
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */

    public function delete_dismissed_notice() {
        global $wpdb;
        $query = $wpdb->prepare( "DELETE FROM  $wpdb->usermeta WHERE `meta_key` LIKE %s", 'tgmpa_dismissed_notice' );

        $wpdb->query( $query );
    }


    /**
     * Check plugins version
     *
     * @since  2.0.0
     *
     * @param $transient
     *
     * @return object
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function check_update( $transient ) {
        $wp_plugins     = get_plugins();
        $remote_plugins = $this->get_plugins_from_xml();

        if ( ! empty( $remote_plugins ) && ! empty( $wp_plugins ) ) {
            foreach ( $wp_plugins as $key => $wp_plugin ) {
                foreach ( $remote_plugins as $remote_plugin ) {
                    if ( ( $wp_plugin['Name'] == $remote_plugin->name ) && version_compare( $wp_plugin['Version'], $remote_plugin->version, '<' ) ) {
                        $obj              = new stdClass();
                        $obj->slug        = (string) $remote_plugin->slug;
                        $obj->new_version = (string) $remote_plugin->version;
                        $obj->url         = (string) $remote_plugin->url;
                        $obj->package     = (string) $remote_plugin->package;
                        $obj->plugin      = $key;

                        $transient->response[$key] = $obj;
                    }
                }
            }
        }

        return $transient;
    }

    /**
     * Get plugins info
     *
     * @since    Version 2.0.0
     *
     * @param $false
     * @param $action
     * @param $arg
     *
     * @return stdClass
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function check_info( $false, $action, $arg ) {
        $remote_plugins = $this->get_plugins_from_xml();

        foreach ( $remote_plugins as $plugin ) {
            if ( isset( $arg->slug ) && isset( $plugin->slug ) ) {
                if ( $arg->slug == $plugin->slug ) {
                    $obj                = new stdClass();
                    $obj->slug          = $plugin->slug;
                    $obj->name          = (string) $plugin->name;
                    $obj->version       = (string) $plugin->version;
                    $obj->requires      = (string) $plugin->info->requires;
                    $obj->tested        = (string) $plugin->info->tested;
                    $obj->last_updated  = (string) $plugin->info->last_updated;
                    $obj->added         = (string) $plugin->info->added;
                    $obj->sections      = array(
                        'description' => (string) $plugin->info->sections->description,
                        'changelog'   => (string) $plugin->info->sections->changelog
                    );
                    $obj->download_link = (string) $plugin->package;

                    return $obj;
                }
            }

        }

        return false;
    }

    /**
     * Get the plugin array from the xml remote file
     *
     * @since    Version 2.0.0
     *
     * @return array | string
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function get_plugins_from_xml() {
        if ( ! empty( $this->_xml_repository ) ) {
            return $this->_xml_repository;
        }

        $xml_plugins = wp_remote_get( $this->_plugins_remote_url );
        $plugins     = array();

        if ( ! is_wp_error( $xml_plugins ) ) {
            $xml_plugins = wp_remote_retrieve_body( $xml_plugins );
            $xml         = simplexml_load_string( $xml_plugins );

            if ( ! empty( $xml ) && isset( $xml->plugin ) ) {
                $plugins = $xml->plugin;
            }
        }

        $this->_xml_repository = $plugins;

        return $plugins;
    }
}