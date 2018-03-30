<?php

class PeThemeMetaBoxProject extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.metabox.project.js",array('pe_theme_metabox'),"pe_theme_metabox_project");
	}

	public function getClasses($type) {
		return "pe_mbox_project ".parent::getClasses($type);
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_project");
	}


}

?>
