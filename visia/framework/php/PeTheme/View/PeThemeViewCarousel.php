<?php

class PeThemeViewCarousel extends PeThemeViewBlog {

	public function name() {
		return __("Carousel",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Carousel",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Carousel",'Pixelentity Theme/Plugin');
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
				  "style" =>
				  array(
						"label"=>__("Style",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Carousel style.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Default",'Pixelentity Theme/Plugin') =>"",
							  __("Testimonials",'Pixelentity Theme/Plugin') =>"testimonials",
							  __("Logos",'Pixelentity Theme/Plugin') => "logos",
							  __("With More Button",'Pixelentity Theme/Plugin') => "more"
							  ),
						"default"=>""
						),
				  "height" =>
				  array(
						"label"=>__("Image Height",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Image height.",'Pixelentity Theme/Plugin'),
						"default"=>195
						),
				  "title" =>
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Carousel Title.",'Pixelentity Theme/Plugin'),
						"default"=>__("Carousel Title",'Pixelentity Theme/Plugin')
						),
				  "subtitle" =>
				  array(
						"label"=>__("Subtitle",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Carousel Subtitle.",'Pixelentity Theme/Plugin'),
						"default"=>'<a href="#">Go to portfolio</a>'
						),
				  "description" =>
				  array(
						"label"=>__("Description",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Carousel Description.",'Pixelentity Theme/Plugin'),
						"default"=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna.'
						),
				  "chars" =>
				  array(
						"label"=>__("Excerpt",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Excerpt length, in chars.",'Pixelentity Theme/Plugin'),
						"default"=>60
						),
				 
				  
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = $custom;
		//array_merge($custom,$mbox["content"]);

		return $mbox;		
	}

	public function defaults() {

		$conf =& $this->conf;

		$t =& peTheme();

		if (!isset($conf->settings)) {
			$conf->settings = new StdClass();
		}

		$settings =& $conf->settings;

		$settings->cips = "ceppa";

		$sw = array(940,350,314,240,180); 
		$iw = array(940,460,420,420,420); 
		$rw = array(940,460,300,220,172);

		$idx = min(5,max(1,absint($settings->layout)))-1; 
		$iw = $iw[$idx];
		$sw = $sw[$idx];
		$rw = $rw[$idx];
		$h = $t->view->resized ? $t->media->h : $settings->height;
		$h = round($h*($iw/$rw));

		$settings->sw = $sw;
		$settings->w = $iw;
		$settings->h = $h;

	}


	public function template($type = '') {
		print('<div class="pe-container pe-block">');
		peTheme()->get_template_part("view","carousel");
		print('</div>');
	}
   
}

?>
