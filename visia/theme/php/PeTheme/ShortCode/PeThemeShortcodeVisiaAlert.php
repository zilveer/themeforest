<?php

class PeThemeShortcodeVisiaAlert extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "alert";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Alert Box",'Pixelentity Theme/Plugin');
		$this->description = __("Add an Alert Box",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Alert Box Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of Alert Box required. The alert type determines the color of the box and text",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Info",'Pixelentity Theme/Plugin') => "info",
										  __("Success",'Pixelentity Theme/Plugin') => "success",
										  __("Error",'Pixelentity Theme/Plugin') => "error",
										  __("Notice",'Pixelentity Theme/Plugin') => "notice",
										  ),
									"default" => "default"
									),
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the Alert Box content here ( Basic HTML supported ).",'Pixelentity Theme/Plugin'),
									)
							  );
		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$html = <<< EOT
<p class="alert $type">
	$content
</p>
EOT;
        return trim($html);
	}


}

?>
