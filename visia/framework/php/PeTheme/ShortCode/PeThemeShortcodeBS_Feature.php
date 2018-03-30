<?php

class PeThemeShortcodeBS_Feature extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "feature";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Feature",'Pixelentity Theme/Plugin');
		$this->description = __("Add a Feature Box",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "icon"=> 
							  array(
									"label" => __("Icon",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Select an icon for this feature. See the help docs for a list of the available icons. ",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Cloud",'Pixelentity Theme/Plugin')=>"icon-feature-cloud",
										  __("Minus",'Pixelentity Theme/Plugin')=>"icon-feature-minus",
										  __("Plus",'Pixelentity Theme/Plugin')=>"icon-feature-plus",
										  __("Quote",'Pixelentity Theme/Plugin')=>"icon-feature-quote",
										  __("Eye",'Pixelentity Theme/Plugin')=>"icon-feature-eye",
										  __("Info",'Pixelentity Theme/Plugin')=>"icon-feature-info",
										  __("Heart",'Pixelentity Theme/Plugin')=>"icon-feature-heart",
										  __("Lightbulb",'Pixelentity Theme/Plugin')=>"icon-feature-bulb",
										  __("Rss",'Pixelentity Theme/Plugin')=>"icon-feature-rss",
										  __("Award",'Pixelentity Theme/Plugin')=>"icon-feature-award",
										  __("Stats",'Pixelentity Theme/Plugin')=>"icon-feature-stat",
										  __("Star",'Pixelentity Theme/Plugin')=>"icon-feature-star",
										  __("Shield",'Pixelentity Theme/Plugin')=>"icon-feature-shield",
										  __("Film",'Pixelentity Theme/Plugin')=>"icon-feature-film",
										  __("Lock",'Pixelentity Theme/Plugin')=>"icon-feature-locked",
										  __("Ribbon",'Pixelentity Theme/Plugin')=>"icon-feature-ribbon",
										  __("Share",'Pixelentity Theme/Plugin')=>"icon-feature-share",
										  __("Location",'Pixelentity Theme/Plugin')=>"icon-feature-location",
										  __("User",'Pixelentity Theme/Plugin')=>"icon-feature-user",
										  __("List",'Pixelentity Theme/Plugin')=>"icon-feature-list",
										  __("Grid",'Pixelentity Theme/Plugin')=>"icon-feature-grid",
										  __("Comment",'Pixelentity Theme/Plugin')=>"icon-feature-comment",
										  __("Map",'Pixelentity Theme/Plugin')=>"icon-feature-map",
										  __("Graph",'Pixelentity Theme/Plugin')=>"icon-feature-graph",
										  __("Settings",'Pixelentity Theme/Plugin')=>"icon-feature-settings",
										  __("Tag",'Pixelentity Theme/Plugin')=>"icon-feature-tag",
										  __("Calendar",'Pixelentity Theme/Plugin')=>"icon-feature-calendar",
										  __("Mail",'Pixelentity Theme/Plugin')=>"icon-feature-mail",
										  __("Clock",'Pixelentity Theme/Plugin')=>"icon-feature-clock",
										  __("Lightening",'Pixelentity Theme/Plugin')=>"icon-feature-lightening",
										  __("Camera",'Pixelentity Theme/Plugin')=>"icon-feature-camera",
										  __("Zoom",'Pixelentity Theme/Plugin')=>"icon-feature-zoom-in",
										  __("Close",'Pixelentity Theme/Plugin')=>"icon-feature-close",
										  __("Tic",'Pixelentity Theme/Plugin')=>"icon-feature-tic",
										  __("CircleTic",'Pixelentity Theme/Plugin')=>"icon-feature-tic2",
										  __("CircleClose",'Pixelentity Theme/Plugin')=>"icon-feature-close2",
										  __("Document",'Pixelentity Theme/Plugin')=>"icon-feature-doc",
										  __("Article",'Pixelentity Theme/Plugin')=>"icon-feature-article",
										  __("Next",'Pixelentity Theme/Plugin')=>"icon-feature-next",
										  __("Prev",'Pixelentity Theme/Plugin')=>"icon-feature-prev",
										  __("Down",'Pixelentity Theme/Plugin')=>"icon-feature-down",
										  __("Up",'Pixelentity Theme/Plugin')=>"icon-feature-up",
										  __("UpRight",'Pixelentity Theme/Plugin')=>"icon-feature-up-right",
										  __("DownLeft",'Pixelentity Theme/Plugin')=>"icon-feature-down-left"
										  ),
									"default" => "icon-feature-tic"
									),
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the feature box text content here. Simple HTML tags are supported.",'Pixelentity Theme/Plugin'),
									"default" => sprintf('<h3>Title</h3>%s<p>Description</p>',"\n")
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$html = sprintf('<div class="feature"><span class="featureIcon"><i class="%s"></i></span><div class="featureContent">%s</div></div>',$icon,$content);
        return trim($html);
	}


}

?>
