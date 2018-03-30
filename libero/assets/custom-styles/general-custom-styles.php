<?php
if(!function_exists('libero_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function libero_mikado_design_styles() {

        $preload_background_styles = array();

        if(libero_mikado_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.libero_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo libero_mikado_dynamic_css('.mkd-preload-background', $preload_background_styles);

		if (libero_mikado_options()->getOptionValue('google_fonts')){
			$font_family = libero_mikado_options()->getOptionValue('google_fonts');
			if(libero_mikado_is_font_option_valid($font_family)) {
				echo libero_mikado_dynamic_css('body', array('font-family' => libero_mikado_get_font_option_val($font_family)));
			}
		}

        if(libero_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'h5',
				'h5 a',
				'a',
				'p a',
				'.mkd-search-opener:hover',
				'.mkd-drop-down .second .inner > ul > li:hover > a',
				'.mkd-drop-down .second .inner ul li.sub ul li:hover > a',
				'.mkd-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
				'.mkd-drop-down .wide .second ul li .flexslider ul li a:hover',
				'.mkd-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
				'.mkd-mobile-header .mkd-mobile-nav a:hover, .mkd-mobile-header .mkd-mobile-nav h4:hover',
				'header .mkd-logo-area .mkd-vertical-align-containers .widget_nav_menu ul li a:hover',
				'.mkd-main-menu > ul > li > a:after',
				'.mkd-mobile-header .mkd-mobile-menu-opener:hover .mkd-side-area-icon-text',
				'.mkd-title .mkd-title-holder .mkd-breadcrumbs span.mkd-current',
				'.mkd-search-slide-header-bottom .mkd-search-submit:hover',
				'#mkd-back-to-top > span',
				'.mkd-ordered-list ol li a:hover',
				'.mkd-ordered-list ol > li:before',
				'.mkd-unordered-list ul > li a:hover',
				'.mkd-unordered-list.mkd-line ul > li:before',
				'.mkd-unordered-list.mkd-arrow ul > li:before',
				'.mkd-price-table .mkd-price-table-inner ul li.mkd-table-prices .mkd-price',
				'.mkd-btn.mkd-btn-outline',
				'.mkd-team .mkd-team-social .mkd-icon-linked:hover a .mkd-icon-element',
				'.mkd-comment-holder .mkd-comment-number-icon',
				'.comment-respond .comment-reply-title:before',
				'.mkd-accordion-holder .mkd-title-holder.ui-state-active .mkd-accordion-mark',
				'.mkd-accordion-holder .mkd-title-holder.ui-state-hover .mkd-accordion-mark',
				'.mkd-accordion-holder .mkd-title-holder.ui-state-active',
				'.mkd-accordion-holder .mkd-title-holder.ui-state-hover',
				'.mkd-icon-list-item .mkd-icon-list-icon-holder-inner i',
				'.mkd-icon-list-item .mkd-icon-list-icon-holder-inner .font_elegant',
				'.mkd-image-slider:not(.with-thumbs) .mkd-slider-navigation a:hover',
				'.mkd-owl-slider .owl-buttons .mkd-next-icon i',
				'.mkd-owl-slider .owl-buttons .mkd-prev-icon i',
				'.mkd-portfolio-slider-holder .mkd-portfolio-list-holder.owl-carousel .owl-buttons .mkd-prev-icon i',
				'.mkd-portfolio-slider-holder .mkd-portfolio-list-holder.owl-carousel .owl-buttons .mkd-next-icon i',
				'.mkd-pagination li span.current',
				'.mkd-pagination li a:hover',
				'.mkd-pagination li span:hover',
				'.mkd-pagination li span.current:hover',
				'.mkd-pagination li.active span',
				'.mkd-sidebar .widget_rss ul li:hover > a',
				'.mkd-sidebar .widget_text ul li:hover > a',
				'.mkd-sidebar .widget_pages ul li:hover > a',
				'.mkd-sidebar .widget_meta ul li:hover > a',
				'.mkd-sidebar .widget_archive ul li:hover > a',
				'.mkd-sidebar .widget_recent_entries ul li:hover > a',
				'.mkd-sidebar .widget_recent_comments ul li:hover > a',
				'.mkd-sidebar .widget_product_categories ul li:hover > a',
				'.mkd-sidebar .widget_categories ul li:hover > a',
				'.mkd-side-menu .widget_calendar a',
				'.mkd-side-menu .widget_rss ul li:hover > a',
				'.mkd-side-menu .widget_text ul li:hover > a',
				'.mkd-side-menu .widget_pages ul li:hover > a',
				'.mkd-side-menu .widget_meta ul li:hover > a',
				'.mkd-side-menu .widget_archive ul li:hover > a',
				'.mkd-side-menu .widget_recent_entries ul li:hover > a',
				'.mkd-side-menu .widget_recent_comments ul li:hover > a',
				'.mkd-side-menu .widget_product_categories ul li:hover > a',
				'.mkd-side-menu .widget_categories ul li:hover > a',
				'.mkd-side-menu .widget_nav_menu li a:hover',
				'.wpb_widgetised_column .widget_rss ul li:hover > a',
				'.wpb_widgetised_column .widget_text ul li:hover > a',
				'.wpb_widgetised_column .widget_pages ul li:hover > a',
				'.wpb_widgetised_column .widget_meta ul li:hover > a',
				'.wpb_widgetised_column .widget_archive ul li:hover > a',
				'.wpb_widgetised_column .widget_nav_menu ul li:hover > a',
				'.wpb_widgetised_column .widget_recent_entries ul li:hover > a',
				'.wpb_widgetised_column .widget_recent_comments ul li:hover > a',
				'.wpb_widgetised_column .widget_product_categories ul li:hover > a',
				'.wpb_widgetised_column .widget_categories ul li:hover > a',
				'body .mkd-search-cover .mkd-search-close a:hover',
				'.mkd-call-to-action.with-icon .mkd-text-wrapper .mkd-call-to-action-icon .mkd-call-to-action-icon-inner i',
				'.mkd-call-to-action.with-icon .mkd-text-wrapper .mkd-call-to-action-icon .mkd-call-to-action-icon-inner span',
				'.mkd-counter-holder .mkd-counter',
				'.mkd-counter-holder .mkd-counter-currency',
				'.mkd-testimonials .mkd-testimonial-author',
				'.mkd-tabs .mkd-tabs-nav li.ui-state-active a span.mkd-icon-frame',
				'.mkd-tabs .mkd-tabs-nav li.ui-state-hover a span.mkd-icon-frame',
				'.mkd-tabs .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs .mkd-tabs-nav li.ui-state-hover a',
				'.mkd-blog-share:hover .mkd-social-share-holder .mkd-social-share-title',
				'.mkd-blog-share:hover .mkd-social-share-holder i.icon-share',
				'.mkd-blog-holder article .mkd-post-info-column-inner .mkd-post-info-comments-holder:hover',
				'.mkd-blog-holder article .mkd-post-info-column-inner .mkd-post-info-comments-holder:hover span',
				'.mkd-blog-list-holder .mkd-item-info-section .mkd-post-info-icon',
				'.mkd-blog-list-holder.mkd-image-in-box .mkd-item-info-section > div a:hover',
				'.mkd-blog-list-holder.mkd-image-in-box .mkd-item-info-section > div a:hover span',
				'.mkd-blog-list-holder.mkd-minimal .mkd-blog-list-item-inner .mkd-item-text-holder:hover .mkd-item-title a',
				'.mkd-blog-list-holder.mkd-minimal .mkd-blog-list-item-inner .mkd-post-info-icon',
				'.mkd-dropcaps',
				'.mkd-portfolio-list-holder article .mkd-item-text-holder .mkd-ptf-category-holder span',
				'.mkd-portfolio-single-holder .mkd-portfolio-single-nav a:hover span',
				'.mkd-portfolio-single-holder .mkd-portfolio-single-nav a:hover .mkd-portfolio-back-btn span',
				'.mkd-social-share-holder.mkd-dropdown .mkd-social-share-dropdown ul li:hover a',
				'.mkd-social-share-holder.mkd-dropdown .mkd-social-share-dropdown ul li:hover .mkd-social-network-text',
				'.mkd-blog-holder article .mkd-post-info-column-inner .mkd-post-info-date-day',
				'.mkd-blog-holder article .mkd-post-info .mkd-post-info-icon',
				'.mkd-blog-holder article .mkd-post-info .mkd-blog-like i',
				'.mkd-single-tags-holder .mkd-single-tags-icon',
				'.mkd-single-links-pages .mkd-single-links-pages-inner > a:hover',
				'.mkd-comment-pager a:hover',
				'.widget #lang_sel *:hover > a',
				'.widget #lang_sel a:hover',
				'.widget #lang_sel ul ul *:hover > a',
				'.mkd-iwt .mkd-iwt-title-holder a',
				'footer .widget li a:hover',
				'footer .widget.widget_rss ul li:hover > a',
				'footer .widget.widget_text ul li:hover > a',
				'footer .widget.widget_pages ul li:hover > a',
				'footer .widget.widget_meta ul li:hover > a',
				'footer .widget.widget_archive ul li:hover > a',
				'footer .widget.widget_nav_menu ul li:hover > a',
				'footer .widget.widget_recent_entries ul li:hover > a',
				'footer .widget.widget_recent_comments ul li:hover > a',
				'footer .widget.widget_product_categories ul li:hover > a',
				'footer .widget.widget_categories ul li:hover > a',
				'footer .widget.widget_calendar a',
				'footer .mkd-footer-bottom-holder .widget a',
				'footer .mkd-footer-bottom-holder .widget.widget_nav_menu li a:hover',
				'footer .mkd-footer-bottom-holder .widget.widget_nav_menu li a:after'
            );

			$color_important_selector = array(
				'.mkd-btn.mkd-btn-white:not(.mkd-btn-custom-hover-color):hover'
			);

            $background_color_selector = array(
				'.mkd-progress-bar .mkd-progress-content-outer .mkd-progress-content',
				'.mkd-btn.mkd-btn-solid',
				'.mkd-unordered-list ul > li:before',
				'.mkd-dropcaps.mkd-square',
				'.mkd-dropcaps.mkd-circle',
				'.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li.active span',
				'.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li.current span',
				'.mkd-portfolio-list-holder-outer.mkd-ptf-standard article .mkd-item-image-holder:before',
				'.mkd-portfolio-list-holder-outer.mkd-ptf-standard article .mkd-item-image-holder:after',
				'.mkd-blog-holder article .mkd-post-sticky',
				'.mkd-single-tags-holder .mkd-tags a:hover',
				'.mkd-carousel-holder .mkd-carousel.owl-carousel .owl-pagination .owl-page.active span',
				'.mkd-icon-shortcode.circle .mkd-background',
				'.mkd-icon-shortcode.square .mkd-background',
				'footer .widget #submit_comment',
				'footer .widget .comment-respond input[type="submit"]',
				'footer .widget input.wpcf7-form-control.wpcf7-submit',
				'footer .widget .post-password-form input[type="submit"]',
				'footer .widget.widget_tag_cloud a:hover',
				'.widget_search input[type="submit"].mkd-btn.mkd-search-submit',
				'.mkd-side-menu .widget_tag_cloud a:hover',
				'.mkd-sidebar .widget_tag_cloud a:hover',
				'.wpb_widgetised_column .widget_tag_cloud a:hover',
				'.mkd-blog-list-holder.mkd-minimal .mkd-blog-list-item-inner .mkd-item-date-holder .mkd-post-info-date-month',
				'.mkd-main-menu > ul > li.mkd-active-item > a > span.bottom-border span.bottom-border-inner',
				'.mkd-team.linked .mkd-team-read-more',
				'.mkd-interactive-icon .mkd-interactive-icon-hover-content .mkd-interactive-icon-separator',
				'.mkd-interactive-banner.linked .mkd-interactive-banner-read-more',
				'.mkd-testimonials.owl-carousel .owl-pagination .owl-page.active span',
				'.mkd-mobile-header .mkd-mobile-menu-opener:hover .mkd-lines',
				'body.mkd-right-side-menu-opened .mkd-side-menu-button-opener .mkd-lines',
				'.mkd-side-menu-button-opener:hover .mkd-lines',
				'body .mkd-search-cover .mkd-search-submit',
				'.mkd-service-table .mkd-service-link:after',
				'.mkd-video-box .mkd-video-image .mkd-video-box-button-holder .mkd-video-box-button',
				'.mkd-fullwidth-slider-holder .owl-pagination .owl-page.active span'
            );

            $background_color_important_selector = array(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-bg):hover'
            );

            $border_color_selector = array(
				'#respond textarea:focus',
				'#respond input[type="text"]:focus',
				'.post-password-form input[type="password"]:focus',
				'footer .widget.widget_tag_cloud a:hover',
				'.mkd-portfolio-slider-holder .mkd-portfolio-list-holder.owl-carousel .owl-buttons .mkd-prev-icon',
				'.mkd-portfolio-slider-holder .mkd-portfolio-list-holder.owl-carousel .owl-buttons .mkd-next-icon',
				'footer .mkd-footer-top-holder',
				'.mkd-image-slider .flex-control-nav.flex-control-thumbs li:before',
				'.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li.active span',
				'.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li.current span',
				'.mkd-single-tags-holder .mkd-tags a:hover',
				'.mkd-service-table .mkd-service-link',
				'blockquote',
				'.mkd-sidebar .widget.mkd-holder-widget .mkd-holder-titles',
				'.wpb_widgetised_column .widget.mkd-holder-widget .mkd-holder-titles',
				'.mkd-sidebar .mkd-service-table.mkd-service-has-icon .mkd-service-titles-holder',
				'.wpb_widgetised_column .mkd-service-table .mkd-service-has-icon .mkd-service-titles-holder',
				'.mkd-sidebar .widget_tag_cloud a:hover',
				'.mkd-side-menu .widget_tag_cloud a:hover',
				'.mkd-team.linked .mkd-team-triangle',
				'.mkd-interactive-banner.linked .mkd-interactive-banner-triangle',
				'.wpb_widgetised_column .widget_tag_cloud a:hover'
            );

            $border_color_important_selector = array(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-border-hover):hover'
            );
	
			$first_color = libero_mikado_options()->getOptionValue('first_color');
			$darker_first_color = libero_mikado_darken_border_color($first_color, -27);
			$lighter_first_color = libero_mikado_darken_border_color($first_color, 9);

			$border_darker_color_selector = array(
				'.mkd-btn.mkd-btn-outline',
				'.mkd-btn.mkd-btn-outline.mkd-btn-icon .mkd-btn-text',
				'.widget_search input[type="submit"].mkd-btn.mkd-search-submit',
				'footer .widget #submit_comment',
				'footer .widget .comment-respond input[type="submit"]',
				'footer .widget input.wpcf7-form-control.wpcf7-submit',
				'footer .widget .post-password-form input[type="submit"]'
			);

			$border_darker_color_selector_important = array(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-border-hover):hover'
			);

			$background_darker_color_selector = array(
				'.mkd-video-box .mkd-video-image:hover .mkd-video-box-button-holder .mkd-video-box-button'
			);


			$background_lighter_color_selector = array(
				'.widget_search input[type="submit"].mkd-btn.mkd-search-submit:hover',
				'footer .widget #submit_comment:hover',
				'footer .widget .comment-respond input[type="submit"]:hover',
				'footer .widget input.wpcf7-form-control.wpcf7-submit:hover',
				'footer .widget .post-password-form input[type="submit"]:hover',
			);

			if(libero_mikado_is_woocommerce_installed()){
				$color_selector = array_merge($color_selector,array(
					'.woocommerce-pagination .page-numbers li span.current',
					'.woocommerce-pagination .page-numbers li a:hover',
					'.woocommerce-pagination .page-numbers li span:hover',
					'.woocommerce-pagination .page-numbers li span.current:hover',
					'.mkd-woocommerce-page .star-rating',
					'.mkd-woocommerce-page .woocommerce-checkout-review-order .order-total',
					'.mkd-woocommerce-page input[type="submit"]:hover',
					'.mkd-woocommerce-page .comment-respond input[type="submit"]:hover',
					'.mkd-shopping-cart-dropdown ul li a:hover',
					'.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-left:hover',
					'.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-right .remove:hover',
					'.mkd-shopping-cart-dropdown span.mkd-total span',
					'.mkd-shopping-cart-dropdown span.amount',
					'.mkd-shopping-cart-dropdown span.mkd-quantity',
					'.select2-results .select2-highlighted',
					'.mkd-woocommerce-page .select2-container .select2-choice .select2-arrow b:after',
					'.woocommerce.widget_products .mkd-product-list-content a:hover',
					'.mkd-shopping-cart-outer:hover .mkd-shopping-cart-header .mkd-header-cart i'
				));

				$background_color_selector = array_merge($background_color_selector,array(
					'.mkd-shopping-cart-outer .mkd-shopping-cart-header .mkd-cart-no',
					'.woocommerce.widget_price_filter .price_slider .ui-slider-range'
				));

				$border_color_selector = array_merge($border_color_selector,array(
					'.woocommerce.widget_price_filter .price_slider .ui-slider-range'
				));

				$border_darker_color_selector = array_merge($border_darker_color_selector, array(
					'.mkd-woocommerce-page input[type="text"]:focus',
					'.mkd-woocommerce-page input[type="email"]:focus',
					'.mkd-woocommerce-page input[type="tel"]:focus',
					'.mkd-woocommerce-page input[type="password"]:focus',
					'.mkd-woocommerce-page .coupon input[type="text"]:focus',
					'.mkd-woocommerce-page textarea:focus',
				));
			}

            echo libero_mikado_dynamic_css($color_selector, array('color' => libero_mikado_options()->getOptionValue('first_color')));
            echo libero_mikado_dynamic_css($color_important_selector, array('color' => libero_mikado_options()->getOptionValue('first_color').'!important'));
            echo libero_mikado_dynamic_css('::selection', array('background' => libero_mikado_options()->getOptionValue('first_color')));
            echo libero_mikado_dynamic_css('::-moz-selection', array('background' => libero_mikado_options()->getOptionValue('first_color')));
            echo libero_mikado_dynamic_css($background_color_selector, array('background-color' => libero_mikado_options()->getOptionValue('first_color')));
            echo libero_mikado_dynamic_css($background_color_important_selector, array('background-color' => libero_mikado_options()->getOptionValue('first_color').'!important'));
            echo libero_mikado_dynamic_css($border_color_selector, array('border-color' => libero_mikado_options()->getOptionValue('first_color')));
            echo libero_mikado_dynamic_css($border_color_important_selector, array('border-color' => libero_mikado_options()->getOptionValue('first_color').'!important'));
            echo libero_mikado_dynamic_css($background_darker_color_selector, array('background-color' => $darker_first_color));
            echo libero_mikado_dynamic_css($border_darker_color_selector, array('border-color' => $darker_first_color));
            echo libero_mikado_dynamic_css($border_darker_color_selector_important, array('border-color' => $darker_first_color.' !important'));
            echo libero_mikado_dynamic_css($background_lighter_color_selector, array('background-color' => $lighter_first_color));
        }

		if(libero_mikado_options()->getOptionValue('second_color') !== "") {
			$sec_color_selector = array(
				'.wpcf7-form input.wpcf7-form-control.wpcf7-submit.mkd-cf7-newsltr-sbmt:hover'
			);

			$sec_background_color_selector = array(
				'.mkd-header-standard .mkd-menu-area',
				'.mkd-mobile-header .mkd-mobile-header-inner',
				'.mkd-page-header .mkd-sticky-header .mkd-sticky-holder',
				'body .mkd-search-cover',
				'.wpcf7-form input.wpcf7-form-control.wpcf7-submit.mkd-cf7-newsltr-sbmt',
				'.mkd-price-table.mkd-active .mkd-active-text',
				'.mkd-blog-holder article .mkd-blog-read-more',
				'.mkd-blog-holder article .mkd-more-link-container .mkd-btn',
				'.mkd-portfolio-list-holder-outer .mkd-ptf-list-paging .mkd-ptf-list-load-more .mkd-btn.mkd-btn-solid',
				'#submit_comment',
				'.comment-respond input[type="submit"]',
				'.post-password-form input[type="submit"]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkd-service-table .mkd-service-titles-holder',
				'.mkd-service-table .mkd-service-link',
				'.mkd-video-box .mkd-video-box-text',
				'.mkd-sidebar .widget.mkd-holder-widget .mkd-holder-titles',
				'.wpb_widgetised_column .widget.mkd-holder-widget .mkd-holder-titles',
				'.mkd-sidebar .widget.mkd-holder-widget .mkd-holder-link',
				'.wpb_widgetised_column .widget.mkd-holder-widget .mkd-holder-link',
				'.mkd-team .mkd-team-info',
				'.mkd-interactive-banner .mkd-interactive-banner-info',
				'.mkd-price-table.mkd-active .mkd-active-text',
				'.mkd-blog-list-holder.mkd-minimal .mkd-blog-list-item-inner .mkd-item-date-holder .mkd-post-info-date-day',
				'.mkd-page-not-found .mkd-404-btn.mkd-btn.mkd-btn-solid',
			);

			$sec_border_color_selector = array(
				'.wpcf7-form input.wpcf7-form-control.wpcf7-submit.mkd-cf7-newsltr-sbmt',
			);

			$sec_border_color_important_selector = array();

			$second_color = libero_mikado_options()->getOptionValue('second_color');
			$darker_second_color = libero_mikado_darken_border_color($second_color, -5);
			$lighter_second_color = libero_mikado_darken_border_color($second_color, 30);

			$border_darker_second_color_selector = array(
				'#submit_comment',
				'.comment-respond input[type="submit"]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.post-password-form input[type="submit"]',
			);

			$background_lighter_second_color_selector = array(
				'#submit_comment:hover',
				'.comment-respond input[type=submit]:hover',
				'.post-password-form input[type=submit]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover'
			);
			$sec_border_top_selector = array(
				'.mkd-price-table.mkd-active .mkd-active-text:after'
			);

			if(libero_mikado_is_woocommerce_installed()){
				$sec_color_selector = array_merge($sec_color_selector,array(
					'.mkd-single-product-summary .stock.out-of-stock',
				));

				$sec_background_color_selector = array_merge($sec_background_color_selector,array(
					'.mkd-woocommerce-page .product .mkd-onsale',
					'.woocommerce .product .mkd-onsale',
					'.mkd-woocommerce-page .product .mkd-out-of-stock',
					'.woocommerce .product .mkd-out-of-stock',
					'.mkd-woocommerce-page .mkd-product-content .mkd-btn.add_to_cart_button',
					'.woocommerce .mkd-product-content .mkd-btn.add_to_cart_button',
					'.mkd-woocommerce-page .mkd-product-content .mkd-btn.mkd-read-more',
					'.woocommerce .mkd-product-content .mkd-btn.mkd-read-more',
					'.mkd-woocommerce-page .mkd-btn-solid.single_add_to_cart_button',
					'.mkd-woocommerce-page td.actions .mkd-btn.checkout-button',
					'.mkd-woocommerce-page .mkd-shipping-calculator .mkd-btn.mkd-update-totals',
					'.mkd-shopping-cart-dropdown .mkd-cart-bottom .view-cart',
					'.woocommerce.widget_price_filter .price_slider_amount button'
				));

				$sec_border_top_selector = array_merge($sec_border_top_selector,array(
					'.mkd-woocommerce-page .product .mkd-onsale:after',
					'.woocommerce .product .mkd-onsale:after',
					'.mkd-woocommerce-page .product .mkd-out-of-stock:after',
					'.woocommerce .product .mkd-out-of-stock:after'
				));

				$border_darker_second_color_selector = array_merge($border_darker_second_color_selector,array(
					'.woocommerce.widget_price_filter .price_slider_amount button'
				));

				$background_lighter_second_color_selector = array_merge($background_lighter_second_color_selector,array(
					'.woocommerce.widget_price_filter .price_slider_amount button:hover'
				));
			}

			echo libero_mikado_dynamic_css($sec_color_selector, array('color' => libero_mikado_options()->getOptionValue('second_color')));
			echo libero_mikado_dynamic_css($sec_background_color_selector, array('background-color' => libero_mikado_options()->getOptionValue('second_color')));
			echo libero_mikado_dynamic_css($sec_border_color_selector, array('border-color' => libero_mikado_options()->getOptionValue('second_color')));
			echo libero_mikado_dynamic_css($sec_border_color_important_selector, array('border-color' => libero_mikado_options()->getOptionValue('second_color').'!important'));
			echo libero_mikado_dynamic_css($sec_border_top_selector, array('border-top-color' => libero_mikado_options()->getOptionValue('second_color')));
			echo libero_mikado_dynamic_css($border_darker_second_color_selector, array('border-color' => $darker_second_color));
			echo libero_mikado_dynamic_css($background_lighter_second_color_selector, array('background-color' => $lighter_second_color));
			echo libero_mikado_dynamic_css('.mkd-image-slider .mkd-caption-holder', array('background-color' => libero_mikado_rgba_color($second_color, '0.85')));
			echo libero_mikado_dynamic_css('.mkd-image-slider .flex-control-nav.flex-control-thumbs li .mkd-image-slider-thumb-hover', array('background-color' => libero_mikado_rgba_color($second_color, '0.2')));
			echo libero_mikado_dynamic_css('.mkd-portfolio-list-holder-outer.mkd-ptf-gallery article .mkd-item-text-overlay-inner', array('background-color' => libero_mikado_rgba_color($second_color, '0.95')));
		}

		if (libero_mikado_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.mkd-wrapper-inner',
				'.mkd-content'
			);
			echo libero_mikado_dynamic_css($background_color_selector, array('background-color' => libero_mikado_options()->getOptionValue('page_background_color')));
		}

		if (libero_mikado_options()->getOptionValue('selection_color')) {
			echo libero_mikado_dynamic_css('::selection', array('background' => libero_mikado_options()->getOptionValue('selection_color')));
			echo libero_mikado_dynamic_css('::-moz-selection', array('background' => libero_mikado_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (libero_mikado_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = libero_mikado_options()->getOptionValue('page_background_color_in_box');
		}

		if (libero_mikado_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(libero_mikado_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (libero_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(libero_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (libero_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (libero_mikado_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo libero_mikado_dynamic_css('.mkd-boxed .mkd-wrapper', $boxed_background_style);
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_design_styles');
}


if (!function_exists('libero_mikado_h1_styles')) {

    function libero_mikado_h1_styles() {

        $h1_styles = array();

        if(libero_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = libero_mikado_options()->getOptionValue('h1_color');
        }
        if(libero_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = libero_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = libero_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = libero_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo libero_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_h1_styles');
}

if (!function_exists('libero_mikado_h2_styles')) {

    function libero_mikado_h2_styles() {

        $h2_styles = array();

        if(libero_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = libero_mikado_options()->getOptionValue('h2_color');
        }
        if(libero_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = libero_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = libero_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = libero_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo libero_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_h2_styles');
}

if (!function_exists('libero_mikado_h3_styles')) {

    function libero_mikado_h3_styles() {

        $h3_styles = array();

        if(libero_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = libero_mikado_options()->getOptionValue('h3_color');
        }
        if(libero_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = libero_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = libero_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = libero_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo libero_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_h3_styles');
}

if (!function_exists('libero_mikado_h4_styles')) {

    function libero_mikado_h4_styles() {

        $h4_styles = array();

        if(libero_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = libero_mikado_options()->getOptionValue('h4_color');
        }
        if(libero_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = libero_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = libero_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = libero_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4',
            '.comment-respond .comment-reply-title',
            '.mkd-comment-holder h4',
            '.mkd-single-tags-holder .mkd-single-tags-title',
            'footer .widget .mkd-footer-widget-title',
            'footer .widget .mkd-sidearea-widget-title',
            '.mkd-single-tags-holder .mkd-single-tags-title',
            '.mkd-portfolio-single-holder h4',
            '.mkd-sidebar h4',
            '.wpb_widgetised_column h4',
            '.mkd-woocommerce-page .related.products h4'
        );

        if (!empty($h4_styles)) {
            echo libero_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_h4_styles');
}

if (!function_exists('libero_mikado_h5_styles')) {

    function libero_mikado_h5_styles() {

        $h5_styles = array();

        if(libero_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = libero_mikado_options()->getOptionValue('h5_color');
        }
        if(libero_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = libero_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = libero_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = libero_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo libero_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_h5_styles');
}

if (!function_exists('libero_mikado_h6_styles')) {

    function libero_mikado_h6_styles() {

        $h6_styles = array();

        if(libero_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = libero_mikado_options()->getOptionValue('h6_color');
        }
        if(libero_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = libero_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = libero_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = libero_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo libero_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_h6_styles');
}

if (!function_exists('libero_mikado_text_styles')) {

    function libero_mikado_text_styles() {

        $text_styles = array();

        if(libero_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = libero_mikado_options()->getOptionValue('text_color');
        }
        if(libero_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(libero_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(libero_mikado_options()->getOptionValue('text_text_transform') !== '') {
            $text_styles['text-transform'] = libero_mikado_options()->getOptionValue('text_text_transform');
        }
        if(libero_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = libero_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = libero_mikado_options()->getOptionValue('text_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('text_letter_spacing') !== '') {
            $text_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('text_letter_spacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo libero_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_text_styles');
}

if (!function_exists('libero_mikado_link_styles')) {

    function libero_mikado_link_styles() {

        $link_styles = array();

        if(libero_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = libero_mikado_options()->getOptionValue('link_color');
        }
        if(libero_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = libero_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = libero_mikado_options()->getOptionValue('link_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = libero_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo libero_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_link_styles');
}

if (!function_exists('libero_mikado_link_hover_styles')) {

    function libero_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(libero_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = libero_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(libero_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = libero_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo libero_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(libero_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = libero_mikado_options()->getOptionValue('link_hovercolor');
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
            echo libero_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_link_hover_styles');
}

if (!function_exists('libero_mikado_sidebar_styles')) {

	function libero_mikado_sidebar_styles() {
		$sidebar_styles = array();

		$background_color = libero_mikado_options()->getOptionValue('sidebar_background_color');
		if ($background_color !== ''){
			$sidebar_styles['background-color'] = $background_color;
		}

		$padding_top = libero_mikado_options()->getOptionValue('sidebar_padding_top');
		if ($padding_top !== ''){
			$sidebar_styles['padding-top'] = libero_mikado_filter_px($padding_top).'px';
		}

		$padding_right = libero_mikado_options()->getOptionValue('sidebar_padding_right');
		if ($padding_right !== ''){
			$sidebar_styles['padding-right'] = libero_mikado_filter_px($padding_right).'px';
		}

		$padding_bottom = libero_mikado_options()->getOptionValue('sidebar_padding_bottom');
		if ($padding_bottom !== ''){
			$sidebar_styles['padding-bottom'] = libero_mikado_filter_px($padding_bottom).'px';
		}

		$padding_left = libero_mikado_options()->getOptionValue('sidebar_padding_left');
		if ($padding_left !== ''){
			$sidebar_styles['padding-left'] = libero_mikado_filter_px($padding_left).'px';
		}

		$sidebar_alignment = libero_mikado_options()->getOptionValue('sidebar_alignment');
		if ($sidebar_alignment !== ''){
			$sidebar_styles['text-align'] = $sidebar_alignment;
		}

		if(is_array($sidebar_styles) && count($sidebar_styles)){
			echo libero_mikado_dynamic_css('.mkd-sidebar',$sidebar_styles);
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_sidebar_styles');
}