<?php
/**
 * Theme options
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wolf_theme_options, $wolf_fonts, $theme_socials;

$wolf_theme_options = array(); // set theme options array

include_once( WOLF_THEME_DIR . '/includes/admin/options/main.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/styles.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/home.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/menu.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/header.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/fonts.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/blog.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/share.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/footer.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/socials.php' );

if ( class_exists( 'Wolf_Portfolio' ) )
	include_once( WOLF_THEME_DIR . '/includes/admin/options/portfolio.php' );

if ( class_exists( 'Wolf_Albums' ) )
	include_once( WOLF_THEME_DIR . '/includes/admin/options/albums.php' );

if ( class_exists( 'Wolf_Videos' ) )
	include_once( WOLF_THEME_DIR . '/includes/admin/options/videos.php' );

if ( class_exists( 'Wolf_Discography' ) )
	include_once( WOLF_THEME_DIR . '/includes/admin/options/discography.php' );

if ( class_exists( 'Woocommerce' ) )
	include_once( WOLF_THEME_DIR . '/includes/admin/options/woocommerce.php' );

include_once( WOLF_THEME_DIR . '/includes/admin/options/javascript-code.php' );
include_once( WOLF_THEME_DIR . '/includes/admin/options/misc.php' );