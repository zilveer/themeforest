<?php

define( 'BARCELONA_THEME_VERSION', '1.4.3' );
define( 'BARCELONA_THEME_NAME', esc_html_x( 'Barcelona.', 'Theme Name', 'barcelona' ) );
define( 'BARCELONA_THEME_PATH', trailingslashit( get_template_directory_uri() ) );
define( 'BARCELONA_SERVER_PATH', trailingslashit( get_template_directory() ) );
define( 'BARCELONA_DATE_FORMAT', get_option( 'date_format' ) );

/*
 * Require core functionality
 */
$barcelona_core = array( 'helpers', 'snippets', 'theme-support', 'ajax', 'template-tags', 'nav-menu', 'scripts', 'widgets', 'filters' );
foreach ( $barcelona_core as $k ) {
	locate_template( 'includes/core/'. sanitize_key( $k ) .'.php', true );
}

/*
 * Require option-tree functions
 */
locate_template( 'option-tree/ot-loader.php', true );
locate_template( 'includes/admin/theme-options.php', true );
locate_template( 'includes/admin/meta-boxes.php', true );

/*
 * Require TGM plugin activation
 */
locate_template( 'includes/admin/tgm.php', true );

/*
 * Set content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

/*
 * BuddyPress definitions
 */
if ( function_exists('buddypress') ) {

	if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
		define ( 'BP_AVATAR_FULL_WIDTH', 160 );
	}

	if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
		define ( 'BP_AVATAR_FULL_HEIGHT', 160 );
	}

	if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
		define ( 'BP_AVATAR_THUMB_HEIGHT', 80 );
	}

	if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
		define ( 'BP_AVATAR_THUMB_WIDTH', 80 );
	}

}