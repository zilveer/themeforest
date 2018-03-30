<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Modal fields container class.
 *
 * This class is entitled to manage a modal fields container.
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
if( ! class_exists( 'THB_ModalFieldsContainer' ) ) {
	class THB_ModalFieldsContainer extends THB_FieldsContainer {

		/**
		 * The modal fields container template.
		 *
		 * @var string
		 */
		protected $_template = 'admin/modal_fields_container';

		/**
		 * Constructor
		 *
		 * @param string $title The modal fields container title.
		 * @param string $slug The modal fields container slug.
		 **/
		public function __construct( $title, $slug )
		{
			parent::__construct( $title, $slug );
		}

		/**
		 * Add a field to the modal fields container.
		 *
		 * @param THB_Field $field The field object.
		 * @param integer $index The field index.
		 * @return THB_Field
		 */
		public function addField( THB_Field $field, $index = false, $context = null )
		{
			return parent::addField( $field, $index, THB_Field::Free );
		}

		/**
		 * Render the modal fields container.
		 *
		 * @param array $data The fields data.
		 */
		public function render( $data = array() )
		{
			if( $this->getFields()->size() == 0 ) {
				return;
			}

			$intro_text = new THB_Template( THB_TEMPLATES_DIR . '/admin/introtext', array(
				'intro_text' => $this->getIntroText()
			));

			$modal_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'fields_container'     => $this,
				'container_intro_text' => $intro_text->render(true),
				'data'                 => $data
			) );

			$modal_template->render();
		}

	}
}