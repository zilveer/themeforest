<?php

class PeThemeShortcodeBS_Alert extends PeThemeShortcode {

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
										  __("Default",'Pixelentity Theme/Plugin') => "default",
										  __("Primary",'Pixelentity Theme/Plugin') => "primary",
										  __("Info",'Pixelentity Theme/Plugin') => "info",
										  __("Success",'Pixelentity Theme/Plugin') => "success",
										  __("Warning",'Pixelentity Theme/Plugin') => "warning",
										  __("Danger",'Pixelentity Theme/Plugin') => "danger",
										  __("Inverse",'Pixelentity Theme/Plugin') => "inverse"
										  ),
									"default" => "default"
									),
							  "display"=> 
							  array(
									"label" => __("Alert Box Layout",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the layout based on what type of content the box will hold, inline content or block content",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Block",'Pixelentity Theme/Plugin') => "block",
										  __("Inline",'Pixelentity Theme/Plugin') => "inline"
										  ),
									"default" => "block"
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
<div class="alert alert-$type alert-$display fade in">
	$content
</div>
EOT;
        return trim($html);
	}


}

?>
