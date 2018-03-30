<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Text field class.
 *
 * This class is entitled to manage the option/meta text field types.
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
if( !class_exists('THB_TextField') ) {
	class THB_TextField extends THB_Field {

		/**
		 * The text field placeholder.
		 *
		 * @var string
		 */
		private $_placeholder = '';

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'text', $context );

			$this->_data['placeholder'] = $this->_placeholder;
		}

		/**
		 * Set the text field placeholder.
		 *
		 * @param string $step The text placeholder.
		 * @return void
		 */
		public function setPlaceholder( $placeholder )
		{
			$this->_placeholder = $placeholder;
			$this->_data['placeholder'] = $this->_placeholder;
		}
	}
}