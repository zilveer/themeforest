<?php

class PeThemeShortcodeVisiaHeading extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "heading";
		$this->group = __("CONTENT",'Pixelentity Theme/Plugin');
		$this->name = __("Heading",'Pixelentity Theme/Plugin');
		$this->description = __("Add an Alert Box",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "text" =>
							  array(
									"label" => __("Text",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Heading text",'Pixelentity Theme/Plugin'),
									)
							  );
		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html = <<< EOT
<h3 class="shortcode-title">$text</h3>
EOT;
        return trim($html);
	}


}

?>
