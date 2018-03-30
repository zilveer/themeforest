<?php

class PeThemeViewLayoutModuleStats extends PeThemeViewLayoutModuleColumns {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Stats",'Pixelentity Theme/Plugin')
				  );
	}

	public function name() {
		return __("Stats",'Pixelentity Theme/Plugin');
	}

	public function create() {
		return "Stat";
	}

	public function force() {
		return "Stat";
	}

	public function allowed() {
		return "stat";
	}

	public function blockClass() {
		return "pe-container pe-stats";
	}

	public function tooltip() {
		return __("Use this block to add a stats module to your layout. This consists of a variable number of stat columns each holding a title, image and text content.",'Pixelentity Theme/Plugin');
	}


}

?>
