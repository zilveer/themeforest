<?php

class PeThemeShortcodeClearfix extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "clear";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Clear",'Pixelentity Theme/Plugin');
		$this->description = __("Description",'Pixelentity Theme/Plugin');
	}

	public function output($atts,$content=null,$code="") {		
		$html = <<< EOT
<div class="clearfix"></div>
EOT;
return trim($html);
	}


}

?>
