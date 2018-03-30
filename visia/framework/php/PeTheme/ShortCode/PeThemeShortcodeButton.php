<?php

class PeThemeShortcodeButton extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "button";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Button",'Pixelentity Theme/Plugin');
		$this->description = __("Add a button",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Button Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of button required. The button type determines the icon displayed on the button",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Download",'Pixelentity Theme/Plugin') => "download",
										  __("Link",'Pixelentity Theme/Plugin') => "link",
										  __("Info",'Pixelentity Theme/Plugin') => "info",
										  __("Thumbs",'Pixelentity Theme/Plugin') => "thumbs",
										  __("Vcard",'Pixelentity Theme/Plugin') => "vcard",
										  __("Love",'Pixelentity Theme/Plugin') => "love",
										  __("Warning",'Pixelentity Theme/Plugin') => "warning",
										  __("Tweet",'Pixelentity Theme/Plugin') => "tweet",
										  __("Like",'Pixelentity Theme/Plugin') => "like",
										  __("Note",'Pixelentity Theme/Plugin') => "note"
										  ),
									"default" => "download"
									),
							  "url" =>
							  array(
									"label" => __("Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the button",'Pixelentity Theme/Plugin'),
									),
							  "content" =>
							  array(
									"label" => __("Optional Label",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the button label here. If no text is entered the button will consist of an icon only",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		$type = $atts["type"];
		$class = $content ? "content " : "";
		$content = $content ? '<span class="content">'.$this->parseContent($content).'</span>' : '';
		$html = <<< EOT
<a href="{$atts['url']}" class="btn $class$type"><span class="sprite"></span>$content</a>
EOT;
        return trim($html);
	}


}

?>
