<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

    /**
     * ReduxFramework Theme Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "et_options";

    if(!function_exists('et_redux_header_types')) {
        function et_redux_header_types($opt_name) {

            Redux::setSection( $opt_name, array(
                'title' => 'Header Type',
                'id' => 'general-header',
                'icon' => 'el-icon-cog',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'header_type',
                        'type' => 'image_select',
                        'operator' => 'and',
                        'title' => 'Header Type',
                        'options' => array (
                            1 => array (
                                'title' => 'Variant 1',
                                'img' => ET_CODE_IMAGES . 'headers/1.jpg',
                            ),
                            2 => array (
                                'title' => 'Variant 2',
                                'img' => ET_CODE_IMAGES . 'headers/2.jpg',
                            ),
                            3 => array (
                                'title' => 'Variant 3',
                                'img' => ET_CODE_IMAGES . 'headers/3.jpg',
                            ),
                            /*4 => array (
                                'title' => 'Variant 4',
                                'img' => ET_CODE_IMAGES . 'headers/4.jpg',
                            ),*/
                            5 => array (
                                'title' => 'Variant 4',
                                'img' => ET_CODE_IMAGES . 'headers/5.jpg',
                            ),
                            6 => array (
                                'title' => 'Variant 5',
                                'img' => ET_CODE_IMAGES . 'headers/6.jpg',
                            ),
                            7 => array (
                                'title' => 'Variant 6',
                                'img' => ET_CODE_IMAGES . 'headers/7.jpg',
                            ),
                            8 => array (
                                'title' => 'Variant 7',
                                'img' => ET_CODE_IMAGES . 'headers/8.jpg',
                            ),
                            9 => array (
                                'title' => 'Variant 8',
                                'img' => ET_CODE_IMAGES . 'headers/9.jpg',
                            ),
                            10 => array (
                                'title' => 'Variant 9',
                                'img' => ET_CODE_IMAGES . 'headers/10.jpg',
                            ),
                            /*11 => array (
                                'title' => 'Variant 11',
                                'img' => ET_CODE_IMAGES . 'headers/11.jpg',
                            ),
                            12 => array (
                                'title' => 'Variant 12',
                                'img' => ET_CODE_IMAGES . 'headers/12.jpg',
                            ),
                            13 => array (
                                'title' => 'Vertical header',
                                'img' => ET_CODE_IMAGES . 'headers/13.jpg',
                            ),
                            14 => array (
                                'title' => 'Vertical header 2',
                                'img' => ET_CODE_IMAGES . 'headers/14.jpg',
                            ),
                            15 => array (
                                'title' => 'Variant 15',
                                'img' => ET_CODE_IMAGES . 'headers/15.jpg',
                            ),
                            16 => array (
                                'title' => 'Variant 16',
                                'img' => ET_CODE_IMAGES . 'headers/16.jpg',
                            ),*/
                            17 => array (
                                'title' => 'Variant 10',
                                'img' => ET_CODE_IMAGES . 'headers/17.jpg',
                            ),
                        ),
                        'default' => 1
                    ),
                ),
            ) );
        }
    }

    if(!function_exists('et_redux_theme_options')) {
        function et_redux_theme_options($opt_name) {
            Redux::setSection( $opt_name, array(
                'title' => 'Content',
                'id' => 'style-content',
                'icon' => 'el-icon-picture',
                'subsection' => true,
                'fields' => array (
                    /*array (
                        'id' => 'dark_styles',
                        'type' => 'switch',
                        'title' => 'Dark version',
                    ),*/
                    array (
                        'id' => 'activecol',
                        'type' => 'color',
                        'operator' => 'and',
                        'title' => 'Main Color',
                    ),
                    array (
                        'id' => 'background_img',
                        'type' => 'background',
                        'output' => 'body',
                        'title' => 'Site Background',
                    ),

                    array (
                        'id' => 'container_bg',
                        'type' => 'color_rgba',
                        'title' => 'Container Background Color',
                        'output' => array(
                            'background-color' =>'.select2-results, .select2-drop, .select2-container .select2-choice, .form-control, .page-wrapper, .cart-popup-container, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea, #searchModal, .quick-view-popup, #etheme-popup'
                        )
                    ),
                    array (
                        'id' => 'global_border_color',
                        'type' => 'color',
                        'title' => 'Global borders color',
                        'output' => array(
                            'border-color' => '.after-shop-loop .pagination-cubic, .bag-total-table .order-total, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="checkbox"], textarea, .order-review .order-total, select, .tabs .tab-content, .right-bar .left-titles .tab-title-left:last-child, .right-bar .left-titles .tab-title-left.opened, .right-bar .left-titles .tab-title-left, .left-bar .left-titles .tab-title-left:last-child, .left-bar .left-titles .tab-title-left, .tabs.accordion .tab-title, .carousel-area h2, .sidebar-widget.widget_search .form-group.has-border input, .sidebar-slider.widget_search .form-group.has-border input, .widget-container.widget_search .form-group.has-border input, .project-navigation, .single-tags a, .form-control, .header-wrapper.header-type-9, hr, hr.divider, .tabs .tab-content, .product_list_widget li, .tabs, .product-information .cart, .product-information h4.title, article.post-grid.content-mosaic > div, .sidebar-widget .widget-title, .sidebar-slider .widget-title, .widget-container .widget-title, .filter-wrap, .filter-wrap .view-switcher .switchToList, .filter-wrap .view-switcher .switchToGrid, .pagination-cubic ul li, .products-grid, .product-information .product_meta, .owl-carousel .owl-controls .owl-buttons > div.disabled, .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td, h3.underlined, .reference p, table > thead > tr > th, table > tbody > tr > th, table > tfoot > tr > th, table > thead > tr > td, table > tbody > tr > td, table > tfoot > tr > td, .cart-collaterals .title, h3.step-title, h4.step-title, input.input-text.qty.text, .quantity, .quantity input[type="number"]::-webkit-inner-spin-button, .select2-container-active .select2-choice, .select2-container-active .select2-choices, .select2-container .select2-choice, table.shop_table td.product-remove a, .cart-popup-container, .cart-popup-container p,.template-container .mobile-menu-wrapper'
                        )
                    ),
                    array (
                        'id' => 'lightbox_bg',
                        'type' => 'color',
                        'title' => 'Lightbox background',
                        'output' => array(
                            'background-color' => '.mfp-bg, .emodal-overlay'
                        )
                    ),
                    array (
                        'id' => 'links_color',
                        'type' => 'color',
                        'title' => 'Links',
                        'output' => array(
                            'color' => 'a'
                        )
                    ),
                    array (
                        'id' => 'links_hover_color',
                        'type' => 'color',
                        'title' => 'Links hover',
                        'output' => array(
                            'color' => 'a:hover'
                        )
                    ),
                    array (
                        'id' => 'top_bar_color',
                        'type' => 'color_rgba',
                        'title' => 'Top Bar background',
                        'output' => array(
                            'background-color' => '.top-bar, .home .header-type-3 .top-bar , .breadcrumbs-type-8 .top-bar, body.home .header-type-3 .top-bar'
                        )
                    ),
                    array (
                        'id' => 'top_bar_links_color',
                        'type' => 'color',
                        'title' => 'Top Bar Links',
                        'output' => array(
                            'color' => '.top-bar a, .languages li a, .top-links li.popup_link:before, .top-links li:after, .top-bar .widget_nav_menu .menu > li > a, .top-bar .widget_nav_menu .menu > li, .topbar-widget .menu-social-icons li i'
                        )
                    ),
                    array (
                        'id' => 'top_bar_links_hover_color',
                        'type' => 'color',
                        'title' => 'Top Bar Links Hover',
                        'output' => array(
                            'color' => '.top-bar a:hover, .languages li a:hover, .top-links li.popup_link:hover:before, .top-links li:hover:after, .top-bar .widget_nav_menu .menu > li > a:hover, .top-bar .widget_nav_menu .menu > li:hover, .topbar-widget .menu-social-icons li:hover i'
                        )
                    ),
                    array (
                        'id' => 'header_bg_color',
                        'type' => 'background',
                        'title' => 'Header Background',
                        'output' => array(
                            'background' => '.header-wrapper, .header-vertical-enable .header-vertical.header-wrapper'
                        )
                    ),
                    array (
                        'id' => 'fixed_header_bg_color',
                        'type' => 'background',
                        'title' => 'Fixed Header Background',
                        'output' => array(
                            'background' => '.fixNav-enabled .fixed-active .header-wrapper'
                        )
                    ),

                ),
            ));

            
            Redux::setSection( $opt_name, array(
                'title' => 'Navigation',
                'id' => 'style-nav',
                'icon' => 'el-icon-picture',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'main_nav_color',
                        'type' => 'color',
                        'title' => 'Main Navigation',
                        'output' => array(
                            'background-color' => '.menu-wrapper, .header-type-16 .menu-wrapper, home.breadcrumbs-type-8 a.popup-with-form'
                        )
                    ),
                    array (
                        'id' => 'main_nav_active_links',
                        'type' => 'color',
                        'title' => 'Main Navigation Active links',
                        'output' => array(
                            'color' => '.menu > li.current-menu-item > a, .menu > li.current_page_ancestor > a'
                        )
                    ),
                    array (
                        'id' => 'main_nav_border_top_color',
                        'type' => 'color',
                        'title' => 'Main Navigation top border Color',
                        'output' => array(
                            'border-top-color' => '.menu-wrapper'
                        )
                    ),
                    array (
                        'id' => 'main_nav_border_bottom_color',
                        'type' => 'color',
                        'title' => 'Main Navigation bottom border Color',
                        'output' => array(
                            'border-bottom-color' => '.menu-wrapper'
                        )
                    ),
                    array (
                        'id' => 'submenu_bg_color',
                        'type' => 'background',
                        'title' => 'Submenu Background Color',
                        'output' => array(
                            'background-color' => '.menu .nav-sublist-dropdown, .menu .nav-sublist-dropdown ul > li ul, .template-container .mobile-menu-wrapper'
                        )
                    ),
                    array (
                        'id' => 'submenu_border_color',
                        'type' => 'color',
                        'title' => 'Submenu Border Color',
                        'output' => array(
                            'border-color' => '.menu .item-design-full-width .nav-sublist-dropdown, .menu .nav-sublist-dropdown ul'
                        )
                    ),
                    array (
                        'id' => 'main_navigation_links',
                        'type' => 'link_color',
                        'title' => 'Main Navigation links',
                        'output' => array('.menu > li.current-menu-item > a, .menu > li.current_page_ancestor > a', '.menu > li > a', '.header-vertical-enable .header-vertical .menu-wrapper .menu > li > a', '.menu > li.menu-item-has-children > a:after', '.menu .item-design-full-width .nav-sublist-dropdown ul > li > a, .navbar-right a.popup-with-form'),
                    ),
                    array (
                        'id' => 'main_navigation_subitem_links',
                        'type' => 'link_color',
                        'title' => 'Main Navigation Subitem links',
                        'output' => array('.menu .nav-sublist-dropdown ul > li > a' , '.menu .item-design-full-width .nav-sublist-dropdown .nav-sublist li a', '.template-container .mobile-menu-wrapper .menu > li > a', '.template-container .mobile-menu-wrapper .menu > li .nav-sublist-dropdown ul li a'),
                    ),
                    array (
                        'id' => 'main_navigation_column_links',
                        'type' => 'link_color',
                        'title' => 'Mega Menu column title',
                        'output' => array('.menu .item-design-full-width .nav-sublist-dropdown ul > li > a, .menu .item-design-full-width.demo-column .nav-sublist-dropdown ul > li a'),
                    ),
                    array (
                        'id' => 'fixed_navigation_links',
                        'type' => 'link_color',
                        'title' => 'Fixed Navigation links',
                        'output' => array('.fixNav-enabled .fixed-active .menu-wrapper .menu > li > a'),
                    ),
                    array (
                        'id' => 'fixed_navigation_links_active',
                        'type' => 'link_color',
                        'title' => 'Fixed Navigation active links',
                        'output' => array('.fixNav-enabled .fixed-active .menu-wrapper .menu > li.current-menu-item > a'),
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => 'WooCommerce',
                'id' => 'style-woo',
                'icon' => 'el-icon-picture',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'buttons_bg_color',
                        'type' => 'color',
                        'title' => 'WooCommerce buttons on Products page background',
                        'output' => array(
                            'background-color' => '.product .progress-button, .product .product_type_simple, .product .product_type_grouped, .shopping-container .btn.border-grey, .cart_list.product_list_widget .btn.border-grey, .product .progress-button, .product .product_type_simple, .product .product_type_grouped, .product .product_type_external, .product .btn.product_type_variable, .emodal .emodal-text .btn.filled.active, .actions input[type="submit"].btn.gray'
                        )
                    ),
                    array (
                        'id' => 'buttons_border_color',
                        'type' => 'color',
                        'title' => 'WooCommerce buttons on Products page border',
                        'output' => array(
                            'border-color' => '.product .content-product .btn, .shopping-container .btn.border-grey, .cart_list.product_list_widget .btn.border-grey'
                        )
                    ),
                    array (
                        'id' => 'buttons_hover_bg_color',
                        'type' => 'color',
                        'title' => 'WooCommerce buttons on Products page hover background',
                        'output' => array(
                            'background-color' => '.product .progress-button:hover, .product .product_type_simple:hover, .product .product_type_grouped:hover, .product .product_type_external:hover, .product .btn.product_type_variable:hover, .emodal-text .btn.filled.active:hover, .actions input[type="submit"].btn.gray:hover, .product .progress-button:hover, .product .product_type_simple:hover, .product .product_type_grouped:hover, .shopping-container .btn.border-grey:hover, .cart_list.product_list_widget .btn.border-grey:hover, .product .progress-button:hover, .product .product_type_simple:hover, .product .product_type_grouped:hover, .product .product_type_external:hover, .product .btn.product_type_variable:hover, .emodal-text .btn.filled.active:hover, .actions input[type="submit"].btn.gray:hover'
                        )
                    ),
                    array (
                        'id' => 'buttons_hover_border_color',
                        'type' => 'color',
                        'title' => 'WooCommerce buttons on Products page hover border',
                        'output' => array(
                            'border-color' => '.product .content-product .btn:hover, .shopping-container .btn.border-grey:hover, .cart_list.product_list_widget .btn.border-grey:hover'
                        )
                    ),
                    array (
                        'id' => 'single_pp_buttons_bg_color',
                        'type' => 'color',
                        'title' => 'WooCommerce buttons on Single Product Page background',
                        'output' => array(
                            'background-color' => '.checkout_coupon input[type=submit], .bag-total-table .checkout-button, .form-row.place-order input[type="submit"], .product-information .cart .button, .btn.filled'
                        )
                    ),
                    array (
                        'id' => 'single_pp_buttons_hover_bg_color',
                        'type' => 'color',
                        'title' => 'WooCommerce buttons on Single Product Page hover background',
                        'output' => array(
                            'background-color' => '.checkout_coupon input[type=submit]:hover, .bag-total-table .checkout-button:hover, .form-row.place-order input[type="submit"]:hover, .product-information .cart button:hover, .btn.filled:hover, .checkout_coupon input[type=submit]:hover, .bag-total-table .checkout-button:hover, .form-row.place-order input[type="submit"]:hover'
                        )
                    ),
                    array (
                        'id' => 'sale_label',
                        'type' => 'color',
                        'title' => 'Sale label',
                        'output' => array(
                            'background-color' => '.type-label-2'
                        )
                    ),
                    array (
                        'id' => 'new_label',
                        'type' => 'color',
                        'title' => 'New label',
                        'output' => array(
                            'background-color' => '.type-label-1'
                        )
                    ),
                    array (
                        'id' => 'regular_price',
                        'type' => 'color',
                        'title' => 'Regular price',
                        'output' => array(
                            'color' => 'table.shop_table td.product-price .amount, table.shop_table td.product-subtotal .amount, .price .amount, .price del .amount, .order-list .coast .amount, .shopping-container .big-coast, .cart_list.product_list_widget .big-coast, table.shop_table td.product-price .amount, table.shop_table td.product-subtotal .amount, .bag-total-table .order-total .amount, .bag-total-table .cart-subtotal td .amount, .order-review td .amount'
                        )
                    ),
                    array (
                        'id' => 'sale_price',
                        'type' => 'color',
                        'title' => 'Sale price',
                        'output' => array(
                            'color' => '.price ins .amount, footer .container .woocomposer_list.woocommerce li > span.amount, .product_list_widget li .small-coast ins .amount'
                        )
                    ),
                ),
            ));

            Redux::setSection( $opt_name, array(
                'title' => 'Footer',
                'id' => 'style-footer',
                'subsection' => true,
                'icon' => 'el-icon-cog',
                'fields' => array (
                    array (
                        'id' => 'footer-links',
                        'type' => 'link_color',
                        'title' => 'Footer Links',
                        'output' => array('.footer .footer-list li a:hover, .footer .container a, .vc_wp_posts .widget_recent_entries li a')
                    ),
                    array (
                        'id' => 'footer_bg_color',
                        'type' => 'background',
                        'title' => 'Footer Background Color',
                        'output' => array(
                            'background' => 'footer.footer'
                        )
                    ),
                    array (
                        'id' => 'footer_widget_title_border_color',
                        'type' => 'color',
                        'title' => 'Footer borders',
                        'output' => array(
                            'border-color' => '.footer div, .footer p, .footer li, .footer h2, .footer h3, .footer a,  .footer .container .widget-title, .footer .container .widgettitle, .footer .container .twitter-slider-title, .footer .vc_wp_posts .widget_recent_entries li'
                        )
                    ),
                ),
            ));
            

            Redux::setSection( $opt_name, array(
                'title' => 'Custom CSS',
                'id' => 'style-custom_css',
                'icon' => 'el-icon-css',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'title' => 'Global Custom CSS',
                    ),
                    array (
                        'id' => 'custom_css_desktop',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'title' => 'Custom CSS for desktop',
                        'subtitle' => '992px +',
                    ),
                    array (
                        'id' => 'custom_css_tablet',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'title' => 'Custom CSS for tablet',
                        'subtitle' => '768px - 991px',
                    ),
                    array (
                        'id' => 'custom_css_wide_mobile',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'title' => 'Custom CSS for mobile landscape',
                        'subtitle' => '481px - 767px',
                    ),
                    array (
                        'id' => 'custom_css_mobile',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'title' => 'Custom CSS for mobile',
                        'subtitle' => '0 - 480px',
                    ),
                ),
            ));

            Redux::setSection( $opt_name, array(
                'title' => 'Typography',
                'id' => 'typography',
                'icon' => 'el-icon-font',
            ));

            
            Redux::setSection( $opt_name, array(
                'title' => 'Page',
                'id' => 'typography-page',
                'icon' => 'el-icon-font',
                'subsection' => true,
                'fields' => array(
                    array (
                        'id' => 'sfont',
                        'type' => 'typography',
                        'title' => 'Body Font',
                        'output' => 'body, .quantity input[type="number"]',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'headings',
                        'type' => 'typography',
                        'title' => 'Headings',
                        'output' => 'h1, h2, h3, h4, h5, h6, .title h3',
                        'text-align' => false,
                        'font-size' => false,
                    ),
                    array (
                        'id' => 'top_bar_font',
                        'type' => 'typography',
                        'title' => 'Top bar',
                        'output' => '.top-bar',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'breadcrumbs',
                        'type' => 'typography',
                        'title' => 'Breadcrumbs',
                        'output' => '.breadcrumbs a, .woocommerce-breadcrumb a, .back-history, .breadcrumbs, .woocommerce-breadcrumb',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'main_navigation',
                        'type' => 'typography',
                        'title' => 'Main Navigation',
                        'output' => '.menu > li > a, .header-vertical-enable .header-vertical .menu-wrapper .menu > li > a, .menu > li.menu-item-has-children > a:after, .menu .item-design-full-width .nav-sublist-dropdown ul > li > a',
                        'text-align' => false,
                        'color' => false
                    ),
                    array (
                        'id' => 'main_navigation_subitem',
                        'type' => 'typography',
                        'title' => 'Main Navigation Subitem',
                        'output' => '.menu .nav-sublist-dropdown ul > li > a, .menu .item-design-full-width .nav-sublist-dropdown .nav-sublist li a',
                        'text-align' => false,
                        'color' => false
                    ),
                    array (
                        'id' => 'buttons_font',
                        'type' => 'typography',
                        'title' => 'Buttons',
                        'output' => 'button, .button, input[type=button], input[type=submit], .wishlist_table .add_to_cart.button, .btn-black, .btn.btn-black, .subscription-toggle',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'page_title_font',
                        'type' => 'typography',
                        'title' => 'Page Title',
                        'output' => '.page-heading h1.title',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'breadcrumbs',
                        'type' => 'typography',
                        'title' => 'Breadcrumbs',
                        'output' => '.breadcrumbs a, .woocommerce-breadcrumb a, .back-history, .breadcrumbs, .woocommerce-breadcrumb',
                        'text-align' => false,
                    ),
                )
            ));

            
            Redux::setSection( $opt_name, array(
                'title' => 'Blog',
                'id' => 'typography-blog',
                'icon' => 'el-icon-font',
                'subsection' => true,
                'fields' => array(
                    array (
                        'id' => 'post_titles',
                        'type' => 'typography',
                        'title' => 'Post Title in Blog Layout',
                        'output' => 'article.blog-post h2 a, article.post-grid h2 a, .posts-design-1 .vc_gitem-zone .vc_custom_heading h4 a, .posts-design-4 .vc_gitem-zone .vc_custom_heading h4 a, .posts-design-2 .vc_gitem-zone .vc_custom_heading h4 a',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'single_post_title_font',
                        'type' => 'typography',
                        'title' => 'Single Post Title',
                        'output' => '.single-post article.blog-post h2, .single-post article.post-grid h2',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'post_meta_font',
                        'type' => 'typography',
                        'title' => 'Post Meta',
                        'output' => 'article.blog-post .meta-post, article.post-grid .meta-post',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'post_entry_font',
                        'type' => 'typography',
                        'title' => 'Post Entry',
                        'output' => 'article.blog-post .content-article, article.post-grid .content-article, article.blog-post .content-article, article.post-grid .content-article, article.blog-post .owl-item, article.post-grid .owl-item, article.blog-post .content-article p, article.post-grid .content-article p',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'widget_titles_font',
                        'type' => 'typography',
                        'title' => 'Widget Titles',
                        'output' => '.sidebar-widget .widget-title, .sidebar-slider .widget-title, .widget-container .widget-title',
                        'text-align' => false,
                    ),
                )
            ));
            
            Redux::setSection( $opt_name, array(
                'title' => 'WooCommerce',
                'id' => 'typography-woo',
                'icon' => 'el-icon-font',
                'subsection' => true,
                'fields' => array(        
                    array (
                        'id' => 'product_name_font',
                        'type' => 'typography',
                        'title' => 'Product Name on Shop/Category page',
                        'output' => '.product .product-details .product-title a, .product_list_widget li h4 a',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'single_product_name_font',
                        'type' => 'typography',
                        'title' => 'Single Product Name',
                        'output' => '.product-information .product_title',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'single_prod_description_font',
                        'type' => 'typography',
                        'title' => 'Single Product Short Description',
                        'output' => '.product-information .short-description p',
                        'text-align' => false,
                    ),    
                    array (
                        'id' => 'buttons_product_font',
                        'type' => 'typography',
                        'title' => 'WooCommerce buttons on Products page',
                        'output' => '.product .progress-button, .product .product_type_simple, .product .product_type_grouped, .product .product_type_external, .product .btn.product_type_variable, .emodal .emodal-text .btn.filled.active, .actions input[type="submit"].btn.gray, .product .progress-button, .product .product_type_simple, .product .product_type_grouped .shopping-container .btn.border-grey, .cart_list.product_list_widget .btn.border-grey, .product-information .cart button[type="submit"] .product-information .cart .button',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'single_product_buttons_font',
                        'type' => 'typography',
                        'title' => 'WooCommerce buttons on Single Product Page',
                        'output' => '.checkout_coupon input[type=submit], .bag-total-table .checkout-button, .form-row.place-order input[type="submit"], .product-information .cart button[type="submit"], .btn.filled',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'tabs_title_font',
                        'type' => 'typography',
                        'title' => 'Tabs Title',
                        'output' => '.tabs .tab-title, .single-product .tabs .tab-title, .wpb_tabs .wpb_tabs_nav li a, .products-tabs .wpb_tabs_nav li > a',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'tabs_title_active_font',
                        'type' => 'typography',
                        'title' => 'Tabs Title Active',
                        'output' => '.tabs .tab-title.opened',
                        'text-align' => false,
                    ),
                )
            ));

            Redux::setSection( $opt_name, array(
                'title' => 'Footer',
                'id' => 'typography-footer',
                'subsection' => true,
                'icon' => 'el-icon-cog',
                'fields' => array (
                    array (
                        'id' => 'footer_widget_title_font',
                        'type' => 'typography',
                        'title' => 'Footer Widget Titles',
                        'output' => '.footer .container .widget-container .widget-title, .footer .container .widget-container .widgettitle, .footer .container .widgettitle, .footer .container .twitter-slider-title',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'footer_headings_font',
                        'type' => 'typography',
                        'title' => 'Footer Headings',
                        'output' => '.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6',
                        'text-align' => false,
                    ),
                    array (
                        'id' => 'footer_entry_font',
                        'type' => 'typography',
                        'title' => 'Footer Entry',
                        'output' => '.footer, .footer p, .footer .footer-list li a',
                        'text-align' => false,
                    ),
                ),
            ));

        }
    }

    if(!function_exists('et_redux_theme_options_dummy')) {
        function et_redux_theme_options_dummy($opt_name) {

            Redux::setSection( $opt_name, array(
                'title' => 'Dummy content',
                'id' => 'import-dummy',
                'subsection' => true,
                'icon' => 'el-icon-inbox',
                'fields' => array (
                    array(
                        'id'         => 'dummy-content',
                        'type'       => 'dummy_content',
                        'title'      => 'Install Dummy content',
                        'versions'   => array(
                            'variant1' => array(
                                'name' => 'Victoria',
                                'pageid' => 3411
                            ),
                            'variant2' => array(
                                'name' => 'Julia',
                                'pageid' => 180
                            ),
                            'variant3' => array(
                                'name' => 'Margaret',
                                'pageid' => 116
                            ),
                            'variant4' => array(
                                'name' => 'Maria',
                                'pageid' => 159
                            ),
                            'variant6' => array(
                                'name' => 'Helen',
                                'pageid' => 143
                            ),
                            'variant7' => array(
                                'name' => 'Felicia',
                                'pageid' => 155
                            ),
                            'variant8' => array(
                                'name' => 'Florence',
                                'pageid' => 133
                            ),
                            'variant9' => array(
                                'name' => 'Eleonora',
                                'pageid' => 101
                            ),
                            'variant11' => array(
                                'name' => 'Lucia',
                                'pageid' => 175
                            ),
                            'variant13' => array(
                                'name' => 'Rose',
                                'pageid' => 165
                            ),
                            'variant14' => array(
                                'name' => 'Linda',
                                'pageid' => 183
                            ),
                            'variant15' => array(
                                'name' => 'Eva',
                                'pageid' => 97
                            ),
                        )
                    ),
                )
            ));

        }
    }
