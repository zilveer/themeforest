<?php

/*
*	Custom Nav Menu
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Function to overwrite default menu Walker
 */
function blade_grve_edit_walker( $walker,$menu_id ) {
	return 'Blade_Grve_Walker_Nav_Menu_Edit';
}
add_filter( 'wp_edit_nav_menu_walker', 'blade_grve_edit_walker', 10, 2 );

include_once get_template_directory() . '/includes/custom-menu/grve-walker-nav-menu-edit.php';
include_once get_template_directory() . '/includes/custom-menu/grve-main-navigation-walker.php';

/**
 * Function to get custom menu items
 */
function blade_grve_get_custom_nav_menu_items( $menu_item ) {
	$menu_item->grve_megamenu = get_post_meta( $menu_item->ID, '_grve_menu_item_megamenu', true );
	$menu_item->grve_link_mode = get_post_meta( $menu_item->ID, '_grve_menu_item_link_mode', true );
	$menu_item->grve_link_classes = get_post_meta( $menu_item->ID, '_grve_menu_item_link_classes', true );
	$menu_item->grve_label_text = get_post_meta( $menu_item->ID, '_grve_menu_item_label_text', true );
	$menu_item->grve_icon_fontawesome = get_post_meta( $menu_item->ID, '_grve_menu_item_icon_fontawesome', true );
	$menu_item->grve_style = get_post_meta( $menu_item->ID, '_grve_menu_item_style', true );
	$menu_item->grve_color = get_post_meta( $menu_item->ID, '_grve_menu_item_color', true );
	$menu_item->grve_hover_color = get_post_meta( $menu_item->ID, '_grve_menu_item_hover_color', true );
	return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'blade_grve_get_custom_nav_menu_items' );

/**
 * Function to update custom menu items
 */
function blade_grve_update_custom_nav_menu_items( $menu_id, $menu_item_db_id, $args ) {

	$custom_nav_menu_fields = array( 'megamenu', 'link_mode', 'link_classes', 'label_text', 'icon_fontawesome', 'style', 'color', 'hover_color' );

	if( isset( $_POST['grve_menu_options'] ) ) {
		parse_str( urldecode( $_POST['grve_menu_options'] ), $parse_array );

		foreach ( $custom_nav_menu_fields as $key ){
			if( !isset( $parse_array['_grve_menu_item_' . $key . '_' . $menu_item_db_id] ) ) {
				$parse_array['_grve_menu_item_' . $key . '_' . $menu_item_db_id] = "";
			}
			$new_meta_value = $parse_array['_grve_menu_item_' . $key . '_' . $menu_item_db_id];
			$meta_key = '_grve_menu_item_' . $key;
			$meta_value = get_post_meta( $menu_item_db_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $menu_item_db_id, $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $menu_item_db_id, $meta_key, $new_meta_value );
			} elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $menu_item_db_id, $meta_key, $meta_value );
			}
		}
	}

}
add_action( 'wp_update_nav_menu_item', 'blade_grve_update_custom_nav_menu_items', 10, 3 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
