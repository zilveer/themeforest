<?php

class PeThemeViewLayoutModuleFeaturedProject extends PeThemeViewLayoutModuleServices {

	public function name() {
		return __("Featured Project",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Featured",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "id" =>
				  array(
						"label"=>__("Project",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"description" => __("Select the featured project.",'Pixelentity Theme/Plugin'),
						"options" => peTheme()->project->option(),
						"default"=>""
						)
				  );
		
	}

	public function postType() {
		return "project";
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "featured";
	}

	public function tooltip() {
		return __("Use this block to add featured project section to your layout. This section accepts one project, the content of which is displayed in this full width block.",'Pixelentity Theme/Plugin');
	}

}

?>
