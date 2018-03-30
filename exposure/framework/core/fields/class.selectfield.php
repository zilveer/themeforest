<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Select field class.
 *
 * This class is entitled to manage the option/meta select field types.
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
if( !class_exists('THB_SelectField') ) {
	class THB_SelectField extends THB_Field {

		/**
		 * True if the select should be invisible if empty or with just one
		 * element.
		 *
		 * @var boolean
		 */
		private $invisibleIfEmpty = true;

		/**
		 * Dynamic options callback.
		 *
		 * @var callable
		 */
		private $dynamicOptions = null;

		/**
		 * True if the field accepts options groups.
		 *
		 * @var boolean
		 */
		private $_structured = false;

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name, 'select');
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
		 * Add an options group to the field.
		 *
		 * @param string $group The options group label.
		 * @param array $options The options group options.
		 * @return void
		 */
		public function addOptionsGroup( $group, $options=array() )
		{
			$this->setStructured();

			foreach( $options as $value => $label ) {
				$this->_data['field_options'][$group][(string) $value] = $label;
			}
		}

		/**
		 * Check if the select field allows for optgroups.
		 *
		 * @return boolean
		 */
		public function isStructured()
		{
			return $this->_structured == true;
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

			$depth = thb_array_depth($options);

			if( $depth == 2 ) {
				foreach( (array) $options as $optgroup => $values ) {
					$this->addOptionsGroup( $optgroup, $values );
				}
			}
			else {
				foreach( (array) $options as $value => $label ) {
					$this->addOption( $value, $label );
				}
			}

			if( $this->invisibleIfEmpty && count($this->_data['field_options']) <= 1 ) {
				$this->addClass('invisible');
			}

			parent::preRender();
		}

		/**
		 * Set the field dynamic options.
		 *
		 * @param array $callback The select callback.
		 * @return void
		 */
		public function setDynamicOptions( $callback )
		{
			$this->dynamicOptions = $callback;
		}

		/**
		 * Set the field dynamic options groups.
		 *
		 * @param string $optgroup The option group label.
		 * @param array $callback The select callback.
		 * @return void
		 */
		public function setDynamicOptionsGroup( $optgroup, $callback )
		{
			$this->setStructured();

			$this->dynamicOptions[$optgroup] = $callback;
		}

		/**
		 * Set the select to be invisible if empty or with just one element.
		 *
		 * @param boolean $siie
		 */
		public function setInvisibleIfEmpty( $siie=true )
		{
			$this->invisibleIfEmpty = $siie;
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

		/**
		 * Set the select element to accept optgroups.
		 *
		 * @return void
		 */
		public function setStructured()
		{
			$this->_structured = true;
		}

	}
}

/**
 * Boolean yes/no select.
 *
 */
if( !class_exists('THB_YesNoField') ) {
	class THB_YesNoField extends THB_SelectField {

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 **/
		public function __construct( $name )
		{
			parent::__construct($name);
			$this->_data['field_options'] = array(
				'0' => __('No', 'thb_text_domain'),
				'1' => __('Yes', 'thb_text_domain')
			);
		}

	}
}