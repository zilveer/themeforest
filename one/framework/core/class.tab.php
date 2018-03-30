<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Tab class.
 *
 * This class is entitled to manage a page options tab.
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
if( !class_exists('THB_Tab') ) {
	class THB_Tab {

		/**
		 * The tab containers.
		 *
		 * @var array
		 */
		protected $_containers = null;

		/**
		 * The tab state.
		 *
		 * @var int
		 */
		protected $_state = 0;

		/**
		 * The tab index.
		 *
		 * @var int
		 */
		protected $_index = 0;

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
		protected $_template = 'admin/tab';

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
			if( empty($title) ) {
				wp_die( 'Empty fields container title.' );
			}

			if( empty($slug) ) {
				wp_die( 'Empty fields container slug.' );
			}

			$this->_title = $title;
			$this->_slug = $slug;
			$this->_containers = new THB_List();
		}

		/**
		 * Add a container to the tab.
		 *
		 * @param THB_Container $container The container about to be inserted.
		 * @param integer $index The insertion index.
		 * @return THB_Container
		 */
		public function addContainer( $container, $index=false )
		{
			$container->setTabSlug( $this->_slug );

			if( $index === false ) {
				$this->_containers->insert( $container );
			}
			else {
				$this->_containers->insertAt( $container, $index );
			}

			return $container;
		}

		/**
		 * Create a new fields container.
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 * @param int $index The insertion index.
		 * @return THB_TabFieldsContainer
		 */
		public function createContainer( $title, $slug, $index = false )
		{
			$container = new THB_TabFieldsContainer($title, $slug);
			$this->addContainer($container, $index);

			return $container;
		}

		/**
		 * Create a new duplicable fields container.
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 * @param int $index The insertion index.
		 * @return THB_TabDuplicableFieldsContainer
		 */
		public function createDuplicableContainer( $title, $slug, $index = false )
		{
			$container = new THB_TabDuplicableFieldsContainer($title, $slug);
			$this->addContainer($container, $index);

			return $container;
		}

		/**
		 * Get a tab fields container by its slug.
		 *
		 * @return THB_FieldsContainer
		 */
		public function getContainer( $slug )
		{
			foreach( $this->_containers as $container ) {
				if( $container->getSlug() == $slug ) {
					return $container;
				}
			}

			return false;
		}

		/**
		 * Get the tab fields containers.
		 *
		 * @return array
		 */
		public function getContainers()
		{
			return $this->_containers;
		}

		/**
		 * Get the tab index.
		 *
		 * @return int
		 */
		public function getIndex()
		{
			return $this->_index;
		}

		/**
		 * Get the tab slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get the tab title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Render the tab.
		 */
		public function render()
		{
			$tab_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'tab' => $this
			) );

			$tab_template->render();
		}

		/**
		 * Set the tab index.
		 *
		 * @param int $index
		 */
		public function setIndex( $index )
		{
			$this->_index = $index;
		}

		/**
		 * Set the tab to be active.
		 */
		public function setActive()
		{
			$this->_state = 1;
		}

		/**
		 * Check if this is an active tab.
		 *
		 * @return boolean
		 */
		public function isActive()
		{
			return $this->_state === 1;
		}

	}
}