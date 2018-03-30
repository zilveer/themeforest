<?php

add_action( 'wp_edit_nav_menu_walker', 'wpgrade_edit_nav_menu_walker' , 10, 2 );
add_action( 'wp_update_nav_menu_item', 'wpgrade_update_nav_menu_item' , 10, 3 );

/**
* Provide another admin menu walker class.
* 
* @param string $walker
* @return string
*/
function wpgrade_edit_nav_menu_walker( $walker ) {
	
   // swap the menu walker class only if it's the default wp class (just as a safety measure)
   if ( $walker === 'Walker_Nav_Menu_Edit' ) {
	   require_once(wpgrade::themefilepath('theme-utilities/includes/WPGrade_Bucket_Walker_Nav_Menu_Edit.php'));
	   $walker = 'WPGrade_Bucket_Walker_Nav_Menu_Edit';
   }
   return $walker;
}


/**
* Save the menu item meta (posts of type "menu_item").
* 
* 
* @param type $menu_id
* @param type $menu_item_id
* @param type $args
*/
function wpgrade_update_nav_menu_item($menu_id, $menu_item_id, $args) {

   if ( isset( $_POST[ "wpgrade_megamenu_layout_$menu_item_id" ] ) ) {
	   update_post_meta( $menu_item_id, 'wpgrade_megamenu_layout', $_POST[ "wpgrade_megamenu_layout_$menu_item_id" ] );
   } else {
	   delete_post_meta( $menu_item_id, 'wpgrade_megamenu_layout' );
   }
}