<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class SystemCheck_router {

	/**
	 *
	 * @var SystemCheck_router $_instance 
	 */
	private static $_instance = null;
	private $tests = array ();

	/**
	 *
	 * @var SystemCheck_Controller 
	 */
	private $controller;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		$this->controller = SystemCheck_Controller::instance();
		$this->tests = array (
				array ("separator" => "General"),
				"web_server",
				"php_interface",
				"php_version",
				"max_execution_time",
				"max_input_vars",
				"max_input_time",
				"post_max_size",
				"upload_max_filesize",
				"allow_url_fopen",
//				"time_test",
//				"cpu_test",
				"short_open_tag",
				"memory_limit",
//				"test_memory_limit",
				"mail",
				"safe_mode",
				"mcrypt",
				"hash",
				"socket",
				"session_data",
				"test_accelerator",
				array ("separator" => "File system"),
				"free_space",
				///////
				"permToCss",
				"permToUploads",
				"permToMainDir",
				"permToGeneratedLess",
				///////
//				"dirinfo",
//				"folder_create",
//				"file_create",
//				"filesystem_benchmark",
				"file_upload_value",
				array ("separator" => "PHP extensions"),
				"regex_func",
				"perl_regx",
				"zlib",
				"gd_lib",
				"free_type",
				"ssl",
				"mbstring",
//				array ("separator" => "MySQL configuration"),
//				"mysql_test",
				array ("separator" => "Additional Information"),
				"unmask",
				"register_globals",
				"display_errors",
				array ("separator" => "WordPress configuration"),
				"worpress_version",
				"active_theme",
				array ("separator" => "Active plugins"),
				"active_plugins",
		);
	}

	public function init() {
		if (isset($_GET['sys_action']) && !empty($_GET['sys_action'])) {
			$method = esc_attr($_GET['sys_action']);
			if (method_exists($this->controller, $method)) {
				$this->controller->$method();
			}
			return false;
		}
		if (!empty($this->tests)) {
			foreach ($this->tests as $test) {
				$this->runTest($test);
			}
		}
	}

	public function runTest($test_name) {

		if (is_array($test_name)) {
			$key = key($test_name);
			if (method_exists($this->controller, $key)) {
				$this->controller->$key($test_name[$key]);
			}
		} else {
			if (method_exists($this->controller, $test_name)) {
				$this->controller->$test_name();
			}
		}
	}

}
