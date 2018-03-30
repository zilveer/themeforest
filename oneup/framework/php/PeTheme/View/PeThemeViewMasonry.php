<?php

class PeThemeViewMasonry extends PeThemeViewBlog {

	public function name() {
		return __("Masonry",'Pixelentity Theme/Plugin');
	}
	
	public function short() {
		return __("Masonry",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Blog",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();
		
		$mbox["content"] = 
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
				  "video" => 
				  array(
						"label"=>__("Inline Videos",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("If enabled, display a video player for video format posts.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "slider" => 
				  array(
						"label"=>__("Inline Sliders",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("If enabled, display a slider for gallery format posts.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "width" =>
				  array(
						"label"=>__("Column Width",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Grid cell width.",'Pixelentity Theme/Plugin'),
						"default"=>320
						),
				  "height" =>
				  array(
						"label"=>__("Image Height",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Slider images height.",'Pixelentity Theme/Plugin'),
						"default"=>180
						),
				  "crop" => 
				  array(
						"label"=>__("Crop Featured Image",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("When 'Image Height' is set, only slider images are cropped, set this option to 'yes' to also crop featured images.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "gx" =>
				  array(
						"label"=>__("Horizontal Margin",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Horizontal margin between grid cells.",'Pixelentity Theme/Plugin'),
						"default"=>10
						),
				  "gy" =>
				  array(
						"label"=>__("Vertical Margin",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Vertical margin between grid cells.",'Pixelentity Theme/Plugin'),
						"default"=>10
						),
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "loadMore" => 
				  array(
						"label"=>__("Load More",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("When 'Paged Result' is active (and a value is set in the 'Maximum' field), enabling this option will replace the pager element with a single 'Load More' button. Once clicked, it will load new items in the background and add them to the current page.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						)
				  );

		return $mbox;	
	}

	public function template($type = "") {
		if ($type != "empty") {
			peTheme()->get_template_part("view","masonry");
		}
	}
}

?>
