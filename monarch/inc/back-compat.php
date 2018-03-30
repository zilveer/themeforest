<?php
/**
 * Monarch back compat functionality
 *
 * Prevents Monarch from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Monarch_Theme
 * @since Monarch 1.0
 */

/**
 * Prevent switching to Monarch on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Monarch 1.0
 */
function monarch_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'monarch_upgrade_notice' );
}
add_action( 'after_switch_theme', 'monarch_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Monarch on WordPress versions prior to 4.4.
 *
 * @since Monarch 1.0
 */
function monarch_upgrade_notice() {
	$message = sprintf( esc_html__( 'Monarch requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'monarch' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Monarch 1.0
 */
function monarch_customize() {
	wp_die( sprintf( esc_html__( 'Monarch requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'monarch' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'monarch_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Monarch 1.0
 */
function monarch_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'Monarch requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'monarch' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'monarch_preview' );
