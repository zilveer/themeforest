<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Translation helpers.
 *
 * Utility functions to translate text.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( !function_exists('thb_upload') ) {
	/**
	 * Upload a file to a specified upload folder.
	 *
	 * @param File $upload The file to be uploaded.
	 * @param array $mimes The MIME type(s) the uploaded file should be checked against.
	 * @return mixed
	 **/
	function thb_upload( $upload, $mimes=array() ) {
		// Getting the upload directory
		$upload_dir = wp_upload_dir();

		// The file
		$return_file = false;

		// Check if upload dir is writable
		if( is_writable($upload_dir['path']) ) {
			// Check if uploaded file is not empty
			if( !empty($upload['tmp_name']) && $upload['tmp_name'] ) {
				// Let's upload the file
				$file = thb_handle_upload($upload, $mimes);

				$return_file = array(
					"file" => $file,
					"upload_dir" => $upload_dir
				);
			}
		}

		return $return_file;
	}
}

if( !function_exists('thb_handle_upload') ) {
	/**
	 * Handle the file upload.
	 *
	 * @param File $upload The file being uploaded.
	 * @param array $mimes The MIME type(s) the uploaded file should be checked against.
	 * @return mixed
	 **/
	function thb_handle_upload( $upload, $mimes=array() ) {
		if( !empty($mimes) ) {
			$info = @getimagesize($upload['tmp_name']);
			if( !in_array($info['mime'], $mimes) ) {
				return false;
			}
		}

		$overrides = array('test_form' => false);
		$file = wp_handle_upload($upload, $overrides);

		return $file;
	}
}