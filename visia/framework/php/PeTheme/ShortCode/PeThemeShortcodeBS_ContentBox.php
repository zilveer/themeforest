<?php

class PeThemeShortcodeBS_ContentBox extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "contentbox";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Content Box",'Pixelentity Theme/Plugin');
		$this->description = __("Add Content Box",'Pixelentity Theme/Plugin');

		$this->fields = array(
							  "background"=> 
							  array(
									"label" => __("Background Color",'Pixelentity Theme/Plugin'),
									"type" => "Color",
									"description" => __("Select background color for the content box.",'Pixelentity Theme/Plugin'),
									"default" => ""
									),
							  "padding"=> 
							  array(
									"label" => __("Content Padding",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Content padding: Top, Right, Bottom, Left.",'Pixelentity Theme/Plugin'),
									"default" => "10px 10px 10px 10px"
									),
							  "content" =>
							  array(
									"label" => __("Box Content",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the box content here. Basic HTML tags are supported.",'Pixelentity Theme/Plugin'),
									"default" =>" content "
									)
							  );

		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;

	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$style = "";
		$style .= (isset($background) && $background) ? "background-color:$background;" : "";
		$style .= (isset($padding) && $padding) ? "padding:$padding;\"" : "";
		if ($style) $style = "style=\"$style";

		$html = sprintf('<div class="contentBox" %s>%s</div>',$style,$content);
        return trim($html);
	}


}

?>
