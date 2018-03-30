<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Register menus
 */

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'primary'   => __( 'Top Menu', 'fw' ),
) );


global $menus;
$menus = array(
    'primary' => array(
        'depth'           => 3,
        'container'       => '',
        'container_id'    => '',
        'container_class' => '',
        'menu_class'      => 'navigation-list',
        'theme_location'  => 'primary',
        'fallback_cb'     => 'fw_theme_select_menu_message',
        'link_before'     => '',
        'link_after'      => ''
    )
);


if ( ! function_exists( 'fw_theme_nav_menu' ) ) :
    /**
     * Print the nav menu
     */
    function fw_theme_nav_menu($menu_type) {
        global $menus;
        if (isset($menus[$menu_type])) {
            wp_nav_menu($menus[$menu_type]);
        }
    }
endif;


if ( ! function_exists( 'fw_theme_select_menu_message' ) ) :
    /**
     * Print the select menu message
     */
    function fw_theme_select_menu_message()
    {
        echo '<nav id="nav"><p style="color:#000;">'.__('Please go to the','fw').' <a href="' . admin_url('nav-menus.php') . '" target="_blank">'.__('Menu','fw').'</a> '.__('section, create a  menu and then select the newly created menu from the Theme Locations box from the left.','fw').'</p></nav>';
    }
endif;