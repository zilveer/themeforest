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
 * Class to print fields in the tab Shop -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Typography extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_typography
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
            20 => array(
                'id'   => 'shop-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart list font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#ffffff'
                ),
                'style' => array(
					'selectors' => '#header-sidebar .cart_wrapper ul.cart_list li a, #header-sidebar ul.product_list_widget li .amount, #header-sidebar ul.product_list_widget li .quantity, #header-sidebar .widget_shopping_cart .cart_wrapper .total, #header-sidebar .widget_shopping_cart .cart_wrapper .total .amount',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            30 => array(
                'id' => 'shop-cart-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart list font hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on hover.', 'yit' ),
                'std' => '#ffffff',
                'style' => array(
                	'selectors' => '#header-sidebar .cart_wrapper ul.cart_list li a:hover',
                	'properties' => 'color'
				)
            ),
            40 => array(
                'id'   => 'remove-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart remove font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 10,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#B9B8B8'
                ),
                'style' => array(
					'selectors' => '#header-sidebar .cart_wrapper .cart_list li a.remove_item',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            50 => array(
                'id' => 'remove-cart-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart remove font hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on hover.', 'yit' ),
                'std' => '#ffffff',
                'style' => array(
                	'selectors' => '#header-sidebar .cart_wrapper .cart_list li a.remove_item:hover',
                	'properties' => 'color'
				)
            ),
            60 => array(
                'id'   => 'price-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart price font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#ffffff'
                ),
                'style' => array(
					'selectors' => '#header .cart_wrapper .cart_list span.quantity',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
			70 => array(
                'id'   => 'shop-cart-empty-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart empty font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#ffffff' 
                ),
                'style' => array(
					'selectors' => '#header-sidebar .cart_wrapper .cart_list li.empty',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            )
        );
    }
}