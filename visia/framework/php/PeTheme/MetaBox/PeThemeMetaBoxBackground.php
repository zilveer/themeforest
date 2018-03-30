<?php

class PeThemeMetaBoxBackground extends PeThemeMetaBox {

	public static function addScript() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.metabox.background.js",array('jquery'),"pe_theme_metabox_background");
	}

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeMetaBoxBackground::addScript();
	}

	public function getClasses($type) {
		return "pe_mbox_background ".parent::getClasses($type);
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_background");
	}


}

?>
