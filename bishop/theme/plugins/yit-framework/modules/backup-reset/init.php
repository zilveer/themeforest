<?php
/*
Plugin Name: YIT Backup&Reset
Plugin URI: http://www.yourinspirationweb.com
Description: YIT Framework plugin: Add Backup&Reset features
Author: YIThemes
Text Domain: yit
Domain Path: /languages/
Version: 1.2.2
Author URI: http://www.yithemes.com
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* === DEFINE === */
define( 'YIT_BACKUP_RESET', true );

if ( file_exists( get_template_directory() . '/theme/plugins/yit-framework/' ) ) {
    define( 'YIT_BACKUP_RESET_PATH', trailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/backup-reset' ) );
    define( 'YIT_BACKUP_RESET_URL',  trailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/backup-reset' ) );
}
else {
    define( 'YIT_BACKUP_RESET_PATH', plugin_dir_path( __FILE__ ) );
    define( 'YIT_BACKUP_RESET_URL', plugin_dir_url( __FILE__ ) );
}

define( 'YIT_BACKUP_RESET_THEME_PATH', YIT_BACKUP_RESET_PATH . 'theme' );
define( 'YIT_BACKUP_RESET_CONFIG_PATH', YIT_BACKUP_RESET_PATH . 'config' );
define( 'YIT_BACKUP_RESET_VERSION', '1.2.2' );

/* === REQUIRE === */
require_once 'yit-backup-reset-functions.php';
require_once 'Backup_reset.php';

/* === ACTIONS === */
add_action( 'after_setup_theme', 'yit_backup_reset_loader' );
add_action( 'plugins_loaded', 'yit_backup_reset_load_text_domain' );







