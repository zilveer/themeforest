<?php

class PeThemeConstantQuote {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "type" =>"",
				  "title" =>__("Quote Options",'Pixelentity Theme/Plugin'),
				  "where" => 
				  array(
						"post" => "quote",
						),
				  "content"=>
				  array(
						"text" => 	
						array(
							  "label"=>__("Content",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "description" => __("Text content of the quote box. ( Basic HTML is supported )",'Pixelentity Theme/Plugin'),
							  "default"=>'"Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>, donec odio. Quisque volutpat mattis eros."'
							  ),
						"sign" => 	
						array(
							  "label"=>__("Cite",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Quote cite",'Pixelentity Theme/Plugin'),
							  "default"=>'John Dough, Client'
							  )
						)
				  );
	}
	
}

?>