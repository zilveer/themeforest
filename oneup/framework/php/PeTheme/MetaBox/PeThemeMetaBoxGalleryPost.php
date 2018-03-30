<?php

class PeThemeMetaBoxGalleryPost extends PeThemeMetaBox {

	protected function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.metabox.galleryPost.js",array('pe_theme_metabox'),"pe_theme_metabox_galleryPost");
	}

	public function getClasses($type) {
		return "pe_mbox_galleryPost ".parent::getClasses($type);
	}

	protected function requireAssets() {
		wp_enqueue_script("pe_theme_metabox_galleryPost");
	}


}

?>
