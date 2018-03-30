<?php

class PeThemeConstantSidebar {
	public $all;
	public $fields;
	public $metabox;

	public function __construct() {
		$this->all = array_merge(peTheme()->sidebar->option());

		$this->fields = new stdClass();

		$this->fields->sidebar = 
			array(
				  "label"=>__("Sidebar",'Pixelentity Theme/Plugin'),
				  "type"=>"SelectPlain",
				  "section"=>__("General",'Pixelentity Theme/Plugin'),
				  "description" => __("Select which sidebar to use",'Pixelentity Theme/Plugin'),
				  "options" => $this->all,
				  "default"=>"default"
				  );


		$this->metabox = 
			array(
				  "type" =>"Plain",
				  "title" =>__("Sidebar",'Pixelentity Theme/Plugin'),
				  "context" => "side",
				  "priority" => "core",
				  "where" => 
				  array(
						"post" => "all"
						),
				  "content"=>
				  array(
						"value" => $this->fields->sidebar
						)
				  );
		
		$this->metaboxFooter = 
			array(
				  "title" => __("Footer",'Pixelentity Theme/Plugin')
				  );

		$this->metaboxFooter = array_merge($this->metabox,$this->metaboxFooter);
		$this->metaboxFooter["content"]["value"]["options"] = peTheme()->sidebar->option();
		$this->metaboxFooter["content"]["value"]["default"] = "footer";

	}
	
}

?>