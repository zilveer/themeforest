<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Data helpers.
 *
 * This file contains utility functions concerning data manipulation.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Check if the $arr array contains the $needle element.
 *
 * @return array
 **/
if( !function_exists('thb_data_get') ) {
	function thb_data_get() {
		$data = array();

		if( !empty($_POST) && isset($_POST[THB_DATA_NAMESPACE]) ) {
			$data = $_POST[THB_DATA_NAMESPACE];
		}

		return $data;
	}
}