<?php

class PeThemeViewGalleryImages extends PeThemeViewGallery {


	public function name() {
		return __("Gallery - Images (flare lightbox)",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Images",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();
		unset($mbox["content"]["max"]);
		return $mbox;	
	}

	public function template() {
		peTheme()->get_template_part("view","gallery-images");
	}


   
}

?>
