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
 * Class to print fields in the tab Typography -> General
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Typography_General extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_general
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
            1 => array(
                'id'   => 'general-font',
                'type' => 'typography',
                'name' => __( 'General font', 'yit' ),
                'desc' => __( 'Select the general font used in the theme. ', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_general-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#585555' 
                ) ),
                'style' => apply_filters( 'yit_general-font_style', array( // <-- by piero: aggiunto filtro per poter aggiungere altri selettori in theme
					'selectors' => 'p, li, address, dd, blockquote, td, th, .paragraph-links a, a.text-color',     // <-- by antonino: ho aggiunto a.text-color e .paragraph-links a, per far in modo di dare il stess colore del testo ai link che hanno classe "text-color"
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            2 => array(
                'id'   => 'links-font',
                'type' => 'colorpicker',
                'name' => __( 'Links', 'yit' ),
                'desc' => __( 'Select the type to use for the links. ', 'yit' ),
                'std'  => apply_filters( 'yit_links-font_std', '#b77a2b' ),
                'style' => apply_filters( 'yit_links-font_style', array( // <-- by piero: aggiunto filtro per poter aggiungere altri selettori in theme
					'selectors' => 'a, a.text-color:hover',
					'properties' => 'color'
				) )
            ),
            3 => array(
                'id'   => 'links-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Links hover', 'yit' ),
                'desc' => __( 'Select the type to use for the links when the status is "hover". ', 'yit' ),
                'std'  => apply_filters( 'yit_links-font-hover_std', '#030303' ),
                'style' => apply_filters( 'yit_links-font-hover_style', array(
					'selectors' => 'a:hover',
					'properties' => 'color'
				) )
            ),
            4 => array(
                'id'   => 'breadcrumb-font',
                'type' => 'typography',
                'name' => __( 'Breadcrumb font', 'yit' ),
                'desc' => __( 'Select the type to use for the breadcrumb. ', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_breadcrumb-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#838383' 
                ) ),
                'style' => apply_filters( 'yit_breadcrumb-font_style', array(
					'selectors' => '#yit-breadcrumb a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            5 => array(
                'id'   => 'breadcrumb-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Breadcrumb color hover', 'yit' ),
                'desc' => __( 'Select the type to use for the breadcrumb when the status is "hover". ', 'yit' ),
                'std'  => apply_filters( 'yit_breadcrumb-font-hover_std', '#535353' ),
                'style' => apply_filters( 'yit_breadcrumb-font-hover_style', array(
					'selectors' => '#yit-breadcrumb a:hover',
					'properties' => 'color'
				) )
            ),
            6 => array(
                'id'   => 'breadcrumb-font-current',
                'type' => 'colorpicker',
                'name' => __( 'Breadcrumb color current item', 'yit' ),
                'desc' => __( 'Select the color to use for the current item in breadcrumb. ', 'yit' ),
                'std'  => apply_filters( 'yit_breadcrumb-font-current_std', '#a96605' ),
                'style' => apply_filters( 'yit_breadcrumb-font-current_style', array(
					'selectors' => '#yit-breadcrumb a.current',
					'properties' => 'color'
				) )
            ),
            /* === HEADINGS FONT === */
            10 => array(
                'id'   => 'h1-font',
                'type' => 'typography',
                'name' => __( 'Headings 1 font', 'yit' ),
                'desc' => __( 'Select the type to use for the h1. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_h1-font_std', array(
                    'size'   => 30,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => 'h1, h1 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            20 => array(
                'id'   => 'h2-font',
                'type' => 'typography',
                'name' => __( 'Headings 2 font', 'yit' ),
                'desc' => __( 'Select the type to use for the h2. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_h2-font_std', array(
                    'size'   => 22,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => 'h2, h2 a, a.shipping-calculator-button',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            30 => array(
                'id'   => 'h3-font',
                'type' => 'typography',
                'name' => __( 'Headings 3 font', 'yit' ),
                'desc' => __( 'Select the type to use for the h3. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_h3-font_std', array(
                    'size'   => 20,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => 'h3, h3 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            40 => array(
                'id'   => 'h4-font',
                'type' => 'typography',
                'name' => __( 'Headings 4 font', 'yit' ),
                'desc' => __( 'Select the type to use for the h4. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_h4-font_std', array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => 'h4, h4 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            50 => array(
                'id'   => 'h5-font',
                'type' => 'typography',
                'name' => __( 'Headings 5 font', 'yit' ),
                'desc' => __( 'Select the type to use for the h5. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_h5-font_std', array(
                    'size'   => 15,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => 'h5, h5 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            60 => array(
                'id'   => 'h6-font',
                'type' => 'typography',
                'name' => __( 'Headings 6 font', 'yit' ),
                'desc' => __( 'Select the type to use for the h6. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_h6-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => 'h6, h6 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            61 => array(
                'id'   => 'slogan-font',
                'type' => 'typography',
                'name' => __( 'Slogan font', 'yit' ),
                'desc' => __( 'Select the type to use for the slogan. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_slogan-font_std', array(
                    'size'   => 28,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters( 'yit_slogan-font_style', array(
					'selectors' => '#page-meta h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            62 => array(
                'id'   => 'sub-slogan-font',
                'type' => 'typography',
                'name' => __( 'Sub Slogan font', 'yit' ),
                'desc' => __( 'Select the type to use for the sub slogan. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_sub-slogan-font_std', array(
                    'size'   => 24,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#C86F06' 
                ) ),
                'style' => apply_filters( 'yit_sub-slogan-font_style', array(
					'selectors' => '#page-meta h4',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            /* === END HEADINGS FONT === */
            /* === SPECIAL FONTS === */
            70 => array(
                'id'   => 'special-font',
                'type' => 'typography',
                'name' => __( 'Special font', 'yit' ),
                'desc' => __( 'Select the type to use for the special font. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_special-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Shadows Into Light',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => array(
					'selectors' => '.special-font',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            80 => array(
                'id' => 'highlight-color',
                'type' => 'colorpicker',
                'name' => __( 'Highlight', 'yit' ),
                'desc' => __( 'Select the color to highlight words.', 'yit' ),
                'std' => apply_filters( 'yit_highlight-color_std', '#A05F02' ),
                'style' => apply_filters( 'yit_highlight-color_style', array(
                	'selectors' => 'h1 span, h2 span, h3 span, h4 span, h5 span, h6 span',
                	'properties' => 'color'
				) )
            ),
        );
    }
}