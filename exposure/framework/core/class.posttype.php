<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Post type class.
 *
 * This class is entitled to manage a post type.
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
if( !class_exists('THB_PostType') ) {
	class THB_PostType {

		/**
		 * The post type arguments.
		 *
		 * @var array
		 */
		private $_args;

		/**
		 * The post type supported formats.
		 *
		 * @var array
		 */
		protected $_formats = array();

		/**
		 * The post type additional metaboxes
		 *
		 * @var array
		 **/
		protected $_metaboxes = array();

		/**
		 * The page templates associated to the post type
		 *
		 * @var array
		 **/
		protected $_pageTemplates = array();

		/**
		 * True if the post type is publicly publishable content.
		 *
		 * @var boolean
		 */
		protected $_publicContent = true;

		/**
		 * The post type default sidebar.
		 *
		 * @var string
		 */
		protected $_sidebar = null;

		/**
		 * The post taxonomies.
		 *
		 * @var array
		 */
		private $_taxonomies = array();

		/**
		 * The post type.
		 *
		 * @var string
		 */
		private $_type;

		/**
		 * Constructor
		 *
		 * @param string $type The post type name.
		 * @param arrat $args The post type arguments.
		 */
		public function __construct( $type, $args=array() )
		{
			if( empty($type) ) {
				wp_die( 'Empty post type.' );
			}

			if( !thb_array_contains($type, array('post', 'page')) && empty($args) ) {
				wp_die( 'Empty post arguments.' );
			}

			$this->_type = $type;
			$this->_args = $args;
		}

		/**
		 * Add a custom metabox to the post type.
		 *
		 * @param THB_Metabox $metabox The custom metabox.
		 * @param array $templates The admin templates that should display
		 * the metabox.
		 * @param int $index The insertion index.
		 * @return void
		 */
		public function addMetabox( $metabox, $templates=array(), $index=false )
		{
			$add = true;

			if( !empty($templates) ) {
				$add = thb_is_admin_template($templates);
			}

			// if( empty($_POST) && is_admin() ) {
			// 	foreach( $conditions as $condition ) {
			// 		if( !$condition ) {
			// 			$add = false;
			// 			break;
			// 		}
			// 	}
			// }

			if( $add ) {
				$metabox->setPostType($this->_type);
				$metabox = apply_filters('thb_' . $metabox->getSlug() . '_metabox', $metabox);

				if( $index === false ) {
					$this->_metaboxes[] = $metabox;
				}
				else {
					$this->_metaboxes = thb_array_insert($this->_metaboxes, $metabox, $index);
				}
			}
		}

		/**
		 * Add a custom metabox to the post type, if currently editing a page
		 * that's associated to the post type.
		 *
		 * @param THB_Metabox $metabox The custom metabox.
		 * @param array $templates The page template names array.
		 * @return void
		 */
		public function addMetaboxToPages( $metabox, $templates=array() )
		{
			$thb_theme = thb_theme();
			$thb_pages = $thb_theme->getPostType('page');

			if( empty($templates) ) {
				$templates = $this->getPageTemplates();
			}

			$thb_pages->addMetabox($metabox, $templates);

			// foreach( $templates as $template ) {
			// 	if( thb_is_admin_template($template) ) {
			// 		$thb_pages->addMetabox($metabox);
			// 		break;
			// 	}
			// }
		}

		/**
		 * Associate a page template to the post type.
		 *
		 * @param string $template The page template file name.
		 * @return void
		 */
		public function addPageTemplate( $template )
		{
			$this->_pageTemplates[] = $template;
		}

		/**
		 * Return the page templates associated to the post type.
		 *
		 * @return array
		 */
		public function getPageTemplates()
		{
			return $this->_pageTemplates;
		}

		/**
		 * Add a custom taxonomy to the post type.
		 *
		 * @param THB_Taxonomy $taxonomy The custom taxonomy.
		 * @return void
		 */
		public function addTaxonomy( THB_Taxonomy $taxonomy )
		{
			$taxonomy->setPostType($this->_type);

			$this->_taxonomies[] = $taxonomy;
		}

		/**
		 * Get the supported post formats.
		 *
		 * @return mixed
		 */
		public function getFormats()
		{
			return $this->_formats;
		}

		/**
		 * Get a metabox by its slug.
		 *
		 * @param string $slug The metabox slug.
		 * @return mixed
		 */
		public function getMetabox( $slug )
		{
			foreach( $this->_metaboxes as $metabox ) {
				if( $metabox->getSlug() == $slug ) {
					return $metabox;
				}
			}

			return false;
		}

		/**
		 * Get the post type metaboxes.
		 *
		 * @return mixed
		 */
		public function getMetaboxes()
		{
			return $this->_metaboxes;
		}

		/**
		 * Get the post type name.
		 *
		 * @return string
		 */
		public function getName()
		{
			if( $this->getType() == 'post' ) {
				return __('Posts', 'thb_text_domain');
			}
			elseif( $this->getType() == 'page' ) {
				return __('Pages', 'thb_text_domain');
			}
			else {
				return $this->_args['labels']['name'];
			}
		}

		/**
		 * Check if the post type is public.
		 *
		 * @return void
		 */
		public function isPublicContent()
		{
			return $this->_publicContent;
		}

		/**
		 * Get the post type sidebar.
		 *
		 * @return string
		 */
		public function getSidebar()
		{
			return $this->_sidebar;
		}

		/**
		 * Get the post type taxonomies.
		 *
		 * @return array
		 */
		public function getTaxonomies()
		{
			return $this->_taxonomies;
		}

		/**
		 * Get the post type.
		 *
		 * @return string
		 */
		public function getType()
		{
			return $this->_type;
		}

		/**
		 * Register the post type
		 *
		 * @return void
		 **/
		public function register()
		{
			if( !thb_array_contains($this->_type, array('post', 'page')) ) {
				register_post_type($this->_type, $this->_args);
			}
		}

		/**
		 * Register the post type's metaboxes
		 *
		 * @return void
		 **/
		public function registerMetaboxes()
		{
			foreach( $this->_metaboxes as $metabox ) {
				$metabox->register();
			}
		}

		/**
		 * Register the post type's taxonomies.
		 *
		 * @return void
		 **/
		public function registerTaxonomies()
		{
			foreach( $this->_taxonomies as $taxonomy ) {
				$taxonomy->register();
			}
		}

		/**
		 * Remove a post type metabox.
		 *
		 * @param string $slug The metabox slug.
		 */
		public function removeMetabox( $slug )
		{
			foreach( $this->_metaboxes as $metabox ) {
				if( $metabox->getSlug() == $slug ) {
					$metabox->setConditions( array(false) );
					return;
				}
			}
		}

		/**
		 * Save the custom post type's metabox data
		 **/
		public function saveMetaboxes()
		{
			if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
				return;
			}

			if( defined('DOING_AJAX') && DOING_AJAX ) {
				return;
			}

			global $post_type;

			if( !empty($_POST) && $this->_type == $post_type ) {
				foreach( $this->_metaboxes as $metabox ) {
					if( !$metabox->isAlreadySaved() ) {
						$metabox->save();
						$metabox->setAlreadySaved();
					}
				}
			}
		}

		/**
		 * Set the post type supported formats.
		 *
		 * @param array $formats The supported formats.
		 * @return void
		 */
		public function setFormats( $formats )
		{
			$this->_formats = $formats;
		}

		/**
		 * Set the post type to be public.
		 *
		 * @param boolean $public True if the post type is publicly publishable.
		 */
		public function setPublicContent( $public )
		{
			$this->_publicContent = $public;
		}

		/**
		 * Set the default post type sidebar name.
		 *
		 * @param string $name The sidebar name.
		 * @return void
		 */
		public function setSidebar( $name )
		{
			$this->_sidebar = $name;
		}

		/**
		 * Fix for custom loop pagination in custom taxonomy archives.
		 *
		 * @param Request $request Page request
		 * @return Request
		 */
		public function paginationFix( $request ) {
			if( !thb_array_contains($this->_type, array('post', 'page')) && $this->isPublicContent() ) {
				$dummy_query = new WP_Query();
				$dummy_query->parse_query($request);

				$thb_works_taxonomies = $this->getTaxonomies();

				foreach( $thb_works_taxonomies as $tax ) {
					if( isset($request[$tax->getType()]) ) {
						if ( $dummy_query->is_front_page() || $dummy_query->is_archive() ) {
							$posts_per_page = thb_get_option( $this->getType() . '_per_page');

							if( !empty($posts_per_page) ) {
								$request["posts_per_page"] = $posts_per_page;
							}
						}
					}
				}
			}

			return $request;
		}

	}
}