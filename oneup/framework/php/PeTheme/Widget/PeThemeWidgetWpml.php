<?php

class PeThemeWidgetWpml extends PeThemeWidget {

	public $is_wpml_conditional = true;

	public function __construct() {
		$this->name = __("WPML - Conditional",'Pixelentity Theme/Plugin');
		$this->description = __("Show/Hide widgets according to language",'Pixelentity Theme/Plugin');

		$this->fields = array(
							  "lang" => 
							  array(
									"label"=>__("Language",'Pixelentity Theme/Plugin'),
									"description" => __("Only show subsequent widgets when language match the above selection.",'Pixelentity Theme/Plugin'),
									"type"=>"RadioUI",
									"options" => peTheme()->wpml->options(),
									"default"=>""
									)
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		$html = "";
		return $html;
	}


}
?>
