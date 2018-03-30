<?php

class AjaxCompileLess extends CompileLess {

	private $dir;

//
	function __construct($dir) {
		if (!$this->validSession()) {
			die("Not valid cookie value to compile");
		}
		$this->dir = $dir;
		$this->proccessAjax();
	}

	protected function prepareArrayFiles() {
		if (!isset($_POST["less_files"]) && empty($_POST["less_files"])) {
			echo("No files to compile");
		}
		$less_files = $_POST["less_files"];
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

//
	protected function registerClass() {
		if (!class_exists('lessc')) {
			require_once( $this->dir . '/inc/lessc.inc.php' );
		}
	}

	protected function validSession() {
		if (!isset($_COOKIE["compile_less_id"]) || !isset($_SESSION["compile_less_id"])) {
			return false;
		}
		if ($_COOKIE["compile_less_id"] != $_SESSION["compile_less_id"]) {
			return false;
		}
		return true;
	}

	protected function removeStyleFiles($less_files) {
		if (empty($less_files))
			return false;
//		$dir = get_template_directory()."/assets/css/";
		foreach ($less_files as $key => $value) {
			$file = isset($value["out"]) ? $value["out"] : false;
			if (is_file($file)) {
				$file = basename($file);
				$file = $this->dir . "/assets/css/" . $file;
				if (is_file($file)) {
					if (!@unlink($file)) {
						die("Error in remove file $file: File not found");
					}
				}
			}
		}
	}

}
