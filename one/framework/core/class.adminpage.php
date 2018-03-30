<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Page class.
 *
 * This class is entitled to manage admin pages.
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
if( !class_exists('THB_AdminPage') ) {
	class THB_AdminPage {

		/**
		 * The page capability which determines its level of access.
		 *
		 * @see http://codex.wordpress.org/Roles_and_Capabilities
		 * @var string
		 **/
		protected $_capability = 'edit_theme_options';

		/**
		 * The page content.
		 *
		 * @var string
		 */
		private $_content = '';

		/**
		 * The page content data.
		 *
		 * @var array
		 */
		private $_contentData = array();

		/**
		 * The page slug.
		 *
		 * @var string
		 **/
		private $_slug = '';

		/**
		 * The page tabs.
		 *
		 * @var array
		 **/
		protected $_tabs = array();

		/**
		 * The page template.
		 *
		 * @var string
		 **/
		protected $_template = 'admin/page';

		/**
		 * The page title.
		 *
		 * @var string
		 **/
		private $_title = '';

		/**
		 * Constructor
		 *
		 * @param string $title The page title (to be passed translated).
		 * @param string $slug The page slug (unique, not translated).
		 * @param string $capability The page capability.
		 **/
		public function __construct( $title, $slug, $capability=null )
		{
			if( empty($title) ) {
				wp_die( 'Empty page title.' );
			}

			if( empty($slug) ) {
				wp_die( 'Empty page slug.' );
			}

			$this->_title = $title;
			$this->_slug = $slug;

			if( $capability ) {
				$this->_capability = $capability;
			}
		}

		/**
		 * Add a tab to the page.
		 *
		 * @param THB_Tab, THB_DuplicableTab $tab
		 */
		public function addTab( $tab, $index = null )
		{
			if( $index === null ) {
				$index = 10 + ( count($this->_tabs) * 10 );
			}

			$ok = false;
			while( !$ok ) {
				if( !isset($this->_tabs[$index]) ) {
					$tab->setIndex($index);
					$tab = apply_filters('thb_' . $tab->getSlug() . '_tab', $tab);
					$this->_tabs[$index] = $tab;
					$ok = true;
				}
				else {
					// $index++;
					$index = $index + 10;
				}
			}
		}

		/**
		 * Get the page capability.
		 *
		 * @return string
		 */
		public function getCapability()
		{
			return $this->_capability;
		}

		/**
		 * Get the page content.
		 *
		 * @return string
		 */
		public function getContent()
		{
			if ( ! empty( $this->_content ) ) {
				$content = new THB_Template( $this->_content, $this->_contentData );
				return $content->render( true );
			}

			return '';
		}

		/**
		 * Get the page slug.
		 *
		 * @return string
		 */
		public function getSlug()
		{
			return $this->_slug;
		}

		/**
		 * Get a tab by its slug.
		 *
		 * @param string $slug The tab slug.
		 * @return mixed
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
		 * Get the page tabs.
		 *
		 * @return array
		 */
		public function getTabs()
		{
			$tabs = $this->_tabs;
			usort($tabs, array($this, 'orderTabs'));

			return $tabs;
		}

		/**
		 * Get the page title.
		 *
		 * @return string
		 */
		public function getTitle()
		{
			return $this->_title;
		}

		/**
		 * Order tabs by their registered index.
		 *
		 * @param THB_Tab $a First tab to compare.
		 * @param THB_Tab $b Second tab to compare.
		 * @return int
		 */
		public function orderTabs( $a, $b )
		{
			if( $a->getIndex() == $b->getIndex() ) {
				return 0;
			}

			return ( $a->getIndex() < $b->getIndex() ) ? -1 : 1;
		}

		/**
		 * Render the page.
		 */
		public function render()
		{
			$page_template = new THB_Template( THB_TEMPLATES_DIR . '/' . $this->_template, array(
				'page'  => $this,
				'theme' => thb_theme()
			));

			$page_template->render();
		}

		/**
		 * Save the page.
		 *
		 * @return mixed
		 */
		public function save()
		{
			thb_system_verify_nonce('THB_tab');

			if( isset($_POST['action']) ) {
				if( function_exists($_POST['action']) ) {
					return call_user_func($_POST['action']);
				}
				else {
					wp_die( sprintf( __('The specified tab action must be a valid function: "%s".', 'thb_text_domain'), $_POST['action'] ) );
				}
			}

			return true;
		}

		/**
		 * Set the page capability.
		 *
		 * @param string $capability The page capability.
		 * @return void
		 */
		public function setCapability( $capability )
		{
			$this->_capability = $capability;
		}

		/**
		 * Set the page title.
		 *
		 * @param string $title The page title.
		 * @return void
		 */
		public function setTitle( $title )
		{
			$this->_title = $title;
		}

		/**
		 * Set the page content.
		 *
		 * @param string $templatePath The path to the page content template.
		 * @param array $data=array() The array of data passed to the page.
		 * @return void
		 */
		public function setContent( $templatePath, array $data=array() )
		{
			$data = wp_parse_args( $data, array(
				'page' => $this
			) );

			$this->_content = $templatePath;
			$this->_contentData = $data;
		}

	}
}