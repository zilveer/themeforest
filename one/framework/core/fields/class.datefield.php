<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Date field class.
 *
 * This class is entitled to manage the option/meta date field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Fields
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_DateField') ) {
	class THB_DateField extends THB_Field {

		/**
		 * The field format.
		 *
		 * @var string
		 */
		private $_format = 'yy-mm-dd';

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'date', $context );
			$this->_data['format'] = $this->_format;
		}

		/**
		 * Set the date format.
		 *
		 * @param string $format The date format string.
		 * @return void
		 */
		public function setFormat( $format ) {
			$this->_format = $format;
			$this->_data['format'] = $this->_format;
		}

		/**
		 * Get the date format.
		 *
		 * @return string
		 */
		public function getFormat() {
			return $this->_format;
		}

	}
}