<?php
	if(!function_exists('suprema_qodef_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function suprema_qodef_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'suprema_qodef_layerslider_overrides');
	}
?>