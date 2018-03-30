<?php

require_once( 'settings-api.class.php' );
require_once( 'settings.config.php' );
require_once( 'settings.menu.php' );

/* Add Settings Link to Plugins Panel */
function shiftnav_plugin_settings_link( $links ) {
	$settings_link = '<a href="'.admin_url( 'themes.php?page=shiftnav-settings' ).'">Settings</a>';
	array_unshift( $links, $settings_link );
	return $links;
}
add_filter( 'plugin_action_links_'.SHIFTNAV_BASENAME, 'shiftnav_plugin_settings_link' );