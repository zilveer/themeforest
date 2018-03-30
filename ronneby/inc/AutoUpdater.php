<?php

class AutoUpdater {

	protected $dir;
	protected $version;
	protected $file_version_exist = false;

	function __construct() {
		add_action('admin_footer', array ($this, "init"));
		add_action('wp_footer', array ($this, "init"));
	}

	public function init() {

		if(function_exists('wp_get_upload_dir')) {
			$dir = wp_get_upload_dir();
		} else {
			$dir = wp_upload_dir();
		}
		$this->dir = $dir["basedir"];
		if (is_file($this->dir . '/version.txt')) {
			$this->file_version_exist = true;
		}
		$this->generateVersion();
		
		$version = $this->getVersion();
		$local_version = $this->getContentFromFile();
		if (!$this->file_version_exist || !$this->version_comparee($version, $local_version)) {
			$this->writeToFile($version);
			$less = new CompileLess();
			$less->setAutoGenerateVariables();
			$less->setSimpleCompileStrategy();
			$less->runBackEndCompile();
		}
	}

	public function getTheme() {
		
	}

	public function version_comparee($version1, $version2) {
		if (version_compare($version1, $version2) == 0) {
			return true;
		}
		return false;
	}

	public function getVersion() {
		return $this->version;
	}

	public function generateVersion() {
		$ver = wp_get_theme();
		if (is_child_theme()) {
			$version = $ver->parent()->get("Version");
		} else {
			$version = $ver->get('Version');
		}

		$this->version = $version;
	}

	public function writeToFile($message) {

		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}
//		$wp_filesystem->put_contents(
//				   $this->dir . '/version.txt', $message, FS_CHMOD_FILE
//		);
		if ( !empty($wp_filesystem) ) {
			$wp_filesystem->put_contents( $this->dir . '/version.txt', $message, FS_CHMOD_FILE);
			//file_put_contents( $this->dir . '/version.txt', $message, FS_CHMOD_FILE );
		}
	}

	public function getLocalVersion() {
		$this->getContentFromFile();
	}

	public function getContentFromFile() {
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}
		if ($this->file_version_exist) {
			$version = $wp_filesystem->get_contents($this->dir . '/version.txt');
			return $version;
		}
		return "";
	}
}

new AutoUpdater();