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
 * Class to print fields in the tab Home Shortcodes -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shortcodes_Tabs extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_blog_typography
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
                'id'   => 'tabs',
                'type' => 'title',
                'name' => __( 'Tabs', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the tabs.', 'yit' )                
            ),
            20 => array(
                'id'   => 'tabs-title',
                'type' => 'typography',
                'name' => __( 'Tabs title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_tabs-title_std', array(
                    'size'   => 16,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#0C243D' 
                ) ),
                'style' => apply_filters('yit_tabs-title_style',array(
					'selectors' => '.tabs-container ul.tabs li h4 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            30 => array(
                'id'   => 'tabs-title-hover',
                'type' => 'colorpicker',
                'name' => __( 'Tabs title hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title of tabs on hover.', 'yit' ),
                'std'  => apply_filters( 'yit_tabs-title-hover_std', '#000000' ),
                'style' => apply_filters('yit_tabs-title-hover_style', array(
					'selectors' => '.tabs-container ul.tabs li h4 a:hover',
					'properties' => 'color'
				))
            ),
            40 => array(
                'id'   => 'tabs-title-current',
                'type' => 'colorpicker',
                'name' => __( 'Tabs title current', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title of tabs when is active.', 'yit' ),
                'std'  => apply_filters( 'yit_tabs-title-current_std', '#0C243D' ),
                'style' => apply_filters('yit_tabs-title-current_style', array(
					'selectors' => '.tabs-container ul.tabs li.current h4 a',
					'properties' => 'color'
				))
            ),
            50 => array(
                'id'   => 'price-table',
                'type' => 'title',
                'name' => __( 'Price table', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the price table.', 'yit' )                
            ),
            60 => array(
                'id'   => 'prices-table-special-title',
                'type' => 'typography',
                'name' => __( 'Price table special title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_prices-table-special-title_std', array(
                    'size'   => 17,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'extra-bold',
                    'color'  => '#ffffff' 
                ) ),
                'style' => apply_filters('yit_prices-table-special-title_style',array(
					'selectors' => '.pricing_box.large .header h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            70 => array(
                'id'   => 'prices-table-normal-title',
                'type' => 'typography',
                'name' => __( 'Price table normal title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_prices-table-normal-title_std', array(
                    'size'   => 17,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'extra-bold',
                    'color'  => '#585555' 
                ) ),
                'style' => apply_filters('yit_prices-table-normal-title_style',array(
					'selectors' => '.pricing_box .header h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            80 => array(
                'id'   => 'prices-table-price',
                'type' => 'typography',
                'name' => __( 'Price table price', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_prices-table-price_std', array(
                    'size'   => 17,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'bold',
                    'color'  => '#585555' 
                ) ),
                'style' => apply_filters('yit_prices-table-price_style',array(
					'selectors' => '.pricing_box h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            90 => array(
                'id'   => 'prices-table-button',
                'type' => 'typography',
                'name' => __( 'Price table button', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_prices-table-button_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#3f4950' 
                ) ),
                'style' => apply_filters('yit_prices-table-button_style',array(
					'selectors' => '.pricing_box p.button a, .pricing_box p.button a:hover',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            100 => array(
                'id'   => 'prices-table-text',
                'type' => 'typography',
                'name' => __( 'Price table text', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_prices-table-text_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#808080' 
                ) ),
                'style' => apply_filters('yit_prices-table-text_style',array(
					'selectors' => '.pricing_box, .pricing_box p, .pricing_box ul li',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
        );
    }
}