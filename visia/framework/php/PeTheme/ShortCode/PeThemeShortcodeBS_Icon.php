<?php

class PeThemeShortcodeBS_Icon extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "icon";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Icon",'Pixelentity Theme/Plugin');
		$this->description = __("Select the cion type to add. See the help documentation for a link to the list of available icons",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> PeGlobal::$const->data->fields->icon,
							  "color" =>
							  array(
									"label" => __("Color",'Pixelentity Theme/Plugin'),
									"description" => __("Select color of the icon",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"options" =>
									array(
										  __("White",'Pixelentity Theme/Plugin') => "white",
										  __("Black",'Pixelentity Theme/Plugin') => "black"
										  ),
									"default" => "white"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html = sprintf('<i class="%s icon-%s"></i>',$type,$color);
        return trim($html);
	}


}

?>
