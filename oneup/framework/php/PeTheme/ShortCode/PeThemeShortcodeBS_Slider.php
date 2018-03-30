<?php

class PeThemeShortcodeBS_Slider extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "slider";
		$this->group = __("MEDIA",'Pixelentity Theme/Plugin');
		$this->name = __("Slider",'Pixelentity Theme/Plugin');
		$this->description = __("Slider",'Pixelentity Theme/Plugin');

		$this->fields = array(
							  "id" => PeGlobal::$const->gallery->id,
							  "size" => 
							  array(
									"label"=>__("Size",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("The size of the slider in pixels, written in the form WidthxHeight. Leave empty to use default values.",'Pixelentity Theme/Plugin'),
									"default"=>""
									),
							  );

	}


	public function output($atts,$content=null,$code="") {

		extract(shortcode_atts(array('id'=>'','size'=>''),$atts));
		
		if (!$id) return "";

		$size = $size ? explode("x",$size) : false;


		$t =& peTheme();
		ob_start();
		if ($size) 	$t->media->size($size[0],isset($size[1]) ? $size[1] : null);
		$t->slider->output($id);
		if ($size) $t->media->size();
		$content =& ob_get_clean();
		return $content;

	}


}

?>
