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
 * Class to print fields in the tab Home Testimonials -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Testimonials_Typography extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_testimonials_typography
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
                'id'   => 'testimonials-text-font',
                'type' => 'typography',
                'name' => __( 'Text Testimonials font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => apply_filters( 'yit_testimonials-text-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#585555' 
                ) ),
                'style' => apply_filters( 'yit_testimonials-text-font_style', array(
					'selectors' => '.testimonial .testimonial-text p, .testimonial .testimonial-text-full p, .testimonial-page .testimonial-text-full p',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            20 => array(
                'id'   => 'testimonials-name-font',
                'type' => 'typography',
                'name' => __( 'Testimonial name font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 26,
                'std'  => apply_filters( 'yit_testimonials-name-font_std', array(
                    'size'   => 22,
                    'unit'   => 'px',
                    'family' => 'Shadows Into Light',
                    'style'  => 'regular',
                    'color'  => '#AB5705' 
                ) ),
                'style' => apply_filters( 'yit_testimonials-name-font_style', array(
					'selectors' => '.testimonial .testimonial-name a.name, .testimonial .testimonial-name p.name, .testimonial-page .testimonial-name a.name, .testimonial-page .testimonial-name p.name',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            30 => array(
                'id'   => 'testimonials-website-font',
                'type' => 'typography',
                'name' => __( 'Testimonial website font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => apply_filters( 'yit_testimonials-website-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#1C1C1C' 
                ) ),
                'style' => apply_filters( 'yit_testimonials-website-font_style', array(
					'selectors' => '.testimonial .testimonial-name a.website, .testimonial-page .testimonial-name a.website',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            40 => array(
                'id'   => 'testimonials-slider-font',
                'type' => 'typography',
                'name' => __( 'Testimonials slider font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 32,
                'std'  => apply_filters( 'yit_testimonials-slider-font_std', array(
                    'size'   => 24,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters( 'yit_testimonials-slider-font_style', array(
					'selectors' => '.testimonials-slider ul.testimonials li blockquote p a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            50 => array(
                'id'   => 'testimonials-slider-author-font',
                'type' => 'typography',
                'name' => __( 'Testimonials slider author font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => apply_filters( 'yit_testimonials-slider-author-font_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'bold',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters( 'yit_testimonials-slider-author-font_style', array(
					'selectors' => '.testimonials-slider ul.testimonials li p.meta',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            )
        );
    }
}