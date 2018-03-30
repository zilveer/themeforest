<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Tab fields Container class.
 *
 * This class is entitled to manage a tab container for input fields.
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
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_TabFieldsContainer') ) {
	class THB_TabFieldsContainer extends THB_FieldsContainer {

		/**
		 * The fields container tab slug.
		 *
		 * @var string
		 */
		private $_tabSlug = '';

		/**
		 * The fields container template.
		 *
		 * @var string
		 */
		protected $_template = 'admin/tab_fields_container';

		/**
		 * Constructor
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 **/
		public function __construct( $title, $slug )
		{
			parent::__construct( $title, $slug );
		}

		/**
		 * Add a field to the fields container.
		 *
		 * @param THB_Field $field The field object.
		 * @param integer $index The field index.
		 * @return THB_Field
		 */
		public function addField( THB_Field $field, $index = false, $context = null )
		{
			return parent::addField( $field, $index, $field->getContext() );
		}

		/**
		 * Get the fields container tab slug.
		 *
		 * @return string
		 */
		public function getTabSlug()
		{
			return $this->_tabSlug;
		}

		/**
		 * Return false as the fields container is not duplicable.
		 *
		 * @return boolean
		 */
		public function isDuplicable()
		{
			return false;
		}

		/**
		 * Render the fields container.
		 */
		public function render()
		{
			if( $this->getFields()->size() == 0 ) {
				return;
			}

			$intro_text = new THB_Template( THB_TEMPLATES_DIR . '/admin/introtext', array(
				'intro_text' => $this->getIntroText()
			));

			$fields_container_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'fields_container' => $this,
				'container_intro_text' => $intro_text->render(true)
			));

			$fields_container_template->render();
		}

		/**
		 * Set the fields container tab slug.
		 *
		 * @param string $slug The tab slug.
		 * @return void
		 */
		public function setTabSlug( $slug )
		{
			$this->_tabSlug = $slug;
		}

	}
}