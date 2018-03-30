<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://thecodemafia.org
 * @since      1.0.0
 *
 * @package    Tcm_Theme_Lock
 * @subpackage Tcm_Theme_Lock/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tcm_Theme_Lock
 * @subpackage Tcm_Theme_Lock/includes
 * @author     The Code Mafia <contact@thecodemafia.org>
 */
class Tcm_Theme_Lock {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tcm_Theme_Lock_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $tcm_theme_lock    The string used to uniquely identify this plugin.
	 */
	protected $tcm_theme_lock;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->tcm_theme_lock = 'tcm-theme-lock';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tcm_Theme_Lock_Loader. Orchestrates the hooks of the plugin.
	 * - Tcm_Theme_Lock_i18n. Defines internationalization functionality.
	 * - Tcm_Theme_Lock_Admin. Defines all hooks for the dashboard.
	 * - Tcm_Theme_Lock_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class is responsible for the Mailchimp API integration.
		 */
		require_once THEMEDIR . '/admin/tcm-theme-lock/includes/class-mailchimp-api.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once THEMEDIR . '/admin/tcm-theme-lock/includes/class-tcm-theme-lock-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once THEMEDIR . '/admin/tcm-theme-lock/admin/class-tcm-theme-lock-admin.php';

		$this->loader = new Tcm_Theme_Lock_Loader();

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tcm_Theme_Lock_Admin( $this->get_tcm_theme_lock(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'lock_admin' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menu' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_tcm_theme_lock() {
		return $this->tcm_theme_lock;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tcm_Theme_Lock_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
