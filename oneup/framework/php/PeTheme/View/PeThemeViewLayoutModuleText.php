<?php

class PeThemeViewLayoutModuleText extends PeThemeViewLayoutModule {

	public function registerAssets() {
		parent::registerAssets();

		PeTheme()->editor->instantiate();

		$params =
			array(
				  "type" => "RadioUI",
				  "options" => array("one" => 1,"two" => 2 ,"three" => 3)
				  );

		$test = new PeThemeFormElementRadioUI("","",$params);
		$test = $test->get_render();

		PeThemeAsset::addScript("framework/js/admin/layout/jquery.theme.layout.module.text.js",array("jquery"),"pe_theme_layout_module_text");
		wp_enqueue_script("pe_theme_layout_module_text");
	}

	public function name() {
		return __("Text",'Pixelentity Theme/Plugin');
	}

	public function option() {
		return "Text";
	}

	public function output($conf) {
	}

}

?>
