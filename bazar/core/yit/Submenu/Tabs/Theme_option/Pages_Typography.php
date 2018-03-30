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
 * Class to print fields in the tab Pages -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Pages_Typography extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_pages_typography
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
                'id'   => 'pages-404-font',
                'type' => 'typography',
                'name' => __( 'Pages 404 font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => apply_filters( 'yit_pages-404-font_std', array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#585555' 
                ) ),
                'style' => array(
					'selectors' => '.error-404-text p',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            11 => array(
                'id'   => 'pages-404-a-font',
                'type' => 'colorpicker',
                'name' => __( 'Pages 404 links font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => apply_filters( 'yit_pages-404-a-font_std', '#B77A2B' ),
                'style' => array(
					'selectors' => '.error-404-text p a',
					'properties' => 'color'
				)
            ),
            12 => array(
                'id'   => 'pages-404-a-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Pages 404 links font "hover"', 'yit' ),
                'desc' => __( 'Choose the font color when the status is "hover".', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => apply_filters( 'yit_pages-404-a-font-hover_std', '#000000' ), 
                'style' => array(
					'selectors' => '.error-404-text p a:hover',
					'properties' => 'color'
				)
            ),
        );
    }
}