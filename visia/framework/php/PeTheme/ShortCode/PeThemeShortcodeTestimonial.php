<?php

class PeThemeShortcodeTestimonial extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "testimonial";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Testimonial",'Pixelentity Theme/Plugin');
		$this->description = __("Testimonial",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the testimonial or quotation text in this field",'Pixelentity Theme/Plugin'),
									),
							  "title" =>
							  array(
									"label" => __("Quotee",'Pixelentity Theme/Plugin'),
									"type" => "Text",
									"description" => __("Enter the name of the person being quoted",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		$title = isset($atts["title"]) ? "<h3>{$atts['title']}</h3>" : "";
		if ($content) {
			$content = $this->parseContent($content);
		}		
		$html = <<< EOT
<div class="testimonial">
    <blockquote><span class="sprite open">66</span>$content<span class="sprite close">99</span></blockquote>$title
</div>
EOT;
return trim($html);
	}


}

?>
