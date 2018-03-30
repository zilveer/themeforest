<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Contact.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Portfolio
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_ContactInfoField') ) {
	class THB_ContactInfoField extends THB_Field {

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array('key', 'value', 'type');

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name, thb_get_module_path('core/contact') . '/templates/contact-info-field');
		}

	}
}