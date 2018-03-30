<?php

class PeThemeShortcodeWpml extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "lang";
		$this->group = __("CONTENT",'Pixelentity Theme/Plugin');
		$this->name = __("WPML Language Block",'Pixelentity Theme/Plugin');
		$this->description = __("WPML Language Block",'Pixelentity Theme/Plugin');
		$langs = peTheme()->wpml->options();
		// drop "all" option
		array_shift($langs);
		$this->fields = array(
							  "code" => 
							  array(
									"label"=>__("Language",'Pixelentity Theme/Plugin'),
									"description" => __("Only show content when language match the above selection.",'Pixelentity Theme/Plugin'),
									"type"=>"RadioUI",
									"options" => $langs,
									"default"=>"en"
									),
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "Editor",
									"description" => __("Block content.",'Pixelentity Theme/Plugin'),
									"default" => sprintf("%scontent%s","\n","\n")
									)
							  );

		peTheme()->shortcode->blockLevel[] = $this->trigger;

	}


	public function output($atts,$content=null,$code="") {
		extract(shortcode_atts(array('code'=> ''),$atts));
		if (empty($code)) {
			if (!empty($atts) && count($atts) > 0) {
				$code = $atts[0];
			}
		}

		$content = (!$code || ICL_LANGUAGE_CODE == $code) ? $this->parseContent($content) : "";

		
		return $content;

	}


}

?>
