<?php

class PeThemeViewSliderVario extends PeThemeViewSliderVolo {

	public function name() {
		return __("Slider - Vario (CSS animations / video)",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Vario",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();

		$custom = 
			array(
				  "transition" =>
				  array(
						"label"=>__("Transition",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Transition type",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Fade",'Pixelentity Theme/Plugin') =>"fade",
							  __("Random",'Pixelentity Theme/Plugin') =>"random",
							  __("Block Fade",'Pixelentity Theme/Plugin') =>"blockfade",
							  __("Fall",'Pixelentity Theme/Plugin') =>"fall",
							  __("Domino",'Pixelentity Theme/Plugin') =>"domino",
							  __("Flip",'Pixelentity Theme/Plugin') =>"flip",
							  __("Reveal Right",'Pixelentity Theme/Plugin') =>"revealR",
							  __("Reveal Left",'Pixelentity Theme/Plugin') =>"revealL",
							  __("Reveal Bottom",'Pixelentity Theme/Plugin') =>"revealB",
							  __("Reveal Top",'Pixelentity Theme/Plugin') =>"revealT",
							  __("Saw",'Pixelentity Theme/Plugin') =>"saw",
							  __("Scale",'Pixelentity Theme/Plugin') =>"scale",
							  __("Bars",'Pixelentity Theme/Plugin') =>"bars",
							  __("Zoom",'Pixelentity Theme/Plugin') =>"zoom",
							  __("Drop",'Pixelentity Theme/Plugin') =>"drop"
							  ),
						"default"=>"fade"
						),
				  "bg" =>
				  array(
						"label"=>__("Background",'Pixelentity Theme/Plugin'),
						"description" => __("Whether to use  slide images as background or a video.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Images",'Pixelentity Theme/Plugin')=>"images",
							  __("Video",'Pixelentity Theme/Plugin') => "video"
							  ),
						"default"=>"images"
						),
				  "video" =>
				  array(
						"label"=>__("Video",'Pixelentity Theme/Plugin'),
						"type"=>"UploadLink",
						"description" => __("The video must be available in both ogv and mp4 formats, for instance, if the video is called 'background.mp4', then 'background.ogv' must also be uploaded.",'Pixelentity Theme/Plugin'),
						"default"=>""
						),
				  "loop" =>
				  array(
						"label"=>__("Loop",'Pixelentity Theme/Plugin'),
						"description" => __("Restart video once playback ends.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Enabled",'Pixelentity Theme/Plugin')=>"enabled",
							  __("Disabled",'Pixelentity Theme/Plugin') => ""
							  ),
						"default"=>""
						),
				  "fallback" =>
				  array(
						"label"=>__("Fallback",'Pixelentity Theme/Plugin'),
						"type"=>"Upload",
						"description" => __("When a background video is set, the fallback image will be shown in browsers that lack native video support (like older version of MSIE).",'Pixelentity Theme/Plugin'),
						"default"=>""
						)
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = array_merge($custom,$mbox["content"]);

		return $mbox;
		
	}

	public function template() {
		peTheme()->get_template_part("view","slider-vario");
	}
   
}

?>
