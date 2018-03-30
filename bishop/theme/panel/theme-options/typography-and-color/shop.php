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
 * Return an array with the options for Theme Options > Typography and Color > Shop
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'        => 'shop-add-to-cart-hover-color',
        'type'      => 'colorpicker',
        'name'      => __( 'Remove hover color in widget cart', 'yit' ),
        'desc'      => __( 'Select the hover color to use for the remove link', 'yit' ),
        'std'       => array(
            'color' => '#f7c104'
        ),
        'linked_to' => 'theme-color-1',
        'in_skin'        => true,
        'style'     => array(
            'selectors'  => '#header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a.remove:hover',
            'properties' => 'color'
        )
    ),

    /* Typography and Color > Shop > Shop Page */
    array(
        'type' => 'title',
        'name' => __( 'Shop Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-page-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.info-product h3, .info-product h3 a,
                              ul.featured-products-slider li .product_name,
                             .widget.woocommerce.widget_recently_viewed_products li a .product_title,
                             .widget.woocommerce.widget_products li a .product_title,
                             .widget.woocommerce.widget_top_rated_products li a .product_title,
                             .widget.woocommerce.widget_recent_reviews li a .product_title,
                             .widget.yit_products_category li a .product_title',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
    ),

    array(
        'id'              => 'shop-page-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 19,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.info-product .price,
                              table.compare-list .price td .amount,
                              ul.featured-products-slider li .price,
                              #yit-popup-right .price .amount,
                              .widget.woocommerce.widget_recently_viewed_products .product_price,
                              .widget.woocommerce.widget_products .product_price,
                              .widget.woocommerce.widget_top_rated_products .product_price,
                              .widget.yit_products_category .product_price',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),

    array(
        'id'    => 'shop-page-quick-view-background',
        'type'  => 'colorpicker',
        'name'  => __( 'Quick view background color', 'yit' ),
        'desc'  => __( 'Select a background-color for quick-view section link in slide-up layout', 'yit' ),
        'std'   => apply_filters( 'yit_shop-page-quick-view-background_std', array(
            'color' => '#222222'
        ) ),
        'style' => apply_filters( 'yit_shop-page-quick-view-background_style', array(
            'selectors'  => '.woocommerce ul.products li.product .thumb-wrapper.slideup .quick-view',
            'properties' => 'background-color'
        ) ),
        'in_skin'        => true,
    ),

    array(
        'id'              => 'shop-page-quick-view-font',
        'type'            => 'typography',
        'name'            => __( 'Quick view link font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for quick view link in slide-up layout.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => apply_filters( 'yit_shop-page-quick-view-font_std', array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#ffffff',
            'align'     => 'center',
            'transform' => 'uppercase',
        ) ),
        'style'           => apply_filters( 'yit_shop-page-quick-view-font_style', array(
            'selectors'  => '.woocommerce ul.products li.product .quick-view a, .woocommerce ul.products li.product .quick-view p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ) ,
        'in_skin'        => true,
    ),

    array(
        'type' => 'title',
        'name' => __( 'Shop Icon', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'         => 'shop-icon-onsale-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text'       => __( 'Text Color', 'yit' )
        ),
        'name'       => __( 'Icon On Sale Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the icon on-sale border, background and text color', 'yit' ),
        'std'        => apply_filters( 'yit_shop-icon-onsale-colors_std', array(
            'color' => array(
                'border'     => '#ffa509',
                'background' => '#f7c104',
                'text'       => '#000000'
            )
        ) ),
        'in_skin'        => true,
        'style'      => apply_filters( 'yit_shop-icon-onsale-colors_style', array(
            'border'     => array(
                'selectors'  => '.woocommerce span.onsale, .woocommerce-page span.onsale',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '.woocommerce span.onsale, .woocommerce-page span.onsale',
                'properties' => 'background'
            ),
            'text'       => array(
                'selectors' => '.woocommerce span.onsale, .woocommerce-page span.onsale',
                'properties' => 'color',
            )
        ) )
    ),

    array(
        'id'         => 'shop-preset-onsale-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text'       => __( 'Text Color', 'yit' )
        ),
        'name'       => __( 'Preset Icon On Sale Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the preset icon "on sale" border, background and text color', 'yit' ),
        'std'        => apply_filters( 'yit_shop-preset-onsale-colors_std', array(
            'color' => array(
                'border'     => '#000000',
                'background' => '#636363',
                'text'       => '#ffffff'
            )
        ) ),
        'in_skin'        => true,
        'style'      => apply_filters( 'yit_shop-preset-onsale-colors_style', array(
            'border'     => array(
                'selectors'  => '.woocommerce span.onsale.preset, .woocommerce-page span.onsale.preset',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '.woocommerce span.onsale.preset, .woocommerce-page span.onsale.preset',
                'properties' => 'background'
            ),
            'text'       => array(
                'selectors' => '.woocommerce span.onsale.preset, .woocommerce-page span.onsale.preset',
                'properties' => 'color',
            )
        ) )
    ),

    array(
        'id'         => 'shop-icon-added-cart-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text'       => __( 'Text Color', 'yit' )
        ),
        'name'       => __( 'Icon "Added to Cart" Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the icon "added to cart" border, background and text color', 'yit' ),
        'std'        => apply_filters( 'yit_shop-added-cart-colors_std', array(
            'color' => array(
                'border'     => '#908209',
                'background' => '#adab01',
                'text'       => '#ffffff'
            )
        ) ),
        'in_skin'        => true,
        'style'      => apply_filters( 'yit_shop-icon-added-cart-colors_style', array(
            'border'     => array(
                'selectors'  => '.woocommerce span.added_to_cart_ico, .woocommerce-page span.added_to_cart_ico',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '.woocommerce span.added_to_cart_ico, .woocommerce-page span.added_to_cart_ico',
                'properties' => 'background'
            ),
            'text'       => array(
                'selectors'  => '.woocommerce span.added_to_cart_ico, .woocommerce-page span.added_to_cart_ico',
                'properties' => 'color',
            )
        ) )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Shop Pagination Style', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-pagination-font',
        'type' => 'typography',
        'name' => __( 'Shop Pagination ', 'yit' ),
        'desc' => __( 'Select the font to use for the shop pagination', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#b4b4b4',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => apply_filters( 'yit_shop-pagination-font_style', array(
            'selectors'   => '#number-of-products,
                              #number-of-products a,
                              nav.woocommerce-pagination ul.page-numbers li a,
                              nav.woocommerce-pagination ul.page-numbers li',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) )   ,
        'in_skin'        => true,
    ),


    /* Typography and Color > Shop > Product Detail Page */

    array(
        'type' => 'title',
        'name' => __( 'Single Product Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-product-title-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product title and price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 30,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary .price, .single-product.woocommerce div.product div.summary h1',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),

    array(
        'id'    => 'shop-out-of-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Out of Stock" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Out of Stock" label.', 'yit' ),
        'std'   => array(
            'color' => '#dd0000'
        ),
        'style' => array(
            'selectors'  => '.woocommerce div.product .stock.out-of-stock,
                             .woocommerce-page div.product .stock.out-of-stock',
            'properties' => 'color'
        ),
        'in_skin'        => true,
    ),

    array(
        'id'    => 'shop-in-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Stock Quantity" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Stock Quantity" label.', 'yit' ),
        'std'   => apply_filters( 'yit_shop-in-stock-color_std', array(
            'color' => '#85ad74'
        ) ),
        'style' => apply_filters( 'yit_shop-in-stock-color_style', array(
            'selectors'  => '.woocommerce div.product .stock,
                             .woocommerce-page div.product .stock',
            'properties' => 'color'
        ) ),
        'in_skin'        => true,
    ),

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Cart Header Widget', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'shop-cart-header-widget-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart widget border and background', 'yit' ),
        'std'        => array(
            'color' => array(
                'border'     => '#f7c104',
                'background' => '#ffffff',
            )
        ),
        'linked_to'  => array(
            'border' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'border'     => array(
                'selectors'  => '.woocommerce #header-sidebar .yit_cart_widget .cart_wrapper, #header-sidebar .yit_cart_widget .cart_wrapper',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '.woocommerce #header-sidebar .yit_cart_widget .cart_wrapper, #header-sidebar .yit_cart_widget .cart_wrapper',
                'properties' => 'background'
            )
        )
    ),


);

