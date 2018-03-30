<?php

/**
 * Helper functions for dealing with the icon fonts used by the theme
 *
 * @package wpv
 */

function wpv_icon_type( $icon ) {
	echo wpv_get_icon_type( $icon ); // xss ok
}

function wpv_get_icon_type( $icon ) {
	if ( strpos( $icon, 'theme-' ) === 0 )
		return 'theme';

	if ( strpos( $icon, 'custom-' ) === 0 )
		return 'custom';

	return '';
}

function wpv_icon( $key ) {
	echo wpv_get_icon( $key ); // xss ok
}

function wpv_get_icon( $key ) {
	if ( ( $num = wpv_get_icon_num( $key ) ) !== false ) {
		return "&#$num;";
	}

	return $key;
}

function wpv_get_icon_num( $key ) {
	$icons        = wpv_get_icon_list();
	$theme_icons  = wpv_get_theme_icon_list();
	$custom_icons = wpv_get_custom_icon_list();

	if ( isset( $icons[$key] ) )
		return $icons[$key];

	$theme_key = preg_replace( '/^theme-/', '', $key, 1 );
	if ( isset( $theme_icons[$theme_key] ) ) {
		return $theme_icons[$theme_key];
	}

	$custom_key = preg_replace( '/^custom-/', '', $key, 1 );
	if ( isset( $custom_icons[$custom_key] ) ) {
		return $custom_icons[$custom_key];
	}

	return false;
}

/**
 * Returns the list of Icomoon icons
 * @return array list of icons
 */
function wpv_get_icon_list() {
	if ( !isset( $GLOBALS['WPV_ICONS_CACHE'] ) ) {
		$GLOBALS['WPV_ICONS_CACHE'] = include( WPV_ASSETS_DIR . 'fonts/icons/list.php' );
	}

	return $GLOBALS['WPV_ICONS_CACHE'];
}

/**
 * Returns the list of theme icons
 * @return array list of icons
 */
function wpv_get_theme_icon_list() {
	if ( !isset( $GLOBALS['WPV_THEME_ICONS_CACHE'] ) ) {
		$GLOBALS['WPV_THEME_ICONS_CACHE'] = include( WPV_THEME_ASSETS_DIR . 'fonts/icons/list.php' );
	}

	return $GLOBALS['WPV_THEME_ICONS_CACHE'];
}

/**
 * Returns the list of custom icons
 * @return array list of icons
 */
function wpv_get_custom_icon_list() {
	if ( ! isset( $GLOBALS['WPV_CUSTOM_ICONS_CACHE'] ) ) {
		$GLOBALS['WPV_CUSTOM_ICONS_CACHE'] = get_option( 'vamtam-custom-icons-map' );

		if ( ! is_array( $GLOBALS['WPV_CUSTOM_ICONS_CACHE'] ) ) {
			$GLOBALS['WPV_CUSTOM_ICONS_CACHE'] = array();
		}
	}

	return $GLOBALS['WPV_CUSTOM_ICONS_CACHE'];
}

function wpv_get_icons_extended() {
	$result = array();

	$icons        = wpv_get_icon_list();
	$theme_icons  = wpv_get_theme_icon_list();
	$custom_icons = wpv_get_custom_icon_list();

	ksort( $icons );
	ksort( $theme_icons );
	ksort( $custom_icons );

	foreach ( $icons as $key => $num ) {
		$result[$key] = $key;
	}

	foreach ( $theme_icons as $key => $num ) {
		$result['theme-' . $key] = 'theme-' . $key;
	}

	foreach ( $custom_icons as $key => $num ) {
		$result['custom-' . $key] = 'custom-' . $key;
	}

	return $result;
}