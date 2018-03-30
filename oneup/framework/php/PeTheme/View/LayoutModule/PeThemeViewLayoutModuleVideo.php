<?php

class PeThemeViewLayoutModuleVideo extends PeThemeViewLayoutModuleView {

	public function messages() {
		return
			array(
				  "title" => __("Video",'Pixelentity Theme/Plugin'),
				  "type" => __("Video",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		/*
		$fields = parent::fields();
		$fields["id"] =
			array(
				  "label" => __("Video",'Pixelentity Theme/Plugin'),
				  "description" => __("Select the video to be shown.",'Pixelentity Theme/Plugin'),
				  "type" => "Select",
				  "options" => peTheme()->video->option(),
				  "editable" => admin_url('post.php?post=%0&action=edit')
				  );

		return $fields;
		*/

		return
			array(
				  "id" => 
				  array(
						"label" => __("Video",'Pixelentity Theme/Plugin'),
						"description" => __("Select the video to be shown.",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"options" => peTheme()->video->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  "margin" =>
				  array(
						"label" => __("Margins",'Pixelentity Theme/Plugin'),
						"description" => __("When set to <b>no</b>, content will have no bottom margin.",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => PeGlobal::$const->data->yesno,
						"default"=> "yes"
						)
				  );
		
	}

	public function name() {
		return __("Video",'Pixelentity Theme/Plugin');
	}

	public function option() {
		return "Video";
	}

	public function output($conf) {
		$settings = (object) $conf["data"];
		printf('<div class="pe-block pe-container%s">',($settings->margin === "no") ? " nomargin" : "");

		peTheme()->video->output($settings->id);

		/*
		$settings->view = "Video";
		$settings->data = (object) array("id" => $settings->id);
		peTheme()->view->resize($settings);
		*/

		print("</div>");
	}

	public function tooltip() {
		return __("Use this block to add a video media item to your layout. Video items are created separately.",'Pixelentity Theme/Plugin');
	}

}

?>
