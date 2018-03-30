<?php

class PeThemeViewLayoutModuleGmap extends PeThemeViewLayoutModule {

	public function name() {
		return __("Google Map",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Google Map",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
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
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'Pixelentity Theme/Plugin'),
						"description" => __("Map container layout.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Boxed",'Pixelentity Theme/Plugin')=>"boxed",
							  __("Full Width",'Pixelentity Theme/Plugin') => "fullwidth"
							  ),
						"default"=>"boxed"
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
						)
				  );
		
	}

	public function blockClass() {
		return empty($this->data->layout) || $this->data->layout != "fullwidth" ? "" : "pe-escape-container";
	}


	public function template() {
		peTheme()->get_template_part("viewmodule","gmap");
	}

	public function tooltip() {
		return __("Use this block to add a Google Maps module to your layout. Woth this module you may specify the lattitude, longitude and zoom level of the displayed map.",'Pixelentity Theme/Plugin');
	}


}

?>
