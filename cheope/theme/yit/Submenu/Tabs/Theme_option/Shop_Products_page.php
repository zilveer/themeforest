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
 * Class to print fields in the tab Shop -> Products page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Products_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_products_page
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
                'id'   => 'shop-products-title',
                'type' => 'onoff',
                'name' => __( 'Show products page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Products.', 'yit' ),
                'std'  => true,
            ),
            15 => array(
                'id'   => 'shop-products-text-title',
                'type' => 'text',
                'name' => __( 'Custom title for shop products', 'yit' ),
                'desc' => __( 'Add your text for title of Products.', 'yit' ),
                'std'  => 'Products',
                'deps' => array (
					'ids' => 'shop-products-title',
					'values' => 1
				)
            ),      
            20 => array(
                'id'   => 'shop-layout',
                'type' => 'select',
                'name' => __( 'Style products layout (in grid view)', 'yit' ),
                'desc' => __( 'Select the layout for the list of products, for the grid view.', 'yit' ),
                'options' => apply_filters( 'yit_shop-layout_options', array(
                    'with-hover' => __( 'With hover', 'yit' ),
                    'classic' => __( 'Classic', 'yit' ),
                ) ),
                'std'  => apply_filters( 'yit_shop-layout_std', 'with-hover' )
            ),      
            25 => array(
                'id'   => 'shop-view',
                'type' => 'select',
                'name' => __( 'Show View', 'yit' ),
                'desc' => __( 'Select the default view for the page shop.', 'yit' ),
                'options' => apply_filters( 'yit_shop-view_options', array(
                    'grid' => __( 'Grid View', 'yit' ),
                    'list' => __( 'List View', 'yit' ),
                ) ),
                'std'  => apply_filters( 'yit_shop-view_std', 'grid' )
            ),   
            30 => array(
                'id'   => 'shop-view-show-details',
                'type' => 'onoff',
                'name' => __( 'Show details icon', 'yit' ),
                'desc' => __( 'Say if you want to show the details icon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-details_std', 1 )
            ),   
            40 => array(
                'id'   => 'shop-view-show-add-to-cart',
                'type' => 'onoff',
                'name' => __( 'Show add to cart', 'yit' ),
                'desc' => __( 'Say if you want to show the details icon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-add-to-cart_std', 1 )
            ),    
            50 => array(
                'id'   => 'shop-view-show-title',
                'type' => 'onoff',
                'name' => __( 'Show product title', 'yit' ),
                'desc' => __( 'Say if you want to show the product title.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-title_std', 1 )
            ),    
            60 => array(
                'id'   => 'shop-view-show-price',
                'type' => 'onoff',
                'name' => __( 'Show product price', 'yit' ),
                'desc' => __( 'Say if you want to show the product price.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-price_std', 1 )
            ),      
            70 => array(
                'id'   => 'shop-view-show-description',
                'type' => 'onoff',
                'name' => __( 'Show product description (only for list view)', 'yit' ),
                'desc' => __( 'Say if you want to show the product description, only for list view.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-description_std', 1 )
            ),      
            80 => array(
                'id'   => 'shop-view-show-shadow',
                'type' => 'onoff',
                'name' => __( 'Show product shadow (only for classic layout)', 'yit' ),
                'desc' => __( 'Say if you want to show the product shadow below the thumbnail, only for classic layout.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-shadow_std', 1 )
            ),       
            90 => array(
                'id'   => 'shop-view-show-border',
                'type' => 'onoff',
                'name' => __( 'Show product border image (only for classic layout)', 'yit' ),
                'desc' => __( 'Say if you want to show the product border image for the thumbnail, only for classic layout.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-border_std', 1 )
            ),         
            100 => array(
                'id'   => 'shop-sale-label',
                'type' => 'text',
                'name' => __( 'Sale label', 'yit' ),
                'desc' => __( 'Choose the label you want to display when a product is in sale.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-sale-label_std', 'Sale!' )
            ),
            120 => array(
                'id'   => 'shop-featured-image-size',
                'type' => 'imagesize',
                'name' => __( 'Featured image size', 'yit' ),
                'desc' => __( 'Set the image size for featured products', 'yit' ),
                'std'  => array(
                    'width' => 160,
                    'height' => 160,
                    'crop' => true
                )
            ),
        );
    }
}