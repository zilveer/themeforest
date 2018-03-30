<?php

class PeThemeShortcodeBS_Share extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "share";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Share",'Pixelentity Theme/Plugin');
		$this->description = __("Add a social share button",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Social Network",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the social network on which to share content.",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Facebook",'Pixelentity Theme/Plugin') => "facebook",
										  __("Twitter",'Pixelentity Theme/Plugin') => "twitter",
										  __("Google +1",'Pixelentity Theme/Plugin') => "google",
										  __("Pinterest",'Pixelentity Theme/Plugin') => "pinterest"
										  ),
									"default" => "facebook"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html = sprintf('<button class="share %s"></button>',$type);
        return trim($html);
	}


}

?>
