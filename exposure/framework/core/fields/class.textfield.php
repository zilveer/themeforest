<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Text field class.
 *
 * This class is entitled to manage the option/meta text field types.
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
if( !class_exists('THB_TextField') ) {
	class THB_TextField extends THB_Field {

		/**
		 * The number field placeholder.
		 * 
		 * @var string
		 */
		private $_placeholder = '';

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name, 'text');

			$this->_data['placeholder'] = $this->_placeholder;
		}

		/**
		 * Set the number field placeholder.
		 * 
		 * @param string $step The number placeholder.
		 * @return void
		 */
		public function setPlaceholder( $placeholder )
		{
			$this->_placeholder = $placeholder;
			$this->_data['placeholder'] = $this->_placeholder;
		}
	}
}