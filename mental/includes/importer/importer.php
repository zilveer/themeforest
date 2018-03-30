<?php
/**
 * Wordpress Azelab Importer plugin
 *
 * @author: Vedmant <vedmant@gmail.com>
 * @version: 1.0.0
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

define( 'WP_LOAD_IMPORTERS', true);

$azl_import = true;

if ( ! current_user_can( 'manage_options' ) ) $azl_import = false;

if ( ! class_exists( 'WP_Import' ) ) { // if WP importer doesn't exist
	$wp_import = get_template_directory() . '/includes/importer/wordpress-importer.php';
	if ( ! file_exists( $wp_import ) ) $azl_import = false;;
	require_once $wp_import;
}

if ( ! class_exists( 'Azl_Importer' ) ) { // if WP importer doesn't exist
	$wp_azl_importer = get_template_directory() . '/includes/importer/class-azl-importer.php';
	if ( ! file_exists( $wp_azl_importer ) ) $azl_import = false;;
	require_once $wp_azl_importer;
}

if( $azl_import ) {
	$Azl_Importer = new Azl_Importer();
}