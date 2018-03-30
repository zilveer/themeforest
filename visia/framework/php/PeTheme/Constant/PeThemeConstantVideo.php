<?php

class PeThemeConstantVideo {

	public $all;
	public $metaboxPost;
	public $fields;


	public function __construct() {
		$this->all = peTheme()->video->option();

		$this->fields = new StdClass;

		$description = current($this->all) < 0 ? sprintf(__('<a href="%s">Create a new Video</a>','Pixelentity Theme/Plugin'),admin_url('post-new.php?post_type=video')) : __("Select which video to use",'Pixelentity Theme/Plugin');

		$this->fields->id = 
			array(
				  "label"=>__("Use video",'Pixelentity Theme/Plugin'),
				  "type"=>"Select",
				  "description" => $description,
				  "options" => $this->all,
				  "default"=>""
				  );		

		$this->metaboxPost = 
			array(
				  "title" => __("Video Options",'Pixelentity Theme/Plugin'),
				  "where" =>
				  array(
						"post" => "video"
						),
				  "content" =>
				  array(
						"id" => $this->fields->id
						)
				  );
	}
	
}

?>