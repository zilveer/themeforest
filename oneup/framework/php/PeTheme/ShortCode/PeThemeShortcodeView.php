<?php

class PeThemeShortcodeView extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "pe_view";
		$this->group = __("CONTENT",'Pixelentity Theme/Plugin');
		$this->name = __("View",'Pixelentity Theme/Plugin');
		$this->description = __("Add a View",'Pixelentity Theme/Plugin');
		$this->fields = array(
			"id" => 
				array(
					"label" => __("View",'Pixelentity Theme/Plugin'),
					"description" => __("Select the view to be shown.",'Pixelentity Theme/Plugin'),
					"type" => "Select",
					"groups" => true,
					"options" => peTheme()->view->option()
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
		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {

		$atts = shortcode_atts( array(
			'id' => 0,
			'margin' => 'yes',
			'width' => '',
			'height' => '',
		), $atts, 'pe_view' );

		$settings = (object) $atts;
		$fullwidth = false;

		if ( 'view' !== get_post_type( $settings->id ) ) { // bail out if post type is not 'view'

			return __("Invalid View ID, make sure to generate shortcode using provided shortcode generator and not by copy-pasting.",'Pixelentity Theme/Plugin');

		}

		$view =& peTheme()->view;
		if (!empty($settings->id)) {
			$vconf = $view->conf($settings->id);
			if (!empty($vconf->settings->layout)) {
				$fullwidth = $vconf->settings->layout === "fullwidth";
			}
		}

		ob_start();

		printf('<div class="pe-block%s%s">',($settings->margin === "no") ? " nomargin" : "",$fullwidth ? " pe-block-fullwidth" : "");
		$view->resize($settings);
		print("</div>");

		$output = ob_get_contents();
		ob_end_clean();

		return $output;

	}


}

?>