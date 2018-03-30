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
 * Return an array with the options for Theme Options > Typography and Color > HTML Tags
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > HTML Tags General Settings */
    array(
        'type' => 'title',
        'name' => __( 'HTML Tags General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'typography-link-color',
        'type' => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name' => __( 'Links', 'yit' ),
        'desc' => __( 'Select the colors to use for the links in normal state and on hover.', 'yit' ),
        'std'  => array(
            'color' => array(
                'normal' => '#f7c104',
                'hover'  => '#d2a402'
            )
        ),
        'style' => array(
            'normal' => array(
                'selectors'   => 'a, a:visited,
                                  .portfolio-filterable #portfolio_filterable li .portfolio-thumb .portfolio-overlay .portfolio-overlay-info .portfolio-overlay-title,
                                  .portfolio-pinterest #portfolio_pinterest .work .portfolio-thumb .portfolio-overlay .portfolio-overlay-info .portfolio-overlay-title,
                                  .portfolio_small_image .yit_portfolio_thumbnail .thumbnail .swiper-container .swiper-direction:hover i, .team-section .tabs .thumb .overlay .inner,
                                  .woocommerce ul.products li.product-category .product-category-link .show-category-background .discovery-text, .products-slider-wrapper .es-nav-prev:hover span, .products-slider-wrapper .es-nav-next:hover span,
                                  .categories-slider-wrapper .es-nav-prev:hover span, .categories-slider-wrapper .es-nav-next:hover span, .widget.featured-products .flex-direction-nav li a:hover, .widget.yit_toggle_menu ul.menu > li.opened > a:before, .widget.yit_toggle_menu ul.menu > li:hover > a:before,
                                  .yit_shortcodes.recent-post .text a.read-more, .yit_shortcodes.recent-post .text a,
                                  #faqs-container .faq-wrapper .faq-title.active h4:before,
                                  #buddypress #activity-stream .activity-header p a.activity-time-since:hover span,
                                  #buddypress #activity-stream  .activity-comments .acomment-meta a.activity-time-since:hover span,
                                  #buddypress a:hover',
                'properties'  => 'color'
            ),
            'hover' => array(
                'selectors'   => $this->get_selectors( 'a-tag' ),
                'properties'  => 'color'
            )
        ),
        'linked_to' => array(
            'normal' => 'theme-color-1',
            'hover'  => 'theme-color-2'
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'typography-p-font',
        'type' => 'typography',
        'name' => __( 'Paragraphs', 'yit' ),
        'desc' => __( 'Select the type to use for the p.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#555555',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => $this->get_selectors('p-tag'),
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id' => 'typography-h1-font',
        'type' => 'typography',
        'name' => __( 'Headings 1 font', 'yit' ),
        'desc' => __( 'Select the type to use for the h1.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 28,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h1, h2#yit-popup-title',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'typography-h2-font',
        'type' => 'typography',
        'name' => __( 'Headings 2 font', 'yit' ),
        'desc' => __( 'Select the type to use for the h2.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 24,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h2, .portfolio_big_image h2.post-title.portfolio-title a, .portfolio_small_image h2.post-title.portfolio-title a, #bbpress-forums #bbp-user-wrapper h2.entry-title',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),

    array(
        'id' => 'typography-h3-font',
        'type' => 'typography',
        'name' => __( 'Headings 3 font', 'yit' ),
        'desc' => __( 'Select the type to use for the h3.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => 'h3,.tabs-container ul.tabs li h4 a, .features-tab-container ul.features-tab-labels li h4 a, .yit_shortcodes.last-post h3 a, .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form .bp-login-widget-register-link a, .by-vendor-name a.by-vendor-name-link, #tab-yith_wc_vendor h2 a,
                              .woocommerce-shipping-calculator > p > a.shipping-calculator-button',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'typography-h4-font',
        'type' => 'typography',
        'name' => __( 'Headings 4 font', 'yit' ),
        'desc' => __( 'Select the type to use for the h4.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h4, .woocommerce-page div.product form.cart .variations label, .toggle h4.tab-index a, .toggle h4.tab-index a:hover, .woocommerce div.product form.cart .variations label, .woocommerce table.shop_table th, .woocommerce-page table.shop_table th,
            .cart-collaterals th,
            .widget.widget_bp_core_members_widget.buddypress.widget ul#members-list li.vcard a,
            .widget.widget_bp_groups_widget.buddypress.widget ul#groups-list li a,
            .widget.widget_bp_core_friends_widget.buddypress.widget ul#friends-list li.vcard a,
            .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-link a,
            .widget_bp_core_sitewide_messages.buddypress.widget .bp-site-wide-message #message p strong,
            .bbp-logged-in h4 a,
            #buddypress ul li .item-container .item .item-username a,
            #buddypress div.item-list-tabs#subnav ul li.current a,
            #buddypress div.item-list-tabs#subnav ul li.selected a,
            #buddypress div.item-list-tabs#subnav ul li a:hover,
            #buddypress #activity-stream .activity-header p a:hover,
            #buddypress #activity-stream .activity-comments .acomment-meta a:hover,
            #buddypress table.notifications tbody tr td a:hover,
            #buddypress table#message-threads tr td a:not(.button):hover,
            #buddypress #message-thread .highlight a:hover,
            #buddypress #group-settings-form ul li  h5 > a',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),

    array(
        'id' => 'typography-h5-font',
        'type' => 'typography',
        'name' => __( 'Headings 5 font', 'yit' ),
        'desc' => __( 'Select the type to use for the h5.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h5,.tweets-widget span.meta,
                             .woocommerce div.summary .product_meta,
                             .woocommerce div.summary .product-share,
                             #buddypress div#item-header h2,
                             #buddypress #item-header-content .highlight',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'typography-h6-font',
        'type' => 'typography',
        'name' => __( 'Headings 6 font', 'yit' ),
        'desc' => __( 'Select the type to use for the h6.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h6',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )  ,
        'in_skin'        => true,
    )
);

