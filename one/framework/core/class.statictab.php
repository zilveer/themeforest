<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Custom tab class.
 *
 * This class is entitled to manage a page options static tab.
 * Static tabs are different from regular tabs as they do not save or elaborate
 * data via AJAX, but do that synchronously via page refresh.
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
if( !class_exists('THB_StaticTab') ) {
	class THB_StaticTab extends THB_Tab {

		/**
		 * The custom fields container action.
		 *
		 * @var string
		 */
		private $_action = '';

		/**
		 * The custom fields container submit label.
		 *
		 * @var string
		 */
		private $_submitLabel = '';

		/**
		 * The fields container template.
		 *
		 * @var string
		 */
		protected $_template = 'admin/statictab';

		/**
		 * Create a new custom fields container.
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 * @return THB_TabFieldsContainer
		 */
		public function createContainer( $title, $slug, $index = false )
		{
			$container = new THB_TabFieldsContainer( $title, $slug );
			$this->addContainer( $container, $index );

			return $container;
		}

		/**
		 * Get the name of the action to be called upon saving.
		 *
		 * @return string
		 */
		public function getAction()
		{
			return $this->_action;
		}

		/**
		 * Set a saving action for the fields container.
		 *
		 * @param string $action The name of the function to be called upon saving.
		 */
		public function setAction( $action )
		{
			$this->_action = $action;
		}

		/**
		 * Get the label for the fields container save button.
		 *
		 * @return string
		 */
		public function getSubmitLabel()
		{
			return $this->_submitLabel;
		}

		/**
		 * Set a label for the fields container save button.
		 *
		 * @param string $submitLabel The label of the save button.
		 */
		public function setSubmitLabel( $submitLabel )
		{
			$this->_submitLabel = $submitLabel;
		}

	}
}