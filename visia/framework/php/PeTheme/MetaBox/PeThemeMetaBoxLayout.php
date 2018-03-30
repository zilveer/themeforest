<?php

class PeThemeMetaBoxLayout extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript(
								"framework/js/admin/jquery.theme.metabox.layout.js",
								array(
									  'jquery'
									  ),
								"pe_theme_metabox_layout"
								);		
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_layout");
	}

	public function getClasses($type) {
		return "pe_mbox_layout ".parent::getClasses($type);
	}
}

?>
