<?php
/**
 * Created by PhpStorm.
 * User: hoantv
 * Date: 2015-03-25
 * Time: 5:37 AM
 */

add_action( 'wp_enqueue_scripts' , 'xmenu_menu_load_assets' );
function xmenu_menu_load_assets() {
	wp_enqueue_style( 'xmenu-menu-amination', XMENU_URL. 'assets/css/amination.css' );
	wp_enqueue_style( 'xmenu-menu-style', XMENU_URL. 'assets/css/style.css' );
}

add_action('wp_footer', 'xmenu_footer_css');
function xmenu_footer_css() {
	global $xmenu_queue_css;
	$settings = $settings = get_option(XMENU_SETTING_OPTIONS);

	if (isset($xmenu_queue_css) && is_array($xmenu_queue_css)) {
		foreach ($xmenu_queue_css as $key => $value) {
			if ($key == 'xmenu-default') {
				continue;
			}
			wp_enqueue_style( 'xmenu-menu-style-' . $key, XMENU_URL. 'assets/css/' . $value );
		}
	}

	global $g5plus_options;
	$min_suffix = (isset($g5plus_options['enable_minifile_js']) && $g5plus_options['enable_minifile_js'] == 1) ? '.min' :  '';

	wp_enqueue_script( 'xmenu-menu-js', XMENU_URL. 'assets/js/app' . $min_suffix . '.js' , array( 'jquery' ) , XMENU_VERSION , true );
	global $xmenu_queue_script_data;
	if (isset($xmenu_queue_script_data) && is_array($xmenu_queue_script_data)) {
		foreach ($xmenu_queue_script_data as $key => $value) {
			if ($key == 'xmenu-default') {
				wp_localize_script( 'xmenu-menu-js' , 'xmenu_meta' , $xmenu_queue_script_data[$key] );
				unset($xmenu_queue_script_data[$key]);
				break;
			}
		}
		wp_localize_script( 'xmenu-menu-js' , 'xmenu_meta_custom' , $xmenu_queue_script_data);
	}


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
