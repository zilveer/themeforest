<?php

class PeThemeWidgetProject extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Projects",'Pixelentity Theme/Plugin');
		$this->description = __("Show projects",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_portfolio widget_featured";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=> __("Featured Work",'Pixelentity Theme/Plugin')
									),
							  "id" => 
							  array(
									"label"=>__("Project",'Pixelentity Theme/Plugin'),
									"type"=>"Links",
									"description" => __("Add one or more projects.",'Pixelentity Theme/Plugin'),
									"sortable" => true,
									"options"=> PeGlobal::$const->project->all
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		$html = "";

		$settings = shortcode_atts(array('title'=>'','id'=>array(),"template" => "widget-projects"),$instance);
		extract($settings);

		$settings = (object) $settings;

		if (isset($title)) {
			$html .= "<h3>$title</h3>";
		}

		// if no project manually added, just show last 2
		if (count($id) == 0) {
			$settings->count = 2;
		}

		$t =& peTheme();
		
		ob_start();
		$t->project->portfolio($settings);
		$html .= ob_get_clean();

		return $html;
	}



}
?>
