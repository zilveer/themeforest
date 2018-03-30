<?php

class PeThemeViewLayoutModuleStaff extends PeThemeViewLayoutModuleServices {

	public function name() {
		return __("Staff",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Staff",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array(
						"label" => __("Title",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Section title, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => __("Meet the Team",'Pixelentity Theme/Plugin')
						),
				  "content" =>
				  array(
						"label" => __("Description",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Section description, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "textpos" =>
				  array(
						"label" => __("Text Position",'Pixelentity Theme/Plugin'),
						"description" => __("Text content position in regards to image.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Next the image",'Pixelentity Theme/Plugin') => "right",
							  __("Below the image",'Pixelentity Theme/Plugin') => "bottom"
							  ),
						"default"=> "bottom"
						),
				  "id" => 
				  array(
						"label"=>__("Staff",'Pixelentity Theme/Plugin'),
						"type"=>"Links",
						"description" => __("Add one or more staff member.",'Pixelentity Theme/Plugin'),
						"options" => peTheme()->staff->option(),
						"sortable" => true,
						"default"=>""
						)
				  );
		
	}

	public function postType() {
		return "staff";
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "staff";
	}

	public function tooltip() {
		return __("Use this block to add a staff member profile to your layout. Additional info about the staff member may be input here but staff member profile images, position titles and social media links are created separately. ",'Pixelentity Theme/Plugin');
	}

}

?>
