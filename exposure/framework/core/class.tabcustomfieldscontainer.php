<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Custom Fields Container class.
 * 
 * This class is entitled to manage a custom fields container for input fields.
 * Custom fields containers do NOT save via AJAX.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_TabCustomFieldsContainer') ) {
	class THB_TabCustomFieldsContainer extends THB_TabFieldsContainer {

		/**
		 * The custom fields container template.
		 * 
		 * @var string
		 */
		protected $_template = 'admin/tab_custom_fields_container';

	}
}