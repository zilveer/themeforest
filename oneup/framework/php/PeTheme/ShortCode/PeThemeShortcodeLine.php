<?php

class PeThemeShortcodeLine extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "line";
		$this->group = __("DIVIDERS",'Pixelentity Theme/Plugin');
		$this->name = __("Line",'Pixelentity Theme/Plugin');
		$this->description = __("Add a line",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type" =>
							  array(
									"label" => __("Line Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the line type of the divider",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Solid",'Pixelentity Theme/Plugin') => "solid",
										  __("Dotted",'Pixelentity Theme/Plugin') => "dotted"
										  )
									),
							  "top" =>
							  array(
									"label"=>__("Back to top link",'Pixelentity Theme/Plugin'),
									"type"=>"RadioUI",
									"description" => __("Select whether the line will contain a button which allows the user to scroll back to the top of the page",'Pixelentity Theme/Plugin'),
									"options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
									"default"=>"no"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		if (@$atts["top"] != "yes") {
			$html = <<< EOT
<div class="divider {$atts['type']} clearfix"><span></span></div>
EOT;
		} else {
			$top = __("top &uarr;",'Pixelentity Theme/Plugin');
			$html = <<< EOT
	<div class="divider topBtn {$atts['type']} clearfix"><span></span><a href="#top" title="Go to top">$top</a></div>
EOT;
		}
		return trim($html);

	}



}

?>
