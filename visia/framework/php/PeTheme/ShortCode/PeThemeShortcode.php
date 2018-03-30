<?php

class PeThemeShortcode {

	public $master;
	public $group;
	public $name = "";
	public $trigger = "";
	public $description = "";
	public $fields;

	public function __construct(&$master) {
		$this->master =& $master;
		$this->group = __("DEFAULT",'Pixelentity Theme/Plugin');
	}

	public function registerAssets() {
	}


	public function render() {
		if (isset($this->fields)) {
			foreach ($this->fields as $name => $data) {
				$class = "PeThemeFormElement".$data["type"];
				$field = new $class($this->trigger,$name,$data);
				$field->render();			
			}
		}
	}

	public static function parseContent($content) {

		return trim(do_shortcode($content));
	}


	public function output($atts,$content=null,$code="") {
		return "";
	}

}

?>