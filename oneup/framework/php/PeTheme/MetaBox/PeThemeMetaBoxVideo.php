<?php

class PeThemeMetaBoxVideo extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.metabox.video.js",array('pe_theme_metabox'),"pe_theme_metabox_video");
	}

	public function getClasses($type) {
		return "pe_mbox_video ".parent::getClasses($type);
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_video");
	}


}

?>
