<?php

class PeThemeViewLayoutModuleHeading extends PeThemeViewLayoutModule {

	public function name() {
		return __("Heading",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Heading",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array(
						"label" => "Title",
						"type" => "Text",
						"description" => __("Heading title.",'Pixelentity Theme/Plugin'),
						"default" => __("Title",'Pixelentity Theme/Plugin')
						),
				  "subtitle" =>
				  array(
						"label" => "Subtitle",
						"type" => "Text",
						"description" => __("Heading subtitle, leave blank to hide.",'Pixelentity Theme/Plugin'),
						"default" => __("Subtitle",'Pixelentity Theme/Plugin')
						)

				  );
		
	}

	public function blockClass() {
		return "pe-container nomargin";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","heading");
	}

	public function tooltip() {
		return __("Use this block to add a heading section to your layout. A heading block consists of a title and subtitle.",'Pixelentity Theme/Plugin');
	}
	
}

?>
