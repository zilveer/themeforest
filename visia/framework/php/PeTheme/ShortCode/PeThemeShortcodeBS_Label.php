<?php

class PeThemeShortcodeBS_Label extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "label";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Label",'Pixelentity Theme/Plugin');
		$this->description = __("Add a label",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Label Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of label required. The type determines the label color",'Pixelentity Theme/Plugin'),
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
									"description" => __("Enter the destination url of the label. Leave this field blank if the label is not a clickable link",'Pixelentity Theme/Plugin'),
									),
							  "content" =>
							  array(
									"label" => __("Label",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the label content here.",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$type = $atts["type"];
		if (!isset($url)) $url = false;
		$content = $content ? $this->parseContent($content) : '';
		if ($url) {
			$html = sprintf('<a href="%s" class="label label-%s">%s</a>',$url,$type,$content);
		} else {
			$html = sprintf('<span class="label label-%s">%s</span>',$type,$content);
		}
        return trim($html);
	}


}

?>
