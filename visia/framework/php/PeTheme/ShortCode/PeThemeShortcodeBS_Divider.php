<?php

class PeThemeShortcodeBS_Divider extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "divider";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Divider",'Pixelentity Theme/Plugin');
		$this->description = __("Add a divider",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Divider Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of divider required.",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Solid",'Pixelentity Theme/Plugin') => "solid",
										  __("Dotted",'Pixelentity Theme/Plugin') => "dotted"
										  ),
									"default" => "solid"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html =<<<EOL
<div class="row-fluid">
    <div class="span12">
        <div class="divider $type clearfix"><span></span></div>
    </div>
</div>
EOL;
        return trim($html);
	}


}

?>
