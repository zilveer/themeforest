<?php if(! defined('ABSPATH')){ return; }

/**
 * Add specific css class to active item
 */
add_filter( 'nav_menu_css_class', 'zn_active_item_classes', 10, 2 );
if ( ! function_exists( 'zn_active_item_classes' ) ) {
    /**
     * Add specific css class to active item
     * @param array $classes
     * @param bool  $menu_item
     * @hooked to nav_menu_css_class
     * @see functions.php
     * @return array
     */
    function zn_active_item_classes( $classes = array (), $menu_item = false ){

        // Check for single page item
        if( ! empty( $menu_item->url ) && strpos( $menu_item->url, '#' ) ){
            return $classes;
        }

        if ( in_array( 'current-menu-item', $menu_item->classes ) || in_array( 'current-menu-ancestor', $menu_item->classes ) ) {
            $classes[] = 'active';
        }
        return $classes;
    }
}
