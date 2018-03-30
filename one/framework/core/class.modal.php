<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Modal class.
 *
 * This class is entitled to manage a modal.
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
if( ! class_exists( 'THB_Modal' ) ) {
	class THB_Modal {

		/**
		 * The modal containers.
		 *
		 * @var array
		 */
		protected $_containers = null;

		/**
		 * The modal tabs.
		 *
		 * @var array
		 */
		protected $_tabs = null;

		/**
		 * The modal template.
		 *
		 * @var string
		 */
		protected $_template = 'admin/modal';

		/**
		 * True if the modal has a footer displayed.
		 *
		 * @var boolean
		 */
		protected $_footer = true;

		/**
		 * Constructor
		 *
		 * @param string $title The modal title.
		 * @param string $slug The modal slug.
		 **/
		public function __construct( $title, $slug )
		{
			if( empty($title) ) {
				wp_die( 'Empty modal fields container title.' );
			}

			if( empty($slug) ) {
				wp_die( 'Empty modal fields container slug.' );
			}

			$this->_title = $title;
			$this->_slug = $slug;
			$this->_tabs = new THB_List();

			$this->createTab( __( 'Options', 'thb_text_domain' ), '_options_tab' );
		}

		/**
		 * Add a tab to the modal.
		 *
		 * @param mixed $tab The tab about to be inserted.
		 * @param integer $index The insertion index.
		 * @return THB_ModalTab
		 */
		public function addTab( $tab, $index = false )
		{
			if( $index === false ) {
				$this->_tabs->insert( $tab );
			}
			else {
				$this->_tabs->insertAt( $tab, $index );
			}

			return $tab;
		}

		/**
		 * Create a new modal tab.
		 *
		 * @param string $title The modal tab title.
		 * @param string $slug The metabox tab slug.
		 * @param int $index The insertion index.
		 * @return THB_ModalFieldsContainer
		 */
		public function createTab( $title, $slug, $index=false )
		{
			$tab = new THB_ModalTab( $title, $slug );
			$this->addTab( $tab, $index );

			return $tab;
		}

		/**
		 * Get the modal slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get the modal title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Add a container to the modal.
		 *
		 * @param mixed $container The container about to be inserted.
		 * @param integer $index The insertion index.
		 * @return THB_ModalFieldsContainer
		 */
		public function addContainer( $container, $index = false )
		{
			return $this->getTab( '_options_tab' )->addContainer( $container, $index );
		}

		/**
		 * Create a new modal fields container.
		 *
		 * @param string $title The modal fields container title.
		 * @param string $slug The modal fields container slug.
		 * @param int $index The insertion index.
		 * @return THB_ModalFieldsContainer
		 */
		public function createContainer( $title, $slug, $index=false )
		{
			return $this->getTab( '_options_tab' )->createContainer( $title, $slug, $index );
		}

		/**
		 * Create a new duplicable modal fields container.
		 *
		 * @param string $title The modal fields container title.
		 * @param string $slug The modal fields container slug.
		 * @param int $index The insertion index.
		 * @return THB_ModalDuplicableFieldsContainer
		 */
		public function createDuplicableContainer( $title, $slug, $index=false )
		{
			return $this->getTab( '_options_tab' )->createDuplicableContainer( $title, $slug, $index );
		}

		/**
		 * Get a modal fields container by its slug.
		 *
		 * @return THB_ModalFieldsContainer
		 */
		public function getContainer( $slug )
		{
			return $this->getTab( '_options_tab' )->getContainer( $slug );
		}

		/**
		 * Get the modal fields containers.
		 *
		 * @return array
		 */
		public function getContainers()
		{
			return $this->getTab( '_options_tab' )->getContainers();
		}

		/**
		 * Get a modal tab by its slug.
		 *
		 * @return THB_MetaboxTab
		 */
		public function getTab( $slug )
		{
			foreach( $this->_tabs as $tab ) {
				if( $tab->getSlug() == $slug ) {
					return $tab;
				}
			}

			return false;
		}

		/**
		 * Get the modal tabs.
		 *
		 * @return array
		 */
		public function getTabs()
		{
			return $this->_tabs;
		}

		/**
		 * Hide the modal footer.
		 */
		public function hideFooter()
		{
			return $this->_footer = false;
		}

		/**
		 * Check if the modal footer is hidden.
		 *
		 * @return boolean
		 */
		public function footerHidden()
		{
			return $this->_footer;
		}

		/**
		 * Render the modal.
		 */
		public function render()
		{
			$all_empty = true;

			foreach( $this->getTabs() as $tab ) {
				if ( $tab->getContainers()->size() == 0 ) {
					continue;
				}

				foreach ( $tab->getContainers() as $container ) {
					if ( $container->getFields()->size() == 0 ) {
						continue;
					}
					else {
						$all_empty = false;
						break;
					}
				}
			}

			if( $all_empty ) {
				return;
			}

			$modal_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'modal' => $this
			) );

			$modal_template->render();
		}

		/**
		 * Serialize the modal keys.
		 *
		 * @return array
		 */
		public function serializeKeys()
		{
			$keys = array();

			foreach ( $this->getTabs() as $tab ) {
				foreach ( $tab->getContainers() as $container ) {
					$keys = array_merge( $keys, $container->serializeKeys() );
				}
			}

			return $keys;
		}

	}
}