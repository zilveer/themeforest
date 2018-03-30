<?php
if(!function_exists('hue_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function hue_mikado_design_styles() {

        $preload_background_styles = array();

        if(hue_mikado_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url('.hue_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        } else {
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo hue_mikado_dynamic_css('.mkd-preload-background', $preload_background_styles);

        if(hue_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = hue_mikado_options()->getOptionValue('google_fonts');
            if(hue_mikado_is_font_option_valid($font_family)) {
                echo hue_mikado_dynamic_css('body', array('font-family' => hue_mikado_get_font_option_val($font_family)));
            }
        }

        if(hue_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a',
                'p a',
                '.mkd-type2-gradient-left-to-right-text i',
                '.mkd-type2-gradient-left-to-right-text i:before',
                '.mkd-type2-gradient-left-to-right-text span',
                '.mkd-type2-gradient-bottom-to-top-text i',
                '.mkd-type2-gradient-bottom-to-top-text i:before',
                '.mkd-type2-gradient-bottom-to-top-text span',
                '.mkd-comment-holder .mkd-comment-reply-holder a.comment-reply-link:before',
                '.mkd-pagination li.active span',
                '#mkd-back-to-top',
                '.mkd-like.liked',
                'aside.mkd-sidebar .widget .searchform input[type=submit]',
                '.wpb_widgetised_column .widget .searchform input[type=submit]',
                'aside.mkd-sidebar .widget.widget_recent_comments ul li a:hover',
                '.wpb_widgetised_column .widget.widget_recent_comments ul li a:hover',
                'aside.mkd-sidebar .widget.widget_rss ul li a:hover',
                '.wpb_widgetised_column .widget.widget_rss ul li a:hover',
                'aside.mkd-sidebar .widget.widget_nav_menu ul.menu li a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul.menu li a:hover',
                'aside.mkd-sidebar .widget.widget_nav_menu .current-menu-item > a',
                '.wpb_widgetised_column .widget.widget_nav_menu .current-menu-item > a',
                'aside.mkd-sidebar .widget.widget_meta ul li a:hover',
                '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
                'aside.mkd-sidebar .widget.widget_pages ul li a:hover',
                '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
                'aside.mkd-sidebar .widget.widget_product_tag_cloud .tagcloud a:hover',
                'aside.mkd-sidebar .widget.widget_tag_cloud .tagcloud a:hover',
                '.wpb_widgetised_column .widget.widget_product_tag_cloud .tagcloud a:hover',
                '.wpb_widgetised_column .widget.widget_tag_cloud .tagcloud a:hover',
                'aside.mkd-sidebar .widget.widget_archive ul li:hover',
                '.wpb_widgetised_column .widget.widget_archive ul li:hover',
                'aside.mkd-sidebar .widget.widget_archive ul li:hover a',
                '.wpb_widgetised_column .widget.widget_archive ul li:hover a',
                'aside.mkd-sidebar .widget.widget_archive ul li:hover:before',
                '.wpb_widgetised_column .widget.widget_archive ul li:hover:before',
                '.mkd-main-menu ul .mkd-menu-featured-icon',
                '.mkd-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
                '.mkd-drop-down .wide .second ul li .flexslider ul li a:hover',
                '.mkd-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
                '.mkd-header-vertical .mkd-vertical-menu .mkd-menu-featured-icon',
                '.mkd-mobile-header .mkd-mobile-nav a:hover',
                '.mkd-mobile-header .mkd-mobile-nav h4:hover',
                '.mkd-mobile-header .mkd-mobile-menu-opener a:hover',
                'footer .mkd-footer-top-holder .widget.widget_pages ul li a:hover',
                'footer .mkd-footer-top-holder .widget.widget_archive ul li:hover',
                'footer .mkd-footer-top-holder .widget.widget_archive ul li:hover a',
                'footer .mkd-footer-top-holder .widget.widget_archive ul li:hover:before',
                'footer .mkd-footer-top-holder .widget.widget_archive ul li a:hover',
                'footer .mkd-footer-top-holder .widget ul li a:hover',
                'footer .mkd-footer-top-holder .widget.widget_categories ul li a:hover',
                'footer .mkd-footer-top-holder .widget.widget_product_tag_cloud .tagcloud a:hover',
                'footer .mkd-footer-top-holder .widget.widget_tag_cloud .tagcloud a:hover',
                'ooter .mkd-footer-bottom-holder .widget.widget_nav_menu ul#menu-footer-bottom-menu li a:hover',
                '.mkd-side-menu .widget .searchform input[type=submit]',
                '.mkd-side-menu .mkd-working-hours-holder .mkd-wh-item:last-child .mkd-wh-hours .mkd-wh-from',
                '.mkd-search-cover .mkd-search-close a:hover ',
                '.mkd-search-slide-header-bottom .mkd-search-submit:hover',
                '.mkd-portfolio-single-holder .mkd-portfolio-info-item h6',
                '.mkd-portfolio-single-holder .mkd-portfolio-single-nav .mkd-icon-stack',
                '.countdown-amount',
                '.mkd-message .mkd-message-inner a.mkd-close i:hover',
                '.mkd-ordered-list ol > li:before',
                '.mkd-icon-list-item .mkd-icon-list-icon-holder-inner i',
                '.mkd-icon-list-item .mkd-icon-list-icon-holder-inner .font_elegant',
                '.mkd-price-table .mkd-price-table-inner .mkd-pt-label-holder .mkd-pt-label-inner',
                '.mkd-accordion-holder .mkd-title-holder span.mkd-accordion-number',
                '.mkd-blog-list-holder .mkd-item-info-section > div > a:hover',
                '.mkd-blog-list-holder.mkd-grid-type-2 .mkd-post-item-author-holder a:hover',
                '.mkd-blog-list-holder.mkd-masonry .mkd-post-item-author-holder a:hover',
                '.mkd-blog-list-holder.mkd-image-in-box h6.mkd-item-title a:hover',
                '.mkd-btn.mkd-btn-outline',
                '.woocommerce .mkd-btn-outline.button',
                '.post-password-form input.mkd-btn-outline[type="submit"]',
                'input.mkd-btn-outline.wpcf7-form-control.wpcf7-submit',
                'blockquote .mkd-icon-quotations-holder',
                '.mkd-video-button-play .mkd-video-button-wrapper',
                '.mkd-dropcaps',
                '.mkd-social-share-holder.mkd-list li a:hover',
                '.mkd-social-share-holder.mkd-list [class*="google-plus"]',
                '.mkd-process-slider-holder .mkd-number-holder-inner',
                '.mkd-process-holder .mkd-number-holder-inner',
                '.mkd-icon-progress-bar .mkd-ipb-active',
                '.woocommerce-pagination .page-numbers li span.current',
                '.woocommerce-pagination .page-numbers li a:hover',
                '.woocommerce-pagination .page-numbers li span:hover',
                '.woocommerce-pagination .page-numbers li span.current:hover',
                '.mkd-woocommerce-page .select2-results .select2-highlighted',
                '.mkd-woocommerce-page .price ins',
                '.woocommerce .price ins',
                '.mkd-woocommerce-page .mkd-onsale',
                '.mkd-woocommerce-page .mkd-out-of-stock',
                '.woocommerce .mkd-onsale',
                '.woocommerce .mkd-out-of-stock',
                '.mkd-woocommerce-page .star-rating:before',
                '.woocommerce .star-rating:before',
                '.woocommerce .star-rating span:before',
                '.single-product .mkd-single-product-summary .price .amount ins',
                '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_layered_nav a:hover',
                '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product-categories a:hover',
                '.wpb_widgetised_column .widget.widget_layered_nav a:hover',
                '.wpb_widgetised_column .widget .product-categories a:hover',
                '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product_list_widget li .mkd-woo-product-widget-content ins',
                '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product_list_widget li .mkd-woo-product-widget-content .amount',
                '.wpb_widgetised_column .widget .product_list_widget li .mkd-woo-product-widget-content ins',
                '.wpb_widgetised_column .widget .product_list_widget li .mkd-woo-product-widget-content .amount',
                '.mkd-shopping-cart-dropdown ul li a:hover',
                '.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-left a:hover',
                '.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-right .remove:hover',
                '.mkd-shopping-cart-dropdown span.mkd-total span',
                '.mkd-shopping-cart-dropdown span.mkd-quantity',
                '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
                '.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .woocommerce-shipping-calculator > p a:hover',
                '.mkd-blog-holder article.sticky .mkd-post-title a',
                '.mkd-blog-holder article .mkd-post-info a:hover',
                '.mkd-blog-holder article .mkd-post-info .mkd-like.liked i',
                '.mkd-filter-blog-holder li.mkd-active',
                '.single .mkd-author-description .mkd-author-social-holder .mkd-author-social-google-plus',
                '.single .mkd-author-description .mkd-author-description-text-holder h6.mkd-author-position',
                '.single .mkd-single-tags-holder .mkd-tags a:hover',
                '.single .mkd-blog-single-navigation .mkd-icon-stack',
                'article .mkd-category span.icon_tags',
                '.single-product .mkd-single-product-summary form.cart .price ins .amount',
                '.mkd-blog-slider-holder.mkd-blog-slider-two .mkd-post-info-comments'
            );

            $color_important_selector = array(
                '.mkd-testimonials .mkd-testimonials-job',
                '.mkd-btn.mkd-btn-hover-outline:not(.mkd-btn-custom-hover-color):not(.mkd-btn-transparent):hover',
                '.woocommerce .button:not(.mkd-btn-custom-hover-color):hover',
                '.post-password-form input[type="submit"]:not(.mkd-btn-custom-hover-color):hover',
                'input.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-color):hover',
                '.mkd-btn.mkd-btn-hover-white:not(.mkd-btn-custom-hover-color):hover',
                '.woocommerce .mkd-btn-hover-white.button:not(.mkd-btn-custom-hover-color):hover',
                '.post-password-form input.mkd-btn-hover-white[type="submit"]:not(.mkd-btn-custom-hover-color):hover',
                'input.mkd-btn-hover-white.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-color):hover',
                '.mkd-twitter-slider.mkd-nav-dark .slick-slider .slick-dots li.slick-active button:before',
                '.mkd-process-slider-holder .slick-slider .slick-dots li.slick-active button:before',
                '.mkd-team-slider-holder.mkd-nav-light .slick-slider .slick-dots li.slick-active button:before',
                '.mkd-team-slider-holder .slick-dots li.slick-active button:before'
            );

            $background_color_selector = array(
                '.mkd-st-loader .pulse',
                '.mkd-st-loader .double_pulse .double-bounce1',
                '.mkd-st-loader .double_pulse .double-bounce2',
                '.mkd-st-loader .cube',
                '.mkd-st-loader .rotating_cubes .cube1',
                '.mkd-st-loader .rotating_cubes .cube2',
                '.mkd-st-loader .stripes > div',
                '.mkd-st-loader .wave > div',
                '.mkd-st-loader .two_rotating_circles .dot1',
                '.mkd-st-loader .two_rotating_circles .dot2',
                '.mkd-st-loader .five_rotating_circles .container1 > div',
                '.mkd-st-loader .five_rotating_circles .container2 > div',
                '.mkd-st-loader .five_rotating_circles .container3 > div',
                '.mkd-st-loader .atom .ball-1:before',
                '.mkd-st-loader .atom .ball-2:before',
                '.mkd-st-loader .atom .ball-3:before',
                '.mkd-st-loader .atom .ball-4:before',
                '.mkd-st-loader .clock .ball:before',
                '.mkd-st-loader .mitosis .ball',
                '.mkd-st-loader .lines .line1',
                '.mkd-st-loader .lines .line2',
                '.mkd-st-loader .lines .line3',
                '.mkd-st-loader .lines .line4',
                '.mkd-st-loader .fussion .ball',
                '.mkd-st-loader .fussion .ball-1',
                '.mkd-st-loader .fussion .ball-2',
                '.mkd-st-loader .fussion .ball-3',
                '.mkd-st-loader .fussion .ball-4',
                '.mkd-st-loader .wave_circles .ball',
                '.mkd-st-loader .pulse_circles .ball',
                '.mkd-team .mkd-team-hover',
                '.mkd-team.main-info-below-image .mkd-team-info .mkd-team-position',
                '.mkd-counter-holder .mkd-counter',
                '.mkd-icon-shortcode.circle, .mkd-icon-shortcode.square',
                '.mkd-testimonials.owl-carousel .owl-dots .owl-dot.active span',
                '.mkd-price-table.mkd-pt-active .mkd-price-table-inner',
                '.mkd-pie-chart-doughnut-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
                '.mkd-pie-chart-doughnut-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
                '.mkd-pie-chart-pie-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
                '.mkd-btn.mkd-btn-solid, .woocommerce .button',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.mkd-btn.mkd-btn-hover-solid .mkd-btn-helper',
                '.woocommerce .mkd-btn-hover-solid.button .mkd-btn-helper',
                '.post-password-form input.mkd-btn-hover-solid[type="submit"] .mkd-btn-helper',
                'input.mkd-btn-hover-solid.wpcf7-form-control.wpcf7-submit .mkd-btn-helper',
                'blockquote .mkd-blockquote-text:after',
                '.mkd-dropcaps.mkd-square',
                '.mkd-dropcaps.mkd-circle',
                '.mkd-process-slider-holder .mkd-pi-flip .mkd-pi-back',
                '.mkd-comparision-pricing-tables-holder .mkd-cpt-table .mkd-cpt-table-btn a',
                '.mkd-vertical-progress-bar-holder .mkd-vpb-active-bar',
                '.mkd-zooming-slider-holder .slick-dots .slick-active button',
                '.mkd-zooming-slider-holder .slick-dots li:hover button',
                '#multiscroll-nav ul li .active span',
                '.mkd-product-slider .mkd-product-slider-pager a.selected',
                '.widget_mkd_call_to_action_button .mkd-call-to-action-button',
                '.mkd-woocommerce-page ul.products li:hover .added_to_cart',
                '.woocommerce ul.products li:hover .added_to_cart',
                '.mkd-shopping-cart-outer .mkd-shopping-cart-header .mkd-header-cart .mkd-cart-count',
                '.mkd-blog-holder.mkd-blog-type-masonry:not(.mkd-masonry-simple) .format-quote .mkd-post-content',
                '.mkd-blog-holder.mkd-blog-type-standard .format-quote .mkd-post-content .mkd-post-text',
                '.mkd-team-slider-holder .mkd-team.main-info-below-image.mkd-team-flip .mkd-team-back',
                '.mkd-process-slider-holder .mkd-pi-flip .mkd-pi-back',
				'.mkd-blog-slider-holder .slick-dots li.slick-active',
                '.mkd-card-slider-holder .controls .dots .dots-inner .dot.active'
            );

            $background_color_important_selector = array(
                '.mkd-carousel-pagination .owl-dot.active span',
                '.mkd-woocommerce-page .price_slider_amount button.button',
                '.woocommerce .price_slider_amount button.button'
            );

            $border_color_selector = array(
                '.mkd-st-loader .pulse_circles .ball',
                '.mkd-btn.mkd-btn-solid, .woocommerce .button',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.mkd-btn.mkd-btn-outline',
                '.woocommerce .mkd-btn-outline.button',
                '.post-password-form input.mkd-btn-outline[type="submit"]',
                'input.mkd-btn-outline.wpcf7-form-control.wpcf7-submit',
                '.woocommerce .login input[type=text]:focus',
                '.woocommerce .login input[type=password]:focus',
                '.woocommerce .login input[type=email]:focus',
                '.woocommerce .register input[type=text]:focus',
                '.woocommerce .register input[type=password]:focus',
                '.woocommerce .register input[type=email]:focus',
                '.mkd-woocommerce-page .price_slider_amount button.button',
                '.woocommerce .price_slider_amount button.button',
                '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus',
                '.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .form-row input[type=text]:focus',
                '.woocommerce-checkout .checkout_coupon input[type=text]:focus',
                '.woocommerce-checkout .login input[type=text]:focus',
                '.woocommerce-checkout .login input[type=password]:focus',
                '.woocommerce-checkout form.checkout input[type=text]:focus',
                '.woocommerce-checkout form.checkout input[type=email]:focus',
                '.woocommerce-checkout form.checkout input[type=password]:focus',
                '.woocommerce-checkout form.checkout input[type=tel]:focus',
                '.woocommerce-checkout form.checkout textarea:focus',
                '.woocommerce-account .woocommerce input[type=text]:focus',
                '.woocommerce-account .woocommerce input[type=email]:focus',
                '.woocommerce-account .woocommerce input[type=tel]:focus',
                '.woocommerce-account .woocommerce textarea:focus',
            );

            $border_color_important_selector = array(
                '.mkd-btn.mkd-btn-hover-outline:not(.mkd-btn-custom-border-hover):not(.mkd-btn-gradient):hover',
                '.woocommerce .button:not(.mkd-btn-custom-border-hover):not(.mkd-btn-gradient):hover',
                '.post-password-form input[type="submit"]:not(.mkd-btn-custom-border-hover):not(.mkd-btn-gradient):hover',
                'input.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-border-hover):not(.mkd-btn-gradient):hover',
                '.mkd-btn.mkd-btn-hover-solid:not(.mkd-btn-custom-border-hover):hover',
                '.woocommerce .mkd-btn-hover-solid.button:not(.mkd-btn-custom-border-hover):hover',
                '.post-password-form input.mkd-btn-hover-solid[type="submit"]:not(.mkd-btn-custom-border-hover):hover',
                'input.mkd-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-border-hover):hover'
            );


            $border_top_color_selector = array(
                '.mkd-progress-bar .mkd-progress-number-wrapper.mkd-floating .mkd-down-arrow'
            );

            $border_bottom_color_selector = array(
                '.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .woocommerce-shipping-calculator > p:after',
                '.woocommerce-account .woocommerce h2:after'
            );

            echo hue_mikado_dynamic_css($color_selector, array('color' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css($color_important_selector, array('color' => hue_mikado_options()->getOptionValue('first_color').'!important'));
            echo hue_mikado_dynamic_css('::selection', array('background' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css('::-moz-selection', array('background' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css($background_color_selector, array('background-color' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css($background_color_important_selector, array('background-color' => hue_mikado_options()->getOptionValue('first_color').'!important'));
            echo hue_mikado_dynamic_css($border_color_selector, array('border-color' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css($border_color_important_selector, array('border-color' => hue_mikado_options()->getOptionValue('first_color').'!important'));
            echo hue_mikado_dynamic_css($border_top_color_selector, array('border-top-color' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => hue_mikado_options()->getOptionValue('first_color')));
            echo hue_mikado_dynamic_css('.mkd-preloader svg circle', array('stroke' => hue_mikado_options()->getOptionValue('first_color')));
        }

        if(hue_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkd-wrapper-inner',
                '.mkd-content'
            );
            echo hue_mikado_dynamic_css($background_color_selector, array('background-color' => hue_mikado_options()->getOptionValue('page_background_color')));
        }

        if(hue_mikado_options()->getOptionValue('selection_color')) {
            echo hue_mikado_dynamic_css('::selection', array('background' => hue_mikado_options()->getOptionValue('selection_color')));
            echo hue_mikado_dynamic_css('::-moz-selection', array('background' => hue_mikado_options()->getOptionValue('selection_color')));
        }

        if(hue_mikado_options()->getOptionValue('gradient_style1_start_color') !== '#e14b4f' && hue_mikado_options()->getOptionValue('gradient_style1_start_color') !== '' &&
           hue_mikado_options()->getOptionValue('gradient_style1_end_color') !== '#58b0e3' && hue_mikado_options()->getOptionValue('gradient_style1_end_color') !== ''
        ) {

            echo hue_mikado_dynamic_css('.mkd-type1-gradient-left-to-right', array(
                'background' => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type1-gradient-bottom-to-top, .mkd-type1-gradient-bottom-to-top-after:after', array(
                'background' => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => '-o-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => '-moz-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => 'linear-gradient(to top,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type1-gradient-left-bottom-to-right-top', array(
                'background' => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style1_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_start_color').')',
                'background' => '-o-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => '-moz-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
                'background' => 'linear-gradient(to right top,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type1-gradient-left-to-right-2x', array(
                'background'      => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 100%)',
                'background'      => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 100%)',
                'background'      => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 100%)',
                'background'      => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style1_end_color').' 50%,'.hue_mikado_options()->getOptionValue('gradient_style1_start_color').' 100%)',
                'background-size' => '200% 200%'
            ));

            echo hue_mikado_dynamic_css('.mkd-type1-gradient-left-to-right-text i, .mkd-type1-gradient-left-to-right-text i:before, .mkd-type1-gradient-left-to-right-text span', array(
                'background'              => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style1_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style1_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

            echo hue_mikado_dynamic_css('.mkd-type1-gradient-bottom-to-top-text i, .mkd-type1-gradient-bottom-to-top-text i:before, .mkd-type1-gradient-bottom-to-top-text span', array(
                'background'              => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style1_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style1_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style1_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

        }

        if(hue_mikado_options()->getOptionValue('gradient_style2_start_color') !== '#d4145a' && hue_mikado_options()->getOptionValue('gradient_style2_start_color') !== '' &&
           hue_mikado_options()->getOptionValue('gradient_style2_end_color') !== '#e8664a' && hue_mikado_options()->getOptionValue('gradient_style2_end_color') !== ''
        ) {

            echo hue_mikado_dynamic_css('.mkd-type2-gradient-left-to-right', array(
                'background' => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type2-gradient-bottom-to-top, .mkd-type2-gradient-bottom-to-top-after:after', array(
                'background' => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => '-o-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => '-moz-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => 'linear-gradient(to top,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type2-gradient-left-bottom-to-right-top', array(
                'background' => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style2_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_start_color').')',
                'background' => '-o-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => '-moz-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
                'background' => 'linear-gradient(to right top,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type2-gradient-left-to-right-2x', array(
                'background'      => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 100%)',
                'background'      => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 100%)',
                'background'      => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 100%)',
                'background'      => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style2_end_color').' 50%,'.hue_mikado_options()->getOptionValue('gradient_style2_start_color').' 100%)',
                'background-size' => '200% 200%'
            ));

            echo hue_mikado_dynamic_css('.mkd-type2-gradient-left-to-right-text i, .mkd-type2-gradient-left-to-right-text i:before, .mkd-type2-gradient-left-to-right-text span', array(
                'background'              => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style2_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style2_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

            echo hue_mikado_dynamic_css('.mkd-type2-gradient-bottom-to-top-text i, .mkd-type2-gradient-bottom-to-top-text i:before, .mkd-type2-gradient-bottom-to-top-text span', array(
                'background'              => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style2_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style2_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style2_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

        }

        if(hue_mikado_options()->getOptionValue('gradient_style3_start_color') !== '#0caaaa' && hue_mikado_options()->getOptionValue('gradient_style3_start_color') !== '' &&
           hue_mikado_options()->getOptionValue('gradient_style3_end_color') !== '#63aed3' && hue_mikado_options()->getOptionValue('gradient_style3_end_color') !== ''
        ) {

            echo hue_mikado_dynamic_css('.mkd-type3-gradient-left-to-right', array(
                'background' => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type3-gradient-bottom-to-top, .mkd-type3-gradient-bottom-to-top-after:after', array(
                'background' => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => '-o-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => '-moz-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => 'linear-gradient(to top,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type3-gradient-left-bottom-to-right-top', array(
                'background' => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style3_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_start_color').')',
                'background' => '-o-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => '-moz-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
                'background' => 'linear-gradient(to right top,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type3-gradient-left-to-right-2x', array(
                'background'      => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 100%)',
                'background'      => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 100%)',
                'background'      => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 100%)',
                'background'      => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style3_end_color').' 50%,'.hue_mikado_options()->getOptionValue('gradient_style3_start_color').' 100%)',
                'background-size' => '200% 200%'
            ));

            echo hue_mikado_dynamic_css('.mkd-type3-gradient-left-to-right-text i, .mkd-type3-gradient-left-to-right-text i:before, .mkd-type3-gradient-left-to-right-text span', array(
                'background'              => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style3_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style3_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

            echo hue_mikado_dynamic_css('.mkd-type3-gradient-bottom-to-top-text i, .mkd-type3-gradient-bottom-to-top-text i:before, .mkd-type3-gradient-bottom-to-top-text span', array(
                'background'              => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style3_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style3_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style3_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

        }

        if(hue_mikado_options()->getOptionValue('gradient_style4_start_color') !== '#f5bd24' && hue_mikado_options()->getOptionValue('gradient_style4_start_color') !== '' &&
           hue_mikado_options()->getOptionValue('gradient_style4_end_color') !== '#ffd33c' && hue_mikado_options()->getOptionValue('gradient_style4_end_color') !== ''
        ) {

            echo hue_mikado_dynamic_css('.mkd-type4-gradient-left-to-right', array(
                'background' => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type4-gradient-bottom-to-top, .mkd-type4-gradient-bottom-to-top-after:after', array(
                'background' => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => '-o-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => '-moz-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => 'linear-gradient(to top,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type4-gradient-left-bottom-to-right-top', array(
                'background' => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style4_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_start_color').')',
                'background' => '-o-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => '-moz-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
                'background' => 'linear-gradient(to right top,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type4-gradient-left-to-right-2x', array(
                'background'      => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 100%)',
                'background'      => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 100%)',
                'background'      => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 100%)',
                'background'      => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style4_end_color').' 50%,'.hue_mikado_options()->getOptionValue('gradient_style4_start_color').' 100%)',
                'background-size' => '200% 200%'
            ));

            echo hue_mikado_dynamic_css('.mkd-type4-gradient-left-to-right-text i, .mkd-type4-gradient-left-to-right-text i:before, .mkd-type4-gradient-left-to-right-text span', array(
                'background'              => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style4_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style4_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

            echo hue_mikado_dynamic_css('.mkd-type4-gradient-bottom-to-top-text i, .mkd-type4-gradient-bottom-to-top-text i:before, .mkd-type4-gradient-bottom-to-top-text span', array(
                'background'              => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style4_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style4_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style4_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

        }

        if(hue_mikado_options()->getOptionValue('gradient_style5_start_color') !== '#48316b' && hue_mikado_options()->getOptionValue('gradient_style5_start_color') !== '' &&
           hue_mikado_options()->getOptionValue('gradient_style5_end_color') !== '#913156' && hue_mikado_options()->getOptionValue('gradient_style5_end_color') !== ''
        ) {

            echo hue_mikado_dynamic_css('.mkd-type5-gradient-left-to-right', array(
                'background' => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type5-gradient-bottom-to-top, .mkd-type5-gradient-bottom-to-top-after:after', array(
                'background' => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => '-o-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => '-moz-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => 'linear-gradient(to top,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type5-gradient-left-bottom-to-right-top', array(
                'background' => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style5_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_start_color').')',
                'background' => '-o-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => '-moz-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
                'background' => 'linear-gradient(to right top,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type5-gradient-left-to-right-2x', array(
                'background'      => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 100%)',
                'background'      => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 100%)',
                'background'      => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 100%)',
                'background'      => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style5_end_color').' 50%,'.hue_mikado_options()->getOptionValue('gradient_style5_start_color').' 100%)',
                'background-size' => '200% 200%'
            ));

            echo hue_mikado_dynamic_css('.mkd-type5-gradient-left-to-right-text i, .mkd-type5-gradient-left-to-right-text i:before, .mkd-type5-gradient-left-to-right-text span', array(
                'background'              => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style5_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style5_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

            echo hue_mikado_dynamic_css('.mkd-type5-gradient-bottom-to-top-text i, .mkd-type5-gradient-bottom-to-top-text i:before, .mkd-type5-gradient-bottom-to-top-text span', array(
                'background'              => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style5_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style5_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style5_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

        }

        if(hue_mikado_options()->getOptionValue('gradient_style6_start_color') !== '#3a3897' && hue_mikado_options()->getOptionValue('gradient_style6_start_color') !== '' &&
           hue_mikado_options()->getOptionValue('gradient_style6_end_color') !== '#00ffee' && hue_mikado_options()->getOptionValue('gradient_style6_end_color') !== ''
        ) {

            echo hue_mikado_dynamic_css('.mkd-type6-gradient-left-to-right', array(
                'background' => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type6-gradient-bottom-to-top, .mkd-type6-gradient-bottom-to-top-after:after', array(
                'background' => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => '-o-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => '-moz-linear-gradient(top,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => 'linear-gradient(to top,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type6-gradient-left-bottom-to-right-top', array(
                'background' => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style6_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_start_color').')',
                'background' => '-o-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => '-moz-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
                'background' => 'linear-gradient(to right top,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').')',
            ));

            echo hue_mikado_dynamic_css('.mkd-type6-gradient-left-to-right-2x', array(
                'background'      => '-webkit-linear-gradient(left,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 100%)',
                'background'      => '-o-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 100%)',
                'background'      => '-moz-linear-gradient(right,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').' 50% ,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 100%)',
                'background'      => 'linear-gradient(to right,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 0%, '.hue_mikado_options()->getOptionValue('gradient_style6_end_color').' 50%,'.hue_mikado_options()->getOptionValue('gradient_style6_start_color').' 100%)',
                'background-size' => '200% 200%'
            ));

            echo hue_mikado_dynamic_css('.mkd-type6-gradient-left-to-right-text i, .mkd-type6-gradient-left-to-right-text i:before, .mkd-type6-gradient-left-to-right-text span', array(
                'background'              => '-webkit-linear-gradient(right top,'.hue_mikado_options()->getOptionValue('gradient_style6_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style6_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

            echo hue_mikado_dynamic_css('.mkd-type6-gradient-bottom-to-top-text i, .mkd-type6-gradient-bottom-to-top-text i:before, .mkd-type6-gradient-bottom-to-top-text span', array(
                'background'              => '-webkit-linear-gradient(bottom,'.hue_mikado_options()->getOptionValue('gradient_style6_end_color').', '.hue_mikado_options()->getOptionValue('gradient_style6_start_color').')',
                'color'                   => hue_mikado_options()->getOptionValue('gradient_style6_start_color'),
                '-webkit-background-clip' => 'text',
                '-webkit-text-fill-color' => 'transparent'
            ));

        }

        $boxed_background_style = array();
        if(hue_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = hue_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if(hue_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(hue_mikado_options()->getOptionValue('boxed_background_image')).')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat']   = 'no-repeat';
        }

        if(hue_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(hue_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat']   = 'repeat';
        }

        if(hue_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (hue_mikado_options()->getOptionValue('boxed_background_image_attachment'));
        }

        echo hue_mikado_dynamic_css('.mkd-boxed .mkd-wrapper', $boxed_background_style);
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_design_styles');
}

if(!function_exists('hue_mikado_h1_styles')) {

    function hue_mikado_h1_styles() {

        $h1_styles = array();

        if(hue_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = hue_mikado_options()->getOptionValue('h1_color');
        }
        if(hue_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = hue_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = hue_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = hue_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if(!empty($h1_styles)) {
            echo hue_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_h1_styles');
}

if(!function_exists('hue_mikado_h2_styles')) {

    function hue_mikado_h2_styles() {

        $h2_styles = array();

        if(hue_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = hue_mikado_options()->getOptionValue('h2_color');
        }
        if(hue_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = hue_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = hue_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = hue_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if(!empty($h2_styles)) {
            echo hue_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_h2_styles');
}

if(!function_exists('hue_mikado_h3_styles')) {

    function hue_mikado_h3_styles() {

        $h3_styles = array();

        if(hue_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = hue_mikado_options()->getOptionValue('h3_color');
        }
        if(hue_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = hue_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = hue_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = hue_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if(!empty($h3_styles)) {
            echo hue_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_h3_styles');
}

if(!function_exists('hue_mikado_h4_styles')) {

    function hue_mikado_h4_styles() {

        $h4_styles = array();

        if(hue_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = hue_mikado_options()->getOptionValue('h4_color');
        }
        if(hue_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = hue_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = hue_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = hue_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if(!empty($h4_styles)) {
            echo hue_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_h4_styles');
}

if(!function_exists('hue_mikado_h5_styles')) {

    function hue_mikado_h5_styles() {

        $h5_styles = array();

        if(hue_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = hue_mikado_options()->getOptionValue('h5_color');
        }
        if(hue_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = hue_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = hue_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = hue_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if(!empty($h5_styles)) {
            echo hue_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_h5_styles');
}

if(!function_exists('hue_mikado_h6_styles')) {

    function hue_mikado_h6_styles() {

        $h6_styles = array();

        if(hue_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = hue_mikado_options()->getOptionValue('h6_color');
        }
        if(hue_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = hue_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = hue_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = hue_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if(!empty($h6_styles)) {
            echo hue_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_h6_styles');
}

if(!function_exists('hue_mikado_text_styles')) {

    function hue_mikado_text_styles() {

        $text_styles = array();

        if(hue_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = hue_mikado_options()->getOptionValue('text_color');
        }
        if(hue_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = hue_mikado_get_formatted_font_family(hue_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(hue_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(hue_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(hue_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = hue_mikado_options()->getOptionValue('text_texttransform');
        }
        if(hue_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = hue_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = hue_mikado_options()->getOptionValue('text_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if(!empty($text_styles)) {
            echo hue_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_text_styles');
}

if(!function_exists('hue_mikado_link_styles')) {

    function hue_mikado_link_styles() {

        $link_styles = array();

        if(hue_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = hue_mikado_options()->getOptionValue('link_color');
        }
        if(hue_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = hue_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(hue_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = hue_mikado_options()->getOptionValue('link_fontweight');
        }
        if(hue_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = hue_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if(!empty($link_styles)) {
            echo hue_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_link_styles');
}

if(!function_exists('hue_mikado_link_hover_styles')) {

    function hue_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(hue_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = hue_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(hue_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = hue_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if(!empty($link_hover_styles)) {
            echo hue_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(hue_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = hue_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if(!empty($link_heading_hover_styles)) {
            echo hue_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_link_hover_styles');
}

if(!function_exists('hue_mikado_smooth_page_transition_styles')) {

    function hue_mikado_smooth_page_transition_styles() {

        $loader_style = array();

        if(hue_mikado_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = hue_mikado_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.mkd-smooth-transition-loader');

        if(!empty($loader_style)) {
            echo hue_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(hue_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = hue_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.mkd-st-loader .pulse',
            '.mkd-st-loader .double_pulse .double-bounce1',
            '.mkd-st-loader .double_pulse .double-bounce2',
            '.mkd-st-loader .cube',
            '.mkd-st-loader .rotating_cubes .cube1',
            '.mkd-st-loader .rotating_cubes .cube2',
            '.mkd-st-loader .stripes > div',
            '.mkd-st-loader .wave > div',
            '.mkd-st-loader .two_rotating_circles .dot1',
            '.mkd-st-loader .two_rotating_circles .dot2',
            '.mkd-st-loader .five_rotating_circles .container1 > div',
            '.mkd-st-loader .five_rotating_circles .container2 > div',
            '.mkd-st-loader .five_rotating_circles .container3 > div',
            '.mkd-st-loader .atom .ball-1:before',
            '.mkd-st-loader .atom .ball-2:before',
            '.mkd-st-loader .atom .ball-3:before',
            '.mkd-st-loader .atom .ball-4:before',
            '.mkd-st-loader .clock .ball:before',
            '.mkd-st-loader .mitosis .ball',
            '.mkd-st-loader .lines .line1',
            '.mkd-st-loader .lines .line2',
            '.mkd-st-loader .lines .line3',
            '.mkd-st-loader .lines .line4',
            '.mkd-st-loader .fussion .ball',
            '.mkd-st-loader .fussion .ball-1',
            '.mkd-st-loader .fussion .ball-2',
            '.mkd-st-loader .fussion .ball-3',
            '.mkd-st-loader .fussion .ball-4',
            '.mkd-st-loader .wave_circles .ball',
            '.mkd-st-loader .pulse_circles .ball'
        );

        if(!empty($spinner_style)) {
            echo hue_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_smooth_page_transition_styles');
}