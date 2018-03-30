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
 * Return an array with the options for Theme Options > Shop > General Settings
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-enable',
        'type' => 'onoff',
        'name' => __( 'Enable shop features', 'yit' ),
        'desc' => __( 'Say if you want to enable the shop features. If the option is disabled, products cannot be added to cart.', 'yit' ),
        'std' => 'yes'
    ),

    array(
        'id' => 'shop-products-per-page',
        'type' => 'number',
        'min' => 1,
        'max' => 500,
        'name' => __( 'Products per page', 'yit' ),
        'desc' => __( 'Say how many products to show per page, in the shop pages. ', 'yit' ),
        'std' => 12
    ),

    array(
        'id' => 'shop-enable-vat',
        'type' => 'onoff',
        'name' => __( 'Enable VAT field', 'yit' ),
        'desc' => __( 'Choose if you want to enable VAT field for Customer.', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-enable-ssn',
        'type' => 'onoff',
        'name' => __( 'Enable SSN field', 'yit' ),
        'desc' => __( 'Choose if you want to enable SSN field for Customer.', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-add-to-cart-text',
        'type' => 'text',
        'name' => __( 'Set "Add to Cart" text', 'yit' ),
        'desc' => __( "Choose the text to display within the add to cart button. This will not work for external products. For them it's handled directly in the product admin page.", 'yit' ),
        'std' => 'Add to cart'
    ),

    array(
        'id' => 'shop-sale-text',
        'type' => 'text',
        'name' => __( 'Set "On Sale icon" text', 'yit' ),
        'desc' => __( "Choose the text to display within the 'on sale' icon.", 'yit' ),
        'std' => 'On Sale'
    ),

    array(
        'type' => 'title',
        'name' => __( 'Mini Cart Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-mini-cart-icon',
        'type' => 'upload',
        'name' => __( 'Set Custom Mini Cart Icon', 'yit' ),
        'desc' => __( "Choose the image to display as minicart background", 'yit' ),
        'std' => YIT_THEME_ASSETS_URL . '/images/cart.png',
        'in_skin' => true
    ),

    array(
        'id' => 'shop-mini-cart-total-items',
        'type' => 'onoff',
        'name' => __( 'Count All Items in the cart', 'yit' ),
        'desc' => __( "It changes the way like the cart in the header count items. If ON, everytime you add an item to the cart (also if the item already is in the cart) the quantity will be increased. If OFF, multiple items of the same type will be counted only one time.", 'yit' ),
        'std' => 'no'
    ),

    array(
        'type' => 'title',
        'name' => __( 'Price Filter Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-price-filter-style',
        'type' => 'onoff',
        'name' => __( 'Enable Slider Price Filter', 'yit'),
        'desc' => __( 'Select if you want to enable slider style for price filter widget', 'yit'),
        'std' => 'no',
    )


);


