<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Upload field class.
 *
 * This class is entitled to manage the option/meta upload field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Fields
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_UploadField') ) {
	class THB_UploadField extends THB_Field {

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array('url', 'id');

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name, 'upload');
		}

	}
}

/**
 * Render the partial for a media library upload control.
 *
 * @param array $data The template parameters.
 * @return void
 */
if( !function_exists('thb_partial_upload') ) {
	function thb_partial_upload( $data ) {
		$partial = new THB_TemplateLoader('admin/fields/partials/upload', $data);
		$partial->render();
	}
}