<?php

class PeThemeShortcodeVisiaButton extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "button";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Button",'Pixelentity Theme/Plugin');
		$this->description = __("Add a button",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "url" =>
							  array(
									"label" => __("Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the button",'Pixelentity Theme/Plugin'),
									),
							  "text" =>
							  array(
									"label" => __("Text",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the button text here",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if (!isset($url)) $url = "#";
		$html = <<< EOT
<a href="$url" target="_blank" class="button">$text</a>
EOT;
        return trim($html);
	}


}

?>
