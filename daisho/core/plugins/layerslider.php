<?php
/**
 * Disables LayerSlider auto-updates.
 */
function flow_layerslider_overrides() {
	$GLOBALS['lsAutoUpdateBox'] = false;
}
add_action( 'layerslider_ready', 'flow_layerslider_overrides' );
