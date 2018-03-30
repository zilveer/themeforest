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
	$fields[55] = array(
        'id'   => 'topbar',
        'type' => 'onoff',
        'name' => __( 'Show Top Bar', 'yit' ),
        'desc' => __( 'Select if you want to show the Top Bar above the header.', 'yit' ),
        'std'  => 1
    );
    
    unset( $fields[90] );
    
	$fields[100] = array(
        'id'   => 'search_type',
        'type' => 'select',
        'name' => __( 'Search type header', 'yit' ),
        'desc' => __( 'Select the type of posts you want to search with searchform of the header.', 'yit' ),
        'options' => array(
            'product' => __( 'Products', 'yit' ),
            'post' => __( 'Posts', 'yit' ),
            'any' => __( 'All', 'yit' ),
        ),
        'std'  => 'product'
    );

    $fields[110] = array(
        'id'   => 'gmap-text',
        'type' => 'text',
        'name' => __( 'Google map title', 'yit' ),
        'desc' => __( 'Type the title that appear above the Google map setted trought page settings.', 'yit' ),
        'std'  => __( 'We are...', 'yit' )
    );

    $fields[120] = array(
        'id'   => 'back-top',
        'type' => 'onoff',
        'name' => __( 'Show "Back to Top" button', 'yit' ),
        'desc' => __( 'Enable this option to show the "Back to Top" button in all pages', 'yit' ),
        'std'  => 0
    );

    $fields[130] = array(
        'id'   => 'remove_script_version',
        'type' => 'onoff',
        'name' => __( 'Remove script version', 'yit' ),
        'desc' => __( 'This is an advanced setting that allows you remove query strings from static contents (eg. the ?v=3.5.1 string from CSS and JS files). <a href="http://gtmetrix.com/remove-query-strings-from-static-resources.html">More info</a>', 'yit' ),
        'std'  => 0
    );

    $fields[140] = array(
        'id'   => 'general-lock-down-admin',
        'type' => 'onoff',
        'name' => __( 'Disable WP admin bar', 'yit' ),
        'desc' => __( 'Enable this option to disable the wordpress admin bar in frontend for user are logged in.', 'yit' ),
        'std'  => 0
    );



    return $fields;
}
add_filter( 'yit_submenu_tabs_theme_option_general_settings', 'yit_tab_general_settings' ); 

add_filter( 'yit_background-style_std', create_function( '', "return array( 'image' => 'custom', 'color' => '#ffffff' );" ) );

