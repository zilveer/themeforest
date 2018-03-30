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
        'id' => 'shop-enable-masonry',
        'type' => 'onoff',
        'name' => __( 'Enable masonry shop', 'yit' ),
        'desc' => __( 'Activate/Deactivate masonry shop page.', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-view-type',
        'type' => 'select',
        'options' => array(
            'list' => __( 'List View', 'yit'),
            'grid' => __( 'Grid View', 'yit'),
        ),
        'name' => __( 'Product view', 'yit' ),
        'desc' => __( 'Select the default view for the page shop.', 'yit' ),
        'std' => 'grid',
        'deps' => array(
            'ids' => 'shop-enable-masonry',
            'values' => 'no'
        )
    ),

    array(
        'id' => 'shop-layout-type',
        'type' => 'select',
        'options' => array(
            'slideup' => __( 'Slide-up Layout', 'yit'),
            'classic' => __( 'Classic Layout', 'yit')
        ),
        'name' => __( 'Product layout', 'yit' ),
        'desc' => __( 'Select the default product layout for the page shop.', 'yit' ),
        'std' => 'slideup'
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
        'name' => __( 'Number of product per row', 'yit' ),
        'desc' => __( 'Select the number of items to show in a row.', 'yit' ),
        'std' => 4,
        'deps' => array(
            'ids' => 'shop-enable-masonry',
            'values' => 'no'
        )
    ),

    array(
        'id' => 'shop-product-description-on-list',
        'type' => 'onoff',
        'name' => __( 'Show product description on list view', 'yit' ),
        'desc' => __( 'Say if you want to show the product description on "List" view.', 'yit' ),
        'std' => 'yes',
        'deps' => array(
            'ids' => 'shop-view-type',
            'values' => 'list'
        )
    ),

    array(
        'id' => 'shop-grid-list-option',
        'type' => 'onoff',
        'name' => __( 'Show "Grid/List" view option', 'yit' ),
        'desc' => __( 'Say if you want to show the option to switch between "Grid" and "List" view. ', 'yit'),
        'std' => 'yes',
        'deps' => array(
            'ids' => 'shop-enable-masonry',
            'values' => 'no'
        )

    ),
    array(
        'id' => 'shop-products-per-page-option',
        'type' => 'onoff',
        'name' => __( 'Show "Products per Page" view option', 'yit' ),
        'desc' => __( 'Say if you want to show the option for select how many products show in single shop page.', 'yit'),
        'std' => 'yes'
    ),
    array(
        'id'   => 'shop-use-quick-view',
        'type' => 'onoff',
        'name' => __( 'Use "Quick view"', 'yit' ),
        'desc' => __( 'Set if you want to show the "Quick View" button on product mouse hover.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'shop-quick-view-text',
        'type' => 'text',
        'name' => __( 'Quick View text', 'yit' ),
        'desc' => __( 'Set the text for the "Quick View" button.', 'yit' ),
        'std'  => __( 'Quick View', 'yit' ),
        'deps' => array(
            'ids' => 'shop-use-quick-view',
            'values' => 'yes'
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
        'id' => 'shop-product-category',
        'type' => 'onoff',
        'name' => __( 'Show product category', 'yit' ),
        'desc' => __( 'Say if you want to show the product category', 'yit' ),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-product-rating',
        'type' => 'onoff',
        'name' => __( 'Show product rating', 'yit' ),
        'desc' => __( 'Say if you want to show the product rating. ', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-add-to-cart',
        'type' => 'onoff',
        'name' => __( 'Show add to cart', 'yit' ),
        'desc' => __( 'Say if you want to show the add to cart button', 'yit'),
        'std' => 'yes'
    ),

    array(
        'type' => 'title',
        'name' => __( 'Slide-up Options', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-slide-add-cart-icon',
        'type' => 'upload',
        'name' => __( 'Add to cart icon', 'yit' ),
        'desc' => __( 'Change the icon for the Add to cart', 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'shop-slide-out-stock-icon',
        'type' => 'upload',
        'name' => __( 'Out of stock icon', 'yit' ),
        'desc' => __( 'Change the icon for the Out of Stock', 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'shop-slide-set-option-icon',
        'type' => 'upload',
        'name' => __( 'Set Option icon', 'yit' ),
        'desc' => __( 'Change the icon for the Set Option', 'yit' ),
        'std' => ''
    )
);

