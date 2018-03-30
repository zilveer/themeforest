<?php
/*
Plugin Name: YIT Faq
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: YIT plugin for the add Faq custom post type
Text Domain: yit
Domain Path: /languages/
Author: Yithemes
Author URI: http://yithemes.com/
Version: 1.0.3
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * YIT FAQ VERSION
 */
define( 'YIT_FAQ_VERSION', '1.0.3' );

// load the core plugins library from an yit-theme
add_action( 'after_setup_theme', 'yit_faq_loader', 1 );
add_action( 'plugins_loaded', 'yit_faq_load_text_domain' );

// add a new db table when the plugins is activated
register_activation_hook( __FILE__ , 'yit_faq_activate' );

/**
 * Load the plugin text domain for localization
 *
 * @return void
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 */
function yit_faq_load_text_domain(){
    load_plugin_textdomain( 'yit', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );
}

/**
 * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
 *
 * @return void
 * @since  1.0
 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
 * @author Andrea Grillo   <andrea.grillo@yithemes.com>
 */
function yit_faq_loader() {
    if( yit_check_plugin_support() ) {
        require_once 'yit-faq.php';
    }
}

/**
 * Add a new table to term meta
 *
 * Run when the plugin is activated, add a new table in database to store term meta
 *
 * @return void
 * @since    1.0
 * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function yit_faq_activate() {

    global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $collate = '';

    if ( $wpdb->has_cap( 'collation' ) ) {
        if ( ! empty( $wpdb->charset ) ) {
            $collate .= "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if ( ! empty( $wpdb->collate ) ) {
            $collate .= " COLLATE $wpdb->collate";
        }
    }
    // Term meta table - sadly WordPress does not have termmeta so we need our own
    $sql = "
		CREATE TABLE IF NOT EXISTS {$wpdb->prefix}faq_termmeta (
		  meta_id bigint(20) NOT NULL AUTO_INCREMENT,
		  faq_term_id bigint(20) NOT NULL,
		  meta_key varchar(255) NULL,
		  meta_value longtext NULL,
		  PRIMARY KEY  (meta_id)
		) $collate;
		";

    dbDelta( $sql );
}