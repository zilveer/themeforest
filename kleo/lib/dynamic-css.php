<?php
/* Dynamic CSS Logic
 * @author SeventhQueen
 *
 */


/***************************************************
:: Render custom css resulted from theme options
 ***************************************************/

global $kleo_config, $kleo_theme;
$kleo_dynamic_version = get_option( 'sq_dynamic_' . KLEO_DOMAIN );

if( $kleo_dynamic_version == false ) {
	$needs_update = true;
} else {
	$needs_update = version_compare( $kleo_dynamic_version, KLEO_THEME_VERSION, '<' );
}

//write the file if isn't there
if ( $needs_update || ! file_exists ( trailingslashit( $kleo_config['custom_style_path'] ) . 'dynamic.css' ) ) {
	add_filter( 'kleo_add_dynamic_style', array( $kleo_theme, 'add_font_css' ) );
	add_action( 'after_setup_theme', 'kleo_generate_dynamic_css', 999 );
	update_option( 'sq_dynamic_' . KLEO_DOMAIN,  KLEO_THEME_VERSION );
}

if ( ! is_admin() ) {
	if ( is_writable( trailingslashit( $kleo_config['upload_basedir'] ) ) ) {
		add_action( 'wp_enqueue_scripts', 'kleo_load_dynamic_css', 22 );
	} else {
		add_action( 'wp_head', 'kleo_custom_head_css' );
	}
}



/**
 * Load generated CSS file containing theme customizations
 * @global array $kleo_config
 */
function kleo_load_dynamic_css()
{
	/* If remove query option is ON */
	if ( sq_option('perf_remove_query', 0 ) == 1 ) {
		$version = NULL;
	} else {
		$version = KLEO_THEME_VERSION;
	}

	global $kleo_config;
	wp_register_style( 'kleo-colors', trailingslashit($kleo_config['custom_style_url']) . 'dynamic.css', array(), $version, 'all' );
	wp_enqueue_style( 'kleo-colors' );
}



/**
 * Generate CSS styles in head section
 * @global Kleo $kleo_theme
 */
function kleo_custom_head_css()
{
	global $kleo_theme;
	$dynamic_css = get_template_directory() . '/assets/css/dynamic.php';

	echo "\n<style>";
	ob_start(); // Capture all output (output buffering)
	//add fonts styles
	add_filter('kleo_add_dynamic_style', array($kleo_theme,'add_font_css'));

	require($dynamic_css); // Generate CSS
	$css = ob_get_clean(); // Get generated CSS
	echo kleo_compress($css);
	echo '</style>';
}
