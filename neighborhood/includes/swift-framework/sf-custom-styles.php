<?php
	/*
	*
	*	Theme Styling Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/


 	/* CUSTOM CSS OUTPUT
 	================================================== */
	function sf_custom_styles() {
		$options = get_option('sf_neighborhood_options');
		$enable_responsive = $options['enable_responsive'];

		// Standard Styling
		$accent_color = get_option('accent_color', '#07c1b6');
		$accent_alt_color = get_option('accent_alt_color', '#ffffff');
		$secondary_accent_color = get_option('secondary_accent_color', '#222222');
		$secondary_accent_alt_color = get_option('secondary_accent_alt_color', '#ffffff');

		// Page Styling
		$page_bg_color = get_option('page_bg_color', '#e4e4e4');
		$inner_page_bg_color = get_option('inner_page_bg_color', '#FFFFFF');
		$body_bg_use_image = $options['use_bg_image'];
		$body_upload_bg = $body_preset_bg = "";
		if (isset($options['custom_bg_image'])) {
		$body_upload_bg = $options['custom_bg_image'];
		}
		if (isset($options['preset_bg_image'])) {
		$body_preset_bg = $options['preset_bg_image'];
		}
		$section_divide_color = get_option('section_divide_color', '#e4e4e4');
		$alt_bg_color = get_option('alt_bg_color', '#f7f7f7');
		$bg_size = $options['bg_size'];

		// Header Styling
		$header_layout = $options['header_layout'];
		$topbar_bg_color = get_option('topbar_bg_color', '#252525');
		$topbar_text_color = get_option('topbar_text_color', '#999999');
		$topbar_link_color = get_option('topbar_link_color', '#ffffff');
		$topbar_link_hover_color = get_option('topbar_link_hover_color', '#07c1b6');
		$topbar_divider_color = get_option('topbar_divider_color', '#444444');
		$header_bg_color1 = get_option('header_bg_color1', '#ffffff');
		$header_bg_color2 = get_option('header_bg_color2', '#ffffff');
		$header_overlay = $options['header_overlay'];
		$header_opacity = $options['header_opacity'];

		// Navigation Styling
		$nav_text_color = get_option('nav_text_color', '#252525');
		$nav_text_hover_color = get_option('nav_text_hover_color', '#07c1b6');
		$nav_selected_text_color = get_option('nav_selected_text_color', '#1bbeb4');
		$nav_pointer_color = get_option('nav_pointer_color', '#07c1b6');
		$nav_sm_bg_color = get_option('nav_sm_bg_color', '#FFFFFF');
		$nav_sm_text_color = get_option('nav_sm_text_color', '#252525');
		$nav_sm_bg_hover_color = get_option('nav_sm_bg_hover_color', '#1bbeb4');
		$nav_sm_text_hover_color = get_option('nav_sm_text_hover_color', '#ffffff');
		$nav_sm_selected_text_color = get_option('nav_sm_selected_text_color', '#ffffff');
		$nav_divider = get_option('nav_divider', 'solid');
		$nav_divider_color = get_option('nav_divider_color', '#f0f0f0');

		// Promo Bar Styling
		$promo_bar_bg_color = get_option('promo_bar_bg_color', '#ef3f32');
		$promo_bar_text_color = get_option('promo_bar_text_color', '#ffffff');

		// Page Heading Styling
		$breadcrumb_text_color = get_option('breadcrumb_text_color', '#999999');
		$breadcrumb_link_color = get_option('breadcrumb_link_color', '#999999');
		$page_heading_bg_color = get_option('page_heading_bg_color', '#f7f7f7');
		$page_heading_text_color = get_option('page_heading_text_color', '#222222');

		// Body Styling
		$body_text_color = get_option('body_color', '#222222');
		$link_text_color = get_option('link_color', '#666666');
		$h1_text_color = get_option('h1_color', '#222222');
		$h2_text_color = get_option('h2_color', '#222222');
		$h3_text_color = get_option('h3_color', '#222222');
		$h4_text_color = get_option('h4_color', '#222222');
		$h5_text_color = get_option('h5_color', '#222222');
		$h6_text_color = get_option('h6_color', '#222222');
		$impact_text_color = get_option('impact_text_color', '#222222');

		// Shortcode Stying
		$pt_primary_bg_color = get_option('pt_primary_bg_color', '#07c1b6');
		$pt_secondary_bg_color = get_option('pt_secondary_bg_color', '#fd9d96');
		$pt_tertiary_bg_color = get_option('pt_tertiary_bg_color', '#fed8d5');
		$lpt_primary_row_color = get_option('lpt_primary_row_color', '#fbfbfb');
		$lpt_secondary_row_color = get_option('lpt_secondary_row_color', '#f5f5f5');
		$lpt_default_pricing_header = get_option('lpt_default_pricing_header', '#cccccc');
		$lpt_default_package_header = get_option('lpt_default_package_header', '#bbbbbb');
		$lpt_default_footer = get_option('lpt_default_footer', '#e4e4e4');
		$icon_container_bg_color = get_option('icon_container_bg_color', '#222222');
		$icon_color = get_option('sf_icon_color', '#07c1b6');
		$boxed_content_color = get_option('boxed_content_color', '#07c1b6');

		// Footer Styling
		$footer_bg_color = get_option('footer_bg_color', '#252525');
		$footer_text_color = get_option('footer_text_color', '#cccccc');
		$footer_link_color = get_option('footer_link_color', '#71747b');
		$footer_border_color = get_option('footer_border_color', '#333333');
		$copyright_bg_color = get_option('copyright_bg_color', '#000000');
		$copyright_text_color = get_option('copyright_text_color', '#666666');
		$copyright_link_color = get_option('copyright_link_color', '#999999');

		// Logo/Nav Spacing
		$logo_width = $options['logo_width'];

		// Header Height
		$header_height = $logo_height = 0;
		$logo_padding = 35;
		$logo = $logo_id = "";
		if (isset($options['logo_upload'])) {
			$logo = $options['logo_upload'];
			$logo_id = sf_get_attachment_id_from_url($logo);
		}
		if ($logo_id != "") {
			$logo_object = wp_get_attachment_image_src($logo_id);
			$logo_height = intval($logo_object[2], 10);
		}
		if (isset($options['logo_padding'])) {
			if ($options['logo_padding']) {
				$logo_padding = $options['logo_padding'];
			}
		}
		if ($logo_height < 40) {
			$logo_height = 40;
		}
		if (isset($options['logo_height'])) {
			if ($options['logo_height'] != "") {
				$logo_height = $options['logo_height'];
			}
		}
		if ($logo_height != 0) {
			$logo_padding = apply_filters('sf_header_padding', $logo_padding);
			$header_height = $logo_height + (intval($logo_padding, 10) * 2);
		}


		// Font
		$body_font_option = $options['body_font_option'];
		$standard_font = $options['web_body_font'];
		$google_standard_font = $google_heading_font = $google_menu_font = $google_font_one = $google_font_one_weight = $google_font_two = $google_font_two_weight = $google_font_three = $google_font_three_weight = $custom_fonts = "";
		if (isset($options['google_standard_font'])) {
			$google_standard_font = explode(':', $options['google_standard_font']);
			$google_font_one = str_replace("+", " ", $google_standard_font[0]);
			if (isset($google_standard_font[1])) {
				$google_font_one_weight = $google_standard_font[1];
			}
		}
		$headings_font_option = $options['headings_font_option'];
		$heading_font = $options['web_heading_font'];
		if (isset($options['google_heading_font'])) {
			$google_heading_font = explode(':', $options['google_heading_font']);
			$google_font_two = str_replace("+", " ", $google_heading_font[0]);
			if (isset($google_heading_font[1])) {
				$google_font_two_weight = $google_heading_font[1];
			}
		}
		$menu_font_option = $menu_font = "";

		if (isset($options['menu_font_option'])) {
		$menu_font_option = $options['menu_font_option'];
		}
		if (isset($options['web_menu_font'])) {
		$menu_font = $options['web_menu_font'];
		}
		if (isset($options['google_menu_font'])) {
			$google_menu_font = explode(':', $options['google_menu_font']);
			$google_font_three = str_replace("+", " ", $google_menu_font[0]);
			if (isset($google_menu_font[1])) {
				$google_font_three_weight = $google_menu_font[1];
			}
		}

		// Font Sizing
		$menu_font_size = "";
		$body_font_size = $options['body_font_size'];
		$body_font_line_height = $options['body_font_line_height'];
		if (isset($options['menu_font_size'])) {
		$menu_font_size = $options['menu_font_size'];
		}
		$h1_font_size = $options['h1_font_size'];
		$h1_font_line_height = $options['h1_font_line_height'];
		$h2_font_size = $options['h2_font_size'];
		$h2_font_line_height = $options['h2_font_line_height'];
		$h3_font_size = $options['h3_font_size'];
		$h3_font_line_height = $options['h3_font_line_height'];
		$h4_font_size = $options['h4_font_size'];
		$h4_font_line_height = $options['h4_font_line_height'];
		$h5_font_size = $options['h5_font_size'];
		$h5_font_line_height = $options['h5_font_line_height'];
		$h6_font_size = $options['h6_font_size'];
		$h6_font_line_height = $options['h6_font_line_height'];

		// Alt Background Setup
		$alt_one_bg_color = $options['alt_one_bg_color'];
		$alt_one_text_color = $options['alt_one_text_color'];
		if (isset($options['alt_one_bg_image'])) {
		$alt_one_bg_image = $options['alt_one_bg_image'];
		}
		$alt_one_bg_image_size = $options['alt_one_bg_image_size'];
		$alt_two_bg_color = $options['alt_two_bg_color'];
		$alt_two_text_color = $options['alt_two_text_color'];
		if (isset($options['alt_two_bg_image'])) {
		$alt_two_bg_image = $options['alt_two_bg_image'];
		}
		$alt_two_bg_image_size = $options['alt_two_bg_image_size'];
		$alt_three_bg_color = $options['alt_three_bg_color'];
		$alt_three_text_color = $options['alt_three_text_color'];
		if (isset($options['alt_three_bg_image'])) {
		$alt_three_bg_image = $options['alt_three_bg_image'];
		}
		$alt_three_bg_image_size = $options['alt_three_bg_image_size'];
		$alt_four_bg_color = $options['alt_four_bg_color'];
		$alt_four_text_color = $options['alt_four_text_color'];
		if (isset($options['alt_four_bg_image'])) {
		$alt_four_bg_image = $options['alt_four_bg_image'];
		}
		$alt_four_bg_image_size = $options['alt_four_bg_image_size'];
		$alt_five_bg_color = $options['alt_five_bg_color'];
		$alt_five_text_color = $options['alt_five_text_color'];
		if (isset($options['alt_five_bg_image'])) {
		$alt_five_bg_image = $options['alt_five_bg_image'];
		}
		$alt_five_bg_image_size = $options['alt_five_bg_image_size'];
		$alt_six_bg_color = $options['alt_six_bg_color'];
		$alt_six_text_color = $options['alt_six_text_color'];
		if (isset($options['alt_six_bg_image'])) {
		$alt_six_bg_image = $options['alt_six_bg_image'];
		}
		$alt_six_bg_image_size = $options['alt_six_bg_image_size'];
		$alt_seven_bg_color = $options['alt_seven_bg_color'];
		$alt_seven_text_color = $options['alt_seven_text_color'];
		if (isset($options['alt_seven_bg_image'])) {
		$alt_seven_bg_image = $options['alt_seven_bg_image'];
		}
		$alt_seven_bg_image_size = $options['alt_seven_bg_image_size'];
		$alt_eight_bg_color = $options['alt_eight_bg_color'];
		$alt_eight_text_color = $options['alt_eight_text_color'];
		if (isset($options['alt_eight_bg_image'])) {
		$alt_eight_bg_image = $options['alt_eight_bg_image'];
		}
		$alt_eight_bg_image_size = $options['alt_eight_bg_image_size'];
		$alt_nine_bg_color = $options['alt_nine_bg_color'];
		$alt_nine_text_color = $options['alt_nine_text_color'];
		if (isset($options['alt_nine_bg_image'])) {
		$alt_nine_bg_image = $options['alt_nine_bg_image'];
		}
		$alt_nine_bg_image_size = $options['alt_nine_bg_image_size'];
		$alt_ten_bg_color = $options['alt_ten_bg_color'];
		$alt_ten_text_color = $options['alt_ten_text_color'];
		if (isset($options['alt_ten_bg_image'])) {
		$alt_ten_bg_image = $options['alt_ten_bg_image'];
		}
		$alt_ten_bg_image_size = $options['alt_ten_bg_image_size'];


		$one_page_checkout = "";
		if (isset($options['enable_one_page_checkout'])) {
			$one_page_checkout = $options['enable_one_page_checkout'];
		} else {
			$one_page_checkout = false;
		}

		// PAGE BACKGROUND IMAGE //
		$bg_image_url = "";
		$page_background_image = rwmb_meta('sf_background_image', 'type=image&size=full');
		if (is_array($page_background_image)) {
			foreach ($page_background_image as $image) {
				$bg_image_url = $image['url'];
				break;
			}
		}
		global $post;
		if ($post) {
		$background_image_size = sf_get_post_meta($post->ID, 'sf_background_image_size', true);
		}
		
		// WooCommerce
		$product_imagewidth_override = false;
		$productdetail_imagewidth = "48";
		if ( isset($options['product_imagewidth_override']) ) {
			$product_imagewidth_override = $options['product_imagewidth_override'];
		}
		if ( isset($options['productdetail_imagewidth']) ) {
			$productdetail_imagewidth = $options['productdetail_imagewidth'];
		}
				
		// Custom CSS
		$custom_css = $options['custom_css'];

		// OPEN STYLE TAG
		echo '<style type="text/css">'. "\n";

		// NON-RESPONSIVE STYLES
		if (!$enable_responsive) {
		echo '
			html {
				min-width: 1200px;
			}
			.row {
			  margin-left: -30px;
			  *zoom: 1;
			}
			.row:before,
			.row:after {
			  display: table;
			  line-height: 0;
			  content: "";
			}
			.row:after {
			  clear: both;
			}
			[class*="span"] {
			  float: left;
			  min-height: 1px;
			  margin-left: 30px;
			  box-sizing:content-box!important;
			  -moz-box-sizing:content-box!important; /* Firefox */
			  -webkit-box-sizing:content-box!important; /* Safari */
			}
			.sidebar {
			  box-sizing:border-box!important;
			  -moz-box-sizing:border-box!important; /* Firefox */
			  -webkit-box-sizing:border-box!important; /* Safari */
			}
			.container,
			.navbar-static-top .container,
			.navbar-fixed-top .container,
			.navbar-fixed-bottom .container {
			  width: 1170px!important;
			}
			.span12 {
			  width: 1170px;
			}
			.span11 {
			  width: 1070px;
			}
			.span10 {
			  width: 970px;
			}
			.span9 {
			  width: 870px;
			}
			.span8 {
			  width: 770px;
			}
			.span7 {
			  width: 670px;
			}
			.span6 {
			  width: 570px;
			}
			.span5 {
			  width: 470px;
			}
			.span4 {
			  width: 370px;
			}
			.span3 {
			  width: 270px;
			}
			.span2 {
			  width: 170px;
			}
			.span1 {
			  width: 70px;
			}
			.span-third {
				width: 236px;
			}
			.span-twothirds {
				width: 504px;
			}
			.span-bs-quarter {
				width: 120px;
			}
			.span-bs-threequarter {
				width: 420px;
			}
			.offset12 {
			  margin-left: 1230px;
			}
			.offset11 {
			  margin-left: 1130px;
			}
			.offset10 {
			  margin-left: 1030px;
			}
			.offset9 {
			  margin-left: 930px;
			}
			.offset8 {
			  margin-left: 830px;
			}
			.offset7 {
			  margin-left: 730px;
			}
			.offset6 {
			  margin-left: 630px;
			}
			.offset5 {
			  margin-left: 530px;
			}
			.offset4 {
			  margin-left: 430px;
			}
			.offset3 {
			  margin-left: 330px;
			}
			.offset2 {
			  margin-left: 230px;
			}
			.offset1 {
			  margin-left: 130px;
			}
			.boxed-layout {
				width: 1230px;
			}
			#swift-slider {
				min-width: 1170px;
			}
			.show-menu {
				display:none!important;
			}
			/* PRODUCTS */
			.woocommerce ul.products li.product {
				margin-left: 30px;
			}
			.carousel-wrap ul.products li.product {
				margin-left: 30px!important;
				margin-right: 0!important;
			}
			body .has-no-sidebar ul.products li.product {
				width: 270px;
			}
			body .has-one-sidebar .products-standard.span8 ul.products li.product {
				width: 236px;
			}
			body .has-one-sidebar ul.products li.product {
				width: 170px;
			}
			body .has-both-sidebars ul.products li.product {
				width: 270px;
			}
			body .has-no-sidebar .products-mini ul.products li.product {
				width: 170px;
			}
			body .has-one-sidebar .products-mini ul.products li.product {
				width: 170px;
			}
			body .has-both-sidebars .products-mini ul.products li.product {
				width: 170px;
			}
			body.woocommerce .has-no-sidebar ul.products li.product, body.woocommerce .has-no-sidebar .upsells.products ul.products li.product {
				width: 270px;
			}
			body.woocommerce .has-one-sidebar ul.products li.product, body.woocommerce .has-one-sidebar .upsells.products ul.products li.product {
				width: 270px;
			}
			body.woocommerce .has-both-sidebars ul.products li.product, body.woocommerce .has-both-sidebars ul.products li.product {
				width: 270px;
			}

			/* WIDGETS */
			.caroufredsel_wrapper {
				margin-left: -30px!important;
			}
			.spb_portfolio_carousel_widget.span12 .caroufredsel_wrapper {
				min-width: 1200px;
			}
			'."\n";
		}

		// CUSTOM FONT STYLES
		echo '/*========== Web Font Styles ==========*/'."\n";
		echo 'body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h4, #comments-list > h3, .item-heading h1, .sf-button, button, input[type="submit"], input[type="email"], input[type="reset"], input[type="button"], .spb_accordion_section h3, #header-login input, #mobile-navigation > div, .search-form input, input, button, select, textarea {font-family: "'.$standard_font.'", Palatino, Arial, Helvetica, Tahoma, sans-serif;}'. "\n";
		echo 'h1, h2, h3, h4, h5, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .spb_call_text, .impact-text, .testimonial-text, .header-advert {font-family: "'.$heading_font.'", Palatino, Arial, Helvetica, Tahoma, sans-serif;}'. "\n";
		echo 'nav .menu li {font-family: "'.$menu_font.'", Palatino, Arial Helvetica, Tahoma, sans-serif;}'. "\n";
		echo 'body, p, .masonry-items .blog-item .quote-excerpt, #commentform label, .contact-form label {font-size: '.$body_font_size.'px;line-height: '.$body_font_line_height.'px;}'. "\n";
		echo 'h1, .spb_impact_text .spb_call_text, .impact-text {font-size: '.$h1_font_size.'px;line-height: '.$h1_font_line_height.'px;}'. "\n";
		echo 'h2 {font-size: '.$h2_font_size.'px;line-height: '.$h2_font_line_height.'px;}'. "\n";
		echo 'h3 {font-size: '.$h3_font_size.'px;line-height: '.$h3_font_line_height.'px;}'. "\n";
		echo 'h4, .body-content.quote, #respond-wrap h3 {font-size: '.$h4_font_size.'px;line-height: '.$h4_font_line_height.'px;}'. "\n";
		echo 'h5 {font-size: '.$h5_font_size.'px;line-height: '.$h5_font_line_height.'px;}'. "\n";
		echo 'h6 {font-size: '.$h6_font_size.'px;line-height: '.$h6_font_line_height.'px;}'. "\n";
		echo 'nav .menu li {font-size: '.$menu_font_size.'px;}'. "\n";

		// CUSTOM COLOUR STYLES
		echo "\n".'/*========== Accent Styles ==========*/'."\n";
		echo '::selection, ::-moz-selection {background-color: '.$accent_color.'; color: #fff;}'. "\n";
		echo 'span.highlighted, span.dropcap4, .loved-item:hover .loved-count, .flickr-widget li, .portfolio-grid li, .wpcf7 input.wpcf7-submit[type="submit"], .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li span.current, figcaption .product-added, .woocommerce .wc-new-badge, .yith-wcwl-wishlistexistsbrowse a, .yith-wcwl-wishlistaddedbrowse a, .woocommerce .widget_layered_nav ul li.chosen > *, .woocommerce .widget_layered_nav_filters ul li a {background-color: '.$accent_color.'!important; color: '.$accent_alt_color.';}'. "\n";
		echo '.sf-button.accent {background-color: '.$accent_color.'!important;}'. "\n";
		echo 'a:hover, #sidebar a:hover, .pagination-wrap a:hover, .carousel-nav a:hover, .portfolio-pagination div:hover > i, #footer a:hover, #copyright a, .beam-me-up a:hover span, .portfolio-item .portfolio-item-permalink, .read-more-link, .blog-item .read-more, .blog-item-details a, .author-link, .comment-meta .edit-link a, .comment-meta .comment-reply a, #reply-title small a, ul.member-contact, ul.member-contact li a, #respond .form-submit input:hover, span.dropcap2, .spb_divider.go_to_top a, love-it-wrapper:hover .love-it, .love-it-wrapper:hover span, .love-it-wrapper .loved, .comments-likes a:hover i, .comments-likes .love-it-wrapper:hover a i, .comments-likes a:hover span, .love-it-wrapper:hover a i, .item-link:hover, #header-translation p a, #swift-slider .flex-caption-large h1 a:hover, .wooslider .slide-title a:hover, .caption-details-inner .details span > a, .caption-details-inner .chart span, .caption-details-inner .chart i, #swift-slider .flex-caption-large .chart i, #breadcrumbs a:hover, .ui-widget-content a:hover, .woocommerce form.cart button.single_add_to_cart_button:hover, .yith-wcwl-add-button a:hover, #product-img-slider li a.zoom:hover, .woocommerce .star-rating span, .mobile-search-link.active, .woocommerce div.product form.cart .button.add_to_cart_button {color: '.$accent_color.';}'. "\n";
		echo '.carousel-wrap > a:hover, .ajax-search-results .all-results:hover, .search-result h5 a:hover {color: '.$accent_color.'!important;}'. "\n";
		echo '.comments-likes a:hover span, .comments-likes a:hover i {color: '.$accent_color.'!important;}'. "\n";
		echo '.read-more i:before, .read-more em:before {color: '.$accent_color.';}'. "\n";
		echo '.bypostauthor .comment-wrap .comment-avatar,.search-form input:focus,.wpcf7 input[type="text"]:focus,.wpcf7 textarea:focus {border-color: '.$accent_color.'!important;}'. "\n";
		echo 'nav .menu ul li:first-child:after,.navigation a:hover > .nav-text {border-bottom-color: '.$accent_color.';}'. "\n";
		echo 'nav .menu ul ul li:first-child:after {border-right-color: '.$accent_color.';}'. "\n";
		echo '.spb_impact_text .spb_button span {color: #fff;}'. "\n";
		echo 'article.type-post #respond .form-submit input#submit {background-color: '.$secondary_accent_color.';}'. "\n";
		echo '.woocommerce .free-badge {background-color: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}'. "\n";

		// MAIN STYLES
		echo "\n".'/*========== Main Styles ==========*/'."\n";
		echo 'body {color: '.$body_text_color.';}'. "\n";
		echo '.pagination-wrap a, .search-pagination a {color: '.$body_text_color.';}'. "\n";
		if ($body_bg_use_image) {
			if ($body_upload_bg) {
				echo 'body {background: '.$page_bg_color.' url('.$body_upload_bg.') repeat center top fixed;}'. "\n";
			} else if ($body_preset_bg) {
				echo 'body {background: '.$page_bg_color.' url('.$body_preset_bg.') repeat center top fixed;}'. "\n";
			}
			echo 'body {background-size: '.$bg_size.';}'. "\n";
		} else {
			echo 'body {background-color: '.$page_bg_color.';}'. "\n";
		}
		echo '#main-container, .tm-toggle-button-wrap a {background-color: '.$inner_page_bg_color.';}'. "\n";
		echo 'a, .ui-widget-content a {color: '.$link_text_color.';}'. "\n";
		echo '.pagination-wrap li span.current, .pagination-wrap li a:hover {color: '.$accent_alt_color.';background: '.$accent_color.';border-color: '.$accent_color.';}'. "\n";
		echo '.pagination-wrap li a, .pagination-wrap li span.expand {color: '.$body_text_color.';border-color: '.$section_divide_color.';}'. "\n";
		echo '.pagination-wrap li a, .pagination-wrap li span {background-color: '.$inner_page_bg_color.';}'. "\n";
		echo 'input[type="text"], input[type="password"], input[type="email"], textarea, select {border-color: '.$section_divide_color.';background: '.$alt_bg_color.';}'. "\n";
		echo 'textarea:focus, input:focus {border-color: #999!important;}'. "\n";
		echo '.modal-header {background: '.$alt_bg_color.';}'. "\n";

		// HEADER STYLES
		echo "\n".'/*========== Header Styles ==========*/'."\n";
		if ($logo_height != 0) {
			echo '#logo > a.logo-link {height: '.$logo_height.'px;}';
		}
		if ($logo_padding != 0) {
			echo '#header-section.header-1 #header {padding: '.$logo_padding.'px 0;}';
		}
		if ($header_height != 0) {
			echo '#header-section.header-4 #header nav#main-navigation ul.menu > li, #header-section.header-5 #header nav#main-navigation ul.menu > li, #header-section.header-4 .header-right nav ul.menu > li, #header-section.header-5 .header-left nav ul.menu > li {line-height: '.$header_height.'px;}';
			echo '#header-section.header-4 #logo > a.logo-link, #header-section.header-5 #logo > a.logo-link {height: '.$header_height.'px;}';
		} else {
			echo '#header-section.header-4 #header, #header-section.header-5 #header {padding: 35px 0;}';
		}
		echo '.sf-super-search {background-color: ' . $secondary_accent_color . ';}';
		echo '.sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input {color: ' . $accent_color . '; border-bottom-color: ' . $accent_color . ';}';
		echo '.sf-super-search .search-options .ss-dropdown ul li .fa-check {color: ' . $accent_color . ';}';
		echo '.sf-super-search-go:hover, .sf-super-search-close:hover { background-color: ' . $accent_color . '; border-color: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
		echo '#top-bar {background: '.$topbar_bg_color.'; color: '.$topbar_text_color.';}'. "\n";
		echo '#top-bar .tb-welcome {border-color: '.$topbar_divider_color.';}'. "\n";
		echo '#top-bar a {color: '.$topbar_link_color.';}'. "\n";
		echo '#top-bar .menu li {border-left-color: '.$topbar_divider_color.'; border-right-color: '.$topbar_divider_color.';}'. "\n";
		echo '#top-bar .menu > li > a, #top-bar .menu > li.parent:after {color: '.$topbar_link_color.';}'. "\n";
		echo '#top-bar .menu > li > a:hover, #top-bar a:hover {color: '.$topbar_link_hover_color.';}'. "\n";
		echo '#top-bar .show-menu {background-color: '.$topbar_divider_color.';color: '.$secondary_accent_color.';}'. "\n";
		echo '.header-languages .current-language {background: '.$nav_sm_bg_hover_color.'; color: '.$nav_sm_selected_text_color.';}'. "\n";
		echo '#header-section:before, #mini-header {background-color: '.$header_bg_color1.';background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$header_bg_color2.'), to('.$header_bg_color1.'));background: -webkit-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -moz-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -ms-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -o-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');}'. "\n";
		if ($logo_width > 0) {
		echo '#logo img, #logo img.retina {width: '.$logo_width.'px;}'. "\n";
		}
		if ( $logo_height > 40) {
			echo '#logo img {height: '.$logo_height.'px;}'. "\n";
		} else {
			echo '#logo img {height: auto;}'. "\n";
		}
		if ($header_opacity != "100") {
		echo '#header-section:before {opacity: 0.'.$header_opacity.';}'. "\n";
		}
		if (!$header_overlay) {
		echo '#header-section:before {opacity: 1;}'. "\n";
		}
		echo '#header-section .header-menu .menu li, #mini-header .header-right nav .menu li {border-left-color: '.$section_divide_color.';}'. "\n";
		echo '#header-section > #main-nav {border-top-color: '.$section_divide_color.';}'. "\n";
		echo '.page-content {border-bottom-color: '.$section_divide_color.';}'. "\n";

		// NAVIGATION STYLES
		echo "\n".'/*========== Navigation Styles ==========*/'."\n";
		echo '#nav-pointer {background-color: '.$nav_pointer_color.';}'. "\n";
		echo '.show-menu {background-color: '.$secondary_accent_color.';color: '.$secondary_accent_alt_color.';}'. "\n";
		echo 'nav .menu > li:before {background: '.$nav_pointer_color.';}'. "\n";
		echo 'nav .menu .sub-menu .parent > a:after {border-left-color: '.$nav_pointer_color.';}'. "\n";
		echo 'nav .menu ul.sub-menu {background-color: '.$nav_sm_bg_color.';}'. "\n";
		echo 'nav .menu ul.sub-menu li {border-bottom-color: '.$nav_divider_color.';border-bottom-style: '.$nav_divider.';}'. "\n";
		echo 'li.menu-item.sf-mega-menu > ul.sub-menu > li {border-color: '.$nav_divider_color.';border-style: '.$nav_divider.';}'. "\n";
		echo 'nav .menu > li a, #menubar-controls a {color: '.$nav_text_color.';}'. "\n";
		echo 'nav .menu > li:hover > a {color: '.$nav_text_hover_color.';}'. "\n";
		echo 'nav .menu ul.sub-menu li > a, #top-bar nav .menu ul li > a {color: '.$nav_sm_text_color.';}'. "\n";
		echo 'nav .menu ul.sub-menu li:hover > a {color: '.$nav_sm_text_hover_color.'!important; background: '.$nav_sm_bg_hover_color.';}'. "\n";
		echo 'nav .menu li.parent > a:after, nav .menu li.parent > a:after:hover {color: #aaa;}'. "\n";
		echo 'nav .menu li.current-menu-ancestor > a, nav .menu li.current-menu-item > a {color: '.$nav_selected_text_color.';}'. "\n";
		echo 'nav .menu ul li.current-menu-ancestor > a, nav .menu ul li.current-menu-item > a {color: '.$nav_sm_selected_text_color.'; background: '.$nav_sm_bg_hover_color.';}'. "\n";
		echo '#main-nav .header-right ul.menu > li, .wishlist-item, .header-right .menu-search, .header-left .menu-search {border-left-color: '.$nav_divider_color.';}'. "\n";
		echo '#nav-search, #mini-search {background: '.$topbar_bg_color.';}'. "\n";
		echo '#nav-search a, #mini-search a {color: '.$topbar_text_color.';}'. "\n";
		echo '.bag-header, .bag-product, .bag-empty, .wishlist-empty {border-color: '.$nav_divider_color.';}'. "\n";
		echo '.bag-buttons a {background-color: '.$nav_divider_color.'; color: '.$nav_text_color.';}'. "\n";
		echo '.bag-buttons a.checkout-button, .bag-buttons a.create-account-button, .woocommerce input.button.alt, .woocommerce .alt-button, .woocommerce button.button.alt, .woocommerce .button.checkout-button {background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}'. "\n";
		echo '.bag-buttons a:hover, .woocommerce .button.update-cart-button:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}'. "\n";
		echo '.bag-buttons a.checkout-button:hover, .woocommerce input.button.alt:hover, .woocommerce .alt-button:hover, .woocommerce button.button.alt:hover, .woocommerce .button.checkout-button:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}'. "\n";
		echo 'nav.std-menu ul.menu > li.parent > a:after {border-bottom-color: '.$nav_pointer_color.';}'. "\n";

		// PROMO BAR STYLES
		echo "\n".'/*========== Page Heading Styles ==========*/'."\n";
		echo '#promo-bar {background-color: '.$promo_bar_bg_color.';}'. "\n";
		echo '#promo-bar * {color: '.$promo_bar_text_color.';}'. "\n";

		// PAGE HEADING STYLES
		echo "\n".'/*========== Page Heading Styles ==========*/'."\n";
		echo '.page-heading {background-color: '.$page_heading_bg_color.';border-bottom-color: '.$section_divide_color.';}'. "\n";
		echo '.page-heading h1, .page-heading h3 {color: '.$page_heading_text_color.';}'. "\n";
		echo '#breadcrumbs {background: '.$inner_page_bg_color.';}'. "\n";
		echo '#breadcrumbs {color: '.$breadcrumb_text_color.';}'. "\n";
		echo '#breadcrumbs a, #breadcrumb i {color: '.$breadcrumb_link_color.';}'. "\n";

		// BODY STYLES
		echo "\n".'/*========== Body Styles ==========*/'."\n";
		echo 'body, input[type="text"], input[type="password"], input[type="email"], textarea, select {color: '.$body_text_color.';}'. "\n";
		echo 'h1, h1 a {color: '.$h1_text_color.';}'. "\n";
		echo 'h2, h2 a {color: '.$h2_text_color.';}'. "\n";
		echo 'h3, h3 a {color: '.$h3_text_color.';}'. "\n";
		echo 'h4, h4 a, .carousel-wrap > a {color: '.$h4_text_color.';}'. "\n";
		echo 'h5, h5 a {color: '.$h5_text_color.';}'. "\n";
		echo 'h6, h6 a {color: '.$h6_text_color.';}'. "\n";
		echo '.spb_impact_text .spb_call_text, .impact-text {color: '.$impact_text_color.';}'. "\n";
		echo '.read-more i, .read-more em {color: transparent;}'. "\n";

		// CONTENT STYLES
		echo "\n".'/*========== Content Styles ==========*/'."\n";
		echo '.pb-border-bottom, .pb-border-top {border-color: '.$section_divide_color.';}'. "\n";
		echo '#swift-slider ul.slides {background: '.$secondary_accent_color.';}'. "\n";
		echo '#swift-slider .flex-caption .flex-caption-headline {background: '.$inner_page_bg_color.';}'. "\n";
		echo '#swift-slider .flex-caption .flex-caption-details .caption-details-inner {background: '.$inner_page_bg_color.'; border-bottom: '.$section_divide_color.'}'. "\n";
		echo '#swift-slider .flex-caption-large, #swift-slider .flex-caption-large h1 a {color: '.$secondary_accent_alt_color.';}'. "\n";
		echo '#swift-slider .flex-caption h4 i {line-height: '.$h4_font_line_height.'px;}'. "\n";
		echo '#swift-slider .flex-caption-large .comment-chart i {color: '.$secondary_accent_alt_color.';}'. "\n";
		echo '#swift-slider .flex-caption-large .loveit-chart span {color: '.$accent_color.';}'. "\n";
		echo '#swift-slider .flex-caption-large a {color: '.$accent_color.';}'. "\n";
		echo '#swift-slider .flex-caption .comment-chart i, #swift-slider .flex-caption .comment-chart span {color: '.$secondary_accent_color.';}'. "\n";
		echo 'figure .overlay {background-color: '.$accent_color.';color: #fff;}'. "\n";
		echo '.overlay .thumb-info h4 {color: #fff;}'. "\n";
		echo 'figure:hover .overlay {box-shadow: inset 0 0 0 500px '.$accent_color.';}'. "\n";
		echo 'h4.spb_heading span, h4.lined-heading span {background: '.$inner_page_bg_color.'}'. "\n";
		echo '.spb_parallax_asset h4.spb_heading {border-bottom-color: '.$h4_text_color.'}'. "\n";
		echo '.carousel-wrap a.carousel-prev, .carousel-wrap a.carousel-next {background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.'!important;}'. "\n";
		echo '.carousel-wrap a.carousel-prev:hover, .carousel-wrap a.carousel-next:hover {color: '.$accent_color.'!important;}'. "\n";

		// SIDEBAR STYLES
		echo "\n".'/*========== Sidebar Styles ==========*/'."\n";
		echo '.sidebar .widget-heading h4 {color: '.$h4_text_color.';}'. "\n";
		echo '.sidebar .widget-heading h4 span {background: '.$inner_page_bg_color.';}'. "\n";
		echo '.widget ul li {border-color: '.$section_divide_color.';}'. "\n";
		echo '.widget_search form input {background: '.$alt_bg_color.';}'. "\n";
		echo '.widget .wp-tag-cloud li a {border-color: '.$section_divide_color.';}'. "\n";
		echo '.widget .tagcloud a:hover, .widget ul.wp-tag-cloud li:hover > a {background: '.$accent_color.'; color: '.$accent_alt_color.';}'. "\n";
		echo '.loved-item .loved-count {color: '.$secondary_accent_alt_color .';background: '.$secondary_accent_color.';}'. "\n";
		echo '.subscribers-list li > a.social-circle {color: '.$secondary_accent_alt_color.';background: '.$secondary_accent_color.';}'. "\n";
		echo '.subscribers-list li:hover > a.social-circle {color: #fbfbfb;background: '.$accent_color.';}'. "\n";
		echo '.sidebar .widget_categories ul > li a, .sidebar .widget_archive ul > li a, .sidebar .widget_nav_menu ul > li a, .sidebar .widget_meta ul > li a, .sidebar .widget_recent_entries ul > li, .widget_product_categories ul > li a, .widget_layered_nav ul > li a {color: '.$link_text_color.';}'. "\n";
		echo '.sidebar .widget_categories ul > li a:hover, .sidebar .widget_archive ul > li a:hover, .sidebar .widget_nav_menu ul > li a:hover, .widget_nav_menu ul > li.current-menu-item a, .sidebar .widget_meta ul > li a:hover, .sidebar .widget_recent_entries ul > li a:hover, .widget_product_categories ul > li a:hover, .widget_layered_nav ul > li a:hover {color: '.$accent_color.';}'. "\n";
		echo '#calendar_wrap caption {border-bottom-color: '.$secondary_accent_color.';}'. "\n";
		echo '.sidebar .widget_calendar tbody tr > td a {color: '.$secondary_accent_alt_color.';background-color: '.$secondary_accent_color.';}'. "\n";
		echo '.sidebar .widget_calendar tbody tr > td a:hover {background-color: '.$accent_color.';}'. "\n";
		echo '.sidebar .widget_calendar tfoot a {color: '.$secondary_accent_color.';}'. "\n";
		echo '.sidebar .widget_calendar tfoot a:hover {color: '.$accent_color.';}'. "\n";
		echo '.widget_calendar #calendar_wrap, .widget_calendar th, .widget_calendar tbody tr > td, .widget_calendar tbody tr > td.pad {border-color: '.$section_divide_color.';}'. "\n";
		echo '.widget_sf_infocus_widget .infocus-item h5 a {color: '.$secondary_accent_color.';}'. "\n";
		echo '.widget_sf_infocus_widget .infocus-item h5 a:hover {color: '.$accent_color.';}'. "\n";
		echo '.sidebar .widget hr {border-color: '.$section_divide_color.';}'. "\n";

		// PORTFOLIO STYLES
		echo "\n".'/*========== Portfolio Styles ==========*/'."\n";
		echo '.filter-wrap .select:after {background: '.$inner_page_bg_color.';}'. "\n";
		echo '.filter-wrap ul li a {color: '.$body_text_color.'; background: '.$alt_bg_color.';}'. "\n";
		echo '.filter-wrap ul li a:hover {color: '.$accent_color.';}'. "\n";
		echo '.filter-wrap ul li.selected a {color: '.$accent_alt_color.';background: '.$accent_color.';}'. "\n";
		echo '.portfolio-item {border-bottom-color: '.$section_divide_color.';}'. "\n";
		echo '.masonry-items .portfolio-item-details {border-color: '.$section_divide_color.';background: '.$alt_bg_color.';}'. "\n";
		echo '.spb_portfolio_carousel_widget .portfolio-item {background: '.$inner_page_bg_color.';}'. "\n";
		echo '.spb_portfolio_carousel_widget .portfolio-item h4.portfolio-item-title a > i {line-height: '.$h4_font_line_height.'px;}'. "\n";
		echo '.masonry-items .blog-item .blog-details-wrap:before {background-color: '.$alt_bg_color.';}'. "\n";
		echo '.masonry-items .portfolio-item figure {border-color: '.$section_divide_color.';}'. "\n";
		echo '.portfolio-details-wrap span span {color: #666;}'. "\n";
		echo '.share-links > a:hover {color: '.$accent_color.';}'. "\n";

		// BLOG STYLES
		echo "\n".'/*========== Blog Styles ==========*/'."\n";
		echo '.blog-aux-options li a, .blog-aux-options li form input {background: '.$alt_bg_color.';}'. "\n";
		echo '.blog-aux-options li.selected a {background: '.$accent_color.';color: '.$accent_alt_color.';}'. "\n";
		echo '.blog-filter-wrap .aux-list li:hover {border-bottom-color: transparent;}'. "\n";
		echo '.blog-filter-wrap .aux-list li:hover a {color: '.$accent_alt_color.';background: '.$accent_color.';}'. "\n";
		echo '.blog-item {border-color: '.$section_divide_color.';}'. "\n";
		echo '.standard-post-details .standard-post-author {border-color: '.$section_divide_color.';}'. "\n";
		echo '.masonry-items .blog-item {background: '.$alt_bg_color.';}'. "\n";
		echo '.mini-items .blog-item-details, .author-info-wrap, .related-wrap, .tags-link-wrap, .comment .comment-wrap, .share-links, .single-portfolio .share-links, .single .pagination-wrap {border-color: '.$section_divide_color.';}'. "\n";
		echo '.related-wrap h4, #comments-list h4, #respond-wrap h3 {border-bottom-color: '.$h4_text_color.';}'. "\n";
		echo '.related-item figure {background-color: '.$secondary_accent_color.';}'. "\n";
		echo '.search-item-img .img-holder {background: '.$alt_bg_color.';border-color:'.$section_divide_color.';}';
		echo '.required {color: #ee3c59;}'. "\n";
		echo 'article.type-post #respond .form-submit input#submit {color: #fff;}'. "\n";
		echo '.comments-likes a i, .comments-likes a span, .comments-likes .love-it-wrapper a i {color: '.$body_text_color.';}'. "\n";
		echo '#respond .form-submit input:hover {color: #fff!important;}'. "\n";
		echo '.recent-post {background: '.$inner_page_bg_color.';}'. "\n";
		echo '.recent-post .post-item-details {border-top-color: '.$section_divide_color.';color: '.$section_divide_color.';}'. "\n";
		echo '.post-item-details span, .post-item-details a, .post-item-details .comments-likes a i, .post-item-details .comments-likes a span {color: #999;}'. "\n";

		// SHORTCODE STYLES
		echo "\n".'/*========== Shortcode Styles ==========*/'."\n";
		echo '.sf-button.accent {color: #fff;}'. "\n";
		echo 'a.sf-button:hover, #footer a.sf-button:hover {background-image: none;color: #fff!important;}'. "\n";
		echo 'a.sf-button.green:hover, a.sf-button.lightgrey:hover, a.sf-button.limegreen:hover {color: #111!important;}'. "\n";
		echo 'a.sf-button.white:hover {color: '.$accent_color.'!important;}'. "\n";
		echo '.wpcf7 input.wpcf7-submit[type="submit"] {color: #fff;}'. "\n";
		echo '.sf-icon {color: '.$icon_color.';}'. "\n";
		echo '.sf-icon-cont {background-color: '.$icon_container_bg_color.';}'. "\n";
		echo 'span.dropcap3 {background: #000;color: #fff;}'. "\n";
		echo 'span.dropcap4 {color: #fff;}'. "\n";
		echo '.spb_divider, .spb_divider.go_to_top_icon1, .spb_divider.go_to_top_icon2, .testimonials > li, .jobs > li, .spb_impact_text, .tm-toggle-button-wrap, .tm-toggle-button-wrap a, .portfolio-details-wrap, .spb_divider.go_to_top a {border-color: '.$section_divide_color.';}'. "\n";
		echo '.spb_divider.go_to_top_icon1 a, .spb_divider.go_to_top_icon2 a {background: '.$inner_page_bg_color.';}'. "\n";
		echo '.spb_tabs .ui-tabs .ui-tabs-panel, .spb_content_element .ui-tabs .ui-tabs-nav, .ui-tabs .ui-tabs-nav li {border-color: '.$section_divide_color.';}'. "\n";
		echo '.spb_accordion_section, .spb_tabs .ui-tabs .ui-tabs-panel, .spb_accordion .spb_accordion_section, .spb_accordion_section .ui-accordion-content, .spb_accordion .spb_accordion_section > h3.ui-state-active a, .ui-tabs .ui-tabs-nav li.ui-tabs-active a {background: '.$inner_page_bg_color.'!important;}'. "\n";
		echo '.spb_tabs .nav-tabs li a {border-color: '.$section_divide_color.';}'. "\n";
		echo '.spb_tabs .nav-tabs li.active a {border-bottom-color: transparent;}'. "\n";
		echo '.spb_tour .ui-tabs .ui-tabs-nav li a {border-color: '.$section_divide_color.';}'. "\n";
		echo '.spb_tour.span3 .ui-tabs .ui-tabs-nav li {border-color: '.$section_divide_color.'!important;}'. "\n";
		echo '.ui-accordion h3.ui-accordion-header .ui-icon {color: '.$body_text_color.';}'. "\n";
		echo '.ui-accordion h3.ui-accordion-header.ui-state-active .ui-icon, .ui-accordion h3.ui-accordion-header.ui-state-active:hover .ui-icon {color: '.$accent_color.';}'. "\n";
		echo 'blockquote.pullquote {border-color: '.$section_divide_color.';}'. "\n";
		echo '.borderframe img {border-color: #eeeeee;}'. "\n";
		echo '.labelled-pricing-table .column-highlight {background-color: #fff;}'. "\n";
		echo '.labelled-pricing-table .pricing-table-label-row, .labelled-pricing-table .pricing-table-row {background: '.$lpt_secondary_row_color.';}'. "\n";
		echo '.labelled-pricing-table .alt-row {background: '.$lpt_primary_row_color.';}'. "\n";
		echo '.labelled-pricing-table .pricing-table-price {background: '.$lpt_default_pricing_header.';}'. "\n";
		echo '.labelled-pricing-table .pricing-table-package {background: '.$lpt_default_package_header.';}'. "\n";
		echo '.labelled-pricing-table .lpt-button-wrap {background: '.$lpt_default_footer.';}'. "\n";
		echo '.labelled-pricing-table .lpt-button-wrap a.accent {background: #222!important;}'. "\n";
		echo '.labelled-pricing-table .column-highlight .lpt-button-wrap {background: transparent!important;}'. "\n";
		echo '.labelled-pricing-table .column-highlight .lpt-button-wrap a.accent {background: '.$accent_color.'!important;}'. "\n";
		echo '.column-highlight .pricing-table-price {color: #fff;background: '.$pt_primary_bg_color.';border-bottom-color: '.$pt_primary_bg_color.';}'. "\n";
		echo '.column-highlight .pricing-table-package {background: '.$pt_secondary_bg_color.';}'. "\n";
		echo '.column-highlight .pricing-table-details {background: '.$pt_tertiary_bg_color.';}'. "\n";
		echo '.spb_box_text.coloured .box-content-wrap {background: '.$boxed_content_color.';color: #fff;}'. "\n";
		echo '.spb_box_text.whitestroke .box-content-wrap {background-color: #fff;border-color: '.$section_divide_color.';}'. "\n";
		echo '.client-item figure {border-color: '.$section_divide_color.';}'. "\n";
		echo '.client-item figure:hover {border-color: #333;}'. "\n";
		echo 'ul.member-contact li a:hover {color: #333;}'. "\n";
		echo '.testimonials.carousel-items li {border-color: '.$section_divide_color.';}'. "\n";
		echo '.testimonials.carousel-items li:after {border-left-color: '.$section_divide_color.';border-top-color: '.$section_divide_color.';}'. "\n";
		echo '.team-member .team-member-bio {border-bottom-color: '.$section_divide_color.';}'. "\n";
		echo '.horizontal-break {background-color: '.$section_divide_color.';}'. "\n";
		echo '.progress .bar {background-color: '.$accent_color.';}'. "\n";
		echo '.progress.standard .bar {background: '.$accent_color.';}'. "\n";

		// FOOTER STYLES
		echo "\n".'/*========== Footer Styles ==========*/'."\n";
		echo '#footer {background: '.$footer_bg_color.';}'. "\n";
		echo '#footer, #footer p {color: '.$footer_text_color.';}'. "\n";
		echo '#footer h4 {color: '.$footer_text_color.';}'. "\n";
		echo '#footer h4:before {border-color: '.$footer_border_color.';}'. "\n";
		echo '#footer h4 span {background: '.$footer_bg_color.';}'. "\n";
		echo '#footer a {color: '.$footer_text_color.';}'. "\n";
		echo '#footer .widget ul li, #footer .widget_categories ul, #footer .widget_archive ul, #footer .widget_nav_menu ul, #footer .widget_recent_comments ul, #footer .widget_meta ul, #footer .widget_recent_entries ul, #footer .widget_product_categories ul {border-color: '.$footer_border_color.';}'. "\n";
		echo '#copyright {background-color: '.$copyright_bg_color.';border-top-color: '.$footer_border_color.';}'. "\n";
		echo '#copyright p {color: '.$copyright_text_color.';}'. "\n";
		echo '#copyright a {color: '.$copyright_link_color.';}'. "\n";
		echo '#copyright a:hover {color: '.$accent_color.';}'. "\n";
		echo '#footer .widget_calendar #calendar_wrap, #footer .widget_calendar th, #footer .widget_calendar tbody tr > td, #footer .widget_calendar tbody tr > td.pad {border-color: '.$footer_border_color.';}'. "\n";
		echo '.widget input[type="email"] {background: #f7f7f7; color: #999}'. "\n";
		echo '#footer .widget hr {border-color: '.$footer_border_color.';}'. "\n";

		// WOOCOMMERCE STYLES
		echo "\n".'/*========== WooCommerce Styles ==========*/'."\n";
		echo '.woocommerce nav.woocommerce-pagination, .woocommerce #content nav.woocommerce-pagination, .woocommerce-page nav.woocommerce-pagination, .woocommerce-page #content nav.woocommerce-pagination, .modal-body .comment-form-rating, .woocommerce form .form-row input.input-text, ul.checkout-process, #billing .proceed, ul.my-account-nav > li, .woocommerce #payment, .woocommerce-checkout p.thank-you, .woocommerce .order_details, .woocommerce-page .order_details, .review-order-wrap { border-color: '.$section_divide_color.' ;}'. "\n";
		echo '.woocommerce-account p.myaccount_address, .woocommerce-account .page-content h2, p.no-items, #payment_heading {border-bottom-color: '.$section_divide_color.';}'. "\n";
		echo '.woocommerce-MyAccount-navigation li {border-color: '.$section_divide_color.';}';
		echo '.woocommerce-MyAccount-navigation li.is-active a, .woocommerce-MyAccount-navigation li a:hover {color: '.$body_text_color.';}';
		echo '.woocommerce .products ul, .woocommerce ul.products, .woocommerce-page .products ul, .woocommerce-page ul.products, p.no-items {border-top-color: '.$section_divide_color.';}'. "\n";
		echo '.woocommerce-ordering .woo-select, .variations_form .woo-select, .add_review a, .woocommerce .quantity, .woocommerce-page .quantity, .woocommerce .coupon input.apply-coupon, .woocommerce table.shop_table tr td.product-remove .remove, .woocommerce .button.update-cart-button, .shipping-calculator-form .woo-select, .woocommerce .shipping-calc-wrap button[name="calc_shipping"], .woocommerce #billing_country_field .woo-select, .woocommerce #shipping_country_field .woo-select, .woocommerce #review_form #respond .form-submit input, .woocommerce form .form-row input.input-text, .woocommerce table.my_account_orders .order-actions .button, .woocommerce #payment div.payment_box, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce.widget .buttons a, .woocommerce input[name="apply_coupon"], .woocommerce .cart input[name="update_cart"], .woocommerce-cart .wc-proceed-to-checkout a.checkout-button {background: '.$alt_bg_color.'; color: '.$secondary_accent_color.'}'. "\n";
		echo '.woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li span.current { color: '.$accent_alt_color.';}'. "\n";
		echo 'li.product figcaption a.product-added {color: '.$accent_alt_color.';}'. "\n";
		echo '.woocommerce ul.products li.product figure figcaption .shop-actions > a, .woocommerce ul.products li.product figure figcaption .shop-actions > a.product-added:hover {color: '.$secondary_accent_alt_color.';}'. "\n";
		echo '.woocommerce ul.products li.product figure figcaption .shop-actions > a:hover, ul.social-icons li a:hover {color: '.$accent_color.';}'. "\n";
		echo '.woocommerce ul.products li.product figure figcaption, .yith-wcwl-add-to-wishlist, .yith-wcwl-add-button a, .woocommerce #account_details .login form p.form-row input[type="submit"], .my-account-login-wrap .login-wrap form.login p.form-row input[type="submit"], .woocommerce .my-account-login-wrap form input[type="submit"], .lost_reset_password p.form-row input[type="submit"], .track_order p.form-row input[type="submit"], .change_password_form p input[type="submit"], .woocommerce .wishlist_table tr td.product-add-to-cart a, .woocommerce input.button[name="save_address"], .woocommerce .woocommerce-message a.button, ul.products li.product a.quick-view-button, #login-form .modal-body form.login p.form-row input[type="submit"], .woocommerce input[name="save_account_details"], .login p.form-row input[type="submit"], #jckqv .cart .single_add_to_cart_button, #jckqv .cart .add_to_cart_button { background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.' ;}'. "\n";
		echo '.woocommerce form.cart button.single_add_to_cart_button, .woocommerce p.cart a.single_add_to_cart_button, ul.products li.product a.quick-view-button, .woocommerce div.product form.cart .button.add_to_cart_button { background: '.$secondary_accent_color.'!important; color: '.$secondary_accent_alt_color.' ;}'. "\n";
		echo '.woocommerce p.cart a.single_add_to_cart_button:hover {background: '.$secondary_accent_color.'; color: '.$accent_color.' ;}'. "\n";
		echo '.woocommerce table.shop_table tr td.product-remove .remove:hover, .woocommerce .coupon input.apply-coupon:hover, .woocommerce .shipping-calc-wrap button[name="calc_shipping"]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .add_review a:hover, .woocommerce #review_form #respond .form-submit input:hover, .lost_reset_password p.form-row input[type="submit"]:hover, .track_order p.form-row input[type="submit"]:hover, .change_password_form p input[type="submit"]:hover, .woocommerce table.my_account_orders .order-actions .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce.widget .buttons a:hover, .woocommerce .wishlist_table tr td.product-add-to-cart a:hover, .woocommerce input.button[name="save_address"]:hover, #login-form .modal-body form.login p.form-row input[type="submit"]:hover, .woocommerce input[name="save_account_details"]:hover, .woocommerce input[name="apply_coupon"]:hover, .woocommerce .cart input[name="update_cart"]:hover, .login p.form-row input[type="submit"]:hover, #jckqv .cart .single_add_to_cart_button:hover, #jckqv .cart .add_to_cart_button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}'. "\n";
		echo '.woocommerce #account_details .login, .woocommerce #account_details .login h4.lined-heading span, .my-account-login-wrap .login-wrap, .my-account-login-wrap .login-wrap h4.lined-heading span, .woocommerce div.product form.cart table div.quantity {background: '.$alt_bg_color.';}'. "\n";
		echo '.woocommerce .help-bar ul li a:hover, .woocommerce .continue-shopping:hover, .woocommerce .address .edit-address:hover, .my_account_orders td.order-number a:hover, .product_meta a.inline:hover { border-bottom-color: '.$accent_color.';}'. "\n";
		echo '.woocommerce .order-info, .woocommerce .order-info mark {background: '.$accent_color.'; color: '.$accent_alt_color.';}'. "\n";
		echo '.woocommerce #payment div.payment_box:after {border-bottom-color: '.$alt_bg_color.';}'. "\n";
		echo '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {background: '.$section_divide_color.';}'. "\n";
		echo '.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range {background: '.$alt_bg_color.';}'. "\n";
		echo '.yith-wcwl-wishlistexistsbrowse a:hover, .yith-wcwl-wishlistaddedbrowse a:hover {color: '.$accent_alt_color.';}'. "\n";
		echo '.woocommerce ul.products li.product .price, .woocommerce div.product p.price {color: '.$body_text_color.';}'. "\n";
		if ($one_page_checkout) {
		echo '.checkout-process, #billing .proceed {display: none;}'. "\n";
		echo '.checkout-pane {display: block!important; margin-top: 40px;}'. "\n";
		echo '#billing {margin-top:80px;}'. "\n";
		}
		if ( $product_imagewidth_override ) {
			$product_summary_width = 98 - $productdetail_imagewidth;
			
			$custom_styles = '@media only screen and (min-width: 768px) {';
			$custom_styles .= '.woocommerce div.product div.images {width: '.$productdetail_imagewidth.'%;}';
			$custom_styles .= '.woocommerce div.product div.summary {width: '.$product_summary_width.'%;}';
			$custom_styles .= '}';
			echo $custom_styles;
		}

		// ASSET BACKGROUND STYLES
		echo "\n".'/*========== Asset Background Styles ==========*/'."\n";
		echo '.asset-bg {border-color: '.$section_divide_color.';}'. "\n";
		echo '.asset-bg.alt-one {background-color: '.$alt_one_bg_color.';}'. "\n";
		if (isset($options['alt_one_bg_image']) && $alt_one_bg_image != "") {
			if ($alt_one_bg_image_size == "cover") {
				echo '.asset-bg.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-one, .asset-bg.alt-one h1, .asset-bg.alt-one h2, .asset-bg.alt-one h3, .asset-bg.alt-one h3, .asset-bg.alt-one h4, .asset-bg.alt-one h5, .asset-bg.alt-one h6, .alt-one .carousel-wrap > a {color: '.$alt_one_text_color.';}'. "\n";
		echo '.alt-one.full-width-text:after {border-top-color:'.$alt_one_bg_color.';}'. "\n";
		echo '.alt-one h4.spb_text_heading {border-bottom-color:'.$alt_one_text_color.';}'. "\n";
		echo '.alt-one h4.spb_heading:before {border-top-color:'.$alt_one_text_color.';}'. "\n";
		echo '.asset-bg.alt-two {background-color: '.$alt_two_bg_color.';}'. "\n";
		if (isset($options['alt_two_bg_image']) && $alt_two_bg_image != "") {
			if ($alt_two_bg_image_size == "cover") {
				echo '.asset-bg.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-two, .asset-bg.alt-two h1, .asset-bg.alt-two h2, .asset-bg.alt-two h3, .asset-bg.alt-two h3, .asset-bg.alt-two h4, .asset-bg.alt-two h5, .asset-bg.alt-two h6, .alt-two .carousel-wrap > a {color: '.$alt_two_text_color.';}'. "\n";
		echo '.alt-two.full-width-text:after {border-top-color:'.$alt_two_bg_color.';}'. "\n";
		echo '.alt-two h4.spb_text_heading {border-bottom-color:'.$alt_two_text_color.';}'. "\n";
		echo '.alt-two h4.spb_heading:before {border-top-color:'.$alt_two_text_color.';}'. "\n";
		echo '.asset-bg.alt-three {background-color: '.$alt_three_bg_color.';}'. "\n";
		if (isset($options['alt_three_bg_image']) && $alt_three_bg_image != "") {
			if ($alt_three_bg_image_size == "cover") {
				echo '.asset-bg.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-three, .asset-bg.alt-three h1, .asset-bg.alt-three h2, .asset-bg.alt-three h3, .asset-bg.alt-three h3, .asset-bg.alt-three h4, .asset-bg.alt-three h5, .asset-bg.alt-three h6, .alt-three .carousel-wrap > a {color: '.$alt_three_text_color.';}'. "\n";
		echo '.alt-three.full-width-text:after {border-top-color:'.$alt_three_bg_color.';}'. "\n";
		echo '.alt-three h4.spb_text_heading {border-bottom-color:'.$alt_three_text_color.';}'. "\n";
		echo '.alt-three h4.spb_heading:before {border-top-color:'.$alt_three_text_color.';}'. "\n";
		echo '.asset-bg.alt-four {background-color: '.$alt_four_bg_color.';}'. "\n";
		if (isset($options['alt_four_bg_image']) && $alt_four_bg_image != "") {
			if ($alt_four_bg_image_size == "cover") {
				echo '.asset-bg.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-four, .asset-bg.alt-four h1, .asset-bg.alt-four h2, .asset-bg.alt-four h3, .asset-bg.alt-four h3, .asset-bg.alt-four h4, .asset-bg.alt-four h5, .asset-bg.alt-four h6, .alt-four .carousel-wrap > a {color: '.$alt_four_text_color.';}'. "\n";
		echo '.alt-four.full-width-text:after {border-top-color:'.$alt_four_bg_color.';}'. "\n";
		echo '.alt-four h4.spb_text_heading {border-bottom-color:'.$alt_four_text_color.';}'. "\n";
		echo '.alt-four h4.spb_heading:before {border-top-color:'.$alt_four_text_color.';}'. "\n";
		echo '.asset-bg.alt-five {background-color: '.$alt_five_bg_color.';}'. "\n";
		if (isset($options['alt_five_bg_image']) && $alt_five_bg_image != "") {
			if ($alt_five_bg_image_size == "cover") {
				echo '.asset-bg.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-five, .asset-bg.alt-five h1, .asset-bg.alt-five h2, .asset-bg.alt-five h3, .asset-bg.alt-five h3, .asset-bg.alt-five h4, .asset-bg.alt-five h5, .asset-bg.alt-five h6, .alt-five .carousel-wrap > a {color: '.$alt_five_text_color.';}'. "\n";
		echo '.alt-five.full-width-text:after {border-top-color:'.$alt_five_bg_color.';}'. "\n";
		echo '.alt-five h4.spb_text_heading {border-bottom-color:'.$alt_five_text_color.';}'. "\n";
		echo '.alt-five h4.spb_heading:before {border-top-color:'.$alt_five_text_color.';}'. "\n";
		echo '.asset-bg.alt-six {background-color: '.$alt_six_bg_color.';}'. "\n";
		if (isset($options['alt_six_bg_image']) && $alt_six_bg_image != "") {
			if ($alt_six_bg_image_size == "cover") {
				echo '.asset-bg.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-six, .asset-bg.alt-six h1, .asset-bg.alt-six h2, .asset-bg.alt-six h3, .asset-bg.alt-six h3, .asset-bg.alt-six h4, .asset-bg.alt-six h5, .asset-bg.alt-six h6, .alt-six .carousel-wrap > a {color: '.$alt_six_text_color.';}'. "\n";
		echo '.alt-six.full-width-text:after {border-top-color:'.$alt_six_bg_color.';}'. "\n";
		echo '.alt-six h4.spb_text_heading {border-bottom-color:'.$alt_six_text_color.';}'. "\n";
		echo '.alt-six h4.spb_heading:before {border-top-color:'.$alt_six_text_color.';}'. "\n";
		echo '.asset-bg.alt-seven {background-color: '.$alt_seven_bg_color.';}'. "\n";
		if (isset($options['alt_seven_bg_image']) && $alt_seven_bg_image != "") {
			if ($alt_seven_bg_image_size == "cover") {
				echo '.asset-bg.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-seven, .asset-bg.alt-seven h1, .asset-bg.alt-seven h2, .asset-bg.alt-seven h3, .asset-bg.alt-seven h3, .asset-bg.alt-seven h4, .asset-bg.alt-seven h5, .asset-bg.alt-seven h6, .alt-seven .carousel-wrap > a {color: '.$alt_seven_text_color.';}'. "\n";
		echo '.alt-seven.full-width-text:after {border-top-color:'.$alt_seven_bg_color.';}'. "\n";
		echo '.alt-seven h4.spb_text_heading {border-bottom-color:'.$alt_seven_text_color.';}'. "\n";
		echo '.alt-seven h4.spb_heading:before {border-top-color:'.$alt_seven_text_color.';}'. "\n";
		echo '.asset-bg.alt-eight {background-color: '.$alt_eight_bg_color.';}'. "\n";
		if (isset($options['alt_eight_bg_image']) && $alt_eight_bg_image != "") {
			if ($alt_eight_bg_image_size == "cover") {
				echo '.asset-bg.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-eight, .asset-bg.alt-eight h1, .asset-bg.alt-eight h2, .asset-bg.alt-eight h3, .asset-bg.alt-eight h3, .asset-bg.alt-eight h4, .asset-bg.alt-eight h5, .asset-bg.alt-eight h6, .alt-eight .carousel-wrap > a {color: '.$alt_eight_text_color.';}'. "\n";
		echo '.alt-eight.full-width-text:after {border-top-color:'.$alt_eight_bg_color.';}'. "\n";
		echo '.alt-eight h4.spb_text_heading {border-bottom-color:'.$alt_eight_text_color.';}'. "\n";
		echo '.alt-eight h4.spb_heading:before {border-top-color:'.$alt_eight_text_color.';}'. "\n";
		echo '.asset-bg.alt-nine {background-color: '.$alt_nine_bg_color.';}'. "\n";
		if (isset($options['alt_nine_bg_image']) && $alt_nine_bg_image != "") {
			if ($alt_nine_bg_image_size == "cover") {
				echo '.asset-bg.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-nine, .asset-bg.alt-nine h1, .asset-bg.alt-nine h2, .asset-bg.alt-nine h3, .asset-bg.alt-nine h3, .asset-bg.alt-nine h4, .asset-bg.alt-nine h5, .asset-bg.alt-nine h6, .alt-nine .carousel-wrap > a {color: '.$alt_nine_text_color.';}'. "\n";
		echo '.alt-nine.full-width-text:after {border-top-color:'.$alt_nine_bg_color.';}'. "\n";
		echo '.alt-nine h4.spb_text_heading {border-bottom-color:'.$alt_nine_text_color.';}'. "\n";
		echo '.alt-nine h4.spb_heading:before {border-top-color:'.$alt_nine_text_color.';}'. "\n";
		echo '.asset-bg.alt-ten {background-color: '.$alt_ten_bg_color.';}'. "\n";
		if (isset($options['alt_ten_bg_image']) && $alt_ten_bg_image != "") {
			if ($alt_ten_bg_image_size == "cover") {
				echo '.asset-bg.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
			} else {
				echo '.asset-bg.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}'. "\n";
			}
		}
		echo '.asset-bg.alt-ten, .asset-bg.alt-ten h1, .asset-bg.alt-ten h2, .asset-bg.alt-ten h3, .asset-bg.alt-ten h3, .asset-bg.alt-ten h4, .asset-bg.alt-ten h5, .asset-bg.alt-ten h6, .alt-ten .carousel-wrap > a {color: '.$alt_ten_text_color.';}'. "\n";
		echo '.alt-ten.full-width-text:after {border-top-color:'.$alt_ten_bg_color.';}'. "\n";
		echo '.alt-ten h4.spb_text_heading {border-bottom-color:'.$alt_ten_text_color.';}'. "\n";
		echo '.alt-ten h4.spb_heading:before {border-top-color:'.$alt_ten_text_color.';}'. "\n";

		if ($bg_image_url != "") {
		// PAGE BACKGROUND STYLES
		echo "\n".'/*========== Page Background Styles ==========*/'."\n";
			if ($background_image_size == "cover") {
			echo 'body { background: transparent url("'.$bg_image_url.'") no-repeat center top fixed; background-size: cover; }';
			} else {
			echo 'body { background: transparent url("'.$bg_image_url.'") repeat center top fixed; background-size: auto; }';
			}
		}

		// CUSTOM FONT STYLES
		echo "\n".'/*========== Custom Font Styles ==========*/'."\n";
		if ($body_font_option == "google") {
		echo 'body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h4, #comments-list > h4, .item-heading h1, .sf-button, button, input[type="submit"], input[type="reset"], input[type="button"], input[type="email"], .spb_accordion_section h3, #header-login input, #mobile-navigation > div, .search-form input, input, button, select, textarea {font-family: "'.$google_font_one.'", sans-serif;font-weight: '.$google_font_one_weight.';}'. "\n";
		}
		if ($headings_font_option == "google") {
		echo 'h1, h2, h3, h4, h5, .heading-font, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .spb_call_text, .impact-text, .testimonial-text, .header-advert, .spb_call_text, .impact-text {font-family: "'.$google_font_two.'", sans-serif;font-weight: '.$google_font_two_weight.';}'. "\n";
		}
		if ($menu_font_option == "google") {
		echo 'nav .menu li, nav.std-menu .menu li {font-family: "'.$google_font_three.'", sans-serif;font-weight: '.$google_font_three_weight.';}'. "\n";
		}

		// RESPONSIVE STYLES
		if ($enable_responsive) {
		echo "\n".'/*========== Responsive Coloured Styles ==========*/'."\n";
		echo '@media only screen and (max-width: 767px) {';
		echo '#top-bar nav .menu > li {border-top-color: '.$topbar_divider_color.';}'. "\n";
		echo 'nav .menu > li {border-top-color: '.$section_divide_color.';}'. "\n";
		echo '}'. "\n";
		}

		// USER STYLES
		if ($custom_css) {
		echo "\n".'/*========== User Custom CSS Styles ==========*/'."\n";
		echo $custom_css;
		}

		// CLOSE STYLE TAG
		echo "</style>". "\n";
	}

	add_action('wp_head', 'sf_custom_styles');

?>