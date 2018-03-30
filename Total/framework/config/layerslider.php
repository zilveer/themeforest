<?php
/**
 * LayerSlider Config
 *
 * @package Total WordPress Theme
 * @subpackage Configs
 * @version 3.4.0
 */

// Remove purchase notice on plugins page
if ( defined( 'LS_PLUGIN_BASE' ) && ! get_option( 'layerslider-authorized-site', null ) ) {
	remove_action( 'after_plugin_row_'.LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
}