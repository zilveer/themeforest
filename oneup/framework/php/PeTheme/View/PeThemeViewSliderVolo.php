<?php

class PeThemeViewSliderVolo extends PeThemeView {

	public function name() {
		return __("Slider - Volo (swipe)",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Volo",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Slider",'Pixelentity Theme/Plugin');
	}

	public function supports($type) {
		return !in_array($type,array("post-ptable","content","layout"));
	}

	public function capability($cap) {
		return in_array($cap,array("captions","links"));
	}

	public function mbox() {
		$mbox = parent::mbox();
		$mbox["type"] = "Slider";
		$mbox["content"] = 
			array(
				  "delay" => 
				  array(
						"label" => __("Delay",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"description" => __("Time in seconds before the slider rotates to next slide.",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->delay,
						"default" => 0
						),
				  "autopause" =>
				  array(
						"label"=>__("Autopause",'Pixelentity Theme/Plugin'),
						"description" => __("Pause timer when mouse is over the slider.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Enabled",'Pixelentity Theme/Plugin')=>"enabled",
							  __("Disabled",'Pixelentity Theme/Plugin') => ""
							  ),
						"default"=>""
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'Pixelentity Theme/Plugin'),
						"description" => __("A boxed slider (default) behaves like a responsive image. A full width slider will always fill all the available width and upscale the image if smaller than slider area.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Boxed",'Pixelentity Theme/Plugin')=>"boxed",
							  __("Full Width",'Pixelentity Theme/Plugin') => "fullwidth"
							  ),
						"default"=>"boxed"
						),
				  "max" => 
				  array(
						"label" => __("Max height",'Pixelentity Theme/Plugin'),
						"type" => "Number",
						"description" => __("Maximum slider height.",'Pixelentity Theme/Plugin'),
						"default" => 600
						),
				  "min" => 
				  array(
						"label" => __("Min height",'Pixelentity Theme/Plugin'),
						"type" => "Number",
						"description" => __("Minimum slider height.",'Pixelentity Theme/Plugin'),
						"default" => 0
						)
				  );

		return $mbox;	
	}

	public function output($conf) {

		parent::output($conf);

		$t =& peTheme();

		$loop = $t->view->getViewLoop($conf);

		if ($loop) {
			$t->template->data($conf,$loop);
			$boxed = empty($conf->settings->layout) || $conf->settings->layout === "boxed";
			printf('<div class="%s">',$boxed ? "pe-container pe-block" : "pe-block");
			$this->template();
			printf('</div>');
		}
	}

	public function template() {
		peTheme()->get_template_part("view","slider-volo");
	}
	   
}

?>
