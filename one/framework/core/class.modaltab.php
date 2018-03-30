<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Modal tab class.
 *
 * This class is entitled to manage a modal tabs.
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
if( ! class_exists( 'THB_ModalTab' ) ) {
	class THB_ModalTab {
		/**
		 * The modal tab containers.
		 *
		 * @var array
		 */
		protected $_containers = null;
		/**
		 * The fields container slug.
		 *
		 * @var string
		 */
		protected $_slug = '';
		/**
		 * The modal tab template.
		 *
		 * @var string
		 */
		protected $_template = 'admin/modal_tab';
		/**
		 * The fields container title.
		 *
		 * @var string
		 */
		protected $_title = '';

		/**
		 * The modal tab nav class.
		 *
		 * @var string
		 */
		private $_nav_class = '';

		/**
		 * Constructor
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 **/
		public function __construct( $title, $slug )
		{
			if( empty($title) ) {
				wp_die( 'Empty modal tab title.' );
			}

			if( empty($slug) ) {
				wp_die( 'Empty modal tab slug.' );
			}

			$this->setTitle( $title );
			$this->_slug = $slug;
			$this->_containers = new THB_List();
		}
		/**
		 * Add a container to the modal tab.
		 *
		 * @param mixed $container The container about to be inserted.
		 * @param integer $index The insertion index.
		 * @return THB_MetaboxFieldsContainer
		 */
		public function addContainer( $container, $index = false )
		{
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
		 * @return THB_MetaboxFieldsContainer
		 */
		public function createContainer( $title, $slug, $index=false )
		{
			$container = new THB_ModalFieldsContainer( $title, $slug );
			$this->addContainer( $container, $index );

			return $container;
		}
		/**
		 * Create a new duplicable fields container.
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 * @param int $index The insertion index.
		 * @return THB_MetaboxDuplicableFieldsContainer
		 */
		public function createDuplicableContainer( $title, $slug, $index=false )
		{
			$container = new THB_ModalDuplicableFieldsContainer($title, $slug);
			$this->addContainer($container, $index);

			return $container;
		}

		/**
		 * Get a modal tab fields container by its slug.
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
		 * Get the modal tab fields containers.
		 *
		 * @return array
		 */
		public function getContainers()
		{
			return $this->_containers;
		}

		/**
		 * Get the modal tab slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get the modal tab title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Set the modal tab title.
		 *
		 * @param string $title
		 * @return string
		 */
		public function setTitle( $title )
		{
			$this->_title = $title;
		}

		/**
		 * Save the metabox.
		 */
		public function save()
		{
			foreach( $this->getContainers() as $container ) {
				$container->save();
			}
		}

		/**
		 * Render the modal tab.
		 */
		public function render( $data = array() )
		{
			$modal_tab_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'tab'  => $this,
				'data' => $data
			) );

			$modal_tab_template->render();
		}

		/**
		 * Add a separator for the modal tab.
		 */
		public function addSeparator()
		{
			$this->_nav_class .= ' sep';
		}

		/**
		 * Get the tab nav class.
		 *
		 * @return string
		 */
		public function getNavClass()
		{
			return $this->_nav_class;
		}
	}
}