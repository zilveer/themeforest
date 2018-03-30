<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Metabox class.
 *
 * This class is entitled to manage a post type metabox.
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
		 * The metabox containers.
		 *
		 * @var array
		 */
		protected $_containers = array();

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
		 * Add a container to the metabox.
		 *
		 * @param mixed $container The container about to be inserted.
		 * @param int $index The insertion index.
		 * @return void
		 */
		public function addContainer( $container, $index=false )
		{
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
		 * @return THB_MetaboxFieldsContainer
		 */
		public function createContainer( $title, $slug, $index=false )
		{
			$container = new THB_MetaboxFieldsContainer($title, $slug);
			$this->addContainer($container, $index);

			return $container;
		}

		/**
		 * Create a new duplicable fields container.
		 *
		 * @param string $title The fields container title.
		 * @param string $slug The fields container slug.
		 * @return THB_MetaboxDuplicableFieldsContainer
		 */
		public function createDuplicableContainer( $title, $slug )
		{
			$container = new THB_MetaboxDuplicableFieldsContainer($title, $slug);
			$this->addContainer($container);

			return $container;
		}

		/**
		 * Get a metabox fields container by its slug.
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
		 * Get a metabox fields container index by its slug.
		 *
		 * @return int
		 */
		public function getContainerIndex( $slug )
		{
			$i=0;

			foreach( $this->_containers as $container ) {
				if( $container->getSlug() == $slug ) {
					return $i;
				}

				$i++;
			}

			return false;
		}

		/**
		 * Get the metabox fields containers.
		 *
		 * @return array
		 */
		public function getContainers()
		{
			return $this->_containers;
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

			if( count($this->getContainers()) == 0 ) {
				return;
			}
			else {
				foreach( $this->getContainers() as $container ) {
					$all_empty = true;
					if( ! $container instanceOf THB_MetaboxFieldsContainer || count($container->getFields()) != 0 ) {
						$all_empty = false;
						break;
					}
				}

				if( $all_empty ) {
					return;
				}
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
		 *
		 * @return void
		 */
		public function render()
		{
			$metabox_template = new THB_TemplateLoader($this->_template, array(
				'metabox' => $this,
				'showing_conditions' => $this->parseMetaboxConditions()
			));

			$metabox_template->render();
		}

		/**
		 * Save the metabox.
		 *
		 * @return void
		 */
		public function save()
		{
			foreach( $this->_containers as $container ) {
				$container->save();
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

		// public function __toString() {
		// 	$containers = $this->getContainers();

		// 	$string = '<pre>';
		// 		$string .= sprintf("Title: %s", $this->getTitle()) . "\n";
		// 		$string .= sprintf("Slug: %s", $this->getSlug()) . "\n";
		// 		$string .= "Containers:" . "\n";

		// 		foreach( $containers as $container ) {
		// 			$string .= "\t" . $container->getSlug() . "\n";
		// 		}

		// 	$string .= '</pre>';

		// 	return $string;
		// }

	}
}