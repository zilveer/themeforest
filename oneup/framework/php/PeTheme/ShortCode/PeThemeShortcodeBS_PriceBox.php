<?php

class PeThemeShortcodeBS_PriceBox extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "pricetable";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Price Table",'Pixelentity Theme/Plugin');
		$this->description = __("Add an Price Box",'Pixelentity Theme/Plugin');

		$html = <<<EOL
<ul class="unstyled">
    <li><i class="icon-ok icon-white"></i>Includes stuff</li>
    <li><i class="icon-ok icon-white"></i>Other great items</li>
    <li><i class="icon-ok icon-white"></i>Yep that too</li>
</ul>
EOL;

		$this->fields = array(
							  "color"=> 
							  array(
									"label" => __("Background Color",'Pixelentity Theme/Plugin'),
									"type" => "Color",
									"description" => __("Select background color.",'Pixelentity Theme/Plugin'),
									"default" => "#666666"
									),
							 "title" =>
							  array(
									"label" => __("Title",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Price table title.",'Pixelentity Theme/Plugin'),
									"default" => "Like a Player",
									),
							  "price" =>
							  array(
									"label" => __("Price",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Price table price.",'Pixelentity Theme/Plugin'),
									"default" => "$19<span>99 /m</span>",
									),
							  "content" =>
							  array(
									"label" => __("Features",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the pricing tables features, one per line.",'Pixelentity Theme/Plugin'),
									"default" => $html
									),
							  "button_type"=> 
							  array(
									"label" => __("Button Type",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select the type of button required. The type determines the button color",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Default",'Pixelentity Theme/Plugin') => "default",
										  __("Primary",'Pixelentity Theme/Plugin') => "primary",
										  __("Info",'Pixelentity Theme/Plugin') => "info",
										  __("Success",'Pixelentity Theme/Plugin') => "success",
										  __("Warning",'Pixelentity Theme/Plugin') => "warning",
										  __("Danger",'Pixelentity Theme/Plugin') => "danger",
										  __("Inverse",'Pixelentity Theme/Plugin') => "inverse"
										  ),
									"default" => "default"
									),
							  "button_url" =>
							  array(
									"label" => __("Button Url",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the destination url of the button",'Pixelentity Theme/Plugin'),
									"default" => "#"
									),
							  "button_label" =>
							  array(
									"label" => __("Button Label",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the button label here. Leave this field blank to hide the button",'Pixelentity Theme/Plugin'),
									"default" => "Sign Up" 
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$html = sprintf('<div class="hero-unit price warning well" style="background-color: %s;">',$color);
		if (@$title) $html .= sprintf('<p class="type">%s</p>',$title);
		if (@$price) $html .= sprintf('<h1>%s</h1>',$price);
		if (@$content) $html .= $content;
		if (@$button_label) $html .= sprintf('<br/><p><a href="%s" class="btn btn-%s">%s</a></p>',$button_url,$button_type,$button_label);
		$html .= "</div>";
        return trim($html);
	}


}

?>
