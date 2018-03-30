<?php

class PeThemeViewLayoutModuleHomeColumn extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Column",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Column title.",'Pixelentity Theme/Plugin'),
						"default"=>__("Title",'Pixelentity Theme/Plugin')
						),
				  "icon" => 	
				  array(
						"label"=>__("Icon",'Pixelentity Theme/Plugin'),
						"type"=>"Icon",
						"description" => __("Column icon.",'Pixelentity Theme/Plugin'),
						"default"=>"icon-bookmarks",
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"description" => __("Column content.",'Pixelentity Theme/Plugin'),
						"default" => 'Lorem ipsum dolor sit amet, consect tu era dipis cing elit. Donec odio. Quisque volut pat mattiois eros. Nullam males ua da erat ut turp is. Suspen disse urna tus nibh, viverra nonet, semper susci pi , pos uere a, pede. Sed eget estas, ante ettuli vulputate volutpat, eros pede.'
						),
				  "label" =>
				  array(
						"label"=>__("Link Label",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Column link label, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default"=>__("LEARN MORE",'Pixelentity Theme/Plugin')
						),
				  "url" =>
				  array(
						"label"=>__("Link Url",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Column link url, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default"=>"#"
						)
				  );
		
	}

	public function name() {
		return __("Home Column",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return "Custom";
	}
	
	public function cssClass() {
		return "custom";
	}

	public function group() {
		return "homecolumn";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","homecolumn");
	}

	public function tooltip() {
		return __("Use this block to add an additional column of data to the home column module.",'Pixelentity Theme/Plugin');
	}


}

?>
