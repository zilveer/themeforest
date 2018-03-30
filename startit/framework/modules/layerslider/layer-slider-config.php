<?php
	if(!function_exists('qode_startit_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function qode_startit_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'qode_startit_layerslider_overrides');
	}
?>