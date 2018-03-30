<?php

class PeThemeMetaBoxConditional extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript(
								"framework/js/admin/jquery.theme.metabox.conditional.js",
								array(
									  'jquery',
									  'json2'
									  ),
								"pe_theme_metabox_conditional"
								);		
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_conditional");
	}

	public function getClasses($type) {
		return "pe_mbox_conditional ".parent::getClasses($type);
	}
}

?>
