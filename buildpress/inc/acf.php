<?php
/**
 * Filters and include calls for the ACF plugin, so it is available within the theme
 *
 * @see http://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/
 */

/**
 * Customize ACF path
 * @param  string $path
 * @return string new path
 */
function buildpress_acf_settings_path( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/bower_components/acf/';

	return $path;
}
add_filter( 'acf/settings/path', 'buildpress_acf_settings_path' );

/**
 * Customize ACF dir
 * @param  string $dir
 * @return string
 */
function buildpress_acf_settings_dir( $dir ) {
	// update path
	$dir = get_template_directory_uri() . '/bower_components/acf/';

	return $dir;
}
add_filter( 'acf/settings/dir', 'buildpress_acf_settings_dir' );

if ( 'yes' !== get_theme_mod( 'show_acf', 'no' ) ) {
	// hide ACF field group menu item depending on how it's set in the customizer
	define( 'ACF_LITE' , true );
}

// include ACF, magic! :)
locate_template( 'bower_components/acf/acf.php', true, true );

// load acf field groups from PHP file
if ( ! BUILDPRESS_DEVELOPMENT ) {
	locate_template( 'inc/acf-field-groups.php', true, true );
}