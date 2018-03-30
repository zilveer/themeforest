<?php

class PeThemeShortcodeBS_Hero extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "hero";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Hero Unit",'Pixelentity Theme/Plugin');
		$this->description = __("Add an Hero Unit",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Hero Unit Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of hero unit required. the type determines the color",'Pixelentity Theme/Plugin'),
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
							 "title" =>
							  array(
									"label" => __("Title",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the title of the Hero Unit.",'Pixelentity Theme/Plugin'),
									),
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "Editor",
									"description" => __("Enter the Hero Unit content here.",'Pixelentity Theme/Plugin'),
									)
							  );

		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
	
		$content = $content ? $this->parseContent($content) : '';
		$title = isset($title) ? "<h1>$title</h1>" : "";

		$html = <<< EOT
<div class="hero-unit well $type">
	$title
	<p>$content</p>
</div>
EOT;
        return trim($html);
	}


}

?>
