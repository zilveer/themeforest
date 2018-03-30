<?php

class PeThemeViewGalleryGrid extends PeThemeViewGallery {


	public function name() {
		return __("Gallery - Grid (flare lightbox)",'Pixelentity Theme/Plugin');

	}

	public function short() {
		return __("Images",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();
		$content =& $mbox["content"];

		unset($content["max"]);

		$fields = 
			array(
				  "filterable" => 
				  array(
						"label"=>__("Filter by",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Show filters based on the selected criteria.",'Pixelentity Theme/Plugin'),
						"options" => peTheme()->view->taxonomiesOptions(),
						"datatype" => "taxonomies",
						"default"=>""
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'Pixelentity Theme/Plugin'),
						"description" => __("Grid container layout.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Boxed",'Pixelentity Theme/Plugin')=>"boxed",
							  __("Full Width",'Pixelentity Theme/Plugin') => "fullwidth"
							  ),
						"default"=>"boxed"
						),				  
				  "width" =>
				  array(
						"label"=>__("Thumbnail Width",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Image thumbnail width.",'Pixelentity Theme/Plugin'),
						"default"=>256
						),
				  "height" =>
				  array(
						"label"=>__("Thumbnail Height",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Image thumbnail height, leave empty to avoid image cropping (masonry layout)",'Pixelentity Theme/Plugin'),
						"default"=>""
						),
				  "gx" =>
				  array(
						"label"=>__("Horizontal Margin",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Horizontal margin between image thumbnails.",'Pixelentity Theme/Plugin'),
						"default"=>1
						),
				  "gy" =>
				  array(
						"label"=>__("Vertical Margin",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Vertical margin between image thumbnails.",'Pixelentity Theme/Plugin'),
						"default"=>1
						),
				  );

		$content = array_merge($fields,$content);

		return $mbox;	
	}

	public function template() {
		peTheme()->get_template_part("view","gallery-grid");
	}


   
}

?>
