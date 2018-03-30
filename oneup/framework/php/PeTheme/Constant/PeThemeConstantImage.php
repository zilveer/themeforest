<?php

class PeThemeConstantImage {
	public $scale;
	public $align;
	public $fields;
	public $metabox;

	public function __construct() {
		$this->scale = 
			array(
				  __("FILL",'Pixelentity Theme/Plugin')=>"fill",
				  __("FIT",'Pixelentity Theme/Plugin')=>"fit"
				  );

		$this->align =
			array(
				  __("Top Left",'Pixelentity Theme/Plugin')=>"top,left",
				  __("Top Center",'Pixelentity Theme/Plugin')=>"top,center",
				  __("Top Right",'Pixelentity Theme/Plugin')=>"top,right",
				  __("Center Left",'Pixelentity Theme/Plugin')=>"center,left",
				  __("Center Center",'Pixelentity Theme/Plugin')=>"center,center",
				  __("Center Right",'Pixelentity Theme/Plugin')=>"center,right",
				  __("Bottom Left",'Pixelentity Theme/Plugin')=>"bottom,left",
				  __("Bottom Center",'Pixelentity Theme/Plugin')=>"bottom,center",
				  __("Bottom Right",'Pixelentity Theme/Plugin')=>"bottom,right",
				  );

		$this->fields = new stdClass();

		$this->fields->scale = 
			array(
				  "label"=>__("Scale Mode",'Pixelentity Theme/Plugin'),
				  "type"=>"RadioUI",
				  "section"=>__("General",'Pixelentity Theme/Plugin'),
				  "description" => __("This setting determins how the images are scaled / cropped when displayed in the browser window.\"<strong>Fit</strong>\" fits the whole image into the browser ignoring surrounding space.\"<strong>Fill</strong>\" fills the whole browser area by cropping the image if necessary",'Pixelentity Theme/Plugin'),
				  "options" => $this->scale,
				  "default"=>"fill"
				  );

		$this->fields->align = 							  
			array(
				  "label"=>__("Image Alignment",'Pixelentity Theme/Plugin'),
				  "type"=>"Select",
				  "section"=>__("General",'Pixelentity Theme/Plugin'),
				  "description" => __("Specify the alignment to be used in the event of the image being cropped. Use this to ensure that important parts of the image can be always seen.",'Pixelentity Theme/Plugin'),
				  "options" => $this->align,
				  "default"=>"center,center"
				  );

		$this->metabox = 
			array(
				  "type" =>"",
				  "title" =>__("Image Options",'Pixelentity Theme/Plugin'),
				  "where" => 
				  array(
						"post" => "image,video",
						"page" => "all"
						/*
						  format: "taxonomy" => "value1,value2"
						 */
						),
				  "content"=>
				  array(
						"scale" => $this->fields->scale,
						"align" => $this->fields->align
						)
				  );

		$this->metaboxScale = 
			array(
				  "type" =>"",
				  "title" =>__("Image Options",'Pixelentity Theme/Plugin'),
				  "where" => 
				  array(
						"post" => "image",
						),
				  "content"=>
				  array(
						"scale" => $this->fields->scale
						)
				  );
	}
	
}

?>