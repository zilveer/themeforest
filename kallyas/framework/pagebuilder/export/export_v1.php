<?php

/**
 * In this export type we will only export a configuration file containing the json data
 * @param  boolean $name          [description]
 * @param  array   $export_config [description]
 * @return [type]                 [description]
 */
function znpb_prepare_export_template( $export_config = array() ){

	// Set the location where we'll save the export file
	$wp_upload_dir = wp_upload_dir();
	$wp_upload_dir = trailingslashit( $wp_upload_dir['basedir'] );
	$export_path = $wp_upload_dir.'template_export.txt';

	if( file_put_contents( $export_path, json_encode( $export_config ) ) ){
		$return['url'] = $export_path;
	}
	else{
		return new WP_Error( 'ZNPB export failed', 'Could not creaate the export file in '. $export_path );
	}

	return $return;
}

/**
 * This function will start the download for the exported template
 * @return [type] [description]
 */
function znpb_download_export(){

	check_ajax_referer( 'zn_framework', 'nonce' );

	$wp_upload_dir = wp_upload_dir();
	$wp_upload_dir = trailingslashit( $wp_upload_dir['basedir'] );
	$exportname = 'template_export.txt';
	$export_file = $wp_upload_dir.$exportname;

	header("Content-type: application/zip");
	header("Content-Disposition: attachment; filename=".$exportname);
	header("Pragma: no-cache");
	header("Expires: 0");
	readfile($export_file);

	@unlink($export_file); //delete file after sending it to user

	exit();
}