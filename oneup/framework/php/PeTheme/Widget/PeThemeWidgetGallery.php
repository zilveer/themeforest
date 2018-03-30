<?php

class PeThemeWidgetGallery extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Gallery",'Pixelentity Theme/Plugin');
		$this->description = __("Show a gallery",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_gallery";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=>"Gallery widget"
									),
							  "size" => 
							  array(
									"label"=>__("Size",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Gallery widget size",'Pixelentity Theme/Plugin'),
									"default"=>"218x180"
									),
							  "id" => PeGlobal::$const->gallery->id
							  );

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);

		extract($instance);

		if (!@$id) return;
		$post = get_post($id);
		if (!$post) return;
		echo $args["before_widget"];
		if (isset($title)) echo "<h3>$title</h3>";
		list($w,$h) = explode("x",$size);
		echo "<div>";
		$t =& peTheme();
		$t->data->postSetup($post);
		$t->template->gallery_cover($w,$h);
		$t->data->postReset();
		$t->template->intro_gallery($id,90,74,"fullscreen");
		echo "</div>";
		echo $args["after_widget"];
	}


}
?>
