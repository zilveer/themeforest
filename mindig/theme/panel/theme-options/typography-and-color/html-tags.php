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
                'normal' => '#c38c08',
                'hover'  => '#fab000'
            )
        ),
        'style' => array(
            'normal' => array(
                'selectors'   => $this->get_selectors( 'a-tag' ),
                'properties'  => 'color'
            ),
            'hover' => array(
                'selectors'   => $this->get_selectors( 'a-tag-hover' ),
                'properties'  => 'color'
            )
        ),
        'linked_to' => array(
            'normal' => 'theme-color-1',
            'hover'  => 'theme-color-2'
        )
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
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#686868',
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
            'size'      => 22,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => 'h1',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
            'size'      => 20,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => 'h2, .testimonial-wrapper .testimonial-name .name,
                              .team-section .member-name h4,
                              .woocommerce .login-form-checkout .woocommerce-info,
                              .quote-title span',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
            'style'     => '400',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => 'h3, fieldset.bbp-form legend',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h4, h4 span,
                             .features-tab-container ul.features-tab-labels li h4 a,
                             .single-product.woocommerce div.product form.cart .variations .label label,
                             #product-box form.cart .label label,
                             .cart-collaterals th,
                             .cart-collaterals td,
                             .cart-collaterals td span,
                             table.shop_table.cart td.product-subtotal span,
                             #order_review table tr.cart-subtotal td span,
                             #order_review table tr.total td span,
                             .woocommerce table.shop_table th,
                             #yith-wcwl-form table.shop_table th span,
                             .woocommerce-page table.shop_table.my_account_orders th span,
                             h4 span.title-highlight,
                             #buddypress div.item-list-tabs ul li a,
                             #buddypress div.item-list-tabs ul li span,
                             #buddypress div.item-list-tabs ul li.selected a,
                             #buddypress div.item-list-tabs ul li.current a,
                             #buddypress table.notifications thead th,
                             .bbp-logged-in h4 a,
                              #bbpress-forums li.bbp-body ul.forum li.bbp-forum-info > a,
                              #bbpress-forums li.bbp-body ul.topic li.bbp-topic-title > a',

            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h5, #payment li label, #shipping_method li label,
                              #yith-wcwl-form table.shop_table td.product-name a,
                              #yith-wcwl-form table.shop_table td.product-price span,
                              #bbpress-forums div.bbp-reply-author a.bbp-author-name,
                              #bbpress-forums li.bbp-header .bbp-reply-author,
                              #bbpress-forums li.bbp-footer .bbp-reply-author,
                              #bbpress-forums li.bbp-header .bbp-reply-content,
                              #bbpress-forums li.bbp-footer .bbp-reply-content,
                              #buddypress ul li .item-container .item .item-username a,
                              #buddypress ul#friend-list li .item .item-title a,
                              #buddypress table#message-threads tr td.thread-info p:first-child a,
                              .buddypress.widget ul li.vcard a,
                              .buddypress.widget ul li.bp-single-group a,
                              .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => 'h6, div.category-count-content span',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    )
);

