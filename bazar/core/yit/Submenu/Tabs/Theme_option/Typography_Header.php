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
 * Class to print fields in the tab Typography -> Header
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Typography_Header extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_header
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
            /* === LOGO FONT === */
            10 => array(
                'id'   => 'logo-font',
                'type' => 'typography',
                'name' => __( 'Logo font', 'yit' ),
                'desc' => __( 'Select the type to use for the logo font. ', 'yit' ),
                'min'  => 1,
                'max'  => 80,
                'std'  => apply_filters( 'yit_logo-font_std', array(
                    'size'   => 40,
                    'unit'   => 'px',
                    'family' => 'Montez',
                    'style'  => 'regular',
                    'color'  => '#1d1d1d' 
                ) ),
                'style' => apply_filters( 'yit_logo-font_style', array(
					'selectors' => '#header #logo #textual',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            11 => array(
                'id'   => 'logo-highlight-font',
                'type' => 'typography',
                'name' => __( 'Logo font highlight', 'yit' ),
                'desc' => __( 'Select the type to use for the logo font highlight.', 'yit' ),
                'min'  => 1,
                'max'  => 80,
                'std'  => apply_filters( 'yit_logo-highlight-font_std', array(
                    'size'   => 40,
                    'unit'   => 'px',
                    'family' => 'Montez',
                    'style'  => 'regular',
                    'color'  => '#ac670c' 
                ) ),
                'style' => array(
					'selectors' => '#header #logo #textual span',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            12 => array(
                'id'   => 'logo-tagline-font',
                'type' => 'typography',
                'name' => __( 'Tagline font', 'yit' ),
                'desc' => __( 'Select the type to use for the tagline below the logo.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_logo-tagline-font_std', array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#1d1d1d' 
                ) ),
                'style' => array(
					'selectors' => '#header #logo #tagline',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            /* == END LOGO FONT === */
        );
    }
}