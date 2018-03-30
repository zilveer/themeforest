<?php

class PeThemeViewLayoutModuleTestimonials extends PeThemeViewLayoutModuleServices {

	public function name() {
		return __("Testimonials",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Testimonials",'Pixelentity Theme/Plugin')
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
						"default" => __("What Others Are Saying",'Pixelentity Theme/Plugin')
						),
				  "content" =>
				  array(
						"label" => __("Description",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Section description, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "id" => 
				  array(
						"label"=>__("Testimonials",'Pixelentity Theme/Plugin'),
						"type"=>"Links",
						"description" => __("Add one or more testimonial.",'Pixelentity Theme/Plugin'),
						"options" => peTheme()->testimonial->option(),
						"sortable" => true,
						"default"=>""
						)
				  );
		
	}

	public function postType() {
		return "testimonial";
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "testimonials";
	}

	public function tooltip() {
		return __("Use this block to add a testimonial module to your layout. This module consists of a title, description followed by multiple testimonials or quotations arranged in rows of 2. The testimonial items are created separately.",'Pixelentity Theme/Plugin');
	}

}

?>
