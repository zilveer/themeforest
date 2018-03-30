<?php

class PeThemeView {

	protected $conf;
		
	public function __construct() {
	}

	public function name() {
		return "";
	}

	public function type() {
		return __("Default",'Pixelentity Theme/Plugin');
	}

	public function supports($type) {
		return false;
	}

	public function capability($cap) {
		return false;
	}

	public function mbox() {
		return 
			array(
				  "title" => $this->name(),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						)
				  );
	}

	public function defaults() {
	}

	public function registerAssets() {
	}

	public function output($conf) {
		$this->conf = $conf;
		$this->defaults();
		return "";
	}

	public function template() {
	}

}

?>
