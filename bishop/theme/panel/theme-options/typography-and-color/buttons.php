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
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
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
        'id' => 'button-font',
        'type' => 'typography',
        'name' => __( 'Buttons Typography', 'yit' ),
        'desc' => __( 'Select the font, color and size for buttons text.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.btn-flat, a.btn-flat,
                              .nav ul > li div div.btn-fb-login a,
                              #welcome-menu-login.nav ul > li #customer_login .button,
                              .yith-wcwl-add-button .add_to_wishlist,
                              .yith-wcwl-add-button .add_to_wishlist:before,
                              div.compare a.compare,
                              div.compare a.compare:before,
                              .yith-wcwl-wishlistaddedbrowse a,
                              .yith-wcwl-wishlistexistsbrowse a,
                              a.button.view,
                              .banner-image .button,
                              .wishlist_table .button,
                              a.btn.animated.btn-flat:hover,
                              table.compare-list .add-to-cart td a,
                              .wishlist-name a.wishlist-anchor,
                              .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a,
                              a.bp-title-button,
                              .widget.widget_price_filter button[type="submit"],
                              .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form input#bp-login-widget-submit,
                              .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                              a.compare.button,
                              .yit-maintenance-mode form.newsletter input.submit-field,
                              #buddypress div.generic-button a,
                              #buddypress a.button,
                              #buddypress div.generic-button a span,
                              #buddypress div.activity-meta a.button span,
                              #buddypress div.activity-comments form input,
                              #buddypress table#message-threads tr td.thread-options a.button,
                              #buddypress div.messages-options-nav > a,
                              #buddypress input#upload,
                              #buddypress #create-group-form input[type="submit"],
                              .cx-send a.cx-form-btn,
                              .woocommerce .cart-collaterals .cart_update_checkout .wc-proceed-to-checkout > a.wc-forward',
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
        'id' => 'button-hover-color',
        'type' => 'colorpicker',
        'name' => __( 'Buttons color hover', 'yit' ),
        'desc' => __( 'Select a text color hover for the buttons of all pages.', 'yit' ),
        'std'  => array(
            'color' => '#ffffff'
        ),
        'style' => array(
            'selectors'   => '.btn-flat:hover,
                              .nav ul > li div div.btn-fb-login a:hover,
                              a.btn-flat:hover,
                              #welcome-menu-login.nav ul > li #customer_login .button:hover,
                              .yith-wcwl-add-button .add_to_wishlist:hover,
                              .yith-wcwl-add-button .add_to_wishlist:hover:before,
                              div.compare a.compare:hover,
                              div.compare a.compare:hover:before,
                               .yith-wcwl-wishlistaddedbrowse a:hover,
                               .yith-wcwl-wishlistexistsbrowse a:hover,
                               a.button.view:hover,
                               table.compare-list .add-to-cart td a:hover,
                               .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a,
                               .widget.widget_price_filter button[type="submit"]:hover,
                               .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form input#bp-login-widget-submit:hover,
                               .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout:hover,
                               .yith-wcwl-wishlistaddedbrowse .feedback,
                               a.compare.button:hover,
                               .woocommerce a.button.wc-forward.btn-flat:hover,
                               a.button.wc-forward.btn-flat:hover,
                               .yit-maintenance-mode form.newsletter input.submit-field:hover,
                               #buddypress div.generic-button a:hover,
                               #buddypress a.button:hover,
                               #buddypress div.generic-button a:hover span,
                               #buddypress div.activity-meta a.button:hover span,
                               #buddypress div.activity-comments form input:hover,
                               #buddypress table#message-threads tr td.thread-options a.button:hover,
                               #buddypress div.messages-options-nav > a:hover,
                               #buddypress input#upload:hover,
                               #buddypress #create-group-form input[type="submit"]:hover,
                               .cx-send a.cx-form-btn:hover,
                               .woocommerce .cart-collaterals .cart_update_checkout .wc-proceed-to-checkout > a.wc-forward:hover',
            'properties'  => 'color'
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'button-background-color',
        'type' => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover' => __( 'Background hover color', 'yit ')
        ),
        'name' => __( 'Buttons background color', 'yit' ),
        'desc' => __( 'Select a color for the buttons background of all pages.', 'yit' ),
        'std'  => array(
			'color' => array(
				'normal' => 'transparent',
				'hover' => '#000000'
			)
		),
        'style' => array(
            'normal' => array(
                'selectors'   => '.btn-flat,
                                   a.btn-flat,
                                   button.button-login,
                                   .nav ul > li div div.btn-fb-login,
                                   .banner-image .button,
                                   #welcome-menu-login.nav ul > li #customer_login .button,
                                   .yith-wcwl-add-button .add_to_wishlist,
                                   div.compare a.compare, a.button.view,
                                   .wishlist_table .button,
                                   a.btn.animated.btn-flat,
                                   a.btn.animated.btn-flat:hover,
                                   table.compare-list .add-to-cart td a,
                                   .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a,
                                  .widget.widget_price_filter button[type="submit"],
                                  .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form input#bp-login-widget-submit,
                                  .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                                  a.compare.button,
                                  .yit-maintenance-mode form.newsletter input.submit-field,
                                  #buddypress div.generic-button a,
                                  #buddypress a.button,
                                  #buddypress div.activity-comments form input,
                                  #buddypress table#message-threads tr td.thread-options a.button,
                                  #buddypress div.messages-options-nav > a,
                                  #buddypress input#upload,
                                  #buddypress #create-group-form input[type="submit"],
                                  .cx-send a.cx-form-btn,
                                  .woocommerce .cart-collaterals .cart_update_checkout .wc-proceed-to-checkout > a.wc-forward',
                'properties'  => 'background-color, background'
            ),
            'hover' => array(
                'selectors'   => '.btn-flat:hover, a.btn-flat:hover, .nav ul > li div div.btn-fb-login:hover, #welcome-menu-login.nav ul > li #customer_login .button:hover, .yith-wcwl-add-button .add_to_wishlist:hover, div.compare a.compare:hover,
                                .woocommerce div.product-actions div.wishlist .yith-wcwl-wishlistaddedbrowse a:hover, .woocommerce div.product-actions div.wishlist .yith-wcwl-wishlistexistsbrowse a:hover, a.button.view:hover, #yith-wcwl-form a.button:hover, table.compare-list .add-to-cart td a:hover,
                                .widget.widget_price_filter button[type="submit"]:hover,
                                .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form input#bp-login-widget-submit:hover,
                                .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout:hover,
                                .yith-wcwl-wishlistaddedbrowse .feedback,
                                a.compare.button:hover,
                                .woocommerce a.button.wc-forward.btn-flat:hover,
                                a.button.wc-forward.btn-flat:hover,
                                .yit-maintenance-mode form.newsletter input.submit-field:hover,
                                #buddypress div.generic-button a:hover,
                                #buddypress a.button:hover,
                                #buddypress div.activity-comments form input:hover,
                                #buddypress table#message-threads tr td.thread-options a.button:hover,
                                #buddypress div.messages-options-nav > a:hover,
                                #buddypress input#upload:hover,
                                #buddypress #create-group-form input[type="submit"]:hover,
                                .cx-send a.cx-form-btn:hover,
                                .woocommerce .cart-collaterals .cart_update_checkout .wc-proceed-to-checkout > a.wc-forward:hover',
                'properties'  => 'background-color, background'
            )
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'button-border-color',
        'type' => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover' => __( 'Border hover color', 'yit' )
        ),
        'name' => __( 'Buttons border color', 'yit' ),
        'desc' => __( 'Select a color for the buttons border of all pages.', 'yit' ),
        'std'  => array(
            'color' => array(
                'normal' => '#5a5858',
                'hover' => '#000000'
            )
        ),
        'style' => array(
            'normal' => array(
                'selectors'   => '.btn-flat, a.btn-flat, .yith-wcwl-add-button .add_to_wishlist, .banner-image .button, div.compare a.compare, .nav ul > li div div.btn-fb-login, .yith-wcwl-wishlistaddedbrowse a, .yith-wcwl-wishlistexistsbrowse a, a.button.view, .wishlist_table .button, a.btn.animated.btn-flat, a.btn.animated.btn-flat:hover, table.compare-list .add-to-cart td a, .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a,
                                 a.bp-title-button, .widget.widget_price_filter button[type="submit"],
                                 .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form input#bp-login-widget-submit,
                                 .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout,
                                 a.compare.button, #welcome-menu-login.nav ul > li #customer_login .button,
                                 .yit-maintenance-mode form.newsletter input.submit-field,
                                 #buddypress div.generic-button a,
                                 #buddypress a.button,
                                 #buddypress div.activity-comments form input,
                                 #buddypress table#message-threads tr td.thread-options a.button,
                                 #buddypress div.messages-options-nav > a,
                                 #buddypress input#upload,
                                 #buddypress #create-group-form input[type="submit"],
                                 .cx-send a.cx-form-btn,
                                 .woocommerce .cart-collaterals .cart_update_checkout .wc-proceed-to-checkout > a.wc-forward',
                'properties'  => 'border-color'
            ),
            'hover' => array(
                'selectors'   => '.btn-flat:hover, a.btn-flat:hover, .yith-wcwl-add-button .add_to_wishlist:hover, .banner-image .button:hover, div.compare a.compare:hover, .nav ul > li div div.btn-fb-login:hover, .yith-wcwl-wishlistaddedbrowse a:hover, .yith-wcwl-wishlistexistsbrowse a:hover, a.button.view:hover, table.compare-list .add-to-cart td a:hover,
                                 .widget.widget_price_filter button[type="submit"]:hover,
                                 .widget.widget_bp_core_login_widget.buddypress.widget #bp-login-widget-form input#bp-login-widget-submit:hover,
                                 .widget.widget_bp_core_login_widget.buddypress.widget .bp-login-widget-user-logout a.logout:hover,
                                 .yith-wcwl-wishlistaddedbrowse .feedback:after,
                                 a.compare.button:hover,
                                 .yit-maintenance-mode form.newsletter input.submit-field:hover,
                                 #welcome-menu-login.nav ul > li #customer_login .button:hover,
                                 #buddypress div.generic-button a:hover,
                                 #buddypress a.button:hover,
                                 #buddypress div.activity-comments form input:hover,
                                 #buddypress table#message-threads tr td.thread-options a.button:hover,
                                 #buddypress div.messages-options-nav > a:hover,
                                 #buddypress input#upload:hover,
                                 #buddypress #create-group-form input[type="submit"]:hover,
                                 .cx-send a.cx-form-btn:hover,
                                 .woocommerce .cart-collaterals .cart_update_checkout .wc-proceed-to-checkout > a.wc-forward:hover',
                'properties'  => 'border-color'
            )
        ),
        'in_skin'        => true,
    ),

    /* ========= Button Alternative =========== */
    array(
        'type' => 'title',
        'name' => __( 'Buttons Alternative', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'button-font-alternative',
        'type' => 'typography',
        'name' => __( 'Buttons Typography', 'yit' ),
        'desc' => __( 'Select the font, color and size for buttons text.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.btn-alternative,
                              a.btn-alternative,
                              #welcome-menu-login.nav ul > li #customer_login .button.button-register,
                              #submit,
                              .button,
                              a.btn.animated.btn-alternative:hover,
                              .woocommerce-Button.button,
                              .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a:hover,
                              #comments ol li .information .user-info .is_author,
                              #buddypress div.item-list-tabs ul li a span,
                              #buddypress div.item-list-tabs ul li a:hover span,
                              #buddypress div.item-list-tabs ul li.current a span,
                              #buddypress div.item-list-tabs ul li.current a:hover span,
                              #buddypress div.item-list-tabs ul li.selected a span,
                              #buddypress div.item-list-tabs ul li.selected a:hover span,
                              #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                              #buddypress div.generic-button a.join-group,
                              #buddypress #whats-new-submit input[type="submit"],
                              #buddypress .standard-form div.submit input,
                              #buddypress .groups-members-search input[type="submit"],
                              #buddypress #group-settings-form input[type="submit"]:not(#upload),
                              #buddypress #search-message-form input[type="submit"],
                              #buddypress table#message-threads tr.unread td.thread-count span.unread-count,
                             .yith-wcwl-popup-button a.add_to_wishlist,
                             .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
                             .woocommerce .yith-wcwl-wishlist-new button,
                             .woocommerce .wishlist_table.cart .ask-an-estimate-button,
                             .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                             .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button .add-request-quote-button.button,
                             .single-product .summary.entry-summary .yith_ywraq_add_item_response_message,
                             .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith_ywraq_add_item_browse_message a',
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
        'id' => 'button-hover-color-alternative',
        'type' => 'colorpicker',
        'name' => __( 'Buttons color hover', 'yit' ),
        'desc' => __( 'Select a text color hover for the buttons of all pages.', 'yit' ),
        'std'  => array(
            'color' => '#ffffff'
        ),
        'style' => array(
            'selectors'   => '.btn-alternative:hover,
                              a.btn-alternative:hover,
                              #welcome-menu-login.nav ul > li #customer_login .button.button-register:hover,
                              #submit:hover, .button:hover,
                              #my-account-sidebar .user-profile span.logout a,
                              #my-account-content .addresses .title a.edit,
                              .woocommerce-MyAccount-navigation .user-profile span.logout a,
                              .woocommerce-MyAccount-content .addresses .title a.edit,
                              #bbpress-forums #subscription-toggle span a,
                              #bbpress-forums #favorite-toggle span a,
                              .widget.bbp_widget_login a.button,
                              #buddypress div.generic-button.not_friends[id^="friendship-button"] a:hover,
                              #buddypress div.generic-button a.join-group:hover,
                              #buddypress #whats-new-submit input[type="submit"]:hover,
                              #buddypress .standard-form div.submit input:hover,
                              #buddypress .groups-members-search input[type="submit"]:hover,
                              #buddypress #group-settings-form input[type="submit"]:not(#upload):hover,
                              #buddypress #search-message-form input[type="submit"]:hover,
                             .yith-wcwl-popup-button a.add_to_wishlist:hover,
                             .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes:hover,
                             .woocommerce .yith-wcwl-wishlist-new button:hover,
                             .woocommerce .wishlist_table.cart .ask-an-estimate-button:hover,
                             .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover',
            'properties'  => 'color'
        ),
        'in_skin'        => true,
    ),

    array(
        'id' => 'button-background-color-alternative',
        'type' => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover' => __( 'Background hover color', 'yit ')
        ),
        'linked_to' => array(
            'normal' => 'theme-color-1'
        ),
        'name' => __( 'Buttons background color', 'yit' ),
        'desc' => __( 'Select a color for the buttons background of all pages.', 'yit' ),
        'in_skin'        => true,
        'std'  => array(
			'color' => array(
				'normal' => '#f7c104',
				'hover' => '#000000'
			)
		),
        'style' => array(
            'normal' => array(
                'selectors'   => '.btn-alternative,
                                  a.btn-alternative,
                                  #welcome-menu-login.nav ul > li #customer_login .button.button-register,
                                  #submit, .button,
                                  .woocommerce input.button,
                                  .button.submit-field,
                                  a.btn.animated.btn-alternative:hover,
                                  .woocommerce.widget.widget_product_search #searchform #searchsubmit,
                                  #yith-searchsubmit, .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a:hover,
                                  #my-account-sidebar .user-profile span.logout,
                                  #my-account-content .addresses .title a.edit,
                                  .woocommerce-MyAccount-navigation .user-profile span.logout,
                                  .woocommerce-MyAccount-content .addresses .title a.edit,
                                  #bbpress-forums #subscription-toggle span,
                                  #bbpress-forums #favorite-toggle span,
                                  .widget.bbp_widget_login a.button,
                                  #comments ol li .information .user-info .is_author,
                                  #buddypress div.item-list-tabs ul li a span,
                                  #buddypress div.item-list-tabs ul li a:hover span,
                                  #buddypress div.item-list-tabs ul li.current a span,
                                  #buddypress div.item-list-tabs ul li.current a:hover span,
                                  #buddypress div.item-list-tabs ul li.selected a span,
                                  #buddypress div.item-list-tabs ul li.selected a:hover span,
                                  #buddypress div.dir-search input[type="submit"],
                                  #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                                  #buddypress div.generic-button a.join-group,
                                  #buddypress #whats-new-submit input[type="submit"],
                                  #buddypress .standard-form div.submit input,
                                  #buddypress .groups-members-search input[type="submit"],
                                  #buddypress #group-settings-form input[type="submit"]:not(#upload),
                                  #buddypress table#message-threads tr.unread td.thread-count span.unread-count,
                                  #buddypress #search-message-form input[type="submit"],
                                  .yith-wcwl-popup-button a.add_to_wishlist,
                                  .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
                                  .woocommerce .yith-wcwl-wishlist-new button,
                                  .woocommerce .wishlist_table.cart .ask-an-estimate-button,
                                  .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button',
                'properties'  => 'background-color, background'
            ),
            'hover' => array(
                'selectors'   => '.btn-alternative:hover,
                                  a.btn-alternative:hover,
                                  #welcome-menu-login.nav ul > li #customer_login .button.button-register:hover,
                                  #submit:hover,
                                  .woocommerce #respond input#submit:hover,
                                  .button:hover,
                                  .woocommerce input.button:hover,
                                  .button.submit-field:hover,
                                  .woocommerce .btn-alternative.button.checkout:hover,
                                  .woocommerce a.btn-alternative.button.checkout:hover,
                                  .woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,
                                  #yith-searchsubmit:hover,
                                  #my-account-sidebar .user-profile span.logout:hover,
                                  #my-account-content .addresses .title a.edit:hover,
                                  .woocommerce-MyAccount-navigation .user-profile span.logout:hover,
                                  .woocommerce-MyAccount-content .addresses .title a.edit:hover,
                                  #bbpress-forums #subscription-toggle span:hover,
                                  #bbpress-forums #favorite-toggle span:hover,
                                  .widget.bbp_widget_login a.button:hover,
                                  #buddypress div.dir-search input[type="submit"]:hover,
                                  #buddypress div.generic-button.not_friends[id^="friendship-button"] a:hover,
                                  #buddypress div.generic-button a.join-group:hover,
                                  #buddypress #whats-new-submit input[type="submit"]:hover,
                                  #buddypress .standard-form div.submit input:hover,
                                  #buddypress .groups-members-search input[type="submit"]:hover,
                                  #buddypress #group-settings-form input[type="submit"]:not(#upload):hover,
                                  #buddypress #search-message-form input[type="submit"]:hover,
                                  .yith-wcwl-popup-button a.add_to_wishlist:hover,
                                  .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes:hover,
                                  .woocommerce .yith-wcwl-wishlist-new button:hover,
                                  .woocommerce .wishlist_table.cart .ask-an-estimate-button:hover,
                                  .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover',
                'properties'  => 'background-color, background'
            )
        )
    ),

    array(
        'id' => 'button-border-color-alternative',
        'type' => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover' => __( 'Border hover color', 'yit' )
        ),
        'linked_to' => array(
            'normal' => 'theme-color-2'
        ),
        'in_skin'        => true,
        'name' => __( 'Buttons border color', 'yit' ),
        'desc' => __( 'Select a color for the buttons border of all pages.', 'yit' ),
        'std'  => array(
            'color' => array(
                'normal' => '#ffa509',
                'hover' => '#000000'
            )
        ),
        'style' => array(
            'normal' => array(
                'selectors'   => '.btn-alternative,
                                  a.btn-alternative,
                                  #welcome-menu-login.nav ul > li #customer_login .button.button-register,
                                  #submit,
                                  .button,
                                  a.btn.animated.btn-alternative:hover,
                                  .products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a:hover,
                                  #buddypress div.dir-search input[type="submit"],
                                  #buddypress div.generic-button.not_friends[id^="friendship-button"] a,
                                  #buddypress div.generic-button a.join-group,
                                  #buddypress #whats-new-submit input[type="submit"],
                                  #buddypress .standard-form div.submit input,
                                  #buddypress .groups-members-search input[type="submit"],
                                  #buddypress #group-settings-form input[type="submit"]:not(#upload),
                                  #buddypress table#message-threads tr.unread td.thread-count span.unread-count,
                                  #buddypress #search-message-form input[type="submit"],
                                  .yith-wcwl-popup-button a.add_to_wishlist,
                                  .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
                                  .woocommerce .yith-wcwl-wishlist-new button,
                                  .woocommerce .wishlist_table.cart .ask-an-estimate-button,
                                  .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button',
                'properties'  => 'border-color'
            ),
            'hover' => array(
                'selectors'   => '.btn-alternative:hover,
                                 a.btn-alternative:hover,
                                 #welcome-menu-login.nav ul > li #customer_login .button.button-register:hover,
                                 #submit:hover,
                                 .button:hover,
                                 #buddypress div.dir-search input[type="submit"]:hover,
                                 #buddypress div.generic-button.not_friends[id^="friendship-button"] a:hover,
                                 #buddypress div.generic-button a.join-group:hover,
                                 #buddypress #whats-new-submit input[type="submit"]:hover,
                                 #buddypress .standard-form div.submit input:hover,
                                 #buddypress .groups-members-search input[type="submit"]:hover,
                                 #buddypress #group-settings-form input[type="submit"]:not(#upload):hover,
                                 #buddypress #search-message-form input[type="submit"]:hover,
                                 .yith-wcwl-popup-button a.add_to_wishlist:hover,
                                 .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes:hover,
                                 .woocommerce .yith-wcwl-wishlist-new button:hover,
                                 .woocommerce .wishlist_table.cart .ask-an-estimate-button:hover,
                                 .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover',
                'properties'  => 'border-color'
            )
        )
    )
);

