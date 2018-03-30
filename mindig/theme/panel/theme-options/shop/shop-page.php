<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Shop > Shop Page
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @author Francesco Licandro <francesco.licandro@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Shop > Shop Page Settings */
    array(
        'type' => 'title',
        'name' => __( 'Shop Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-show-page-title',
        'type' => 'onoff',
        'name' => __( 'Show page title', 'yit' ),
        'desc' => __( 'Activate/Deactivate the page title on shop page.', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-view-type',
        'type' => 'select',
        'options' => array(
            'list' => __( 'List View', 'yit'),
            'grid' => __( 'Grid View', 'yit'),
            'masonry_item' => __( 'Masonry View', 'yit')
        ),
        'name' => __( 'Shop layout', 'yit' ),
        'desc' => __( 'Select the default layout for the page shop.', 'yit' ),
        'std' => 'grid'
    ),

    array(
        'id' => 'shop-layout-type',
        'type' => 'select',
        'options' => array(
            'zoom' => __( 'Zoom Layout', 'yit'),
            'flip' => __( 'Flip Layout', 'yit')
        ),
        'name' => __( 'Products layout', 'yit' ),
        'desc' => __( 'Select the default products layout for the page shop.', 'yit' ),
        'std' => 'zoom',
        'deps' => array(
            'ids' => 'shop-view-type',
            'values' => 'list,grid'
        )
    ),

    array(
        'id' => 'shop-num-column',
        'type' => 'select',
        'options' => array(
            1 => __( 'One', 'yit'),
            2 => __( 'Two', 'yit'),
            3 => __( 'Three', 'yit'),
            4 => __( 'Four', 'yit'),
            6 => __( 'Six', 'yit'),
        ),
        'name' => __( 'Number of products per row', 'yit' ),
        'desc' => __( 'Select the number of items to show in a row.', 'yit' ),
        'std' => 4,
        'deps' => array(
            'ids' => 'shop-view-type',
            'values' => 'grid,masonry_item'
        ),
    ),

    array(
        'id' => 'shop-grid-list-option',
        'type' => 'onoff',
        'name' => __( 'Show "Grid/List" view option', 'yit' ),
        'desc' => __( 'Say if you want to show the option to switch between "Grid" and "List" view. ', 'yit'),
        'std' => 'yes',
        'deps' => array(
            'ids' => 'shop-view-type',
            'values' => 'list,grid'
        )
    ),

    array(
        'id' => 'shop-product-title',
        'type' => 'onoff',
        'name' => __( 'Show product title', 'yit' ),
        'desc' => __( 'Say if you want to show the product title. ', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-product-price',
        'type' => 'onoff',
        'name' => __( 'Show product price', 'yit' ),
        'desc' => __( 'Say if you want to show the product price. ', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-add-to-cart-button',
        'type' => 'onoff',
        'name' => __( 'Show Add To Cart button', 'yit' ),
        'desc' => __( 'Say if you want to show the add to cart button', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-quick-view-enable',
        'type' => 'onoff',
        'name' => __( 'Show Quick View button', 'yit' ),
        'desc' => __( 'Say if you want to enable quick view for products, if set to "on" will be replace the "view details" button.', 'yit'),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-view-details-button',
        'type' => 'onoff',
        'name' => __( 'Show View Details button', 'yit' ),
        'desc' => __( 'Say if you want to show the View Details button', 'yit'),
        'std' => 'yes',
    ),

    array(
        'id' => 'shop-view-details-text',
        'type' => 'text',
        'name' => __( 'Set "View Details" text', 'yit' ),
        'desc' => __( "Choose the text to display within the view details button.", 'yit' ),
        'std' => 'View Details',
        'deps' => array(
            'ids' => 'shop-view-details-button',
            'values' => 'yes'
        )
    ),

    array(
        'id' => 'shop-product-rating',
        'type' => 'onoff',
        'name' => __( 'Show product rating', 'yit' ),
        'desc' => __( 'Say if you want to show the product rating. ', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-product-description',
        'type' => 'onoff',
        'name' => __( 'Show product description in Grid View', 'yit' ),
        'desc' => __( 'Say if you want to show the product short description in grid view', 'yit' ),
        'std' => 'no',
    ),

    array(
        'id' => 'shop-view-wishlist-button',
        'type' => 'onoff',
        'name' => __( 'Show wishlist button', 'yit' ),
        'desc' => __( 'Say if you want to show wishlist button.', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-view-compare-button',
        'type' => 'onoff',
        'name' => __( 'Show compare button', 'yit' ),
        'desc' => __( 'Say if you want to show compare button.', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-view-share-button',
        'type' => 'onoff',
        'name' => __( 'Show share button', 'yit' ),
        'desc' => __( 'Say if you want to show share button.', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-added-icon',
        'type' => 'upload',
        'name' => __( 'Added to cart icon', 'yit' ),
        'desc' => __( 'Change the icon for the Added feedback message when you add to cart a product.', 'yit' ),
        'std' => YIT_URL . '/woocommerce/images/added.png',
    ),

    array(
        'id' => 'shop-added-wishlist-icon',
        'type' => 'upload',
        'name' => __( 'Added to wishlist icon', 'yit' ),
        'desc' => __( 'Change the icon for the Added feedback message when you add to wishlist a product.', 'yit' ),
        'std' => YIT_URL . '/woocommerce/images/added-to-wishlist.png',
    )
);

