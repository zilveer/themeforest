<?php

class PeThemeViewLayoutModuleTabsItem extends PeThemeViewLayoutModule {

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
						),
				  "content" =>
				  array(
						"label" => __("Content",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Item text content.",'Pixelentity Theme/Plugin'),
						"default" => __("Content",'Pixelentity Theme/Plugin')
						)
				  );
		
	}

	public function name() {
		return __("Text",'Pixelentity Theme/Plugin');
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

	public function template() {
		echo $this->data->content;
	}

	public function tooltip() {
		return __("Use this block to add an additional tab to your tabbed content module.",'Pixelentity Theme/Plugin');
	}

}

?>
