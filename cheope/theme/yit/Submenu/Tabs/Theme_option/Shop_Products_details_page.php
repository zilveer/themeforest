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
 * Class to print fields in the tab Shop -> Products details page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Products_details_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_products_details_page
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

        $is_multi_vendor_installed = function_exists( 'YITH_Vendors' );

        return array(
        	10 => array(
                'id'   => 'shop-products-details-title',
                'type' => 'onoff',
                'name' => __( 'Show products details page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Products details.', 'yit' ),
                'std'  => true,
            ),
			30 => array(
                'id'   => 'shop-products-details-contact-form',
                'type' => 'select',
                'name' => __( 'Ask info form', 'yit' ),
                'desc' => __( 'The contact form.', 'yit' ),
                'options' => yit_contact_forms(),
				'std' => -1,
            ),
            35 => !$is_multi_vendor_installed ? false: array(
                'id'   => 'send-email-to-vendor',
                'type' => 'onoff',
                'name' => __( 'Send Email to product vendor', 'yit' ),
                'desc' => __( 'Select if you want to send the email to the product vendor instead of administrator.', 'yit' ),
                'std'  => false,
            ),
            40 => array(
                'id'   => 'shop-share',
                'type' => 'onoff',
                'name' => __( 'Print shortcode [share]', 'yit' ),
                'desc' => __( 'Enable the shortcode [share].', 'yit' ),
				'std' => 1,
            ),
            50 => array(
                'id'   => 'shop-share-title',
                'type' => 'text',
                'name' => __( '[share] shortcode title', 'yit' ),
                'desc' => __( 'Add your text for title of [share] shortcode.', 'yit' ),
                'std'  => __( 'Love it, share it!', 'yit' ),
                'deps' => array (
					'ids' => 'shop-share',
					'values' => 1
				)
            ),
            60 => array(
                'id'   => 'shop-share-socials',
                'type' => 'text',
                'name' => __( '[share] shortcode socials', 'yit' ),
                'desc' => __( 'Write which socials use for the [share] shortcode.', 'yit' ),
                'std'  => __( 'facebook,twitter,google,pinterest,bookmark', 'yit' ),
                'deps' => array (
					'ids' => 'shop-share',
					'values' => 1
				)
            ),
            170 => array(
                'id'   => 'shop-detail-show-price',
                'type' => 'onoff',
                'name' => __( 'Show price', 'yit' ),
                'desc' => __( 'Select if you want to show a the price on the products list.', 'yit' ),
				'std' => 1
            ),
            180 => array(
                'id'   => 'shop-detail-add-to-cart',
                'type' => 'onoff',
                'name' => __( 'Show button add to cart', 'yit' ),
                'desc' => __( 'Select if you want to show the purchase button.', 'yit' ),
				'std' => 1
            ),
            190 => array(
                'id'   => 'shop-show-related',
                'type' => 'onoff',
                'name' => __( 'Show Related Products', 'yit' ),
                'desc' => __( 'Select if you want to show the related products. Note: if you are already using a custom filter to do that, please don\'t enable this option. ( Default: Off )', 'yit' ),
                'std'  => 0
            ),
            200 => array(
                'id'   => 'shop-number-related',
                'type' => 'number',
                'name' => __( 'Number of Related Products', 'yit' ),
                'desc' => __( 'Select the total numbers of the related products displayed, on the product detail page. Note: related products are displayed randomly from Woocommerce/Jigoshop. Sometimes the number of related products could be less than the number of items selected. This number depends from the query plugin, not from the theme.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-number-related_std', 3 ),
                'min'  => 1,
                'deps' => array(
					'ids' => 'shop-show-related',
					'values' => 1
				),
            )
        );
    }
}