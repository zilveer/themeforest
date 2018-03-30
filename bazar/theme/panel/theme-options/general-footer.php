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

function yit_submenu_tabs_theme_option_general_footer( $fields ) {
    $fields[15] = array(
        'id'      => 'footer-layout',
        'type'    => 'sidebarlayout',
        'name'    => __( 'Footer layout', 'yit' ),
        'desc'    => __( 'Select the footer layout for the theme.', 'yit' ),
        'std'     => apply_filters( 'yit_footer-layout_std', 'sidebar-right' ),
        'deps' => array(
            'ids' => 'footer-type',
            'values' => 'sidebar-normal,sidebar-centered'
        )
    );
    
    return $fields;
}
add_filter( 'yit_submenu_tabs_theme_option_general_footer', 'yit_submenu_tabs_theme_option_general_footer' );

function yit_footer_type_options( $array ) {
    $array['sidebar-normal'] = __( 'Sidebar + Two Columns', 'yit' );
    $array['sidebar-centered'] = __( 'Sidebar + Centered', 'yit' );
    
    return $array;
}
add_filter( 'yit_footer-type_options', 'yit_footer_type_options' );

function yit_footer_center_text_deps() {
    return array(
        'ids' => 'footer-type',
        'values' => 'centered,big-centered,sidebar-centered'
    );   
}
add_filter( 'yit_footer-center-text_deps', 'yit_footer_center_text_deps' );

function yit_footer_left_text_deps() {
    return array(
        'ids' => 'footer-type',
        'values' => 'normal,big-normal,sidebar-normal'
    );   
}
add_filter( 'yit_footer-left-text_deps', 'yit_footer_left_text_deps' );

function yit_footer_right_text_deps() {
    return array(
        'ids' => 'footer-type',
        'values' => 'normal,big-normal,sidebar-normal'
    );   
}
add_filter( 'yit_footer-right-text_deps', 'yit_footer_right_text_deps' );