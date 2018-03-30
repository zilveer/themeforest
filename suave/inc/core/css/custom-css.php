<?php

$root = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
    require_once( $root.'/wp-config.php' );
}

function cg_custom_css() {
    global $cg_options;
    ?>

    <style type="text/css">

        <?php
        $cg_bg_color = '';
        $cg_pagewrapper_color = '';
        $cg_bg_img = '';
        $cg_bg_img_attach = '';
        $cg_bg_pattern_img = '';
        $cg_bg_img_repeat = '';
        $cg_bg_pattern_img_repeat = '';
        $cg_page_wrapper_color = '';
        $cg_skin_color = '';
        $cg_custom_css = '';
        $cg_primary_menu_img_css = '';
        $cg_primary_menu_img_height = '';
        $cg_product_loop_cart_button_color = '';
        $cg_product_loop_cart_button_text_color = '';
        $cg_woo_sale_label_bg_color = '';

        if ( isset( $cg_options['cg_product_loop_cart_button_color'] ) ) {
            $cg_product_loop_cart_button_color = $cg_options['cg_product_loop_cart_button_color'];
        }

        if ( isset( $cg_options['cg_product_loop_cart_button_text_color'] ) ) {
            $cg_product_loop_cart_button_text_color = $cg_options['cg_product_loop_cart_button_text_color'];
        }

        if ( isset( $cg_options['cg_background']['background-color'] ) ) {
            $cg_bg_color = $cg_options['cg_background']['background-color'];
        }

        if ( isset( $cg_options['cg_background']['background-image'] ) ) {
            $cg_bg_img = $cg_options['cg_background']['background-image'];
        }

        if ( isset( $cg_options['cg_pattern_background']['background-image'] ) ) {
            $cg_bg_pattern_img = $cg_options['cg_pattern_background']['background-image'];
        }

        if ( isset( $cg_options['cg_background']['background-repeat'] ) ) {
            $cg_bg_img_repeat = $cg_options['cg_background']['background-repeat'];
        }

        if ( isset( $cg_options['cg_pattern_background']['background-repeat'] ) ) {
            $cg_bg_pattern_img_repeat = $cg_options['cg_pattern_background']['background-repeat'];
        }

        if ( isset( $cg_options['cg_page_wrapper_color'] ) ) {
            $cg_page_wrapper_color = $cg_options['cg_page_wrapper_color'];
        }

        if ( isset( $cg_options['cg_primary_menu_img_height'] ) ) {
            $cg_primary_menu_img_height = $cg_options['cg_primary_menu_img_height'];
        }

        if ( isset( $cg_options['cg_woo_sale_label_bg_color'] ) ) {
            $cg_woo_sale_label_bg_color = $cg_options['cg_woo_sale_label_bg_color'];
        }

        $cg_skin_color = $cg_options['cg_skin_color'];
        $cg_primary_color = $cg_options['cg_primary_color'];
        $cg_active_link_color = $cg_options['cg_active_link_color'];
        $cg_link_hover_color = $cg_options['cg_link_hover_color'];

        if ( !empty( $_SESSION['cg_skin_color'] ) ) {
            $cg_skin_color = $_SESSION['cg_skin_color'];
        }

        if ( isset( $cg_skin_color ) ) {
            if ( $cg_skin_color !== 'none' ) {
                $cg_primary_color = $cg_skin_color;
                $cg_active_link_color = $cg_skin_color;
                $cg_link_hover_color = $cg_skin_color;
            }
        }

        $cg_first_footer_bg = $cg_options['cg_first_footer_bg'];
        $cg_second_footer_bg = $cg_options['cg_second_footer_bg'];
        $cg_last_footer_bg = $cg_options['cg_last_footer_bg'];
        $cg_first_footer_text = $cg_options['cg_first_footer_text'];
        $cg_second_footer_text = $cg_options['cg_second_footer_text'];
        $cg_last_footer_text = $cg_options['cg_last_footer_text'];
        $cg_header_height = $cg_options['cg_header_height'];
        $cg_header_height_mobile = $cg_options['cg_header_height_mobile'];
        $cg_fixed_header_height = $cg_options['cg_fixed_header_height'];
        $cg_header_bg_color = $cg_options['cg_header_bg_color'];
        $cg_header_fixed_bg_color = $cg_options['cg_header_fixed_bg_color'];
        $cg_header_cart_text_color = $cg_options['cg_header_cart_text_color'];
        $cg_submenu_border = $cg_options['cg_submenu_border']['border-color'];

        if ( isset( $cg_options['cg_custom_css'] ) ) {
            $cg_custom_css = $cg_options['cg_custom_css'];
        }

        $cg_level2_font_color = $cg_options['cg_level2_font']['color'];
        $cg_mobile_menu_padding = ( ( $cg_header_height_mobile - 20 ) / 2);
        $cg_mobile_count_height = ( ( $cg_header_height_mobile) / 2);
        $cg_search_suggestions = ( ( $cg_header_height ) / 2);
        $cart_counter = ( ( $cg_fixed_header_height ) / 2);
        $cg_menu_center_cart_count = ( ( $cg_header_height ) / 2);

        $cg_menu_id = get_nav_menu_locations();

        if ( isset( $cg_menu_id['primary'] ) ) {

            $cg_primary_menuitems = wp_get_nav_menu_items( $cg_menu_id['primary'] );
            if ( !empty( $cg_primary_menuitems ) ) {
                foreach ( $cg_primary_menuitems as $item ) {

                    if ( $item->menu_item_parent === '0' ) {

                        if ( isset( $cg_options['cg_primary_' . $item->ID]['url'] ) && $cg_options['cg_primary_' . $item->ID]['url'] != '' ) {
                            $cg_primary_menu_img_css .= ".menu-item-$item->ID .cg-menu-img {";
                            $cg_primary_menu_img_css .= "background-image: url('" . $cg_options['cg_primary_' . $item->ID]['url'] . "');";
                            $cg_primary_menu_img_css .= "background-repeat: no-repeat;";
                            $cg_primary_menu_img_css .= "position: relative; width: 100%; background-size: cover; z-index: 10;";
                            $cg_primary_menu_img_css .= "}";
                            $cg_primary_menu_img_css .= "\n";
                        } else {
                            $cg_primary_menu_img_css .= ".menu-item-$item->ID .cg-menu-img {";
                            $cg_primary_menu_img_css .= "display: none;";
                            $cg_primary_menu_img_css .= "}";
                            $cg_primary_menu_img_css .= "\n";
                        }
                    }
                }
                echo $cg_primary_menu_img_css;
            }
        }

        if ( $cg_level2_font_color ) {
            ?>

            .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover, 
            .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover 
            {
                color: <?php echo esc_attr( $cg_level2_font_color ); ?>;
            }
        <?php } ?>

        <?php if ( $cg_bg_color ) {
            ?>
            body {
                background-color: <?php echo esc_attr( $cg_bg_color ); ?>; 
            }
        <?php } ?>
        
        <?php if ( $cg_bg_img ) { ?>
            body {
                background-image: url('<?php echo esc_url( $cg_bg_img ); ?>'); 
                background-position: 0px 0px;
                background-attachment: fixed;
                background-size: cover;
            }
        <?php } ?>

        <?php if ( $cg_bg_img_repeat ) { ?>
            body {
                background-repeat: <?php echo esc_attr( $cg_bg_img_repeat ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_bg_pattern_img ) { ?>
            body {
                background-image: url('<?php echo esc_url( $cg_bg_pattern_img ); ?>'); 
                background-position: 0px 0px;
            }
        <?php } ?>

        <?php if ( $cg_bg_pattern_img_repeat ) { ?>
            body {
                background-repeat: <?php echo esc_attr( $cg_bg_pattern_img_repeat ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_page_wrapper_color ) { ?>
            #wrapper {
                background-color: <?php echo esc_attr( $cg_page_wrapper_color ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_woo_sale_label_bg_color ) { ?>
            .onsale-wrap {
                background-color: <?php echo esc_attr( $cg_woo_sale_label_bg_color ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_primary_color ) { ?>

            #top,
            .new.menu-item a:after, 
            .faqs-reviews .accordionButton .icon-plus:before,
            .container .cg-product-cta a.button.added, 
            .container .cg-product-cta a.button.loading,
            .mc4wp-form input[type="submit"],
            body.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover, 
            body.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover, 
            body.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a,
            .content-area ul.bullets li:before,
            .container .mejs-controls .mejs-time-rail .mejs-time-current,
            .wpb_toggle:before, h4.wpb_toggle:before,
            #filters button.is-checked,
            .container .cg-product-cta a.button.added, .container .cg-product-cta a.button.loading,
            .tipr_content,
            .navbar-toggle .icon-bar,
            .woocommerce-page .container input.button,
            .woocommerce-page .container button.button,
            body.page .woocommerce .summary .button,
            .woocommerce-page .container p.cart a.button,
            #calendar_wrap caption,
            .content-area table.my_account_orders td.order-actions a,
            .woocommerce-page .container #yith-wcwl-form a.button,
            .subfooter #mc_signup_submit,
            .cg-quickview-product-pop .single-product-details .button,
            .container .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active,
            .page-numbers li span.current,
            .page-numbers li a:hover,
            .widget_price_filter .ui-slider .ui-slider-range,
            .product-category-description,
            .cg-cart-count,
            .woocommerce-page .container input.button,
            .woocommerce-page .container a.checkout-button,
            .owl-theme .owl-controls .owl-page.active span, 
            .owl-theme .owl-controls.clickable .owl-page:hover span

            {
                background-color: <?php echo esc_attr( $cg_primary_color ); ?> !important; 
            }

            /* non !important overrides */ 

            .cg-product-cta .button:hover,

            #respond input#submit:hover,
            .woocommerce-page .container p.return-to-shop a.button:hover,
            .blog-pagination ul li a:hover,
            body.error404 .content-area a.btn:hover,
            #respond input#submit:hover, 
            .wpcf7 input.wpcf7-submit:hover,
            .homepage-feature .cg-strip-content a:hover,
            .container .wpb_tour_next_prev_nav a:hover,
            .woocommerce .woocommerce_tabs ul.tabs li.active a, 
            .woocommerce .woocommerce-tabs ul.tabs li.active a,
            .container .vc_gitem-zone .vc_btn

            {
                color: <?php echo esc_attr( $cg_primary_color ); ?> !important;
                border-color: <?php echo esc_attr( $cg_primary_color ); ?> !important;
            }

            .page-numbers li span.current,
            ul.tiny-cart li ul.cart_list li.buttons .button.checkout,
            .page-numbers li a:hover,
            .container .cg-product-cta a.button.added, 
            .container .cg-product-cta a.button.loading,
            .prev-product:hover:before, 
            .next-product:hover:before,
            .page-numbers li span.current,
            .page-numbers li span.current:hover,
            .page-numbers li a:hover,
            .vc_read_more,
            body .wpb_teaser_grid .categories_filter li a:hover, 
            #filters button:hover,
            .container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
            .owl-theme .owl-controls .owl-page.active span, 
            .owl-theme .owl-controls.clickable .owl-page:hover span,
            .woocommerce-page .container a.checkout-button

            {
                border-color: <?php echo esc_attr( $cg_primary_color ); ?> !important;
            }

            a,
            .cg-features i,
            .cg-features h2,
            .widget_layered_nav ul.yith-wcan-list li a:before,
            .widget_layered_nav ul.yith-wcan-list li.chosen a:before,
            .widget_layered_nav ul.yith-wcan-list li.chosen a,
            blockquote:before,
            blockquote:after,
            article.format-link .entry-content p:before,
            .container .ui-state-default a, 
            .container .ui-state-default a:link, 
            .container .ui-state-default a:visited,
            .logo a,
            .woocommerce-breadcrumb a,
            #cg-articles h3 a,
            .cg-announcements li a:hover,
            .cg-wp-menu-wrapper .menu li:hover > a,
            .cg-recent-folio-title a, 
            .content-area h2.cg-recent-folio-title a,
            .cg-product-info .yith-wcwl-add-to-wishlist a:hover:before,
            .cg-product-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before,
            .widget_rss ul li a,
            .lightwrapper .widget_rss ul li a,
            .woocommerce-tabs .tabs li a:hover,
            .summary .price,
            .content-area .checkout-confirmed-payment p,
            .widget.widget_recent_entries ul li a,
            .blog-pagination ul li.active a,
            .icon.cg-icon-bag-shopping-2, 
            .icon.cg-icon-basket-1, 
            .icon.cg-icon-shopping-1,
            #top-menu-wrap li a:hover,
            .cg-product-info .amount,
            .single-product-details .price ins,
            .cg-product-info .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:before, 
            .cg-product-info .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover:before,
            .prev-product:hover:before, 
            .next-product:hover:before,
            .content-area article a.more-link:hover,
            body.woocommerce-checkout .woocommerce-info a,
            .widget ul.product-categories ul.children li a:before,
            .widget_pages ul ul.children li a:before,
            .container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
            .container .wpb_tabs .wpb_tabs_nav li a:hover,
            .content-area .woocommerce-MyAccount-navigation ul li a:hover, 
            .content-area .woocommerce-MyAccount-navigation ul li.is-active a,
            .container .wpb_tour.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav li.ui-state-active a

            {
                color: <?php echo esc_attr( $cg_primary_color ); ?>;
            }

            .owl-theme .owl-controls .owl-buttons div:hover,
            .content-area blockquote:hover, 
            article.format-link .entry-content p:hover,
            .blog-pagination ul li a:hover,
            .blog-pagination ul li.active a,
            .container .ui-state-hover,
            #filters button.is-checked,
            #filters button.is-checked:hover,
            .container form.cart .button:hover, 
            .woocommerce-page .container p.cart a.button:hover,
            .map_inner,
            .woocommerce-page .container .cart-collaterals input.checkout-button, 
            .woocommerce .checkout-button,
            h4.widget-title span,
            .content-area article a.more-link:hover,
            .wpb_teaser_grid .categories_filter li.active a,
            .cg-header-fixed .menu > li .cg-submenu-ddown, 
            .cg-primary-menu .menu > li .cg-submenu-ddown,
            body .wpb_teaser_grid .categories_filter li.active a,
            .container .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active

            {
                border-color: <?php echo esc_attr( $cg_primary_color ); ?>;
            }


            ul.tabNavigation li a.active,
            .wpb_teaser_grid .categories_filter li.active a,
            ul.tiny-cart li ul.cart_list li.buttons .button.checkout

            {
                background: <?php echo esc_attr( $cg_primary_color ); ?> !important;

            }

            .tipr_point_top:after,
            .woocommerce .woocommerce-tabs ul.tabs li.active a:after {
                border-top-color: <?php echo esc_attr( $cg_primary_color ); ?>;
            }

            .tipr_point_bottom:after,
            .content-area a:hover
            {
                border-bottom-color: <?php echo esc_attr( $cg_primary_color ); ?>;
            }

        <?php } ?>

        <?php if ( $cg_active_link_color ) { ?>

            a,
            .logo a,
            .navbar ul li.current-menu-item a, 
            .navbar ul li.current-menu-ancestor a, 
            #cg-articles h3 a,
            .widget-area .widget.widget_rss ul li a,
            .widget-area .widget #recentcomments li a,
            .current_page_ancestor,
            .current-menu-item,
            .cg-primary-menu .menu > li.current-menu-item > a,
            .cg-primary-menu .menu > li.current-menu-ancestor > a
            {
                color: <?php echo esc_attr( $cg_active_link_color ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_link_hover_color ) { ?>
            a:hover, 
            a:focus,
            #top .dropdown-menu li a:hover, 
            ul.navbar-nav li .nav-dropdown li a:hover,
            .navbar ul li.current-menu-item a:hover, 
            .navbar ul li.current-menu-ancestor a:hover,
            .owl-theme .owl-controls .owl-buttons div:hover,
            .woocommerce ul.product_list_widget li a:hover,
            .content-area a.reset_variations:hover,
            .content-area article h2 a:hover,
            .content-area footer.entry-meta a:hover,
            .content-area footer.entry-meta .comments-link:hover:before, 
            .content-area a.post-edit-link:hover:before,
            .scwebsite:hover:before,
            .cg-wp-menu-wrapper .menu li a:hover,
            .cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li a:hover, 
            body .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover, 
            .cg-submenu-ddown .container > ul > li > a:hover,
            .cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li a:hover,
            .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover
            {
                color: <?php echo esc_attr( $cg_link_hover_color ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_header_bg_color ) { ?>
            .header,
            .cg-menu-default,
            .cg-menu-below
            {
                background-color: <?php echo esc_attr( $cg_header_bg_color ); ?>; 
            }
        <?php } ?>

        <?php if ( $cg_header_fixed_bg_color ) { ?>
            .cg-header-fixed-wrapper.cg-is-fixed
            {
                background-color: <?php echo esc_attr( $cg_header_fixed_bg_color ); ?>; 
            }
        <?php } ?>


        <?php if ( $cg_first_footer_bg ) { ?>
            .lightwrapper 

            {
                background-color: <?php echo esc_attr( $cg_first_footer_bg ); ?>; 
            }

        <?php } ?>

        <?php if ( $cg_second_footer_bg ) { ?>
            .subfooter 

            {
                background-color: <?php echo esc_attr( $cg_second_footer_bg ); ?>; 
            }

        <?php } ?>

        <?php if ( $cg_last_footer_bg ) { ?>
            .footer 

            {
                background-color: <?php echo esc_attr( $cg_last_footer_bg ); ?>; 
            }

        <?php } ?>

        <?php if ( $cg_first_footer_text ) { ?>
            .lightwrapper h4, .lightwrapper ul li a 

            {
                color: <?php echo esc_attr( $cg_first_footer_text ); ?>; 
            }

        <?php } ?>

        <?php if ( $cg_second_footer_text ) { ?>

            .subfooter #mc_subheader,
            .subfooter .widget_recent_entries ul li a,
            .subfooter ul.product_list_widget li a,
            .subfooter #mc_signup_submit,
            .subfooter p a,
            .bottom-footer-left a

            {
                color: <?php echo esc_attr( $cg_second_footer_text ); ?>; 
            }

        <?php } ?>

        <?php if ( $cg_last_footer_text ) { ?>
            .footer p

            {
                color: <?php echo esc_attr( $cg_last_footer_text ); ?>; 
            }

        <?php } ?>

        <?php if ( $cg_product_loop_cart_button_color ) { ?>
            .cg-product-cta .add_to_cart_button, 
            .cg-product-cta .product_type_external,
            .cg-product-cta .product_type_grouped

            {
                background: <?php echo esc_attr( $cg_product_loop_cart_button_color ); ?> !important; 
            }

        <?php } ?>

        <?php if ( $cg_product_loop_cart_button_text_color ) { ?>
            .cg-product-cta .add_to_cart_button,
            .cg-product-cta .product_type_external,
            .cg-product-cta .product_type_grouped,
            .woocommerce-page .container .cg-product-cta a.button

            {
                color: <?php echo esc_attr( $cg_product_loop_cart_button_text_color ); ?> !important; 
            }

        <?php } ?>

        <?php if ( $cg_header_height ) { ?>
            .header,
            .mean-bar,
            .cg-menu-default,
            .cg-menu-default .logo,
            .cg-menu-below,
            .cg-menu-below .logo,
            .responsive-container,
            .cg-header-cart ul.tiny-cart,
            .dummy

            {
                height: <?php echo esc_attr( $cg_header_height ); ?>px; 
            }

            .cg-header-cart ul.tiny-cart li ul.cart_list {
                top: <?php echo esc_attr( $cg_header_height ); ?>px !important;
            }

            .cg-menu-default .logo img, .cg-menu-below .logo img {
                max-height: <?php echo esc_attr( $cg_header_height ); ?>px; 
            }

            .text-logo h1,
            #top-bar-wrap,
            #top-bar-wrap,
            .top-nav-wrap ul li a,
            .cg-announcements li,
            .cg-header-search,
            .cg-menu-below .sb-search,
            .cg-header-cart,
            .cg-header-cart ul.tiny-cart

            {
                line-height: <?php echo esc_attr( $cg_header_height ); ?>px; 
            }

            .cg-menu-below .img-container img {
                max-height: <?php echo esc_attr( $cg_header_height ); ?>px; 
            }

            ul.tiny-cart li ul li, .cg-header-fixed-wrapper.cg-is-fixed ul.tiny-cart li ul li {
                height: auto;
            }

            .cg-logo-inner-cart-wrap .autocomplete-suggestions
            {
                top: <?php echo esc_attr( $cg_search_suggestions ); ?>px; 
                bottom: auto;
                margin-top: 6px;
            }

            .cg-wp-menu-wrapper input.sb-search-submit {
                top: <?php echo esc_attr( $cg_search_suggestions ); ?>px; 
                margin-top: -15px;
            }

            .cg-header-fixed .cg-cart-count {
                top: <?php echo esc_attr( $cart_counter ); ?>px; 
                bottom: auto;
                margin-top: -15px;
            }

            @media only screen and (min-width: 1100px) {

                .cg-logo-center .logo img {
                  top: -<?php echo esc_attr( $cg_header_height ); ?>px !important;
                }

                .cg-header-cart .cg-cart-count {
                    bottom: <?php echo esc_attr( $cg_menu_center_cart_count ); ?>px;
                }


            }

        <?php } ?>

        <?php if ( $cg_fixed_header_height ) { ?>
            .cg-header-fixed-wrapper.cg-is-fixed .header, 
            .cg-header-fixed-wrapper.cg-is-fixed ul.tiny-cart,
            .cg-header-fixed-wrapper.cg-is-fixed .mean-bar,
            .cg-header-fixed .menu, .cg-primary-menu .menu

            {
                height: <?php echo esc_attr( $cg_fixed_header_height ); ?>px; 
            }

            .cg-header-fixed-wrapper.cg-is-fixed ul.tiny-cart li:hover ul.cart_list
            {
                top: <?php echo esc_attr( $cg_fixed_header_height ); ?>px !important;
            }

            .cg-header-fixed-wrapper.cg-is-fixed .cg-header-fixed .menu > li > a,
            .cg-header-fixed-wrapper.cg-is-fixed .text-logo h1,
            .cg-header-fixed-wrapper.cg-is-fixed .cg-announcements li,
            .cg-header-fixed-wrapper.cg-is-fixed ul.tiny-cart,
            .cg-header-fixed-wrapper.cg-is-fixed ul.tiny-cart li,
            .cg-header-fixed-wrapper.cg-is-fixed .navbar ul li a
            {
                line-height: <?php echo esc_attr( $cg_fixed_header_height ); ?>px;
            }

            .cg-header-fixed-wrapper.cg-is-fixed .logo img {
                max-height: <?php echo esc_attr( $cg_fixed_header_height ); ?>px; 
            }

            .cg-header-fixed-wrapper.cg-is-fixed .logo {
                height: <?php echo esc_attr( $cg_fixed_header_height ); ?>px; 
            }

            #top-bar-search .autocomplete-suggestions {
                margin-top: -<?php echo esc_attr( $cg_search_suggestions ); ?>px; 
            }

            @media screen and (min-width:0\0) {
                .cg-header-fixed .cg-header-cart-icon-wrap {
                    top: <?php echo esc_attr( $cart_counter ); ?>px;
                    margin-top: -20px;
                }
            }

            #lang_sel {
                margin-top: <?php echo esc_attr( $cg_search_suggestions ); ?>px; 
            }

        <?php } ?>

        <?php if ( $cg_header_height_mobile ) { ?>

            @media only screen and (max-width: 1100px) { 

                .header,
                ul.tiny-cart,
                ul.tiny-cart li,
                .mean-bar,
                .cg-menu-default,
                .cg-menu-default .logo,
                .cg-menu-below,
                .cg-menu-below .logo

                {
                    /* $cg_header_height_mobile */
                    height: <?php echo esc_attr( $cg_header_height_mobile ); ?>px; 
                }

                .cg-menu-default .logo img, .cg-menu-below .logo img {
                    max-height: <?php echo esc_attr( $cg_header_height_mobile ); ?>px; 
                }

                .img-container {
                    height: <?php echo esc_attr( $cg_header_height_mobile ); ?>px; 
                }

                .cg-menu-below .img-container img {
                    max-height: <?php echo esc_attr( $cg_header_height_mobile ); ?>px; 
                }

                ul.tiny-cart, 
                ul.tiny-cart .icon:before,
                .logo a,
                .navbar ul li a,
                .text-logo h1,
                .cg-announcements li
                {
                    /* $cg_header_height_mobile */
                    line-height: <?php echo esc_attr( $cg_header_height_mobile ); ?>px !important; 
                }

                ul.tiny-cart li {
                    line-height: inherit !important;
                }

                ul.tiny-cart li:hover ul.cart_list {
                    top: <?php echo esc_attr( $cg_header_height_mobile ); ?>px;
                }

                .logo img {
                    max-height: <?php echo esc_attr( $cg_header_height_mobile ); ?>px;
                }

                .mean-container a.meanmenu-reveal {
                    padding: <?php echo esc_attr( $cg_mobile_menu_padding ); ?>px 15px;
                    padding-right: 0px;
                }

                .mean-container .mean-nav {
                    top: <?php echo esc_attr( $cg_header_height_mobile ); ?>px;
                }

                .cg-header-cart-icon-wrap {
                    top: -<?php echo esc_attr( $cg_header_height_mobile ); ?>px; 
                }

                .cg-cart-count {
                    top: <?php echo esc_attr( $cg_mobile_count_height ); ?>px; 
                }

            }

        <?php } ?>

        <?php if ( $cg_primary_menu_img_height ) { ?>
            .menu-full-width .cg-menu-title-wrap
            {
                line-height: <?php echo esc_attr( $cg_primary_menu_img_height ); ?>px;
            }

            .menu-full-width .cg-menu-img {
                height: <?php echo esc_attr( $cg_primary_menu_img_height ); ?>px; 
            }

        <?php } ?>

        <?php
        if ( $cg_custom_css ) {
            //echo esc_attr( $cg_custom_css );
            echo $cg_custom_css;
        }
        ?>

    </style>

    <?php
}

function hex2rgb( $hex ) {
    $hex = str_replace( "#", "", $hex );

    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }
    $rgb = array( $r, $g, $b );
    return implode( ",", $rgb ); // returns the rgb values separated by commas
    //return $rgb; // returns an array with the rgb values
}

add_action( 'wp_head', 'cg_custom_css', 100 );
