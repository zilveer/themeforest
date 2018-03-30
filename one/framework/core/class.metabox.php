<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Metabox class.
 *
 * This class is entitled to manage a post type metabox.
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
if( !class_exists('THB_Metabox') ) {
	class THB_Metabox {

		/**
		 * The metabox saved state.
		 *
		 * @var boolean
		 */
		protected $_alreadySaved = false;

		/**
		 * The metabox showing conditions.
		 *
		 * @var array
		 */
		private $_conditions = array();

		/**
		 * The metabox tabs.
		 *
		 * @var array
		 */
		protected $_tabs = null;

		/**
		 * The metabox #id.
		 *
		 * @var string
		 */
		private $_id = '';

		/**
		 * The metabox position.
		 *
		 * @var string
		 */
		protected $_postType;

		/**
		 * The metabox position.
		 *
		 * @var string
		 */
		protected $_position = 'normal';

		/**
		 * The metabox priority.
		 *
		 * @var string
		 */
		protected $_priority = 'low';

		/**
		 * The fields container slug.
		 *
		 * @var string
		 */
		protected $_slug = '';

		/**
		 * The metabox template.
		 *
		 * @var string
		 */
		protected $_template = 'admin/metabox';

		/**
		 * The fields container title.
		 *
		 * @var string
		 */
		protected $_title = '';

		/**
		 * Set to true to always display the metabox, even when it has no fields.
		 *
		 * @var boolean
		 */
		private $_alwaysDisplay = false;

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
			$this->_tabs = new THB_List();

			$tab = $this->createTab( __( 'Options', 'thb_text_domain' ), '_options_tab' );
			$tab->setIcon( 'admin-generic' );
		}

		/**
		 * Set the metabox to always display, even when it has no fields.
		 *
		 * @param boolean $ad
		 */
		public function setAlwaysDisplay( $ad = true )
		{
			$this->_alwaysDisplay = $ad;
		}

		/**
		 * Add a tab to the metabox.
		 *
		 * @param mixed $tab The tab about to be inserted.
		 * @param integer $index The insertion index.
		 * @return THB_MetaboxTab
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
		 * Create a new metabox tab.
		 *
		 * @param string $title The metabox tab title.
		 * @param string $slug The metabox tab slug.
		 * @param int $index The insertion index.
		 * @return THB_MetaboxFieldsContainer
		 */
		public function createTab( $title, $slug, $index=false )
		{
			$tab = new THB_MetaboxTab( $title, $slug );
			$this->addTab( $tab, $index );

			return $tab;
		}

		/**
		 * Add a container to the metabox.
		 *
		 * @param mixed $container The container about to be inserted.
		 * @param integer $index The insertion index.
		 * @return THB_MetaboxFieldsContainer
		 */
		public function addContainer( $container, $index = false )
		{
			return $this->getTab( '_options_tab' )->addContainer( $container, $index );
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
			return $this->getTab( '_options_tab' )->createContainer( $title, $slug, $index );
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
			return $this->getTab( '_options_tab' )->createDuplicableContainer( $title, $slug, $index );
		}

		/**
		 * Get the metabox tab fields containers.
		 *
		 * @return array
		 */
		public function getContainers()
		{
			return $this->getTab( '_options_tab' )->getContainers();
		}

		/**
		 * Get a metabox tab fields container by its slug.
		 *
		 * @return THB_FieldsContainer
		 */
		public function getContainer( $slug )
		{
			return $this->getTab( '_options_tab' )->getContainer( $slug );
		}

		/**
		 * Get a metabox tab by its slug.
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
		 * Get the metabox tabs.
		 *
		 * @return array
		 */
		public function getTabs()
		{
			return $this->_tabs;
		}

		/**
		 * Get the metabox post type.
		 *
		 * @return string
		 */
		public function getPostType()
		{
			return $this->_postType;
		}

		/**
		 * Get the metabox slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get the metabox title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Check if the metabox has already been saved.
		 *
		 * @return boolean
		 */
		public function isAlreadySaved()
		{
			return $this->_alreadySaved == true;
		}

		/**
		 * Parse the metabox showing conditions.
		 *
		 * @return string
		 */
		private function parseMetaboxConditions()
		{
			foreach( $this->_conditions as $condition ) {
				if( !$condition ) {
					return '<style>#' . $this->_id . ' { display: none !important; }</style>';
				}
			}

			return '';
		}

		/**
		 * Register the post type's metabox
		 *
		 * @return void
		 **/
		public function register()
		{
			if( empty($this->_postType) ) {
				wp_die( 'Empty metabox post type.' );
			}

			$all_empty = true;

			foreach( $this->getTabs() as $tab ) {
				if ( ! $this->_alwaysDisplay && $tab->getContainers()->size() == 0 ) {
					continue;
				}

				foreach ( $tab->getContainers() as $container ) {
					if ( ! $this->_alwaysDisplay && $container->getFields()->size() == 0 ) {
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

			$this->_id = "metabox_{$this->_postType}_{$this->_slug}";

			add_meta_box(
				$this->_id,
				$this->_title,
				array($this, 'render'),
				$this->_postType,
				$this->_position,
				$this->_priority
			);

			add_action( 'admin_head', array($this, 'disableHideMetaboxes') );
		}

		/**
		 * Do not allow users to hide custom created metaboxes.
		 *
		 * @return void
		 */
		public function disableHideMetaboxes()
		{
			echo "<style type='text/css'>label[for='" . $this->_id . "-hide'] { display: none; }</style>";
		}

		/**
		 * Render the metabox.
		 */
		public function render()
		{
			$metabox_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'metabox' => $this,
				'showing_conditions' => $this->parseMetaboxConditions()
			) );

			$metabox_template->render();
		}

		/**
		 * Save the metabox.
		 */
		public function save()
		{
			foreach( $this->getTabs() as $tab ) {
				$tab->save();
			}
		}

		/**
		 * Set a mark that indicates that the metabox has already been saved.
		 *
		 * @return void
		 */
		public function setAlreadySaved()
		{
			$this->_alreadySaved = true;
		}

		/**
		 * Set the metabox showing conditions.
		 *
		 * @param array $conditions The metabox showing conditions.
		 * @return void
		 */
		public function setConditions( $conditions )
		{
			$this->_conditions = $conditions;
		}

		/**
		 * Set the metabox position.
		 *
		 * @param string $position
		 * @return void
		 */
		public function setPosition( $position )
		{
			$this->_position = $position;
		}

		/**
		 * Set the metabox post type.
		 *
		 * @param string $postType
		 * @return void
		 */
		public function setPostType( $postType )
		{
			$this->_postType = $postType;
		}

		/**
		 * Set the metabox priority.
		 *
		 * @param string $priority
		 * @return void
		 */
		public function setPriority( $priority )
		{
			$this->_priority = $priority;
		}

	}
}