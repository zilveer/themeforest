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
 * Class to print fields in the tab Typography -> Sidebar 
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Typography_Sidebar extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_sidebar
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
        	/* === START FONT === */            
            10 => array(
                'id'   => 'sidebar-title-font',
                'type' => 'typography',
                'name' => __( 'Sidebar title font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_sidebar-title-font_std', array(
                    'size'   => 20,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters( 'yit_sidebar-title-font_style', array(
					'selectors' => '.sidebar h1, .sidebar h2, .sidebar h3, .sidebar h4, .sidebar h5, .sidebar h6',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            20 => array(
                'id'   => 'sidebar-content-font',
                'type' => 'typography',
                'name' => __( 'Sidebar content font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_sidebar-content-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#585555' 
                ) ),
                'style' => array(
					'selectors' => apply_filters( 'yit_sidebar-content-font_selectors', '.sidebar p, .sidebar li, .sidebar div' ),
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            30 => array(
                'id'   => 'sidebar-links-font',
                'type' => 'colorpicker',
                'name' => __( 'Sidebar links font', 'yit' ),
                'desc' => __( 'Select the type to use for the sidebar links.', 'yit' ),
                'std'  => apply_filters( 'yit_sidebar-links-font_std', '#b77a2b' ),
                'style' => array(
					'selectors' => apply_filters( 'yit_sidebar-links-font_selectors', '.sidebar a' ),
					'properties' => 'color'
				)
            ),
            31 => array(
                'id'   => 'sidebar-links-hover-font',
                'type' => 'colorpicker',
                'name' => __( 'Sidebar links font "hover"', 'yit' ),
                'desc' => __( 'Select the type to use for the sidebar links when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_sidebar-links-hover-font_std', '#030303' ),
                'style' => array(
					'selectors' => apply_filters( 'yit_sidebar-links-hover-font_selectors', '.sidebar a:hover' ),
					'properties' => 'color'
				)
            ),
        );
    }
}