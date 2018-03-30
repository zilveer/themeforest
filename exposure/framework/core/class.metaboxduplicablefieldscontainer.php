<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Duplicable Metabox Fields Container class.
 *
 * This class is entitled to manage a duplicable metabox container for input
 * fields.
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
if( !class_exists('THB_MetaboxDuplicableFieldsContainer') ) {
	class THB_MetaboxDuplicableFieldsContainer {

		/**
		 * The duplicable field controls.
		 *
		 * @var array
		 */
		protected $_controls = array();

		/**
		 * The duplicable field model.
		 *
		 * @var string
		 */
		protected $_field;

		/**
		 * The intro text.
		 *
		 * @var string
		 */
		protected $_introText = '';

		/**
		 * True if the fields elements should be sortable.
		 *
		 * @var boolean
		 */
		protected $_isSortable = false;

		/**
		 * True if the fields elements are to be prepended in the container.
		 *
		 * @var boolean
		 */
		protected $_prependable = false;

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
		protected $_template = 'admin/metabox_fields_container_duplicable';

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
		 * Add a duplicable field control.
		 *
		 * @param string $label The control label.
		 * @param string $id The control id.
		 * @param array $data The control data attributes.
		 * @return void
		 */
		public function addControl( $label, $id, $icon='', $data=array() )
		{
			if( empty($id) ) {
				$id = 'new';
			}

			$data['tpl'] = $id;

			$this->_controls[$id] = array(
				'label' => $label,
				'icon' => $icon,
				'data' => $data
			);
		}

		/**
		 * Get the duplicable field controls.
		 *
		 * @return array
		 */
		public function getControls()
		{
			return $this->_controls;
		}

		/**
		 * Get the duplicable field model.
		 *
		 * @return THB_Field
		 */
		public function getField()
		{
			return $this->_field;
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
		 * Get the items from the duplicable table
		 *
		 * @return array
		 */
		public function getItems()
		{
			global $post;

			$post_id = isset($_GET['post']) ? $_GET['post'] : $post->ID;

			$items = thb_duplicable_get( $this->getField()->getName(), $post_id );

			$fields = array();
			$field = null;

			foreach( $items as $item ) {
				$field = clone $this->_field;

				// if( $field->isComplex() ) {
				// 	$item['value'] = unserialize($item['value']);
				// }

				$meta = array();
				if( !empty($item['meta']) ) {
					$meta = $item['meta'];
				}

				$field->setValue($item['value']);
				$field->setMeta($meta);

				$fields[] = $field;
			}

			return $fields;
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
		 * Return true when asked if duplicable.
		 *
		 * @return boolean
		 */
		public function isDuplicable()
		{
			return true;
		}

		/**
		 * Check if the fields are sortable.
		 *
		 * @return boolean
		 */
		public function isSortable()
		{
			return $this->_isSortable;
		}

		/**
		 * Check if the fields are prependable.
		 *
		 * @return boolean
		 */
		public function isPrependable()
		{
			return $this->_prependable;
		}

		/**
		 * Render the fields container.
		 *
		 * @return void
		 */
		public function render()
		{
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
		 * Save the fields container.
		 *
		 * @return void
		 */
		public function save()
		{
			global $post_id;

			thb_duplicable_fields_save( $this->_field, $post_id );
		}

		/**
		 * Set the duplicable field.
		 *
		 * @param THB_Field $field The field.
		 * @return void
		 */
		public function setField( THB_Field $field )
		{
			$this->_field = $field;
			$this->_field->setDuplicable();
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
		 * Set the fields to be sortable.
		 *
		 * @param boolean $sortable
		 * @return void
		 */
		public function setSortable( $sortable=true )
		{
			$this->_isSortable = $sortable;
		}

		/**
		 * Set the fields to be prependable.
		 *
		 * @param boolean $prependable
		 * @return void
		 */
		public function setPrependable( $prependable=true )
		{
			$this->_prependable = $prependable;
		}

	}
}