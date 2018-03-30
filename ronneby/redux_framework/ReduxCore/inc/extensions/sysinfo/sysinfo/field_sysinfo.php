<?php

/**
 * @package     ReduxFramework
 * @author      Vladyslav Tkachenko
 * @version     1.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_sysinfo')) {

	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_sysinfo extends ReduxFramework {

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct($field = array (), $value = '', $parent) {

			$this->parent = $parent;
			$this->field = $field;
			$this->value = $value;
			$this->extension_obj = ReduxFramework_extension_sysinfo::getInstance();


			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}

			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults = array (
					'options' => array (""),
					'stylesheet' => 'fff',
					'output' => true,
					'enqueue' => true,
					'enqueue_frontend' => true
			);
			$this->field = wp_parse_args($this->field, $defaults);
		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {
//			echo $this->extension_dir;
//			echo ReduxFramework_extension_sysinfo::getInstance()->components_dir;
//			require_once ReduxFramework_extension_sysinfo::getInstance()->components_dir."test.php";
			require_once $this->extension_obj->view_dir . "index.php";
//			echo "hello";
		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {
			wp_enqueue_style(
					  'sysinfo-css', $this->extension_url . 'sysinfo.css', array (), time(), 'all'
			);

			wp_enqueue_script(
					  'sysinfo-js', $this->extension_url . 'sysinfo.js', array ('jquery', 'redux-js'), time(), true
			);
		}

		/**
		 * Output Function.
		 *
		 * Used to enqueue to the front-end
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function output() {

			if ($this->field['enqueue_frontend']) {
				
			}
		}

	}

}
