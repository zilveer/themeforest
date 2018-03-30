<?php

class PeThemeViewLayoutModuleView extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => __("View",'Pixelentity Theme/Plugin'),
				  "type" => __("View",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "id" => 
				  array(
						"label" => __("View",'Pixelentity Theme/Plugin'),
						"description" => __("Select the view to be shown.",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"groups" => true,
						"options" => peTheme()->view->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  "margin" =>
				  array(
						"label" => __("Margins",'Pixelentity Theme/Plugin'),
						"description" => __("When set to <b>no</b>, content will have no bottom margin.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => PeGlobal::$const->data->yesno,
						"default"=> "yes"
						),
				  "width" =>
				  array(
						"label"=>__("Media Width",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Leave empty to use default width.",'Pixelentity Theme/Plugin'),
						"default"=> ""
						),
				  "height" =>
				  array(
						"label"=>__("Media Height",'Pixelentity Theme/Plugin'),
						"type"=>"Number",
						"description" => __("Leave empty to avoid image cropping. In this case, slider based views will require all the (original) images to have the same size to work correctly.",'Pixelentity Theme/Plugin'),
						"default"=> ""
						)
				  );
		
	}

	public function name() {
		return __("View",'Pixelentity Theme/Plugin');
	}

	public function option() {
		return "View";
	}

	public function output($conf) {
		$settings = (object) $conf["data"];
		printf('<div class="pe-block%s">',($settings->margin === "no") ? " nomargin" : "");
		peTheme()->view->resize($settings);
		print("</div>");
	}

	public function tooltip() {
		return __("Use this block to add a component to your layout. Components are usually made of complex dynamic media such as portfolio grids or carousels. These components are created separately.",'Pixelentity Theme/Plugin');
	}

}

?>
