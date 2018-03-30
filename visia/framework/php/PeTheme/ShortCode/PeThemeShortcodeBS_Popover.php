<?php

class PeThemeShortcodeBS_Popover extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "popover";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Popover",'Pixelentity Theme/Plugin');
		$this->description = __("Add a popover",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "position"=> 
							  array(
									"label" => __("Position",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the position for the popover",'Pixelentity Theme/Plugin'),
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
									"description" => __("Enter the destination url of the popover trigger object",'Pixelentity Theme/Plugin'),
									"default" => "#"
									),
							  "type"=> 
							  array(
									"label" => __("Button Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of button to use as the trigger object",'Pixelentity Theme/Plugin'),
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
									"description" => __("Enter the popover trigger button's text label here.",'Pixelentity Theme/Plugin'),
									"default" => "Hover for popover."
									),
							  "title" =>
							  array(
									"label" => __("Title",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the popover title here.",'Pixelentity Theme/Plugin'),
									"default" => "Popover Title"
									),
							  "body" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the popover content here.",'Pixelentity Theme/Plugin'),
									"default" => "Popover content"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if (!@$url || !@$title || !@$body) return "";
		$class = (@$type && $type != "none") ? sprintf(' class="btn btn-%s"',$type) : "";
		return sprintf('<a%s href="%s" data-placement="%s" data-rel="popover" data-content="%s" title="%s">%s</a>',$class,$url,$position,esc_attr($body),esc_attr($title),$this->parseContent($content));
	}


}

?>
