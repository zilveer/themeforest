<?php

class PeThemeLayout {

	public $master;
	public $mbox;
	public $def;
	public $force;

	public function __construct($master) {
		$this->master =& $master;

		$this->mbox =
			array(
				  "title" => __('Page Layout','Pixelentity Theme/Plugin'),
				  "type" => 'Layout',
				  "priority" => "core",
				  "context" => "side",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"fullscreen" =>
						array(
							  "label" => __("Fullscreen",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "no"
							  ),
						"title" =>
						array(
							  "label" => __("Title",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "yes"
							  ),
						"headerMargin" =>
						array(
							  "label" => __("Header Margin",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "yes"
							  ),
						"content" =>
						array(
							  "label" => __("Content Area",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("Boxed",'Pixelentity Theme/Plugin')=>"boxed",
									__("Full Width",'Pixelentity Theme/Plugin') => "fullwidth"
									),
							  "default"=> "boxed"
							  ),
						"sidebar" =>
						array(
							  "label" => __("Sidebar",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("None",'Pixelentity Theme/Plugin')=>"",
									__("Right",'Pixelentity Theme/Plugin') => "right"
									),
							  "default"=> is_single() || is_page() ? "" : "right"
							  ),
						"widgets" =>
						array(
							  "label"=>__("Widgets",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "options" => $this->master->sidebar->option(),
							  "default"=> "default"
							  ),
						"footerMargin" =>
						array(
							  "label" => __("Footer Margin",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "yes"
							  ),
						"footerStyle" =>
						array(
							  "label"=>__("Footer Style",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("Default",'Pixelentity Theme/Plugin') => "",
									__("Small",'Pixelentity Theme/Plugin') => "small"
									),
							  "default"=> ""
							  )
						)
				  );

		
		$this->def = new stdClass();
		$this->force = new stdClass();
		
		foreach ($this->mbox["content"] as $option=>$data) {
			$this->def->$option = isset($data["default"]) ? $data["default"] : null;
		}

	}

	public function __get($what) {

		$ret = false;

		if (isset($this->force->$what)) {
			return $this->force->$what;
		} else {

			$meta = $this->master->content->meta();
			
			$layout = isset($meta) && isset($meta->layout) ? $meta->layout : $this->def;
			$layout = apply_filters("pe_theme_page_layout",$layout);

			if (isset($layout->$what)) {
				$ret = $layout->$what;
			}
		}

		return apply_filters("pe_theme_page_layout_$what",$ret);

	}

	public function __set($what,$value) {
		$this->force->$what = $value;
	}


}

?>