<?php
	/*
	*
	*	Theme Styling Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_custom_styles()
	*	sf_custom_script()
	*
	*/


 	/* CUSTOM CSS OUTPUT
 	================================================== */
 	if (!function_exists('sf_custom_styles')) {
		function sf_custom_styles() {
			$options = get_option('sf_dante_options');
			$enable_responsive = $options['enable_responsive'];
			$site_maxwidth = "1170";
			if (isset($options['site_maxwidth']) && $options['site_maxwidth'] == "940") {
			$site_maxwidth = "940";
			}

			// Standard Styling
			$accent_color = get_option('accent_color', '#1dc6df');
			$accent_alt_color = get_option('accent_alt_color', '#ffffff');
			$secondary_accent_color = get_option('secondary_accent_color', '#222222');
			$secondary_accent_alt_color = get_option('secondary_accent_alt_color', '#ffffff');

			// Page Styling
			$page_bg_color = get_option('page_bg_color', '#222222');
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
			$overlay_opacity = 100;
			$hover_overlay_rgb = "";
			if (isset($options['overlay_opacity'])) {
			$overlay_opacity = $options['overlay_opacity'];
			$hover_overlay_rgb = sf_hex2rgb($accent_color);
			}

			// Header Styling
			$header_aux_text_color = get_option('header_aux_text_color', '#fff');
			$topbar_bg_color = get_option('topbar_bg_color', '#1dc6df');
			$topbar_text_color = get_option('topbar_text_color', '#ffffff');
			$topbar_link_color = get_option('topbar_link_color', '#ffffff');
			$topbar_link_hover_color = get_option('topbar_link_hover_color', '#1dc6df');
			$topbar_divider_color = get_option('topbar_divider_color', '#f7f7f7');
			$header_bg_color1 = get_option('header_bg_color1', '#ffffff');
			$header_bg_color2 = get_option('header_bg_color2', '#ffffff');
			$header_border_color = get_option('header_border_color', '#e4e4e4');
			$header_opacity = $options['header_opacity'];
			$header_layout = $options['header_layout'];

			// Navigation Styling
			$nav_text_color = get_option('nav_text_color', '#252525');
			$nav_text_hover_color = get_option('nav_text_hover_color', '#07c1b6');
			$nav_selected_text_color = get_option('nav_selected_text_color', '#1bbeb4');
			$nav_pointer_color = get_option('nav_pointer_color', '#07c1b6');
			$nav_sm_bg_color = get_option('nav_sm_bg_color', '#FFFFFF');
			$nav_sm_text_color = get_option('nav_sm_text_color', '#666666');
			$nav_sm_bg_hover_color = get_option('nav_sm_bg_hover_color', '#f7f7f7');
			$nav_sm_text_hover_color = get_option('nav_sm_text_hover_color', '#000000');
			$nav_sm_selected_text_color = get_option('nav_sm_selected_text_color', '#000000');
			$nav_divider = get_option('nav_divider', 'solid');
			$nav_divider_color = get_option('nav_divider_color', '#f0f0f0');

			// Promo Bar Styling
			$promo_bar_bg_color = get_option('promo_bar_bg_color', '#e4e4e4');
			$promo_bar_text_color = get_option('promo_bar_text_color', '#222');

			// Page Heading Styling
			$breadcrumb_text_color = get_option('breadcrumb_text_color', '#333333');
			$breadcrumb_link_color = get_option('breadcrumb_link_color', '#333333');
			$page_heading_bg_color = get_option('page_heading_bg_color', '#f7f7f7');
			$page_heading_text_color = get_option('page_heading_text_color', '#222222');

			// Body Styling
			$body_text_color = get_option('body_color', '#222222');
			$body_alt_text_color = get_option('body_alt_color', '#222222');
			$link_text_color = get_option('link_color', '#666666');
			$link_hover_color = get_option('link_hover_color', $accent_color);
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
			$lpt_primary_row_color = get_option('lpt_primary_row_color', '#fff');
			$lpt_secondary_row_color = get_option('lpt_secondary_row_color', '#f7f7f7');
			$lpt_default_pricing_header = get_option('lpt_default_pricing_header', '#e4e4e4');
			$lpt_default_package_header = get_option('lpt_default_package_header', '#f7f7f7');
			$lpt_default_footer = get_option('lpt_default_footer', '#e4e4e4');
			$icon_container_bg_color = get_option('icon_container_bg_color', '#1dc6df');
			$icon_container_border_color = sf_hex2rgb($icon_container_bg_color);
			$icon_color = get_option('sf_icon_color', '#1dc6df');
			$icon_alt_color = get_option('sf_icon_alt_color', '#ffffff');
			$boxed_content_color = get_option('boxed_content_color', '#07c1b6');

			// Extra Icon Styling
			$icon_one_color = get_option('icon_one_color', '#FF9900');
			$icon_one_alt_color = get_option('icon_one_alt_color', '#ffffff');
			$icon_two_color = get_option('icon_two_color', '#339933');
			$icon_two_alt_color = get_option('icon_two_alt_color', '#ffffff');
			$icon_three_color = get_option('icon_three_color', '#cccccc');
			$icon_three_alt_color = get_option('icon_three_alt_color', '#222222');
			$icon_four_color = get_option('icon_four_color', '#6633ff');
			$icon_four_alt_color = get_option('icon_four_alt_color', '#ffffff');

			// Footer Styling
			$footer_bg_color = get_option('footer_bg_color', '#222222');
			$footer_text_color = get_option('footer_text_color', '#cccccc');
			$footer_link_color = get_option('footer_link_color', '#71747b');
			$footer_border_color = get_option('footer_border_color', '#333333');
			$copyright_bg_color = get_option('copyright_bg_color', '#222222');
			$copyright_text_color = get_option('copyright_text_color', '#999999');
			$copyright_link_color = get_option('copyright_link_color', '#ffffff');
			$copyright_link_hover_color = get_option('copyright_link_hover_color', '#e4e4e4');

			// Logo/Nav Spacing
			$logo_width = $logo_height = $logo_resized_height = $logo_resized_width = $nav_top_spacing = "";
			$logo_width = $options['logo_width'];
			$logo_spacing_top = $options['logo_top_spacing'];
			$logo_spacing_bottom = $options['logo_bottom_spacing'];
			if (isset($options['logo_height'])) {
			$logo_height = $options['logo_height'];
			}
			if (isset($options['logo_resized_height'])) {
			$logo_resized_height = $options['logo_resized_height'];
			}
			if (isset($options['logo_resized_width'])) {
			$logo_resized_width = $options['logo_resized_width'];
			}
			if (isset($options['nav_top_spacing'])) {
			$nav_top_spacing = $options['nav_top_spacing'];
			}


			// Font
			$body_font_option = $options['body_font_option'];
			$standard_font = $options['web_body_font'];
			$google_standard_font = $google_heading_font = $google_menu_font = $google_font_one = $google_font_one_weight = $google_font_one_style = $google_font_two = $google_font_two_weight = $google_font_two_style = $google_font_three = $google_font_three_weight = $google_font_three_style = $custom_fonts = "";
			if (isset($options['google_standard_font'])) {
				$google_standard_font = explode(':', $options['google_standard_font']);
				$google_font_one = str_replace("+", " ", $google_standard_font[0]);
				if (isset($google_standard_font[1])) {
					$google_font_one_style = strpos($google_standard_font[1],'italic') ? "italic" : "normal";
					$google_font_one_weight = str_replace('italic', '', $google_standard_font[1]);
				}
			}
			$fontdeck_standard_font = $options['fontdeck_standard_font'];
			$headings_font_option = $options['headings_font_option'];
			$heading_font = $options['web_heading_font'];
			if (isset($options['google_heading_font'])) {
				$google_heading_font = explode(':', $options['google_heading_font']);
				$google_font_two = str_replace("+", " ", $google_heading_font[0]);
				if (isset($google_heading_font[1])) {
					$google_font_two_style = strpos($google_heading_font[1],'italic') ? "italic" : "normal";
					$google_font_two_weight = str_replace('italic', '', $google_heading_font[1]);
				}
			}
			$menu_font_option = $menu_font = $fontdeck_menu_font = "";

			$fontdeck_heading_font = $options['fontdeck_heading_font'];
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
					$google_font_three_style = strpos($google_menu_font[1],'italic') ? "italic" : "normal";
					$google_font_three_weight = str_replace('italic', '', $google_menu_font[1]);
				}
			}
			if (isset($options['fontdeck_menu_font'])) {
			$fontdeck_menu_font = $options['fontdeck_menu_font'];
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

			// PAGE BACKGROUND IMAGE //
			$bg_image_url = $inner_bg_image_url = "";
			$page_background_image = rwmb_meta('sf_background_image', 'type=image&size=full');
			$inner_page_background_image = rwmb_meta('sf_inner_background_image', 'type=image&size=full');
			if (is_array($page_background_image)) {
				foreach ($page_background_image as $image) {
					$bg_image_url = $image['url'];
					break;
				}
			}
			if (is_array($inner_page_background_image)) {
				foreach ($inner_page_background_image as $image) {
					$inner_bg_image_url = $image['url'];
					break;
				}
			}

			global $post;
			if ($post) {
			$background_image_size = sf_get_post_meta($post->ID, 'sf_background_image_size', true);
			}

			// Custom CSS
			$custom_css = $options['custom_css'];

			// OPEN STYLE TAG
			echo '<style type="text/css">'. "\n";

			// 940PX OPTION
			if ($site_maxwidth == "940") {
				echo '@media only screen and (min-width: 1200px) {
				.header-overlay .header-wrap {
				margin-left: -485px;
				max-width: 970px;
				}
				#header .is-sticky .sticky-header, .boxed-layout #header-section.header-3 #header .is-sticky .sticky-header, .boxed-layout #header-section.header-4 #header .is-sticky .sticky-header, .boxed-layout #header-section.header-5 #header .is-sticky .sticky-header {
					max-width: 940px;
				}
				nav.mega-menu li .mega .sub, nav.mega-menu li .mega .sub > .row {
					width: 940px!important;
				}
				.container {
				width: 970px;
				}
				.span12 {
				  width: 940px;
				}
				.span11 {
				  width: 860px;
				}
				.span10 {
				  width: 779px;
				}
				.span9 {
				  width: 698px;
				}
				.span8 {
				  width: 617px;
				}
				.span7 {
				  width: 536px;
				}
				.span6 {
				  width: 455px;
				}
				.span5 {
				  width: 374px;
				}
				.span4 {
				  width: 293px;
				}
				.span3 {
				  width: 212px;
				}
				.span2 {
				  width: 131px;
				}
				.span1 {
				  width: 50px;
				}
				.span-third {
					width: 193px;
				}
				.span-twothirds {
					width: 407px;
				}
				.span-bs-quarter {
					width: 100px;
				}
				.span-bs-threequarter {
					width: 340px;
				}

				/* PRODUCTS */
				body .has-no-sidebar ul.products li.product {
					width: 212px;
					float: left;
				}
				body .has-one-sidebar ul.products li.product {
					width: 140px;
				}
				body.woocommerce .has-no-sidebar ul.products li.product, body.woocommerce .has-one-sidebar ul.products li.product {
					width: 212px
				}
				body .has-one-sidebar .products-standard.span8 ul.products li.product {
					width: 193px;
				}
				body .has-both-sidebars ul.products li.product {
					width: 220px;
				}
				body .has-no-sidebar .products-mini ul.products li.product {
					width: 140px;
				}
				body .has-one-sidebar .products-mini ul.products li.product {
					width: 140px;
				}
				body .has-both-sidebars .products-mini ul.products li.product {
					width: 140px;
				}
				body.woocommerce .has-no-sidebar ul.products li.product {
					width: 212px;
				}
				body.woocommerce .has-one-sidebar ul.products li.product {
					width: 219px;
				}
				body.woocommerce .has-both-sidebars ul.products li.product {
					width: 217px;
				}
				}
				';
			}

			// NON-RESPONSIVE STYLES
			if (!$enable_responsive) {
			echo '
				html {
					min-width: 1200px;
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
				  max-width: none!important;
				}
				#header .is-sticky .sticky-header {
				 width: 100%!important;
				 max-width: none!important;
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
				.col-sm-1,
				.col-sm-2,
				.col-sm-3,
				.col-sm-4,
				.col-sm-5,
				.col-sm-6,
				.col-sm-7,
				.col-sm-8,
				.col-sm-9,
				.col-sm-10,
				.col-sm-11 {
				  float: left;
				}
				.col-sm-12 {
				  width: 100%;
				}
				.col-sm-11 {
				  width: 91.66666666666666%;
				}
				.col-sm-10 {
				  width: 83.33333333333334%;
				}
				.col-sm-9 {
				  width: 75%;
				}
				.col-sm-8 {
				  width: 66.66666666666666%;
				}
				.col-sm-7 {
				  width: 58.333333333333336%;
				}
				.col-sm-6 {
				  width: 50%;
				}
				.col-sm-5 {
				  width: 41.66666666666667%;
				}
				.col-sm-4 {
				  width: 33.33333333333333%;
				}
				.col-sm-3 {
				  width: 25%;
				}
				.col-sm-2 {
				  width: 16.666666666666664%;
				}
				.col-sm-1 {
				  width: 8.333333333333332%;
				}
				.col-sm-pull-12 {
				  right: 100%;
				}
				.col-sm-pull-11 {
				  right: 91.66666666666666%;
				}
				.col-sm-pull-10 {
				  right: 83.33333333333334%;
				}
				.col-sm-pull-9 {
				  right: 75%;
				}
				.col-sm-pull-8 {
				  right: 66.66666666666666%;
				}
				.col-sm-pull-7 {
				  right: 58.333333333333336%;
				}
				.col-sm-pull-6 {
				  right: 50%;
				}
				.col-sm-pull-5 {
				  right: 41.66666666666667%;
				}
				.col-sm-pull-4 {
				  right: 33.33333333333333%;
				}
				.col-sm-pull-3 {
				  right: 25%;
				}
				.col-sm-pull-2 {
				  right: 16.666666666666664%;
				}
				.col-sm-pull-1 {
				  right: 8.333333333333332%;
				}
				.col-sm-push-12 {
				  left: 100%;
				}
				.col-sm-push-11 {
				  left: 91.66666666666666%;
				}
				.col-sm-push-10 {
				  left: 83.33333333333334%;
				}
				.col-sm-push-9 {
				  left: 75%;
				}
				.col-sm-push-8 {
				  left: 66.66666666666666%;
				}
				.col-sm-push-7 {
				  left: 58.333333333333336%;
				}
				.col-sm-push-6 {
				  left: 50%;
				}
				.col-sm-push-5 {
				  left: 41.66666666666667%;
				}
				.col-sm-push-4 {
				  left: 33.33333333333333%;
				}
				.col-sm-push-3 {
				  left: 25%;
				}
				.col-sm-push-2 {
				  left: 16.666666666666664%;
				}
				.col-sm-push-1 {
				  left: 8.333333333333332%;
				}
				.col-sm-offset-12 {
				  margin-left: 100%;
				}
				.col-sm-offset-11 {
				  margin-left: 91.66666666666666%;
				}
				.col-sm-offset-10 {
				  margin-left: 83.33333333333334%;
				}
				.col-sm-offset-9 {
				  margin-left: 75%;
				}
				.col-sm-offset-8 {
				  margin-left: 66.66666666666666%;
				}
				.col-sm-offset-7 {
				  margin-left: 58.333333333333336%;
				}
				.col-sm-offset-6 {
				  margin-left: 50%;
				}
				.col-sm-offset-5 {
				  margin-left: 41.66666666666667%;
				}
				.col-sm-offset-4 {
				  margin-left: 33.33333333333333%;
				}
				.col-sm-offset-3 {
				  margin-left: 25%;
				}
				.col-sm-offset-2 {
				  margin-left: 16.666666666666664%;
				}
				.col-sm-offset-1 {
				  margin-left: 8.333333333333332%;
				}
				#container.boxed-layout, .boxed-layout #header-section .is-sticky #main-nav.sticky-header, .boxed-layout #header-section.header-6 .is-sticky #header.sticky-header {
					width: 1230px;
				}
				.header-overlay .header-wrap {
					margin-left: -585px;
				}
				#swift-slider {
					min-width: 1170px;
				}
				.visible-xs, .visible-sm, .visible-xs.visible-sm {
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
					width: 262px;
				}
				body .has-one-sidebar .products-standard.span8 ul.products li.product {
					width: 236px;
				}
				body .has-one-sidebar ul.products li.product {
					width: 170px;
				}
				body .has-both-sidebars ul.products li.product {
					width: 252px;
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
				body.woocommerce .has-no-sidebar ul.products li.product {
					width: 262px;
				}
				body.woocommerce .has-one-sidebar ul.products li.product {
					width: 270px;
				}
				body.woocommerce .has-both-sidebars ul.products li.product, body.woocommerce .has-both-sidebars ul.products li.product {
					width: 252px;
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

			// FONT SIZING
			echo 'body, p, #commentform label, .contact-form label {font-size: '.$body_font_size.'px;line-height: '.$body_font_line_height.'px;}';
			echo 'h1 {font-size: '.$h1_font_size.'px;line-height: '.$h1_font_line_height.'px;}';
			echo 'h2 {font-size: '.$h2_font_size.'px;line-height: '.$h2_font_line_height.'px;}';
			echo 'h3, .blog-item .quote-excerpt {font-size: '.$h3_font_size.'px;line-height: '.$h3_font_line_height.'px;}';
			echo 'h4, .body-content.quote, #respond-wrap h3, #respond h3 {font-size: '.$h4_font_size.'px;line-height: '.$h4_font_line_height.'px;}';
			echo 'h5 {font-size: '.$h5_font_size.'px;line-height: '.$h5_font_line_height.'px;}';
			echo 'h6 {font-size: '.$h6_font_size.'px;line-height: '.$h6_font_line_height.'px;}';
			echo 'nav .menu li {font-size: '.$menu_font_size.'px;}';

			// CUSTOM COLOUR STYLES
			echo '::selection, ::-moz-selection {background-color: '.$accent_color.'; color: #fff;}';
			echo '.recent-post figure, span.highlighted, span.dropcap4, .loved-item:hover .loved-count, .flickr-widget li, .portfolio-grid li, input[type="submit"], .wpcf7 input.wpcf7-submit[type="submit"], .gform_wrapper input[type="submit"], .mymail-form input[type="submit"], .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li span.current, figcaption .product-added, .woocommerce .wc-new-badge, .yith-wcwl-wishlistexistsbrowse a, .yith-wcwl-wishlistaddedbrowse a, .woocommerce .widget_layered_nav ul li.chosen > *, .woocommerce .widget_layered_nav_filters ul li a, .sticky-post-icon, .fw-video-close:hover {background-color: '.$accent_color.'!important; color: '.$accent_alt_color.';}';
			echo 'a:hover, a:focus, #sidebar a:hover, .pagination-wrap a:hover, .carousel-nav a:hover, .portfolio-pagination div:hover > i, #footer a:hover, #copyright a, .beam-me-up a:hover span, .portfolio-item .portfolio-item-permalink, .read-more-link, .blog-item .read-more, .blog-item-details a:hover, .author-link, #reply-title small a, #respond .form-submit input:hover, span.dropcap2, .spb_divider.go_to_top a, love-it-wrapper:hover .love-it, .love-it-wrapper:hover span.love-count, .love-it-wrapper .loved, .comments-likes .loved span.love-count, .comments-likes a:hover i, .comments-likes .love-it-wrapper:hover a i, .comments-likes a:hover span, .love-it-wrapper:hover a i, .item-link:hover, #header-translation p a, #swift-slider .flex-caption-large h1 a:hover, .wooslider .slide-title a:hover, .caption-details-inner .details span > a, .caption-details-inner .chart span, .caption-details-inner .chart i, #swift-slider .flex-caption-large .chart i, #breadcrumbs a:hover, .ui-widget-content a:hover, .yith-wcwl-add-button a:hover, #product-img-slider li a.zoom:hover, .woocommerce .star-rating span, .article-body-wrap .share-links a:hover, ul.member-contact li a:hover, .price ins, .bag-product a.remove:hover, .bag-product-title a:hover, #back-to-top:hover,  ul.member-contact li a:hover, .fw-video-link-image:hover i, .ajax-search-results .all-results:hover, .search-result h5 a:hover .ui-state-default a:hover {color: '.$link_hover_color.';}';
			echo '.carousel-wrap > a:hover, #mobile-menu ul li:hover > a {color: '.$accent_color.'!important;}';
			echo '.comments-likes a:hover span, .comments-likes a:hover i {color: '.$accent_color.'!important;}';
			echo '.read-more i:before, .read-more em:before {color: '.$accent_color.';}';
			echo 'input[type="text"]:focus, input[type="email"]:focus, input[type="tel"]:focus, textarea:focus, .bypostauthor .comment-wrap .comment-avatar,.search-form input:focus, .wpcf7 input:focus, .wpcf7 textarea:focus, .ginput_container input:focus, .ginput_container textarea:focus, .mymail-form input:focus, .mymail-form textarea:focus {border-color: '.$accent_color.'!important;}';
			echo 'nav .menu ul li:first-child:after,.navigation a:hover > .nav-text, .returning-customer a:hover {border-bottom-color: '.$accent_color.';}';
			echo 'nav .menu ul ul li:first-child:after {border-right-color: '.$accent_color.';}';
			echo '.spb_impact_text .spb_call_text {border-left-color: '.$accent_color.';}';
			echo '.spb_impact_text .spb_button span {color: #fff;}';
			echo '#respond .form-submit input#submit {border-color: '.$section_divide_color.';background-color: '.$inner_page_bg_color.';}';
			echo '#respond .form-submit input#submit:hover {border-color: '.$accent_color.';background-color: '.$accent_color.';color: '.$accent_alt_color.';}';
			echo '.woocommerce .free-badge, .my-account-login-wrap .login-wrap form.login p.form-row input[type="submit"], .woocommerce .my-account-login-wrap form input[type="submit"] {background-color: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}';
			echo 'a[rel="tooltip"], ul.member-contact li a, .blog-item-details a, .post-info a, a.text-link, .tags-wrap .tags a, .logged-in-as a, .comment-meta-actions .edit-link, .comment-meta-actions .comment-reply, .read-more {border-color: '.$accent_color.';}';
			echo '.super-search-go {border-color: '.$accent_color.'!important;}';
			echo '.super-search-go:hover {background: '.$accent_color.'!important;border-color: '.$accent_color.'!important;}';

			// MAIN STYLES
			echo 'body {color: '.$body_text_color.';}';
			echo '.pagination-wrap a, .search-pagination a {color: '.$body_text_color.';}';
			echo '.layout-boxed #header-search, .layout-boxed #super-search, body > .sf-super-search {background-color: '.$page_bg_color.';}';
			if ($body_bg_use_image) {
				if ($body_upload_bg) {
					echo 'body {background: '.$page_bg_color.' url('.$body_upload_bg.') repeat center top fixed;}';
				} else if ($body_preset_bg) {
					echo 'body {background: '.$page_bg_color.' url('.$body_preset_bg.') repeat center top fixed;}';
				}
				echo 'body {background-color: '.$page_bg_color.';background-size: '.$bg_size.';}';
			} else {
				echo 'body {background-color: '.$page_bg_color.';}';
			}
			echo '#main-container, .tm-toggle-button-wrap a {background-color: '.$inner_page_bg_color.';}';
			echo 'a, .ui-widget-content a {color: '.$link_text_color.';}';
			echo '.pagination-wrap li a:hover, ul.bar-styling li:not(.selected) > a:hover, ul.bar-styling li > .comments-likes:hover, ul.page-numbers li > a:hover, ul.page-numbers li > span.current {color: '.$accent_alt_color.'!important;background: '.$accent_color.';border-color: '.$accent_color.';}';
			echo 'ul.bar-styling li > .comments-likes:hover * {color: '.$accent_alt_color.'!important;}';
			echo '.pagination-wrap li a, .pagination-wrap li span, .pagination-wrap li span.expand, ul.bar-styling li > a, ul.bar-styling li > div, ul.page-numbers li > a, ul.page-numbers li > span, .curved-bar-styling, ul.bar-styling li > form input {border-color: '.$section_divide_color.';}';
			echo 'ul.bar-styling li > a, ul.bar-styling li > span, ul.bar-styling li > div, ul.bar-styling li > form input {background-color: '.$inner_page_bg_color.';}';
			echo 'input[type="text"], input[type="password"], input[type="email"], input[type="tel"], textarea, select {border-color: '.$section_divide_color.';background: '.$alt_bg_color.';}';
			echo 'textarea:focus, input:focus {border-color: #999!important;}';
			echo '.modal-header {background: '.$alt_bg_color.';}';
			echo '.recent-post .post-details, .team-member .team-member-position, .portfolio-item h5.portfolio-subtitle, .mini-items .blog-item-details, .standard-post-content .blog-item-details, .masonry-items .blog-item .blog-item-details, .jobs > li .job-date, .search-item-content time, .search-item-content span, .blog-item-details a, .portfolio-details-wrap .date,  .portfolio-details-wrap .tags-link-wrap {color: '.$body_alt_text_color.';}';
			echo 'ul.bar-styling li.facebook > a:hover {color: #fff!important;background: #3b5998;border-color: #3b5998;}';
			echo 'ul.bar-styling li.twitter > a:hover {color: #fff!important;background: #4099FF;border-color: #4099FF;}';
			echo 'ul.bar-styling li.google-plus > a:hover {color: #fff!important;background: #d34836;border-color: #d34836;}';
			echo 'ul.bar-styling li.pinterest > a:hover {color: #fff!important;background: #cb2027;border-color: #cb2027;}';

			// HEADER STYLES
			echo '#header-search input, #header-search a, .super-search-close, #header-search i.ss-search {color: '.$header_aux_text_color.';}';
			echo '#header-search a:hover, .super-search-close:hover {color: '.$accent_color.';}';
			echo '.sf-super-search, .spb_supersearch_widget.asset-bg {background-color: '.$secondary_accent_color.';}';
			echo '.sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input {color: '.$accent_color.'; border-bottom-color: '.$accent_color.';}';
			echo '.sf-super-search .search-options .ss-dropdown ul li .fa-check {color: '.$accent_color.';}';
			echo '.sf-super-search-go:hover, .sf-super-search-close:hover { background-color: '.$accent_color.'; border-color: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '#top-bar {background: '.$topbar_bg_color.'; color: '.$topbar_text_color.';}';
			echo '#top-bar .tb-welcome {border-color: '.$topbar_divider_color.';}';
			echo '#top-bar a {color: '.$topbar_link_color.';}';
			echo '#top-bar .menu li {border-left-color: '.$topbar_divider_color.'; border-right-color: '.$topbar_divider_color.';}';
			echo '#top-bar .menu > li > a, #top-bar .menu > li.parent:after {color: '.$topbar_link_color.';}';
			echo '#top-bar .menu > li > a:hover, #top-bar a:hover {color: '.$topbar_link_hover_color.';}';
			echo '#top-bar .show-menu {background-color: '.$topbar_divider_color.';color: '.$secondary_accent_color.';}';
			echo '#header-languages .current-language {background: '.$nav_sm_bg_hover_color.'; color: '.$nav_sm_selected_text_color.';}';
			echo '#header-section:before, #header .is-sticky .sticky-header, #header-section .is-sticky #main-nav.sticky-header, #header-section.header-6 .is-sticky #header.sticky-header, .ajax-search-wrap {background-color: '.$header_bg_color1.';background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$header_bg_color2.'), to('.$header_bg_color1.'));background: -webkit-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -moz-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -ms-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -o-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');}';
			echo '#logo img {padding-top: '.$logo_spacing_top.'px;padding-bottom: '.$logo_spacing_bottom.'px;}';
			if ($logo_width > 0) {
			echo '#logo img, #logo img.retina {width: '.$logo_width.'px;}';
			}
			if ($logo_height && $logo_height > 0) {
			$logo_row_height = $logo_height + 20;
			echo '#logo {height: '.$logo_height.'px!important;}';
			echo '#logo img {height: '.$logo_height.'px;min-height:'.$logo_height.'px;}';
			echo '.header-container > .row, .header-5 header .container > .row, .header-6 header > .container > .row {height: '.$logo_row_height.'px;}';
			echo '@media only screen and (max-width: 991px) {#logo img {max-height:'.$logo_height.'px;}}';
			} else {
			echo '#logo {max-height: 42px;}';
			}
			if (($logo_resized_height && $logo_resized_height > 0) && ($logo_height && $logo_height > 0)) {
			$logo_resized_row_height = $logo_resized_height + 20;
			echo '.sticky-header-resized #logo {height: '.$logo_resized_height.'px!important;}';
			echo '.sticky-header-resized #logo img {height: '.$logo_resized_height.'px;}';
			echo '.header-container.sticky-header-resized > .row, .header-5 header .container.sticky-header-resized > .row, .header-6 header > .container.sticky-header-resized > .row, .sticky-header-resized .header-container > .row {height: '.$logo_resized_row_height.'px;}';
			}
			if (($logo_resized_width && $logo_resized_width > 0) && ($logo_width && $logo_width > 0)) {
			echo '.sticky-header-resized #logo img {width: '.$logo_resized_width.'px;}';
			}
			if ($header_opacity != "100" && ($header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5")) {
			echo '#header-section:before {opacity: 0.'.$header_opacity.';}';
			}
			echo '#header-section .header-menu .menu li, #mini-header .header-right nav .menu li {border-left-color: '.$section_divide_color.';}';
			echo '#header-section #main-nav {border-top-color: '.$section_divide_color.';}';
			echo '#top-header {border-bottom-color: '.$header_border_color.';}';
			echo '#top-header {border-bottom-color: '.$header_border_color.';}';
			echo '#top-header .th-right > nav .menu li, .ajax-search-wrap:after {border-bottom-color: '.$header_border_color.';}';
			if ($nav_top_spacing && $nav_top_spacing > 0) {
			echo '.header-3 .header-right, .header-4 .header-right, .header-5 .header-right, .header-6 .header-right,  .header-7 .header-right {margin-top: '.$nav_top_spacing.'px;}';
			}
			echo '.ajax-search-wrap, .ajax-search-results, .search-result-pt .search-result {border-color: '.$section_divide_color.';}';
			echo '.page-content {border-bottom-color: '.$section_divide_color.';}';
			echo '.ajax-search-wrap input[type="text"], .search-result-pt h6, .no-search-results h6, .search-result h5 a {color: '.$nav_text_color.';}';
			if ($header_bg_color1 != "#ffffff") {
			echo '.search-item-content time {color: '.$nav_divider_color.';}';
			}
			echo '@media only screen and (max-width: 991px) {
			.naked-header #header-section, .naked-header #header-section:before, .naked-header #header .is-sticky .sticky-header, .naked-header .is-sticky #header.sticky-header {background-color: '.$header_bg_color1.';background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$header_bg_color2.'), to('.$header_bg_color1.'));background: -webkit-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -moz-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -ms-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');background: -o-linear-gradient(top, '.$header_bg_color1.', '.$header_bg_color2.');}
			}';

			// NAVIGATION STYLES
			echo 'nav#main-navigation .menu > li > a span.nav-line {background-color: '.$nav_pointer_color.';}';
			echo '.show-menu {background-color: '.$secondary_accent_color.';color: '.$secondary_accent_alt_color.';}';
			echo 'nav .menu > li:before {background: '.$nav_pointer_color.';}';
			echo 'nav .menu .sub-menu .parent > a:after {border-left-color: '.$nav_pointer_color.';}';
			echo 'nav .menu ul.sub-menu {background-color: '.$nav_sm_bg_color.';}';
			echo 'nav .menu ul.sub-menu li {border-bottom-color: '.$nav_divider_color.';border-bottom-style: '.$nav_divider.';}';
			echo 'nav.mega-menu li .mega .sub .sub-menu, nav.mega-menu li .mega .sub .sub-menu li, nav.mega-menu li .sub-container.non-mega li, nav.mega-menu li .sub li.mega-hdr {border-top-color: '.$nav_divider_color.';border-top-style: '.$nav_divider.';}';
			echo 'nav.mega-menu li .sub li.mega-hdr {border-right-color: '.$nav_divider_color.';border-right-style: '.$nav_divider.';}';
			echo 'nav .menu > li.menu-item > a, nav .menu > li.menu-item.indicator-disabled > a, #menubar-controls a, nav.search-nav .menu>li>a, .naked-header .is-sticky nav .menu > li a {color: '.$nav_text_color.';}';
			echo 'nav .menu > li.menu-item:hover > a {color: '.$nav_text_hover_color.';}';
			echo 'nav .menu ul.sub-menu li.menu-item > a, nav .menu ul.sub-menu li > span, #top-bar nav .menu ul li > a {color: '.$nav_sm_text_color.';}';
			echo 'nav .menu ul.sub-menu li.menu-item:hover > a {color: '.$nav_sm_text_hover_color.'!important; background: '.$nav_sm_bg_hover_color.';}';
			echo 'nav .menu li.parent > a:after, nav .menu li.parent > a:after:hover {color: #aaa;}';
			echo 'nav .menu li.current-menu-ancestor > a, nav .menu li.current-menu-item > a, #mobile-menu .menu ul li.current-menu-item > a, nav .menu li.current-scroll-item > a {color: '.$nav_selected_text_color.';}';
			echo 'nav .menu ul li.current-menu-ancestor > a, nav .menu ul li.current-menu-item > a {color: '.$nav_sm_selected_text_color.'; background: '.$nav_sm_bg_hover_color.';}';
			echo '#main-nav .header-right ul.menu > li, .wishlist-item {border-left-color: '.$nav_divider_color.';}';
			echo '#nav-search, #mini-search {background: '.$topbar_bg_color.';}';
			echo '#nav-search a, #mini-search a {color: '.$topbar_text_color.';}';
			echo '.bag-header, .bag-product, .bag-empty, .wishlist-empty {border-color: '.$nav_divider_color.';}';
			echo '.bag-buttons a.sf-button.bag-button, .bag-buttons a.sf-button.wishlist-button, .bag-buttons a.sf-button.guest-button {background-color: '.$section_divide_color.'; color: '.$body_text_color.'!important;}';
			echo '.bag-buttons a.checkout-button, .bag-buttons a.create-account-button, .woocommerce input.button.alt, .woocommerce .alt-button, .woocommerce button.button.alt, .woocommerce #account_details .login form p.form-row input[type="submit"], #login-form .modal-body form.login p.form-row input[type="submit"] {background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}';
			echo '.woocommerce .button.update-cart-button:hover, .woocommerce #account_details .login form p.form-row input[type="submit"]:hover, #login-form .modal-body form.login p.form-row input[type="submit"]:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '.woocommerce input.button.alt:hover, .woocommerce .alt-button:hover, .woocommerce button.button.alt:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '.shopping-bag:before, nav .menu ul.sub-menu li:first-child:before {border-bottom-color: '.$nav_pointer_color.';}';
			echo 'nav ul.menu > li.menu-item.sf-menu-item-btn > a {background-color: '.$nav_text_hover_color.';color: '.$nav_text_color.';}';
			echo 'nav ul.menu > li.menu-item.sf-menu-item-btn:hover > a {color: '.$nav_text_hover_color.';background-color: '.$nav_text_color.';}';

			// PROMO BAR STYLES
			echo '#base-promo {background-color: '.$promo_bar_bg_color.';}';
			echo '#base-promo > p, #base-promo.footer-promo-text > a, #base-promo.footer-promo-arrow > a {color: '.$promo_bar_text_color.';}';
			echo '#base-promo.footer-promo-arrow:hover, #base-promo.footer-promo-text:hover {background-color: '.$accent_color.';color: '.$accent_alt_color.';}';
			echo '#base-promo.footer-promo-arrow:hover > *, #base-promo.footer-promo-text:hover > * {color: '.$accent_alt_color.';}';

			// PAGE HEADING STYLES
			echo '.page-heading {background-color: '.$page_heading_bg_color.';border-bottom-color: '.$section_divide_color.';}';
			echo '.page-heading h1, .page-heading h3 {color: '.$page_heading_text_color.';}';
			echo '#breadcrumbs {color: '.$breadcrumb_text_color.';}';
			echo '#breadcrumbs a, #breadcrumb i {color: '.$breadcrumb_link_color.';}';

			// BODY STYLES
			echo 'body, input[type="text"], input[type="password"], input[type="email"], textarea, select, .ui-state-default a {color: '.$body_text_color.';}';
			echo 'h1, h1 a {color: '.$h1_text_color.';}';
			echo 'h2, h2 a {color: '.$h2_text_color.';}';
			echo 'h3, h3 a {color: '.$h3_text_color.';}';
			echo 'h4, h4 a, .carousel-wrap > a {color: '.$h4_text_color.';}';
			echo 'h5, h5 a {color: '.$h5_text_color.';}';
			echo 'h6, h6 a {color: '.$h6_text_color.';}';
			echo '.spb_impact_text .spb_call_text, .impact-text, .impact-text-large {color: '.$impact_text_color.';}';
			echo '.read-more i, .read-more em {color: transparent;}';

			// CONTENT STYLES
			echo '.pb-border-bottom, .pb-border-top, .read-more-button {border-color: '.$section_divide_color.';}';
			echo '#swift-slider ul.slides {background: '.$secondary_accent_color.';}';
			echo '#swift-slider .flex-caption .flex-caption-headline {background: '.$inner_page_bg_color.';}';
			echo '#swift-slider .flex-caption .flex-caption-details .caption-details-inner {background: '.$inner_page_bg_color.'; border-bottom: '.$section_divide_color.'}';
			echo '#swift-slider .flex-caption-large, #swift-slider .flex-caption-large h1 a {color: '.$secondary_accent_alt_color.';}';
			echo '#swift-slider .flex-caption h4 i {line-height: '.$h4_font_line_height.'px;}';
			echo '#swift-slider .flex-caption-large .comment-chart i {color: '.$secondary_accent_alt_color.';}';
			echo '#swift-slider .flex-caption-large .loveit-chart span {color: '.$accent_color.';}';
			echo '#swift-slider .flex-caption-large a {color: '.$accent_color.';}';
			echo '#swift-slider .flex-caption .comment-chart i, #swift-slider .flex-caption .comment-chart span {color: '.$secondary_accent_color.';}';
			echo 'figure.animated-overlay figcaption {background-color: '.$accent_color.';}'."\n";
			if ($overlay_opacity < 100) {
			echo 'figure.animated-overlay figcaption {background-color: rgba('.$hover_overlay_rgb["red"].','.$hover_overlay_rgb["green"].','.$hover_overlay_rgb["blue"].', 0.'.$overlay_opacity.');}';
			}
			echo 'figure.animated-overlay figcaption .thumb-info h4, figure.animated-overlay figcaption .thumb-info h5, figcaption .thumb-info-excerpt p {color: '.$accent_alt_color.';}';
			echo 'figure.animated-overlay figcaption .thumb-info i {background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}';
			echo 'figure:hover .overlay {box-shadow: inset 0 0 0 500px '.$accent_color.';}';
			echo 'h4.spb-heading span:before, h4.spb-heading span:after, h3.spb-heading span:before, h3.spb-heading span:after, h4.lined-heading span:before, h4.lined-heading span:after {border-color: '.$section_divide_color.'}';
			echo 'h4.spb-heading:before, h3.spb-heading:before, h4.lined-heading:before {border-top-color: '.$section_divide_color.'}';
			echo '.spb_parallax_asset h4.spb-heading {border-bottom-color: '.$h4_text_color.'}';
			echo '.testimonials.carousel-items li .testimonial-text {background-color: '.$alt_bg_color.';}';

			// SIDEBAR STYLES
			echo '.sidebar .widget-heading h4 {color: '.$h4_text_color.';}';
			echo '.widget ul li, .widget.widget_lip_most_loved_widget li {border-color: '.$section_divide_color.';}';
			echo '.widget.widget_lip_most_loved_widget li {background: '.$inner_page_bg_color.'; border-color: '.$section_divide_color.';}';
			echo '.widget_lip_most_loved_widget .loved-item > span {color: '.$body_alt_text_color.';}';

			echo '.widget_search form input {background: '.$inner_page_bg_color.';}';
			echo '.widget .wp-tag-cloud li a {background: '.$alt_bg_color.'; border-color: '.$section_divide_color.';}';
			echo '.widget .tagcloud a:hover, .widget ul.wp-tag-cloud li:hover > a {background-color: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '.loved-item .loved-count > i {color: '.$body_text_color .';background: '.$section_divide_color.';}';
			echo '.subscribers-list li > a.social-circle {color: '.$secondary_accent_alt_color.';background: '.$secondary_accent_color.';}';
			echo '.subscribers-list li:hover > a.social-circle {color: #fbfbfb;background: '.$accent_color.';}';
			echo '.sidebar .widget_categories ul > li a, .sidebar .widget_archive ul > li a, .sidebar .widget_nav_menu ul > li a, .sidebar .widget_meta ul > li a, .sidebar .widget_recent_entries ul > li, .widget_product_categories ul > li a, .widget_layered_nav ul > li a {color: '.$link_text_color.';}';
			echo '.sidebar .widget_categories ul > li a:hover, .sidebar .widget_archive ul > li a:hover, .sidebar .widget_nav_menu ul > li a:hover, .widget_nav_menu ul > li.current-menu-item a, .sidebar .widget_meta ul > li a:hover, .sidebar .widget_recent_entries ul > li a:hover, .widget_product_categories ul > li a:hover, .widget_layered_nav ul > li a:hover {color: '.$accent_color.';}';
			echo '#calendar_wrap caption {border-bottom-color: '.$secondary_accent_color.';}';
			echo '.sidebar .widget_calendar tbody tr > td a {color: '.$secondary_accent_alt_color.';background-color: '.$secondary_accent_color.';}';
			echo '.sidebar .widget_calendar tbody tr > td a:hover {background-color: '.$accent_color.';}';
			echo '.sidebar .widget_calendar tfoot a {color: '.$secondary_accent_color.';}';
			echo '.sidebar .widget_calendar tfoot a:hover {color: '.$accent_color.';}';
			echo '.widget_calendar #calendar_wrap, .widget_calendar th, .widget_calendar tbody tr > td, .widget_calendar tbody tr > td.pad {border-color: '.$section_divide_color.';}';
			echo '.widget_sf_infocus_widget .infocus-item h5 a {color: '.$secondary_accent_color.';}';
			echo '.widget_sf_infocus_widget .infocus-item h5 a:hover {color: '.$accent_color.';}';
			echo '.sidebar .widget hr {border-color: '.$section_divide_color.';}';
			echo '.widget ul.flickr_images li a:after, .portfolio-grid li a:after {color: '.$accent_alt_color.';}';

			// PORTFOLIO STYLES
			echo '.slideout-filter .select:after {background: '.$inner_page_bg_color.';}';
			echo '.slideout-filter ul li a {color: '.$accent_alt_color.';}';
			echo '.slideout-filter ul li a:hover {color: '.$accent_color.';}';
			echo '.slideout-filter ul li.selected a {color: '.$accent_alt_color.';background: '.$accent_color.';}';
			echo 'ul.portfolio-filter-tabs li.selected a {background: '.$alt_bg_color.';}';
			echo '.spb_blog_widget .filter-wrap {background-color: #222;}';
			echo '.portfolio-item {border-bottom-color: '.$section_divide_color.';}';
			echo '.masonry-items .portfolio-item-details {background: '.$alt_bg_color.';}';
			echo '.spb_portfolio_carousel_widget .portfolio-item {background: '.$inner_page_bg_color.';}';
			echo '.spb_portfolio_carousel_widget .portfolio-item h4.portfolio-item-title a > i {line-height: '.$h4_font_line_height.'px;}';
			echo '.masonry-items .blog-item .blog-details-wrap:before {background-color: '.$alt_bg_color.';}';
			echo '.masonry-items .portfolio-item figure {border-color: '.$section_divide_color.';}';
			echo '.portfolio-details-wrap span span {color: #666;}';
			echo '.share-links > a:hover {color: '.$accent_color.';}';

			// BLOG STYLES
			echo '.blog-aux-options li.selected a {background: '.$accent_color.';border-color: '.$accent_color.';color: '.$accent_alt_color.';}';
			echo '.blog-filter-wrap .aux-list li:hover {border-bottom-color: transparent;}';
			echo '.blog-filter-wrap .aux-list li:hover a {color: '.$accent_alt_color.';background: '.$accent_color.';}';
			echo '.mini-blog-item-wrap, .mini-items .mini-alt-wrap, .mini-items .mini-alt-wrap .quote-excerpt, .mini-items .mini-alt-wrap .link-excerpt, .masonry-items .blog-item .quote-excerpt, .masonry-items .blog-item .link-excerpt, .standard-post-content .quote-excerpt, .standard-post-content .link-excerpt, .timeline, .post-info, .body-text .link-pages, .page-content .link-pages {border-color: '.$section_divide_color.';}';
			echo '.post-info, .article-body-wrap .share-links .share-text, .article-body-wrap .share-links a {color: '.$body_alt_text_color.';}';
			echo '.standard-post-date {background: '.$section_divide_color.';}';
			echo '.standard-post-content {background: '.$alt_bg_color.';}';
			echo '.format-quote .standard-post-content:before, .standard-post-content.no-thumb:before {border-left-color: '.$alt_bg_color.';}';
			echo '.search-item-img .img-holder {background: '.$alt_bg_color.';border-color:'.$section_divide_color.';}';
			echo '.masonry-items .blog-item .masonry-item-wrap {background: '.$alt_bg_color.';}';
			echo '.mini-items .blog-item-details, .share-links, .single-portfolio .share-links, .single .pagination-wrap, ul.portfolio-filter-tabs li a {border-color: '.$section_divide_color.';}';
			echo '.related-item figure {background-color: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.'}';
			echo '.required {color: #ee3c59;}';
			echo '.comments-likes a i, .comments-likes a span, .comments-likes .love-it-wrapper a i, .comments-likes span.love-count, .share-links ul.bar-styling > li > a {color: '.$body_alt_text_color.';}';
			echo '#respond .form-submit input:hover {color: #fff!important;}';
			echo '.recent-post {background: '.$inner_page_bg_color.';}';
			echo '.recent-post .post-item-details {border-top-color: '.$section_divide_color.';color: '.$section_divide_color.';}';
			echo '.post-item-details span, .post-item-details a, .post-item-details .comments-likes a i, .post-item-details .comments-likes a span {color: '.$body_alt_text_color.';}';

			// SHORTCODE STYLES
			echo '.sf-button.accent {color: '.$accent_alt_color.'; background-color: '.$accent_color.';}';
			echo '.sf-button.sf-icon-reveal.accent {color: '.$accent_alt_color.'!important; background-color: '.$accent_color.'!important;}';
			echo '.sf-button.accent:hover {background-color: '.$secondary_accent_color.';color: '.$secondary_accent_alt_color.';}';
			echo 'a.sf-button, a.sf-button:hover, #footer a.sf-button:hover {background-image: none;color: #fff!important;}';
			echo 'a.sf-button.gold, a.sf-button.gold:hover, a.sf-button.lightgrey, a.sf-button.lightgrey:hover, a.sf-button.white, a.sf-button.white:hover {color: #222!important;}';
			echo 'a.sf-button.transparent-dark {color: '.$body_text_color.'!important;}';
			echo 'a.sf-button.transparent-light:hover, a.sf-button.transparent-dark:hover {color: '.$accent_color.'!important;}';
			echo ' input[type="submit"], .wpcf7 input.wpcf7-submit[type="submit"], .gform_wrapper input[type="submit"], .mymail-form input[type="submit"] {color: #fff;}';
			echo 'input[type="submit"]:hover, .wpcf7 input.wpcf7-submit[type="submit"]:hover, .gform_wrapper input[type="submit"]:hover, .mymail-form input[type="submit"]:hover {background-color: '.$secondary_accent_color.'!important;color: '.$secondary_accent_alt_color.';}';
			echo 'input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select {background: '.$alt_bg_color.'; border-color: '.$section_divide_color.';}';
			echo '.sf-icon {color: '.$icon_color.';}';
			echo '.sf-icon-cont {border-color: rgba('.$icon_container_border_color["red"].','.$icon_container_border_color["green"].','.$icon_container_border_color["blue"].',0.5);}';
			echo '.sf-icon-cont:hover, .sf-hover .sf-icon-cont, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont, .sf-hover .sf-icon-box-hr {background-color: '.$icon_container_bg_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont:after {border-top-color: '.$icon_container_bg_color.';border-left-color: '.$icon_container_bg_color.';}';
			echo '.sf-icon-cont:hover .sf-icon, .sf-hover .sf-icon-cont .sf-icon, .sf-icon-box.sf-icon-box-boxed-one .sf-icon, .sf-icon-box.sf-icon-box-boxed-three .sf-icon {color: '.$icon_alt_color.';}';
			echo '.sf-icon-box-animated .front {background: '.$alt_bg_color.'; border-color: '.$section_divide_color.';}';
			echo '.sf-icon-box-animated .front h3 {color: '.$body_text_color.'!important;}';
			echo '.sf-icon-box-animated .back {background: '.$accent_color.'; border-color: '.$accent_color.';}';
			echo '.sf-icon-box-animated .back, .sf-icon-box-animated .back h3 {color: '.$accent_alt_color.'!important;}';
			echo '.sf-icon-accent.sf-icon-cont, .sf-icon-accent > i {color: '.$accent_color.';}';
			echo '.sf-icon-cont.sf-icon-accent {border-color: '.$accent_color.';}';
			echo '.sf-icon-cont.sf-icon-accent:hover, .sf-hover .sf-icon-cont.sf-icon-accent, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont.sf-icon-accent, .sf-hover .sf-icon-box-hr.sf-icon-accent {background-color: '.$accent_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont.sf-icon-accent:after {border-top-color: '.$accent_color.';border-left-color: '.$accent_color.';}';
			echo '.sf-icon-cont.sf-icon-accent:hover .sf-icon, .sf-hover .sf-icon-cont.sf-icon-accent .sf-icon, .sf-icon-box.sf-icon-box-boxed-one.sf-icon-accent .sf-icon, .sf-icon-box.sf-icon-box-boxed-three.sf-icon-accent .sf-icon {color: '.$accent_alt_color.';}';
			echo '.sf-icon-secondary-accent.sf-icon-cont, .sf-icon-secondary-accent > i {color: '.$secondary_accent_color.';}';
			echo '.sf-icon-cont.sf-icon-secondary-accent {border-color: '.$secondary_accent_color.';}';
			echo '.sf-icon-cont.sf-icon-secondary-accent:hover, .sf-hover .sf-icon-cont.sf-icon-secondary-accent, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont.sf-icon-secondary-accent, .sf-hover .sf-icon-box-hr.sf-icon-secondary-accent {background-color: '.$secondary_accent_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont.sf-icon-secondary-accent:after {border-top-color: '.$secondary_accent_color.';border-left-color: '.$secondary_accent_color.';}';
			echo '.sf-icon-cont.sf-icon-secondary-accent:hover .sf-icon, .sf-hover .sf-icon-cont.sf-icon-secondary-accent .sf-icon, .sf-icon-box.sf-icon-box-boxed-one.sf-icon-secondary-accent .sf-icon, .sf-icon-box.sf-icon-box-boxed-three.sf-icon-secondary-accent .sf-icon {color: '.$secondary_accent_alt_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-secondary-accent {background: '.$secondary_accent_color.'; border-color: '.$secondary_accent_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-secondary-accent, .sf-icon-box-animated .back.sf-icon-secondary-accent h3 {color: '.$secondary_accent_alt_color.'!important;}';
			echo '.sf-icon-icon-one.sf-icon-cont, .sf-icon-icon-one > i, i.sf-icon-icon-one {color: '.$icon_one_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-one {border-color: '.$icon_one_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-one:hover, .sf-hover .sf-icon-cont.sf-icon-icon-one, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-one, .sf-hover .sf-icon-box-hr.sf-icon-icon-one {background-color: '.$icon_one_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-one:after {border-top-color: '.$icon_one_color.';border-left-color: '.$icon_one_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-one:hover .sf-icon, .sf-hover .sf-icon-cont.sf-icon-icon-one .sf-icon, .sf-icon-box.sf-icon-box-boxed-one.sf-icon-icon-one .sf-icon, .sf-icon-box.sf-icon-box-boxed-three.sf-icon-icon-one .sf-icon {color: '.$icon_one_alt_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-one {background: '.$icon_one_color.'; border-color: '.$icon_one_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-one, .sf-icon-box-animated .back.sf-icon-icon-one h3 {color: '.$icon_one_alt_color.'!important;}';
			echo '.sf-icon-icon-two.sf-icon-cont, .sf-icon-icon-two > i, i.sf-icon-icon-two {color: '.$icon_two_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-two {border-color: '.$icon_two_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-two:hover, .sf-hover .sf-icon-cont.sf-icon-icon-two, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-two, .sf-hover .sf-icon-box-hr.sf-icon-icon-two {background-color: '.$icon_two_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-two:after {border-top-color: '.$icon_two_color.';border-left-color: '.$icon_two_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-two:hover .sf-icon, .sf-hover .sf-icon-cont.sf-icon-icon-two .sf-icon, .sf-icon-box.sf-icon-box-boxed-one.sf-icon-icon-two .sf-icon, .sf-icon-box.sf-icon-box-boxed-three.sf-icon-icon-two .sf-icon {color: '.$icon_two_alt_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-two {background: '.$icon_two_color.'; border-color: '.$icon_two_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-two, .sf-icon-box-animated .back.sf-icon-icon-two h3 {color: '.$icon_two_alt_color.'!important;}';
			echo '.sf-icon-icon-three.sf-icon-cont, .sf-icon-icon-three > i, i.sf-icon-icon-three {color: '.$icon_three_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-three {border-color: '.$icon_three_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-three:hover, .sf-hover .sf-icon-cont.sf-icon-icon-three, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-three, .sf-hover .sf-icon-box-hr.sf-icon-icon-three {background-color: '.$icon_three_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-three:after {border-top-color: '.$icon_three_color.';border-left-color: '.$icon_three_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-three:hover .sf-icon, .sf-hover .sf-icon-cont.sf-icon-icon-three .sf-icon, .sf-icon-box.sf-icon-box-boxed-one.sf-icon-icon-three .sf-icon, .sf-icon-box.sf-icon-box-boxed-three.sf-icon-icon-three .sf-icon {color: '.$icon_three_alt_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-three {background: '.$icon_three_color.'; border-color: '.$icon_three_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-three, .sf-icon-box-animated .back.sf-icon-icon-three h3 {color: '.$icon_three_alt_color.'!important;}';
			echo '.sf-icon-icon-four.sf-icon-cont, .sf-icon-icon-four > i, i.sf-icon-icon-four {color: '.$icon_four_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-four {border-color: '.$icon_four_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-four:hover, .sf-hover .sf-icon-cont.sf-icon-icon-four, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-four, .sf-hover .sf-icon-box-hr.sf-icon-icon-four {background-color: '.$icon_four_color.';}';
			echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont.sf-icon-icon-four:after {border-top-color: '.$icon_four_color.';border-left-color: '.$icon_four_color.';}';
			echo '.sf-icon-cont.sf-icon-icon-four:hover .sf-icon, .sf-hover .sf-icon-cont.sf-icon-icon-four .sf-icon, .sf-icon-box.sf-icon-box-boxed-one.sf-icon-icon-four .sf-icon, .sf-icon-box.sf-icon-box-boxed-three.sf-icon-icon-four .sf-icon {color: '.$icon_four_alt_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-four {background: '.$icon_four_color.'; border-color: '.$icon_four_color.';}';
			echo '.sf-icon-box-animated .back.sf-icon-icon-four, .sf-icon-box-animated .back.sf-icon-icon-four h3 {color: '.$icon_four_alt_color.'!important;}';
			echo 'span.dropcap3 {background: #000;color: #fff;}';
			echo 'span.dropcap4 {color: #fff;}';
			echo '.spb_divider, .spb_divider.go_to_top_icon1, .spb_divider.go_to_top_icon2, .testimonials > li, .jobs > li, .spb_impact_text, .tm-toggle-button-wrap, .tm-toggle-button-wrap a, .portfolio-details-wrap, .spb_divider.go_to_top a, .impact-text-wrap, .widget_search form input, .asset-bg.spb_divider {border-color: '.$section_divide_color.';}';
			echo '.spb_divider.go_to_top_icon1 a, .spb_divider.go_to_top_icon2 a {background: '.$inner_page_bg_color.';}';
			echo '.spb_tabs .ui-tabs .ui-tabs-panel, .spb_content_element .ui-tabs .ui-tabs-nav, .ui-tabs .ui-tabs-nav li {border-color: '.$section_divide_color.';}';
			echo '.spb_tabs .ui-tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li.ui-tabs-active a {background: '.$inner_page_bg_color.'!important;}';
			echo '.spb_tabs .nav-tabs li a, .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus, .spb_accordion .spb_accordion_section, .spb_tour .nav-tabs li a {border-color: '.$section_divide_color.';}';
			echo '.spb_tabs .nav-tabs li.active a, .spb_tour .nav-tabs li.active a, .spb_accordion .spb_accordion_section > h3.ui-state-active a {background-color: '.$alt_bg_color.';}';
			echo '.spb_tour .ui-tabs .ui-tabs-nav li a {border-color: '.$section_divide_color.';}';
			echo '.spb_tour.span3 .ui-tabs .ui-tabs-nav li {border-color: '.$section_divide_color.'!important;}';
			echo '.toggle-wrap .spb_toggle, .spb_toggle_content {border-color: '.$section_divide_color.';}';
			echo '.toggle-wrap .spb_toggle:hover {color: '.$accent_color.';}';
			echo '.ui-accordion h3.ui-accordion-header .ui-icon {color: '.$body_text_color.';}';
			echo '.ui-accordion h3.ui-accordion-header.ui-state-active:hover a, .ui-accordion h3.ui-accordion-header:hover .ui-icon {color: '.$accent_color.';}';
			echo 'blockquote.pullquote {border-color: '.$accent_color.';}';
			echo '.borderframe img {border-color: #eeeeee;}';
			echo '.labelled-pricing-table .column-highlight {background-color: #fff;}';
			echo '.labelled-pricing-table .pricing-table-label-row, .labelled-pricing-table .pricing-table-row {background: '.$lpt_secondary_row_color.';}';
			echo '.labelled-pricing-table .alt-row {background: '.$lpt_primary_row_color.';}';
			echo '.labelled-pricing-table .pricing-table-price {background: '.$lpt_default_pricing_header.';}';
			echo '.labelled-pricing-table .pricing-table-package {background: '.$lpt_default_package_header.';}';
			echo '.labelled-pricing-table .lpt-button-wrap {background: '.$lpt_default_footer.';}';
			echo '.labelled-pricing-table .lpt-button-wrap a.accent {background: #222!important;}';
			echo '.labelled-pricing-table .column-highlight .lpt-button-wrap {background: transparent!important;}';
			echo '.labelled-pricing-table .column-highlight .lpt-button-wrap a.accent {background: '.$accent_color.'!important;}';
			echo '.column-highlight .pricing-table-price {color: #fff;background: '.$pt_primary_bg_color.';border-bottom-color: '.$pt_primary_bg_color.';}';
			echo '.column-highlight .pricing-table-package {background: '.$pt_secondary_bg_color.';}';
			echo '.column-highlight .pricing-table-details {background: '.$pt_tertiary_bg_color.';}';
			echo '.spb_box_text.coloured .box-content-wrap {background: '.$boxed_content_color.';color: #fff;}';
			echo '.spb_box_text.whitestroke .box-content-wrap {background-color: #fff;border-color: '.$section_divide_color.';}';
			echo '.client-item figure {border-color: '.$section_divide_color.';}';
			echo '.client-item figure:hover {border-color: #333;}';
			echo 'ul.member-contact li a:hover {color: #333;}';
			echo '.testimonials.carousel-items li .testimonial-text {border-color: '.$section_divide_color.';}';
			echo '.testimonials.carousel-items li .testimonial-text:after {border-left-color: '.$section_divide_color.';border-top-color: '.$section_divide_color.';}';
			echo '.team-member figure figcaption {background: '.$alt_bg_color.';}';
			echo '.horizontal-break {background-color: '.$section_divide_color.';}';
			echo '.progress .bar {background-color: '.$accent_color.';}';
			echo '.progress.standard .bar {background: '.$accent_color.';}';
			echo '.progress-bar-wrap .progress-value {color: '.$accent_color.';}';
			echo '.asset-bg-detail {background:'.$inner_page_bg_color.';border-color:'.$section_divide_color.';}';

			// FOOTER STYLES
			echo '#footer {background: '.$footer_bg_color.';}';
			echo '#footer, #footer p {color: '.$footer_text_color.';}';
			echo '#footer h6 {color: '.$footer_text_color.';}';
			echo '#footer a {color: '.$footer_text_color.';}';
			echo '#footer .widget ul li, #footer .widget_categories ul, #footer .widget_archive ul, #footer .widget_nav_menu ul, #footer .widget_recent_comments ul, #footer .widget_meta ul, #footer .widget_recent_entries ul, #footer .widget_product_categories ul {border-color: '.$footer_border_color.';}';
			echo '#copyright {background-color: '.$copyright_bg_color.';border-top-color: '.$footer_border_color.';}';
			echo '#copyright p {color: '.$copyright_text_color.';}';
			echo '#copyright a {color: '.$copyright_link_color.';}';
			echo '#copyright a:hover {color: '.$copyright_link_hover_color.';}';
			echo '#copyright nav .menu li {border-left-color: '.$footer_border_color.';}';
			echo '#footer .widget_calendar #calendar_wrap, #footer .widget_calendar th, #footer .widget_calendar tbody tr > td, #footer .widget_calendar tbody tr > td.pad {border-color: '.$footer_border_color.';}';
			echo '.widget input[type="email"] {background: #f7f7f7; color: #999}';
			echo '#footer .widget hr {border-color: '.$footer_border_color.';}';

			// WOOCOMMERCE STYLES
			echo '.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .modal-body .comment-form-rating, .woocommerce form .form-row input.input-text, ul.checkout-process, #billing .proceed, ul.my-account-nav > li, .woocommerce #payment, .woocommerce-checkout p.thank-you, .woocommerce .order_details, .woocommerce-page .order_details, .woocommerce ul.products li.product figure figcaption .yith-wcwl-add-to-wishlist, #product-accordion .panel, .review-order-wrap { border-color: '.$section_divide_color.' ;}';
			echo 'nav.woocommerce-pagination ul li span.current, nav.woocommerce-pagination ul li a:hover {background:'.$accent_color.'!important;border-color:'.$accent_color.';color: '.$accent_alt_color.'!important;}';
			echo '.woocommerce-account p.myaccount_address, .woocommerce-account .page-content h2, p.no-items, #order_review table.shop_table, #payment_heading, .returning-customer a {border-bottom-color: '.$section_divide_color.';}';
			echo '.woocommerce .products ul, .woocommerce ul.products, .woocommerce-page .products ul, .woocommerce-page ul.products, p.no-items {border-top-color: '.$section_divide_color.';}';
			echo '.woocommerce-ordering .woo-select, .variations_form .woo-select, .add_review a, .woocommerce .quantity, .woocommerce-page .quantity, .woocommerce .coupon input.apply-coupon, .woocommerce table.shop_table tr td.product-remove .remove, .woocommerce .button.update-cart-button, .shipping-calculator-form .woo-select, .woocommerce .shipping-calculator-form .update-totals-button button, .woocommerce #billing_country_field .woo-select, .woocommerce #shipping_country_field .woo-select, .woocommerce #review_form #respond .form-submit input, .woocommerce form .form-row input.input-text, .woocommerce table.my_account_orders .order-actions .button, .woocommerce #payment div.payment_box, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce.widget .buttons a, .load-more-btn {background: '.$alt_bg_color.'; color: '.$secondary_accent_color.'}';
			echo '.woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li span.current { color: '.$accent_alt_color.';}';
			echo 'li.product figcaption a.product-added {color: '.$accent_alt_color.';}';
			echo '.woocommerce ul.products li.product figure figcaption, .yith-wcwl-add-button a, ul.products li.product a.quick-view-button, .yith-wcwl-add-to-wishlist, .woocommerce form.cart button.single_add_to_cart_button, .woocommerce p.cart a.single_add_to_cart_button, .lost_reset_password p.form-row input[type="submit"], .track_order p.form-row input[type="submit"], .change_password_form p input[type="submit"], .woocommerce form.register input[type="submit"], .woocommerce .wishlist_table tr td.product-add-to-cart a, .woocommerce input.button[name="save_address"], .woocommerce .woocommerce-message a.button {background: '.$alt_bg_color.';}';
			echo '.woocommerce ul.products li.product figure figcaption .shop-actions > a, .woocommerce .wishlist_table tr td.product-add-to-cart a {color: '.$body_text_color.';}';
			echo '.woocommerce ul.products li.product figure figcaption .shop-actions > a.product-added, .woocommerce ul.products li.product figure figcaption .shop-actions > a.product-added:hover {color: '.$accent_alt_color.';}';
			echo 'ul.products li.product .product-details .posted_in a {color: '.$body_alt_text_color.';}';
			echo '.woocommerce ul.products li.product figure figcaption .shop-actions > a:hover, ul.products li.product .product-details .posted_in a:hover {color: '.$accent_color.';}';
			echo '.woocommerce form.cart button.single_add_to_cart_button, .woocommerce p.cart a.single_add_to_cart_button, .woocommerce input[name="save_account_details"] { background: '.$alt_bg_color.'!important; color: '.$body_text_color.' ;}'. "\n";
			echo '.woocommerce form.cart button.single_add_to_cart_button:disabled, .woocommerce form.cart button.single_add_to_cart_button:disabled[disabled] { background: '.$alt_bg_color.'!important; color: '.$body_text_color.' ;}'. "\n";
			echo '.woocommerce form.cart button.single_add_to_cart_button:hover, .woocommerce .button.checkout-button, .woocommerce .wc-proceed-to-checkout > a.checkout-button { background: '.$accent_color.'!important; color: '.$accent_alt_color.' ;}'. "\n";
			echo '.woocommerce p.cart a.single_add_to_cart_button:hover, .woocommerce .button.checkout-button:hover, .woocommerce .wc-proceed-to-checkout > a.checkout-button:hover {background: '.$secondary_accent_color.'!important; color: '.$accent_color.'!important;}';
			echo '.woocommerce table.shop_table tr td.product-remove .remove:hover, .woocommerce .coupon input.apply-coupon:hover, .woocommerce .shipping-calculator-form .update-totals-button button:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .add_review a:hover, .woocommerce #review_form #respond .form-submit input:hover, .lost_reset_password p.form-row input[type="submit"]:hover, .track_order p.form-row input[type="submit"]:hover, .change_password_form p input[type="submit"]:hover, .woocommerce table.my_account_orders .order-actions .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce.widget .buttons a:hover, .woocommerce .wishlist_table tr td.product-add-to-cart a:hover, .woocommerce input.button[name="save_address"]:hover, .woocommerce input[name="apply_coupon"]:hover, .woocommerce .cart input[name="update_cart"]:hover, .woocommerce form.register input[type="submit"]:hover, .woocommerce form.cart button.single_add_to_cart_button:hover, .woocommerce form.cart .yith-wcwl-add-to-wishlist a:hover, .load-more-btn:hover, .woocommerce-account input[name="change_password"]:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '.woocommerce-MyAccount-navigation li {border-color: '.$section_divide_color.';}';
			echo '.woocommerce-MyAccount-navigation li.is-active a, .woocommerce-MyAccount-navigation li a:hover {color: '.$body_text_color.';}';
			echo '.woocommerce #account_details .login, .woocommerce #account_details .login h4.lined-heading span, .my-account-login-wrap .login-wrap, .my-account-login-wrap .login-wrap h4.lined-heading span, .woocommerce div.product form.cart table div.quantity {background: '.$alt_bg_color.';}';
			echo '.woocommerce .help-bar ul li a:hover, .woocommerce .continue-shopping:hover, .woocommerce .address .edit-address:hover, .my_account_orders td.order-number a:hover, .product_meta a.inline:hover { border-bottom-color: '.$accent_color.';}';
			echo '.woocommerce .order-info, .woocommerce .order-info mark {background: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '.woocommerce #payment div.payment_box:after {border-bottom-color: '.$alt_bg_color.';}';
			echo '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {background: '.$section_divide_color.';}';
			echo '.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range {background: '.$alt_bg_color.';}';
			echo '.yith-wcwl-wishlistexistsbrowse a:hover, .yith-wcwl-wishlistaddedbrowse a:hover {color: '.$accent_alt_color.';}';
			echo '.woocommerce ul.products li.product .price, .woocommerce div.product p.price {color: '.$body_text_color.';}';
			echo '.woocommerce ul.products li.product-category .product-cat-info {background: '.$section_divide_color.';}';
			echo '.woocommerce ul.products li.product-category .product-cat-info:before {border-bottom-color:'.$section_divide_color.';}';
			echo '.woocommerce ul.products li.product-category a:hover .product-cat-info {background: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '.woocommerce ul.products li.product-category a:hover .product-cat-info h3 {color: '.$accent_alt_color.'!important;}';
			echo '.woocommerce ul.products li.product-category a:hover .product-cat-info:before {border-bottom-color:'.$accent_color.';}';
			echo '.woocommerce input[name="apply_coupon"], .woocommerce .cart input[name="update_cart"], .woocommerce .shipping-calc-wrap button[name="calc_shipping"], .woocommerce-account input[name="change_password"] {background: '.$alt_bg_color.'!important; color: '.$secondary_accent_color.'!important}';
			echo '.woocommerce input[name="apply_coupon"]:hover, .woocommerce .cart input[name="update_cart"]:hover, .woocommerce .shipping-calc-wrap button[name="calc_shipping"]:hover, .woocommerce-account input[name="change_password"]:hover, .woocommerce input[name="save_account_details"]:hover {background: '.$accent_color.'!important; color: '.$accent_alt_color.'!important;}';

			// BUDDYPRESS STYLES
			echo '#buddypress .activity-meta a, #buddypress .acomment-options a, #buddypress #member-group-links li a {border-color: '.$section_divide_color.';}';
			echo '#buddypress .activity-meta a:hover, #buddypress .acomment-options a:hover, #buddypress #member-group-links li a:hover {border-color: '.$accent_color.';}';
			echo '#buddypress .activity-header a, #buddypress .activity-read-more a {border-color: '.$accent_color.';}';
			echo '#buddypress #members-list .item-meta .activity, #buddypress .activity-header p {color: '.$body_alt_text_color.';}';
			echo '#buddypress .pagination-links span, #buddypress .load-more.loading a {background-color: '.$accent_color.';color: '.$accent_alt_color.';border-color: '.$accent_color.';}';

			// BBPRESS STYLES
			echo 'span.bbp-admin-links a, li.bbp-forum-info .bbp-forum-content {color: '.$body_alt_text_color.';}';
			echo 'span.bbp-admin-links a:hover {color: '.$accent_color.';}';
			echo '.bbp-topic-action #favorite-toggle a, .bbp-topic-action #subscription-toggle a, .bbp-single-topic-meta a, .bbp-topic-tags a, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbp-user-navigation ul li a, .bbp-pagination-links a, #bbp-your-profile fieldset input, #bbp-your-profile fieldset textarea, #bbp-your-profile, #bbp-your-profile fieldset {border-color: '.$section_divide_color.';}';
			echo '.bbp-topic-action #favorite-toggle a:hover, .bbp-topic-action #subscription-toggle a:hover, .bbp-single-topic-meta a:hover, .bbp-topic-tags a:hover, #bbp-user-navigation ul li a:hover, .bbp-pagination-links a:hover {border-color: '.$accent_color.';}';
			echo '#bbp-user-navigation ul li.current a, .bbp-pagination-links span.current {border-color: '.$accent_color.';background: '.$accent_color.'; color: '.$accent_alt_color.';}';
			echo '#bbpress-forums fieldset.bbp-form button[type="submit"], #bbp_user_edit_submit {background: '.$alt_bg_color.'; color: '.$secondary_accent_color.'}';
			echo '#bbpress-forums fieldset.bbp-form button[type="submit"]:hover, #bbp_user_edit_submit:hover {background: '.$accent_color.'; color: '.$accent_alt_color.';}';

			// ASSET BACKGROUND STYLES
			echo '.asset-bg {border-color: '.$section_divide_color.';}';
			echo '.asset-bg.alt-one {background-color: '.$alt_one_bg_color.';}';
			if (isset($options['alt_one_bg_image']) && $alt_one_bg_image != "") {
				if ($alt_one_bg_image_size == "cover") {
					echo '.asset-bg.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-one, .asset-bg .alt-one, .asset-bg.alt-one h1, .asset-bg.alt-one h2, .asset-bg.alt-one h3, .asset-bg.alt-one h3, .asset-bg.alt-one h4, .asset-bg.alt-one h5, .asset-bg.alt-one h6, .alt-one .carousel-wrap > a {color: '.$alt_one_text_color.';}';
			echo '.asset-bg.alt-one h4.spb-center-heading span:before, .asset-bg.alt-one h4.spb-center-heading span:after {border-color: '.$alt_one_text_color.';}';
			echo '.alt-one .full-width-text:after {border-top-color:'.$alt_one_bg_color.';}';
			echo '.alt-one h4.spb-text-heading, .alt-one h4.spb-heading {border-bottom-color:'.$alt_one_text_color.';}';
			echo '.asset-bg.alt-two {background-color: '.$alt_two_bg_color.';}';
			if (isset($options['alt_two_bg_image']) && $alt_two_bg_image != "") {
				if ($alt_two_bg_image_size == "cover") {
					echo '.asset-bg.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-two, .asset-bg .alt-two, .asset-bg.alt-two h1, .asset-bg.alt-two h2, .asset-bg.alt-two h3, .asset-bg.alt-two h3, .asset-bg.alt-two h4, .asset-bg.alt-two h5, .asset-bg.alt-two h6, .alt-two .carousel-wrap > a {color: '.$alt_two_text_color.';}';
			echo '.asset-bg.alt-two h4.spb-center-heading span:before, .asset-bg.alt-two h4.spb-center-heading span:after {border-color: '.$alt_two_text_color.';}';
			echo '.alt-two .full-width-text:after {border-top-color:'.$alt_two_bg_color.';}';
			echo '.alt-two h4.spb-text-heading, .alt-two h4.spb-heading {border-bottom-color:'.$alt_two_text_color.';}';
			echo '.asset-bg.alt-three {background-color: '.$alt_three_bg_color.';}';
			if (isset($options['alt_three_bg_image']) && $alt_three_bg_image != "") {
				if ($alt_three_bg_image_size == "cover") {
					echo '.asset-bg.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-three, .asset-bg .alt-three, .asset-bg.alt-three h1, .asset-bg.alt-three h2, .asset-bg.alt-three h3, .asset-bg.alt-three h3, .asset-bg.alt-three h4, .asset-bg.alt-three h5, .asset-bg.alt-three h6, .alt-three .carousel-wrap > a {color: '.$alt_three_text_color.';}';
			echo '.asset-bg.alt-three h4.spb-center-heading span:before, .asset-bg.alt-three h4.spb-center-heading span:after {border-color: '.$alt_three_text_color.';}';
			echo '.alt-three .full-width-text:after {border-top-color:'.$alt_three_bg_color.';}';
			echo '.alt-three h4.spb-text-heading, .alt-three h4.spb-heading {border-bottom-color:'.$alt_three_text_color.';}';
			echo '.asset-bg.alt-four {background-color: '.$alt_four_bg_color.';}';
			if (isset($options['alt_four_bg_image']) && $alt_four_bg_image != "") {
				if ($alt_four_bg_image_size == "cover") {
					echo '.asset-bg.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-four, .asset-bg .alt-four, .asset-bg.alt-four h1, .asset-bg.alt-four h2, .asset-bg.alt-four h3, .asset-bg.alt-four h3, .asset-bg.alt-four h4, .asset-bg.alt-four h5, .asset-bg.alt-four h6, .alt-four .carousel-wrap > a {color: '.$alt_four_text_color.';}';
			echo '.asset-bg.alt-four h4.spb-center-heading span:before, .asset-bg.alt-four h4.spb-center-heading span:after {border-color: '.$alt_four_text_color.';}';
			echo '.alt-four .full-width-text:after {border-top-color:'.$alt_four_bg_color.';}';
			echo '.alt-four h4.spb-text-heading, .alt-four h4.spb-heading {border-bottom-color:'.$alt_four_text_color.';}';
			echo '.asset-bg.alt-five {background-color: '.$alt_five_bg_color.';}';
			if (isset($options['alt_five_bg_image']) && $alt_five_bg_image != "") {
				if ($alt_five_bg_image_size == "cover") {
					echo '.asset-bg.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-five, .asset-bg .alt-five, .asset-bg.alt-five h1, .asset-bg.alt-five h2, .asset-bg.alt-five h3, .asset-bg.alt-five h3, .asset-bg.alt-five h4, .asset-bg.alt-five h5, .asset-bg.alt-five h6, .alt-five .carousel-wrap > a {color: '.$alt_five_text_color.';}';
			echo '.asset-bg.alt-five h4.spb-center-heading span:before, .asset-bg.alt-five h4.spb-center-heading span:after {border-color: '.$alt_five_text_color.';}';
			echo '.alt-five .full-width-text:after {border-top-color:'.$alt_five_bg_color.';}';
			echo '.alt-five h4.spb-text-heading, .alt-five h4.spb-heading {border-bottom-color:'.$alt_five_text_color.';}';
			echo '.asset-bg.alt-six {background-color: '.$alt_six_bg_color.';}';
			if (isset($options['alt_six_bg_image']) && $alt_six_bg_image != "") {
				if ($alt_six_bg_image_size == "cover") {
					echo '.asset-bg.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-six, .asset-bg .alt-six, .asset-bg.alt-six h1, .asset-bg.alt-six h2, .asset-bg.alt-six h3, .asset-bg.alt-six h3, .asset-bg.alt-six h4, .asset-bg.alt-six h5, .asset-bg.alt-six h6, .alt-six .carousel-wrap > a {color: '.$alt_six_text_color.';}';
			echo '.asset-bg.alt-six h4.spb-center-heading span:before, .asset-bg.alt-six h4.spb-center-heading span:after {border-color: '.$alt_six_text_color.';}';
			echo '.alt-six .full-width-text:after {border-top-color:'.$alt_six_bg_color.';}';
			echo '.alt-six h4.spb-text-heading, .alt-six h4.spb-heading {border-bottom-color:'.$alt_six_text_color.';}';
			echo '.asset-bg.alt-seven {background-color: '.$alt_seven_bg_color.';}';
			if (isset($options['alt_seven_bg_image']) && $alt_seven_bg_image != "") {
				if ($alt_seven_bg_image_size == "cover") {
					echo '.asset-bg.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-seven, .asset-bg .alt-seven, .asset-bg.alt-seven h1, .asset-bg.alt-seven h2, .asset-bg.alt-seven h3, .asset-bg.alt-seven h3, .asset-bg.alt-seven h4, .asset-bg.alt-seven h5, .asset-bg.alt-seven h6, .alt-seven .carousel-wrap > a {color: '.$alt_seven_text_color.';}';
			echo '.asset-bg.alt-seven h4.spb-center-heading span:before, .asset-bg.alt-seven h4.spb-center-heading span:after {border-color: '.$alt_seven_text_color.';}';
			echo '.alt-seven .full-width-text:after {border-top-color:'.$alt_seven_bg_color.';}';
			echo '.alt-seven h4.spb-text-heading, .alt-seven h4.spb-heading {border-bottom-color:'.$alt_seven_text_color.';}';
			echo '.asset-bg.alt-eight {background-color: '.$alt_eight_bg_color.';}';
			if (isset($options['alt_eight_bg_image']) && $alt_eight_bg_image != "") {
				if ($alt_eight_bg_image_size == "cover") {
					echo '.asset-bg.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-eight, .asset-bg .alt-eight, .asset-bg.alt-eight h1, .asset-bg.alt-eight h2, .asset-bg.alt-eight h3, .asset-bg.alt-eight h3, .asset-bg.alt-eight h4, .asset-bg.alt-eight h5, .asset-bg.alt-eight h6, .alt-eight .carousel-wrap > a {color: '.$alt_eight_text_color.';}';
			echo '.asset-bg.alt-eight h4.spb-center-heading span:before, .asset-bg.alt-eight h4.spb-center-heading span:after {border-color: '.$alt_eight_text_color.';}';
			echo '.alt-eight .full-width-text:after {border-top-color:'.$alt_eight_bg_color.';}';
			echo '.alt-eight h4.spb-text-heading, .alt-eight h4.spb-heading {border-bottom-color:'.$alt_eight_text_color.';}';
			echo '.asset-bg.alt-nine {background-color: '.$alt_nine_bg_color.';}';
			if (isset($options['alt_nine_bg_image']) && $alt_nine_bg_image != "") {
				if ($alt_nine_bg_image_size == "cover") {
					echo '.asset-bg.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-nine, .asset-bg .alt-nine, .asset-bg.alt-nine h1, .asset-bg.alt-nine h2, .asset-bg.alt-nine h3, .asset-bg.alt-nine h3, .asset-bg.alt-nine h4, .asset-bg.alt-nine h5, .asset-bg.alt-nine h6, .alt-nine .carousel-wrap > a {color: '.$alt_nine_text_color.';}';
			echo '.asset-bg.alt-nine h4.spb-center-heading span:before, .asset-bg.alt-nine h4.spb-center-heading span:after {border-color: '.$alt_nine_text_color.';}';
			echo '.alt-nine .full-width-text:after {border-top-color:'.$alt_nine_bg_color.';}';
			echo '.alt-nine h4.spb-text-heading, .alt-nine h4.spb-heading {border-bottom-color:'.$alt_nine_text_color.';}';
			echo '.asset-bg.alt-ten {background-color: '.$alt_ten_bg_color.';}';
			if (isset($options['alt_ten_bg_image']) && $alt_ten_bg_image != "") {
				if ($alt_ten_bg_image_size == "cover") {
					echo '.asset-bg.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}';
				} else {
					echo '.asset-bg.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: repeat; background-position: center top; background-size:auto;}';
				}
			}
			echo '.asset-bg.alt-ten, .asset-bg .alt-ten, .asset-bg.alt-ten h1, .asset-bg.alt-ten h2, .asset-bg.alt-ten h3, .asset-bg.alt-ten h3, .asset-bg.alt-ten h4, .asset-bg.alt-ten h5, .asset-bg.alt-ten h6, .alt-ten .carousel-wrap > a {color: '.$alt_ten_text_color.';}';
			echo '.asset-bg.alt-ten h4.spb-center-heading span:before, .asset-bg.alt-ten h4.spb-center-heading span:after {border-color: '.$alt_ten_text_color.';}';
			echo '.alt-ten .full-width-text:after {border-top-color:'.$alt_ten_bg_color.';}';
			echo '.alt-ten h4.spb-text-heading, .alt-ten h4.spb-heading {border-bottom-color:'.$alt_ten_text_color.';}';
			echo '.asset-bg.light-style, .asset-bg.light-style h1, .asset-bg.light-style h2, .asset-bg.light-style h3, .asset-bg.light-style h3, .asset-bg.light-style h4, .asset-bg.light-style h5, .asset-bg.light-style h6 {color: #fff!important;}';
			echo '.asset-bg.dark-style, .asset-bg.dark-style h1, .asset-bg.dark-style h2, .asset-bg.dark-style h3, .asset-bg.dark-style h3, .asset-bg.dark-style h4, .asset-bg.dark-style h5, .asset-bg.dark-style h6 {color: #222!important;}';

			// PAGE BACKGROUND STYLES
			if ($bg_image_url != "") {
				if ($background_image_size == "cover") {
				echo 'body { background: transparent url("'.$bg_image_url.'") no-repeat center top fixed; background-size: cover; }';
				} else {
				echo 'body { background: transparent url("'.$bg_image_url.'") repeat center top fixed; background-size: auto; }';
				}
			}

			// INNER PAGE BACKGROUND STYLES
			if ($inner_bg_image_url != "") {
				echo '#main-container { background: transparent url("'.$inner_bg_image_url.'") repeat center top; background-size: auto; }';
				echo '.standard-post-content, .blog-aux-options li a, .blog-aux-options li form input, .masonry-items .blog-item .masonry-item-wrap, .widget .wp-tag-cloud li a, ul.portfolio-filter-tabs li.selected a, .masonry-items .portfolio-item-details {background: '.$inner_page_bg_color.';}';
				echo '.format-quote .standard-post-content:before, .standard-post-content.no-thumb:before {border-left-color: '.$inner_page_bg_color.';}';
			}

			// CUSTOM FONT STYLES
			if ($body_font_option == "standard") {
			echo 'body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h4, #comments-list > h3, .item-heading h1, .sf-button, button, input[type="submit"], input[type="email"], input[type="reset"], input[type="button"], .spb_accordion_section h3, #header-login input, #mobile-navigation > div, .search-form input, input, button, select, textarea {font-family: "'.$standard_font.'", Arial, Helvetica, Tahoma, sans-serif;}';
			}
			if ($headings_font_option == "standard") {
			echo 'h1, h2, h3, h4, h5, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .spb_call_text, .impact-text, .impact-text-large, .testimonial-text, .header-advert, .sf-count-asset .count-number, #base-promo, .sf-countdown, .fancy-heading h1, .sf-icon-character {font-family: "'.$heading_font.'", Arial, Helvetica, Tahoma, sans-serif;}';
			}
			if ($menu_font_option == "standard") {
			echo 'nav .menu li {font-family: "'.$menu_font.'", Arial, Helvetica, Tahoma, sans-serif;}';
			}
			if ($body_font_option == "google") {
			echo 'body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h4, #comments-list > h4, .item-heading h1, .sf-button, button, input[type="submit"], input[type="reset"], input[type="button"], input[type="email"], .spb_accordion_section h3, #header-login input, #mobile-navigation > div, .search-form input, input, button, select, textarea {font-family: "'.$google_font_one.'", sans-serif;font-weight: '.$google_font_one_weight.';font-style: '.$google_font_one_style.';}';
			echo 'strong, .sf-button, h6, .standard-post-date, .sf-count-asset h6.count-subject, .progress-bar-wrap .bar-text > span.progress-value, .portfolio-showcase-wrap ul li .item-info span.item-title, table.sf-table th, .team-member figcaption span, .read-more-button, .pagination-wrap li span.current, #respond .form-submit input#submit, .twitter-link a, .comment-meta .comment-author, .woocommerce span.onsale, .woocommerce .wc-new-badge, .woocommerce .out-of-stock-badge, .woocommerce .free-badge, .woocommerce a.button.alt, .woocommerce .coupon input.apply-coupon, .bag-product-title a, .woocommerce .shipping-calculator-form .update-totals-button button, table.totals_table tr.total, .woocommerce .button.update-cart-button, .woocommerce .button.checkout-button, #product-accordion .accordion-toggle, .woocommerce ul.products li.product-category h3 {font-family: "'.$google_font_one.'", sans-serif;font-style: '.$google_font_one_style.';letter-spacing: normal; font-weight: bold!important;}';
			}
			if ($headings_font_option == "google") {
			echo 'h1, h2, h3, h4, h5, .heading-font, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .spb_call_text, .impact-text, .impact-text-large, .testimonial-text, .header-advert, .spb_call_text, .impact-text, .sf-count-asset .count-number, #base-promo, .sf-countdown, .fancy-heading h1, .sf-icon-character {font-family: "'.$google_font_two.'", sans-serif;font-weight: '.$google_font_two_weight.';font-style: '.$google_font_two_style.';}';
			}
			if ($menu_font_option == "google") {
			echo 'nav .menu li {font-family: "'.$google_font_three.'", sans-serif;font-weight: '.$google_font_three_weight.';font-style: '.$google_font_three_style.';}';
			}
			if ($body_font_option == "fontdeck") {
			$replace_with = 'body, h6, #sidebar .widget-heading h3, #header-search input, .header-items h3.phone-number, .related-wrap h4, #comments-list > h4, .item-heading h1, .sf-button, button, input[type="submit"], input[type="reset"], input[type="button"], input[type="email"], .spb_accordion_section h3, #header-login input, #mobile-navigation > div, .search-form input, input, button, select, textarea {';
			$fd_standard_output = str_replace("div {", $replace_with, $fontdeck_standard_font);
			echo $fd_standard_output;
			$replace_with_bold = 'strong, .sf-button, h6, .standard-post-date, .sf-count-asset h6.count-subject, .progress-bar-wrap .bar-text > span.progress-value, .portfolio-showcase-wrap ul li .item-info span.item-title, table.sf-table th, .team-member figcaption span, .read-more-button, .pagination-wrap li span.current, #respond .form-submit input#submit, .twitter-link a, .comment-meta .comment-author, .woocommerce span.onsale, .woocommerce .wc-new-badge, .woocommerce .out-of-stock-badge, .woocommerce .free-badge, .woocommerce a.button.alt, .woocommerce .coupon input.apply-coupon, .bag-product-title a, .woocommerce .shipping-calculator-form .update-totals-button button, table.totals_table tr.total, .woocommerce .button.update-cart-button, .woocommerce .button.checkout-button, #product-accordion .accordion-toggle, .woocommerce ul.products li.product-category h3 {';
			$fd_standard_bold_output = str_replace("div {", $replace_with_bold, $fontdeck_standard_font);
			echo $fd_standard_bold_output;
			}
			if ($headings_font_option == "fontdeck") {
			$replace_with = 'h1, h2, h3, h4, h5, .heading-font, .custom-caption p, span.dropcap1, span.dropcap2, span.dropcap3, span.dropcap4, .spb_call_text, .impact-text, .impact-text-large, .testimonial-text, .header-advert, .spb_call_text, .impact-text, .sf-count-asset .count-number, #base-promo, .sf-countdown, .fancy-heading h1, .sf-icon-character {';
			$fd_heading_output = str_replace("div {", $replace_with, $fontdeck_heading_font);
			echo $fd_heading_output;
			}
			if ($menu_font_option == "fontdeck") {
			$replace_with = 'nav .menu li {';
			$fd_menu_output = str_replace("div {", $replace_with, $fontdeck_menu_font);
			echo $fd_menu_output;
			}

			// RESPONSIVE STYLES
			if ($enable_responsive) {
			echo '@media only screen and (max-width: 767px) {';
			echo '#top-bar nav .menu > li {border-top-color: '.$topbar_divider_color.';}';
			echo 'nav .menu > li {border-top-color: '.$section_divide_color.';}';
			echo '}';
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
	}

	/* CUSTOM JS OUTPUT
	================================================== */
	function sf_custom_script() {
		$options = get_option('sf_dante_options');
		$custom_js = $options['custom_js'];

		if ($custom_js) {
		echo $custom_js;
		}
	}

	add_action('wp_footer', 'sf_custom_script');
?>