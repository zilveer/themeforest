<?php

class PeThemeViewLayoutModuleGalleryCarousel extends PeThemeViewLayoutModule {

	public function name() {
		return __("Carousel",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Carousel",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "id" =>
				  array(
						"label" => __("Gallery",'Pixelentity Theme/Plugin'),
						"description" => __("Select the gallery.",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"options" => peTheme()->gallery->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  "columns" =>
				  array(
						"label" => __("Columns",'Pixelentity Theme/Plugin'),
						"description" => __("Number of columns to use for the layout.",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"options" => array("1" => 1,"2" => 2,"3" => 3,"4" => 4),
						"default" => 2
						),
				  "caption" =>
				  array(
						"label" => __("Show Caption",'Pixelentity Theme/Plugin'),
						"description" => __("Whether to show title/description under the image/video or not.",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"options" => array(__("Yes",'Pixelentity Theme/Plugin') => "yes", __("No",'Pixelentity Theme/Plugin') => ""),
						"default" => ""
						)
				  );
		
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "gallerycarousel";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule",$this->templateName());
	}

	public function tooltip() {
		return __("Use this block to show a gallery as a Carousel.",'Pixelentity Theme/Plugin');
	}

}

?>
