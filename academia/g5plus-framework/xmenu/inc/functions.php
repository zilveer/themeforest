<?php
/**
 * Created by PhpStorm.
 * User: hoantv
 * Date: 2015-03-25
 * Time: 5:37 AM
 */

add_action( 'wp_enqueue_scripts' , 'xmenu_menu_load_assets' );
function xmenu_menu_load_assets() {
	wp_enqueue_style( 'xmenu-menu-amination', G5PLUS_XMENU_URL. 'assets/css/amination.css' );
}

add_action('wp_footer', 'xmenu_footer_css');
function xmenu_footer_css() {
	$enable_minifile_js = G5Plus_Global::get_option('enable_minifile_js');
	$min_suffix = ($enable_minifile_js == 1) ? '.min' :  '';

	wp_enqueue_script( 'xmenu-menu-js', G5PLUS_XMENU_URL. 'assets/js/app' . $min_suffix . '.js' , array( 'jquery' ) , G5PLUS_XMENU_VERSION , true );

}

function xmenu_get_attachment_id_from_url( $attachment_url = '' ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}
