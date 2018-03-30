<?php
if(!function_exists('qode_startit_design_styles')) {
    /**
     * Generates general custom styles
     */
    function qode_startit_design_styles() {

        $preload_background_styles = array();

        if(qode_startit_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.qode_startit_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(QODE_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo qode_startit_dynamic_css('.qodef-preload-background', $preload_background_styles);

		if (qode_startit_options()->getOptionValue('google_fonts')){
			$font_family = qode_startit_options()->getOptionValue('google_fonts');
			if(qode_startit_is_font_option_valid($font_family)) {
				echo qode_startit_dynamic_css('body', array('font-family' => qode_startit_get_font_option_val($font_family)));
			}
		}

		if(qode_startit_options()->getOptionValue('sticky_header_height') !== "") {
			echo qode_startit_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-sticky-holder .qodef-logo-wrapper a ', array('max-height' => qode_startit_options()->getOptionValue('sticky_header_height')."px"));
		}

        if(qode_startit_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a',
                'p a',
                '.qodef-main-menu ul li ul li:hover a, .qodef-main-menu ul li ul li.qodef-active-item a',
                '.qodef-drop-down .second .inner ul li.sub ul li:hover > a',
				'.qodef-drop-down .second .inner ul li:hover > a',
                '.qodef-drop-down .wide .second .inner > ul > li > a:hover',
                '.qodef-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
                '.qodef-drop-down .wide .second ul li .flexslider ul li a:hover',
                '.qodef-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
                '.qodef-mobile-header .qodef-mobile-nav a:hover, .qodef-mobile-header .qodef-mobile-nav h4:hover',
                '.qodef-mobile-header .qodef-mobile-menu-opener a:hover',
                '.qodef-side-menu-button-opener:hover',
                'nav.qodef-fullscreen-menu ul li a:hover',
                'nav.qodef-fullscreen-menu ul li ul li a',
                '.qodef-search-slide-header-bottom .qodef-search-submit:hover',
                '.qodef-search-cover .qodef-search-close a:hover',
                '.qodef-message .qodef-message-inner a.qodef-close i:hover',
                '.qodef-ordered-list ol > li:before',
                '.qodef-icon-list-item .qodef-icon-list-icon-holder .qodef-icon-list-icon-holder-inner i',
                '.qodef-icon-list-item .qodef-icon-list-icon-holder .qodef-icon-list-icon-holder-inner .font_elegant',
                '.qodef-tabs .qodef-tabs-nav li a',
                '#submit_comment:hover',
                '.post-password-form input[type="submit"]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
				'.qodef-accordion-holder .qodef-title-holder.ui-state-active',
				'.qodef-accordion-holder .qodef-title-holder.ui-state-hover',
				'.qodef-icon-list-item .qodef-icon-list-icon-holder-inner i',
				'.qodef-icon-list-item .qodef-icon-list-icon-holder-inner .font_elegant',
				'.qodef-ordered-list ol>li:before',
				'.qodef-portfolio-filter-holder .qodef-portfolio-filter-holder-inner ul li.active span',
				'.qodef-portfolio-filter-holder .qodef-portfolio-filter-holder-inner ul li.current span',
				'.qodef-portfolio-list-holder.qodef-ptf-standard article .qodef-item-icons-holder a:hover',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-prev-icon i',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-next-icon i',
				'.qodef-search-opener:hover',
				'.qodef-side-menu a.qodef-close-side-menu:hover span',
                '.qodef-underline-icon-box-holder.qodef-underline-animation:hover .qodef-underline-icon-box-icon-holder .qodef-icon-shortcode .qodef-icon-element',
                '.qodef-pie-chart-with-icon-holder .qodef-percentage-with-icon i',
                '.qodef-pie-chart-with-icon-holder .qodef-percentage-with-icon span',
                '.qodef-blog-list-holder .qodef-item-info-section',
                '.qodef-blog-holder article .qodef-post-info a:hover',
                '.qodef-comment-holder .qodef-comment-text .qodef-comment-date',
                '.qodef-sidebar .widget a:hover',
                '.qodef-side-menu .widget a:hover',
                'footer a:hover',
                '#submit_comment:hover',
                '.post-password-form input[type="submit"]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.qodef-sidebar #searchform input[type="submit"]:hover',
                '.qodef-side-menu #searchform input[type="submit"]:hover',
                'footer input[type="submit"]:hover',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-social-inner a:hover',
				'.qodef-portfolio-single-holder .qodef-portfolio-info-holder h6',
				'.qodef-portfolio-single-holder .qodef-portfolio-single-nav .qodef-portfolio-back-btn span:hover',
				'.qodef-portfolio-single-holder .qodef-portfolio-single-nav .qodef-portfolio-next a:hover span', 
				'.qodef-portfolio-single-holder .qodef-portfolio-single-nav .qodef-portfolio-prev a:hover span',
				'.qodef-portfolio-list-holder-outer.qodef-ptf-gallery article .qodef-item-text-holder .qodef-ptf-category-holder',
				'.qodef-portfolio-filter-holder .qodef-portfolio-filter-holder-inner ul li span:hover',
                '.star-rating',
                '.qodef-woocommerce-page .select2-results .select2-highlighted',
                '.qodef-woocommerce-page .select2-container .select2-choice .select2-arrow b:after',
                '.qodef_twitter_widget li .tweet_icon_holder .social_twitter',
                '.qodef-single-product-summary .qodef-woocommerce-share-holder .qodef-social-share-holder a:hover',
                '.qodef-counter-holder .qodef-counter-title',
                '.qodef-shopping-cart-outer .qodef-shopping-cart-header .qodef-header-cart:hover i',
                '.qodef-woocommerce-page .qodef-cart-totals .order-total',
                '.qodef-woocommerce-page .woocommerce-checkout-review-order-table .order-total',
                '.qodef-process-holder .qodef-process-item:hover .qodef-process-item-title-holder > *',
                '.qodef-blog-holder article.sticky .qodef-post-title a',
                '.qodef-blog-list-holder .qodef-item-info-section > div a',
                '.qodef-blog-list-holder .qodef-item-info-section > div:before',
                '.qodef-blog-list-holder .qodef-item-info-section span',
                '.qodef-sidebar .widget.widget_recent_comments a',
                '.qodef-side-menu .widget.widget_recent_comments a',
                '.qodef-shopping-cart-dropdown .qodef-item-info-holder .qodef-item-left a:hover',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-subtotal-holder .qodef-total-amount',
                '.qodef-blog-holder.qodef-blog-type-masonry .qodef-btn',
                '.qodef-blog-holder.qodef-masonry-full-width .qodef-btn',
                '.countdown-period',
                '.qodef-menu-area .qodef-featured-icon',
                '.qodef-sticky-nav .qodef-featured-icon',
                '.qodef-portfolio-list-holder-outer.qodef-ptf-standard article .qodef-item-text-holder .qodef-ptf-category-holder span',
                '.qodef-portfolio-list-holder-outer.qodef-ptf-gallery article .qodef-item-text-holder .qodef-ptf-category-holder span',
                '.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
                '.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover',
                '.qodef-mobile-showcase .qodef-mobile-wrapper .qodef-screens > .qodef-screen:hover .qodef-label',
                '.qodef-pricing-info .qodef-pricing-info-pricing .qodef-value',
                '.qodef-pricing-info .qodef-pricing-info-pricing .qodef-price',
                '.qodef-service-table table tbody td .qodef-mark.qodef-checked',
                '.qodef-header-vertical .qodef-vertical-menu > ul > li > a .qodef-featured-icon',
                '.qodef-header-vertical .qodef-vertical-menu .second .inner .qodef-featured-icon',
                '.qodef-header-vertical .qodef-vertical-menu ul li a:hover',
                '.qodef-header-vertical .qodef-vertical-dropdown-float .second .inner ul li a:hover',
                '.qodef-testimonials.cards_carousel.dark .qodef-testimonials-job',
                '.qodef-testimonials-holder .owl-pagination .owl-page.active span',
                '.qodef-testimonials-holder .owl-pagination .owl-page.active span:before'
            );

            $color_important_selector = array(
                '.qodef-blog-holder.qodef-blog-type-masonry .qodef-btn:hover',
                '.qodef-blog-holder.qodef-masonry-full-width .qodef-btn:hover'
            );

            $background_color_selector = array(
                '.qodef-title',
                '.qodef-fullscreen-menu-opener:hover .qodef-line',
                '.qodef-fullscreen-menu-opener.opened:hover .qodef-line:after',
                '.qodef-fullscreen-menu-opener.opened:hover .qodef-line:before',
                '.qodef-icon-shortcode.circle, .qodef-icon-shortcode.square',
                '.qodef-progress-bar .qodef-progress-content-outer .qodef-progress-content',
                '.qodef-price-table.qodef-active .qodef-active-text',
                '.qodef-pie-chart-doughnut-holder .qodef-pie-legend ul li .qodef-pie-color-holder',
                '.qodef-pie-chart-pie-holder .qodef-pie-legend ul li .qodef-pie-color-holder',
                '.qodef-tabs .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs .qodef-tabs-nav li.ui-state-hover a',
                '.qodef-btn.qodef-btn-solid',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
				'.qodef-accordion-holder .qodef-title-holder.ui-state-active .qodef-accordion-mark',
				'.qodef-accordion-holder .qodef-title-holder.ui-state-hover .qodef-accordion-mark',
                '.qodef-accordion-holder.qodef-boxed .qodef-title-holder .qodef-accordion-mark',
                '.qodef-price-table.qodef-active .qodef-price-table-inner ul li.qodef-table-title',
                '.qodef-price-table .qodef-price-table-inner ul li.qodef-table-title',
				'.qodef-portfolio-list-holder.qodef-ptf-standard article .qodef-item-icons-holder a',
				'.qodef-team.main-info-below-image .qodef-circle-animate',
				'body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu > ul > li:hover > a .item_outer, .qodef-main-menu > ul > li.qodef-active-item > a .item_outer',
				'.qodef-drop-down .second .inner ul li a:before',
				'#qodef-back-to-top:hover > span',
                '.qodef-process-holder .qodef-process-item:hover .qodef-icon-shortcode.circle',
                '.qodef-underline-icon-box-holder .qodef-underline-icon-box-underline',
                '.qodef-image-with-icon-holder .qodef-image-with-icon-holder-icon-wrapper .qodef-icon-shortcode',
				'.qodef-icon-shortcode.circle.checked:before',
                '.qodef-image-with-icon-holder .qodef-image-with-icon-holder-icon-wrapper .qodef-icon-shortcode',
                '.qodef-input-title:before',
                '.qodef-social-share-holder.qodef-list a:hover',
                '.qodef-sidebar .widget h4:before',
                '.qodef-side-menu .widget h4:before',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                'footer input[type="submit"]',
                '.qodef-blog-holder article.format-audio .mejs-controls .mejs-time-rail .mejs-time-current',
                '.qodef-blog-holder article.format-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.qodef-pagination li.active',
                '.qodef-pagination li:hover',
                '.qodef-blog-holder.qodef-blog-type-standard .qodef-blog-standard-post-date .month',
                '.qodef-btn.qodef-btn-solid',
                '.qodef-btn.qodef-btn-icon:not(.qodef-btn-custom-hover-bg).qodef-btn-solid:hover',
                '.qodef-btn:not(.qodef-btn-custom-border-hover):hover',
                '.qodef-main-menu > ul > li > a .item_outer:before',
                '.qodef-woocommerce-page .product .qodef-onsale',
                '.page-template-default .woocommerce .product .qodef-onsale',
                '.page-template-full-width .woocommerce .product .qodef-onsale',
                '.qodef-woocommerce-page .qodef-woocommerce-product-list-add-to-cart-button-holder .added_to_cart:hover',
                '.page-template-default .woocommerce .qodef-woocommerce-product-list-add-to-cart-button-holder .added_to_cart:hover',
                '.page-template-full-width .woocommerce .qodef-woocommerce-product-list-add-to-cart-button-holder .added_to_cart:hover',
                '.woocommerce-pagination .page-numbers li span.current',
                '.woocommerce-pagination .page-numbers li a:hover',
                '.woocommerce-pagination .page-numbers li span:hover',
                '.woocommerce-pagination .page-numbers li span.current:hover',
                '.widget_price_filter .ui-slider-range',
                '.widget_price_filter .price_slider_amount .button',
                '.qodef-woocommerce-page .qodef-quantity-buttons .qodef-quantity-input',
                '.qodef-woocommerce-page .woocommerce-accordions.qodef-boxed .qodef-title-holder.ui-state-active',
                '.qodef-woocommerce-page .woocommerce-accordions.qodef-boxed .qodef-title-holder.ui-state-hover',
                '.qodef-woocommerce-page #reviews input[type="submit"]',
                'footer input.wpcf7-form-control.wpcf7-submit:hover',
                '.qodef-shopping-cart-outer .qodef-shopping-cart-header .qodef-cart-label',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .checkout',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .view-cart:hover',
                '.qodef-shopping-cart-dropdown .qodef-item-info-holder .qodef-item-right .remove:hover',
                '.qodef-woocommerce-page .checkout_coupon input[type="submit"]:hover',
                '.qodef-woocommerce-page .login .form-row input[type="submit"]:hover',
                '.qodef-woocommerce-page .lost_reset_password .form-row input[type="submit"]:hover',
                '.qodef-woocommerce-page .return-to-shop a:hover',
                '.qodef-team .qodef-team-social-holder',
                '.qodef-testimonials.filled .qodef-testimonial-text-holder .qodef-testimonial-text-inner',
                '.qodef-shopping-cart-dropdown .qodef-dropdown-top-stripe-holder',
                '.qodef-btn.qodef-btn-hover-animation .qodef-animation-overlay',
                '.woocommerce-edit-account input[type=submit]:hover',
                '.woocommerce-edit-address input[type=submit]:hover',
                '.woocommerce-view-order mark',
                '.qodef-blog-single .qodef-blog-standard-post-date .month',
                '.qodef-portfolio-list-holder-outer.qodef-ptf-standard article .qodef-item-icons-holder a:hover',
                '.qodef-portfolio-list-holder article .qodef-item-icons-holder a',
                '.qodef-portfolio-list-holder-outer.qodef-ptf-standard article .qodef-item-icons-holder a',
                '.qodef-single-product-summary table.variations td.label label:before',
                '.qodef-btn.qodef-btn-hover-animation:not(.qodef-btn-outline):not(.qodef-btn-custom-hover-bg):not(.qodef-btn-solid) .qodef-animation-overlay',
                '.qodef-info-box.qodef-animate .qodef-info-box-back-side',
                '.qodef-pricing-slider .qodef-pricing-slider-button.active .qodef-btn',
                '.qodef-pricing-slider .qodef-pricing-slider-button-extra.active .qodef-btn',
                '.qodef-pricing-slider .qodef-pricing-slider-drag',
                '.qodef-pricing-slider .qodef-pricing-slider-bar',
                '.qodef-blog-holder.qodef-blog-type-gallery .qodef-post-info-category a'
            );

            $background_color_important_selector = array(
                '.qodef-btn.qodef-btn-icon:not(.qodef-btn-custom-hover-bg).qodef-btn-solid:hover',
                '.qodef-btn:not(.qodef-btn-custom-hover-bg):hover',
                '.qodef-btn.qodef-btn-hover-animation:not(.qodef-btn-outline):hover.qodef-btn-solid:not(.qodef-btn-custom-hover-bg)'

            );

            $border_color_selector = array(
                '.qodef-drop-down .second',
                '.qodef-tabs .qodef-tabs-nav li a',
				'.qodef-tabs .qodef-tabs-nav li.ui-state-active a',
				'.qodef-tabs .qodef-tabs-nav li.ui-state-hover a',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus',
                '#respond textarea:focus',
                '#respond input[type="text"]:focus',
                '.post-password-form input[type="password"]:focus',
				'.qodef-accordion-holder .qodef-title-holder.ui-state-active .qodef-accordion-mark',
				'.qodef-accordion-holder .qodef-title-holder.ui-state-hover .qodef-accordion-mark',
				'.qodef-portfolio-list-holder article .qodef-item-icons-holder a',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-prev-icon',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-next-icon',
				'.qodef-drop-down .second .inner > ul',
                '.qodef-process-holder .qodef-process-item:hover .qodef-process-item-icon-holder',
                '.qodef-icon-shortcode.circle',
                '.qodef-icon-shortcode.square',
                '.qodef-single-tags-holder .qodef-tags a:after',
                'blockquote .qodef-blockquote-text',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                'footer input[type="submit"]',
                '.qodef-sidebar .tagcloud a:hover:after',
                '.qodef-side-menu .tagcloud a:hover:after',
                'footer .widget .tagcloud a:hover:after',
				'.qodef-portfolio-single-holder .qodef-portfolio-single-nav .qodef-portfolio-prev a:hover',
				'.qodef-portfolio-single-holder .qodef-portfolio-single-nav .qodef-portfolio-next a:hover',
                '.qodef-pagination li.active',
                '.qodef-pagination li:hover',
                '.qodef-btn.qodef-btn-solid',
                '.qodef-btn:not(.qodef-btn-custom-border-hover):hover',
                '.qodef-woocommerce-page .qodef-woocommerce-product-list-add-to-cart-button-holder .added_to_cart:hover',
                '.page-template-default .woocommerce .qodef-woocommerce-product-list-add-to-cart-button-holder .added_to_cart:hover',
                '.page-template-full-width .woocommerce .qodef-woocommerce-product-list-add-to-cart-button-holder .added_to_cart:hover',
                '.woocommerce-pagination .page-numbers li span.current',
                '.woocommerce-pagination .page-numbers li a:hover',
                '.woocommerce-pagination .page-numbers li span:hover',
                '.woocommerce-pagination .page-numbers li span.current:hover',
                '.widget_price_filter .ui-slider-handle',
                '.widget_price_filter .price_slider_amount .button',
                '.qodef-woocommerce-page .woocommerce-accordions.qodef-boxed .qodef-title-holder.ui-state-active',
                '.qodef-woocommerce-page .woocommerce-accordions.qodef-boxed .qodef-title-holder.ui-state-hover',
                'footer .qodef-footer-top-holder .widget.widget_recent_entries li a:before',
                '.qodef-woocommerce-page #reviews input[type="submit"]',
                'footer input.wpcf7-form-control.wpcf7-submit:hover',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .checkout',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .view-cart:hover',
                '.qodef-woocommerce-page .checkout_coupon input[type="submit"]:hover',
                '.qodef-woocommerce-page .login .form-row input[type="submit"]:hover',
                '.qodef-woocommerce-page .lost_reset_password .form-row input[type="submit"]:hover',
                '.qodef-woocommerce-page .return-to-shop a:hover',
                '.qodef-blog-holder.qodef-blog-type-masonry article:not(.format-audio) .qodef-post-image',
                '.carousel-inner h3.qodef-slide-subtitle',
                '.woocommerce-edit-account input[type=submit]:hover',
                '.woocommerce-edit-address input[type=submit]:hover',
                '.qodef-portfolio-list-holder-outer.qodef-ptf-standard article .qodef-item-icons-holder a:hover',
                '.qodef-portfolio-list-holder article .qodef-item-icons-holder a',
                '.qodef-portfolio-list-holder-outer.qodef-ptf-standard article .qodef-item-icons-holder a',
                '.qodef-mobile-showcase .qodef-mobile-wrapper .qodef-screens > .qodef-screen:hover .qodef-label',
                '.qodef-pricing-slider .qodef-pricing-slider-button.active .qodef-btn',
                '.qodef-pricing-slider .qodef-pricing-slider-button-extra.active .qodef-btn'
            );

            $border_color_important_selector = array(
                '.qodef-btn:not(.qodef-btn-custom-border-hover):hover'
            );

            $border_color_opacity_selector = array(
                '.qodef-process-holder .qodef-process-item:hover .qodef-process-item-background-holder'
            );

            $border_top_color_selector = array(
                '.qodef-testimonials.filled .qodef-testimonial-text-holder .qodef-testimonial-text-inner:after',
                '.qodef-progress-bar .qodef-progress-number-wrapper.qodef-floating .qodef-down-arrow'
            );

            echo qode_startit_dynamic_css('.qodef-btn.qodef-btn-icon:not(.qodef-btn-custom-hover-bg).qodef-btn-solid .qodef-btn-text-icon', array('background-color' => 'rgba(0,0,0,0.05)'));

            echo qode_startit_dynamic_css($color_selector, array('color' => qode_startit_options()->getOptionValue('first_color')));
            echo qode_startit_dynamic_css($color_important_selector, array('color' => qode_startit_options()->getOptionValue('first_color').'!important'));
            echo qode_startit_dynamic_css('::selection', array('background' => qode_startit_options()->getOptionValue('first_color')));
            echo qode_startit_dynamic_css('::-moz-selection', array('background' => qode_startit_options()->getOptionValue('first_color')));
            echo qode_startit_dynamic_css($background_color_selector, array('background-color' => qode_startit_options()->getOptionValue('first_color')));
            echo qode_startit_dynamic_css($background_color_important_selector, array('background-color' => qode_startit_options()->getOptionValue('first_color').'!important'));
            echo qode_startit_dynamic_css($border_color_selector, array('border-color' => qode_startit_options()->getOptionValue('first_color')));
            echo qode_startit_dynamic_css($border_top_color_selector, array('border-top-color' => qode_startit_options()->getOptionValue('first_color')));
            echo qode_startit_dynamic_css($border_color_important_selector, array('border-color' => qode_startit_options()->getOptionValue('first_color').'!important'));
            $first_color_rgba = qode_startit_hex2rgb(qode_startit_options()->getOptionValue('first_color'));
            echo qode_startit_dynamic_css($border_color_opacity_selector, array(
                    'border-color' => "rgba(". $first_color_rgba[0] . "," . $first_color_rgba[1] . "," . $first_color_rgba[2] . "," . "0.3)"
                )
            );
        }

		if (qode_startit_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
                '.qodef-content .qodef-content-inner > .qodef-container',
                '.qodef-content .qodef-content-inner > .qodef-full-width'
			);
			echo qode_startit_dynamic_css($background_color_selector, array('background-color' => qode_startit_options()->getOptionValue('page_background_color')));
		}

		if (qode_startit_options()->getOptionValue('selection_color')) {
			echo qode_startit_dynamic_css('::selection', array('background' => qode_startit_options()->getOptionValue('selection_color')));
			echo qode_startit_dynamic_css('::-moz-selection', array('background' => qode_startit_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (qode_startit_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = qode_startit_options()->getOptionValue('page_background_color_in_box');
		}

		if (qode_startit_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(qode_startit_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (qode_startit_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(qode_startit_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (qode_startit_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (qode_startit_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo qode_startit_dynamic_css('.qodef-boxed .qodef-wrapper', $boxed_background_style);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_design_styles');
}

if (!function_exists('qode_startit_h1_styles')) {

    function qode_startit_h1_styles() {

        $h1_styles = array();

        if(qode_startit_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = qode_startit_options()->getOptionValue('h1_color');
        }
        if(qode_startit_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('h1_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = qode_startit_options()->getOptionValue('h1_texttransform');
        }
        if(qode_startit_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = qode_startit_options()->getOptionValue('h1_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = qode_startit_options()->getOptionValue('h1_fontweight');
        }
        if(qode_startit_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo qode_startit_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_h1_styles');
}

if (!function_exists('qode_startit_h2_styles')) {

    function qode_startit_h2_styles() {

        $h2_styles = array();

        if(qode_startit_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = qode_startit_options()->getOptionValue('h2_color');
        }
        if(qode_startit_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('h2_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = qode_startit_options()->getOptionValue('h2_texttransform');
        }
        if(qode_startit_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = qode_startit_options()->getOptionValue('h2_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = qode_startit_options()->getOptionValue('h2_fontweight');
        }
        if(qode_startit_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo qode_startit_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_h2_styles');
}

if (!function_exists('qode_startit_h3_styles')) {

    function qode_startit_h3_styles() {

        $h3_styles = array();

        if(qode_startit_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = qode_startit_options()->getOptionValue('h3_color');
        }
        if(qode_startit_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('h3_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = qode_startit_options()->getOptionValue('h3_texttransform');
        }
        if(qode_startit_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = qode_startit_options()->getOptionValue('h3_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = qode_startit_options()->getOptionValue('h3_fontweight');
        }
        if(qode_startit_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo qode_startit_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_h3_styles');
}

if (!function_exists('qode_startit_h4_styles')) {

    function qode_startit_h4_styles() {

        $h4_styles = array();

        if(qode_startit_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = qode_startit_options()->getOptionValue('h4_color');
        }
        if(qode_startit_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('h4_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = qode_startit_options()->getOptionValue('h4_texttransform');
        }
        if(qode_startit_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = qode_startit_options()->getOptionValue('h4_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = qode_startit_options()->getOptionValue('h4_fontweight');
        }
        if(qode_startit_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo qode_startit_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_h4_styles');
}

if (!function_exists('qode_startit_h5_styles')) {

    function qode_startit_h5_styles() {

        $h5_styles = array();

        if(qode_startit_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = qode_startit_options()->getOptionValue('h5_color');
        }
        if(qode_startit_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('h5_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = qode_startit_options()->getOptionValue('h5_texttransform');
        }
        if(qode_startit_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = qode_startit_options()->getOptionValue('h5_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = qode_startit_options()->getOptionValue('h5_fontweight');
        }
        if(qode_startit_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo qode_startit_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_h5_styles');
}

if (!function_exists('qode_startit_h6_styles')) {

    function qode_startit_h6_styles() {

        $h6_styles = array();

        if(qode_startit_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = qode_startit_options()->getOptionValue('h6_color');
        }
        if(qode_startit_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('h6_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = qode_startit_options()->getOptionValue('h6_texttransform');
        }
        if(qode_startit_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = qode_startit_options()->getOptionValue('h6_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = qode_startit_options()->getOptionValue('h6_fontweight');
        }
        if(qode_startit_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo qode_startit_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_h6_styles');
}

if (!function_exists('qode_startit_text_styles')) {

    function qode_startit_text_styles() {

        $text_styles = array();

        if(qode_startit_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = qode_startit_options()->getOptionValue('text_color');
        }
        if(qode_startit_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('text_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('text_fontsize')).'px';
        }
        if(qode_startit_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('text_lineheight')).'px';
        }
        if(qode_startit_options()->getOptionValue('text_text_transform') !== '') {
            $text_styles['text-transform'] = qode_startit_options()->getOptionValue('text_text_transform');
        }
        if(qode_startit_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = qode_startit_options()->getOptionValue('text_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = qode_startit_options()->getOptionValue('text_fontweight');
        }
        if(qode_startit_options()->getOptionValue('text_letter_spacing') !== '') {
            $text_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('text_letter_spacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo qode_startit_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_text_styles');
}

if (!function_exists('qode_startit_link_styles')) {

    function qode_startit_link_styles() {

        $link_styles = array();

        if(qode_startit_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = qode_startit_options()->getOptionValue('link_color');
        }
        if(qode_startit_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = qode_startit_options()->getOptionValue('link_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = qode_startit_options()->getOptionValue('link_fontweight');
        }
        if(qode_startit_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = qode_startit_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo qode_startit_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_link_styles');
}

if (!function_exists('qode_startit_link_hover_styles')) {

    function qode_startit_link_hover_styles() {

        $link_hover_styles = array();

        if(qode_startit_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = qode_startit_options()->getOptionValue('link_hovercolor');
        }
        if(qode_startit_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = qode_startit_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo qode_startit_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(qode_startit_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = qode_startit_options()->getOptionValue('link_hovercolor');
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
            echo qode_startit_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_link_hover_styles');
}
