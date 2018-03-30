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
 * Class to print fields in the tab Typography -> Navigation
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Typography_Navigation extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_navigation
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return array(
            10 => array(
                'id'   => 'navigation-text-font',
                'type' => 'typography',
                'name' => __( 'Navigation font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => apply_filters( 'yit_navigation-text-font_std', array(
                    'size'   => 15,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#939191' 
                ) ),
                'style' => array(
					'selectors' => '#header div.menu > ul > li > a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            11 => array(
                'id'   => 'navigation-text-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Navigation font hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_navigation-text-font-hover_std', '#000000' ),
                'style' => array(
					'selectors' => '#header div.menu > ul > li > a:hover',
					'properties' => 'color'
				)
            ),
            12 => array(
                'id'   => 'navigation-text-font-active',
                'type' => 'colorpicker',
                'name' => __( 'Navigation font active', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation active item.', 'yit' ),
                'std'  => apply_filters( 'yit_navigation-text-font-active_std', '#000000' ),
                'style' => array(
					'selectors' => '#header div.menu > ul > li.current-menu-item > a, #header div.menu > ul > li.current-menu-ancestor > a, #header div.menu > ul > li.current_page_parent > a, #header div.menu > ul > li.current_page_ancestor > a, #header div.menu > ul > li.current_page_item > a',
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
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#939191' 
                ) ),
                'style' => array(
					'selectors' => '#header div.menu > ul ul li a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            21 => array(
                'id'   => 'sub-navigation-text-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Sub Navigation font hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation sub menus when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_sub-navigation-text-font-hover_std', '#000000' ),
                'style' => array(
					'selectors' => '#header div.menu > ul ul li a:hover',
					'properties' => 'color'
				)
            ),
            22 => array(
                'id'   => 'sub-navigation-text-font-active',
                'type' => 'colorpicker',
                'name' => __( 'Sub Navigation font active', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the navigation sub menus active item.', 'yit' ),
                'std'  => apply_filters( 'yit_sub-navigation-text-font-active_std', '#000000' ),
                'style' => array(
					'selectors' => '#header div.menu > ul ul li.current-menu-item > a, #header div.menu > ul ul .current-menu-ancestor > a',
					'properties' => 'color'
				)
            ),            
        );
    }
}