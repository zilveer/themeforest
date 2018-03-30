<?php

class PeThemeViewLayoutModuleTabsItemContainer extends PeThemeViewLayoutModuleContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Tab",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array(
						"label" => __("Title",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Item Title.",'Pixelentity Theme/Plugin'),
						"default" => __("Title",'Pixelentity Theme/Plugin')
						)
				  );
		
	}

	public function type() {
		return "Tabs";
	}

	public function cssClass() {
		return "custom";
	}
	
	public function group() {
		return "tabs";
	}

	public function tooltip() {
		return __("Use this block to add more complex content to your tabbed item. This block basically acts as a container into which further blocks may be inserted.",'Pixelentity Theme/Plugin');
	}

}

?>
