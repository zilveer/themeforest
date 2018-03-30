<?php

class PeThemeShortcodeDownload extends PeThemeShortcodeLink {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "download";
		$this->name = __("Download",'Pixelentity Theme/Plugin');
		$this->description = __("Add download box",'Pixelentity Theme/Plugin');
	}

	public function output($atts,$content=null,$code="") {
		if ($content) {
			$content = $this->parseContent($content);
		}
		$html = <<< EOT
<a href="{$atts['url']}"><div class="alert download"><span class="sprite"></span><p>$content</p></div></a>
EOT;
return trim($html);
	}


}

?>
