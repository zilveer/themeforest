<?php

class PeThemeViewVideo extends PeThemeView {


	public function output($conf) {
		peTheme()->video->output($conf->data->id);
	}   
}

?>
