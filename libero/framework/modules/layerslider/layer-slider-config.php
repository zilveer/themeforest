<?php
	if(!function_exists('libero_mikado_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function libero_mikado_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'libero_mikado_layerslider_overrides');
	}
?>