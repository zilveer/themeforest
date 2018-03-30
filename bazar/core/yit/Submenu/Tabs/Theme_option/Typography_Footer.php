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
 * Class to print fields in the tab Typography -> Footer
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Typography_Footer extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_footer
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
                'id'   => 'footer-font',
                'type' => 'typography',
                'name' => __( 'Footer font', 'yit' ),
                'desc' => __( 'Select the type to use for the footer.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_footer-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#585555' 
                ) ),
                'style' => apply_filters( 'yit_footer-font_style', array(
					'selectors' => '#footer, #footer p, #footer li',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            11 => array(
                'id'   => 'footer-links-font',
                'type' => 'colorpicker',
                'name' => __( 'Footer links font', 'yit' ),
                'desc' => __( 'Select the type to use for the footer links.', 'yit' ),
                'std'  => apply_filters( 'yit_footer-links-font_std', '#b77a2b' ),
                'style' => apply_filters( 'yit_footer-links-font_style', array(
					'selectors' => '#footer a',
					'properties' => 'color'
				) )
            ),
            12 => array(
                'id'   => 'footer-links-hover-font',
                'type' => 'colorpicker',
                'name' => __( 'Footer links font "hover"', 'yit' ),
                'desc' => __( 'Select the type to use for the footer links when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_footer-links-hover-font_std', '#030303' ),
                'style' => apply_filters( 'yit_footer-links-hover-font_style', array(
					'selectors' => '#footer a:hover',
					'properties' => 'color'
				) )
            ),
            13 => array(
                'id'   => 'footer-title-font',
                'type' => 'typography',
                'name' => __( 'Footer titles', 'yit' ),
                'desc' => __( 'Select the type to use for the footer.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_footer-title-font_std', array(
                    'size'   => 20,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters( 'yit_footer-title-font_style', array(
					'selectors' => '#footer h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            20 => array(
                'id'   => 'copyright-font',
                'type' => 'typography',
                'name' => __( 'Copyright font', 'yit' ),
                'desc' => __( 'Select the type to use for the copyright in the footer.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_copyright-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#585555' 
                ) ),
                'style' => apply_filters( 'yit_copyright-font_style', array(
					'selectors' => '#copyright, #copyright p, #copyright a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            21 => array(
                'id'   => 'copyright-links-font',
                'type' => 'colorpicker',
                'name' => __( 'Copyright links font', 'yit' ),
                'desc' => __( 'Select the type to use for the copyright links.', 'yit' ),
                'std'  => apply_filters( 'yit_copyright-links-font_std', '#b77a2b' ),
                'style' => apply_filters( 'yit_copyright-links-font_style', array(
					'selectors' => '#copyright a',
					'properties' => 'color'
				) )
            ),
            22 => array(
                'id'   => 'copyright-links-hover-font',
                'type' => 'colorpicker',
                'name' => __( 'Copyright links font "hover"', 'yit' ),
                'desc' => __( 'Select the type to use for the copyright links when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_copyright-links-hover-font_std', '#030303' ),
                'style' => apply_filters( 'yit_copyright-links-hover-font_style', array(
					'selectors' => '#copyright a:hover',
					'properties' => 'color'
				) )
            ),
        );
    }
}