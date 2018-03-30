<?php
if (!function_exists('hashmag_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function hashmag_mikado_design_styles() {

        if (hashmag_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = hashmag_mikado_options()->getOptionValue('google_fonts');
            if (hashmag_mikado_is_font_option_valid($font_family)) {
                echo hashmag_mikado_dynamic_css('body', array('font-family' => hashmag_mikado_get_font_option_val($font_family)));
            }
        }

        if (hashmag_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'a:hover',
                'p a:hover',
                '.mkdf-top-bar #lang_sel ul li:hover .lang_sel_sel',
                '.mkdf-top-bar #lang_sel ul ul a:hover',
                '.mkdf-drop-down .mkdf-menu-second .mkdf-menu-inner ul li.mkdf-menu-sub:hover a i.mkdf_menu_arrow',
                '.mkdf-drop-down .mkdf-menu-wide .mkdf-menu-second .mkdf-menu-inner>ul>li>a .menu_icon_wrapper i',
                '.mkdf-drop-down .mkdf-menu-wide .mkdf-menu-second .mkdf-menu-inner ul li ul li a .item_text:after',
                '.mkdf-top-bar .widget.widget_nav_menu ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav h6:hover',
                '.mkdf-dark .mkdf-main-menu.mkdf-default-nav>ul>li.mkdf-active-item>a',
                '.mkdf-light .mkdf-main-menu.mkdf-default-nav>ul>li.mkdf-active-item>a',
                '.mkdf-transparent .mkdf-main-menu.mkdf-default-nav>ul>li.mkdf-active-item>a',
                'footer .widget.widget_tag_cloud a:hover',
                'footer .mkdf-footer-bottom-holder .widget.widget_nav_menu ul li a:hover',
                '.mkdf-icon-shortcode .mkdf-icon-element',
                '.mkdf-tabs.mkdf-tabs-skin-light .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-skin-light .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-tabs.mkdf-tabs-skin-dark .mkdf-tabs-nav li.ui-state-active a',
                '.mkdf-tabs.mkdf-tabs-skin-dark .mkdf-tabs-nav li.ui-state-hover a',
                '.mkdf-post-info-icon-holder .mkdf-post-info-icon',
                '.mkdf-post-layout-light .mkdf-pt-title a:hover',
                '.mkdf-pb-three-holder .mkdf-pb-three-non-featured .mkdf-pt-four-item.mkdf-reveal-nonf-active .mkdf-post-info-category .mkdf-comma',
                '.mkdf-pb-three-holder .mkdf-pb-three-non-featured .mkdf-pt-four-item.mkdf-reveal-nonf-active .mkdf-post-info-category a',
                '.mkdf-post-pag-np-horizontal.mkdf-post-layout-light .mkdf-bnl-nav-icon:hover',
                '.mkdf-post-pag-np-horizontal.mkdf-post-layout-dark .mkdf-bnl-nav-icon:hover',
                '.mkdf-bn-holder ul.mkdf-bn-slide .mkdf-bn-text a:hover',
                '.mkdf-footer-bottom-holder .mkdf-social-icon-widget-holder:hover',
                '.mkdf-top-bar .mkdf-social-icon-widget-holder:hover',
                '.mkdf-twitter-widget li .mkdf-tweet-text a:hover',
                '.mkdf-side-menu-button-opener:hover'
            );


            $color_important_selector = array(
                '.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-hover-color):hover .mkdf-btn-icon-element',
                '.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-color):hover .mkdf-btn-icon-element',
                '.mkdf-pt-five-item .mkdf-pt-five-image-holder+.mkdf-pt-five-content-holder .mkdf-pt-info-section>div .mkdf-post-info-author-link',
                '.mkdf-pt-six-item.mkdf-item-hovered .mkdf-pt-six-title'


            );

            $background_color_selector = array(
                '.mkdf-pagination ul li a:hover',
                '.mkdf-pagination ul li.active span',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner>a:hover',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner>span',
                '#mkdf-back-to-top>span',
                '.mkdf-main-menu>ul>li.mkdf-active-item>a',
                '.mkdf-main-menu>ul>li.mkdf-active-item>a',
                '.mkdf-main-menu>ul>li:hover>a',
                'footer .widget #wp-calendar td#today',
                'footer .widget.widget_search input[type=submit]',
                '.wpb_widgetised_column .widget #wp-calendar td#today',
                'aside.mkdf-sidebar .widget #wp-calendar td#today',
                '.wpb_widgetised_column .widget.widget_search input[type=submit]',
                'aside.mkdf-sidebar .widget.widget_search input[type=submit]',
                '.mkdf-icon-shortcode.circle',
                '.mkdf-icon-shortcode.square',
                '.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a.flex-active',
                '.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a:hover',
                '.mkdf-social-share-holder.mkdf-dropdown:hover .mkdf-social-share-dropdown-opener',
                '.mkdf-psc-holder .flex-direction-nav a .flex-control-paging>li a.flex-active',
                '.mkdf-psc-holder .flex-direction-nav a .flex-control-paging>li a:hover',
                '.mkdf-psc-slides .mkdf-post-item .mkdf-post-info-category',
                '.mkdf-pswt-holder .mkdf-pswt-slides .mkdf-pswt-content .mkdf-pswt-content-inner .mkdf-post-info-category',
                '.mkdf-pcs-swipe-holder .mkdf-post-item.mkdf-pt-seven-item .mkdf-post-info-category',
                '.mkdf-post-item .mkdf-bnl-image-holder .mkdf-post-info-category',
                '.mkdf-blog-holder article .mkdf-post-info-category',
                '.mkdf-blog-holder article.format-link .mkdf-post-title-holder:before',
                '.mkdf-blog-holder article.format-quote .mkdf-post-title-holder:before',
                '.mkdf-single-tags-holder .mkdf-tags a:before',
                '.mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-paging-button-holder.mkdf-bnl-paging-active .mkdf-paging-button',
                '.mkdf-post-pag-np-horizontal .mkdf-bnl-navigation-holder .mkdf-paging-button-holder:hover .mkdf-paging-button',
                '.single-post .mkdf-post-content-featured .mkdf-post-info-category',
                '.single-post.single-format-link .mkdf-title-subtitle-holder-inner:before',
                '.single-post.single-format-quote .mkdf-title-subtitle-holder-inner:before',
                '.single-post .mkdf-related-posts-holder .mkdf-post-info-category',
                '.widget_mkdf_instagram_widget .mkdf-instagram-feed-heading a:hover span',
                '.mkdf-twitter-widget .mkdf-twitter-widget-heading a:hover span',
                '.mkdf-side-menu .widget #wp-calendar td#today',
                '.mkdf-side-menu .widget.widget_search input[type=submit]'
            );

            $background_color_important_selector = array(
                '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .checkout:hover',
                '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .view-cart:hover'
            );

            $border_color_selector = array(
                '.mkdf-dark .mkdf-search-menu-holder .mkdf-search-field:focus',
                '.mkdf-light .mkdf-search-menu-holder .mkdf-search-field:focus',
                'footer .widget.widget_search input:not([type=submit]):focus',
                'footer .widget.widget_search input:not([type=submit]):focus+[type=submit]',
                '.mkdf-main-menu ul li .mkdf-plw-tabs .mkdf-plw-tabs-tab:hover'
            );

            $woo_color_selector = array();
            $woo_background_color_selector = array();
            $woo_background_color_important_selector = array();
            $woo_border_color_selector = array();

            if (hashmag_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.woocommerce .mkdf-product-info-holder .mkdf-product-categories',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .comment-respond .stars a.active:after',
                    '.mkdf-shopping-cart-dropdown ul li a:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-left a:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-left .amount',
                    '.mkdf-shopping-cart-dropdown span.mkdf-quantity',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-total-amount span',
                    '.mkdf-woocommerce-page .woocommerce-info .showcoupon:hover',
                    '.mkdf-woocommerce-page .mkdf-content a.button.checkout-button:hover:after',
                    '.mkdf-woocommerce-page .mkdf-content button[type=submit]:hover:after',
                    '.mkdf-woocommerce-page .mkdf-content input[type=submit]:hover:after',
                    '.mkdf-woocommerce-page table.cart tr.cart_item td.product-remove a:hover:before',
                    '.widget.woocommerce.widget_products ul li ins',
                    '.widget.woocommerce.widget_recent_reviews ul li ins',
                    '.widget.woocommerce.widget_top_rated_products ul li ins'
                );

                $woo_background_color_selector = array(
                    '.woocommerce-pagination .page-numbers li a:hover',
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li span.current:hover',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .mkdf-social-share-holder.mkdf-dropdown:hover .mkdf-social-share-dropdown-opener',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs>li.active a',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs>li:hover a',
                    '.mkdf-shopping-cart-outer .mkdf-shopping-cart-header .mkdf-cart-no',
                    '.mkdf-woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-input',
                    '.mkdf-woocommerce-page .woocommerce-message a.button.wc-forward',
                    '.woocommerce a.added_to_cart'
                );

                $woo_border_color_selector = array(
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs>li.active a',
                    '.mkdf-woocommerce-page.mkdf-woocommerce-single-page .woocommerce-tabs ul.tabs>li:hover a' 
                );
            }


            $color_selector = array_merge($color_selector, $woo_color_selector);
            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);
            $background_color_important_selector = array_merge($background_color_important_selector, $woo_background_color_important_selector);
            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);


            $bbp_color_selector = array();
            $bbp_background_color_selector = array();

            if (hashmag_mikado_bbpress_installed()) {
                $bbp_color_selector = array(
                    '#bbpress-forums .bbp-topics ul.sticky:after'
                );

                $bbp_background_color_selector = array(
                    '#bbpress-forums button:hover',
                    '.mkdf-sidebar .bbp_widget_login button:hover'
                );
            }

            $color_selector = array_merge($color_selector, $bbp_color_selector);
            $background_color_selector = array_merge($background_color_selector, $bbp_background_color_selector);


            echo hashmag_mikado_dynamic_css('::selection', array('background' => hashmag_mikado_options()->getOptionValue('first_color')));
            echo hashmag_mikado_dynamic_css('::-moz-selection', array('background' => hashmag_mikado_options()->getOptionValue('first_color')));
            echo hashmag_mikado_dynamic_css($color_selector, array('color' => hashmag_mikado_options()->getOptionValue('first_color')));
            echo hashmag_mikado_dynamic_css($color_important_selector, array('color' => hashmag_mikado_options()->getOptionValue('first_color') . '!important'));
            echo hashmag_mikado_dynamic_css($background_color_selector, array('background-color' => hashmag_mikado_options()->getOptionValue('first_color')));
            echo hashmag_mikado_dynamic_css($background_color_important_selector, array('background-color' => hashmag_mikado_options()->getOptionValue('first_color') . '!important'));
            echo hashmag_mikado_dynamic_css($border_color_selector, array('border-color' => hashmag_mikado_options()->getOptionValue('first_color')));
        }

        if (hashmag_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkdf-wrapper-inner',
                '.mkdf-content',
                '.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner',
                '.mkdf-boxed .mkdf-wrapper .mkdf-content'
            );
            echo hashmag_mikado_dynamic_css($background_color_selector, array('background-color' => hashmag_mikado_options()->getOptionValue('page_background_color')));
        }

        if (hashmag_mikado_options()->getOptionValue('selection_color')) {
            echo hashmag_mikado_dynamic_css('::selection', array('background' => hashmag_mikado_options()->getOptionValue('selection_color')));
            echo hashmag_mikado_dynamic_css('::-moz-selection', array('background' => hashmag_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if (hashmag_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = hashmag_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if (hashmag_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image'] = 'url(' . esc_url(hashmag_mikado_options()->getOptionValue('boxed_background_image')) . ')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat'] = 'no-repeat';
        }

        if (hashmag_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image'] = 'url(' . esc_url(hashmag_mikado_options()->getOptionValue('boxed_pattern_background_image')) . ')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat'] = 'repeat';
        }

        if (hashmag_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (hashmag_mikado_options()->getOptionValue('boxed_background_image_attachment'));
            if (hashmag_mikado_options()->getOptionValue('boxed_background_image_attachment') == 'fixed') {
                $boxed_background_style['background-size'] = 'cover';
            }
        }

        echo hashmag_mikado_dynamic_css('.mkdf-boxed', $boxed_background_style);
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_design_styles');
}


if (!function_exists('hashmag_mikado_content_styles')) {
    /**
     * Generates content custom styles
     */
    function hashmag_mikado_content_styles() {

        $content_style = array();
        if (hashmag_mikado_options()->getOptionValue('content_top_padding') !== '') {
            $padding_top = (hashmag_mikado_options()->getOptionValue('content_top_padding'));
            $content_style['padding-top'] = hashmag_mikado_filter_px($padding_top) . 'px';
        }

        $content_selector = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
        );

        echo hashmag_mikado_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
        if (hashmag_mikado_options()->getOptionValue('content_top_padding_in_grid') !== '') {
            $padding_top_in_grid = (hashmag_mikado_options()->getOptionValue('content_top_padding_in_grid'));
            $content_style_in_grid['padding-top'] = hashmag_mikado_filter_px($padding_top_in_grid) . 'px';

        }

        $content_selector_in_grid = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
        );

        echo hashmag_mikado_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_content_styles');
}


if (!function_exists('hashmag_mikado_h1_styles')) {

    function hashmag_mikado_h1_styles() {

        $h1_styles = array();

        if (hashmag_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = hashmag_mikado_options()->getOptionValue('h1_color');
        }
        if (hashmag_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h1_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h1_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('h1_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = hashmag_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('h1_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h1_letterspacing')) . 'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo hashmag_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_h1_styles');
}

if (!function_exists('hashmag_mikado_h2_styles')) {

    function hashmag_mikado_h2_styles() {

        $h2_styles = array();

        if (hashmag_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = hashmag_mikado_options()->getOptionValue('h2_color');
        }
        if (hashmag_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h2_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h2_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('h2_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = hashmag_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('h2_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h2_letterspacing')) . 'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo hashmag_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_h2_styles');
}

if (!function_exists('hashmag_mikado_h3_styles')) {

    function hashmag_mikado_h3_styles() {

        $h3_styles = array();

        if (hashmag_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = hashmag_mikado_options()->getOptionValue('h3_color');
        }
        if (hashmag_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h3_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h3_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('h3_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = hashmag_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('h3_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h3_letterspacing')) . 'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo hashmag_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_h3_styles');
}

if (!function_exists('hashmag_mikado_h4_styles')) {

    function hashmag_mikado_h4_styles() {

        $h4_styles = array();

        if (hashmag_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = hashmag_mikado_options()->getOptionValue('h4_color');
        }
        if (hashmag_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h4_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h4_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('h4_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = hashmag_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('h4_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h4_letterspacing')) . 'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo hashmag_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_h4_styles');
}

if (!function_exists('hashmag_mikado_h5_styles')) {

    function hashmag_mikado_h5_styles() {

        $h5_styles = array();

        if (hashmag_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = hashmag_mikado_options()->getOptionValue('h5_color');
        }
        if (hashmag_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h5_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h5_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('h5_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = hashmag_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('h5_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h5_letterspacing')) . 'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo hashmag_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_h5_styles');
}

if (!function_exists('hashmag_mikado_h6_styles')) {

    function hashmag_mikado_h6_styles() {

        $h6_styles = array();

        if (hashmag_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = hashmag_mikado_options()->getOptionValue('h6_color');
        }
        if (hashmag_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h6_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h6_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('h6_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = hashmag_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('h6_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('h6_letterspacing')) . 'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo hashmag_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_h6_styles');
}

if (!function_exists('hashmag_mikado_text_styles')) {

    function hashmag_mikado_text_styles() {

        $text_styles = array();

        if (hashmag_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = hashmag_mikado_options()->getOptionValue('text_color');
        }
        if (hashmag_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if (hashmag_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('text_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('text_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('text_texttransform');
        }
        if (hashmag_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = hashmag_mikado_options()->getOptionValue('text_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('text_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('text_letterspacing')) . 'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo hashmag_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_text_styles');
}

if (!function_exists('hashmag_mikado_boxy_text_styles')) {

    function hashmag_mikado_boxy_text_styles() {

        $text_styles = array();

        if (hashmag_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = hashmag_mikado_options()->getOptionValue('text_color');
        }
        if (hashmag_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('text_fontsize')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('text_lineheight')) . 'px';
        }
        if (hashmag_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('text_fontweight');
        }

        $text_selector = array(
            'body'
        );

        if (!empty($text_styles)) {
            echo hashmag_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_boxy_text_styles');
}

if (!function_exists('hashmag_mikado_link_styles')) {

    function hashmag_mikado_link_styles() {

        $link_styles = array();

        if (hashmag_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = hashmag_mikado_options()->getOptionValue('link_color');
        }
        if (hashmag_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = hashmag_mikado_options()->getOptionValue('link_fontstyle');
        }
        if (hashmag_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('link_fontweight');
        }
        if (hashmag_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = hashmag_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo hashmag_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_link_styles');
}

if (!function_exists('hashmag_mikado_link_hover_styles')) {

    function hashmag_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if (hashmag_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = hashmag_mikado_options()->getOptionValue('link_hovercolor');
        }
        if (hashmag_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = hashmag_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo hashmag_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if (hashmag_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = hashmag_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo hashmag_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_link_hover_styles');
}

if (!function_exists('hashmag_mikado_sidebar_styles')) {

    function hashmag_mikado_sidebar_styles() {

        $sidebar_styles = array();

        if (hashmag_mikado_options()->getOptionValue('sidebar_background_color') !== '') {
            $sidebar_styles['background-color'] = hashmag_mikado_options()->getOptionValue('sidebar_background_color');
        }

        if (hashmag_mikado_options()->getOptionValue('sidebar_padding_top') !== '') {
            $sidebar_styles['padding-top'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidebar_padding_top')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidebar_padding_right') !== '') {
            $sidebar_styles['padding-right'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidebar_padding_right')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidebar_padding_bottom') !== '') {
            $sidebar_styles['padding-bottom'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidebar_padding_bottom')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidebar_padding_left') !== '') {
            $sidebar_styles['padding-left'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidebar_padding_left')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidebar_alignment') !== '') {
            $sidebar_styles['text-align'] = hashmag_mikado_options()->getOptionValue('sidebar_alignment');
        }

        if (!empty($sidebar_styles)) {
            echo hashmag_mikado_dynamic_css('aside.mkdf-sidebar', $sidebar_styles);
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_sidebar_styles');
}