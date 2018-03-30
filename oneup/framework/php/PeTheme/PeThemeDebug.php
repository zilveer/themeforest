<?php

class PeThemeDebug {

	protected $master;
	protected $errors;
	protected $group;
	protected $inited = false;

	public function __construct(&$master) {
		$this->master =& $master;
		$this->group = $_SERVER["REQUEST_URI"] . " - " . gmdate("H:i:s d M");
	}

	public function init() {
		if ($this->inited) return;
		$this->inited = true;
		set_error_handler(array(&$this,"error_handler"), E_ALL);
		$saved = get_transient("_pe_theme_debug_errors");
		$this->errors = empty($saved["errors"]) ? array() : $saved["errors"];
		add_action("shutdown",array(&$this, 'shutdown'));
		if (current_user_can('manage_options')) {
			add_action('wp_ajax_pe_theme_debug', array(&$this, 'ajax'));
			add_action("admin_enqueue_scripts",array(&$this,"enqueue"));
			add_action("wp_enqueue_scripts",array(&$this,"enqueue"));
		} 
	}

	public function enqueue() {
		PeThemeAsset::addAsset("script","framework/js/admin/jquery.theme.debug.js",array('jquery','pe_theme_utils'),"pe_theme_debug",true);
		wp_localize_script("pe_theme_debug", 'peThemeDebug',array("url"=>admin_url("admin-ajax.php")));
		wp_enqueue_script("pe_theme_debug");
	}

	public function ajax() {
		header("Content-Type: application/json");
		if (!empty($_POST["delete"])) {
			delete_transient("_pe_theme_debug_errors");
		}
		echo json_encode(get_transient('_pe_theme_debug_errors'));
		$this->errors = false;
		die();
	}

	public function shutdown() {
		if (!empty($this->errors)) {
			$now = microtime(true);
			set_transient("_pe_theme_debug_errors", array("last"=>$now,"errors"=>$this->errors),0);
		}
	}

	public function error_handler($errno, $errstr, $errfile, $errline) {
		if (!isset($this->errors)) {
			$this->errors = array();
		}
		$base = dirname(PE_FRAMEWORK)."/";

		$this->errors[] = 
			array(
				  "time" => time(),
				  "group" => $this->group,
				  "error" => array($errno, json_encode($errstr), str_replace($base,"",$errfile), $errline),
				  );
	}

	public function log($msg) {
		if (!$this->inited) $this->init();

		$msg = func_num_args() > 1 ? func_get_args() : $msg;
		$base = dirname(PE_FRAMEWORK)."/";
		$debug = debug_backtrace(0,2);

		$this->errors[] = 
			array(
				  "time" => time(),
				  "group" => $this->group,
				  "error" => 
				  array(
						E_USER_NOTICE,
						json_encode($msg),
						str_replace($base,"",$debug[0]["file"]),
						$debug[0]["line"],
						$debug[1]["function"]
						)
				  );
	}

}

if (!function_exists("pe_debug")) {
	function pe_debug($msg) {
		if (function_exists("peTheme")) {
			return peTheme()->debug->log($msg);
		}
	}
}

?>
