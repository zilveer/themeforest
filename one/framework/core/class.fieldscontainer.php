<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Fields Container class.
 *
 * This class is entitled to manage a generic container for input fields.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0.2
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( ! class_exists('THB_FieldsContainer') ) {
	abstract class THB_FieldsContainer {

		/**
		 * The fields.
		 *
		 * @var array
		 */
		protected $_fields = null;

		/**
		 * The intro text.
		 *
		 * @var string
		 */
		protected $_introText = '';

		/**
		 * The fields container slug.
		 *
		 * @var string
		 */
		protected $_slug = '';

		/**
		 * The fields container title.
		 *
		 * @var string
		 */
		protected $_title = '';

		/**
		 * Constructor
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 **/
		public function __construct( $title, $slug )
		{
			if( empty($slug) ) {
				wp_die( 'Empty fields container slug.' );
			}

			$this->_title = $title;
			$this->_slug = $slug;
			$this->_fields = new THB_List();
		}

		/**
		 * Add a field to the fields container.
		 *
		 * @param THB_Field $field The field object.
		 * @param integer $index The field index.
		 * @return THB_Field
		 */
		public function addField( THB_Field $field, $index = false, $context = THB_Field::THB_Option )
		{
			$field->setContext( $context );

			if( $index === false ) {
				$this->_fields->insert( $field );
			}
			else {
				$this->_fields->insertAt( $field, $index );
			}

			return $field;
		}

		/**
		 * Get a fields container field by its name.
		 *
		 * @param string $name The field name.
		 * @return THB_Field
		 */
		public function getField( $name )
		{
			foreach( $this->_fields as $field ) {
				if( $field->getName() == $name ) {
					return $field;
				}
			}

			return false;
		}

		/**
		 * Remove a fields container field by its name.
		 *
		 * @param string $name The field name.
		 * @return THB_Field
		 */
		public function removeField( $name )
		{
			$i = 0;

			foreach( $this->_fields as $field ) {
				if ( $field->getName() == $name ) {
					$this->_fields->removeAt( $i );
				}

				$i++;
			}
		}

		/**
		 * Get the fields container fields.
		 *
		 * @return array
		 */
		public function getFields()
		{
			return $this->_fields;
		}

		/**
		 * Get the fields container intro text.
		 *
		 * @return string
		 */
		public function getIntroText()
		{
			return $this->_introText;
		}

		/**
		 * Get the fields container slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get the fields container title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Set the fields container tab intro text.
		 *
		 * @param string $text The tab intro text.
		 * @return void
		 */
		public function setIntroText( $text )
		{
			$this->_introText = $text;
		}

		/**
		 * Set the fields container title.
		 *
		 * @param string $text The title.
		 * @return void
		 */
		public function setTitle( $title )
		{
			$this->_title = $title;
		}

		/**
		 * Serialize the field container keys.
		 *
		 * @return array
		 */
		public function serializeKeys()
		{
			$keys = array();

			foreach ( $this->getFields() as $field ) {
				$keys = array_merge( $keys, $field->serializeKeys() );
			}

			return $keys;
		}

		abstract public function render();

	}
}