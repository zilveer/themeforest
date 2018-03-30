<?php

/**
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_extension_sysinfo')) {


	/**
	 * Main ReduxFramework custom_field extension class
	 *
	 * @since       3.1.6
	 */
	class ReduxFramework_extension_sysinfo /*extends ReduxFramework*/ {

		// Protected vars
		protected $parent;
		public $extension_url;
		public $extension_dir;
		public $components_dir;
		public $view_dir;
		/* @var $theInstance ReduxFramework_extension_custom_font */
		public static $theInstance;

		/**
		 * Array of values
		 * @var array 
		 */
		public $errors = array ();

		/**
		 * Class Constructor. Defines the args for the extions class
		 *
		 * @since       1.0.0
		 * @access      public
		 * @param       array $sections Panel sections.
		 * @param       array $args Class constructor arguments.
		 * @param       array $extra_tabs Extra panel tabs.
		 * @return      void
		 */
		public function __construct($parent) {

			$this->parent = $parent;
			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}
			$this->field_name = 'sysinfo';

			self::$theInstance = $this;

			$this->includeClases();

			add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array (&$this, 'overload_field_path')); // Adds the local field
			add_action('wp_ajax_dfd_checksystem', array ($this, "checksystem"));
		}

		public function checksystem() {
			SystemCheck_router::instance()->init();
			$result = SystemCheck_Controller::instance()->getResult();
			$result = json_encode($result);
			echo $result;
			wp_die();
		}

		public function getParent() {
			return $this->parent;
		}

		/**
		 * 
		 * @return self
		 */
		public static function getInstance() {
			return self::$theInstance;
		}

		private function includeClases() {
			$this->components_dir = $this->extension_dir . "/components/";
			$this->view_dir = $this->extension_dir . "/view/";
			$this->assets_dir = $this->extension_url . "/assets/";
			require_once $this->components_dir . "router" . ".php";
			require_once $this->components_dir . "controller" . ".php";
			require_once $this->components_dir . "helper" . ".php";
		}

		// Forces the use of the embeded field path vs what the core typically would use    
		public function overload_field_path($field) {
			return dirname(__FILE__) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
		}

	}

	// class
} // if
