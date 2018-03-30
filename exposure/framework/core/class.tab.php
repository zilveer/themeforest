<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Tab class.
 *
 * This class is entitled to manage a page options tab.
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
if( !class_exists('THB_Tab') ) {
	class THB_Tab {

		/**
		 * The tab containers.
		 *
		 * @var array
		 */
		protected $_containers = array();

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
		}

		/**
		 * Add a container to the tab.
		 *
		 * @param THB_Container $container The container about to be inserted.
		 * @param int $index The insertion index.
		 * @return void
		 */
		public function addContainer( $container, $index=false )
		{
			$container->setTabSlug($this->_slug);

			if( $index === false ) {
				$this->_containers[] = $container;
			}
			else {
				$this->_containers = thb_array_insert($this->_containers, $container, $index);
			}
		}

		/**
		 * Create a new fields container.
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 * @param int $index The insertion index.
		 * @return THB_TabFieldsContainer
		 */
		public function createContainer( $title, $slug, $index=false )
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
		 * @return THB_TabDuplicableFieldsContainer
		 */
		public function createDuplicableContainer( $title, $slug )
		{
			$container = new THB_TabDuplicableFieldsContainer($title, $slug);
			$this->addContainer($container);

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
		 *
		 * @return void
		 */
		public function render()
		{
			$tab_template = new THB_TemplateLoader($this->_template, array(
				'tab' => $this
			));

			$tab_template->render();
		}

		/**
		 * Set the tab index.
		 *
		 * @return void
		 */
		public function setIndex( $index )
		{
			$this->_index = $index;
		}

	}
}

/**
 * Save an options page tab.
 *
 * @return void
 */
if( !function_exists('thb_save_tab') ) {
	function thb_save_tab() {

		thb_system_verify_nonce('THB_tab');

		$theme = thb_theme();
		$page = $theme->getAdmin()->getPage($_POST['page']);
		$tab = $page->getTab($_POST['tab']);
		$containers = $tab->getContainers();
		$uniqids = array();

		foreach( $containers as $container ) {
			if( !$container->isDuplicable() ) {
				$newoptions = array();

				foreach( $container->getFields() as $field ) {
					if( $field->isComplex() ) {
						$value = array();
						foreach( $field->getSubkeys() as $subKey ) {
							$value[$subKey] = thb_text_toDB( $_POST[$field->getName()][$subKey] );
						}
					}
					else {
						$value = thb_text_toDB( $_POST[$field->getName()] );
					}
					$newoptions[$field->getName()] = $value;
				}

				$theme->saveOptions($newoptions);
			}
			else {
				$uniqids[$container->getSlug()] = thb_duplicable_fields_save( $container->getField() );
			}
		}

		thb_system_raise_success( __('All saved!', 'thb_text_domain'), $uniqids );
	}
}