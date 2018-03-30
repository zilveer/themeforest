<?php

class PeThemeFormElementSelectSlider extends PeThemeFormElementSelect {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.selectSlider.js",array(),"pe_theme_field_selectSlider");
		wp_enqueue_script("pe_theme_field_selectSlider");
	}
	
	protected function jsInit() {
		return 'jQuery("#[ID]").peFieldSelectSlider();'.parent::jsInit();
	}

}

?>
