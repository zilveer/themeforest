<?php

class PeThemeShortcodeBS_Portfolio extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "portfolio";
		$this->group = __("CONTENT",'Pixelentity Theme/Plugin');
		$this->name = __("Portfolio",'Pixelentity Theme/Plugin');
		$this->description = __("Portfolio",'Pixelentity Theme/Plugin');

		$options =& peTheme()->content->getPagesOptionsByTemplate("portfolio");

		if (!$options) {
			$options = array();
		}

		$options =& array_merge(array(__("Default / All Posts",'Pixelentity Theme/Plugin')=>""),$options);

		
		$this->fields = array(
							  "id" => 
							  array(
									"label" => __("Portfolio Options",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Show all posts with default options or use custom settings of a blog page template.",'Pixelentity Theme/Plugin'),
									"options" => $options
									),
							  "size" => 
							  array(
									"label"=>__("Media Size",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("The size of the Media Area in pixels. Leave empty to use default values",'Pixelentity Theme/Plugin'),
									"default"=>""
									),
							  );
	}

	public function output($atts,$content=null,$code="") {

		extract(shortcode_atts(array('id'=>''),$atts));
		
		$t =& peTheme();
		
		ob_start();
		$t->project->portfolio($id);
		$content =& ob_get_clean();
		return $content;

	}


}

?>
