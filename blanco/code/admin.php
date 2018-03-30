<?php
add_action('admin_menu', 'etheme_add_admin_menu');
function etheme_add_admin_menu() {
	global $menu,$_etheme_settings_pagehook;
	$menu['58.995'] = array( '', 'manage_options', 'separator-etheme', '', 'wp-menu-separator' );
	
	$has_update = false;
	$updateNote = '';
	
	
	if($has_update){
		$updateNote = '<span class="awaiting-mod count-1"><span class="pending-count">1</span></span>';
	}	
	
	add_menu_page(ETHEME_THEME_NAME.' Theme Options', ETHEME_THEME_NAME . $updateNote, 'manage_options', 'ethemesoptions', 'etheme_theme_settings_admin', ETHEME_CODE_CSS_URL.'/images/etheme.png', '58.996');
    $_etheme_settings_pagehook = add_submenu_page('ethemesoptions', __('Theme Settings',ETHEME_DOMAIN), __('Theme Settings',ETHEME_DOMAIN), 'manage_options', 'ethemesoptions', 'etheme_theme_settings_admin');
    add_action( 'admin_init', 'etheme_register_theme_settings' );
}
