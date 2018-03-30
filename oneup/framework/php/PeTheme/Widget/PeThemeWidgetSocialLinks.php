<?php

class PeThemeWidgetSocialLinks extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Social links",'Pixelentity Theme/Plugin');
		$this->description = __("Link to social profiles",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_social";
		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=>"Social Media Widget"
									),
							  "links" => 
							  array(
									"label"=>__("Links",'Pixelentity Theme/Plugin'),
									"type"=>"Links",
									"description" => __("Paste your social media profile links one at a time and hit the Add New button. The link will be added to a table below and the appropriate icon will be automatically selected based on the link's domain name",'Pixelentity Theme/Plugin'),
									"sortable" => true,
									"default"=>""
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		extract($instance);
		$html = "";
		if (!isset($links)) return $html;
		$html = isset($title) ? "<h3>$title</h3>" : "";
		$html .= peTheme()->content->getSocialLinks($links);
		return $html;
	}


}
?>
