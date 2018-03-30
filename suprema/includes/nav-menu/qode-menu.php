<?php

// add custom menu fields to menu
add_filter( 'wp_setup_nav_menu_item', 'suprema_qodef_add_custom_nav_fields');

// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'suprema_qodef_update_custom_nav_fields', 10, 3 );

// edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'suprema_qodef_edit_walker', 10, 2 );


function suprema_qodef_add_custom_nav_fields( $menu_item ) {
	$menu_item->anchor = get_post_meta( $menu_item->ID, '_menu_item_anchor', true );
	$menu_item->nolink = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
	$menu_item->hide = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
	$menu_item->type_menu = get_post_meta( $menu_item->ID, '_menu_item_type_menu', true );
	$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	$menu_item->icon_pack = get_post_meta( $menu_item->ID, '_menu_item_icon_pack', true );
	$menu_item->sidebar = get_post_meta( $menu_item->ID, '_menu_item_sidebar', true );
	$menu_item->wide_position = get_post_meta( $menu_item->ID, '_menu_item_wide_position', true );
	$menu_item->background_image = get_post_meta( $menu_item->ID, '_menu_item_background_image', true );
	$menu_item->featured_icon = get_post_meta( $menu_item->ID, '_menu_item_featured_icon', true );
	return $menu_item;
   
}

/**
 * Save menu custom fields
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function suprema_qodef_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
		
	$check = array('anchor', 'nolink', 'hide', 'type_menu', 'icon', 'icon_pack', 'sidebar', 'wide_position', 'background_image', 'featured_icon');

	if(isset($_POST['qode_menu_options'])) {
		parse_str(urldecode($_POST['qode_menu_options']), $parse_array);

		foreach ( $check as $key ){
			if(!isset($parse_array['menu_item_'.$key.'_'.$menu_item_db_id])) {
				$parse_array['menu_item_'.$key.'_'.$menu_item_db_id] = "";
			}

			$value = $parse_array['menu_item_'.$key.'_'.$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $value );
		}
	}

}

/**
 * Define new Walker edit
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function suprema_qodef_edit_walker($walker,$menu_id) {

	return 'SupremaQodef_Walker_Nav_Menu_Edit_Custom';
		
}

include_once QODE_ROOT_DIR.'/includes/nav-menu/edit_custom_walker.php';

/**
 * Include custom walkers
 */
include_once QODE_ROOT_DIR.'/includes/nav-menu/top-navigation-walker.php';
include_once QODE_ROOT_DIR.'/includes/nav-menu/mobile-navigation-walker.php';
include_once QODE_ROOT_DIR.'/includes/nav-menu/fullscreen-navigation-walker.php';
include_once QODE_ROOT_DIR.'/includes/nav-menu/left-right-navigation-walker.php';
include_once QODE_ROOT_DIR.'/includes/nav-menu/sticky-navigation-walker.php';