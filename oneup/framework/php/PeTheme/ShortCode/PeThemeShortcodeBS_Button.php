<?php

class PeThemeShortcodeBS_Button extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "button";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Button",'Pixelentity Theme/Plugin');
		$this->description = __("Add a button",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Button Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of button required. The button type determines the boton's color",'Pixelentity Theme/Plugin'),
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
							  "size"=> 
							  array(
									"label" => __("Button Size",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the size of button",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Small",'Pixelentity Theme/Plugin') => "small",
										  __("Medium",'Pixelentity Theme/Plugin') => "medium",
										  __("Large",'Pixelentity Theme/Plugin') => "large"
										  ),
									"default" => "small"
									),
							  "url" =>
							  array(
									"label" => __("Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the button",'Pixelentity Theme/Plugin'),
									),
							  "content" =>
							  array(
									"label" => __("Optional Label",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the button label here. If no text is entered the button will have no label and so will require an icon or something else to be inserted. This can be done using the icon shortcode once this button shortcode has been added to the editor",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$type = $atts["type"];
		if (!isset($url)) $url = "#";
		$content = $content ? $this->parseContent($content) : '';
		$html = <<< EOT
<a href="$url" target="_blank" class="btn btn-$size btn-$type">$content</a>
EOT;
        return trim($html);
	}


}

?>
