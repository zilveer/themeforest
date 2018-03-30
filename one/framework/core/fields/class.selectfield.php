<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Select field class.
 *
 * This class is entitled to manage the option/meta select field types.
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
		 * Deferred options callback.
		 *
		 * @var callable
		 */
		private $deferredOptions = null;

		/**
		 * True if the field accepts options groups.
		 *
		 * @var boolean
		 */
		private $_structured = false;

		/**
		 * True if the field accepts more than one comma separated value.
		 *
		 * @var boolean
		 */
		private $_multiple = false;

		/**
		 * On change custom callback.
		 *
		 * @var string
		 */
		private $_callback = false;

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'select', $context );

			$this->_data['field_options'] = array();
			$this->_data['select_class'] = 'thb-select';
			$this->_data['select_attrs'] = array();
		}

		/**
		 * Add an option to the field.
		 *
		 * @param string $value The option value.
		 * @param string $label The option label.
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
		 * Check if the select field allows for more than one value.
		 *
		 * @return boolean
		 */
		public function isMultiple()
		{
			return $this->_multiple == true;
		}

		/**
		 * Pre-render the field.
		 *
		 * @return void
		 */
		protected function preRender()
		{
			if( $this->invisibleIfEmpty && count($this->_data['field_options']) <= 1 ) {
				$this->addClass('thb-invisible');
			}

			parent::preRender();
		}

		/**
		 * Deferred options management.
		 */
		public function handleDeferredOptions()
		{
			$options = array();

			if( $this->deferredOptions ) {
				if( is_array($this->deferredOptions) ) {
					foreach( array_keys($this->deferredOptions) as $key ) {
						if( is_callable($this->deferredOptions[$key]) ) {
							$options[$key] = call_user_func($this->deferredOptions[$key]);
						}
					}
				}
				else {
					if( is_callable($this->deferredOptions) ) {
						$options = call_user_func($this->deferredOptions);
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
		 * Set the field options.
		 *
		 * @param array|string $options The select options.
		 */
		public function setOptions( $options = array() )
		{
			$this->_data['field_options'] = array();

			if ( is_array( $options ) ) {
				foreach( $options as $k => $v ) {
					$this->addOption( $k, $v );
				}
			}
			elseif( is_string( $options ) ) {
				$this->deferredOptions = $options;
				add_action( 'wp_loaded', array( $this, 'handleDeferredOptions' ) );
			}
		}

		/**
		 * Set the select element to accept optgroups.
		 */
		public function setStructured()
		{
			$this->_structured = true;
		}

		/**
		 * Set the select element to accept more than one value.
		 */
		protected function setMultiple()
		{
			$this->_multiple = true;
		}

		/**
		 * Get the select element callback on change.
		 *
		 * @return string
		 */
		public function getCallback()
		{
			return $this->_callback;
		}

		/**
		 * Set the select element callback on change.
		 *
		 * @param string $callback The callback name;
		 */
		public function setCallback( $callback )
		{
			$this->_callback = $callback;
		}
	}
}