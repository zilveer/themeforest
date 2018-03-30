<?php

class PeThemeShortcodeBS_Staff extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "staff";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Staff",'Pixelentity Theme/Plugin');
		$this->description = __("Add a staff block",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "layout"=> 
							  array(
									"label" => __("Layout",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select position of main image.",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Left",'Pixelentity Theme/Plugin') => "left",
										  __("Right",'Pixelentity Theme/Plugin') => "right"
										  ),
									"default" => "left"
									),
							  "image" => 
							  array(
									"label"=>__("Image",'Pixelentity Theme/Plugin'),
									"type"=>"Upload",
									"description" => __("Upload the large image. 400x320px aprox. ",'Pixelentity Theme/Plugin')
									),
							  "thumb" => 
							  array(
									"label"=>__("Thumbnail",'Pixelentity Theme/Plugin'),
									"type"=>"Upload",
									"description" => __("Upload the small Image. 110x130px aprox. Leave this field blank if no small images is required.",'Pixelentity Theme/Plugin')
									),
							  "content" => 
							  array(
									"label"=>__("Content",'Pixelentity Theme/Plugin'),
									"type"=>"TextArea",
									"description" => __("Description content. Simple HTML tags and buttons are supported.",'Pixelentity Theme/Plugin'),
									"default" => sprintf('<h3>Full Name <span>Position</span></h3>%s<p>Description</p>',"\n")
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$t =& peTheme();
		$content = isset($content) ? sprintf('<div class="span7"><div class="innerSpacer">
			<div class="content">%s</div>
		</div></div>',$this->parseContent($content)) : "";
		
		$thumb = isset($thumb) ? sprintf('<div class="thumb">%s</div>',$t->image->resizedImg($thumb,110,130)) : "";
		$image = isset($image) ? sprintf('<div class="span5 clearfix"><div class="image">%s</div>%s</div>',$t->image->resizedImg($image,420,300),$thumb) : "";

		$content = isset($layout) && $layout == "left" ? "$image $content" : "$content $image";

		$html =<<<EOL
<div class="row-fluid">
    <div class="span12">
        <div class="staff clearfix $layout"><div class="row-fluid">$content</div></div>
    </div>
</div>
EOL;
        return trim($html);
	}


}

?>
