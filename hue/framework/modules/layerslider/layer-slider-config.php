<?php
if(!function_exists('hue_mikado_layerslider_overrides')) {
	/**
	 * Disables Layer Slider auto update box
	 */
	function hue_mikado_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'hue_mikado_layerslider_overrides');
}
?>