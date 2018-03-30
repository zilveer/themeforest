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
            10 => array(
                'type' => 'title',
                'name' => __( 'Cart header widget', 'yit' ),
                'desc' => __( 'Typography settings for the widget of shopping cart in header.', 'yit' )
            ),            
            20 => array(
                'id'   => 'shop-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart list font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736'
                ),
                'style' => array(
					'selectors' => '#header-cart-search .cart_wrapper ul.cart_list li a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            30 => array(
                'id' => 'shop-cart-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart list font hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on hover.', 'yit' ),
                'std' => '#995D08',
                'style' => array(
                	'selectors' => '#header-cart-search .cart_wrapper ul.cart_list li a:hover',
                	'properties' => 'color'
				)
            ),
            40 => array(
                'id'   => 'remove-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart remove font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 10,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736'
                ),
                'style' => array(
					'selectors' => '#header-cart-search .cart_wrapper .cart_list li a.remove_item',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            50 => array(
                'id' => 'remove-cart-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart remove font hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on hover.', 'yit' ),
                'std' => '#995D08',
                'style' => array(
                	'selectors' => '#header-cart-search .cart_wrapper .cart_list li a.remove_item:hover',
                	'properties' => 'color'
				)
            ),
            60 => array(
                'id'   => 'price-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart price font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#8b8b84'
                ),
                'style' => array(
					'selectors' => '#header-cart-search ul.product_list_widget li .quantity, #header-cart-search ul.product_list_widget li .amount',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            65 => array(
                'id'   => 'subtotal-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart subtotal font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736'
                ),
                'style' => array(
					'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper .total, #header-cart-search .widget_shopping_cart .cart_wrapper .total .amount',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
			70 => array(
                'id'   => 'shop-cart-empty-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart empty font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736' 
                ),
                'style' => array(
					'selectors' => '#header-cart-search .cart_wrapper .cart_list li.empty',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            80 => array(
                'id'   => 'shop-cart-button-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart button font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#ffffff' 
                ),
                'style' => array(
					'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper .buttons .button, li.product .yith-wcqv-button:not( .button ) span, li.product .yith-wcqv-button:not( .inside-thumb )',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            90 => array(
                'id'   => 'shop-search-font',
                'type' => 'typography',
                'name' => __( 'Shopping search form font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 18,
                'std'  => array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#747373' 
                ),
                'style' => array(
					'selectors' => '#header-cart-search #search_mini',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
              
            100 => array(
                'type' => 'title',
                'name' => __( 'Products page', 'yit' ),
                'desc' => __( 'Common settings for the products page.', 'yit' )
            ), 
            110 => array(
                'id'   => 'shop-title',
                'type' => 'typography',
                'name' => __( 'Product title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 36,
                'std'  => array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#3E3D3D' 
                ),
                'style' => array(
					'selectors' => 'ul.products li.product h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),
            120 => array(
                'id'   => 'shop-title-uppercase',
                'type' => 'onoff',
                'name' => __( 'Set uppercase in the product title', 'yit' ),
                'desc' => __( 'Set YES if you want to force the uppercase in the product title.', 'yit' ),
                'min'  => 7,
                'max'  => 36,
                'std'  => 0
            ), 
            130 => array(
                'id'   => 'shop-price',
                'type' => 'typography',
                'name' => __( 'Product price', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 36,
                'std'  => array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#7C7B7B' 
                ),
                'style' => array(
					'selectors' => 'ul.products li.product .price',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ), 
              
            200 => array(
                'type' => 'title',
                'name' => __( 'Product single page', 'yit' ),
                'desc' => __( 'Common settings for the detail page of a product.', 'yit' )
            ), 
            210 => array(
                'id'   => 'shop-single-title',
                'type' => 'typography',
                'name' => __( 'Product title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 54,
                'std'  => array(
                    'size'   => 30,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736' 
                ),
                'style' => array(
					'selectors' => '.product .summary h1.product_title, .yith-wcqv-main .yith-quick-view-content.woocommerce div.summary h1',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				)
            ),  
            220 => array(
                'id'   => 'shop-single-title-uppercase',
                'type' => 'onoff',
                'name' => __( 'Set uppercase in the product title', 'yit' ),
                'desc' => __( 'Set YES if you want to force the uppercase in the product title.', 'yit' ),
                'std'  => 0
            ),  
            230 => array(
                'id'   => 'shop-single-price',
                'type' => 'typography',
                'name' => __( 'Product price', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 54,
                'std'  => array(
                    'size'   => 24,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736'
                ),
                'style' => array(
                    'selectors' => '.product-box .price',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),
            240 => array(
                'id'   => 'shop-single-labels',
                'type' => 'typography',
                'name' => __( 'Product variations label', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 54,
                'std'  => array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#373736'
                ),
                'style' => array(
                    'selectors' => 'div.product-box label, .qnt_label',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),
            241 => array(
                'id'   => 'shop-single-labels-active-dropdown',
                'type' => 'typography',
                'name' => __( 'Product variations active dropdown option', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 54,
                'std'  => array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'bold',
                    'color'  => '#bcbbbb'
                ),
                'style' => array(
                    'selectors' => '.variations .select-wrapper a.sbSelector, .variations .select-wrapper select, .variations .sbHolder a.sbSelector, .variations .attribute-options select',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),
            242 => array(
                'id'   => 'shop-single-labels-dropdown',
                'type' => 'typography',
                'name' => __( 'Product variations dropdown list options', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 7,
                'max'  => 54,
                'std'  => array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#bcbbbb'
                ),
                'style' => array(
                    'selectors' => '.variations .select-wrapper .sbOptions li a, .variations .sbHolder .sbOptions li a',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),
        );
    }
}