<?php

class PeThemeViewLayoutModuleStat extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Stat",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Stat title.",'Pixelentity Theme/Plugin'),
						"default"=>__("Title",'Pixelentity Theme/Plugin')
						),
				  "image" => 	
				  array(
						"label"=>__("Image",'Pixelentity Theme/Plugin'),
						"type"=>"upload",
						"description" => __("Stat image.",'Pixelentity Theme/Plugin'),
						"default"=>"",
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"description" => __("Stat content.",'Pixelentity Theme/Plugin'),
						"default" => 'Lorem ipsum dolor sit amet.'
						)
				  );
		
	}

	public function name() {
		return __("Stat",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return "Custom";
	}
	
	public function cssClass() {
		return "custom";
	}

	public function group() {
		return "stat";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","stat");
	}

	public function tooltip() {
		return __("Use this block to add an additional stat column of data to the stats module.",'Pixelentity Theme/Plugin');
	}


}

?>
