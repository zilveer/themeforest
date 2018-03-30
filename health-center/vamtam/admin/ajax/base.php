<?php

// saves the theme/framework options
function wpv_save_options_callback() {
	$page_str = str_replace( 'wpv_', '', $_POST['page'] );

	$options = array();

	$tabs = include WPV_THEME_OPTIONS . $page_str . '/list.php';

	foreach ( $tabs as $tab ) {
		$tab_contents = include WPV_THEME_OPTIONS.$page_str."/$tab.php";

		$options = array_merge( $options, $tab_contents );
	}

	$status = '';
	if ( ! isset( $_POST['cacheonly'] ) ) {
		$status = wpv_save_config( $options );
	} else {
		$status = wpv_finalize_custom_css();
	}

	wpv_update_option( 'css-cache-timestamp', time() );

	do_action( 'wpv_after_save_theme_options' );

	echo $status;

	exit;
}
add_action( 'wp_ajax_wpv-save-options', 'wpv_save_options_callback' );

function wpv_shortcode_generator() {
	$config = array(
		'title' => __( 'Shortcodes', 'health-center' ),
		'id' => 'shortcode',
	);

	$shortcodes = apply_filters( 'wpv_shortcode_'.$_GET['slug'], include( WPV_SHORTCODES_GENERATOR . $_GET['slug'] .'.php' ) );
	$generator  = new WpvShortcodesGenerator( $config, $shortcodes );

	$generator->render();
}
add_action( 'wp_ajax_wpv-shortcode-generator', 'wpv_shortcode_generator' );