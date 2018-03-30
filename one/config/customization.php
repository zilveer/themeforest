<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

$thb_customizer = thb_theme()->setCustomizer( new THB_Customizer() );


	/**
	 * Logo
	 * -------------------------------------------------------------------------
	 */

	$thb_logo = $thb_customizer->addSection( 'logo', __( 'Logo', 'thb_text_domain' ) );

		$thb_logo
			->addSetting( new THB_CustomizerFontSetting( 'logo', __( 'Logo', 'thb_text_domain' ) ) )
				->setDefault( 'Source+Sans+Pro' )
				->setDefaultVariants( array( '400' ) )
				->addRule( 'font-family', '#logo .thb-logo' );

		$thb_logo
			->addSetting( new THB_CustomizerSelectSetting( 'logo_case', __( 'Logo text transform', 'thb_text_domain' ) ) )
				->setDefault( 'capitalize' )
				->setOptions( array(
					'lowercase' => __( 'Lowercase', 'thb_text_domain' ),
					'uppercase' => __( 'Uppercase', 'thb_text_domain' ),
					'capitalize' => __( 'Capitalize', 'thb_text_domain' )
				) )
				->addRule( 'text-transform', '#logo .thb-logo' );


		$thb_logo
			->addSetting( new THB_CustomizerFontSetting( 'tagline', __( 'Tagline', 'thb_text_domain' ) ) )
				->setDefault( 'Source+Sans+Pro' )
				->setDefaultVariants( array( 'regular' ) )
				->addRule( 'font-family', '#logo .thb-logo-tagline' );

		$thb_logo
			->addSetting( new THB_CustomizerSelectSetting( 'tagline_case', __( 'Tagline text transform', 'thb_text_domain' ) ) )
				->setDefault( 'capitalize' )
				->setOptions( array(
					'lowercase' => __( 'Lowercase', 'thb_text_domain' ),
					'uppercase' => __( 'Uppercase', 'thb_text_domain' ),
					'capitalize' => __( 'Capitalize', 'thb_text_domain' )
				) )
				->addRule( 'text-transform', '#logo .thb-logo-tagline' );

	/**
	 * Theme style
	 * -------------------------------------------------------------------------
	 */

	$thb_main = $thb_customizer->addSection( 'main', __( 'Theme style', 'thb_text_domain' ) );

		// Fonts ---------------------------------------------------------------

		$thb_main->addDivider( __( 'Fonts', 'thb_text_domain' ) );

		// Primary font

		$source_sans = '.thb-slide-caption .thb-caption-inner-wrapper .thb-caption-texts-wrapper > div.thb-heading p, .hentry.masonry .item-header h1, .item.list.classic .item-header h1, .thb-related h3, .work-inner-wrapper .work-data h3, .work-data .work-title, .page-template-template-archives-php .thb-archives-container h3, #reply-title, #comments-title, .comment .comment_rightcol .comment_head .user, .widget .widgettitle, .thb-section-column-block-thb_text_box .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_image .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_video .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_blog .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_list .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_portfolio .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_progress_bar .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_photogallery .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_page .thb-section-block-header .thb-section-block-title, .thb-section-column-block-thb_progress_bar.progress-style-b .thb-meter, .thb-section-column-block-thb_progress_bar.progress-style-a .thb-meter-bar-label, .thb-section-column-block-thb_accordion .thb-toggle-trigger, .thb-section-column-block-thb_tabs .thb-tabs-nav li a, .main-navigation, .secondary-navigation, #slide-menu-container ul, .thb-text h1, .thb-text h2, .thb-text h3, .thb-text h4, .thb-text h5, .thb-text h6, .comment_body h1, .comment_body h2, .comment_body h3, .comment_body h4, .comment_body h5, .comment_body h6, #page-header .page-title, .thb-portfolio-filter, .comment .comment_rightcol .comment_head .comment-reply-link, .thb-section-column-block-thb_pricingtable .thb-pricingtable-featured, .thb-section-column-block-thb_pricingtable .thb-pricingtable-price';

		if ( function_exists( 'is_woocommerce' ) && function_exists( 'thb_woocommerce_check' ) ) {
			$source_sans .= ', .woocommerce-page .upsells.products h2, .woocommerce-page .related.products h2, .woocommerce .upsells.products h2, .woocommerce .related.products h2, .woocommerce-page .cart-collaterals .cart_totals h2, .woocommerce .cart-collaterals .cart_totals h2, .woocommerce-page .thb-checkout-billing h3, .woocommerce-page .thb-checkout-shipping h3, .woocommerce-page #payment h3, .woocommerce .thb-checkout-billing h3, .woocommerce .thb-checkout-shipping h3, .woocommerce #payment h3, .woocommerce-page #order_review_heading, .woocommerce #order_review_heading, .woocommerce-page .cross-sells h2, .woocommerce .cross-sells h2, .woocommerce-page.woocommerce-account .thb-text .woocommerce h2, .woocommerce-page.woocommerce-account .thb-text .woocommerce h3, .woocommerce.woocommerce-account .thb-text .woocommerce h2, .woocommerce.woocommerce-account .thb-text .woocommerce h3, .woocommerce-page .woocommerce-tabs .tabs li a, .woocommerce .woocommerce-tabs .tabs li a, .woocommerce-page .woocommerce-tabs .panel h2, .woocommerce .woocommerce-tabs .panel h2, .woocommerce-page .products ul li.product .thb-product-description h3, .woocommerce-page ul.products li.product .thb-product-description h3, .woocommerce .products ul li.product .thb-product-description h3, .woocommerce ul.products li.product .thb-product-description h3, .woocommerce-page.single-product .summary .thb-product-header .product_title';
		}

		$thb_main
			->addSetting( new THB_CustomizerFontSetting( 'primary_font', __( 'Primary Font', 'thb_text_domain' ) ) )
				->setDefault( 'Source+Sans+Pro' )
				->setDefaultVariants( array( '300', 'regular', '600', '700' ) )
				->addRule( 'font-family', $source_sans );

		// Secondary font

		$noto_serif = '#slide-menu-container ul li ul li a, .thb-slide-caption .thb-caption-inner-wrapper .thb-caption-texts-wrapper > div.thb-caption, .thb-text blockquote, .comment_body blockquote, #page-header .page-subtitle, .hentry.masonry .loop-post-meta, .item.list.classic .item-header .loop-post-meta, .thb-related li .item-title p, .format-quote.hentry.masonry .item-header h1, .format-quote.item.list.classic .item-header h1, .work-inner-wrapper .work-data .work-categories, .work-data .work-subtitle, #respond .comment-notes, #respond .logged-in-as, .comment .comment_rightcol .comment_head .date, .thb-section-column-block-thb_text_box .thb-section-block-header p, .thb-section-column-block-thb_pricingtable .thb-pricingtable-description';

		if ( function_exists( 'is_woocommerce' ) && function_exists( 'thb_woocommerce_check' ) ) {
			$noto_serif .= ', .woocommerce-page .woocommerce-result-count, .woocommerce .woocommerce-result-count, .woocommerce-page .products ul li.product .thb-product-description .posted_in, .woocommerce-page ul.products li.product .thb-product-description .posted_in, .woocommerce .products ul li.product .thb-product-description .posted_in, .woocommerce ul.products li.product .thb-product-description .posted_in, .woocommerce-page.single-product .summary .thb-product-header .woocommerce-breadcrumb, .woocommerce-page.single-product .summary .product_meta';
		}

		$thb_main
			->addSetting( new THB_CustomizerFontSetting( 'secondary_font', __( 'Secondary Font', 'thb_text_domain' ) ) )
				->setDefault( 'Noto+Serif' )
				->setDefaultVariants( array( 'regular', 'italic', '700', '700italic' ) )
				->addRule( 'font-family', $noto_serif );

		// Text font

		$noto_sans = 'body, .thb-text blockquote cite, .comment_body blockquote cite, form input, form button, form textarea';

		$thb_main
			->addSetting( new THB_CustomizerFontSetting( 'text_font', __( 'Text Font', 'thb_text_domain' ) ) )
				->setDefault( 'Noto+Sans' )
				->setDefaultVariants( array( 'regular', 'italic', '700', '700italic' ) )
				->addRule( 'font-family', $noto_sans );



		// Colors --------------------------------------------------------------

		$thb_main->addDivider( __( 'Colors', 'thb_text_domain' ) );

		$color = '.header-layout-a #main-nav ul > li.action.blue > a:hover, .thb-section-column-block-thb_text_box .thb-section-block-call-to .action-primary:hover, .header-layout-a #main-nav ul ul li a:hover, #slide-menu-container ul li a:hover, .thb-navigation.numeric li .current, #page-links span, a:hover, .thb-text blockquote:after, .comment_body blockquote:after, .hentry.masonry .loop-post-meta a:hover, .item.list.classic .item-header .loop-post-meta a:hover, .thb-related li .item-title p a:hover, .meta.details a:hover, .thb-portfolio-grid-b .work-inner-wrapper .thb-like:hover, .thb-portfolio-filter .filterlist li.active, #respond .comment-notes a:hover, #respond .logged-in-as a:hover, .icon-style-a.thb-section-column-block-thb_text_box .thb-section-block-icon, .icon-style-b.thb-section-column-block-thb_text_box .thb-section-block-icon, .icon-style-e.thb-section-column-block-thb_text_box .thb-section-block-icon, .thb-section-column-block-thb_accordion .thb-toggle-trigger:hover, .thb-section-column-block-thb_accordion .thb-toggle-trigger:hover:before, .thb-tab-horizontal.thb-section-column-block-thb_tabs .thb-tabs-nav li.open a, .thb-tab-vertical.thb-section-column-block-thb_tabs .thb-tabs-nav li.open a, .thb-tab-vertical.thb-section-column-block-thb_tabs .thb-tabs-nav li.open a:after, .thb-tab-vertical.thb-section-column-block-thb_tabs .thb-tabs-nav li.open a:hover:after, .thb-section-column-block-thb_divider .thb-go-top:hover, .thb-skin-light .hentry.masonry .item-header h1 a:hover, .hentry.masonry .item-header .thb-skin-light h1 a:hover, .thb-skin-light .item.list.classic .item-header h1 a:hover, .item.list.classic .item-header .thb-skin-light h1 a:hover, .thb-skin-dark .thb-text a:hover, .thb-skin-dark .hentry.masonry .item-header h1 a:hover, .hentry.masonry .item-header .thb-skin-dark h1 a:hover, .thb-skin-dark .item.list.classic .item-header h1 a:hover, .item.list.classic .item-header .thb-skin-dark h1 a:hover';
		$background_color = '.thb-btn.thb-read-more:after, .owl-buttons div.thb-read-more:after, .header-layout-a #main-nav ul > li.action.blue > a:after, .thb-section-column-block-thb_text_box .thb-section-block-call-to .action-primary:after, .header-layout-a #main-nav ul > li a:before, .thb-overlay, .thb-work-overlay, .format-aside.hentry.masonry .post-wrapper, .format-aside.item.list.classic .post-wrapper, .thb-portfolio-grid-b .work-thumb:hover .work-data, .thb-portfolio-filter .filterlist li.active:after, .thb-portfolio-filter .filterlist li.active:hover:after, .icon-style-c.thb-section-column-block-thb_text_box .thb-section-block-icon, .icon-style-d.thb-section-column-block-thb_text_box .thb-section-block-icon, .thb-section-column-block-thb_progress_bar.progress-style-b .thb-meter .thb-meter-bar-progress, .thb-section-column-block-thb_progress_bar.progress-style-a .thb-meter-bar-progress';
		$border_color = '.thb-btn.thb-read-more:hover, .owl-buttons div.thb-read-more:hover, .thb-navigation.numeric li .current, #page-links span, .header-layout-a #main-nav ul > li.action.blue > a, .thb-text blockquote, .comment_body blockquote, .comment.bypostauthor .comment_rightcol .comment_head p, .icon-style-c.thb-section-column-block-thb_text_box .thb-section-block-icon, .icon-style-d.thb-section-column-block-thb_text_box .thb-section-block-icon, .thb-section-column-block-thb_text_box .thb-section-block-call-to .action-primary, .thb-tab-horizontal.thb-section-column-block-thb_tabs .thb-tabs-nav li.open a, .thb-skin-light#header #main-nav ul li.action.blue > a, .thb-skin-light .thb-btn.thb-read-more:hover, .thb-skin-light .owl-buttons div.thb-read-more:hover, .owl-buttons .thb-skin-light div.thb-read-more:hover, .thb-skin-dark .thb-btn.thb-read-more:hover, .thb-skin-dark .owl-buttons div.thb-read-more:hover, .owl-buttons .thb-skin-dark div.thb-read-more:hover';

		if ( function_exists( 'is_woocommerce' ) && function_exists( 'thb_woocommerce_check' ) ) {
			$color .= ', .thb_mini_cart_wrapper a:hover, .woocommerce-page .woocommerce-pagination li .current, .woocommerce .woocommerce-pagination li .current, .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-page.single-product .summary .thb-product-header .woocommerce-breadcrumb a:hover';
			$background_color .= ', .widget_shopping_cart_content .buttons .button.checkout:after, .thb_mini_cart_wrapper .buttons .button.checkout:after, .woocommerce-page .button.alt:after, .woocommerce .button.alt:after, .thb-product-numbers, .woocommerce-page .woocommerce-tabs .tabs li.active a, .woocommerce .woocommerce-tabs .tabs li.active a';
			$border_color .= ', .woocommerce-page .woocommerce-pagination li .current, .woocommerce .woocommerce-pagination li .current';
		}

		$thb_main
			->addSetting( new THB_CustomizerColorSetting( 'highlight_color', __( 'Highlight color', 'thb_text_domain' ) ) )
				->setDefault( '#00aeef' )
				->addRule( 'color', $color )
				->addRule( 'background-color', $background_color )
				->addRule( 'border-color', $border_color )
				->addRule( 'background-color', '#slide-menu-container, #thb-search-box-container', array( 'rgba' => '0.9' ) )
				->addRule( 'background-color', '::-webkit-selection' )
				->addRule( 'background-color', '::-moz-selection' )
				->addRule( 'background-color', '::selection' )
				->addRule( 'border-top-color', '#nprogress .spinner .spinner-icon' )
				->addRule( 'border-left-color', '#nprogress .spinner .spinner-icon' );

		$thb_main
			->addSetting( new THB_CustomizerColorSetting( 'body_bg', __( 'Background', 'thb_text_domain' ) ) )
				->setDefault( '#fff' )
				->addRule( 'background-color', '#thb-external-wrapper' );

		$thb_main
			->addSetting( new THB_CustomizerColorSetting( 'boxed_body_bg', __( 'Boxed Background', 'thb_text_domain' ) ) )
				->setDefault( '#dadada' )
				->addRule( 'background-color', 'body' );

		$thb_main
			->addSetting( new THB_CustomizerColorSetting( 'footer_bg', __( 'Footer background color', 'thb_text_domain' ) ) )
				->setDefault( '#272727' )
				->addRule( 'background-color', '#footer-sidebar, #footer' );