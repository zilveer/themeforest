<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Number field class.
 *
 * This class is entitled to manage the option/meta number field types.
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
if( !class_exists('THB_NumberField') ) {
	class THB_NumberField extends THB_Field {

		/**
		 * The number min value.
		 *
		 * @var string
		 */
		private $_min = '';

		/**
		 * The number max value.
		 *
		 * @var string
		 */
		private $_max = '';

		/**
		 * The number field placeholder.
		 *
		 * @var string
		 */
		private $_placeholder = '';

		/**
		 * The number step.
		 *
		 * @var string
		 */
		private $_step = '1';

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'number', $context );

			$this->_data['max'] = $this->_max;
			$this->_data['min'] = $this->_min;
			$this->_data['step'] = $this->_step;
			$this->_data['placeholder'] = $this->_placeholder;
		}

		/**
		 * Set the number field max value.
		 *
		 * @param string $step The number max value.
		 * @return void
		 */
		public function setMax( $max )
		{
			$this->_max = $max;
			$this->_data['max'] = $this->_max;
		}

		/**
		 * Set the number field min value.
		 *
		 * @param string $step The number min value.
		 * @return void
		 */
		public function setMin( $min )
		{
			$this->_min = $min;
			$this->_data['min'] = $this->_min;
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

		/**
		 * Set the number field step.
		 *
		 * @param string $step The number step.
		 * @return void
		 */
		public function setStep( $step )
		{
			$this->_step = $step;
			$this->_data['step'] = $this->_step;
		}
	}
}