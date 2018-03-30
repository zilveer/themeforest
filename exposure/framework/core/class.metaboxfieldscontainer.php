<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Metabox Fields Container class.
 * 
 * This class is entitled to manage a metabox container for input fields. 
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_MetaboxFieldsContainer') ) {
	class THB_MetaboxFieldsContainer {

		/**
		 * The fields.
		 * 
		 * @var array
		 */
		protected $_fields = array();

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
		 * The fields container template.
		 * 
		 * @var string
		 */
		protected $_template = 'admin/metabox_fields_container';

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
		}

		/**
		 * Add a field to the fields container.
		 *
		 * @param THB_Field $field The field object.
		 * @return void
		 */
		public function addField( THB_Field $field )
		{
			$this->_fields[] = $field;
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
		 * Return false when asked if duplicable.
		 * 
		 * @return boolean
		 */
		public function isDuplicable()
		{
			return false;
		}

		/**
		 * Render the fields container.
		 * 
		 * @return void
		 */
		public function render()
		{
			if( count($this->getFields()) == 0 ) {
				return;
			}

			$intro_text = new THB_TemplateLoader('admin/introtext', array(
				'intro_text' => $this->getIntroText()
			));

			$fields_container_template = new THB_TemplateLoader($this->_template, array(
				'fields_container' => $this,
				'container_intro_text' => $intro_text->render(true)
			));

			$fields_container_template->render();
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
		 * Save the fields container.
		 * 
		 * @return void
		 */
		public function save()
		{
			global $post_id;

			$meta = array();
			$metaName = THB_META_KEY;

			foreach( $this->getFields() as $field ) {
				if( $field->isComplex() ) {
					foreach( $field->getSubkeys() as $subKey ) {
						if( isset($_POST[$field->getName()][$subKey]) ) {
							$meta[$metaName . $field->getName() . '_' . $subKey] = $_POST[$field->getName()][$subKey];
						}
					} 
				}
				else {
					if( isset($_POST[$field->getName()]) ) {
						$meta[$metaName . $field->getName()] = $_POST[$field->getName()];
					}

				}
			}

			foreach( $meta as $key => $value ) {
				update_post_meta($post_id, $key, $value);
			}
		}

	}
}