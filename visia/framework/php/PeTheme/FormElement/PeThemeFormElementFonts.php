<?php

class PeThemeFormElementFonts extends PeThemeFormElementSelect {
	
	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.fonts.js",array("jquery"),"pe_theme_field_fonts");
		wp_enqueue_script("pe_theme_field_fonts");
	}

	protected function addTemplateValues(&$data) {
		$this->data["options"] =& PeGlobal::$const->fonts->google->all;
		//$this->data["single"] = true;
		parent::addTemplateValues($data);
	}

	protected function getOptionList($options) {
		if (isset($this->data["value"])) {
			$value = $this->data["value"];
		} else {
			$value = $this->data["default"];
		}
		$buffer = sprintf('<option value="0">%s</option>',__("Default",'Pixelentity Theme/Plugin'));
		foreach ($options as $label=>$current) {
			$classes = $current["classes"];
			$selected = ($label == $value) ? " selected " : "";
			$alabel = esc_attr($label);
			$buffer .= sprintf('<option value="%s"%s%s>%s</option>',$alabel,$classes ? "class=\"$classes\"" : '', $selected,$alabel);
		}
		return $buffer;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldFonts();'.parent::jsInit();
	}
}
