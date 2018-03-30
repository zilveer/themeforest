<?php

class PeThemeViewPortfolioGrid extends PeThemeViewBlog {

	public function name() {
		return __("Portfolio Grid",'Pixelentity Theme/Plugin');
	}
	
	public function short() {
		return __("Portfolio",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Portfolio",'Pixelentity Theme/Plugin');
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
				  "lightbox" => 
				  array(
						"label"=>__("Use Lightbox",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("If set to 'yes', clicking on image thumbnail will open a lightbox window, 'no' will go directly to the item page.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"yes"
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
						"label"=>__("Cell Width",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Grid cell width.",'Pixelentity Theme/Plugin'),
						"default"=>320
						),
				  "height" =>
				  array(
						"label"=>__("Cell Height",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Grid cell height.",'Pixelentity Theme/Plugin'),
						"default"=>240
						),
				  "clayout" =>
				  array(
						"label"=>__("Cell Layout",'Pixelentity Theme/Plugin'),
						"description" => __("<b>Fixed</b>: all grid cell will have the same width/height.<br><b>Variable</b>: will use the cell layout defined in the project portfolio settings.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Fixed",'Pixelentity Theme/Plugin') => "fixed",
							  __("Variable",'Pixelentity Theme/Plugin')=>"variable",
							  ),
						"default"=>"variable"
						),
				  "gx" =>
				  array(
						"label"=>__("Horizontal Margin",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Horizontal margin between grid cells.",'Pixelentity Theme/Plugin'),
						"default"=>1
						),
				  "gy" =>
				  array(
						"label"=>__("Vertical Margin",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Vertical margin between grid cells.",'Pixelentity Theme/Plugin'),
						"default"=>1
						),
				  "sort" =>
				  array(
						"label"=>__("Sorting",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("'none' will preserve items natural order which is what you want when all grid cell have the same width/height. 'optimize layout' should only be used when mixing cells with different layouts.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("none",'Pixelentity Theme/Plugin') =>"none",
							  __("auto",'Pixelentity Theme/Plugin') =>"auto"
							  ),
						"default"=>"none"
						),
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						)
				  );

		return $mbox;	
	}

	public function template($type = "") {
		if ($type != "empty") {
			peTheme()->get_template_part("view","portfolio-grid");
		}
	}
}

?>
