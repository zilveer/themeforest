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
 * Add specific fields to the tab Typography -> Navigation
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_typography_navigation( $fields ) {
        return array(
            10 => array(
                'id'   => 'navigation-text-font',
                'type' => 'typography',
                'name' => __( 'Navigation font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation.', 'yit' ),
                'min'  => 10,
                'max'  => 20,
                'std'  => apply_filters( 'yit_navigation-text-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#666767' 
                ) ),
                'style' => array(
					'selectors' => '#nav ul li a,
								    li.woocommerce-MyAccount-navigation-link > a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            11 => array(
                'id'   => 'navigation-text-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Navigation font hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_navigation-text-font-hover_std', '#0d0d0d' ),
                'style' => array(
					'selectors' => '#nav ul li a:hover,
									li.woocommerce-MyAccount-navigation-link > a:hover,
									li.woocommerce-MyAccount-navigation-link.is-active > a',
					'properties' => 'color'
				)
            ),
            12 => array(
                'id'   => 'navigation-text-font-active',
                'type' => 'colorpicker',
                'name' => __( 'Navigation font active', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation active item.', 'yit' ),
                'std'  => apply_filters( 'yit_navigation-text-font-active_std', '#0d0d0d' ),
                'style' => array(
					'selectors' => '#nav .current-menu-item > a, #nav .current-menu-ancestor > a, div#nav ul .current_page_item > a',
					'properties' => 'color'
				)
            ),
            20 => array(
                'id'   => 'sub-navigation-text-font',
                'type' => 'typography',
                'name' => __( 'Sub Navigation font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation sub menus.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_sub-navigation-text-font_std', array(
                    'size'   => 11,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#666767' 
                ) ),
                'style' => array(
					'selectors' => '#nav ul li ul li a, #header #nav .megamenu ul.sub-menu li a, #nav .megamenu ul.sub-menu li li a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            21 => array(
                'id'   => 'sub-navigation-text-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Sub Navigation font hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation sub menus when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_sub-navigation-text-font-hover_std', '#0d0d0d' ),
                'style' => array(
					'selectors' => '#nav ul li ul li a:hover, #header #nav .megamenu ul.sub-menu li > a:hover, #header #nav .megamenu ul.sub-menu li li > a:hover',
					'properties' => 'color'
				)
            ),
            22 => array(
                'id'   => 'sub-navigation-text-font-active',
                'type' => 'colorpicker',
                'name' => __( 'Sub Navigation font active', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation sub menus active item.', 'yit' ),
                'std'  => apply_filters( 'yit_sub-navigation-text-font-active_std', '#0d0d0d' ),
                'style' => array(
					'selectors' => '#nav ul ul .current-menu-item > a, #nav ul ul .current-menu-ancestor > a, div#nav ul ul .current_page_item > a, #nav .megamenu ul.sub-menu li a',
					'properties' => 'color'
				)
            )
        );
}
add_filter( 'yit_submenu_tabs_theme_option_typography_navigation', 'yit_tab_typography_navigation' );