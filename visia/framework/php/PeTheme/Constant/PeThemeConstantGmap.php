<?php

class PeThemeConstantGmap {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Google Map",'Pixelentity Theme/Plugin'),
				  "where" => 
				  array(
						"page" => "page-contact",
						),
				  "content"=>
				  array(
						"show" =>
						array(
							  "label"=>__("Show Google Map",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Specify whether or not to show the Google map",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"latitude" => 	
						array(
							  "label"=>__("Latitude",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Latitudinal location for the map center. See the help documentation for a link to a utility used to convert addresses into lat/long numbers",'Pixelentity Theme/Plugin'),
							  "default"=>'51.50813'
							  ),
						"longitude" => 	
						array(
							  "label"=>__("Longitude",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Longitudinal location for the map center. See the help documentation for a link to a utility used to convert addresses into lat/long numbers",'Pixelentity Theme/Plugin'),
							  "default"=>'-0.12801'
							  ),
						"zoom" => 	
						array(
							  "label"=>__("Zoom Level",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Enter the zoom level of the map upon page load. The user is then free to adjust this zoom level using the map UI",'Pixelentity Theme/Plugin'),
							  "default"=>'12'
							  ),
						"title" => 	
						array(
							  "label"=>__("Map Marker Title",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Enter a title for the map marker flyout",'Pixelentity Theme/Plugin'),
							  "default"=>'Custom title here'
							  ),
						"description" => 	
						array(
							  "label"=>__("Map Marker Description",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "description" => __("Enter a description for the map marker flyout",'Pixelentity Theme/Plugin'),
							  "default"=>'Custom description here'
							  )
						)
				  );
	}
	
}

?>