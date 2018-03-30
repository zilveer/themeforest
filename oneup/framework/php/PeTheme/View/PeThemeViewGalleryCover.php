<?php

class PeThemeViewGalleryCover extends PeThemeViewGallery {


	public function name() {
		return __("Gallery - Cover (flare lightbox)",'Pixelentity Theme/Plugin');
	}

	public function short() {
		return __("Cover",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();
		unset($mbox["content"]["max"]);
		return $mbox;	
	}

	public function template() {
		peTheme()->get_template_part("view","gallery-cover");
	}


   
}

?>
