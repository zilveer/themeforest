<?php
/**
 * Steps for the setup guide.
 * @since 1.5.0
 */

global $tgmpa;

/** Create the steps */
$steps = array();

if ( ! wp_get_theme()->parent() ) {
	$steps[ 'child-theme' ] = array(
		'title' => __( 'Install a Child Theme', 'listify' ),
		'completed' => wp_get_theme()->parent()
	);
}

$api = Astoundify_Envato_Market_API::instance();

$steps[ 'theme-updater' ] = array(
	'title' => __( 'Enable Automatic Updates', 'listify' ),
	'completed' => $api->can_make_request_with_token()
);

$steps[ 'install-plugins' ] = array(
	'title' => __( 'Install Required Plugins', 'listify' ),
	'completed' => class_exists( 'WP_Job_Manager' ) && class_exists( 'WooCommerce' )
);

if ( current_user_can( 'import' ) ) {
	$steps[ 'import-content' ] = array(
		'title' => __( 'Import Demo Content', 'listify' ),
		'completed' => get_option( 'page_for_posts' )
	);
}

$steps[ 'google-maps' ] = array(
	'title' => __( 'Setup Google Maps', 'listify' ),
	'completed' => get_theme_mod( 'map-behavior-api-key', false )
);

$steps[ 'customize-theme' ] = array(
	'title' => __( 'Customize Your Site', 'listify' ),
	'completed' => 'n/a'
);

$steps[ 'support-us' ] = array(
	'title' => __( 'Get Involved', 'listify' ),
	'completed' => 'n/a'
);

return $steps;
