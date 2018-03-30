<?php

class PeThemeShortcodeBS_Badge extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "badge";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Badge",'Pixelentity Theme/Plugin');
		$this->description = __("Add a badge",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Badge Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of badge required. The badge type determines the bodge color",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Default",'Pixelentity Theme/Plugin') => "default",
										  __("Info",'Pixelentity Theme/Plugin') => "info",
										  __("Success",'Pixelentity Theme/Plugin') => "success",
										  __("Warning",'Pixelentity Theme/Plugin') => "warning",
										  __("Important",'Pixelentity Theme/Plugin') => "important",
										  __("Inverse",'Pixelentity Theme/Plugin') => "inverse"
										  ),
									"default" => "default"
									),
							  "url" =>
							  array(
									"label" => __("Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the badge. Leave this field blank if the badge is not required to be a clickable link",'Pixelentity Theme/Plugin'),
									),
							  "content" =>
							  array(
									"label" => __("Label",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the badge's text content here.",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$type = $atts["type"];
		if (!isset($url)) $url = false;
		$content = $content ? $this->parseContent($content) : '';
		if ($url) {
			$html = sprintf('<a href="%s" class="badge badge-%s">%s</a>',$url,$type,$content);
		} else {
			$html = sprintf('<span class="badge badge-%s">%s</span>',$type,$content);
		}
        return trim($html);
	}


}

?>
