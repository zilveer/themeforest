<?php

class PeThemeShortcodeBS_Widget extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "widget_sidebar";
		$this->group = __("CONTENT",'Pixelentity Theme/Plugin');
		$this->name = __("Widgets Sidebar",'Pixelentity Theme/Plugin');
		$this->description = __("Widget",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "id" => 
							  array(
									"label"=>__("Widget Area",'Pixelentity Theme/Plugin'),
									"type"=>"Select",
									"description" => __("Select which widget area to insert. Widget areas need to be created in the 'Theme Options' panel before they will appear in this list.",'Pixelentity Theme/Plugin'),
									"options" => peTheme()->sidebar->option(),
									"default"=>"default"
									)
							  );

	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if (!@$id) return "";
		//return peTheme()->widget->inline($id);
		ob_start();
		peTheme()->sidebar->show($id,true);
		$content =& ob_get_contents();
		ob_end_clean();
		return $content;
	}


}

?>
