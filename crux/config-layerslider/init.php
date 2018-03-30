<?php
/**
 * Configure LayerSlider WordPress Plugin.
 *
 * @package StagFramework
 * @subpackage Crux
 */

/**
 * Disable LayerSlider.
 *
 * @return void
 */
function stag_layerslider_config() {

    // Disable auto-updates
    $GLOBALS['lsAutoUpdateBox'] = false;
}
add_action( 'layerslider_ready', 'stag_layerslider_config' );
