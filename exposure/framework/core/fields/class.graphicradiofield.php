<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Graphic radio field class.
 *
 * This class is entitled to manage the option/meta graphic radio field types.
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
if( !class_exists('THB_GraphicRadioField') ) {
	class THB_GraphicRadioField extends THB_Field {

		/**
		 * Dynamic options callback.
		 * 
		 * @var callable
		 */
		private $dynamicOptions = null;

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name, 'graphicradio');
			$this->_data['field_options'] = array();
		}

		/**
		 * Add an option to the field.
		 *
		 * @param string $value The option value.
		 * @param string $label The option label.
		 * @return void
		 */
		public function addOption( $value, $label )
		{
			$this->_data['field_options'][(string) $value] = $label;
		}

		/**
		 * Pre-render the field.
		 *
		 * @return void
		 */
		protected function preRender()
		{
			$options = array();

			if( $this->dynamicOptions ) {
				if( is_array($this->dynamicOptions) ) {
					foreach( array_keys($this->dynamicOptions) as $key ) {
						if( is_callable($this->dynamicOptions[$key]) ) {
							$options[$key] = call_user_func($this->dynamicOptions[$key]);
						}
					}
				}
				else {
					if( is_callable($this->dynamicOptions) ) {
						$options = call_user_func($this->dynamicOptions);
					}
				}
			}

			foreach( (array) $options as $value => $label ) {
				$this->addOption( $value, $label );
			}

			parent::preRender();
		}

		/**
		 * Set the field dynamic options.
		 *
		 * @param array $callback The graphic radio callback.
		 * @return void
		 */
		public function setDynamicOptions( $callback )
		{
			$this->dynamicOptions = $callback;
		}

		/**
		 * Set the field options
		 *
		 * @param array $options The select options.
		 * @return void
		 */
		public function setOptions( $options=array() )
		{
			$this->_data['field_options'] = array();

			foreach( $options as $k => $v ) {
				$this->addOption($k, $v);
			}
		}

	}
}