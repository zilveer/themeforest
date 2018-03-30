<?php

class PeThemeViewPortfolio extends PeThemeViewBlog {

	public function name() {
		return __("Portfolio Columns",'Pixelentity Theme/Plugin');
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
				  "layout" =>
				  array(
						"label"=>__("Layout",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Show filters based on the selected criteria.",'Pixelentity Theme/Plugin'),
						"options" => apply_filters("pe_theme_portfolio_layouts",
												   array(
														 __("Single column (no grid)",'Pixelentity Theme/Plugin')=>1,
														 __("2 Columns",'Pixelentity Theme/Plugin')=>2,
														 __("3 Columns",'Pixelentity Theme/Plugin')=>3,
														 __("4 Columns",'Pixelentity Theme/Plugin')=>4,
														 __("6 Columns",'Pixelentity Theme/Plugin')=>6
														 )),
						"default"=>apply_filters("pe_theme_portfolio_default_layout",3),
						),
				  "filterable" => 
				  array(
						"label"=>__("Filter by",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Specify if the filter keywords are shown in this page. ",'Pixelentity Theme/Plugin'),
						"options" => peTheme()->view->taxonomiesOptions(),
						"datatype" => "taxonomies",
						"default"=>""
						),
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"yes"
						)
				  );

		return $mbox;	
	}

	public function template($type = "") {
		if ($type != "empty") {
			peTheme()->get_template_part("view","portfolio");
			//peTheme()->get_template_part("view","portfolio-masonary");
		}
	}
}

?>
