<?php
/**
 * Envato Toolkit
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function envato_toolkit_admin_init() {
	require_once locate_template('/inc/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
	$u = new DFD_Envato_WordPress_Theme_Upgrader();
	
	if ($u->validateUserOptions() && $u->continueChecking()) {
		$u->check_update();
	}
}
