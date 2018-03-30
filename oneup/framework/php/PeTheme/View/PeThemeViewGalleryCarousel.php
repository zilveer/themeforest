<?php

class PeThemeViewGalleryCarousel extends PeThemeViewGallery {

	public function name() {
		return __("Gallery - Carousel",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Carousel",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Gallery",'Pixelentity Theme/Plugin');
	}

	/*
	public function capability($cap) {
		return false;
	}
	*/

	public function supports($type) {
		return $type === "gallery";
	}

	public function mbox() {
		$mbox = parent::mbox();

		$custom = 
			array(
				  "delay" => 
				  array(
						"label" => __("Delay",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"description" => __("Time in seconds before the slider rotates to next slide.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->delay,
						"default" => 0
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Number of items to show simultaneously.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("1",'Pixelentity Theme/Plugin') =>1,
							  __("2",'Pixelentity Theme/Plugin') =>2,
							  __("3",'Pixelentity Theme/Plugin') =>3,
							  __("4",'Pixelentity Theme/Plugin') =>4,
							  __("5",'Pixelentity Theme/Plugin') =>5
							  ),
						"default"=>4
						),
				  "height" =>
				  array(
						"label"=>__("Image Height",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Image height.",'Pixelentity Theme/Plugin'),
						"default"=>195
						)
				 
				  
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = $custom;

		return $mbox;		
	}

	public function defaults() {

		$conf =& $this->conf;

		$t =& peTheme();

		if (!isset($conf->settings)) {
			$conf->settings = new StdClass();
		}

		$settings =& $conf->settings;

		if (empty($settings->height)) {
			$settings->height = 195;
		}

		if (empty($settings->delay)) {
			$settings->delay = 0;
		}

		if (empty($settings->style)) {
			$settings->style = "default";
		}

		$sw = array(940,350,314,240,180); 
		$iw = array(940,460,420,420,420); 
		$rw = array(940,460,300,220,172);

		$idx = min(5,max(1,absint($settings->layout)))-1; 
		$iw = $iw[$idx];
		$sw = $sw[$idx];
		$rw = $rw[$idx];
		$h = $t->view->resized ? $t->media->h : $settings->height;

		$h = $h < 2 ? $h*$rw : $h;
		$h = round($h*($iw/$rw));

		$settings->sw = $sw;
		$settings->w = $iw;
		$settings->h = $h;

	}


	public function template($type = '') {
		print('<div class="pe-container pe-block">');
		peTheme()->get_template_part("view","gallery-carousel");
		print('</div>');
	}
   
}

?>
