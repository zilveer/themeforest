<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Graphic radio field class.
 *
 * This class is entitled to manage the option/meta graphic radio field types.
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
if( !class_exists('THB_GraphicRadioField') ) {
	class THB_GraphicRadioField extends THB_Field {

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'graphicradio', $context );
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
		 * Set the field options
		 *
		 * @param array $options The select options.
		 */
		public function setOptions( $options = array() )
		{
			$this->_data['field_options'] = array();

			foreach( $options as $k => $v ) {
				$this->addOption($k, $v);
			}
		}

	}
}

if( ! function_exists( 'thb_graphicradio' ) ) {
	/**
	 * Render the partial for the graphic radio control.
	 */
	function thb_graphicradio( $field_name, $field_value, $field_options ) {
		$partial = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/partials/graphicradio', array( 'field_name' => $field_name, 'field_value' => $field_value, 'field_options' => $field_options ) );
		$partial->render();
	}
}