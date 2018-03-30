<?php

class PeThemeMetaBoxSlider extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript(
								"framework/js/admin/jquery.theme.metabox.slider.js",
								array(
									  'jquery'
									  ),
								"pe_theme_metabox_slider"
								);		
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_slider");
	}

	public function getClasses($type) {
		return "pe_mbox_slider ".parent::getClasses($type);
	}
}

?>
