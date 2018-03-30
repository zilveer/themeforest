<?php

class PeThemeConstantBlog {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Blog",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-blog",
						),
				  "content"=>
				  array(
						"layout" =>
						array(
							  "label"=>__("Layout",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Select the required post layout. 'Full' - denotes a full width normal blog layout. 'Compact' - denotes a full width list style layout. 'Mini' - denotes a compressed layout with small post thumbnails.",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$config["blog"],
							  "default"=>""
							  ),
						"count" =>
						array(
							  "label" => __("Max Posts",'Pixelentity Theme/Plugin'),
							  "type" => "Text",
							  "description" => __("Maximum number of posts to show.",'Pixelentity Theme/Plugin'),
							  "default" => get_option("posts_per_page"),
							  ),
						"media" => 
						array(
							  "label"=>__("Show Media",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Specify if the post's image/video/gallery media is displayed.",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"pager" => 
						array(
							  "label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"sticky" => 
						array(
							  "label"=>__("Include Sticky Posts",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("Include sticky posts in the displayed list.",'Pixelentity Theme/Plugin'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"category" =>
						array(
							  "label" => __("Category",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "description" => __("Only show posts from a specific category.",'Pixelentity Theme/Plugin'),
							  "options" => array_merge(array(__("All",'Pixelentity Theme/Plugin')=>""),peTheme()->data->getTaxOptions("category")),
							  "default" => ""
							  ),
						"tag" =>
						array(
							  "label" => __("Tag",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "description" => __("Only show posts with a specific tag.",'Pixelentity Theme/Plugin'),
							  "options" => array_merge(array(__("All",'Pixelentity Theme/Plugin')=>""),peTheme()->data->getTaxOptions("post_tag")),
							  "default" => ""
							  ),
						"format" =>
						array(
							  "label" => __("Post Format",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "description" => __("Only show posts of a specific format.",'Pixelentity Theme/Plugin'),
							  "options" => array_merge(array(__("All",'Pixelentity Theme/Plugin')=>""),array_combine(PeGlobal::$config["post-formats"],PeGlobal::$config["post-formats"])),
							  "default" => ""
							  )
						)
				  );
		if (count(PeGlobal::$config["blog"]) < 2) {
			unset($this->metabox["content"]["layout"]);
		}
	}
	
}

?>