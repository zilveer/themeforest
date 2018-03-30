<?php

class PeThemeConstantBackground {
	public $fields;
	public $options;
	public $metabox;

	public function __construct() {

		$this->fields = new stdClass();

		$this->fields->image = 							  
			array(
				  "label"=>__("Image",'Pixelentity Theme/Plugin'),
				  "type"=>"Upload",
				  "description" => __("Select a background image.",'Pixelentity Theme/Plugin'),
				  "default"=>""
				  );

		$this->metabox = 
			array(
				  "type" =>"Background",
				  "title" =>__("Background",'Pixelentity Theme/Plugin'),
				  "where" => 
				  array(
						"post" => "all",
						"page" => "all"
						/*
						  format: "taxonomy" => "value1,value2"
						 */
						),
				  "content"=>
				  array(
						"type" => 
						array(
							  "label"=>__("Background",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("This option controls the backgrounds type.<br/><span><strong>Default</strong> uses global setting (defined in theme options).<br/></span><strong>Custom</strong> means use custom settings and <br/><strong>None</strong> disables the custom background component.",'Pixelentity Theme/Plugin'),
							  //"options" => Array(__("Default",'Pixelentity Theme/Plugin')=>"default",__("Color",'Pixelentity Theme/Plugin')=>"color",__("Black&White",'Pixelentity Theme/Plugin')=>"bw",__("None",'Pixelentity Theme/Plugin')=>"none"),
							  "options" => Array(__("Default",'Pixelentity Theme/Plugin')=>"default",__("Custom",'Pixelentity Theme/Plugin')=>"color",__("None",'Pixelentity Theme/Plugin')=>"none"),
							  "default"=>"default"
							  ),
						"resource" => 
						array(
							  "label"=>__("Type",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("<strong>Image</strong> means you can select a static image,<br/><strong>Slider</strong> means a background image will be set according to the current slide as shown in the first slider of that page,<br/><strong>Gallery</strong> means a slideshow is displayed of a selected gallery's images.<br/>These may be overwritten on a page by page basis by setting different background options in specific pages.",'Pixelentity Theme/Plugin'),
							  "options" => 
							  array(
									__("Image",'Pixelentity Theme/Plugin') => "image",
									__("Slider",'Pixelentity Theme/Plugin') => "slider",
									__("Gallery",'Pixelentity Theme/Plugin') => "gallery"
),
							  "default"=>"image"
							  ),
						"image" => $this->fields->image,
						"gallery" => PeGlobal::$const->gallery->id,
						"mobile" => 
						array(
							  "label"=>__("Mobile",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Static image for mobile.",'Pixelentity Theme/Plugin'),
							  "default"=>""
							  ),
						"overlay" => 
						array(
							  "label"=>__("Overlay",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("This option allows a tiled pattern overlay to be applied to the background.",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"overlayImage" =>
						array(
							  "label"=>__("Pattern",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Select a background pattern tile.",'Pixelentity Theme/Plugin'),
							  "default"=> PE_THEME_URL."/img/skin/pat.png"
							  )
						)
				  );

		foreach ($this->metabox["content"] as $key => $value) {
			$value["section"] = __("Background",'Pixelentity Theme/Plugin');
			if ($key == "type") {
				//unset($value["options"][__("Default",'Pixelentity Theme/Plugin')]);
				$value["options"] = Array(__("Enabled",'Pixelentity Theme/Plugin')=>"color",__("Disabled",'Pixelentity Theme/Plugin')=>"none");
				$value["default"] = "none";
				$value["description"] = __("This option controls the default background.",'Pixelentity Theme/Plugin');
					//preg_replace("/<span>.*<\/span>/","",$value["description"]);
			} 
			$this->options["background_".$key] = $value;
		}

	}
	
}

?>