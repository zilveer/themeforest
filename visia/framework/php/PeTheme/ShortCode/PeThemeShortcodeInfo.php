<?php

class PeThemeShortcodeInfo extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "info";
		$this->group = __("ALERTS",'Pixelentity Theme/Plugin');
		$this->name = __("Info",'Pixelentity Theme/Plugin');
		$this->description = __("Add info box",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "content" =>
							  array(
									"label" => __("Alert Text",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the text content of the alert box",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {		
		if ($content) {
			$content = $this->parseContent($content);
		}
		$html = <<< EOT
<div class="alert note"><span class="sprite">Alert</span><p>$content</p></div>
EOT;
return trim($html);
	}


}

?>
