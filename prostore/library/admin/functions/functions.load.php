<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/admin/functions/functions.load.php
 * @file	 	1.0
 */
?>
<?php
/**
 * Functions Load
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
//global $pagenow;
require_once( ADMIN_PATH . 'functions/functions.php' );
//if (( $pagenow == 'admin.php' )) {
require_once( ADMIN_PATH . 'functions/functions.interface.php' );
require_once( ADMIN_PATH . 'functions/functions.options.php' );
require_once( ADMIN_PATH . 'functions/functions.admin.php' );
require_once( ADMIN_PATH . 'functions/functions.mediauploader.php' );
//}