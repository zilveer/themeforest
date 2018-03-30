<?php

class PeThemeViewLayoutModulePricingColumn extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Column",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
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
						"type"=>"Editor",
						"description" => __("Price box content, can be html.",'Pixelentity Theme/Plugin'),
						"default"=>__("<h4>$99</h4><span>PER MONTH</span>",'Pixelentity Theme/Plugin')
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
						"auto" => __("Feature %",'Pixelentity Theme/Plugin'),
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
									"width" => "500",
									"default" => ""
									)
							  ),
						"default" => array(
										   array("content"=>__("Feature 1",'Pixelentity Theme/Plugin')),
										   array("content"=>__("Feature 2",'Pixelentity Theme/Plugin')),
										   array("content"=>__("Feature 3",'Pixelentity Theme/Plugin'))
										   )
						),
				  "button_label" => 	
				  array(
						"label"=>__("Button Label",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"default"=>__("Sign Up Now",'Pixelentity Theme/Plugin')
						),
				  "button_link" => 	
				  array(
						"label"=>__("Button Link",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"default"=>"#"
						)
				  );
		
	}

	public function name() {
		return __("Pricing Column",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return "Custom";
	}
	
	public function cssClass() {
		return "custom";
	}

	public function group() {
		return "pricingcolumn";
	}


	public function template() {
		peTheme()->get_template_part("viewmodule","pricingcolumn");
	}

	public function tooltip() {
		return __("Use this block to add another column of data to your pricing table layout.",'Pixelentity Theme/Plugin');
	}

}

?>
