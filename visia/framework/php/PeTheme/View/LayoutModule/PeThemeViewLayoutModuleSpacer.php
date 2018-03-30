<?php

class PeThemeViewLayoutModuleSpacer extends PeThemeViewLayoutModule {

	public function name() {
		return __("Spacer",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Spacer",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "height" =>
				  array(
						"label" => "Height",
						"type" => "Number",
						"description" => __("Spacer height in pixels.",'Pixelentity Theme/Plugin'),
						"default" => "70"
						)

				  );
		
	}

	public function blockClass() {
		return "pe-container nomargin";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","spacer");
	}

	public function tooltip() {
		return __("Use this block to add a spacer to your layout. A spacer is basically a way to add vertical spacing between elements in your layout. The amount of vertical spacing is user defined.",'Pixelentity Theme/Plugin');
	}
	
}

?>
