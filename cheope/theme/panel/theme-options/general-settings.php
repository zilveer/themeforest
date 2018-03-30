<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Add more items to the menu in the Theme Options panel
 * 
 * @param array $items
 * @return array
 */
function yit_item_menu_theme_options( $items ) {
    return array_merge( $items, array( 
        'panel_import' => __( 'Panel Import', 'yit' ),
        'custom_style' => __( 'Custom style', 'yit' ),
        'custom_script' => __( 'Custom script', 'yit' ),
    ) );
}
//add_filter( 'yit_admin_menu_theme_options', 'yit_item_menu_theme_options' );

function yit_item_submenu_theme_options( $items ) {
    return array_merge( $items, array( 
        'testimonials' => array(
            'settings' => __( 'Settings', 'yit' ),
            'typography' => __( 'Typography', 'yit' ),
            'colors' => __( 'Colors', 'yit' )
        )
    ) );
}
//add_filter( 'yit_admin_submenu_theme_options', 'yit_item_submenu_theme_options' );

/**
 * Add specific fields to the tab General -> Settings
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_general_settings( $fields ) {
	
    $fields[100] = array(
        'id'   => 'home-sidebar-width',
        'type' => 'select',
        'name' => __( 'Home sidebar width', 'yit' ),
        'desc' => __( 'Select the width of the sidebar in the home.', 'yit' ),
        'options' => apply_filters( 'yit_home-sidebar-width_options', array(
            '2' => __( 'Small', 'yit' ),
            '3' => __( 'Big', 'yit' )
        ) ),
        'std'  => apply_filters( 'yit_home-sidebar-width_std', '3' )
    );
	
	$fields[150] = array(
        'id'   => 'show-top-menu-login-register',
        'type' => 'onoff',
        'name' => __( 'Show Login/Register', 'yit' ),
        'desc' => __( 'Say if you want Login/Register in Top Menu.', 'yit' ),
        'std'  => apply_filters( 'yit_show-top-menu-login-register_std', true )
    );
    
    $fields[160] = array(
        'id'   => 'show-top-menu-search',
        'type' => 'onoff',
        'name' => __( 'Show Search bar', 'yit' ),
        'desc' => __( 'Say if you want Search bar in Top Menu.', 'yit' ),
        'std'  => apply_filters( 'yit_show-top-menu-search_std', true )
    );

    $fields[170] = array(
        'id'   => 'back-top',
        'type' => 'onoff',
        'name' => __( 'Show "Back to Top" button', 'yit' ),
        'desc' => __( 'Enable this option to show the "Back to Top" button in all pages', 'yit' ),
        'std'  => 0
    );

    $fields[180] = array(
        'id' => 'general-lock-down-admin',
        'type' => 'onoff',
        'name' => __( 'Disable WP admin bar', 'yit' ),
        'desc' => __( 'Enable this option to disable the wordpress admin bar in frontend for user are logged in', 'yit' ),
        'std' => apply_filters( 'yit_general-lock-down-admin_std', 'no' )
    );
    
    return $fields;
}
add_filter( 'yit_submenu_tabs_theme_option_general_settings', 'yit_tab_general_settings' );