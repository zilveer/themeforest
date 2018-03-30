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
 * Return an array with the options for Theme Options > Typography and Color > General Settings
 *
 * @package Yithemes
 * @author  Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since   2.0.0
 * @return  mixed array
 *
 */
return array(
    /* Typography and Color > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Main general color scheme', 'yit' ),
        'desc' => __( "Set the different colors shades for the main theme's color", 'yit' )
    ),

    array(
        'id'             => 'theme-color-1',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 1', 'yit' ),
        'desc'           => __( 'Set the first shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#c38c08'
        ),
        'style'          => array(
            'selectors'  => '.shade-1, .box-title .subtitle',
            'properties' => 'color'
        )
    ),
    array(
        'id'             => 'theme-color-2',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 2', 'yit' ),
        'desc'           => __( 'Set the second shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#fab000'
        ),
        'style'          => array(
            'selectors'  => '.shade-2,
                            .logos-slider .nav a.next:hover,
                            .logos-slider .nav a.next:hover span.fa,
                            .logos-slider .nav a.prev:hover,
                            .logos-slider .nav a.prev:hover span.fa,
                            .images-slider-sc .flex-direction-nav li a:hover',
            'properties' => 'color'
        )
    ),
    array(
        'id'             => 'theme-color-3',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 3', 'yit' ),
        'desc'           => __( 'Set the third shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#686868'
        ),
        'style'          => array(
            'selectors'  => '.shade-3',
            'properties' => 'color'
        )
    ),
    array(
        'id'             => 'general-background-color',
        'type'           => 'colorpicker',
        'name'           => __( 'General Background Color', 'yit' ),
        'desc'           => __( 'Set the general background color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#fab000'
        ),
        'style'          => array(
            'selectors'  => '#comments ol li .information .user-info .is_author,
                            .nav  span.highlight,
                            .widget.yit-recent-posts .recent-post .hentry-post p.post-date,
                            .widget_price_filter .ui-slider .ui-slider-range,
                            .widget_price_filter .ui-slider .ui-slider-handle,
                            #wp-calendar thead tr,
                            #wp-calendar td#today,
                            ul.blog_posts li div.blog_post .yit_post_date,
                            .pricing_box.price-table.large div.head span.price',
            'properties' => 'background-color'
        )
    ),
    array(
        'id'    => 'color-website-border-style-1',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 1', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#dbdbdb'
        ),
        'style' => array(
            array(
                'selectors'  => $this->get_selectors( 'border-1-top' ),
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-1-bottom' ),
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-1-all' ),
                'properties' => 'border-color'
            ),
            array(
                'selectors'  => '.border-line',
                'properties' => 'background-color'
            )
        )
    ),

    array(
        'id'    => 'color-website-border-style-2',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 2', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#fab000'
        ),
        'style' => array(
            array(
                'selectors'  => $this->get_selectors( 'border-2-top' ),
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-2-bottom' ),
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-2-all' ),
                'properties' => 'border-color'
            ),
            array(
                'selectors'  => '.border-line',
                'properties' => 'background-color'
            )
        )
    ),

    array(
        'id'    => 'color-website-border-style-3',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 3', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#ffe595'
        ),
        'style' => array(
            'selectors'  => '.woocommerce-tabs #review_form,
                                 .woocommerce .cart-collaterals .cart_totals,
                                 .woocommerce ul.product_list_widget li:hover:after,
                                 .widget.yit_products_category ul.product_list_widget li:hover:after,
                                 #product-box .border.group,
                                  .yit_quick_contact .contact_form_wrapper,
                                 #order_review,
                                 .widget.newsletter-form.with-border:after,
                                 .widget.yit_products_category ul.product_list_widget li:hover,
                                 .wpb_widgetised_column .widget.newsletter-form.with-border:after',
            'properties' => 'border-color'
        )
    ),



    array(
        'id'    => 'color-theme-icon',
        'type'  => 'colorpicker',
        'name'  => __( 'General Icons Color', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the theme icons', 'yit' ),
        'std'   => array(
            'color' => '#b4b4b4'
        ),
        'style' => array(
            array(
                'selectors'  => '.woocommerce-tabs #review_form p.stars,.fa, .glyphicon, .entypo, #number-of-products a, #number-of-products a:after,
                                 #featured-slider .ms-nav-next:after,
                                 #featured-slider .ms-nav-prev:after,
                                 #bbp-user-navigation li span:before,
                                 .widget.testimonial-widget .ms-skin-default .ms-nav-next:after,
                                 .widget.testimonial-widget .ms-skin-default .ms-nav-prev:after,
                                 .widget.featured-products .flex-direction-nav li a,
                                 .images-slider-sc .flex-direction-nav li a,
                                 .star-rating,
                                 .logos-slider .nav a.next,
                                 .logos-slider .nav a.prev',
                'properties' => 'color'
            ),
        )
    ),

    array(
        'id'        => 'color-theme-star',
        'type'      => 'colorpicker',
        'name'      => __( 'General Stars Color', 'yit' ),
        'desc'      => __( 'Select the color used in the theme for the theme stars.', 'yit' ),
        'std'       => array(
            'color' => '#fab000'
        ),
        'style'     => array(
            'selectors'  => '.woocommerce ul.products li.product .product-actions-wrapper .product-rating,
                            .single-product.woocommerce div.product div.summary .product-rating,
                            .woocommerce-tabs #comments ol.commentlist div.meta .product-rating,
                            .woocommerce-tabs #review_form p.stars a:hover:before,
                            .woocommerce-tabs #review_form p.stars a:focus:before,
                            .woocommerce-tabs #review_form p.stars a.active:before,
                            .woocommerce-tabs #review_form p.stars a.visited:before,
                            .widget.testimonial-widget  ul li .testimonial-rating span,
                            .woocommerce ul.products li.product .info-product .product-rating,
                            .woocommerce #reviews #comments ol.commentlist li .product-rating,
                            .star-rating span,
                            .widget.yit_recent_reviews .meta div.reviews-rating,
                            .testimonial-wrapper .testimonial-rating',
            'properties' => 'color'
        )
    ),
);

