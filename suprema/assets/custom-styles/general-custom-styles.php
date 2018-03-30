<?php
if(!function_exists('suprema_qodef_design_styles')) {
    /**
     * Generates general custom styles
     */
    function suprema_qodef_design_styles() {

        $preload_background_styles = array();

        if(suprema_qodef_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.suprema_qodef_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(QODE_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo suprema_qodef_dynamic_css('.qodef-preload-background', $preload_background_styles);

		if (suprema_qodef_options()->getOptionValue('google_fonts')){
			$font_family = suprema_qodef_options()->getOptionValue('google_fonts');
			if(suprema_qodef_is_font_option_valid($font_family)) {
				echo suprema_qodef_dynamic_css('body', array('font-family' => suprema_qodef_get_font_option_val($font_family)));
			}
		}

        if(suprema_qodef_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a:hover',
                'p a:hover',
                'body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu > ul > li:hover > a, .qodef-main-menu > ul > li.qodef-active-item > a',
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
                '.qodef-ordered-list ol > li:before',
                '.qodef-icon-list-item .qodef-icon-list-icon-holder .qodef-icon-list-icon-holder-inner i',
                '.qodef-icon-list-item .qodef-icon-list-icon-holder .qodef-icon-list-icon-holder-inner .font_elegant',
                '.qodef-price-table .qodef-price-table-inner ul li.qodef-table-prices .qodef-value',
                '.qodef-price-table .qodef-price-table-inner ul li.qodef-table-prices .qodef-price',
                '.qodef-price-table .qodef-price-table-inner ul li.qodef-table-prices .qodef-mark',
                '.qodef-btn.qodef-btn-outline',
                '.post-password-form input[type="submit"]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
				'.qodef-icon-list-item .qodef-icon-list-icon-holder-inner i',
				'.qodef-icon-list-item .qodef-icon-list-icon-holder-inner .font_elegant',
				'.qodef-ordered-list ol>li:before',
				'.qodef-portfolio-filter-holder .qodef-portfolio-filter-holder-inner ul li.active span',
				'.qodef-portfolio-filter-holder .qodef-portfolio-filter-holder-inner ul li.current span',
				'.qodef-portfolio-list-holder article .qodef-item-icons-holder a',
				'.qodef-portfolio-list-holder.qodef-ptf-standard article .qodef-item-icons-holder a:hover',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-prev-icon i',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-next-icon i',
                '.qodef-team .qodef-team-social-holder .qodef-icon-shortcode.square a',
                '.qodef-team .qodef-team-social-holder .qodef-icon-shortcode.square span',
                '.qodef-team .qodef-team-social-holder .qodef-icon-shortcode.square i',
                '.qodef-iwt .qodef-iwt-link',
                '.qodef-title.qodef-breadcrumb-type .qodef-title-holder .qodef-breadcrumbs .qodef-current',
                '.qodef-title.qodef-breadcrumb-type .qodef-title-holder .qodef-breadcrumbs a:hover',
                '.qodef-portfolio-single-holder .qodef-portfolio-social .qodef-social-share-holder ul li a:hover',
                '.qodef-portfolio-single-holder .qodef-portfolio-single-nav span:hover',
                '.qodef-social-share-holder:not(.square) ul li a:hover',
                '.qodef-accordion-holder .qodef-title-holder.ui-state-active .qodef-accordion-mark',
                '.qodef-accordion-holder .qodef-title-holder.ui-state-hover .qodef-accordion-mark',
                '.qodef-pie-chart-with-icon-holder .qodef-percentage-with-icon i',
                '.qodef-pie-chart-with-icon-holder .qodef-percentage-with-icon span',
                '.qodef-blog-list-holder .qodef-item-info-section',
                '.qodef-btn.qodef-btn-underlined',
				'.qodef-page-header .qodef-login-widget-holder > ul > li:hover > a',
                '.qodef-sidebar #lang_sel ul ul a:hover, .wpb_widgetised_column #lang_sel ul ul a:hover',
                '.qodef-shopping-cart-outer .qodef-shopping-cart-header .qodef-header-cart:hover span',
                '.qodef-shopping-cart-outer .qodef-shopping-cart-header .qodef-header-cart:hover i',
                '.qodef-side-menu #lang_sel ul ul a:hover span',
                '.widget.qodef-latest-posts-widget .qodef-blog-list-holder.qodef-image-in-box .qodef-item-title a:hover',
                'aside.qodef-sidebar .widget ul > li a:hover',
                '.qodef-blog-holder article .qodef-post-info',
                '.qodef-blog-holder article .qodef-post-info > div a',
                '.qodef-comment-holder .qodef-comment-text .qodef-comment-date',
                '.qodef-blog-holder.qodef-blog-single article .qodef-post-info-bottom .qodef-blog-share .qodef-social-share-holder.qodef-list li a:hover span',
                '.woocommerce .products.boxed .qodef-product-list-categories a:hover',
                '.qodef-woocommerce-page .products.boxed .qodef-product-list-categories a:hover',
                '.woocommerce-pagination .page-numbers li span.current',
                '.woocommerce-pagination .page-numbers li a:hover',
                '.woocommerce-pagination .page-numbers li span:hover',
                '.woocommerce-pagination .page-numbers li span.current:hover',
                '.widget.woocommerce.widget_recently_viewed_products .qodef-product-list-widget-info-wrapper a:hover',
                '.widget.woocommerce.widget_top_rated_products .qodef-product-list-widget-info-wrapper a:hover',
                '.widget.woocommerce.widget_products .qodef-product-list-widget-info-wrapper a:hover',
                'aside.qodef-sidebar .widget .tagcloud a:hover',
                '.star-rating span:before',
                '.qodef-single-product-summary .product_meta > span > a:hover',
                '.qodef-single-product-info-bottom .qodef-social-share-holder ul li:hover a .qodef-social-network-icon',
                '.qodef-single-product-info-bottom .qodef-social-share-holder ul li:hover a:after',
                '.woocommerce .products.standard .product .qodef-product-list-categories a:hover',
                '.qodef-woocommerce-page .products.standard .product .qodef-product-list-categories a:hover',
                '.qodef-twitter-widget li .qodef-social-twitter',
                '.qodef-twitter-widget li .qodef-tweet-content-holder .qodef-tweet-text a:hover',
                '.qodef-twitter-widget li .qodef-tweet-content-holder .qodef-tweet-time a:hover',
                '.qodef-footer-inner #lang_sel ul ul a:hover',
                '.qodef-shopping-cart-dropdown .qodef-item-info-holder .qodef-item-left a:hover',
                '.qodef-shopping-cart-dropdown .qodef-item-info-holder .qodef-item-right .remove:hover',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-subtotal-holder .qodef-total-amount',
                '.qodef-woocommerce-page .qodef-cart-totals .cart_totals #shipping_method .shipping_method:after',
                '.woocommerce .qodef-cart-totals .cart_totals #shipping_method .shipping_method:after',
                '.qodef-woocommerce-page.woocommerce-account .myaccount_user a',
                '.qodef-woocommerce-page.woocommerce-account .address .title a',
                '.qodef-woocommerce-page .shop_table.cart tbody tr td.product-stock-status span.wishlist-in-stock',
                '.woocommerce .shop_table.cart tbody tr td.product-stock-status span.wishlist-in-stock',
                '.yith-wcwl-wishlistexistsbrowse a',
                '.yith-wcwl-wishlistaddedbrowse a',
                '.qodef-woocommerce-page #reviews .comment-form-rating .stars span a:after',
                '.qodef-woocommerce-page.woocommerce-account #customer_login .col-1 label[for="rememberme"] input:after',
				'.qodef-featured-products .qodef-product .qodef-product-featured-info h6:hover',
				'.qodef-featured-products .qodef-product .qodef-product-list-categories a:hover',
				'.qodef-portfolio-filter-holder .qodef-portfolio-filter-holder-inner ul li span:hover',
				'.qodef-pagination li.active span',
				'.qodef-comment-holder .qodef-comment-text .qodef-comment-actions a:hover',
				'.qodef-pagination li a:hover',
                '.qodef-woocommerce-page .qodef-cart-totals .cart_totals #shipping_method label:after',
                '.woocommerce .qodef-cart-totals .cart_totals #shipping_method label:after',
                '.qodef-woocommerce-page .woocommerce-checkout label[for="ship-to-different-address-checkbox"]:after',
                '.qodef-woocommerce-page .woocommerce-checkout label[for="createaccount"]:after',
                '.woocommerce .woocommerce-checkout label[for="ship-to-different-address-checkbox"]:after',
                '.woocommerce .woocommerce-checkout label[for="createaccount"]:after',
                '.qodef-woocommerce-page .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot #shipping_method label:after',
                '.woocommerce .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot #shipping_method label:after',
                '.qodef-woocommerce-page.woocommerce-account #customer_login .col-1 label[for="rememberme"]:after',
                '.qodef-woocommerce-page .woocommerce-checkout .woocommerce-checkout-payment .wc_payment_methods .input-radio.checked ~ label:after',
                '.woocommerce .woocommerce-checkout .woocommerce-checkout-payment .wc_payment_methods .input-radio.checked ~ label:after',
                '.qodef-menu-area .qodef-featured-icon',
                '.qodef-sticky-nav .qodef-featured-icon',
                '.qodef-woocommerce-page.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
                '.qodef-woocommerce-page.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover'
            );

            $background_color_selector = array(
                '.qodef-title',
                '.qodef-fullscreen-menu-opener:hover .qodef-line',
                '.qodef-fullscreen-menu-opener.opened:hover .qodef-line:after',
                '.qodef-fullscreen-menu-opener.opened:hover .qodef-line:before',
                '.qodef-progress-bar .qodef-progress-content-outer .qodef-progress-content',
                '.qodef-price-table.qodef-active .qodef-active-text',
                '.qodef-pie-chart-doughnut-holder .qodef-pie-legend ul li .qodef-pie-color-holder',
                '.qodef-pie-chart-pie-holder .qodef-pie-legend ul li .qodef-pie-color-holder',
                '.qodef-btn.qodef-btn-solid',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
				'#qodef-back-to-top:after',
				'.qodef-portfolio-list-holder.qodef-ptf-standard article .qodef-item-icons-holder a',
                '.qodef-team .qodef-team-image .qodef-team-overlay',
                '.qodef-team.main-info-below-image .qodef-icon-shortcode.circle:hover',
                '.qodef-team.main-info-below-image .qodef-icon-shortcode.square:hover',
                '.qodef-message',
                '.qodef-interactive-banner.qodef-fade-hover .qodef-text-holder .qodef-banner-title',
                '.qodef-social-share-holder.square ul li a:hover',
                '.qodef-video-button-play .qodef-video-button-wrapper:hover',
                '.qodef-shop-masonry .qodef-shop-product .qodef-onsale',
                '.qodef-shop-masonry .qodef-shop-product .qodef-out-of-stock-button',
                '.qodef-side-menu .widget.qodef-latest-posts-widget .qodef-blog-list-holder.qodef-minimal > ul > li:hover .qodef-item-text-holder',
                'aside.qodef-sidebar .widget .woocommerce-product-search input[type="submit"]:hover',
                'aside.qodef-sidebar .widget #searchform input[type="submit"]:hover',
                '.qodef-right-from-mobile-logo.widget_icl_lang_sel_widget #lang_sel ul ul a:hover',
                '.qodef-right-from-main-menu-widget.widget_icl_lang_sel_widget #lang_sel ul ul a:hover',
                '.qodef-btn.add_to_cart_button.qodef-btn.qodef-btn-icon:hover i',
                '.qodef-btn.add_to_cart_button.qodef-btn.qodef-btn-icon:hover span:not(.qodef-btn-text)',
                '.qodef-btn.single_add_to_cart_button.qodef-btn.qodef-btn-icon:hover i',
                '.qodef-btn.single_add_to_cart_button.qodef-btn.qodef-btn-icon:hover span:not(.qodef-btn-text)',
                '.qodef-btn.out_of_stock_button.qodef-btn.qodef-btn-icon:hover i',
                '.qodef-btn.out_of_stock_button.qodef-btn.qodef-btn-icon:hover span:not(.qodef-btn-text)',
                '.woocommerce .product .qodef-onsale',
                '.qodef-woocommerce-page .product .qodef-onsale',
                '.widget.woocommerce.widget_price_filter .price_slider_amount .button',
                '.qodef-woocommerce-page .qodef-quantity-buttons .qodef-quantity-minus:hover',
                '.qodef-woocommerce-page .qodef-quantity-buttons .qodef-quantity-plus:hover',
                '.woocommerce .qodef-quantity-buttons .qodef-quantity-minus:hover',
                '.woocommerce .qodef-quantity-buttons .qodef-quantity-plus:hover',
                'footer .qodef-subscription-form input.wpcf7-form-control.wpcf7-submit:hover',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .checkout',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .view-cart',
                '.qodef-woocommerce-page .select2-container .select2-choice:hover .select2-arrow',
                '.woocommerce .select2-container .select2-choice:hover .select2-arrow',
                '.qodef-woocommerce-page.woocommerce-account.woocommerce-view-order .order-info mark',
                '.woocommerce input[name="save_address"]:hover',
                '.woocommerce form.checkout_coupon input[type="submit"]:hover',
                '.woocommerce form.edit-account input[type="submit"]:hover',
                '.woocommerce form.register input[type="submit"]:hover',
                '.woocommerce form.lost_reset_password input[type="submit"]:hover',
                '.woocommerce form.track_order input[type="submit"]:hover',
                '.woocommerce form.login input[type="submit"]:hover',
                '.qodef-woocommerce-page .return-to-shop .button.wc-backward',
                '.woocommerce .return-to-shop .button.wc-backward',
                '.qodef-popup-holder .qodef-popup-bottom',
                '.qodef-shopping-cart-outer .qodef-shopping-cart-header .qodef-header-cart .qodef-cart-label',
                '.underline-links a:before',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.qodef-woocommerce-page #reviews input[type="submit"]',
                '.qodef-woocommerce-page .woocommerce-message a',
                '.qodef-woocommerce-page .woocommerce-info a',
                '.qodef-woocommerce-page .woocommerce-error a',
                '.woocommerce-page .woocommerce-message a',
                '.woocommerce-page .woocommerce-info a',
                '.woocommerce-page .woocommerce-error a',
                '.woocommerce .woocommerce-message a',
                '.woocommerce .woocommerce-info a',
                '.woocommerce .woocommerce-error a',
                '.qodef-wipe-holder .qodef-wipe-2',
				'.qodef-progress-bar .qodef-progress-content-outer .qodef-progress-content'
            );

            $background_color_important_selector = array(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-bg):hover',
                '.qodef-woocommerce-page input[type="submit"].qodef-btn.qodef-btn-solid:hover',
                '.woocommerce input[type="submit"].qodef-btn.qodef-btn-solid:hover',
                '.qodef-woocommerce-page .shop_table.cart tbody tr td.product-add-to-cart a:hover',
                '.woocommerce .shop_table.cart tbody tr td.product-add-to-cart a:hover'
            );

            $border_color_selector = array(
                '.qodef-drop-down .second',
                '.qodef-progress-bar .qodef-progress-number-wrapper.qodef-floating .qodef-down-arrow',
                '.qodef-tabs .qodef-tabs-nav li a',
                '.qodef-btn.qodef-btn-outline',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus',
                '#respond input[type="text"]:focus',
                '.post-password-form input[type="password"]:focus',
				'.qodef-accordion-holder.qodef-boxed .qodef-title-holder.ui-state-active',
				'.qodef-accordion-holder.qodef-boxed .qodef-title-holder.ui-state-hover',
				'.qodef-portfolio-list-holder article .qodef-item-icons-holder a',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-prev-icon',
				'.qodef-portfolio-slider-holder .qodef-portfolio-list-holder.owl-carousel .owl-buttons .qodef-next-icon',
                '.qodef-btn.qodef-btn-icon.qodef-btn-outline .qodef-btn-text',
                '.qodef-tabs.qodef-vertical-tab .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-vertical-tab .qodef-tabs-nav li.ui-state-hover a',
                '.qodef-tabs.qodef-horizontal-tab .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-horizontal-tab .qodef-tabs-nav li.ui-state-hover a',
                '.qodef-main-menu .qodef-item-hover-holder > .qodef-item-hover',
                '#qodef-back-to-top:hover',
                'aside.qodef-sidebar .widget.widget_pages ul > li a:after',
                'aside.qodef-sidebar .widget.widget_meta ul > li a:after',
                'aside.qodef-sidebar .widget.widget_nav_menu ul > li a:after',
                'aside.qodef-sidebar .widget.widget_product_categories ul > li a:after',
                'aside.qodef-sidebar .widget.widget_categories ul > li a:after',
                'aside.qodef-sidebar .widget.widget_archive ul > li a:after',
                '.qodef-blog-holder article .qodef-post-info > div a:after',
                '.qodef-woocommerce-page .qodef-quantity-buttons .qodef-quantity-minus:hover',
                '.qodef-woocommerce-page .qodef-quantity-buttons .qodef-quantity-plus:hover',
                '.woocommerce .qodef-quantity-buttons .qodef-quantity-minus:hover',
                '.woocommerce .qodef-quantity-buttons .qodef-quantity-plus:hover',
                'footer .qodef-subscription-form input.wpcf7-form-control.wpcf7-submit:hover',
                '.qodef-woocommerce-page .select2-container .select2-choice:hover .select2-arrow',
                '.woocommerce .select2-container .select2-choice:hover .select2-arrow',
                '.yith-wcwl-wishlistexistsbrowse a:after',
                '.yith-wcwl-wishlistaddedbrowse a:after',
                '.qodef-woocommerce-page.woocommerce-account #customer_login .col-1 .lost_password a:hover:after',
				'blockquote .qodef-blockquote-text'
            );

            $border_top_color_selector = array(
                '.qodef-woocommerce-page .qodef-quantity-buttons .qodef-quantity-plus:hover ~ .qodef-quantity-minus',
                '.woocommerce .qodef-quantity-buttons .qodef-quantity-plus:hover ~ .qodef-quantity-minus'
            );

            $border_color_important_selector = array(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-border-hover):hover'
            );

            $color_important_selector = array();

            echo suprema_qodef_dynamic_css($color_selector, array('color' => suprema_qodef_options()->getOptionValue('first_color')));
            echo suprema_qodef_dynamic_css($color_important_selector, array('color' => suprema_qodef_options()->getOptionValue('first_color').'!important'));
            echo suprema_qodef_dynamic_css('::selection', array('background' => suprema_qodef_options()->getOptionValue('first_color')));
            echo suprema_qodef_dynamic_css('::-moz-selection', array('background' => suprema_qodef_options()->getOptionValue('first_color')));
            echo suprema_qodef_dynamic_css($background_color_selector, array('background-color' => suprema_qodef_options()->getOptionValue('first_color')));
            echo suprema_qodef_dynamic_css($background_color_important_selector, array('background-color' => suprema_qodef_options()->getOptionValue('first_color').'!important'));
            echo suprema_qodef_dynamic_css($border_color_important_selector, array('border-color' => suprema_qodef_options()->getOptionValue('first_color').'!important'));
            echo suprema_qodef_dynamic_css($border_color_selector, array('border-color' => suprema_qodef_options()->getOptionValue('first_color')));
            echo suprema_qodef_dynamic_css($border_top_color_selector, array('border-top-color' => suprema_qodef_options()->getOptionValue('first_color')));
        }

		if (suprema_qodef_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.qodef-content .qodef-content-inner > .qodef-container',
				'.qodef-content .qodef-content-inner > .qodef-full-width'
			);
			echo suprema_qodef_dynamic_css($background_color_selector, array('background-color' => suprema_qodef_options()->getOptionValue('page_background_color')));
		}

		if (suprema_qodef_options()->getOptionValue('selection_color')) {
			echo suprema_qodef_dynamic_css('::selection', array('background' => suprema_qodef_options()->getOptionValue('selection_color')));
			echo suprema_qodef_dynamic_css('::-moz-selection', array('background' => suprema_qodef_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (suprema_qodef_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = suprema_qodef_options()->getOptionValue('page_background_color_in_box');
		}

		if (suprema_qodef_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(suprema_qodef_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (suprema_qodef_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(suprema_qodef_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (suprema_qodef_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (suprema_qodef_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo suprema_qodef_dynamic_css('.qodef-boxed .qodef-wrapper', $boxed_background_style);
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_design_styles');
}

if (!function_exists('suprema_qodef_h1_styles')) {

    function suprema_qodef_h1_styles() {

        $h1_styles = array();

        if(suprema_qodef_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = suprema_qodef_options()->getOptionValue('h1_color');
        }
        if(suprema_qodef_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('h1_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = suprema_qodef_options()->getOptionValue('h1_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = suprema_qodef_options()->getOptionValue('h1_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = suprema_qodef_options()->getOptionValue('h1_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo suprema_qodef_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_h1_styles');
}

if (!function_exists('suprema_qodef_h2_styles')) {

    function suprema_qodef_h2_styles() {

        $h2_styles = array();

        if(suprema_qodef_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = suprema_qodef_options()->getOptionValue('h2_color');
        }
        if(suprema_qodef_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('h2_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = suprema_qodef_options()->getOptionValue('h2_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = suprema_qodef_options()->getOptionValue('h2_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = suprema_qodef_options()->getOptionValue('h2_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo suprema_qodef_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_h2_styles');
}

if (!function_exists('suprema_qodef_h3_styles')) {

    function suprema_qodef_h3_styles() {

        $h3_styles = array();

        if(suprema_qodef_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = suprema_qodef_options()->getOptionValue('h3_color');
        }
        if(suprema_qodef_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('h3_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = suprema_qodef_options()->getOptionValue('h3_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = suprema_qodef_options()->getOptionValue('h3_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = suprema_qodef_options()->getOptionValue('h3_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo suprema_qodef_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_h3_styles');
}

if (!function_exists('suprema_qodef_h4_styles')) {

    function suprema_qodef_h4_styles() {

        $h4_styles = array();

        if(suprema_qodef_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = suprema_qodef_options()->getOptionValue('h4_color');
        }
        if(suprema_qodef_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('h4_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = suprema_qodef_options()->getOptionValue('h4_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = suprema_qodef_options()->getOptionValue('h4_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = suprema_qodef_options()->getOptionValue('h4_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo suprema_qodef_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_h4_styles');
}

if (!function_exists('suprema_qodef_h5_styles')) {

    function suprema_qodef_h5_styles() {

        $h5_styles = array();

        if(suprema_qodef_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = suprema_qodef_options()->getOptionValue('h5_color');
        }
        if(suprema_qodef_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('h5_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = suprema_qodef_options()->getOptionValue('h5_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = suprema_qodef_options()->getOptionValue('h5_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = suprema_qodef_options()->getOptionValue('h5_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo suprema_qodef_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_h5_styles');
}

if (!function_exists('suprema_qodef_h6_styles')) {

    function suprema_qodef_h6_styles() {

        $h6_styles = array();

        if(suprema_qodef_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = suprema_qodef_options()->getOptionValue('h6_color');
        }
        if(suprema_qodef_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('h6_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = suprema_qodef_options()->getOptionValue('h6_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = suprema_qodef_options()->getOptionValue('h6_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = suprema_qodef_options()->getOptionValue('h6_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo suprema_qodef_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_h6_styles');
}

if (!function_exists('suprema_qodef_text_styles')) {

    function suprema_qodef_text_styles() {

        $text_styles = array();

        if(suprema_qodef_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = suprema_qodef_options()->getOptionValue('text_color');
        }
        if(suprema_qodef_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('text_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('text_fontsize')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('text_lineheight')).'px';
        }
        if(suprema_qodef_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('text_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = suprema_qodef_options()->getOptionValue('text_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('text_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo suprema_qodef_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_text_styles');
}

if (!function_exists('suprema_qodef_link_styles')) {

    function suprema_qodef_link_styles() {

        $link_styles = array();

        if(suprema_qodef_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = suprema_qodef_options()->getOptionValue('link_color');
        }
        if(suprema_qodef_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = suprema_qodef_options()->getOptionValue('link_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = suprema_qodef_options()->getOptionValue('link_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = suprema_qodef_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo suprema_qodef_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_link_styles');
}

if (!function_exists('suprema_qodef_link_hover_styles')) {

    function suprema_qodef_link_hover_styles() {

        $link_hover_styles = array();

        if(suprema_qodef_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = suprema_qodef_options()->getOptionValue('link_hovercolor');
        }
        if(suprema_qodef_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = suprema_qodef_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo suprema_qodef_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(suprema_qodef_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = suprema_qodef_options()->getOptionValue('link_hovercolor');
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
            echo suprema_qodef_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_link_hover_styles');
}

if (!function_exists('suprema_qodef_preloading_effect_styles')) {

    function suprema_qodef_preloading_effect_styles() {
        
        $loader_style = array();

        if(suprema_qodef_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = suprema_qodef_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        if(suprema_qodef_options()->getOptionValue('smooth_wipe_effect') == 'yes') {
            $loader_selector = array('.qodef-wipe-holder .qodef-wipe-1');
        } else {
            $loader_selector = array('.qodef-smooth-transition-loader');
        }

        if (!empty($loader_style)) {
            echo suprema_qodef_dynamic_css($loader_selector, $loader_style);
        }

        //background style
        $spinner_style = array();

        if(suprema_qodef_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = suprema_qodef_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.qodef-st-loader .pulse', 
            '.qodef-st-loader .double_pulse .double-bounce1', 
            '.qodef-st-loader .double_pulse .double-bounce2', 
            '.qodef-st-loader .cube', 
            '.qodef-st-loader .rotating_cubes .cube1', 
            '.qodef-st-loader .rotating_cubes .cube2', 
            '.qodef-st-loader .stripes > div', 
            '.qodef-st-loader .wave > div', 
            '.qodef-st-loader .two_rotating_circles .dot1', 
            '.qodef-st-loader .two_rotating_circles .dot2', 
            '.qodef-st-loader .five_rotating_circles .container1 > div', 
            '.qodef-st-loader .five_rotating_circles .container2 > div', 
            '.qodef-st-loader .five_rotating_circles .container3 > div', 
            '.qodef-st-loader .atom .ball-1:before', 
            '.qodef-st-loader .atom .ball-2:before', 
            '.qodef-st-loader .atom .ball-3:before', 
            '.qodef-st-loader .atom .ball-4:before', 
            '.qodef-st-loader .clock .ball:before', 
            '.qodef-st-loader .mitosis .ball', 
            '.qodef-st-loader .lines .line1', 
            '.qodef-st-loader .lines .line2', 
            '.qodef-st-loader .lines .line3', 
            '.qodef-st-loader .lines .line4', 
            '.qodef-st-loader .fussion .ball', 
            '.qodef-st-loader .fussion .ball-1', 
            '.qodef-st-loader .fussion .ball-2', 
            '.qodef-st-loader .fussion .ball-3', 
            '.qodef-st-loader .fussion .ball-4', 
            '.qodef-st-loader .wave_circles .ball', 
            '.qodef-st-loader .pulse_circles .ball' 
        );

        if (!empty($spinner_style)) {
            echo suprema_qodef_dynamic_css($spinner_selectors, $spinner_style);
        }

        //border style
        if(suprema_qodef_options()->getOptionValue('smooth_pt_spinner_type') == 'semi_circle' && suprema_qodef_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $semi_circle_selector = '.qodef-st-loader .semi-circle';
            $semi_circle_style = array();
            $semi_circle_style['border-top-color'] = suprema_qodef_options()->getOptionValue('smooth_pt_spinner_color');
            $semi_circle_style['border-left-color'] = suprema_qodef_options()->getOptionValue('smooth_pt_spinner_color');
            $semi_circle_style['border-bottom-color'] = suprema_qodef_options()->getOptionValue('smooth_pt_spinner_color');
            if (!empty($semi_circle_style)) {
                echo suprema_qodef_dynamic_css($semi_circle_selector, $semi_circle_style);
            }
        }

    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_preloading_effect_styles');
}