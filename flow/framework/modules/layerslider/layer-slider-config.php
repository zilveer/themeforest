<?php
	if(!function_exists('flow_elated_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function flow_elated_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'flow_elated_layerslider_overrides');
	}
?>