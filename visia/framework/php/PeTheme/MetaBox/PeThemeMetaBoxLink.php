<?php

class PeThemeMetaBoxLink extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript(
								"framework/js/admin/jquery.theme.metabox.link.js",
								array(
									  'jquery'
									  ),
								"pe_theme_metabox_link"
								);		
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_link");
	}

	public function getClasses($type) {
		return "pe_mbox_link ".parent::getClasses($type);
	}
}

?>
