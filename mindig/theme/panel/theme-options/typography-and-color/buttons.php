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
 * Return an array with the options for Theme Options > Typography and Color > Buttons
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Buttons */

    array(
        'type' => 'title',
        'name' => __( 'Buttons Flat', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-font',
        'type'            => 'typography',
        'name'            => __( 'Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-flat, a.btn-flat,
                             .modal-shortcode .modal-opener a.btn-flat,
                            .parallaxeos_animate a.btn-flat span,
                            #header-row .yit-custom-megamenu > div > ul > li > a,
                            input.button,
                            a.btn.btn-flat.animated span,
                            .recent-post .hentry-post p.post-date .day,
                            .recent-post .hentry-post p.post-date .month,
                            .yith-wcwl-wishlistaddedbrowse span.feedback,
                            #yith-wcwl-form a.button,
                            table.my_account_orders a.button.view,
                            table.my_account_orders a.button.cancel,
                            table.my_account_orders a.button.pay,
                            .woocommerce-message .button.wc-forward,
                            #buddypress div.generic-button a,
                            #buddypress a.button,
                            #buddypress #group-creation-previous,
                            #buddypress #delete_inbox_messages,
                            #buddypress #delete_sentbox_messages,
                            .woocommerce-error .button.wc-forward,
                            button.single_add_to_cart_button.button,
                            .button.compare,
                            .blog input[type="submit"],
                            #my-account-content p.order-again a.button,
                            a.track-button,
                            a.comment-reply-link.button',

            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform'
        )
    ),

    array(
        'id'         => 'button-text-color',
        'type'       => 'colorpicker',
        'name'       => __( 'Buttons Text color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-flat, a.btn-flat, a.btn-flat.added,
                                .modal-shortcode .modal-opener a.btn-flat,
                                #header-row .yit-custom-megamenu > div > ul > li > a,
                                .nav  span.highlight-inverse,
                                input.button,
                                .btn.btn-flat i.fa,
                                .btn.btn-alternative i.fa,
                                a.btn.btn-flat.animated span,
                                .recent-post .hentry-post p.post-date .day,
                                .recent-post .hentry-post p.post-date .month,
                                .parallaxeos_animate a.btn-flat span,
                                .yith-wcwl-wishlistaddedbrowse span.feedback,
                                #yith-wcwl-form a.button,
                                table.my_account_orders a.button.view,
                                table.my_account_orders a.button.cancel,
                                table.my_account_orders a.button.pay,
                                .woocommerce-message .button.wc-forward,
                                a[class^=eg-portfolio-masonry],
                                #buddypress div.generic-button a,
                                #buddypress a.button,
                                #buddypress #group-creation-previous,
                                #buddypress #delete_inbox_messages,
                                #buddypress #delete_sentbox_messages,
                                .woocommerce-error .button.wc-forward,
                                button.single_add_to_cart_button.button,
                                .blog input[type="submit"],
                                .button.compare,
                                #my-account-content p.order-again a.button,
                                a.track-button,
                                a.comment-reply-link.button,
                                a.checkout-button.button.alt.wc-forward',

                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-flat:hover, a.btn-flat:hover,
                                #header-row .yit-custom-megamenu > div > ul > li > a:hover,
                                input.button:hover,
                                .parallaxeos_animate a.btn-flat:hover span,
                                #yith-wcwl-form a.button:hover,
                                .btn.btn-flat:hover i.fa,
                                a.btn.btn-flat.animated:hover span,
                                .btn.btn-alternative:hover i.fa,
                                table.my_account_orders a.button.view:hover,
                                table.my_account_orders a.button.cancel:hover,
                                table.my_account_orders a.button.pay:hover,
                                .woocommerce-message .button.wc-forward:hover,
                                #buddypress div.generic-button a:hover,
                                #buddypress a.button:hover,
                                #buddypress #group-creation-previous:hover,
                                #buddypress #delete_inbox_messages:hover,
                                #buddypress #delete_sentbox_messages:hover,
                                .woocommerce-error .button.wc-forward:hover,
                                button.single_add_to_cart_button.button:hover,
                                .blog input[type="submit"]:hover,
                                .button.compare:hover,
                                #my-account-content p.order-again a.button:hover,
                                a.track-button:hover,
                                a.comment-reply-link.button:hover',

                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'name'       => __( 'Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#1f1f1f',
                'hover'  => '#747474'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-flat, a.btn-flat,
                                #header-row .yit-custom-megamenu > div > ul > li > a,
                                .yith-wcwl-wishlistaddedbrowse span.feedback,
                                .parallaxeos_animate a.btn-flat span,
                                input.button,
                                #yith-wcwl-form a.button,
                                table.my_account_orders a.button.view,
                                table.my_account_orders a.button.cancel,
                                table.my_account_orders a.button.pay,
                                .woocommerce-message .button.wc-forward,
                                #buddypress div.generic-button a,
                                #buddypress a.button,
                                #buddypress #group-creation-previous,
                                #buddypress #delete_inbox_messages,
                                #buddypress #delete_sentbox_messages,
                                .woocommerce-error .button.wc-forward,
                                button.single_add_to_cart_button.button,
                                .blog input[type="submit"],
                                .button.compare,
                                #my-account-content p.order-again a.button,
                                a.track-button,
                                a.comment-reply-link.button',

                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-flat:hover, a.btn-flat:hover,
                                #header-row .yit-custom-megamenu > div > ul > li > a:hover,
                                .parallaxeos_animate a.btn-flat:hover span,
                                input.button:hover,
                                #yith-wcwl-form a.button:hover,
                                table.my_account_orders a.button.view:hover,
                                table.my_account_orders a.button.cancel:hover,
                                table.my_account_orders a.button.pay:hover,
                                .woocommerce-message .button.wc-forward:hover,
                                #buddypress div.generic-button a:hover,
                                #buddypress a.button:hover,
                                #buddypress #group-creation-previous:hover,
                                #buddypress #delete_inbox_messages:hover,
                                #buddypress #delete_sentbox_messages:hover,
                                .woocommerce-error .button.wc-forward:hover,
                                button.single_add_to_cart_button.button:hover,
                                .blog input[type="submit"]:hover,
                                .button.compare:hover,
                                #my-account-content p.order-again a.button:hover,
                                a.track-button:hover,
                                a.comment-reply-link.button:hover',

                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'name'       => __( 'Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#1f1f1f',
                'hover'  => '#747474'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-flat, a.btn-flat,
                                #header-row .yit-custom-megamenu > div > ul > li > a,
                                .nav  span.highlight-inverse,
                                .parallaxeos_animate a.btn-flat span,
                                input.button,
                                #yith-wcwl-form a.button,
                                table.my_account_orders a.button.view,
                                table.my_account_orders a.button.cancel,
                                table.my_account_orders a.button.pay,
                                .woocommerce-message .button.wc-forward,
                                #buddypress div.generic-button a,
                                #buddypress a.button,
                                #buddypress #group-creation-previous,
                                #buddypress #delete_inbox_messages,
                                #buddypress #delete_sentbox_messages,
                                .woocommerce-error .button.wc-forward,
                                button.single_add_to_cart_button.button,
                                .blog input[type="submit"],
                                .button.compare,
                                #my-account-content p.order-again a.button,
                                a.track-button,
                                a.comment-reply-link.button',

                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => '.btn-flat:hover, a.btn-flat:hover,
                                #header-row .yit-custom-megamenu > div > ul > li > a:hover,
                                input.button:hover,
                                .parallaxeos_animate a.btn-flat:hover span,
                                #yith-wcwl-form a.button:hover,
                                table.my_account_orders a.button.view:hover,
                                table.my_account_orders a.button.cancel:hover,
                                table.my_account_orders a.button.pay:hover,
                                .woocommerce-message .button.wc-forward:hover,
                                #buddypress div.generic-button a:hover,
                                #buddypress a.button:hover,
                                #buddypress #group-creation-previous:hover,
                                #buddypress #delete_inbox_messages:hover,
                                #buddypress #delete_sentbox_messages:hover,
                                .woocommerce-error .button.wc-forward:hover,
                                button.single_add_to_cart_button.button:hover,
                                .blog input[type="submit"]:hover,
                                .button.compare:hover,
                                #my-account-content p.order-again a.button:hover,
                                a.track-button:hover,
                                a.comment-reply-link.button:hover',

                'properties' => 'background-color, background'
            )
        )
    ),

    /* ========= Button Alternative =========== */

    array(
        'type' => 'title',
        'name' => __( 'Buttons Alternative', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-font-alternative',
        'type'            => 'typography',
        'name'            => __( 'Buttons Alternative Typography', 'yit' ),
        'desc'            => __( 'Select the typography for alternative buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-alternative, a.btn-alternative, #submit,
                            .modal-shortcode .modal-opener a.btn-alternative,
                             input.button.button-register.btn-alternative,
                             .register input.button.btn-alternative,
                             a.btn.btn-alternative.animated span,
                             .widget.widget_search #searchform #searchsubmit,.woocommerce-product-search input[type="submit"],
                             .error-404-container .error-404-search #searchsubmit,
                             .widget.widget_price_filter button[type="submit"],
                             .widget_product_search #searchform #searchsubmit,
                              #bbp_search_submit,
                              #bbp_reply_submit,
                              #bbp_topic_submit,
                              #bbp_user_edit_submit,
                              #buddypress input[type="submit"],
                              #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                              .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                              .widget.bbp_widget_login .button.logout-link,
                              .call-three .newsletter-cta-form-container input[type="submit"],
                              .cx-form-btn,input#place_order,
                              .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist,
                              .submit-wishlist-changes,
                              .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                              .woocommerce .yith-wcwl-wishlist-new button,
                              a.stop-reply.button,
                              a.checkout-button.button.alt.wc-forward',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform'
        )
    ),

    array(
        'id'         => 'button-hover-color-alternative',
        'type'       => 'colorpicker',
        'name'       => __( 'Buttons Alternative Text Color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the alternative buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit ' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-alternative, a.btn-alternative, a.btn-alternative:active, #submit,
                                #my-account-sidebar .user-profile span.logout a,
                                nav.woocommerce-MyAccount-navigation .user-profile span.logout a,
                                .modal-shortcode .modal-opener a.btn-alternative,
                                input.button.button-register.btn-alternative,
                                .widget.widget_search #searchform #searchsubmit, .woocommerce-product-search input[type="submit"],
                                .parallaxeos_animate a.btn-alternative span,
                                #my-account-content .addresses .title a.edit,
                                .woocommerce-MyAccount-content .woocommerce-Address .title a.edit,
                                .register input.button.btn-alternative,
                                a.btn.btn-alternative.animated span,
                                .error-404-container .error-404-search #searchsubmit,
                                .widget.widget_price_filter button[type="submit"],
                                .widget_product_search #searchform #searchsubmit,
                                #bbp_search_submit,
                                #bbp_reply_submit,
                                #bbp_topic_submit,
                                #subscription-toggle span a,
                                #favorite-toggle span a,
                                #bbp_user_edit_submit,
                                #buddypress input[type="submit"],
                                #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                                #buddypress div.item-list-tabs ul li a span,
                                #buddypress div.item-list-tabs ul li a:hover span,
                                .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                                .widget.bbp_widget_login .button.logout-link,
                                .call-three .newsletter-cta-form-container input[type="submit"],
                                .cx-form-btn,input#place_order,
                                .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist,
                                .submit-wishlist-changes,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                                .woocommerce .yith-wcwl-wishlist-new button,
                                a.stop-reply.button,
                                a.checkout-button.button.alt.wc-forward',

                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-alternative:hover, a.btn-alternative:hover, #submit:hover,
                                #my-account-sidebar .user-profile span.logout:hover a,
                                nav.woocommerce-MyAccount-navigation .user-profile span.logout:hover a,
                                input.button.button-register.btn-alternative:hover,
                                .widget.widget_search #searchform #searchsubmit:hover, .woocommerce-product-search input[type="submit"]:hover,
                                #my-account-content .addresses .title a.edit:hover,
                                .woocommerce-MyAccount-content .woocommerce-Address .title a.edit:hover,
                                a.btn.btn-alternative.animated:hover span,
                                .register input.button.btn-alternative:hover,
                                .error-404-container .error-404-search #searchsubmit:hover,
                                .widget.widget_price_filter button[type="submit"]:hover,
                                .widget_product_search #searchform #searchsubmit:hover,
                                #bbp_search_submit:hover,
                                #bbp_reply_submit:hover,
                                #bbp_topic_submit:hover,
                                #subscription-toggle span a:hover,
                                #favorite-toggle span a:hover,
                                #bbp_user_edit_submit:hover,
                                #buddypress input[type="submit"]:hover,
                                #buddypress div.generic-button.not_friends[id^="friendship-button"] a:hover,
                                .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout:hover,
                                .widget.bbp_widget_login .button.logout-link:hover,
                                .call-three .newsletter-cta-form-container input[type="submit"]:hover,
                                .cx-form-btn:hover,input#place_order:hover,
                                .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist:hover,
                                .submit-wishlist-changes:hover,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover,
                                .woocommerce .yith-wcwl-wishlist-new button:hover,
                                a.stop-reply.button:hover,
                                a.checkout-button.button.alt.wc-forward:hover',

                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color-alternative',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-2'
        ),
        'name'       => __( 'Buttons Alternative border color', 'yit' ),
        'desc'       => __( 'Select a color for the alternative buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#e9a400',
                'hover'  => '#747474'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-alternative, a.btn-alternative, #submit,
                                 input.button.button-register.btn-alternative,
                                 .widget.widget_search #searchform #searchsubmit, .woocommerce-product-search input[type="submit"],
                                 .error-404-container .error-404-search #searchsubmit,
                                 .register input.button.btn-alternative,
                                 .widget.widget_price_filter button[type="submit"],
                                 #bbp_search_submit,
                                 #bbp_reply_submit,
                                 #bbp_topic_submit,
                                 #subscription-toggle span,
                                 #favorite-toggle span,
                                 #bbp_user_edit_submit,
                                 #buddypress input[type="submit"],
                                 #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                                 .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                                 .widget.bbp_widget_login .button.logout-link,
                                 .call-three .newsletter-cta-form-container input[type="submit"],
                                 .cx-form-btn,input#place_order,
                                 .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist,
                                 .submit-wishlist-changes,
                                 .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                                 .woocommerce .yith-wcwl-wishlist-new button,
                                 a.stop-reply.button,
                                 a.checkout-button.button.alt.wc-forward',

                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-alternative:hover, a.btn-alternative:hover, #submit:hover,
                                 .widget.widget_search #searchform #searchsubmit:hover, .woocommerce-product-search input[type="submit"]:hover,
                                 input.button.button-register.btn-alternative:hover,
                                 .register input.button.btn-alternative:hover,
                                 .error-404-container .error-404-search #searchsubmit:hover,
                                 .widget.widget_price_filter button[type="submit"]:hover,
                                 #bbp_search_submit:hover,
                                 #bbp_reply_submit:hover,
                                 #bbp_topic_submit:hover,
                                 #subscription-toggle span:hover,
                                 #favorite-toggle span:hover,
                                 #bbp_user_edit_submit:hover,
                                 #buddypress input[type="submit"]:hover,
                                 #buddypress div.generic-button.not_friends[id^="friendship-button"] a:hover,
                                 .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout:hover,
                                 .widget.bbp_widget_login .button.logout-link:hover,
                                 .call-three .newsletter-cta-form-container input[type="submit"]:hover,
                                 .cx-form-btn:hover,input#place_order:hover,
                                 .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist:hover,
                                 .submit-wishlist-changes:hover,
                                 .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover,
                                 .woocommerce .yith-wcwl-wishlist-new button:hover,
                                 a.stop-reply.button:hover,
                                 a.checkout-button.button.alt.wc-forward:hover',

                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color-alternative',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-1'
        ),
        'name'       => __( 'Buttons Alternative background color', 'yit' ),
        'desc'       => __( 'Select a color for the alternative buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#e9a400',
                'hover'  => '#747474'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-alternative, a.btn-alternative, #submit,
                                #my-account-sidebar .user-profile span.logout,
                                nav.woocommerce-MyAccount-navigatio .user-profile span.logout,
                                nav.woocommerce-MyAccount-navigation .user-profile span.logout,
                                input.button.button-register.btn-alternative,
                                .widget.widget_search #searchform #searchsubmit, .woocommerce-product-search input[type="submit"],
                                .nav  span.highlight,
                                .register input.button.btn-alternative,
                                #my-account-content .addresses .title a.edit,
                                .woocommerce-MyAccount-content .woocommerce-Address .title a.edit,
                                .error-404-container .error-404-search #searchsubmit,
                                .widget.widget_price_filter button[type="submit"],
                                .widget_product_search #searchform #searchsubmit,
                                #bbp_search_submit,
                                #bbp_reply_submit,
                                #bbp_topic_submit,
                                #subscription-toggle span,
                                #favorite-toggle span,
                                #bbp_user_edit_submit,
                                #buddypress input[type="submit"],
                                #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                                #buddypress div.item-list-tabs ul li a span,
                                #buddypress div.item-list-tabs ul li a:hover span,
                                #buddypress div.item-list-tabs ul li.selected a span,
                                #buddypress li span.unread-count,
                                #buddypress tr.unread span.unread-count,
                                .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                                .widget.bbp_widget_login .button.logout-link,
                                .call-three .newsletter-cta-form-container input[type="submit"],
                                .cx-form-btn,input#place_order,
                                .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist,
                                .submit-wishlist-changes,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                                .woocommerce .yith-wcwl-wishlist-new button,
                                a.stop-reply.button,
                                a.checkout-button.button.alt.wc-forward',

                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => '.btn-alternative:hover, a.btn-alternative:hover, #submit:hover,
                                #my-account-sidebar .user-profile span.logout:hover,
                                nav.woocommerce-MyAccount-navigation .user-profile span.logout:hover,
                                #my-account-content .addresses .title a.edit:hover,
                                .woocommerce-MyAccount-content .woocommerce-Address .title a.edit:hover,
                                .widget.widget_search #searchform #searchsubmit:hover, .woocommerce-product-search input[type="submit"]:hover,
                                input.button.button-register.btn-alternative:hover,
                                .register input.button.btn-alternative:hover,
                                .error-404-container .error-404-search #searchsubmit:hover,
                                .widget.widget_price_filter button[type="submit"]:hover,
                                .widget_product_search #searchform #searchsubmit:hover,
                                #bbp_search_submit:hover,
                                #bbp_reply_submit:hover,
                                #bbp_topic_submit:hover,
                                #subscription-toggle span:hover,
                                #favorite-toggle span:hover,
                                #bbp_user_edit_submit:hover,
                                #buddypress input[type="submit"]:hover,
                                #buddypress div.generic-button.not_friends[id^="friendship-button"] a:hover,
                                .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout:hover,
                                .widget.bbp_widget_login .button.logout-link:hover,
                                .call-three .newsletter-cta-form-container input[type="submit"]:hover,
                                .cx-form-btn:hover,input#place_order:hover,
                                .yith-wcwl-popup-button .add_to_wishlist.single_add_to_wishlist:hover,
                                .submit-wishlist-changes:hover,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover,
                                .woocommerce .yith-wcwl-wishlist-new button:hover,
                                a.stop-reply.button:hover,
                                a.checkout-button.button.alt.wc-forward:hover',

                'properties' => 'background-color, background'
            )
        )
    ),

    /* ========= Ghost Button =========== */

    array(
        'type' => 'title',
        'name' => __( 'Ghost Button', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-ghost-font',
        'type'            => 'typography',
        'name'            => __( 'Ghost Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for ghost buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-ghost,
                             a.btn-ghost,
                             #footer a.btn-ghost,
                             .eg-item-skin-1-wrapper .esg-top .btn-eg a,
                             .eg-item-skin-1-wrapper .esg-top .btn-eg,
                             table.compare-list .add-to-cart td a,
                             .teaser-wrapper .btn-ghost,
                             .eg-mindig-shop-element-16,
                             .yith-wcan-reset-navigation.button',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
        )
    ),

    array(
        'id'         => 'button-hover-color-ghost',
        'type'       => 'colorpicker',
        'name'       => __( 'Ghost Buttons Text Color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the ghost buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit ' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#d89c0a',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-ghost,
                                a.btn-ghost,
                                #footer a.btn-ghost,
                                .teaser-wrapper .btn-ghost,
                                .eg-item-skin-1-wrapper .esg-top .btn-eg a,
                                .eg-item-skin-1-wrapper .esg-top .btn-eg,
                                .parallaxeos_animate a.btn-ghost span,
                                .eg-mindig-shop-element-16,
                                .yith-wcan-reset-navigation.button',
                 'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost:hover,
                                a.btn-ghost:hover,
                                #footer a.btn-ghost:hover,
                                .parallaxeos_animate a.btn-ghost:hover span,
                                .eg-item-skin-1-wrapper:hover .esg-top .btn-eg a,
                                .eg-item-skin-1-wrapper:hover .esg-top .btn-eg,
                                .teaser-wrapper .btn-ghost:hover,
                                .btn-eg a:hover,
                                .teaser-wrapper:hover .btn-ghost,
                                #footer .teaser-wrapper:hover .btn-ghost,
                                .eg-mindig-shop-element-16:hover,
                                .yith-wcan-reset-navigation.button:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color-ghost',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-2'
        ),
        'name'       => __( 'Ghost Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#d89c0a ',
                'hover'  => '#d89c0a '
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-ghost,
                                 a.btn-ghost,
                                 #footer a.btn-ghost,
                                .eg-item-skin-1-wrapper .esg-top .btn-eg a,
                                .eg-item-skin-1-wrapper .esg-top .btn-eg,
                                .parallaxeos_animate a.btn-ghost,
                                .teaser-wrapper .btn-ghost,
                                .eg-mindig-shop-element-16,
                                .yith-wcan-reset-navigation.button',
                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost:hover,
                                 a.btn-ghost:hover,
                                 #footer a.btn-ghost:hover,
                                .parallaxeos_animate a.btn-ghost:hover,
                                .eg-item-skin-1-wrapper:hover .esg-top .btn-eg a,
                                .eg-item-skin-1-wrapper:hover .esg-top .btn-eg,
                                .teaser-wrapper .btn-ghost:hover,
                                .teaser-wrapper:hover .btn-ghost,
                                #footer .teaser-wrapper:hover .btn-ghost,
                                .eg-mindig-shop-element-16:hover,
                                .yith-wcan-reset-navigation.button:hover',
                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color-ghost',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-1'
        ),
        'name'       => __( 'Ghost Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => 'transparent',
                'hover'  => '#d89c0a'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost,
                                .btn-ghost,
                                #footer a.btn-ghost,
                                .parallaxeos_animate a.btn-ghost,
                                .eg-item-skin-1-wrapper .esg-top .btn-eg a,
                                .eg-item-skin-1-wrapper .esg-top .btn-eg,
                                div.widget.teaser-wrapper .teaser-wrapper .btn-ghost,
                                .eg-mindig-shop-element-16,
                                .yith-wcan-reset-navigation.button',
                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost:hover,
                                a.btn-ghost:hover,
                                #footer a.btn-ghost:hover,
                                .parallaxeos_animate a.btn-ghost:hover,
                                div.widget.teaser .teaser-wrapper .btn-ghost:hover,
                                .btn-eg a:hover,
                                 li.esg-hovered:hover .esg-top .btn-eg a,
                                 li.esg-hovered:hover .esg-top .btn-eg,
                                div.widget.teaser .teaser-wrapper:hover .btn-ghost,
                                #footer div.widget.teaser .teaser-wrapper:hover .btn-ghost,
                                .eg-mindig-shop-element-16:hover,
                                .yith-wcan-reset-navigation.button:hover',
                'properties' => 'background-color, background'
            )
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Ghost Alternative Button', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-ghost-alternative-font',
        'type'            => 'typography',
        'name'            => __( 'Ghost Alternative Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for alternative ghost buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-ghost-alternative, .blog .more-link, .blog .read-more, .blog a.read-more,
                            a.btn-ghost-alternative',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
        )
    ),

    array(
        'id'         => 'button-ghost-alternative-color',
        'type'       => 'colorpicker',
        'name'       => __( 'Ghost Alternative Buttons Text Color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the ghost alternative buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit ' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#1f1f1f',
                'hover'  => '#ffffff '
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-alternative, .btn-ghost-alternative, .blog .more-link, .blog a.read-more',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => 'a.btn-ghost-alternative:hover, .btn-ghost-alternative:hover, .blog .more-link:hover, .blog a.read-more:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color-ghost-alternative',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'name'       => __( 'Ghost Alternative Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost alternative buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#1f1f1f ',
                'hover'  => '#1f1f1f '
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-alternative, .btn-ghost-alternative, .blog .more-link, .blog a.read-more',
                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => 'a.btn-ghost-alternative, .btn-ghost-alternative:hover, .blog .more-link:hover, .blog a.read-more:hover',
                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color-ghost-alternative',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'name'       => __( 'Ghost Alternative Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost alternative buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => 'transparent',
                'hover'  => '#1f1f1f'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-alternative, .btn-ghost-alternative, .blog .more-link, .blog a.read-more',
                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => 'a.btn-ghost-alternative:hover, .btn-ghost-alternative:hover, .blog .more-link:hover, .blog a.read-more:hover',
                'properties' => 'background-color, background'
            )
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Ghost White Button', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-ghost-white-font',
        'type'            => 'typography',
        'name'            => __( 'Ghost White Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for white ghost buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-ghost-white, a.btn-ghost-white',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
        )
    ),

    array(
        'id'         => 'button-ghost-white-color',
        'type'       => 'colorpicker',
        'name'       => __( 'Ghost White Buttons Text Color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the ghost white buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit ' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#ffffff '
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-white, .btn-ghost-white',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => 'a.btn-ghost-white:hover, .btn-ghost-white:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color-ghost-white',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'name'       => __( 'Ghost White Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost white buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#d89c0a'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-white, .btn-ghost-white',
                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => 'a.btn-ghost-white:hover, .btn-ghost-white:hover',
                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color-ghost-white',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'name'       => __( 'Ghost White Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost white buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => 'transparent',
                'hover'  => '#d89c0a'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-white, .btn-ghost-white',
                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => 'a.btn-ghost-white:hover, .btn-ghost-white:hover',
                'properties' => 'background-color, background'
            )
        )
    ),
);

