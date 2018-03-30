<?php

/**
 * @package SLT File Select
 */

/*
Plugin Name: SLT File Select
Plugin URI: http://sltaylor.co.uk/wordpress/plugins/file-select/
Description: Provides themes and plugins with a form interface to select a file from the Media Library.
Author: Steve Taylor
Version: 0.2.1
Author URI: http://sltaylor.co.uk
License: GPLv2
*/

/* Inspired by code in Professional WordPress Development by Brad Williams, Ozh Richard and Justin Tadlock */

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
	_e( "Hi there! I'm just a plugin, not much I can do when called directly." );
	exit;
}

// JavaScript
add_action( 'admin_print_scripts', 'slt_fs_scripts' );
function slt_fs_scripts() {
	wp_register_script('master', get_template_directory_uri() . '/functions/admin/js/master.js', array('jquery', 'media-upload', 'thickbox'));
	wp_enqueue_script('master');
	$protocol = isset( $_SERVER[ 'HTTPS' ] ) ? 'https://' : 'http://';
	wp_localize_script( 'master', 'slt_file_select', array(
		'ajaxurl'			=> admin_url( 'admin-ajax.php', $protocol ),
		'text_select_file'	=> esc_html__( 'Select', 'master' )
	));
}

// Styles
add_action( 'admin_print_styles', 'slt_fs_styles' );
function slt_fs_styles() {
	wp_enqueue_style('thickbox');
}

// Disable Flash uploader when this plugin invokes Media Library overlay
add_action( 'admin_init', 'slt_fs_disable_flash_uploader' );
function slt_fs_disable_flash_uploader() {
	if ( basename( $_SERVER['SCRIPT_FILENAME'] ) == 'media-upload.php' && array_key_exists( 'slt_fs_field', $_GET ) )
		add_filter( 'flash_uploader', create_function( '$a','return false;' ), 5 );
}

// Output form button
function slt_fs_button($name, $value, $label = 'Select file', $preview_size = 'thumbnail', $removable = true, $image = '') {

	// If we have already image then show it
	if (!empty($image)) {

	}

	if (is_array($preview_size)) {
		$preview_size = json_encode($preview_size);
	}
	?>
	<div>
		<input type="button" class="button-secondary slt-fs-button" value="<?php echo esc_attr( $label ); ?>" />
		<?php if ( $value && $removable ) { ?>
			&nbsp;&nbsp;<input type="checkbox" name="<?php echo esc_attr( $name ); ?>_remove" id="<?php echo esc_attr( $name ); ?>_remove" value="1" class="slt-fs-remove" /> <label for="<?php echo esc_attr( $name ); ?>_remove"><?php _e( 'Remove', 'ch' ); ?></label>
		<?php } ?>
		<input type="hidden" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="slt-fs-value" />
		<input type="hidden" value="<?php echo esc_attr( $preview_size ); ?>" name="<?php echo esc_attr( $name ); ?>_preview-size" id="<?php echo esc_attr( $name ); ?>_preview-size" class="slt-fs-preview-size" />
	</div>
	<div class="slt-fs-preview" id="<?php echo esc_attr( $name ); ?>_preview" style="margin-top:7px"><?php
		if ( $value ) {

			// Show image preview
			echo '<img src="' . $value . '" alt="" />';
		}
	?></div>
<?php }

// AJAX wrapper to get image HTML
add_action( 'wp_ajax_slt_fs_get_file', 'slt_fs_get_file_ajax' );
function slt_fs_get_file_ajax() {
	$json_request = (json_decode($_REQUEST['size']) != NULL) ? true : false;

	// If JSON then decode
	if ($json_request) {
		$size = json_decode($_REQUEST['size']);
	} else {
		$size = $_REQUEST['size'];
	}

	if ( wp_attachment_is_image( $_REQUEST['id'] ) ) {
		echo wp_get_attachment_image( $_REQUEST['id'], $size );
	} else {
		echo slt_fs_file_link( $_REQUEST['id'] );
	}
	die();
}

// AJAX wrapper to get image URL
add_action( 'wp_ajax_slt_fs_get_file_url', 'slt_fs_get_file_url_ajax' );
function slt_fs_get_file_url_ajax() {
	$json_request = (json_decode($_REQUEST['size']) != NULL) ? true : false;

	// If JSON then decode
	if ($json_request) {
		$size = json_decode($_REQUEST['size']);
	} else {
		$size = $_REQUEST['size'];
	}

	if ( wp_attachment_is_image( $_REQUEST['id'] ) ) {
		$image_attributes = wp_get_attachment_image_src( $_REQUEST['id'], $size );
		echo $image_attributes[0];
	} else {
		echo wp_get_attachment_url( $_REQUEST['id'] );
	}
	die();
}

// Generate markup for file link
function slt_fs_file_link( $id ) {
	$attachment_url = wp_get_attachment_url( $id );
	$filetype_check = wp_check_filetype( $attachment_url );
	$filetype_parts = explode( '/', $filetype_check['type'] );
	return '<a href="' . wp_get_attachment_url( $id ) . '" style="display: block; min-height:32px; padding: 10px 0 0 38px; background: url(' . plugins_url( "img/icon-" . $filetype_parts[1] . ".png", __FILE__ ) . ') no-repeat; font-size: 13px; font-weight: bold;">' . basename( $attachment_url ) . '</a>';
}