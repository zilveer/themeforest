<?php

class PeThemeConstantPricingTable {
	public $all;
	public $fields;
	public $metabox;

	public function __construct() {
		$this->all = peTheme()->ptable->option();

		$this->metabox = 
			array(
				  "title" => __("Table Properties",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"ptable" => "all"
						),
				  "content" =>
				  array(
						"title" => 	
						array(
							  "label"=>__("Title",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Table title. ",'Pixelentity Theme/Plugin'),
							  "default"=>__("Package One",'Pixelentity Theme/Plugin')
							  ),
						"price" => 	
						array(
							  "label"=>__("Price Box",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "description" => __("Price box content, can be html.",'Pixelentity Theme/Plugin'),
							  "default"=>__("<h2><span>$199</span> Plus monthly free</h2>",'Pixelentity Theme/Plugin')
							  ),
						"features" => 
						array(
							  "label"=>__("Features",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "description" => __("Add one or more features.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "unique" => false,
							  "default"=>array(__("Feature 1",'Pixelentity Theme/Plugin'),__("Feature 2",'Pixelentity Theme/Plugin'),__("Feature 3",'Pixelentity Theme/Plugin'))
							  ),
						"button_label" => 	
						array(
							  "label"=>__("Button Label",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=>__("Sign Up",'Pixelentity Theme/Plugin')
							  ),
						"button_link" => 	
						array(
							  "label"=>__("Button Link",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=>"#"
							  )
						)
				  
				  );

		$this->metaboxGroup =
			array(
				  "type" =>"",
				  "title" =>__("Pricing Tables",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-pricing_table",
						),
				  "content"=>
				  array(
						"items" => 
						array(
							  "label"=>__("Tables",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "description" => __("Add one or more pricing tables.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "options"=> $this->all
							  ),
						"labels" =>				
						array(
							  "label"=>__("Show Labels",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description"=>__('If set to "YES", the first table will be used to show property labels.','Pixelentity Theme/Plugin'),
							  "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							  "default"=>"no"
							  ),
						"starter" => 
						array(
							  "label"=>__("Starter",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __('Which table should be highlighted as "Starter" pack, "1" = highlight first table.','Pixelentity Theme/Plugin'),
							  "options" => 
							  array(
									__("None",'Pixelentity Theme/Plugin') => 0,
									"1" => 1,
									"2" => 2,
									"3" => 3,
									"4" => 4,
									"5" => 5,
									),
							  "default"=> 0
							  ),
						"popular" => 
						array(
							  "label"=>__("Popular",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __('Which table should be highlighted as "Popular" pack, "1" = highlight first table.','Pixelentity Theme/Plugin'),
							  "options" => range(1,5),
							  "single" => true,
							  "default"=> 2
							  )
						)
				  
				  );

		

	}
	
}

?>