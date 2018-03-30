<?php

class PeThemeConstantPortfolio {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Portfolio",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-portfolio",
						),
				  "content"=>
				  array(
						"columns" =>
						array(
							  "label"=>__("Columns",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "description" => __("Specify the layout arrangement of columns for the project items. ",'Pixelentity Theme/Plugin'),
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
							  "label"=>__("Allow Filtering",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Specify if the project filter keywords are shown in this page. ",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"count" =>
						array(
							  "label" => __("Max Project",'Pixelentity Theme/Plugin'),
							  "type" => "Text",
							  "description" => __("Maximum number of project to show, leave empty for unlimited.",'Pixelentity Theme/Plugin'),
							  "default" => "",
							  ),
						"pager" => 
						array(
							  "label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"no"
							  ),
						"id" => 
						array(
							  "label"=>__("Selection",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "description" => __("Using this control, you can manually pick individual projects to be included in the portfolio. If you also want projects to be shown in the same order as listed here, make sure no 'tag' is selected in the next field.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "options"=> peTheme()->project->option()
							  ),
						"tags" =>
						array(
							  "label" => __("Only Include Projects With The Following Tags",'Pixelentity Theme/Plugin'),
							  "type" => "Tags",
							  "taxonomy" => "prj-category",
							  "description" => __("Only include projects in this page based on specific keywords/tags. ",'Pixelentity Theme/Plugin'),
							  "default" => ""
							  ),
						)
				  );
	}
	
}

?>