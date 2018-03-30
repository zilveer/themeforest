<?php

class PeThemeShortcodeBS_Tooltip extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "tooltip";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Tooltip",'Pixelentity Theme/Plugin');
		$this->description = __("Add a tooltip",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "position"=> 
							  array(
									"label" => __("Position",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the tooltip position.",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Top",'Pixelentity Theme/Plugin') => "top",
										  __("Bottom",'Pixelentity Theme/Plugin') => "bottom",
										  __("Left",'Pixelentity Theme/Plugin') => "left",
										  __("Right",'Pixelentity Theme/Plugin') => "right"
										  ),
									"default" => "top"
									),
							  "url" =>
							  array(
									"label" => __("Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the tooltip trigger",'Pixelentity Theme/Plugin'),
									"default" => "#"
									),
							  "type"=> 
							  array(
									"label" => __("Button Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of button to use. The type determines the button color",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("No button, use normal text",'Pixelentity Theme/Plugin') => "none",
										  __("Default",'Pixelentity Theme/Plugin') => "default",
										  __("Primary",'Pixelentity Theme/Plugin') => "primary",
										  __("Info",'Pixelentity Theme/Plugin') => "info",
										  __("Success",'Pixelentity Theme/Plugin') => "success",
										  __("Warning",'Pixelentity Theme/Plugin') => "warning",
										  __("Danger",'Pixelentity Theme/Plugin') => "danger",
										  __("Inverse",'Pixelentity Theme/Plugin') => "inverse"
										  ),
									"default" => "none"
									),
							  "content" =>
							  array(
									"label" => __("Label",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the tooltip trigger label content here.",'Pixelentity Theme/Plugin'),
									"default" => "Label content."
									),
							  "title" =>
							  array(
									"label" => __("Tooltip",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the tooltip content here.",'Pixelentity Theme/Plugin'),
									"default" => "Tooltip content"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if (!@$url || !@$title) return "";
		$class = (@$type && $type != "none") ? sprintf(' class="btn btn-%s" ',$type) : "";
		return sprintf('<a%s href="%s" data-rel="tooltip" data-position="%s" title="%s">%s</a>',$class,$url,$position,esc_attr($title),$this->parseContent($content));
	}


}

?>
