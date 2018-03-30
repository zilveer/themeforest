<?php

class PeThemeViewGallery extends PeThemeView {


	public function type() {
		return __("Gallery",'Pixelentity Theme/Plugin');
	}

	public function supports($type) {
		return !in_array($type,array("post-ptable","content","layout"));
	}

	public function mbox() {
		$mbox = parent::mbox();
		$mbox["type"] = "GalleryPost";

		$mbox["content"] = 
			array(
				  "max" => 
				  array(
						"label"=>__("Thumbnails",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Maximum number of thumbnails to show in the main page. Regardless this setting, all gallery images would still be shown inside the lightbox window.",'Pixelentity Theme/Plugin'),
						"default"=>"1000"
						),
				  "type" => 
				  array(
						"label"=>__("Lightbox Gallery Transition",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Choose image transition when viewed inside the lightbox: <strong>Slide</strong> Slides left/right. <strong>Shutter</strong> Black and white zoom effect.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Slide",'Pixelentity Theme/Plugin')=>"default",
							  __("Shutter",'Pixelentity Theme/Plugin')=>"shutter",
							  ),
						"default"=>"default"
						),
				  "bw" => 
				  array(
						"label"=>__("Black & White",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Enable Black & White effect.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("yes",'Pixelentity Theme/Plugin')=>"yes",
							  __("no",'Pixelentity Theme/Plugin')=>"no",
							  ),
						"default"=>"no"
						),
				  "scale" =>
				  array(
						"label"=>__("Scale Mode",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"section"=>__("General",'Pixelentity Theme/Plugin'),
						"description" => __("This setting determins how the images are scaled / cropped when displayed in the browser window.\"<strong>Fit</strong>\" fits the whole image into the browser ignoring surrounding space.\"<strong>Fill</strong>\" fills the whole browser area by cropping the image if necessary. The Max version will also upscale the image.",'Pixelentity Theme/Plugin'),
						"options" => array(
										   __("Fit",'Pixelentity Theme/Plugin')=>"fit",
										   __("Fit (Max)",'Pixelentity Theme/Plugin')=>"fitmax",
										   __("Fill",'Pixelentity Theme/Plugin')=>"fill",
										   __("Fill (Max)",'Pixelentity Theme/Plugin')=>"fillmax"
										   ),
						"default"=>"fit"
						)
				  );

		return $mbox;	
	}

	public function defaults() {

		$conf =& $this->conf;

		if (!isset($conf->settings)) {
			$conf->settings = new StdClass();
		}

		$settings =& $conf->settings;
		
		$settings->type = isset($settings->type) && $settings->type ? $settings->type : "default";
		$settings->max = isset($settings->max) ? intval($settings->max) : 0;
		$settings->scale = isset($settings->scale) && $settings->scale ? $settings->scale : "fit";
		$settings->bw = isset($settings->bw) && $settings->bw === "yes" && $settings->type === "shutter" ? true : false;

	}

	public function capability($cap) {
		return $cap === "captions";
	}

	public function output($conf) {

		parent::output($conf);

		$t =& peTheme();

		$loop = $t->view->getViewLoop($conf);

		if ($loop) {
			$t->template->data($conf,$loop);
			$this->template();
		}
	}

	public function template() {
	}   
}

?>
