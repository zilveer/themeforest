<?php

class PeThemeConstantProject {
	public $all;
	public $metabox;

	public function __construct() {
		$this->all = $this->all =& peTheme()->project->option();

		$this->metabox = 
			array(
				  "title" =>__("Project",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "type" => "Project",
				  "where" => 
				  array(
						"project" => "all",
						),
				  "content"=>
				  array(
						"subtitle" => 	
						array(
							  "label"=>__("Subtitle",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Specify a project subtitle. This will be shown on the portfolio single column page as well as the single project pages. ",'Pixelentity Theme/Plugin'),
							  "default"=>'Subtitle here'
							  ),
						"icon" => 	
						array(
							  "label"=>__("Icon",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "description" => __("Select an icon which represents the contents or theme of this project. This icon will be shown on all portfolio and project pages. ",'Pixelentity Theme/Plugin'),
							  "options" => apply_filters("pe_theme_project_icons",
							  array(
									__("Image",'Pixelentity Theme/Plugin')=>"icon-picture",
									__("Film",'Pixelentity Theme/Plugin')=>"icon-film",
									__("Video",'Pixelentity Theme/Plugin')=>"icon-facetime-video",
									__("Music",'Pixelentity Theme/Plugin')=>"icon-music",
									__("File",'Pixelentity Theme/Plugin')=>"icon-file",
									__("Review",'Pixelentity Theme/Plugin')=>"icon-search",
									__("List",'Pixelentity Theme/Plugin')=>"icon-list",
									__("Thumbnails",'Pixelentity Theme/Plugin')=>"icon-th",
									__("Book",'Pixelentity Theme/Plugin')=>"icon-book",
									__("Photography",'Pixelentity Theme/Plugin')=>"icon-camera",
									__("Typography",'Pixelentity Theme/Plugin')=>"icon-font",
									__("Private",'Pixelentity Theme/Plugin')=>"icon-lock",
									__("Info",'Pixelentity Theme/Plugin')=>"icon-info-sign",
									__("Event",'Pixelentity Theme/Plugin')=>"icon-calendar",
									__("Commentary",'Pixelentity Theme/Plugin')=>"icon-comment",
									__("Announcement",'Pixelentity Theme/Plugin')=>"icon-bullhorn",
									__("Business",'Pixelentity Theme/Plugin')=>"icon-briefcase",
									__("World",'Pixelentity Theme/Plugin')=>"icon-globe",
									__("Location",'Pixelentity Theme/Plugin')=>"icon-map-marker",
									__("Illustration",'Pixelentity Theme/Plugin')=>"icon-pencil",
									__("Person",'Pixelentity Theme/Plugin')=>"icon-user"
									)),
							  "default"=> apply_filters("pe_theme_project_default_icon",'icon-picture')
							  )
						)
				  );

		$layouts = apply_filters("pe_theme_project_layouts",array());
		if (count($layouts) > 0) {
			$this->metabox["content"]["layout"] =
				array(
					  "label"=>__("Layout",'Pixelentity Theme/Plugin'),
					  "type"=>"Select",
					  "description" => __("Select project layout.",'Pixelentity Theme/Plugin'),
					  "options" => $layouts,
					  "default" =>"right"
					  );
		}

		$this->metaboxFeatured = 
			array(
				  "title" =>__("Featured Project",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-portfolio",
						),
				  "content"=>
				  array(
						"featured" => 
						array(
							  "label"=>__("Project",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "description" => __("Select the project you wish to be featured. (Shown full width at top of page)",'Pixelentity Theme/Plugin'),
							  "options" =>
							  array_merge(
										  array(__("None",'Pixelentity Theme/Plugin') => ""),
										  $this->all
										  ),
							  "default"=>""
							  )
						)
				  );

	}
	
}

?>