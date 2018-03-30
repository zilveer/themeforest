<?php

class PeThemeViewLayoutModuleSkills extends PeThemeViewLayoutModule {

	public function name() {
		return __("Skills",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Skills",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array( 
						"label" => __("Title",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Title",'Pixelentity Theme/Plugin'),
						"default" => 'Title'
						 ),
				  "features" => 
				  array(
						"section" => "main",
						"label"=> __("Features",'Pixelentity Theme/Plugin'),
						"description" => __("Add one or more features",'Pixelentity Theme/Plugin'),
						"type"=>"Items",
						"description" => "",
						"button_label" => __("Add New",'Pixelentity Theme/Plugin'),
						"sortable" => true,
						"auto" => __("Skill %",'Pixelentity Theme/Plugin'),
						"unique" => false,
						"editable" => false,
						"legend" => false,
						"fields" => 
						array(
							  array(
									"type" => "empty",
									"width" => "186"
									),
							  array(
									"name" => "content",
									"type" => "text",
									"width" => "300",
									"default" => ""
									),
							  array(
									"name" => "perc",
									"type" => "text",
									"width" => "50",
									"default" => "50"
									)
							  ),
						"default" => array(
										   array("content"=>__("Skill 1",'Pixelentity Theme/Plugin'),"perc" => "80"),
										   array("content"=>__("Skill 2",'Pixelentity Theme/Plugin'),"perc" => "70"),
										   array("content"=>__("Skill 3",'Pixelentity Theme/Plugin'),"perc" => "60")
										   )
						),
				  );
		
	}

	public function blockClass() {
		return "nomargin";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","skills");
	}

	public function tooltip() {
		return __("Use this block to add feature block to your layout. This consists of text content with an optional action button and a single image",'Pixelentity Theme/Plugin');
	}


}

?>
