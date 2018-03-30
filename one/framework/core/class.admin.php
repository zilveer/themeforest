<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Admin class.
 *
 * This class is entitled to manage the theme administration instance.
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
if( !class_exists('THB_Admin') ) {
	class THB_Admin {

		/**
		 * The admin actions.
		 *
		 * @var array
		 **/
		private $_actions = array();

		/**
		 * The admin modals.
		 *
		 * @var array
		 **/
		private $_modals = array();

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
			/**
			 * Tweaks to the administration UI.
			 */
			$this->_tweaks = new THB_AdminTweaks();

			/**
			 * Pages.
			 */
			$this->addPage( new THB_AdminPage( __('Theme options', 'thb_text_domain'), 'thb-theme-options' ) );

			if ( thb_system_is_development() ) {
				$this->addPage( new THB_AdminPage( __('Theme appearance', 'thb_text_domain'), 'thb-theme-appearance' ) );

				$changelog_page = new THB_AdminPage( __('Changelog', 'thb_text_domain'), 'thb-changelog' );
				$changelog_page->setContent( THB_TEMPLATES_DIR .'/admin/pages/changelog', array(
					'changelog' => $this->getChangelog()
				) );
				$this->addPage($changelog_page);

				$welcome_page = new THB_AdminPage( __('Welcome', 'thb_text_domain'), 'thb-welcome' );
				$welcome_page->setContent( THB_TEMPLATE_DIR .'/config/welcome_page' );
				$this->addPage($welcome_page);

				$faq_page = new THB_AdminPage( __('Theme help', 'thb_text_domain'), 'thb-help' );
				$faq_page->setContent( THB_TEMPLATES_DIR .'/admin/pages/faq' );
				$this->addPage($faq_page);
			}

			/**
			 * Internal image sizes.
			 */
			add_image_size( 'upload_field', null, 150, true );
			add_image_size( 'upload_field_slide', 150, 150, true );

			/**
			 * Admin scripts.
			 */
			if ( ! defined( 'THB_COMPILER' ) || THB_COMPILER == true ) {
				add_filter( 'thb_admin_scripts', array( $this, 'addScripts' ) );
			}

			if ( defined( 'THB_MINIFY_ADMIN_SCRIPTS' ) && THB_MINIFY_ADMIN_SCRIPTS === false ) {
				$admin_script = 'admin.compact.js';
			}
			else {
				$admin_script = 'admin.compact.min.js';
			}

			$this->addScript( THB_ADMIN_JS_URL . '/' . $admin_script, array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable', 'media-upload', 'backbone' ) );

			/**
			 * Admin styles.
			 */
			$this->addStyle( THB_ADMIN_CSS_URL . '/admin.css' );

			/**
			 * Admin AJAX actions.
			 */
			$this->addAction( 'wp_ajax_thb_save_tab', 'thb_save_tab' );
			$this->addAction( 'wp_ajax_thb_modal_content', 'thb_modal_content' );
			$this->addAction( 'wp_ajax_thb_image_upload_get_size', 'thb_image_upload_get_size' );
			$this->addAction( 'wp_ajax_thb_images_upload_get_sizes', 'thb_images_upload_get_sizes' );
			$this->addAction( 'wp_ajax_thb_system_discard_message', 'thb_system_discard_message' );

			/**
			 * Custom fields templates.
			 */
			$this->addAction( 'in_admin_header', array( $this, 'customTemplates' ) );

			/**
			 * Custom metabox locations.
			 */
			$this->addAction( 'edit_form_after_title', array( $this, 'afterTitleMetaboxes' ) );
		}

		/**
		 * Check if the theme is being installed for the first time.
		 *
		 * @return boolean
		 */
		public function isBeingInstalled()
		{
			return get_option( THB_INSTALLATION_KEY ) === false;
		}

		/**
		 * Check if the theme has just been activated.
		 *
		 * @return boolean
		 */
		public function isBeingActivated()
		{
			global $pagenow;

			if ( is_admin() && thb_input_get( 'activated' ) && $pagenow === 'themes.php' ) {
				return true;
			}

			return false;
		}

		/**
		 * Get the theme installation details.
		 *
		 * @return array
		 */
		public function getThemeDetails()
		{
			$data = wp_parse_args( get_option( THB_INSTALLATION_KEY ), array(
				'framework_version' => '1'
			) );

			return $data;
		}

		/**
		 * Check if the framework has just been updated.
		 *
		 * @return boolean
		 */
		public function isFrameworkBeingUpdated()
		{
			$data = $this->getThemeDetails();

			$framework_updated = version_compare( $data['framework_version'] , THB_FRAMEWORK_VERSION, '<' );

			return $framework_updated;
		}

		/**
		 * Check if the theme has just been updated.
		 *
		 * @return boolean
		 */
		public function isBeingUpdated()
		{
			$data = $this->getThemeDetails();

			$theme_updated = version_compare( $data['version'] , THB_MASTER_THEME_VERSION, '<' );

			return $theme_updated;
		}

		/**
		 * Get the theme changelog.
		 *
		 * @return string
		 */
		public function getChangelog()
		{
			$this->checkForUpdates();

			$transient_key = 'thb-update-check-' . THB_THEME_KEY;
			$transient = thb_cache_get( $transient_key );
			$decoded_transient = json_decode( $transient );

			if ( $transient === false || isset( $decoded_transient->error ) ) {
				return '';
			}

			return $transient;
		}

		/**
		 * Check for updates availability.
		 *
		 * @return boolean
		 */
		public function checkForUpdates()
		{
			if ( defined('THB_DISABLE_VERSION_CHECK') && THB_DISABLE_VERSION_CHECK === true ) {
				return '';
			}

			if ( ! is_admin() ) {
				return;
			}

			if ( ! thb_system_is_development() ) {
				return;
			}

			$transient_key = 'thb-update-check-' . THB_THEME_KEY;
			$cached_changelog = thb_cache_get( $transient_key );

			if( $cached_changelog === false || isset( json_decode( $cached_changelog )->error ) ) {
				$response = wp_remote_get( 'http://thbthemes.com/update-checker/?product=' . THB_THEME_KEY );

				if ( wp_remote_retrieve_response_code( $response ) == '200' ) {
					$body = wp_remote_retrieve_body( $response );
					thb_cache_set( $transient_key, $body, 86400 ); // Check once a day
				}
				else {
					return false;
				}
			}
			else {
				$body = $cached_changelog;
			}

			$info = json_decode( $body );

			if ( isset($info->error) ) {
				return false;
			}

			$latest_version = key( $info->changelog );

			return version_compare( $latest_version , THB_MASTER_THEME_VERSION, '>' );
		}

		/**
		 * Imports the custom templates for dynamic components in admin pages.
		 */
		public function customTemplates()
		{
			$partial = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/partials/select' );
			$partial->render();

			$partial = new THB_Template( THB_TEMPLATES_DIR . '/admin/modal' );
			$partial->render();
		}

		/**
		 * Add a new location for metaboxes after the entry title.
		 */
		public function afterTitleMetaboxes()
		{
			global $post;

			do_meta_boxes( null, 'thb_after_title', $post );
		}

		/**
		 * Add a modal view to the admin interface.
		 *
		 * @param THB_Modal $modal
		 * @return THB_Modal
		 */
		public function addModal( $modal )
		{
			$search_modal = $this->getModal( $modal->getSlug() );

			if ( $search_modal === false ) {
				$this->_modals[] = $modal;
			}
			else {
				$modal = $search_modal;
			}

			return $modal;
		}

		/**
		 * Get the modal views of the admin interface.
		 *
		 * @return array
		 */
		public function getModals()
		{
			return $this->_modals;
		}

		/**
		 * Get a modal view of the admin interface.
		 *
		 * @param string $slug The modal slug.
		 * @return THB_Modal
		 */
		public function getModal( $slug )
		{
			foreach( $this->getModals() as $modal ) {
				if( $modal->getSlug() == $slug ) {
					return $modal;
				}
			}

			return false;
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
		 * Add admin scripts to be compressed.
		 *
		 * @param array $scripts
		 */
		public function addScripts( $scripts )
		{
			$scripts[] = THB_FRONTEND_JS_PATH . '/thb.toolkit.js';
			$scripts[] = THB_FRONTEND_JS_URL . '/jquery.easing.1.3.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/jquery.scrollTo-min.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/selectize.min.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/codemirror.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/css.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/javascript.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/jquery.stepper.min.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/jquery.customSelect.min.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/jquery.fonticonpicker.min.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/jquery.minicolors.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/admin-libs.js';
			$scripts[] = THB_ADMIN_JS_PATH . '/admin.js';

			return $scripts;
		}

		/**
		 * Add a script to the admin interface.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
		 * @param string $path The admin script path.
		 * @param string $dependencies The admin script dependencies.
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
		 * @param array $dependencies The admin stylesheet dependencies.
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
		 **/
		public function appendActions()
		{
			foreach( $this->_actions as $name => $callback ) {
				add_action($name, $callback);
			}
		}

		/**
		 * Append the scripts to the admin interface.
		 **/
		public function appendScripts()
		{
			global $pagenow;

			$can_add_script = in_array( $pagenow, array(
				'post.php',
				'post-new.php',
				// 'edit.php',
				'themes.php',
				'admin.php'
			) );

			if ( in_array( $pagenow, array( 'themes.php', 'admin.php' ) ) && isset( $_GET['page'] ) && ! thb_text_startsWith( $_GET['page'], 'thb-' ) ) {
				$can_add_script = false;
			}

			if ( ! $can_add_script ) {
				return;
			}

			$taxonomies = array();
			foreach ( thb_theme()->getPublicPostTypes() as $post_type ) {
				$ts = thb_get_post_type_taxonomies( $post_type->getType() );

				foreach ( $ts as $t ) {
					$taxonomies[$t->name] = array(
						'slug'     => $t->name,
						'singular' => $t->labels->singular_name,
						'plural'   => $t->labels->name
					);
				}
			}

			global $wp_version;

			wp_localize_script( 'jquery', 'thb', array(
				'strings'    => thb_admin_inline_strings(),
				'taxonomies' => $taxonomies,
				'icons'      => thb_load_icons(),
				'wp_version' => $wp_version
			) );

			$edit_page = $pagenow == 'post.php' || $pagenow == 'post-new.php';
			$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_GET['post']) ? get_post_type($_GET['post']) : 'post');
			$post_type_support = post_type_supports($post_type, 'editor') || post_type_supports($post_type, 'thumbnail');

			if ( function_exists('wp_enqueue_media') ) {
				if( !$edit_page || !$post_type_support ) {
					wp_enqueue_media();
				}
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
		 */
		public function appendCustomAdminCSS()
		{
			$icon_css = apply_filters( 'thb_icon_css_url', THB_SHARED_ASSETS_URL . '/fontello/css/fontello.css' );
			printf( '<link type="text/css" rel="stylesheet" href="%s">', $icon_css );

			echo '<style type="text/css">' . thb_get_option('admin_css') . '</style>';
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
		 * Get the theme administration interface language.
		 *
		 * @return string
		 */
		public function getLanguage()
		{
			return $this->_language;
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
		 * Get the theme appearance page admin URL.
		 *
		 * @return string
		 */
		public function getAppearancePageUrl()
		{
			$slug = $this->getAppearancePage()->getSlug();

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
		 * Get the theme appearance page.
		 *
		 * @return mixed
		 */
		public function getAppearancePage()
		{
			return $this->getPage('thb-theme-appearance');
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
		 */
		public function redirectToThemePage( $slug = null )
		{
			if ( thb_text_contains( $slug, '#' ) ) {
				list( $slug, $target ) = explode( '#', $slug );
			}

			if( ! $slug ) {
				$pages = $this->getPages();

				if( empty($pages) ) {
					return;
				}

				$page = $pages[0];
				$slug = $page->getSlug();
			}
			elseif ( $this->getPage( $slug ) === false ) {
				return;
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

			remove_submenu_page( 'themes.php', 'thb-changelog' );
			remove_submenu_page( 'themes.php', 'thb-welcome' );
			// remove_submenu_page( 'themes.php', 'thb-help' );
		}

		/**
		 * Save the theme administration pages.
		 *
		 * @return void
		 */
		public function savePages()
		{
			$page_slug = thb_input_get( 'page' );

			if( $_SERVER['REQUEST_METHOD'] !== 'POST' || $page_slug === false ) {
				return;
			}

			$page = $this->getPage( $page_slug );

			if( $page ) {
				$page->save();
				$this->redirectToThemePage( $page_slug );
			}
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
		 */
		private function dummyContent()
		{
			$dummy_setup = THB_THEME_CONFIG_DIR . '/dummy/thb-dummy.thb-backup';

			if( file_exists( $dummy_setup ) ) {
				$backup = @file_get_contents( $dummy_setup );

				if ( ! empty( $backup ) ) {
					$data = unserialize( base64_decode( $backup ) );

					if ( ! empty( $data ) ) {
						thb_import_array( $data );
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
			add_action( 'admin_enqueue_scripts', array($this, 'appendScripts') );
			add_action( 'admin_init', array($this, 'appendActions') );
			add_action( 'admin_head', array($this, 'appendCustomAdminCSS') );
			add_action( 'login_head', array($this, 'appendCustomAdminCSS') );
			add_action( 'admin_menu', array( $this, 'registerPages' ) );

			if( is_admin() && thb_is_super_user() ) {
				require_once THB_CORE_DIR . '/pages/class.frameworksettings.php';
				add_action( 'init', 'thb_frameworksettings_page' );
			}

			$data = array(
				'version'           => THB_MASTER_THEME_VERSION,
				'framework_version' => THB_FRAMEWORK_VERSION
			);

			if ( $this->isBeingInstalled() ) {
				update_option( THB_INSTALLATION_KEY, $data );
				$this->dummyContent();
				do_action( 'thb_theme_installation' );

				$this->redirectToThemePage('thb-welcome');
			}
			else {
				if( $this->isBeingUpdated() ) {
					do_action( 'thb_framework_update' );
					do_action( 'thb_theme_update' );
					update_option( THB_INSTALLATION_KEY, $data );

					$this->redirectToThemePage('thb-changelog');
				}
				elseif( $this->isFrameworkBeingUpdated() ) {
					do_action( 'thb_framework_update' );
					update_option( THB_INSTALLATION_KEY, $data );
				}
				elseif( $this->isBeingActivated() ) {
					do_action( 'thb_theme_activation' );

					$this->redirectToThemePage('thb-welcome');
				}
			}
		}

	}
}