<?php

class PeThemeViewSliderVista extends PeThemeViewSliderVolo {

	public function name() {
		return __("Slider - Vista (Pan/Zoom effect)",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Vista",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();

		$custom = 
			array(
				  "transition" =>
				  array(
						"label"=>__("Transition",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Transition type.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Pan / Zoom",'Pixelentity Theme/Plugin') =>"pz",
							  __("Fade",'Pixelentity Theme/Plugin') =>"fade"
							  ),
						"default"=>"pz"
						),
				  "fade" =>
				  array(
						"label"=>__("Fade Duration",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"step"=>"0.1",
						"description" => __("Duration (in seconds) of the crossfade transition.",'Pixelentity Theme/Plugin'),
						"default"=>"2"
						),
				  "speed" =>
				  array(
						"label"=>__("Animation Time",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Duration (in seconds) of the pan/zoom animation, lower values increase animation speed. ",'Pixelentity Theme/Plugin'),
						"default"=>"10"
						)
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = array_merge($custom,$mbox["content"]);

		return $mbox;
		
	}

	public function template() {
		peTheme()->get_template_part("view","slider-vista");
	}
   
}

?>
