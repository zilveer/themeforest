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
 * @author  Francesco Licandro <francesco.licandro@yithemes.it>
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
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#686868',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.product-meta h3.product-name, .product-meta h3.product-name a,
                             .woocommerce table.cart td.product-name div.product-name a,
                             .widget.woocommerce.widget_top_rated_products .product_price,
                             .woocommerce ul.product_list_widget li a,
                             .woocommerce ul.product_list_widget a span.product_title,
                             .widget.featured-products .info-featured-product .product_name,
                             .widget.yit_products_category a span.product_title',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#1f1f1f',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.product-meta .price, .product-meta .price .amount, .woocommerce table.cart td.product-name div.product-price span,
                             .widget.woocommerce ul.product_list_widget li .product_price ins .amount,
                             .widget.woocommerce ul.product_list_widget li .product_price .amount,
                             .widget.featured-products .info-featured-product .price .amount,
                             .widget.yit_products_category ul li .product_price .amount,
                             .widget.yit_products_category ul li .product_price ins .amount,
                             #yit-popup-border.woocommerce .price .amount,
                             #yit-popup-border.woocommerce .price ins .amount,
                             #yit-popup-border.woocommerce .price .from',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-product-other-actions',
        'type'            => 'typography',
        'name'            => __( 'Share Compare and Wishlist font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#686868',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.product-actions-wrapper .product-other-action .yith-wcwl-add-to-wishlist a,
                             .product-actions-wrapper .product-other-action .compare-button a,
                             .product-actions-wrapper .product-other-action .share-button a,
                             #product-box .product-actions .compare-button a,
                             #product-box .product-actions .yith-wcwl-add-to-wishlist a,
                             .single-product.woocommerce div.product div.summary .product-actions .compare-button a,
                             .single-product.woocommerce div.product div.summary .product-actions .yith-wcwl-add-to-wishlist a,
                             .woocommerce-tabs #comments ol.commentlist li .comment-info div.meta span.fn,
                             #my-account-sidebar .username,
                             nav.woocommerce-MyAccount-navigation .username',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-layout-selector',
        'type'            => 'typography',
        'name'            => __( 'Page and Layout Selector font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#686868',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#list-or-grid span, #number-of-products span, nav.woocommerce-pagination li a,
                            nav.woocommerce-pagination li span',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-notice-font',
        'type'            => 'typography',
        'name'            => __( 'Shop notice font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#535353',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.woocommerce-message, .woocommerce-info, .woocommerce-error li',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Shop > Product Detail Page */

    array(
        'type' => 'title',
        'name' => __( 'Single Product Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-single-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product name font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary h1',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary .price, .single-product.woocommerce div.product div.summary .price span.amount,
                             #product-box .border.group .price, #product-box .border.group .price span.amount',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-label-font',
        'type'            => 'typography',
        'name'            => __( 'Product page label font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#686868',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary form.cart h4,
                            .single-product.woocommerce div.product form.cart table.variations .label label,
                            #product-box form.cart h4,
                            #product-box form.cart table.variations .label label,
                            div.summary.entry-summary form.variations_form.cart .single_variation_wrap h4,
                            #inquiry-form .product-inquiry h4',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-tabs-font',
        'type'            => 'typography',
        'name'            => __( 'Product tabs title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.woocommerce-tabs ul.tabs li a, .woocommerce-tabs ul.tabs li:after, .woocommerce-tabs #respond h3,
                            .single-product.woocommerce div.product div.summary .product-share span,
                            #product-nav span.prev-label,
                            .share-container .share-text,
                            .share-modal a .share-text,
                            #product-nav span.next-label,
                            div.yith-wcwl-share h4,
                            .tabs-container ul.tabs li:after,
                            .tabs-container ul.tabs li h4 a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
                             .woocommerce-page div.product .stock.out-of-stock,
                             #product-box .stock.out-of-stock',
            'properties' => 'color'
        )
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
                             .woocommerce-page div.product .stock,
                             .wishlist_table tr td.product-stock-status span.wishlist-in-stock,
                             #product-box .stock',
            'properties' => 'color'
        ) )
    ),


    /* Typography and Color > Shop > My-Account page */
    array(
        'type' => 'title',
        'name' => __( 'My Account Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'my-account-page-menu-font',
        'type'            => 'typography',
        'name'            => __( 'My Account sidebar menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#my-account-sidebar ul li > a,
                             nav.woocommerce-MyAccount-navigation ul li > a,
                             #bbp-user-navigation li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),


    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Cart Header Widget', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-cart-header-widget-label-font',
        'type'            => 'typography',
        'name'            => __( 'Cart header label font', 'yit' ),
        'desc'            => __( 'Select the font to use for the label cart font.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'       => array(
            ''
        ),
        'style'           => array(
            'selectors'  => '#header a .yit-mini-cart-subtotal span, a span.cart-items-number,
            div.yit_cart_widget .product_list_widget .mini-cart-item-info .quantity,
            div.yit_cart_widget .product_list_widget .mini-cart-item-info .quantity .amount,
             .sidebar .woocommerce .product_list_widget .mini-cart-item-info .quantity,
             .sidebar .woocommerce .product_list_widget .mini-cart-item-info .quantity .amount,
            #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal span.amount,
            .sidebar .woocommerce .product_list_widget .mini-cart-item-info .subtotal span.amount,
            .sidebar .woocommerce  p.total span,
            .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal span.amount,
            .woocommerce #header-sidebar > div.yit_cart_widget p.total span,
            #header-sidebar > div.yit_cart_widget p.total span,
            div.yit_cart_widget .product_list_widget .mini-cart-item-info a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'             => 'shop-cart-header-widget-alternative-text-colors',
        'type'           => 'colorpicker',
        'name'       => __( 'Cart Header Widget Alternative Text Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the alternative text color', 'yit' ),

        'std'            => array(
            'color' => '#a4a4a4'
        ),
        'style'          => array(
            'selectors'  => '#header a .yit-mini-cart-subtotal span.cart-label_text,
                             #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .quantity,
                             #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .quantity .amount,
                             .sidebar .woocommerce .product_list_widget .mini-cart-item-info .quantity,
                             .sidebar .woocommerce .product_list_widget .mini-cart-item-info .quantity .amount',
            'properties' => 'color'
        )
    ),

    array(
        'id'         => 'shop-cart-header-widget-link-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'     => __( 'Link', 'yit' ),
            'hover' => __( 'Link hover', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Link Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart link', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'     => '#383838',
                'hover' => '#fab000',
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        'style'      => array(
            'normal'     => array(
                'selectors'  => '
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal,

                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal',
                'properties' => 'color'
            ),
            'hover' => array(
                'selectors'  => '
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover',
                'properties' => 'color'
            )
        )
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
                'border'     => '#dbdbdb',
                'background' => '#ffffff',
            )
        ),
        'linked_to'  => array(
            'border' => 'theme-color-1',
        ),
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
    )
);

