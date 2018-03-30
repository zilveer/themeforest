<?php

class PeThemeWidgetVideo extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Video",'Pixelentity Theme/Plugin');
		$this->description = __("Show a video",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_video";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=>"Video Widget"
									),
							  "id" => PeGlobal::$const->video->fields->id
							  );

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);
		extract($instance);

		if (!@$id) return;		
		echo $args["before_widget"];
		if (isset($title)) echo "<h3>$title</h3>";
		echo "<div>";
		peTheme()->video->show($id);
		echo "</div>";
		echo $args["after_widget"];
	}


}
?>
