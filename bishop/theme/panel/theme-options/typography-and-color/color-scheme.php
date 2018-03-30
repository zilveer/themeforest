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
    /* General > Settings */
    array(
        'type' => 'title',
        'name' => __( 'Select Demo', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'general-skin',
        'type' => 'selectskins',
        'options' => $this->getModel( 'skins' )->get_skins_list(),
        'name' => __( 'Demo Color Scheme', 'yit' ),
        'std' => 'default'
    ),

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
            'color' => '#f7c104'
        ),
        'style'          => array(
            'selectors'  => '.shade-1, .fa.shade-1, #footer span.icon-circle i.fa, .blog-slider .next-blog:hover .icon-circle i.fa, .blog-slider .prev-blog:hover .icon-circle i.fa, .blog-masonry .masonry-brick .yit_post_content a:hover, .images-slider-sc .flex-direction-nav li a:hover:before',
            'properties' => 'color'
        ),
        'in_skin'        => true,
    ),

    array(
        'id'             => 'theme-color-2',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 2', 'yit' ),
        'desc'           => __( 'Set the second shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#d3a310'
        ),
        'style'          => array(
            'selectors'  => '.shade-2, #primary .testimonials-slider ul.testimonial-content li p.meta, #primary .testimonials-slider ul.testimonial-content li p.meta a, #primary div.owl-prev:hover i, #primary div.owl-next:hover i,.images-slider-sc ul li a.flex-prev:hover i,.images-slider-sc ul li a.flex-next:hover i,.logos-slider .nav .prev:hover i,.logos-slider .nav .next:hover i,#primary .testimonial-widget .owl-nav .owl-prev:hover i,#primary .testimonial-widget .owl-nav .owl-next:hover i, .blog-masonry .masonry-brick .yit_post_content a',
            'properties' => 'color'
        ),
        'in_skin'        => true,
    ),
    array(
        'id'             => 'general-background-color',
        'type'           => 'colorpicker',
        'name'           => __( 'General Background Color', 'yit' ),
        'desc'           => __( 'Set the general background color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#f7c104'
        ),
        'style'          => array(
            'selectors'  => '.pricing_box.price-table.large div.head span.price,
                            #wp-calendar th, #wp-calendar #today,
                            #wp-calendar #today a,
                            .blog.small .yit_post_format_icon,
                            .blog.big .yit_post_format_icon,
                            .blog-masonry .yit_post_format_icon,
                            .service-wrapper .image-wrapper.border:hover,
                            .widget_price_filter .ui-slider .ui-slider-range,
                            .widget_price_filter .ui-slider .ui-slider-handle',
            'properties' => 'background-color'
        ),
        'in_skin'        => true,
    ),
    array(
        'id'    => 'color-website-border-style-1',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 1', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#cdcdcd'
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
        ),
        'in_skin'        => true,
    ),

    array(
        'id'    => 'color-website-border-style-2',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 2', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#f7c104'
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
        ),
        'in_skin'        => true,
    ),

    array(
        'id'    => 'color-theme-icon',
        'type'  => 'colorpicker',
        'name'  => __( 'General Icons Color 1', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the theme icons', 'yit' ),
        'std'   => array(
            'color' => '#b4b4b4'
        ),
        'style' => array(
            array(
                'selectors'  => '.fa,
                                .widget_product_categories ul.product-categories > li > a:before,
                                .widget_nav_menu ul.menu > li > a:before,
                                .widget.widget_meta ul > li > a:before,
                                .widget.widget_pages ul > li > a:before,
                                .team-section .links a span,
                                .widget.featured-products .flex-direction-nav li a,ul.short li:before,
                                .comment-flexslider ul.flex-direction-nav li a,
                                .widget.yit_toggle_menu ul.menu > li > a:before,.sitemap ul > li:before,
                                .widget.widget_categories ul > li,
                                .widget.widget_archive ul > li,
                                #bbpress-forums #bbp-single-user-details #bbp-user-navigation li span:before,
                                .widget.widget_display_forums ul li a.bbp-forum-title:before,
                                .widget.widget_display_views ul li a.bbp-view-title:before,
                                .widget.widget_display_topics ul li a.bbp-forum-title:before,
                                #faqs-container .faq-wrapper .faq-title h4:before,
                                a.yith-wcan-reset-navigation.button:before,
                                .widget.woocommerce.widget_layered_nav_filters ul li:before,
                                .yith-wcan-select-wrapper ul.yith-wcan-select.yith-wcan li.chosen:before,
                                .yith-woocompare-widget ul.products-list a.remove,
                                #title_bar .product-nav .next a, #title_bar .product-nav .prev a,
                                .woocommerce table.shop_table.cart a .remove,
                                table.wishlist_table td.product-remove a .remove,
                                .faq-filters ul > li > a:before,
                                .portfolio_share .social-icon a,
                                .portfolio_share .social-icon a,
                                .yit-maintenance-mode .socials a span,
                                .yit-maintenance-mode form.newsletter .input-text span,
                                #faqs-container .faq-wrapper .faq-title .faq-icon,
                                .images-slider-sc .flex-direction-nav li a:before',
                'properties' => 'color'
            ),
        ),
        'in_skin'        => true,
    )
);

