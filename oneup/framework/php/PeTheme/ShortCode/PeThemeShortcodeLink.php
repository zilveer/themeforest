<?php

class PeThemeShortcodeLink extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "link";
		$this->group = __("ALERTS",'Pixelentity Theme/Plugin');
		$this->name = __("Link",'Pixelentity Theme/Plugin');
		$this->description = __("Add link box",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the text content of the alert box",'Pixelentity Theme/Plugin'),
									),
							  "url" =>
							  array(
									"label" => __("Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the alert box when clicked",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {		
		if ($content) {
			$content = $this->parseContent($content);
		}
		$html = <<< EOT
<a href="{$atts['url']}"><div class="alert link"><span class="sprite"></span><p>$content</p></div></a>
EOT;
return trim($html);
	}


}

?>
