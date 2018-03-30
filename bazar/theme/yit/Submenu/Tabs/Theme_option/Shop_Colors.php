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
 * Class to print fields in the tab Shop -> Colors
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Colors extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_colors
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
        	/* === START COLORS === */     
            5 => array(
                'type' => 'title',
                'name' => __( 'Cart header widget', 'yit' ),
                'desc' => __( 'Color settings for the widget of shopping cart in header.', 'yit' )
            ),          
        	10 => array(
                'id' => 'shop-cart-background',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart background', 'yit' ),
                'desc' => __( 'Select the color of shop cart on topbar background.', 'yit' ),
                'std' => '#c58408',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_control',
                	'properties' => 'background-color'
				)
            ),
        	15 => array(
                'id' => 'shop-cart-background-empty',
                'type' => 'colorpicker',
                'name' => __( 'Empty shopping cart background', 'yit' ),
                'desc' => __( 'Select the color of empty shop cart on topbar background.', 'yit' ),
                'std' => '#afacac',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_control_empty',
                	'properties' => 'background-color'
				)
            ),
            20 => array(
                'id' => 'shop-cart-border',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart button border', 'yit' ),
                'desc' => __( 'Select the color of border of shop cart on topbar.', 'yit' ),
                'std' => '#e0dfdf',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_control',
                	'properties' => 'border-color'
				)
            ),
            30 => array(
                'id' => 'shop-cart-list-background',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart list background', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on topbar background.', 'yit' ),
                'std' => '#ffffff',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper',
                	'properties' => 'background-color'
				)
            ),
            31 => array(
                'id' => 'shop-cart-list-border',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart list border', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on topbar background.', 'yit' ),
                'std' => '#dcdcdc',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper',
                	'properties' => 'border-color'
				)
            ),
            35 => array(
                'id' => 'shop-cart-button-checkout-color',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart checkout button color', 'yit' ),
                'desc' => __( 'Select the color of shop cart checkout button.', 'yit' ),
                'std' => '#333333',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper .buttons .button.checkout,#tab-reviews div.reply a.button, li.product .yith-wcqv-button:not( .button ) span, li.product .yith-wcqv-button:not( .inside-thumb )',
                	'properties' => 'background-color'
				)
            ),
            36 => array(
                'id' => 'shop-cart-button-checkout-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart checkout button hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart checkout button hover.', 'yit' ),
                'std' => '#828282',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper .buttons .button.checkout:hover, #tab-reviews div.reply a.button:hover, li.product .yith-wcqv-button:not( .button ) span, li.product .yith-wcqv-button:not( .inside-thumb )',
                	'properties' => 'background-color'
				)
            ),
            37 => array(
                'id' => 'shop-cart-button-color',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart button color', 'yit' ),
                'desc' => __( 'Select the color of shop cart button.', 'yit' ),
                'std' => '#c58408',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper .buttons .button, .hidden-title-form button, .create-wishlist-button, .wishlist-search-button, .submit-wishlist-changes, li.product .yith-wcqv-button:not( .button ) span, li.product .yith-wcqv-button:not( .inside-thumb )',
                	'properties' => 'background-color'
				)
            ),
            38 => array(
                'id' => 'shop-cart-button-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart button hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart button hover.', 'yit' ),
                'std' => '#e79c0c',
                'style' => array(
                	'selectors' => '#header-cart-search .widget_shopping_cart .cart_wrapper .buttons .button:hover, .hidden-title-form button:hover, .create-wishlist-button:hover, .wishlist-search-button:hover, .submit-wishlist-changes:hover, li.product .yith-wcqv-button:not( .button ) span:hover, li.product .yith-wcqv-button:not( .inside-thumb ):hover',
                	'properties' => 'background-color'
				)
            ),
            70 => array(
                'type' => 'title',
                'name' => __( 'Grid View (With Hover style)', 'yit' ),
                'desc' => __( 'Colors for the grid view, with style "With Hover".', 'yit' )
            ),
            80 => array(
                'id' => 'shop-grid-add-to-cart',
                'type' => 'colorpicker',
                'name' => __( 'Bg color of button add to cart', 'yit' ),
                'desc' => __( 'Select the background color of add to cart button.', 'yit' ),
                'std' => '#333333',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.with-hover .product-actions .add_to_cart_button, ul.products li.product.grid.with-hover .product-actions .view-options',
                	'properties' => 'background-color'
				)                   
            ),  
            90 => array(
                'id' => 'shop-grid-add-to-cart-hover',
                'type' => 'colorpicker',
                'name' => __( 'Bg color of button add to cart (on mouse hover)', 'yit' ),
                'desc' => __( 'Select the background color of add to cart button, on mouse over.', 'yit' ),
                'std' => '#555',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.with-hover .product-actions .add_to_cart_button:hover, ul.products li.product.grid.with-hover .product-actions .view-options:hover',
                	'properties' => 'background-color'
				)
            ),
            100 => array(
                'id' => 'shop-grid-add-to-cart-color',
                'type' => 'colorpicker',
                'name' => __( 'Text color of button add to cart', 'yit' ),
                'desc' => __( 'Select the text color of add to cart button.', 'yit' ),
                'std' => '#f7f7f7',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.with-hover .product-actions .add_to_cart_button, ul.products li.product.grid.with-hover .product-actions .view-options, .hidden-title-form button',
                	'properties' => 'color'
				)
            ),
            105 => array(
                'id' => 'shop-grid-add-to-cart-color-hover',
                'type' => 'colorpicker',
                'name' => __( 'Text color of button add to cart (on mouse hover)', 'yit' ),
                'desc' => __( 'Select the text color of add to cart button, on mouse over.', 'yit' ),
                'std' => '#f7f7f7',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.with-hover .product-actions .add_to_cart_button:hover, ul.products li.product.grid.with-hover .product-actions .view-options:hover, .hidden-title-form button:hover',
                	'properties' => 'color'
				)
            ),
            110 => array(
                'type' => 'title',
                'name' => __( 'List View', 'yit' ),
                'desc' => __( 'Colors for the list view.', 'yit' )
            ),
            120 => array(
                'id' => 'shop-list-button-bg',
                'type' => 'colorpicker',
                'name' => __( 'Color background read more button', 'yit' ),
                'desc' => __( 'Select the background color of read more button.', 'yit' ),
                'std' => '#333333',
                'style' => array(
                	'selectors' => 'ul.products li.product.list .description .view-detail',
                	'properties' => 'background-color'
				)
            ), 
            130 => array(
                'id' => 'shop-list-button-text',
                'type' => 'colorpicker',
                'name' => __( 'Color text read more button', 'yit' ),
                'desc' => __( 'Select the text color of read more button.', 'yit' ),
                'std' => '#F7F7F7',
                'style' => array(
                	'selectors' => 'ul.products li.product.list .description .view-detail',
                	'properties' => 'color'
				)
            ),  
            140 => array(
                'id' => 'shop-list-button-bg-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color background read more button (hover)', 'yit' ),
                'desc' => __( 'Select the background color of read more button, in hover.', 'yit' ),
                'std' => '#555555',
                'style' => array(
                	'selectors' => 'ul.products li.product.list .description .view-detail:hover',
                	'properties' => 'background-color'
				)
            ), 
            150 => array(
                'id' => 'shop-list-button-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color text read more button (hover)', 'yit' ),
                'desc' => __( 'Select the text color of read more button, in hover.', 'yit' ),
                'std' => '#F7F7F7',
                'style' => array(
                	'selectors' => 'ul.products li.product.list .description .view-detail:hover',
                	'properties' => 'color'
				)
            ),
            160 => array(
                'type' => 'title',
                'name' => __( 'Classic Layout', 'yit' ),
                'desc' => __( 'Colors for the classic layout.', 'yit' )
            ),
            170 => array(
                'id' => 'shop-classic-button-details-bg',
                'type' => 'colorpicker',
                'name' => __( 'Color background of details button', 'yit' ),
                'desc' => __( 'Select the background color of details button.', 'yit' ),
                'std' => '#6f6e6e',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.details',
                	'properties' => 'background-color'
				)
            ), 
            180 => array(
                'id' => 'shop-classic-button-details-text',
                'type' => 'colorpicker',
                'name' => __( 'Color text of details button', 'yit' ),
                'desc' => __( 'Select the text color of details button.', 'yit' ),
                'std' => '#fff',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.details',
                	'properties' => 'color'
				)
            ), 
            190 => array(
                'id' => 'shop-classic-button-details-bg-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color background of details button (in hover)', 'yit' ),
                'desc' => __( 'Select the background color of details button, when mouse over.', 'yit' ),
                'std' => '#535353',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.details:hover',
                	'properties' => 'background-color'
				)
            ), 
            200 => array(
                'id' => 'shop-classic-button-details-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color text of details button (in hover)', 'yit' ),
                'desc' => __( 'Select the text color of details button, when mouse over.', 'yit' ),
                'std' => '#fff',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.details:hover',
                	'properties' => 'color'
				)
            ), 
            210 => array(
                'id' => 'shop-classic-button-add-to-cart-bg',
                'type' => 'colorpicker',
                'name' => __( 'Color background of add to cart button', 'yit' ),
                'desc' => __( 'Select the background color of add to cart button.', 'yit' ),
                'std' => '#dc8323',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.add_to_cart_button, ul.products li.product.grid.classic .product-actions a.view-options',
                	'properties' => 'background-color'
				)                   
            ), 
            220 => array(
                'id' => 'shop-classic-button-add-to-cart-text',
                'type' => 'colorpicker',
                'name' => __( 'Color text of add to cart button', 'yit' ),
                'desc' => __( 'Select the text color of add to cart button.', 'yit' ),
                'std' => '#fff',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.add_to_cart_button, ul.products li.product.grid.classic .product-actions a.view-options',
                	'properties' => 'color'
				)
            ), 
            230 => array(
                'id' => 'shop-classic-button-add-to-cart-bg-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color background of add to cart button (in hover)', 'yit' ),
                'desc' => __( 'Select the background color of add to cart button, when mouse over.', 'yit' ),
                'std' => '#be7526',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.add_to_cart_button:hover, ul.products li.product.grid.classic .product-actions a.view-options:hover',
                	'properties' => 'background-color'
				)
            ), 
            240 => array(
                'id' => 'shop-classic-button-add-to-cart-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color text of add to cart button (in hover)', 'yit' ),
                'desc' => __( 'Select the text color of add to cart button, when mouse over.', 'yit' ),
                'std' => '#fff',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.add_to_cart_button:hover, ul.products li.product.grid.classic .product-actions a.view-options:hover',
                	'properties' => 'color'
				)
            ), 
            250 => array(
                'id' => 'shop-classic-out-of-stock-bg',
                'type' => 'colorpicker',
                'name' => __( 'Color background out of stock message', 'yit' ),
                'desc' => __( 'Select the background color of out of stock message.', 'yit' ),
                'std' => '#8e0404',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.out-of-stock',
                	'properties' => 'background-color'
				)
            ),
            260 => array(
                'id' => 'shop-classic-out-of-stock-text',
                'type' => 'colorpicker',
                'name' => __( 'Color text out of stock message', 'yit' ),
                'desc' => __( 'Select the text color of out of stock message.', 'yit' ),
                'std' => '#fff',
                'style' => array(
                	'selectors' => 'ul.products li.product.grid.classic .product-actions a.out-of-stock',
                	'properties' => 'color'
				)
            ),
            270 => array(
                'type' => 'title',
                'name' => __( 'Button colors', 'yit' ),
                'desc' => __( 'Colors for the buttons.', 'yit' )
            ),
            280 => array(
                'id' => 'shop-buttons-background',
                'type' => 'colorpicker',
                'name' => __( 'Color background of buttons', 'yit' ),
                'desc' => __( 'Select the background color of buttons.', 'yit' ),
                'std' => '#333333',
                'style' => array(
                	'selectors' => '.product .single_add_to_cart_button, .cart .button, input.checkout-button.alt.button, .shipping-calculator-form .button, .multistep_step .button, #place_order.button, .single-product .single_add_to_cart_button.button.alt, 
                	.price_slider_wrapper button.button, .yith-woo-ajax-reset-navigation .yith-wcan-reset-navigation.button, .woocommerce-cart-notice .button,a.checkout-button.button.wc-forward',
                	'properties' => 'background-color'
				)
            ),
            290 => array(
                'id' => 'shop-buttons-hover-background',
                'type' => 'colorpicker',
                'name' => __( 'Color background of buttons on hover', 'yit' ),
                'desc' => __( 'Select the background color of Add to cart button on hover.', 'yit' ),
                'std' => '#555555',
                'style' => array(
                	'selectors' => 'div.product form.cart .button:hover, #content div.product form.cart .button:hover, .cart .button:hover, input.checkout-button.alt.button:hover, .shipping-calculator-form .button:hover, .multistep_step .button:hover, #place_order.button:hover, .single-product .single_add_to_cart_button.button.alt:hover, .price_slider_wrapper button.button:hover, .yith-woo-ajax-reset-navigation .yith-wcan-reset-navigation.button:hover, , .woocommerce-cart-notice .button:hover',
                	'properties' => 'background-color'
				)
            ),
            300 => array(
                'id' => 'shop-buttons-text',
                'type' => 'colorpicker',
                'name' => __( 'Color text of buttons', 'yit' ),
                'desc' => __( 'Select the text color of buttons.', 'yit' ),
                'std' => '#FFFFFF',
                'style' => array(
                	'selectors' => '.product .summary .single_add_to_cart_button, .cart .button, input.checkout-button.alt.button, .shipping-calculator-form .button, .multistep_step .button, #place_order.button, .price_slider_wrapper button.button, .yith-woo-ajax-reset-navigation .yith-wcan-reset-navigation.button, , .woocommerce-cart-notice .button',
                	'properties' => 'color'
				)
            ),
            310 => array(
                'id' => 'shop-buttons-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Color text hover of buttons', 'yit' ),
                'desc' => __( 'Select the text color of buttons on hover.', 'yit' ),
                'std' => '#FFFFFF',
                'style' => array(
                	'selectors' => 'div.product form.cart .button:hover, #content div.product form.cart .button:hover, .cart .button:hover, input.checkout-button.alt.button:hover, .shipping-calculator-form .button:hover, .multistep_step .button:hover, #place_order.button:hover, .price_slider_wrapper button.button:hover, .yith-woo-ajax-reset-navigation .yith-wcan-reset-navigation.button:hover, , .woocommerce-cart-notice .button:hover',
                	'properties' => 'color'
				)
            ),   
            320 => array(
                'type' => 'title',
                'name' => __( 'Shop Widgets', 'yit' ),
                'desc' => __( 'Colors for the widgets.', 'yit' )
            ),   
            330 => array(
                'id' => 'shop-price-filter-bar-inactive',
                'type' => 'colorpicker',
                'name' => __( 'Price Filter - Inactive bar', 'yit' ),
                'desc' => __( 'Select the color for the bar rappresents the prices not included in the filtering (default: #DADADA).', 'yit' ),
                'std' => '#DADADA',
                'style' => array(
                	'selectors' => '.widget_price_filter .price_slider_wrapper .ui-widget-content',
                	'properties' => 'background-color'
				)
            ),  
            340 => array(
                'id' => 'shop-price-filter-bar-active',
                'type' => 'colorpicker',
                'name' => __( 'Price Filter - Active bar', 'yit' ),
                'desc' => __( 'Select the color for the bar rappresents the prices included in the filtering (default: #CD8906).', 'yit' ),
                'std' => '#CD8906',
                'style' => array(
                	'selectors' => '.widget_price_filter .ui-slider .ui-slider-range, .widget_price_filter .ui-slider .ui-slider-handle',
                	'properties' => 'background-color'
				)
            ), 
            350 => array(
                'id' => 'shop-layered-nav-active-text',
                'type' => 'colorpicker',
                'name' => __( 'Layered Nav - Active filter text', 'yit' ),
                'desc' => __( 'Select the text color for the selected filter (default: #c38204).', 'yit' ),
                'std' => '#c38204',
                'style' => array(
                	'selectors' => '.widget.widget_layered_nav .sizes li.chosen .size-filter',
                	'properties' => 'color'
				)
            ),  
            360 => array(
                'id' => 'shop-layered-nav-active-border',
                'type' => 'colorpicker',
                'name' => __( 'Layered Nav - Active filter border', 'yit' ),
                'desc' => __( 'Select the text color for the selected filter (default: #dec084).', 'yit' ),
                'std' => '#dec084',
                'style' => array(
                	'selectors' => '.widget.widget_layered_nav .sizes li.chosen .size-filter',
                	'properties' => 'border-color'
				)
            ),   
        );
    }
}