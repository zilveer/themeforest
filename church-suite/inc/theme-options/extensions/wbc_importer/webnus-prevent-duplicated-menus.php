<?php

// this file called ajax in field_wbc_importer.js
function webnus_prevent_duplicated_menus() {
	$menus = get_terms( 'nav_menu' );
	$menus_name = array();
	foreach ( $menus as $menu ) :
		$menus_name[] = $menu->name;
	endforeach;

	foreach ( $menus_name as $menu_name_to_delete ) :
		if ( ! is_nav_menu( $menu_name_to_delete ) ) continue;
		$deletion = wp_delete_nav_menu( $menu_name_to_delete );
	endforeach;
}

add_action( 'wp_ajax_webnus_prevent_duplicated_menus', 'webnus_prevent_duplicated_menus' );