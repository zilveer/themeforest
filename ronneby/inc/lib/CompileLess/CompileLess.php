<?php

class CompileLess {

	/**
	 * 	Values Simple|All
	 * @var type 
	 */
	function __construct() {

		add_action('init', array ($this, "init"));
	}

	public function enqueueScript() {

		wp_register_script('compilestyle', get_template_directory_uri() . '/assets/js/compileApp/CompileApp.js', array ("jquery", "thickbox", "underscore"));
		$debug = defined("WP_DEBUG") ? WP_DEBUG : false;

		$_compilestyle = array (
				"url" => get_template_directory_uri() . "/ajax_compile.php",
				"less_files" => get_dfd_less_files(),
				"debug" => $debug
		);
		wp_localize_script('compilestyle', '_compilestyle', $_compilestyle);
		wp_enqueue_script("compilestyle");
		wp_enqueue_style('thickbox', false);
	}

	public function init() {

		if (!is_super_admin()) {
			return false;
		}
		$this->enqueueScript();

		$this->setSession();

		$id = hash("md5", "lesscompile");
		setcookie("compile_less_id", $id, time() + 60 * 60 * 24 * 1, "/");
		$_SESSION["compile_less_id"] = $id;

		$this->registerClass();

		$this->proccessAjax();
	}

	protected function proccessAjax() {

		if (!isset($_SERVER['REQUEST_METHOD'])) {
			return;
		}
		if (isset($_POST['_dfd_compile_yes'])) {

			$this->setSession();

			if (isset($_POST["strategy"]) && $_POST["strategy"] == "simple") {
				$this->setSimpleCompileStrategy();
			} else {
				$this->setAllCompileStrategy();
			}
			$result = $this->procces();
			$result = json_encode($result);
			@header('Content-Type: application/json;');
			echo $result;
//			wp_die();
			exit();
		}
	}

	protected function setSession() {
		if (session_id() == "" || !session_id()) {
			@session_start();
		}
	}

	protected function canCompile($l_files) {
		if (!is_file($l_files['out']) || (!empty($l_files['redux_recompile']) && $l_files['redux_recompile'] == true)) {
			return true;
		}
		return false;
	}

	protected function procces() {
		$this->setSession();
//		die(print_r($this->getStrategy()));
		$startMemory = 0;
		$startMemory = memory_get_usage();

		$name = isset($_POST['name']) ? ($_POST['name']) : "";
		$number = isset($_POST['number']) ? (int) ($_POST['number']) : "";
		$less_files = $this->prepareArrayFiles();
		if (!$name) {
			$this->removeStyleFiles($less_files);
			return array (
					"files" => array_keys($less_files),
					"strategy" => $this->getStrategy()
			);
		}
//		if (isset($_POST["strategy"]) && $_POST["strategy"] == "simple") {
//			$this->setSimpleCompileStrategy();
//		} else {
//			$this->setAllCompileStrategy();
//		}
		$in_array = false;
		if (array_key_exists($name, $less_files) && isset($less_files[$name])) {
			$in_array = $less_files[$name];
			if ($this->canCompile($less_files[$name])) {
				$file = $less_files[$name];
				$this->_compile_less($file['src'], $file['out']);
			}
		}
		$startMemory = round(( (memory_get_usage() - $startMemory) / 1024 / 1024), 2) . ' MB' . PHP_EOL;
//		$debug = defined("WP_DEBUG") ? WP_DEBUG : false;
		return array (
				"show" => false,
				"number" => $number,
				"name" => $name,
				"in_array" => $in_array,
				"memory_usage" => $startMemory,
				"memory_get_peak_usage" => round(( ( memory_get_peak_usage()) / 1024 / 1024), 2)
		);
	}

	protected function prepareArrayFiles() {
		$less_files = get_dfd_less_files();
		if ($this->getStrategy() == "simple") {
			foreach ($less_files as $key => $value) {
				if (!isset($value["redux_recompile"])) {
					if (is_file($value["out"])) {
						unset($less_files[$key]);
					}
				}
			}
		}
		return $less_files;
	}

	protected function removeStyleFiles($less_files) {
		if (empty($less_files))
			return false;
//		$dir = get_template_directory()."/assets/css/";
		foreach ($less_files as $key => $value) {
			$file = isset($value["out"]) ? $value["out"] : false;
			if (is_file($file)) {
				@unlink($file);
			}
		}
	}

	public function setAutoGenerateVariables() {
		//WP_Filesystem();
		global $wp_filesystem, $dfd_ronneby;
		
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}

		/** Capture variables.less output * */
		ob_start();
		require locate_template('/redux_framework/variables_less.php');
		$variables_less = ob_get_clean();
		
		$variables_less_uploads_file = locate_template('assets/less.lib/_generated/variables.less');

		if (!empty($wp_filesystem)) {
			$wp_filesystem->put_contents($variables_less_uploads_file, $variables_less, 0644);
		} else {
			file_put_contents($variables_less_uploads_file, $variables_less);
		}
	}

	/**
	 * Run compile proceess only on clien side.
	 */
	public function run() {
		$memory = @ini_get('memory_limit');
		if((int)$memory > 128){
			$this->runBackEndCompile();
			return true;
		}
		?><script>
					var options = {"strategy": "<?php echo $this->getStrategy(); ?>"};
					jQuery(document).ready(function(){
						dfdCompileLess.run(options);
					});
		</script>
		<?php
	}

	protected function _compile_less($inputFile, $outputFile) {
		$options = array (
				"append" => true
		);
		$less = new lessc();
		try {
			$less->setFormatter('compressed'); //classic
			$less->compileFile($inputFile, $outputFile, $options);
			unset($less);
		} catch (Exception $ex) {
			die('Less compile error: ' . $ex->getMessage());
		}
	}

	public function runBackEndCompile() {
		$this->registerClass();

		$less_files = $this->prepareArrayFiles();
//		$this->removeStyleFiles($less_files);
		$count = "";
		foreach ($less_files as $value) {
			if ($this->canCompile($value) || isset($count[$value["out"]])) {
				if (!isset($count[$value["out"]])) {
					if (is_file($value['out'])) {
						@unlink($value['out']);
					}
				}
				$count[$value["out"]] = 1;
//				}
//				$value['out']["cfd"] = 1;
				$this->_compile_less($value['src'], $value['out']);
			}
		}
	}

	protected function registerClass() {
		if (!class_exists('lessc')) {
			require_once( get_template_directory() . '/inc/lessc.inc.php' );
		}
	}

	public function setSimpleCompileStrategy() {
		$_SESSION["_compile_strategy"] = "simple";
	}

	public function setAllCompileStrategy() {
		$_SESSION["_compile_strategy"] = "all";
	}

	public function getStrategy() {
		return isset($_SESSION["_compile_strategy"]) ? $_SESSION["_compile_strategy"] : "all";
	}

}
