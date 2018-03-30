<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Manage external plugins.
 *
 * @since 1.0.0
 */

require_once YIT_CORE_PATH . '/lib/vendors/tgm-plugin-activation/class-tgm-plugin-activation.php';

class YIT_Plugins {

    /**
     * Plugins loaded
     *
     * @var array
     * @access public
     * @since 1.0.0
     */
    public $plugins = array();


    /**
     * Constructor
     */
    public function __construct() {
        if( !defined('YIT_EXTERNAL_PLUGINS') ) return;

        $this->plugins = apply_filters('yit_plugins', $this->plugins);

        add_action( 'tgmpa_register', array( $this, 'register_required_plugins') );
        add_filter( 'tgmpa_message_type_notice_ask_to_update', array( $this, 'message_type_notice_ask_to_update' ));
        add_action( 'admin_menu', array( $this, 'update_plugins_page') );
        add_action( 'yit_theme_updated', array( $this, 'delete_dismissed_notice' ) );
    }

    /**
     * Init
     *
     */
    public function init() {

    }


    /**
     * Register the plugins needed from the theme
     *
     */
    public function register_required_plugins() {
        $config = array(
            'domain'       		=> 'yit',         	            // Text domain - likely want to be the same as your theme.
            'parent_menu_slug' 	=> 'yit_panel', 				// Default parent menu slug
            'parent_url_slug' 	=> 'admin.php', 				// Default parent URL slug
            'menu'         		=> 'install-required-plugins', 	// Menu slug
            'is_automatic'    	=> false,
        );

        tgmpa( $this->plugins, $config );
    }

    /**
     * Add link to the "Update plugins" message
     *
     * @param $string
     * @return string
     */
    public function message_type_notice_ask_to_update( $string ) {
        return str_replace("</p>", sprintf(__(" <a href='%s' class='how_to_update'>Learn how to update</a>", 'yit'), admin_url('options.php?page=update-plugins-page')) . "</p>", $string);
    }

    /**
     * Print update plugins page
     *
     */
    public function update_plugins_page() {
        add_submenu_page(
            null
            , 'How to update bundled plugins'
            , 'How to update bundled plugins'
            , 'manage_options'
            , 'update-plugins-page'
            , array($this, 'update_plugins_page_callback')
        );
    }

    /**
     * Print page with instructions for install bundled plugins
     *
     * @since 1.0.0
     */
    public function update_plugins_page_callback() {
        yit_get_template("admin/plugins/instructions.php", false);
    }

    /**
     * Delete dismissed notice
     *
     */
    public function delete_dismissed_notice() {
        global $wpdb;
        $query = "DELETE
                  FROM  $wpdb->usermeta
                  WHERE  `meta_key` LIKE  'tgmpa_dismissed_notice'";

        $wpdb->query($query);
    }
}