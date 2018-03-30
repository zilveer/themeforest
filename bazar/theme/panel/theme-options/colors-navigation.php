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
 * Add specific fields to the tab Colors -> Navigation
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_colors_navigation( $fields ) {
	
	unset( $fields[10] );
	unset( $fields[20] );
	
	
	return array_merge( $fields, array(
        	10 => array(
                'id' => 'navigation-background',
                'type' => 'colorpicker',
                'name' => __( 'Navigation background color', 'yit' ),
                'desc' => __( 'Select the background color of the navigation.', 'yit' ),
                'std' => apply_filters( 'yit_navigation-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '.boxed #nav .container, .stretched #nav',
                	'properties' => 'background-color'
				)
            ),
            20 => array(
                'id' => 'sub-navigation-background',
                'type' => 'colorpicker',
                'name' => __( 'Sub navigation background color', 'yit' ),
                'desc' => __( 'Select the background color of the sub navigation.', 'yit' ),
                'std' => apply_filters( 'yit_sub-navigation-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '#nav ul.sub-menu, #nav ul.children',
                	'properties' => 'background-color'
				)
            ),
        	30 => array(
                'id' => 'navigation-item-hover-background',
                'type' => 'colorpicker',
                'name' => __( 'Navigation items background color on hover', 'yit' ),
                'desc' => __( 'Select the background color of the navigation items on hover.', 'yit' ),
                'std' => apply_filters( 'yit_navigation-item-hover-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '#nav ul li a:hover, #nav ul li:hover a',
                	'properties' => 'background-color'
				)
            ),
        	40 => array(
                'id' => 'navigation-item-active-background',
                'type' => 'colorpicker',
                'name' => __( 'Navigation active items background color', 'yit' ),
                'desc' => __( 'Select the background color of the navigation items when they are active.', 'yit' ),
                'std' => apply_filters( 'yit_navigation-item-active-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '#nav .current-menu-item > a, #nav .current-menu-ancestor > a, #nav .current_page_ancestor > a,div#nav ul .current_page_item > a',
                	'properties' => 'background-color'
				)
            ),
	        60 => array(
	            'id' => 'nav-custom-text',
	            'type' => 'colorpicker',
	            'name' => __( 'Custom text color', 'yit' ),
	            'desc' => __( 'Select the color of the custom text.', 'yit' ),
	            'std' => apply_filters( 'yit_custom-text-highlight_std', '#a6a3a3' ),
	            'style' => array(
	               	'selectors' => '#nav .megamenu ul.sub-menu li.menu-item-custom-content p',
	               	'properties' => 'color'
				)
	        ),
	        70 => array(
	            'id' => 'nav-custom-text-highlight',
	            'type' => 'colorpicker',
	            'name' => __( 'Highlight custom text color', 'yit' ),
	            'desc' => __( 'Select the color of the custom text highlight.', 'yit' ),
	            'std' => apply_filters( 'yit_custom-text-highlight_std', '#5b5959' ),
	            'style' => array(
	               	'selectors' => '#nav .megamenu ul.sub-menu li.menu-item-custom-content span.highlight',
	               	'properties' => 'color'
				)
	        ),
        ) );
}
add_filter( 'yit_submenu_tabs_theme_option_colors_navigation', 'yit_tab_colors_navigation' );