<?php

class PeThemeWidgetHtml extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Html",'Pixelentity Theme/Plugin');
		$this->description = __("HTML Block",'Pixelentity Theme/Plugin');

		$this->fields = array(
							  "content" => 
							  array(
									"label"=>__("HTML",'Pixelentity Theme/Plugin'),
									"type"=>"Editor",
									"default"=>""
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		return $instance["content"];
	}


}
?>
