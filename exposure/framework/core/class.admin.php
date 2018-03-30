<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Admin class.
 *
 * This class is entitled to manage the theme administration instance.
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
if( !class_exists('THB_Admin') ) {
	class THB_Admin {

		/**
		 * The admin actions.
		 *
		 * @var array
		 **/
		private $_actions = array();

		/**
		 * The theme installation details.
		 *
		 * @var array
		 **/
		private $_installationDetails = array();

		/**
		 * The theme default language.
		 *
		 * @var string
		 */
		private $_defaultLanguage = 'en_US';

		/**
		 * The theme language.
		 *
		 * @var string
		 */
		private $_language;

		/**
		 * The admin messages.
		 *
		 * @var array
		 **/
		private $_messages = array();

		/**
		 * The admin pages.
		 *
		 * @var array
		 **/
		private $_pages = array();

		/**
		 * The admin scripts.
		 *
		 * @var array
		 **/
		private $_scripts = array();

		/**
		 * The admin styles.
		 *
		 * @var array
		 **/
		private $_styles = array();

		/**
		 * The admin interface tweaks.
		 *
		 * @var THB_AdminTweaks
		 */
		private $_tweaks = null;

		/**
		 * Constructor
		 *
		 **/
		public function __construct()
		{
			$this->addPage( new THB_AdminPage( __('Theme options', 'thb_text_domain'), 'thb-theme-options' ) );

			$this->_loadInstallationDetails();
			$this->_tweaks = new THB_AdminTweaks();

			$this->addScript(THB_ADMIN_JS_URL . '/jquery.scrollTo-1.4.3.1-min.js', array('jquery'));

			$this->addScript(THB_ADMIN_JS_URL . '/jshashtable-2.1.js');
			$this->addScript(THB_FRONTEND_JS_URL . '/thb.toolkit.js' );
			$this->addScript(THB_ADMIN_JS_URL . '/admin-models.js', array('jquery', 'backbone'));
			$this->addScript(THB_ADMIN_JS_URL . '/admin-views.js', array('jquery', 'backbone'));
			$this->addScript(THB_ADMIN_JS_URL . '/admin-fields.js', array('jquery', 'backbone', 'wp-color-picker'));
			$this->addScript(THB_ADMIN_JS_URL . '/admin.js', array('jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable', 'media-upload', 'thickbox'));
			$this->addScript(THB_ADMIN_JS_URL . '/codemirror.js');
			$this->addScript(THB_ADMIN_JS_URL . '/css.js');

			$this->addStyle(THB_ADMIN_CSS_URL . '/admin.css', array('thickbox'));
			$this->addStyle(THB_ADMIN_CSS_URL . '/codemirror.css');

			$this->addAction('wp_ajax_thb_save_tab', 'thb_save_tab');
			$this->addAction('wp_ajax_thb_image_get_sizes', 'thb_image_get_sizes');
			$this->addAction('wp_ajax_thb_discard_message', 'thb_discard_message');

			// Custom metabox locations
			$this->addAction('edit_form_after_title', array($this, 'afterTitleMetaboxes'));
		}

		/**
		 * Add a new location for metaboxes after the entry title.
		 *
		 * @return void
		 */
		public function afterTitleMetaboxes()
		{
			global $post;

			do_meta_boxes(null, 'thb_after_title', $post);
		}

		/**
		 * Add an admin AJAX action to the admin interface.
		 *
		 * @param string $name A string representing the name of the action.
		 * @param callable $callback The function to be executed.
		 **/
		public function addAction( $name, $callback )
		{
			if( empty($name) ) {
				wp_die( 'Empty admin action name.' );
			}

			if( empty($callback) ) {
				wp_die( 'Empty admin action callback.' );
			}

			$this->_actions[$name] = $callback;
		}

		/**
		 * Add a message to the admin interface.
		 *
		 * @param string $key The message key.
		 * @return void
		 */
		public function addMessage( $key )
		{
			$this->discardMessage($key);

			$this->_installationDetails['messages'][] = $key;
			update_option(THB_INSTALLATION_KEY, $this->_installationDetails);
		}

		/**
		 * Add a page to the admin interface.
		 *
		 * @param THB_AdminPage $page The page object.
		 * @return THB_AdminPage
		 */
		public function addPage( $page )
		{
			if( !$this->_verifyPageSlugUniqueness($page->getSlug()) ) {
				wp_die( sprintf('A page with this slug has been defined already: "%s".', $page->getSlug() ) );
			}

			$this->_pages[] = $page;
			return $page;
		}

		/**
		 * Add a script to the admin interface.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
		 * @param string $path The admin script path.
		 * @param string $dependencies The admin script dependencies.
		 * @return void
		 **/
		public function addScript( $path, array $dependencies=array() )
		{
			if( empty($path) ) {
				wp_die( 'Empty admin script path.' );
			}

			$this->_scripts[$path] = $dependencies;
		}

		/**
		 * Add a stylesheet to the admin interface.
		 *
		 * @param string $path The admin stylesheet path.
		 * @param string $dependencies The admin stylesheet dependencies.
		 * @return void
		 **/
		public function addStyle( $path, array $dependencies=array() )
		{
			if( empty($path) ) {
				wp_die( 'Empty admin stylesheet path.' );
			}

			$this->_styles[$path] = $dependencies;
		}

		/**
		 * Append the actions to the admin interface.
		 *
		 * @return void
		 **/
		public function appendActions()
		{
			foreach( $this->_actions as $name => $callback ) {
				add_action($name, $callback);
			}
		}

		/**
		 * Append the scripts to the admin interface.
		 *
		 * @return void
		 **/
		public function appendScripts()
		{
			global $pagenow;

			$edit_page = $pagenow == 'post.php' || $pagenow == 'post-new.php';
			$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_GET['post']) ? get_post_type($_GET['post']) : 'post');
			$post_type_support = post_type_supports($post_type, 'editor') || post_type_supports($post_type, 'thumbnail');

			wp_enqueue_style('wp-color-picker');

			if( !$edit_page || !$post_type_support ) {
				wp_enqueue_media();
			}

			$i=0;
			foreach( $this->_scripts as $path => $dependencies ) {
				$script = 'thb_backendScript' . $i;
				wp_register_script($script, $path, $dependencies, null, true);
				wp_enqueue_script($script);
				$i++;
			}
		}

		/**
		 * Append the styles to the admin interface.
		 *
		 * @return void
		 **/
		public function appendStyles()
		{
			$i=0;
			foreach( $this->_styles as $path => $dependencies ) {
				$style = 'thb_backendStyle' . $i;
				wp_register_style($style, $path, $dependencies);
				wp_enqueue_style($style);
				$i++;
			}
		}

		/**
		 * Append custom admin CSS.
		 *
		 * @return void
		 */
		public function appendCustomAdminCSS()
		{
			echo '<style type="text/css">' . thb_get_option('admin_css') . '</style>';
		}

		/**
		 * Discard all the admin interface messages.
		 *
		 * @return void
		 */
		public function discardAllMessages()
		{
			$this->_installationDetails['messages'] = array();
			update_option(THB_INSTALLATION_KEY, $this->_installationDetails);
		}

		/**
		 * Discard an admin interface message.
		 *
		 * @param string $key The message key.
		 * @return void
		 */
		public function discardMessage( $key )
		{
			foreach( array_keys($this->_installationDetails['messages']) as $i ) {
				if( $this->_installationDetails['messages'][$i] == $key ) {
					unset($this->_installationDetails['messages'][$i]);
				}
			}

			update_option(THB_INSTALLATION_KEY, $this->_installationDetails);
		}

		/**
		 * Check if the theme is being installed for the first time.
		 *
		 * @return boolean
		 */
		public function firstTimeInstall()
		{
			return empty($this->_installationDetails) || !isset($this->_installationDetails['installed']) || $this->_installationDetails['installed'] != '1';
		}

		/**
		 * Get the theme administration interface default language.
		 *
		 * @return string
		 */
		public function getDefaultLanguage()
		{
			return $this->_defaultLanguage;
		}

		/**
		 * Get the theme installation details.
		 *
		 * @return array
		 */
		public function getInstallationDetails()
		{
			return $this->_installationDetails;
		}

		/**
		 * Get the theme administration interface language.
		 *
		 * @return string
		 */
		public function getLanguage()
		{
			return $this->_language;
		}

		/**
		 * Get an admin interface message.
		 *
		 * @return array
		 */
		public function getMessage( $key )
		{
			$message = $key;

			if( isset($this->_installationDetails['messages'][$key]) ) {
				$message = $key;
			}

			return $message;
		}

		/**
		 * Get the admin interface message.
		 *
		 * @return array
		 */
		public function getMessages()
		{
			$messages = array();

			foreach( $this->_installationDetails['messages'] as $key ) {
				$messages[] = $key;
			}

			return $messages;
		}

		/**
		 * Get the theme main options page admin URL.
		 *
		 * @return string
		 */
		public function getMainPageUrl()
		{
			$slug = $this->getMainPage()->getSlug();

			return thb_system_admin_url($slug);
		}

		/**
		 * Get the theme main options page.
		 *
		 * @return mixed
		 */
		public function getMainPage()
		{
			return $this->getPage('thb-theme-options');
		}

		/**
		 * Get a page by its slug.
		 *
		 * @param string $slug The page slug.
		 * @return mixed
		 */
		public function getPage( $slug )
		{
			foreach( $this->_pages as $page ) {
				if( $page->getSlug() == $slug ) {
					return $page;
				}
			}

			return false;
		}

		/**
		 * Get all the theme administration pages.
		 *
		 * @return mixed
		 */
		public function getPages()
		{
			return $this->_pages;
		}

		/**
		 * True when the theme is activated.
		 *
		 * @return boolean
		 */
		function hasJustBeenActivated()
		{
			global $pagenow;

			if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
				return true;
			}

			return false;
		}

		/**
		 * Load the theme installation details.
		 * Migration functions must be named as follows:
		 *
		 * WP version migrations:
		 * thb_wp_migration_{new}
		 * E.g. thb_wp_migration_36()
		 *
		 * DB version migrations:
		 * thb_db_migration_{old}_{new}
		 * E.g. thb_db_migration_5_6()
		 *
		 * @return void
		 */
		private function _loadInstallationDetails()
		{
			$this->_installationDetails = get_option(THB_INSTALLATION_KEY);

			if( empty($this->_installationDetails) ) {
				$this->_installationDetails = array(
					'installed'         => '0',
					'framework_version' => THB_FRAMEWORK_VERSION,
					'db_version'        => THB_DB_VERSION,
					'messages'          => array(),
					'wp_version'		=> get_bloginfo('version')
				);
			}
			else {
				if( version_compare($this->_installationDetails['db_version'], THB_DB_VERSION) < 0 ) {
					for( $i=$this->_installationDetails['db_version']; $i<THB_DB_VERSION; $i++ ) {
						$func = 'thb_db_migration_' . $i . '_' . ($i+1);

						if( function_exists($func) ) {
							call_user_func($func);
						}
					}
				}

				$wp_version = get_bloginfo('version');

				if( isset($this->_installationDetails['wp_version']) ) {
					if( version_compare($this->_installationDetails['wp_version'], $wp_version) < 0 ) {
						$current_version = floatval($this->_installationDetails['wp_version']) * 10;
						$current_wp_version = floatval($wp_version) * 10;

						for( $j=$current_version; $j<$current_wp_version; $j++ ) {
							$func = 'thb_wp_migration_' . ($j+1);

							if( function_exists($func) ) {
								call_user_func($func);
							}
						}
					}
				}

				$this->_installationDetails['installed'] = '1';
				$this->_installationDetails['framework_version'] = THB_FRAMEWORK_VERSION;
				$this->_installationDetails['db_version'] = THB_DB_VERSION;
				$this->_installationDetails['wp_version'] = $wp_version;
			}

			update_option(THB_INSTALLATION_KEY, $this->_installationDetails);
		}

		/**
		 * Set the theme administration interface default language.
		 *
		 * @param string $lang The language code.
		 * @return void
		 */
		public function setDefaultLanguage( $lang )
		{
			if( empty($lang) ) {
				$lang = 'en_US';
			}

			$this->_defaultLanguage = $lang;
		}

		/**
		 * Set the theme administration interface language.
		 *
		 * @param string $lang The language code.
		 * @return void
		 */
		public function setLanguage( $lang )
		{
			$this->_language = $lang == '' ? $this->_defaultLanguage : $lang;
		}

		/**
		 * Redirect the user to a specific theme page.
		 *
		 * @param string $slug The page slug.
		 * @return void
		 */
		public function redirectToThemePage( $slug=null )
		{
			if( ! $slug ) {
				$pages = $this->getPages();

				if( empty($pages) ) {
					return;
				}

				$page = $pages[0];
				$slug = $page->getSlug();
			}

			wp_redirect( thb_system_admin_url($slug) );
			die();
		}

		/**
		 * Register all the defined theme's administration pages.
		 *
		 * @return void
		 **/
		public function registerPages()
		{
			if( !empty($this->_pages) ) {
				$menu_image = null;

				$i=0;
				foreach( $this->_pages as $page ) {
					$page_title = $page->getTitle();
					$page_slug = $page->getSlug();
					$page_capability = $page->getCapability();
					$page_handler = array($page, 'render');

					if( thb_system_is_production() ) {
						if( $i == 0 ) {
							add_menu_page($page_title, $page_title, $page_capability, $page_slug, $page_handler, $menu_image, 58);
							add_submenu_page($page_slug, $page_title, $page_title, $page_capability, $page_slug, $page_handler);
							$master_page_slug = $page_slug;

							$i++;
						}
						else {
							add_submenu_page($master_page_slug, $page_title, $page_title, $page_capability, $page_slug, $page_handler);
						}
					}
					else {
						add_theme_page($page_title, $page_title, $page_capability, $page_slug, $page_handler);
					}
				}
			}
		}

		/**
		 * Save the theme administration pages.
		 *
		 * @return void
		 */
		public function savePages()
		{
			if( $_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_GET['page']) ) {
				return;
			}

			$page = $this->getPage($_GET['page']);

			if( $page ) {
				$page->save();
				$this->redirectToThemePage($_GET['page']);
			}
		}

		/**
		 * Set the theme installation details.
		 *
		 * @param array $details The installation details.
		 * @param boolean $safe True not to override data already present.
		 * @return void
		 */
		public function setInstallationDetails( $details, $safe=false )
		{
			foreach( $details as $k => $v ) {
				if( $safe ) {
					if( !isset($this->_installationDetails[$k]) ) {
						$this->_installationDetails[$k] = $v;
					}
				}
				else {
					$this->_installationDetails[$k] = $v;
				}
			}

			update_option(THB_INSTALLATION_KEY, $this->_installationDetails);
		}

		/**
		 * Verify if other pages with the same slug are already defined.
		 *
		 * @param string $slug The page slug.
		 * @return boolean
		 */
		private function _verifyPageSlugUniqueness( $slug )
		{
			foreach( $this->getPages() as $page ) {
				if( $page->getSlug() == $slug ) {
					return false;
				}
			}

			return true;
		}

		/**
		 * Prepopulate the current installation with a dummy content, if provided.
		 *
		 * @return void
		 */
		private function prepopulateInstallation()
		{
			$dummy_setup = THB_THEME_CONFIG_DIR . '/dummy/thb-dummy.thb-backup';

			if( file_exists($dummy_setup) ) {
				$backup = @file_get_contents($dummy_setup);
				$data = unserialize( base64_decode( $backup ) );

				if( isset($data['options']) ) {
					thb_theme()->importOptions($data['options']);
				}

				if( isset($data['mods']) ) {
					$theme = get_option( 'stylesheet' );
					update_option( "theme_mods_$theme", $data['mods'] );
				}

				if( isset($data['duplicable']) ) {
					thb_duplicable_remove_all();

					foreach( $data['duplicable'] as $row ) {
						$row['meta'] = serialize($row['meta']);
						$row['value'] = serialize($row['value']);
						thb_duplicable_add($row);
					}
				}
			}
		}

		/**
		 * Run the admin interface.
		 *
		 * @return void
		 **/
		public function run()
		{
			add_action( 'admin_init', array($this, 'savePages') );
			add_action( 'admin_init', array($this, 'appendStyles') );
			add_action( 'admin_init', array($this, 'appendScripts') );
			add_action( 'admin_init', array($this, 'appendActions') );
			add_action( 'admin_head', array($this, 'appendCustomAdminCSS') );

			if( is_admin() && thb_is_super_user() ) {
				include THB_CORE_DIR . '/pages/class.backuppage.php';
				thb_backup_page();
			}

			add_action( 'admin_menu', array($this, 'registerPages') );

			// Theme installation procedure
			if( $this->hasJustBeenActivated() ) {
				$this->discardAllMessages();

				if( $this->firstTimeInstall() ) {
					$this->_installationDetails['installed'] = '1';
					update_option(THB_INSTALLATION_KEY, $this->_installationDetails);

					if( thb_system_is_development() ) {
						$this->prepopulateInstallation();
						$this->addMessage('welcome');
					}

					do_action('thb_theme_installation', $this);
				}
				else {
					if( thb_system_is_development() ) {
						$this->addMessage('activation');
					}

					do_action('thb_theme_activation', $this);
				}

				if( thb_system_is_development() ) {
					$this->redirectToThemePage();
				}

			}
		}

	}
}

/**
 * Discard an admin notification message.
 *
 * @return void
 */
if( !function_exists('thb_discard_message') ) {
	function thb_discard_message() {
		$key = $_POST['key'];

		$thb_theme = thb_theme();
		$thb_theme->getAdmin()->discardMessage($key);

		die($key);
	}
}