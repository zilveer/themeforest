<?php
    /*
	*
	*	Theme Styling Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	sf_custom_styles()
	*	sf_custom_script()
	*
	*/

    /* CUSTOM CSS OUTPUT
 	================================================== */
    if ( ! function_exists( 'sf_custom_styles' ) ) {
        function sf_custom_styles() {

            global $sf_options, $post;
            $enable_responsive         = $sf_options['enable_responsive'];
            $disable_mobile_animations = $sf_options['disable_mobile_animations'];
            $enable_mini_header_resize = $sf_options['enable_mini_header_resize'];
            $site_maxwidth             = "1170";
            if ( isset( $sf_options['site_maxwidth'] ) ) {
                $site_maxwidth = $sf_options['site_maxwidth'];
            }

            // Standard Styling
            $accent_color               = sf_get_option( 'accent_color', '#66cc66' );
            $accent_alt_color           = sf_get_option( 'accent_alt_color', '#ffffff' );
            $secondary_accent_color     = sf_get_option( 'secondary_accent_color', '#222222' );
            $secondary_accent_alt_color = sf_get_option( 'secondary_accent_alt_color', '#ffffff' );

            // Page Styling
            $page_bg_color             = sf_get_option( 'page_bg_color', '#f7f7f7' );
            $inner_page_bg_transparent = sf_get_option( 'inner_page_bg_transparent', 'color' );
            $inner_page_bg_color       = sf_get_option( 'inner_page_bg_color', '#ffffff' );
            $body_bg_use_image         = $sf_options['use_bg_image'];
            $body_upload_bg            = $body_preset_bg = "";
            if ( isset( $sf_options['custom_bg_image'] ) ) {
                $body_upload_bg = $sf_options['custom_bg_image'];
            }
            if ( isset( $sf_options['preset_bg_image'] ) ) {
                $body_preset_bg = $sf_options['preset_bg_image'];
            }

            $section_divide_color = sf_get_option( 'section_divide_color', '#e4e4e4' );
            $alt_bg_color         = sf_get_option( 'alt_bg_color', '#f7f7f7' );
            $bg_size              = $sf_options['bg_size'];

            // Top Bar Styling
            $topbar_bg_color         = sf_get_option( 'topbar_bg_color', '#ffffff' );
            $topbar_text_color       = sf_get_option( 'topbar_text_color', '#222222' );
            $topbar_link_color       = sf_get_option( 'topbar_link_color', '#666666' );
            $topbar_link_hover_color = sf_get_option( 'topbar_link_hover_color', '#fe504f' );
            $topbar_divider_color    = sf_get_option( 'topbar_divider_color', '#e3e3e3' );

            // Header Styling
            $header_bg_color         = sf_get_option( 'header_bg_color', '#ffffff' );
            $header_bg_transparent   = sf_get_option( 'header_bg_transparent', 'color' );
            $header_border_color     = sf_get_option( 'header_border_color', '#e4e4e4' );
            $header_text_color       = sf_get_option( 'header_text_color', '#222' );
            $header_link_color       = sf_get_option( 'header_link_color', '#222' );
            $header_link_hover_color = sf_get_option( 'header_link_hover_color', '#fe504f' );
            $header_layout           = $sf_options['header_layout'];
            if ( isset( $_GET['header'] ) ) {
                $header_layout = $_GET['header'];
            }
            $page_header_type = "standard";
            if (is_page() && $post) {
            	$page_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
            } else if (is_singular('post') && $post) {
            	$post_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
            	$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
            	$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
            	if ($page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media") {
            		$page_header_type = $post_header_type;
            	}
            }
            if (($page_header_type == "naked-light" || $page_header_type == "naked-dark") && ($header_layout == "header-vert" || $header_layout == "header-vert-right")) {
            	$header_layout = "header-4";
            }

            $header_divider_style = sf_get_option( 'header_divider_style', 'divider' );

            // Mobile Menu Styling
            $mobile_menu_bg_color         = sf_get_option( 'mobile_menu_bg_color', '#222' );
            $mobile_menu_divider_color    = sf_get_option( 'mobile_menu_divider_color', '#444' );
            $mobile_menu_text_color       = sf_get_option( 'mobile_menu_text_color', '#e4e4e4' );
            $mobile_menu_link_color       = sf_get_option( 'mobile_menu_link_color', '#fff' );
            $mobile_menu_link_hover_color = sf_get_option( 'mobile_menu_link_hover_color', '#fe504f' );

            // Logo Setup
            $logo_width = $logo_height = $logo_maxheight = $header_height = $resize_header_height = $retina_logo_width = $logo_padding = $resize_logo_padding = $resize_logo_height = $custom_logo_padding = "";
            $logo = $retina_logo = array();

            $logo_maxheight = $sf_options['logo_maxheight'];

            if (isset($sf_options['logo_padding'])) {
            $custom_logo_padding = $sf_options['logo_padding'];
            }

            if ( isset( $sf_options['logo_upload'] ) ) {
                $logo = $sf_options['logo_upload'];
            }
            if ( isset( $sf_options['retina_logo_upload'] ) ) {
                $retina_logo       = $sf_options['retina_logo_upload'];
                $retina_logo_width = intval( $retina_logo['width'], 10 ) / 2;
            }
            if ( ! isset( $retina_logo['url'] ) && isset( $logo['url'] ) ) {
                $retina_logo['url'] = $logo['url'];
            }
            if ( isset( $logo['height'] ) && $logo['height'] != "" ) {
                $logo_height = $logo['height'];
                $logo_width = $logo['width'];
                $header_height = intval( $logo['height'], 10 );
            } else {
                $logo_height = $header_height = 60;
            }
            if ($logo_height < 70) {
            	$logo_height = 70;
            }

            if ( $logo_height > $logo_maxheight && $logo_maxheight != "" && $logo_maxheight != 0 ) {
                $logo_height   = $logo_maxheight;
                $header_height = $logo_maxheight;
            }

            if ( $logo_height < 80 ) {
                $logo_padding  = apply_filters( 'sf_logo_padding', 20 );
            } else {
                $logo_padding  = apply_filters( 'sf_logo_padding', 10 );
            }
            if ( isset($custom_logo_padding) && $custom_logo_padding != "") {
            	$logo_padding = $custom_logo_padding;
            }
            $resize_logo_padding = $logo_padding / 2;
            $resize_header_height = $header_height + ($resize_logo_padding * 2) . 'px';

            $header_height = $header_height + ( $logo_padding * 2 ) . 'px';

            if ( $header_height == "" ) {
                $header_height = '70px';
            }

            // Navigation Styling
            $nav_hover_style            = sf_get_option( 'nav_hover_style', 'standard' );
            $nav_bg_color               = sf_get_option( 'nav_bg_color', '#fff' );
            $nav_text_color             = sf_get_option( 'nav_text_color', '#252525' );
            $nav_bg_hover_color         = sf_get_option( 'nav_bg_hover_color', '#f7f7f7' );
            $nav_text_hover_color       = sf_get_option( 'nav_text_hover_color', '#fe504f' );
            $nav_selected_bg_color      = sf_get_option( 'nav_selected_bg_color', '#e3e3e3' );
            $nav_selected_text_color    = sf_get_option( 'nav_selected_text_color', '#fe504f' );
            $nav_pointer_color          = sf_get_option( 'nav_pointer_color', '#07c1b6' );
            $nav_sm_bg_color            = sf_get_option( 'nav_sm_bg_color', '#FFFFFF' );
            $nav_sm_text_color          = sf_get_option( 'nav_sm_text_color', '#666666' );
            $nav_sm_text_hover_color    = sf_get_option( 'nav_sm_text_hover_color', '#000000' );
            $nav_sm_selected_text_color = sf_get_option( 'nav_sm_selected_text_color', '#000000' );
            $nav_divider                = sf_get_option( 'nav_divider', 'solid' );
            $nav_divider_color          = sf_get_option( 'nav_divider_color', '#f0f0f0' );
			$nav_text_hover_color_rgb = sf_hex2rgb( $nav_text_hover_color );

            // Overlay Menu Styling
            $overlay_menu_bg_color            = sf_get_option( 'overlay_menu_bg_color', '#e4e4e4' );
            $overlay_menu_text_color		  = sf_get_option( 'overlay_menu_text_color', '#666666' );
            $overlay_menu_link_color          = sf_get_option( 'overlay_menu_link_color', '#222222' );
            $overlay_menu_link_hover_color    = sf_get_option( 'overlay_menu_link_hover_color', '#1dc6df' );
            $overlay_menu_bg_color_rgb        = sf_hex2rgb( $overlay_menu_bg_color );

			// Slideout Menu Styling
			$slideout_menu_bg_color				= sf_get_option( 'slideout_menu_bg_color', '#222' );
			$slideout_menu_bg_image         	= sf_get_option( 'slideout_menu_bg_image', '' );
			$slideout_menu_link_color			= sf_get_option( 'slideout_menu_link_color', '#fff' );
			$slideout_menu_link_hover_color		= sf_get_option( 'slideout_menu_link_hover_color', '#07c1b6' );
			$slideout_menu_divider_color		= sf_get_option( 'slideout_menu_divider_color', '#ccc' );

			// Newsletter Bar Styling
			$newsletter_bar_bg_color			= sf_get_option( 'newsletter_bar_bg_color', '#222' );
			$newsletter_bar_text_color			= sf_get_option( 'newsletter_bar_text_color', '#ccc' );
			$newsletter_bar_link_hover_color	= sf_get_option( 'newsletter_bar_link_hover_color', '#fff' );

			// Header Banner Styling
			$header_banner_bg_color				= sf_get_option( 'header_banner_bg_color', '#fff' );
			$header_banner_text_color			= sf_get_option( 'header_banner_text_color', '#222' );
			$header_banner_link_color			= sf_get_option( 'header_banner_link_color', '#333' );
			$header_banner_link_hover_color		= sf_get_option( 'header_banner_link_hover_color', '#1dc6df' );
			$header_banner_border_color			= sf_get_option( 'header_banner_border_color', '#e3e3e3' );

            // Promo Bar Styling
            $promo_bar_bg_color   = sf_get_option( 'promo_bar_bg_color', '#e4e4e4' );
            $promo_bar_text_color = sf_get_option( 'promo_bar_text_color', '#222' );

            // Breadcrumbs Styling
            $breadcrumb_bg_color   = sf_get_option( 'breadcrumb_bg_color', '#e4e4e4' );
            $breadcrumb_text_color = sf_get_option( 'breadcrumb_text_color', '#666666' );
            $breadcrumb_link_color = sf_get_option( 'breadcrumb_link_color', '#999999' );

            // Page Heading Styling
            $page_heading_bg_color   = sf_get_option( 'page_heading_bg_color', '#f7f7f7' );
            $page_heading_text_color = sf_get_option( 'page_heading_text_color', '#222222' );
            $page_heading_text_align = sf_get_option( 'page_heading_text_align', 'left' );

            // General Styling
            $body_text_color     = sf_get_option( 'body_color', '#222222' );
            $body_alt_text_color = sf_get_option( 'body_alt_color', '#222222' );
            $link_text_color     = sf_get_option( 'link_color', '#444444' );
            $link_hover_color    = sf_get_option( 'link_hover_color', '#999999' );
            $h1_text_color       = sf_get_option( 'h1_color', '#222222' );
            $h2_text_color       = sf_get_option( 'h2_color', '#222222' );
            $h3_text_color       = sf_get_option( 'h3_color', '#222222' );
            $h4_text_color       = sf_get_option( 'h4_color', '#222222' );
            $h5_text_color       = sf_get_option( 'h5_color', '#222222' );
            $h6_text_color       = sf_get_option( 'h6_color', '#222222' );
            $overlay_bg_color    = sf_get_option( 'overlay_bg_color', '#fe504f' );
            $overlay_text_color  = sf_get_option( 'overlay_text_color', '#ffffff' );
            $overlay_opacity     = 100;
            $hover_overlay_rgb   = "";
            if ( isset( $sf_options['overlay_opacity'] ) ) {
                $overlay_opacity   = $sf_options['overlay_opacity'];
                $hover_overlay_rgb = sf_hex2rgb( $overlay_bg_color );
            }

            // Post Detail Styling
            $article_review_bar_alt_color  = sf_get_option( 'article_review_bar_alt_color', '#f7f7f7' );
            $article_review_bar_color      = sf_get_option( 'article_review_bar_color', '#2e2e36' );
            $article_review_bar_text_color = sf_get_option( 'article_review_bar_text_color', '#fff' );
            $article_extras_bg_color       = sf_get_option( 'article_extras_bg_color', '#f7f7f7' );
            $article_np_bg_color           = sf_get_option( 'article_np_bg_color', '#444' );
            $article_np_text_color         = sf_get_option( 'article_np_text_color', '#fff' );

            // UI Elements Styling
            $form_styling = sf_get_option( 'form_styling', 'standard' );
            $input_bg_color   = sf_get_option( 'input_bg_color', '#f7f7f7' );
            $input_text_color = sf_get_option( 'input_text_color', '#222222' );
            $sale_tag_color = sf_get_option( 'sale_tag_color', '#ef3f32' );
            $new_tag_color = sf_get_option( 'new_tag_color', '#fa726e' );
            $oos_tag_color = sf_get_option( 'oos_tag_color', '#999' );

            // Shortcode Styling
            $icon_container_bg_color       = sf_get_option( 'icon_container_bg_color', '#1dc6df' );
            $icon_color                    = sf_get_option( 'sf_icon_color', '#1dc6df' );
            $icon_container_hover_bg_color = sf_get_option( 'icon_container_hover_bg_color', '#222' );
            $icon_alt_color                = sf_get_option( 'sf_icon_alt_color', '#ffffff' );
            $share_button_bg               = sf_get_option( 'share_button_bg', '#fe504f' );
            $share_button_text             = sf_get_option( 'share_button_text', '#ffffff' );
            $bold_rp_bg                    = sf_get_option( 'bold_rp_bg', '#fff' );
            $bold_rp_text                  = sf_get_option( 'bold_rp_text', '#222' );
            $bold_rp_hover_bg              = sf_get_option( 'bold_rp_hover_bg', '#fe504f' );
            $bold_rp_hover_text            = sf_get_option( 'bold_rp_hover_text', '#ffffff' );

            // Content Slider Styling
            $tweet_slider_bg         = sf_get_option( 'tweet_slider_bg', '#ffffff' );
            $tweet_slider_text       = sf_get_option( 'tweet_slider_text', '#222222' );
            $tweet_slider_link       = sf_get_option( 'tweet_slider_link', '#66cc66' );
            $tweet_slider_link_hover = sf_get_option( 'tweet_slider_link_hover', '#222222' );
            $testimonial_slider_bg   = sf_get_option( 'testimonial_slider_bg', '#222222' );
            $testimonial_slider_text = sf_get_option( 'testimonial_slider_text', '#ffffff' );

            // Extra Icon Styling
            $icon_one_color       = sf_get_option( 'icon_one_color', '#FF9900' );
            $icon_one_alt_color   = sf_get_option( 'icon_one_alt_color', '#ffffff' );
            $icon_two_color       = sf_get_option( 'icon_two_color', '#339933' );
            $icon_two_alt_color   = sf_get_option( 'icon_two_alt_color', '#ffffff' );
            $icon_three_color     = sf_get_option( 'icon_three_color', '#cccccc' );
            $icon_three_alt_color = sf_get_option( 'icon_three_alt_color', '#222222' );
            $icon_four_color      = sf_get_option( 'icon_four_color', '#6633ff' );
            $icon_four_alt_color  = sf_get_option( 'icon_four_alt_color', '#ffffff' );

            // Footer Styling
            $footer_bg_color            = sf_get_option( 'footer_bg_color', '#222222' );
            $footer_text_color          = sf_get_option( 'footer_text_color', '#cccccc' );
            $footer_link_color          = sf_get_option( 'footer_link_color', '#ffffff' );
            $footer_link_hover_color    = sf_get_option( 'footer_link_hover_color', '#cccccc' );
            $footer_border_color        = sf_get_option( 'footer_border_color', '#333333' );
            $copyright_bg_color         = sf_get_option( 'copyright_bg_color', '#222222' );
            $copyright_text_color       = sf_get_option( 'copyright_text_color', '#999999' );
            $copyright_link_color       = sf_get_option( 'copyright_link_color', '#ffffff' );
            $copyright_link_hover_color = sf_get_option( 'copyright_link_hover_color', '#cccccc' );


            // PAGE BACKGROUND IMAGE
            global $post;
            $bg_image_url = $inner_bg_image_url = $inner_background_color = $inner_background_image_size = $background_image_size = "";
            if ( $post && is_singular() && !is_search() ) {
	            $page_background_image       = rwmb_meta( 'sf_background_image', 'type=image&size=full' );
	            $inner_page_background_image = rwmb_meta( 'sf_inner_background_image', 'type=image&size=full' );
	            if ( is_array( $page_background_image ) ) {
	                foreach ( $page_background_image as $image ) {
	                    $bg_image_url = $image['url'];
	                    break;
	                }
	            }
	            if ( is_array( $inner_page_background_image ) ) {
	                foreach ( $inner_page_background_image as $image ) {
	                    $inner_bg_image_url = $image['url'];
	                    break;
	                }
	            }
            }

            
            if ( $post && is_singular() && !is_search() ) {
                $inner_background_image_size = sf_get_post_meta( $post->ID, 'sf_inner_background_image_size', true );
                $inner_background_color      = sf_get_post_meta( $post->ID, 'sf_inner_background_color', true );
                $background_image_size       = sf_get_post_meta( $post->ID, 'sf_background_image_size', true );
            }
            
            // WooCommerce Options
            $product_imagewidth_override = false;
            if ( isset( $sf_options['product_imagewidth_override'] ) ) {
            	$product_imagewidth_override = $sf_options['product_imagewidth_override'];
            }

            // Custom CSS
            $custom_css = $sf_options['custom_css'];

            // OPEN STYLE TAG
            echo '<style type="text/css">' . "\n";

            // CUSTOM WIDTH OPTION
            if ( $site_maxwidth != "1170" ) {
                $site_contwidth  = intval( $site_maxwidth, 10 ) - 30;
                $site_boxedwidth = intval( $site_maxwidth, 10 ) + 30;
                echo '@media only screen and (min-width: ' . $site_boxedwidth . 'px) {
					.layout-boxed #container, .boxed-inner-page #main-container, .single-product.page-heading-fancy .product-main, .layout-boxed #sf-newsletter-bar > .container {
						width: ' . $site_boxedwidth . 'px;
					}
					.container {
						width: ' . $site_maxwidth . 'px;
					}
					li.menu-item.sf-mega-menu > ul.sub-menu {
						width: ' . $site_contwidth . 'px;
					}
					#header .is-sticky .sticky-header, #header-section.header-5 #header {
						max-width: ' . $site_contwidth . 'px!important;
					}
					.boxed-layout #header-section.header-3 #header .is-sticky .sticky-header, .boxed-layout #header-section.header-4 #header .is-sticky .sticky-header, .boxed-layout #header-section.header-5 #header .is-sticky .sticky-header {
						max-width: ' . $site_contwidth . 'px;
					}
				}';
            }

            // NON-RESPONSIVE STYLES
            if ( ! $enable_responsive ) {
                $site_contwidth  = intval( $site_maxwidth, 10 ) - 30;
                $site_boxedwidth = intval( $site_maxwidth, 10 ) + 50;
                echo '
					html {
						min-width: ' . $site_maxwidth . 'px;
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
					  width: ' . $site_contwidth . 'px!important;
					  max-width: none!important;
					}
					#header .is-sticky .sticky-header {
					 width: 100%!important;
					 max-width: none!important;
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
						width: ' . $site_boxedwidth . 'px;
					}
					#swift-slider {
						min-width: ' . $site_contwidth . 'px;
					}
					.visible-xs, .visible-sm, .visible-xs.visible-sm {
						display:none!important;
					}
					' . "\n";
            }

            // FONT STYLES
            if ( sf_woocommerce_activated() || sf_edd_activated() ) {
            	$font_directory = get_template_directory_uri() . '/css/font';
            	$shop_icon_style = $sf_options['shop_icon_style'];
				if ($shop_icon_style == "stroke") {
					echo "@font-face {
						font-family: 'si-shop-one';
						src:url('".$font_directory."/si-shop-one.eot?-7oeevn');
						src:url('".$font_directory."/si-shop-one.eot?#iefix-7oeevn') format('embedded-opentype'),
							url('".$font_directory."/si-shop-one.woff?-7oeevn') format('woff'),
							url('".$font_directory."/si-shop-one.ttf?-7oeevn') format('truetype'),
							url('".$font_directory."/si-shop-one.svg?-7oeevn#atelier') format('svg');
						font-weight: normal;
						font-style: normal;
					}
					.sf-icon-cart, .sf-icon-add-to-cart, .sf-icon-variable-options, .sf-icon-soldout {
						font-family: 'si-shop-one'!important;
					}
					.sf-icon-cart:before {
						content: '\\e609';
					}
					.sf-icon-add-to-cart:before {
						content: '\\e608';
					}
					.sf-icon-variable-options:before {
						content: '\\e600';
					}
					.sf-icon-soldout:before {
						content: '\\e601';
					}
					.shopping-bag-item a > span.num-items {
						line-height: 20px!important;
					}
					#mobile-menu ul li.shopping-bag-item > a span.num-items {
					  right: 21px;
					}
					.wishlist-item > a > i {
						vertical-align: -6px!important;
					}
					";
				} else if ($shop_icon_style == "fill") {
					echo "@font-face {
						font-family: 'si-shop-two';
						src:url('".$font_directory."/si-shop-two.eot?-7oeevn');
						src:url('".$font_directory."/si-shop-two.eot?#iefix-7oeevn') format('embedded-opentype'),
							url('".$font_directory."/si-shop-two.woff?-7oeevn') format('woff'),
							url('".$font_directory."/si-shop-two.ttf?-7oeevn') format('truetype'),
							url('".$font_directory."/si-shop-two.svg?-7oeevn#atelier') format('svg');
						font-weight: normal;
						font-style: normal;
					}
					.sf-icon-cart, .sf-icon-add-to-cart, .sf-icon-variable-options, .sf-icon-soldout {
						font-family: 'si-shop-two'!important;
					}
					.sf-icon-cart:before {
						content: '\\e600';
					}
					.sf-icon-add-to-cart:before {
						content: '\\e601';
					}
					.sf-icon-variable-options:before {
						content: '\\e602';
					}
					.sf-icon-soldout:before {
						content: '\\e603';
					}
					#mobile-menu ul li.shopping-bag-item > a span.num-items {
						right: 24px;
						margin-top: -9px;
					}
					.wishlist-item > a > i {
						vertical-align: -6px!important;
					}
					";
				} else if ($shop_icon_style == "basket") {
					echo "@font-face {
						font-family: 'si-shop-three';
						src:url('".$font_directory."/si-shop-three.eot?-7oeevn');
						src:url('".$font_directory."/si-shop-three.eot?#iefix-7oeevn') format('embedded-opentype'),
							url('".$font_directory."/si-shop-three.woff?-7oeevn') format('woff'),
							url('".$font_directory."/si-shop-three.ttf?-7oeevn') format('truetype'),
							url('".$font_directory."/si-shop-three.svg?-7oeevn#atelier') format('svg');
						font-weight: normal;
						font-style: normal;
					}
					.sf-icon-cart, .sf-icon-add-to-cart, .sf-icon-variable-options, .sf-icon-soldout {
						font-family: 'si-shop-three'!important;
					}
					.sf-icon-variable-options:before {
						content: '\\e600';
					}
					.sf-icon-cart:before {
						content: '\\e601';
					}
					.sf-icon-add-to-cart:before {
						content: '\\e602';
					}
					.sf-icon-soldout:before {
						content: '\\e603';
					}
					.shopping-bag-item > a > span.num-items {
						margin-top: -20px;
						right: 1px;
					}
					#mobile-menu ul li.shopping-bag-item > a span.num-items {
					  right: 21px;
					}
					.mobile-header-opts > nav {
						vertical-align: 0;
					}
					";
				}
            }

            if ( $form_styling == "minimal" ) {
            	echo 'input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select, input[type="date"], input[type="tel"], input[type="number"], select {
            	padding: 10px 0;
            	border-left-width: 0!important;
            	border-right-width: 0!important;
            	border-top-width: 0!important;
            	height: 40px;
            	background-color: transparent!important;
            	}
            	textarea, .wpcf7 textarea {
            	height: auto;
            	}
            	select {
            	background-position: 100%;
            	}
            	#commentform label {
            	display: none;
            	}
            	.browser-ie #commentform label {
            		display: block;
            	}
            	.select2-container .select2-choice {
            		border-width: 0!important;
            		border-bottom-width: 2px!important;
            		padding-left: 0;
            		padding: 10px 0;
					background: transparent!important;
            	}
            	.select2-container .select2-choice .select2-arrow b:after {
            		left: 100%;
            	}
            	.woocommerce form .form-row input.input-text {
            		padding: 10px 0;
            	}
            	.woocommerce .shipping-calculator-form select, #jckqv table.variations td select {
            		padding: 8px 0;
            	}
            	.woocommerce .coupon input.input-text, .woocommerce-cart table.cart td.actions .coupon .input-text {
            		padding: 6px 0;
            	}
            	.woocommerce div.product form.cart .variations select, #jckqv table.variations td select {
            		padding-left: 0;
            		  background-position: 100% center;
            	}
            	@media only screen and (max-width: 767px) {
            	#commentform p > span.required {
            		position: absolute;
            		top: 0;
            		left: 18px;
            	}
            	}
            	';
            }

            // CUSTOM COLOUR STYLES
            echo '::selection, ::-moz-selection {background-color: ' . $accent_color . '; color: #fff;}';
            echo '.accent-bg, .funded-bar .bar {background-color:' . $accent_color . ';}';
            echo '.accent {color:' . $accent_color . ';}';
            echo 'span.highlighted, span.dropcap4, .loved-item:hover .loved-count, .flickr-widget li, .portfolio-grid li, figcaption .product-added, .woocommerce .widget_layered_nav ul li.chosen small.count, .woocommerce .widget_layered_nav_filters ul li a, .sticky-post-icon, .fw-video-close:hover {background-color: ' . $accent_color . '!important; color: ' . $accent_alt_color . '!important;}';
            echo 'a:hover, a:focus, #sidebar a:hover, .pagination-wrap a:hover, .carousel-nav a:hover, .portfolio-pagination div:hover > i, #footer a:hover, .beam-me-up a:hover span, .portfolio-item .portfolio-item-permalink, .read-more-link, .blog-item .read-more, .blog-item-details a:hover, .author-link, span.dropcap2, .spb_divider.go_to_top a, .item-link:hover, #header-translation p a, #breadcrumbs a:hover, .ui-widget-content a:hover, .yith-wcwl-add-button a:hover, #product-img-slider li a.zoom:hover, .woocommerce .star-rating span, #jckqv .woocommerce-product-rating .star-rating span:before, .article-body-wrap .share-links a:hover, ul.member-contact li a:hover, .bag-product a.remove:hover, .bag-product-title a:hover, #back-to-top:hover,  ul.member-contact li a:hover, .fw-video-link-image:hover i, .ajax-search-results .all-results:hover, .search-result h5 a:hover .ui-state-default a:hover, .fw-video-link-icon:hover {color: ' . $accent_color . ';}';
            echo '.carousel-wrap > a:hover,  .woocommerce p.stars a.active:after,  .woocommerce p.stars a:hover:after {color: ' . $accent_color . '!important;}';
            //echo '.comments-likes a:hover span, .comments-likes a:hover i {color: '.$accent_color.'!important;}';
            echo '.read-more i:before, .read-more em:before {color: ' . $accent_color . ';}';
            echo 'textarea:focus, input:focus, input[type="text"]:focus, input[type="email"]:focus, textarea:focus, .bypostauthor .comment-wrap .comment-avatar,.search-form input:focus, .wpcf7 input:focus, .wpcf7 textarea:focus, .ginput_container input:focus, .ginput_container textarea:focus, .mymail-form input:focus, .mymail-form textarea:focus, input[type="tel"]:focus, input[type="number"]:focus {border-color: ' . $accent_color . '!important;}';
            echo 'nav .menu ul li:first-child:after,.navigation a:hover > .nav-text, .returning-customer a:hover {border-bottom-color: ' . $accent_color . ';}';
            echo 'nav .menu ul ul li:first-child:after {border-right-color: ' . $accent_color . ';}';
            echo '.spb_impact_text .spb_call_text {border-left-color: ' . $accent_color . ';}';
            echo '.spb_impact_text .spb_button span {color: #fff;}';
            echo 'a[rel="tooltip"], ul.member-contact li a, a.text-link, .tags-wrap .tags a, .logged-in-as a, .comment-meta-actions .edit-link, .comment-meta-actions .comment-reply, .read-more {border-color: ' . $link_text_color . ';}';
            echo '.super-search-go {border-color: ' . $accent_color . '!important;}';
            echo '.super-search-go:hover {background: ' . $accent_color . '!important;border-color: ' . $accent_color . '!important;}';
            echo '.owl-pagination .owl-page span {background-color: ' . $section_divide_color . ';}';
            echo '.owl-pagination .owl-page::after {background-color: ' . $accent_color . ';}';
            echo '.owl-pagination .owl-page:hover span, .owl-pagination .owl-page.active a {background-color: ' . $secondary_accent_color . ';}';
            echo 'body.header-below-slider .home-slider-wrap #slider-continue:hover {border-color: ' . $accent_color . ';}';
            echo 'body.header-below-slider .home-slider-wrap #slider-continue:hover i {color: ' . $accent_color . ';}';
            echo '#one-page-nav li a:hover > i {background: ' . $accent_color . ';}';
            echo '#one-page-nav li.selected a:hover > i {border-color: ' . $accent_color . ';}';
            echo '#one-page-nav li .hover-caption {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '#one-page-nav li .hover-caption:after {border-left-color: ' . $accent_color . ';}';
			echo '.love-it:hover > svg .stroke {stroke: '.$accent_color.'!important;}';
			echo '.love-it:hover > svg .fill {fill: '.$accent_color.'!important;}';
			echo '.side-details .love-it > svg .stroke {stroke: '.$section_divide_color.';}';			
			echo '.side-details .love-it > svg .fill {fill: '.$section_divide_color.';}';			
			echo '.side-details .comments-wrapper > svg .stroke {stroke: '.$section_divide_color.';}';			
			echo '.side-details .comments-wrapper > svg .fill {fill: '.$section_divide_color.';}';			
			echo '.comments-wrapper a:hover > svg .stroke {stroke: '.$accent_color.'!important;}';
			echo '.comments-wrapper a:hover span, .love-it:hover span.love-count {color: '.$accent_color.'!important;}';
			echo '.circle-bar .spinner > div {border-top-color: '.$accent_color.';border-right-color: '.$accent_color.';}';
			
            // MAIN STYLES
            echo '#sf-home-preloader, #site-loading {background-color: ' . $inner_page_bg_color . ';}';
            echo '.loading-bar-transition .pace .pace-progress {background-color: ' . $accent_color . ';}';
            echo '.spinner .circle-bar {border-left-color:' . $section_divide_color . ';border-bottom-color:' . $section_divide_color . ';border-right-color:' . $accent_color . ';border-top-color:' . $accent_color . ';}';
            echo '.orbit-bars .spinner > div:before {border-top-color:' . $accent_color . ';border-bottom-color:' . $accent_color . ';}';
            echo '.orbit-bars .spinner > div:after {background-color: '.$section_divide_color.';}';
            if ( $body_bg_use_image ) {
                if ( is_array($body_upload_bg) && $body_upload_bg['url'] != "" ) {
                    echo 'body, .layout-fullwidth #container {background: ' . $page_bg_color . ' url(' . $body_upload_bg['url'] . ') repeat center top fixed;}';
                } else if ( $body_preset_bg ) {
                    echo 'body, .layout-fullwidth #container {background: ' . $page_bg_color . ' url(' . $body_preset_bg . ') repeat center top fixed;}';
                }
                if ( $page_bg_color != "" ) {
                    echo 'body, .layout-fullwidth #container {background-color: ' . $page_bg_color . ';background-size: ' . $bg_size . ';}';
                }
            } else if ( $page_bg_color != "" ) {
                echo 'body, .layout-fullwidth #container {background-color: ' . $page_bg_color . ';}';
            }
            echo '#main-container, .tm-toggle-button-wrap a {background-color: ' . $inner_page_bg_color . ';}';
            echo '.tabbed-heading-wrap .heading-text {background-color: ' . $inner_page_bg_color . ';}';
			echo '.single-product.page-heading-fancy .product-main {background-color: ' . $inner_page_bg_color . ';}';
			echo '.spb-row-container[data-top-style="slant-ltr"]:before, .spb-row-container[data-top-style="slant-rtl"]:before, .spb-row-container[data-bottom-style="slant-ltr"]:after, .spb-row-container[data-bottom-style="slant-rtr"]:after {background-color: ' . $inner_page_bg_color . ';}';
						
            if ( $inner_background_color != "" ) {
            	echo '.tabbed-heading-wrap .heading-text {background-color: ' . $inner_background_color . ';}';
                echo '#main-container, .blog-items.timeline-items .standard-post-content {background-color: ' . $inner_background_color . ';}';
                echo '.boxed-inner-page .inner-page-wrap {background-color: ' . $inner_background_color . ';}';
                echo '.single-product.page-heading-fancy .product-main {background-color: ' . $inner_background_color . ';}';
                echo 'body.product-fw-split div.product div.summary {background-color: ' . $inner_background_color . ';}';
                echo '.spb-row-container[data-top-style="slant-ltr"]:before, .spb-row-container[data-top-style="slant-rtl"]:before, .spb-row-container[data-bottom-style="slant-ltr"]:after, .spb-row-container[data-bottom-style="slant-rtr"]:after {background-color: ' . $inner_background_color . ';}';
            }
            if ( $inner_page_bg_transparent == "transparent" ) {
                echo '#main-container {background-color: transparent;}';
            }
            echo 'a, .ui-widget-content a, #respond .form-submit input[type=submit] {color: ' . $link_text_color . ';}';
            echo 'a:hover, a:focus {color: ' . $link_hover_color . ';}';
            echo 'ul.bar-styling li:not(.selected) > a:hover, ul.bar-styling li > .comments-likes:hover {color: ' . $accent_alt_color . ';background: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
            echo 'ul.bar-styling li > .comments-likes:hover * {color: ' . $accent_alt_color . '!important;}';
            echo 'ul.bar-styling li > a, ul.bar-styling li > div, ul.page-numbers li > a, ul.page-numbers li > span, .curved-bar-styling, ul.bar-styling li > form input, .spb_directory_filter_below {border-color: ' . $section_divide_color . ';}';
            echo 'ul.bar-styling li > a, ul.bar-styling li > span, ul.bar-styling li > div, ul.bar-styling li > form input {background-color: ' . $inner_page_bg_color . ';}';
            echo '.pagination-wrap {border-color: ' . $section_divide_color . ';}';
            echo '.pagination-wrap ul li a {border-color: transparent;}';
            echo 'ul.page-numbers li > a:hover, ul.page-numbers li > span.current, .pagination-wrap ul li > a:hover, .pagination-wrap ul li span.current {border-color: ' . $section_divide_color . '!important;color: ' . $body_alt_text_color . '!important;}';
            echo 'input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select, input[type="date"], input[type="tel"], input.input-text, input[type="number"], .select2-container .select2-choice {border-color: ' . $section_divide_color . ';background-color: ' . $input_bg_color . ';color:' . $input_text_color . ';}';
            echo '.select2-container .select2-choice>.select2-chosen {color:' . $input_text_color . '!important;}';
            echo '::-webkit-input-placeholder {color:' . $input_text_color . '!important;}';
            echo ':-moz-placeholder {color:' . $input_text_color . '!important;}';
            echo '::-moz-placeholder {color:' . $input_text_color . '!important;}';
            echo ':-ms-input-placeholder {color:' . $input_text_color . '!important;}';
            echo 'input[type=submit], button[type=submit], input[type="file"], select, .wpcf7 input.wpcf7-submit[type=submit] {border-color: ' . $section_divide_color . ';color: ' . $input_text_color . ';}';
            echo 'input[type=submit]:hover, button[type=submit]:hover, .wpcf7 input.wpcf7-submit[type=submit]:hover, .gform_wrapper input[type=submit]:hover, .mymail-form input[type=submit]:hover {background: ' . $secondary_accent_color . ';border-color: ' . $secondary_accent_color . '; color: ' . $secondary_accent_alt_color . ';}';
            echo '.modal-header {background: ' . $alt_bg_color . ';}';
            echo '.modal-content {background: ' . $inner_page_bg_color . ';}';
            echo '.modal-header h3, .modal-header .close {color: '. $body_text_color.';}';
            echo '.modal-header .close:hover {color: '. $accent_color.';}';
            echo '.recent-post .post-details, .portfolio-item h5.portfolio-subtitle, .search-item-content time, .search-item-content span, .portfolio-details-wrap .date {color: ' . $body_alt_text_color . ';}';
            echo 'ul.bar-styling li.facebook > a:hover {color: #fff!important;background: #3b5998;border-color: #3b5998;}';
            echo 'ul.bar-styling li.twitter > a:hover {color: #fff!important;background: #4099FF;border-color: #4099FF;}';
            echo 'ul.bar-styling li.google-plus > a:hover {color: #fff!important;background: #d34836;border-color: #d34836;}';
            echo 'ul.bar-styling li.pinterest > a:hover {color: #fff!important;background: #cb2027;border-color: #cb2027;}';
			
            // TOP BAR STYLES
            echo '#top-bar {background: ' . $topbar_bg_color . '; border-bottom-color: '.$topbar_divider_color.';}';
            echo '#top-bar .tb-text {color: ' . $topbar_text_color . ';}';
            echo '#top-bar .tb-text > a, #top-bar nav .menu > li > a {color: ' . $topbar_link_color . ';}';
            echo '#top-bar .menu li {border-left-color: ' . $topbar_divider_color . '; border-right-color: ' . $topbar_divider_color . ';}';
            echo '#top-bar .menu > li > a, #top-bar .menu > li.parent:after {color: ' . $topbar_link_color . ';}';
            echo '#top-bar .menu > li:hover > a, #top-bar a:hover {color: ' . $topbar_link_hover_color . '!important;}';

            // HEADER STYLES
            if ( $header_bg_transparent == "transparent" ) {
                echo '.header-wrap, .vertical-header .header-wrap #header-section {background-color:transparent;}';
                echo '.vertical-header #container .header-wrap {-moz-box-shadow: none;-webkit-box-shadow: none;box-shadow: none;}';
            } else {
                echo '.header-wrap #header, .header-standard-overlay #header, .vertical-header .header-wrap #header-section, #header-section .is-sticky #header.sticky-header {background-color:' . $header_bg_color . ';}';
                echo '.fs-search-open .header-wrap #header, .fs-search-open .header-standard-overlay #header, .fs-search-open .vertical-header .header-wrap #header-section, .fs-search-open #header-section .is-sticky #header.sticky-header {background-color: ' . $overlay_menu_bg_color . ';}';
                echo '.fs-supersearch-open .header-wrap #header, .fs-supersearch-open .header-standard-overlay #header, .fs-supersearch-open .vertical-header .header-wrap #header-section, .fs-supersearch-open #header-section .is-sticky #header.sticky-header {background-color: ' . $overlay_menu_bg_color . ';}';
                echo '.overlay-menu-open .header-wrap #header, .overlay-menu-open .header-standard-overlay #header, .overlay-menu-open .vertical-header .header-wrap #header-section, .overlay-menu-open #header-section .is-sticky #header.sticky-header {background-color: ' . $overlay_menu_bg_color . ';}';
                
            }
            echo '#sf-header-banner {background-color:' . $header_banner_bg_color . '; border-bottom: 2px solid' . $header_banner_border_color . ';}';
            echo '#sf-header-banner {color:' . $header_banner_text_color . ';}';
            echo '#sf-header-banner a {color:' . $header_banner_link_color . ';}';
            echo '#sf-header-banner a:hover {color:' . $header_banner_link_hover_color . ';}';
            echo '.header-left, .header-right, .vertical-menu-bottom .copyright {color: ' . $header_text_color . ';}';
            echo '.header-left a, .header-right a, .vertical-menu-bottom .copyright a, #header .header-left ul.menu > li > a.header-search-link-alt, #header .header-right ul.menu > li > a.header-search-link, #header .header-right ul.menu > li > a.header-search-link-alt {color: ' . $header_link_color . ';}';
            echo '.header-left a:hover, .header-right a:hover, .vertical-menu-bottom .copyright a:hover {color: ' . $header_link_hover_color . ';}';
            echo '#header .header-left ul.menu > li:hover > a.header-search-link-alt, #header .header-right ul.menu > li:hover > a.header-search-link-alt {color: ' . $header_link_hover_color . '!important;}';
            echo '#header-search a:hover, .super-search-close:hover {color: ' . $accent_color . ';}';
            echo '.sf-super-search {background-color: ' . $secondary_accent_color . ';}';
            echo '.sf-super-search .search-options .ss-dropdown ul {background-color: ' . $accent_color . ';}';
            echo '.sf-super-search .search-options .ss-dropdown ul li a {color: ' . $accent_alt_color . ';}';
            echo '.sf-super-search .search-options .ss-dropdown ul li a:hover {color: ' . $secondary_accent_color . ';}';
            echo '.sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input {color: ' . $accent_color . '; border-bottom-color: ' . $accent_color . ';}';
            echo '.sf-super-search .search-options .ss-dropdown ul li .fa-check {color: ' . $secondary_accent_color . ';}';
            echo '.sf-super-search-go:hover, .sf-super-search-close:hover { background-color: ' . $accent_color . '; border-color: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '.header-languages .current-language {color: ' . $nav_sm_selected_text_color . ';}';
            echo '#header-section #main-nav {border-top-color: ' . $nav_divider_color . ';}';
            echo '.ajax-search-wrap {background-color:' . $nav_bg_color . '}';
            echo '.ajax-search-wrap, .ajax-search-results, .search-result-pt .search-result, .vertical-header .ajax-search-results {border-color: ' . $nav_divider_color . ';}';
            echo '.page-content {border-bottom-color: ' . $section_divide_color . ';}';
            echo '.ajax-search-wrap input[type="text"], .search-result-pt h6, .no-search-results h6, .search-result h5 a, .no-search-results p {color: ' . $nav_text_color . ';}';
            if ( $header_bg_color != "#ffffff" ) {
                echo '.search-item-content time {color: ' . $nav_divider_color . ';}';
            }
            if ( $header_divider_style == "divider" ) {
                echo '.header-wrap, #header-section .is-sticky .sticky-header, #header-section.header-5 #header {border-bottom: 2px solid ' . $header_border_color . ';}';
                echo '.vertical-header .header-wrap {border-right: 2px solid ' . $header_border_color . ';}';
                echo '.vertical-header-right .header-wrap {border-left: 2px solid ' . $header_border_color . ';}';
                echo 'nav.std-menu ul.sub-menu {border: 2px solid' . $header_border_color . ';}';
                echo '.is-sticky nav.std-menu ul.sub-menu {border-top-width: 0;}';
                echo 'nav.std-menu .sf-mega-menu ul.sub-menu ul.sub-menu {border: 0!important;}';
            } else if ( $header_divider_style == "shadow" ) {
                echo '.header-wrap, .vertical-header .header-wrap, #header-section .is-sticky .sticky-header, #header-section.header-5 #header {-moz-box-shadow: 0 3px 5px rgba(0,0,0,.1);-webkit-box-shadow: 0 3px 5px rgba(0,0,0,.1);box-shadow: 0 3px 5px rgba(0,0,0,.1);}';
                echo 'nav.std-menu ul.sub-menu {-moz-box-shadow: 0 0 5px -1px rgba(0,0,0,.2);-webkit-box-shadow: 0 0 5px -1px rgba(0,0,0,.2);box-shadow: 0 0 5px -1px rgba(0,0,0,.2);}';
            } else {
            	echo '.header-wrap, #header-section .is-sticky .sticky-header, #header-section.header-5 #header, #header .header-right .aux-item, #header .header-left .aux-item {border-color: transparent!important;}';
            	echo '.header-left .aux-item, .header-right .aux-item {padding-left: 10px;padding-right: 10px;}';
            	echo '.aux-item .std-menu.cart-wishlist {margin-left: 0; margin-right: 0;}';
            	echo '#header .aux-item .std-menu li.shopping-bag-item > a {padding-left: 0;}';
            }
            echo '.header-left .aux-item, .header-right .aux-item {border-color: ' . $header_border_color . '!important;}';
			echo '#contact-slideout {background: ' . $inner_page_bg_color . ';}';
			
            // MOBILE HEADER STYLES
            echo '#mobile-top-text, #mobile-header {background-color: ' . $header_bg_color . ';border-bottom-color:' . $header_border_color . ';}';
            echo '#mobile-top-text, #mobile-logo h1 {color: ' . $header_text_color . ';}';
            echo '#mobile-top-text a, #mobile-header a {color: ' . $header_link_color . ';}';
            echo '#mobile-header a {color: ' . $header_link_color . ';}';
            echo '#mobile-header a.mobile-menu-link span.menu-bars, #mobile-header a.mobile-menu-link span.menu-bars:before, #mobile-header a.mobile-menu-link span.menu-bars:after {background-color: ' . $header_link_color . ';}';
            echo '#mobile-header a.mobile-menu-link:hover span.menu-bars, #mobile-header a.mobile-menu-link:hover span.menu-bars:before, #mobile-header a.mobile-menu-link:hover span.menu-bars:after {background-color: ' . $header_link_hover_color . ';}';
            echo '#mobile-menu-wrap, #mobile-cart-wrap {background-color: ' . $mobile_menu_bg_color . ';color: ' . $mobile_menu_text_color . ';}';
            echo '.mobile-search-form input[type="text"] {color: ' . $mobile_menu_text_color . ';border-bottom-color: ' . $mobile_menu_divider_color . ';}';
            echo '.mobile-search-form ::-webkit-input-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
			echo '.mobile-search-form :-moz-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
			echo '.mobile-search-form ::-moz-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
			echo '.mobile-search-form :-ms-input-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
            echo '#mobile-menu-wrap a, #mobile-cart-wrap a:not(.sf-button), #mobile-menu-wrap .shopping-bag-item a > span.num-items {color: ' . $mobile_menu_link_color . ';}';
            echo '.shop-icon-fill #mobile-menu-wrap .shopping-bag-item a > span.num-items {color: ' . $mobile_menu_bg_color . '!important;}';
            echo '#mobile-menu-wrap a:hover, #mobile-cart-wrap a:not(.sf-button):hover,  #mobile-menu ul li:hover > a {color: ' . $mobile_menu_link_hover_color . '!important;}';
            echo '#mobile-menu-wrap .bag-buttons a.wishlist-button {color: ' . $mobile_menu_link_color . '!important;}';
			echo '#mobile-menu ul li.parent > a:after {color: ' . $mobile_menu_text_color . ';}';
            echo '#mobile-cart-wrap .shopping-bag-item > a.cart-contents, #mobile-cart-wrap .bag-product, #mobile-cart-wrap .bag-empty {border-bottom-color: ' . $mobile_menu_divider_color . ';}';
            echo '#mobile-menu ul li, .mobile-cart-menu li, .mobile-cart-menu .bag-header, .mobile-cart-menu .bag-product, .mobile-cart-menu .bag-empty {border-color: ' . $mobile_menu_divider_color . ';}';
            echo 'a.mobile-menu-link span, a.mobile-menu-link span:before, a.mobile-menu-link span:after {background: ' . $mobile_menu_link_color . ';}';
            echo 'a.mobile-menu-link:hover span, a.mobile-menu-link:hover span:before, a.mobile-menu-link:hover span:after {background: ' . $mobile_menu_link_hover_color . ';}';
            echo '#mobile-cart-wrap .bag-buttons > a.bag-button {color: '.$mobile_menu_link_color.'!important;border-color: '.$mobile_menu_link_color.';}';
			echo '#mobile-cart-wrap .bag-product a.remove {color: '.$mobile_menu_link_color.'!important;}';
			echo '#mobile-cart-wrap .bag-product a.remove:hover {color: '.$mobile_menu_link_hover_color.'!important;}';

            // LOGO STYLES
			if ( $logo_height != "" ) {
			    echo '#logo.has-img, .header-left, .header-right {height:' . $logo_height . 'px;}';
			    echo '#mobile-logo {max-height:' . $logo_height . 'px;}';
			    echo '#mobile-logo.has-img img {max-height:' . $logo_height . 'px;}';
			    echo '.full-center #logo.has-img a > img {max-height: '.$header_height.';}';
			    echo '.header-left, .header-right {line-height:' . $logo_height . 'px;}';
			}
			if ($logo_width != "") {
				echo '.browser-ie #logo {width:' . $logo_width . 'px;}';
			}
			if ( $retina_logo_width != "" ) {
			    echo '#logo img.retina {width:' . $retina_logo_width . 'px;}';
			}
			if ( $logo_padding != "" ) {
			    echo '#logo.has-img a > img {padding: ' . $logo_padding . 'px 0;}';
			    echo '.header-2 #logo.has-img img {max-height:' . $logo_height . 'px;}';
			}
			if ( $logo_maxheight != "" && $logo_maxheight != 0 ) {
				echo '#logo.has-img img {max-height:' . $logo_maxheight . 'px;}';
				if ( $logo_height == "" ) {
				echo '#mobile-logo.has-img img {max-height:' . $logo_maxheight . 'px;}';
				}
				$header_height_num = str_replace( $header_height, 'px', '' );
				if ( $header_height_num != "" && $logo_maxheight > $header_height_num) {
					$logo_maxheight = $header_height_num;
				}
				echo '.full-center #logo.has-img a > img {max-height: '.$logo_maxheight.'px;padding: 0;}';
			}
            if ( $header_height != "" ) {
                echo '.full-header-stick #header, .full-header-stick #logo, .full-header-stick .header-left, .full-header-stick .header-right {height:' . $header_height . ';line-height:' . $header_height . ';}';
                echo '.full-center #main-navigation ul.menu > li > a, .full-center .header-right ul.menu > li > a, .full-center nav.float-alt-menu ul.menu > li > a, .full-center .header-right div.text, .full-center #header .aux-item ul.social-icons li {height:' . $header_height . ';line-height:' . $header_height . ';}';
                echo '.full-center #header, .full-center .float-menu, .header-split .float-menu {height:' . $header_height . ';}';
                echo '.full-center nav li.menu-item.sf-mega-menu > ul.sub-menu, .full-center .ajax-search-wrap {top:' . $header_height . '!important;}';
                echo '.browser-ff #logo a {height:' . $header_height . ';}';
            	echo '.full-center #logo {max-height:' . $header_height . ';}';
            	echo '.header-6 .header-left, .header-6 .header-right, .header-6 #logo.has-img {height:' . $header_height . ';line-height:' . $header_height . ';}';
            	echo '.header-6 #logo.has-img a > img {padding: 0;}';
            }
            if ( $resize_header_height != "" && $enable_mini_header_resize ) {
            	echo '#logo.has-img a {height:' . $header_height . ';}';
            	echo '#logo.has-img a > img {padding: 0 10px;}';
            	echo '.full-center.resized-header #main-navigation ul.menu > li > a, .full-center.resized-header .header-right ul.menu > li > a, .full-center.resized-header nav.float-alt-menu ul.menu > li > a, .full-center.resized-header .header-right div.text, .full-header-stick.resized-header #header, .full-header-stick.resized-header #logo, .full-header-stick.resized-header .header-left, .full-header-stick.resized-header .header-right, .full-center.resized-header  #header .aux-item ul.social-icons li {height:' . $resize_header_height . ';line-height:' . $resize_header_height . ';}';
            	echo '.full-center.resized-header #logo, .full-center.resized-header #logo.no-img a {height:' . $resize_header_height . ';}';
            	echo '.full-center.resized-header #header, .full-center.resized-header .float-menu, .header-split.resized-header .float-menu {height:' . $resize_header_height . ';}';
            	echo '.full-center.resized-header nav ul.menu > li.menu-item > ul.sub-menu, .full-center.resized-header nav li.menu-item.sf-mega-menu > ul.sub-menu, .full-center.resized-header nav li.menu-item.sf-mega-menu-alt > ul.sub-menu, .full-center.resized-header .ajax-search-wrap {top:' . $resize_header_height . '!important;}';
            	echo '.browser-ff .resized-header #logo a {height:' . $resize_header_height . ';}';
            	echo '.resized-header #logo.has-img a {height:' . $resize_header_height . ';}';
            	echo '.full-center.resized-header nav.float-alt-menu ul.menu > li > ul.sub-menu {top:' . $resize_header_height . '!important;}';
            }

            // NAVIGATION STYLES
            echo '#main-nav, .header-wrap[class*="page-header-naked"] #header-section .is-sticky #main-nav, .header-wrap #header-section .is-sticky #header.sticky-header, .header-wrap #header-section.header-5 #header, .header-wrap[class*="page-header-naked"] #header .is-sticky .sticky-header, .header-wrap[class*="page-header-naked"] #header-section.header-5 #header .is-sticky .sticky-header {background-color: ' . $nav_bg_color . ';}';
            echo '#main-nav {border-color: ' . $nav_divider_color . ';border-top-style: ' . $nav_divider . ';}';
            echo '.show-menu {background-color: ' . $secondary_accent_color . ';color: ' . $secondary_accent_alt_color . ';}';
            echo 'nav .menu > li:before {background: ' . $nav_pointer_color . ';}';
            echo 'nav .menu .sub-menu .parent > a:after {border-left-color: ' . $nav_pointer_color . ';}';
            echo 'nav .menu ul.sub-menu, li.menu-item.sf-mega-menu > ul.sub-menu > div {background-color: ' . $nav_sm_bg_color . ';}';
            echo 'nav .menu ul.sub-menu li {border-top-color: ' . $nav_divider_color . ';border-top-style: ' . $nav_divider . ';}';
            echo 'li.menu-item.sf-mega-menu > ul.sub-menu > li {border-top-color: ' . $nav_divider_color . ';border-top-style: ' . $nav_divider . ';}';
            echo 'li.menu-item.sf-mega-menu > ul.sub-menu > li {border-left-color: ' . $nav_divider_color . ';border-left-style: ' . $nav_divider . ';}';
            if ( $nav_divider == "none" ) {
                echo '#main-nav {border-width: 0;}';
            }
            echo 'nav .menu > li.menu-item > a, nav.std-menu .menu > li > a {color: ' . $nav_text_color . ';}';
            echo '#main-nav ul.menu > li, #main-nav ul.menu > li:first-child, #main-nav ul.menu > li:first-child, .full-center nav#main-navigation ul.menu > li, .full-center nav#main-navigation ul.menu > li:first-child, .full-center #header nav.float-alt-menu ul.menu > li {border-color: ' . $nav_divider_color . ';}';
            echo 'nav ul.menu > li.menu-item.sf-menu-item-btn > a {border-color: ' . $nav_text_color . ';background-color: ' . $nav_text_color . ';color: ' . $nav_text_hover_color . ';}';
            echo 'nav ul.menu > li.menu-item.sf-menu-item-btn:hover > a {border-color: ' . $accent_color . '; background-color: ' . $accent_color . '; color: ' . $accent_alt_color . '!important;}';
			//echo '#main-navigation ul.menu > li:hover > a {box-shadow: 0 5px 0 rgba(' . $nav_text_hover_color_rgb["red"] . ',' . $nav_text_hover_color_rgb["green"] . ',' . $nav_text_hover_color_rgb["blue"] . ', 0.7) inset;}';
            if ( $nav_hover_style == "bold" ) {
                echo 'nav .menu > li.current-menu-ancestor > a, nav .menu > li.current-menu-item > a, nav .menu > li.current-scroll-item > a, #mobile-menu .menu ul li.current-menu-item > a {background-color:' . $nav_selected_bg_color . ';color: ' . $nav_selected_text_color . ';}';
                echo '#header-section.header-5 #header nav.float-alt-menu {margin-right:0;}';
                echo 'nav .menu > li.menu-item:hover > a, nav.std-menu .menu > li:hover > a {background-color:' . $nav_bg_hover_color . ';color: ' . $nav_text_hover_color . '!important;}';
            } else {
                echo '#main-nav ul.menu > li, .full-center nav#main-navigation ul.menu > li, .full-center nav.float-alt-menu ul.menu > li, .full-center #header nav.float-alt-menu ul.menu > li {border-width: 0!important;}';
                echo '.full-center nav#main-navigation ul.menu > li:first-child {border-width: 0;margin-left: -15px;}';
                echo '#main-nav .menu-right {right: -5px;}';
                echo 'nav .menu > li.menu-item:hover > a, nav.std-menu .menu > li:hover > a {color: ' . $nav_text_hover_color . '!important;}';
                echo 'nav .menu > li.current-menu-ancestor > a, nav .menu > li.current-menu-item > a, nav .menu > li.current-scroll-item > a, #mobile-menu .menu ul li.current-menu-item > a {color: ' . $nav_selected_text_color . ';}';
            }
            echo '.shopping-bag-item a > span.num-items {border-color: '.$header_link_color.';}';
            //echo '.shop-icon-fill .shopping-bag-item > a > i {color: '.$header_link_color.';}';
            echo '.shop-icon-fill .shopping-bag-item > a > i {color: inherit;}';
            echo '.shop-icon-fill .shopping-bag-item a > span.num-items, .shop-icon-fill .shopping-bag-item:hover a > span.num-items {color: '.$header_bg_color.'!important;}';
            //echo '.shop-icon-fill .shopping-bag-item:hover > a > i {color: '.$header_link_hover_color.';}';
            echo '.shop-icon-fill .shopping-bag-item:hover > a > i {color: inherit;}';
            //echo '#header .shopping-bag-item:hover > a {color: '.$header_link_hover_color.'!important;}';
            echo '.header-left ul.sub-menu > li > a:hover, .header-right ul.sub-menu > li > a:hover {color: '.$nav_text_hover_color.';}';
            echo '.shopping-bag-item a > span.num-items:after {border-color: '.$nav_text_hover_color.';}';
            echo '.shopping-bag-item:hover a > span.num-items {border-color: '.$nav_text_hover_color.'!important; color: '.$nav_text_hover_color.'!important;}';
			echo '.shopping-bag-item:hover a > span.num-items:after {border-color: '.$nav_text_hover_color.'!important;}';
			echo '.page-header-naked-light .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items {color: '.$header_bg_color.'}';
			echo '.page-header-naked-light .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items:after, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items:after {border-color: '.$nav_text_hover_color.';}';
            echo 'nav .menu ul.sub-menu li.menu-item > a, nav .menu ul.sub-menu li > span, nav.std-menu ul.sub-menu {color: ' . $nav_sm_text_color . ';}';
            echo '.bag-buttons a.bag-button, .bag-buttons a.wishlist-button {color: ' . $nav_sm_text_color . '!important;}';
            echo '.bag-product a.remove, .woocommerce .bag-product a.remove {color: ' . $nav_sm_text_color . '!important;}';
            echo '.bag-product a.remove:hover, .woocommerce .bag-product a.remove:hover {color: ' . $accent_color . '!important;}';
            echo 'nav .menu ul.sub-menu li.menu-item:hover > a, .bag-product a.remove:hover {color: ' . $nav_sm_text_hover_color . '!important;}';
            echo 'nav .menu li.parent > a:after, nav .menu li.parent > a:after:hover, .ajax-search-wrap:after {color: ' . $nav_text_color . ';}';
            echo 'nav .menu ul.sub-menu li.current-menu-ancestor > a, nav .menu ul.sub-menu li.current-menu-item > a {color: ' . $nav_sm_selected_text_color . '!important;}';
            echo '#main-nav .header-right ul.menu > li, .wishlist-item {border-left-color: ' . $nav_divider_color . ';}';
            echo '.bag-header, .bag-product, .bag-empty, .wishlist-empty {border-color: ' . $nav_divider_color . ';}';
            echo '.bag-buttons a.checkout-button, .bag-buttons a.create-account-button, .woocommerce input.button.alt, .woocommerce .alt-button, .woocommerce button.button.alt {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '.woocommerce .button.update-cart-button:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '.woocommerce input.button.alt:hover, .woocommerce .alt-button:hover, .woocommerce button.button.alt:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '.shopping-bag:before, nav .menu ul.sub-menu li:first-child:before {border-bottom-color: ' . $nav_pointer_color . ';}';
			echo '.page-header-naked-light .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span, .page-header-naked-light .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:before, .page-header-naked-light .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:after, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:before, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:after {background: '.$accent_color.';}';
						
            // FULLSCREEN OVERLAY STYLES
            echo 'a.menu-bars-link span, a.menu-bars-link span:before, a.menu-bars-link span:after {background: ' . $header_link_color . ';}';
            echo 'a.menu-bars-link:hover span, a.menu-bars-link:hover span:before, a.menu-bars-link:hover span:after {background: ' . $header_link_hover_color . ';}';
            echo '.overlay-menu-open .header-wrap {background-color: '.$header_bg_color.';}';
            echo '.overlay-menu-open .header-wrap #header {background-color: transparent!important;}';
            echo '.overlay-menu-open #logo h1, .overlay-menu-open .header-left, .overlay-menu-open .header-right, .overlay-menu-open .header-left a, .overlay-menu-open .header-right a {color: ' . $overlay_menu_link_color . '!important;}';
            echo '#overlay-menu nav li.menu-item > a, .overlay-menu-open a.menu-bars-link, #overlay-menu .fs-overlay-close {color: ' . $overlay_menu_link_color . ';}';
            echo '.overlay-menu-open a.menu-bars-link span:before, .overlay-menu-open a.menu-bars-link span:after {background: ' . $overlay_menu_link_color . '!important;}';
            echo '.fs-supersearch-open .fs-supersearch-link, .fs-search-open .fs-header-search-link {color: ' . $overlay_menu_link_color . '!important;}';
            echo '#overlay-menu {background-color: ' . $overlay_menu_bg_color . ';}';
            echo '#overlay-menu, #fullscreen-search, #fullscreen-supersearch {background-color: rgba(' . $overlay_menu_bg_color_rgb["red"] . ',' . $overlay_menu_bg_color_rgb["green"] . ',' . $overlay_menu_bg_color_rgb["blue"] . ', 0.95);}';
            echo '#overlay-menu nav li:hover > a {color: ' . $overlay_menu_link_hover_color . '!important;}';
            echo '#fullscreen-supersearch .sf-super-search {color: ' . $overlay_menu_text_color . '!important;}';
			echo '#fullscreen-supersearch .sf-super-search .search-options .ss-dropdown > span, #fullscreen-supersearch .sf-super-search .search-options input {color: ' . $overlay_menu_link_color . '!important;}';
			echo '#fullscreen-supersearch .sf-super-search .search-options .ss-dropdown > span:hover, #fullscreen-supersearch .sf-super-search .search-options input:hover {color: ' . $overlay_menu_link_hover_color . '!important;}';
			echo '#fullscreen-supersearch .sf-super-search .search-go a.sf-button {background-color: '.$accent_color.'!important;}';
			echo '#fullscreen-supersearch .sf-super-search .search-go a.sf-button:hover {background-color: '.$secondary_accent_color.'!important;border-color: '.$secondary_accent_color.'!important;color: '.$secondary_accent_alt_color.'!important;}';
			echo '#fullscreen-search .fs-overlay-close, #fullscreen-search .search-wrap .title, .fs-search-bar, .fs-search-bar input#fs-search-input, #fullscreen-search .search-result-pt h3 {color: ' . $overlay_menu_text_color . ';}';
			echo '#fullscreen-search ::-webkit-input-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
			echo '#fullscreen-search :-moz-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
			echo '#fullscreen-search ::-moz-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
			echo '#fullscreen-search :-ms-input-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
			echo '#fullscreen-search .container1 > div, #fullscreen-search .container2 > div, #fullscreen-search .container3 > div {background-color: ' . $overlay_menu_text_color . ';}';
			echo 'nav#main-navigation ul.menu > li.sf-menu-item-new-badge > a:before {background-color: '.$header_bg_color.';box-shadow: inset 2px 2px '.$new_tag_color.';}';
			echo 'nav#main-navigation ul.menu > li.sf-menu-item-new-badge > a:after {background-color: '.$header_bg_color.';color: '.$new_tag_color.'; border-color: '.$new_tag_color.';}';

			// SLIDEOUT MENU STYLES
            echo '.sf-side-slideout {background-color: ' . $slideout_menu_bg_color . ';}';
			if ( $slideout_menu_bg_image != "" ) {
				echo '.sf-side-slideout {background-image: url(' . $slideout_menu_bg_image . ');}';
			}
			echo '.sf-side-slideout .vertical-menu nav .menu li > a, .sf-side-slideout .vertical-menu nav .menu li.parent > a:after, .sf-side-slideout .vertical-menu nav .menu > li ul.sub-menu > li > a {color: ' . $slideout_menu_link_color . ';}';
			echo '.sf-side-slideout .vertical-menu nav .menu li.menu-item {border-color: ' . $slideout_menu_divider_color . ';}';
			echo '.sf-side-slideout .vertical-menu nav .menu li:hover > a, .sf-side-slideout .vertical-menu nav .menu li.parent:hover > a:after, .sf-side-slideout .vertical-menu nav .menu > li ul.sub-menu > li:hover > a {color: ' . $slideout_menu_link_hover_color . '!important;}';
			
			
            // CONTACT SLIDEOUT STYLES
            echo '.contact-menu-link.slide-open {color: ' . $header_link_hover_color . ';}';

            // PROMO BAR STYLES
            echo '#base-promo, .sf-promo-bar {background-color: ' . $promo_bar_bg_color . ';}';
            echo '#base-promo > p, #base-promo.footer-promo-text > a, #base-promo.footer-promo-arrow > a, .sf-promo-bar > p, .sf-promo-bar.promo-text > a, .sf-promo-bar.promo-arrow > a {color: ' . $promo_bar_text_color . ';}';
            echo '#base-promo.footer-promo-arrow:hover, #base-promo.footer-promo-text:hover, .sf-promo-bar.promo-arrow:hover, .sf-promo-bar.promo-text:hover {background-color: ' . $accent_color . '!important;color: ' . $accent_alt_color . '!important;}';
            echo '#base-promo.footer-promo-arrow:hover > *, #base-promo.footer-promo-text:hover > *, .sf-promo-bar.promo-arrow:hover > *, .sf-promo-bar.promo-text:hover > * {color: ' . $accent_alt_color . '!important;}';

            // BREADCRUMBS STYLES
            echo '#breadcrumbs {background-color:' . $breadcrumb_bg_color . ';color:' . $breadcrumb_text_color . ';}';
            echo '#breadcrumbs a, #breadcrumb i {color:' . $breadcrumb_link_color . ';}';

            // PAGE HEADING STYLES
            echo '.page-heading {background-color: ' . $page_heading_bg_color . ';}';
            echo '.page-heading h1, .page-heading h3 {color: ' . $page_heading_text_color . ';}';
            echo '.page-heading .heading-text, .fancy-heading .heading-text {text-align: ' . $page_heading_text_align . ';}';
			echo '.content-divider-wrap .content-divider {border-color: ' . $section_divide_color . ';}';

            // GENERAL STYLES
            echo 'body {color: ' . $body_text_color . ';}';
            echo 'h1, h1 a, h3.countdown-subject {color: ' . $h1_text_color . ';}';
            echo 'h2, h2 a {color: ' . $h2_text_color . ';}';
            echo 'h3, h3 a {color: ' . $h3_text_color . ';}';
            echo 'h4, h4 a, .carousel-wrap > a {color: ' . $h4_text_color . ';}';
            echo 'h5, h5 a {color: ' . $h5_text_color . ';}';
            echo 'h6, h6 a {color: ' . $h6_text_color . ';}';
            echo '.title-wrap .spb-heading span, #reply-title span {border-bottom-color: '.$h2_text_color.';}';
            echo '.title-wrap h3.spb-heading span, h3#reply-title span {border-bottom-color: '.$h3_text_color.';}';
            echo 'figure.animated-overlay figcaption {background-color: ' . $overlay_bg_color . ';}';
            if ( $overlay_opacity < 100 ) {
                echo 'figure.animated-overlay figcaption {background-color: rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', 0.' . $overlay_opacity . ');}';
            }
            echo 'figure.animated-overlay figcaption * {color: ' . $overlay_text_color . ';}';
            echo 'figcaption .thumb-info .name-divide {background-color: ' . $overlay_text_color . ';}';
            echo 'figcaption .thumb-info h6 span.price {border-top-color: ' . $overlay_text_color . ';}';

            // POST STYLES
            echo '.article-divider {background: ' . $section_divide_color . ';}';
            echo '.post-pagination-wrap {background-color:' . $article_np_bg_color . ';}';
            echo '.post-pagination-wrap .next-article > *, .post-pagination-wrap .next-article a, .post-pagination-wrap .prev-article > *, .post-pagination-wrap .prev-article a {color:' . $article_np_text_color . ';}';
            echo '.post-pagination-wrap .next-article a:hover, .post-pagination-wrap .prev-article a:hover {color: ' . $accent_color . ';}';
            echo '.article-extras {background-color:' . $article_extras_bg_color . ';}';
            echo '.review-bar {background-color:' . $article_review_bar_alt_color . ';}';
            echo '.review-bar .bar, .review-overview-wrap .overview-circle {background-color:' . $article_review_bar_color . ';color:' . $article_review_bar_text_color . ';}';
            echo '.posts-type-bright .recent-post .post-item-details {border-top-color:' . $section_divide_color . ';}';

            // CONTENT STYLES
            echo 'table {border-bottom-color: ' . $section_divide_color . ';}';
            echo 'table td {border-top-color: ' . $section_divide_color . ';}';
            echo '.read-more-button, #comments-list li .comment-wrap {border-color: ' . $section_divide_color . ';}';
            echo '.read-more-button:hover {color: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
            echo '.testimonials.carousel-items li .testimonial-text, .recent-post figure {background-color: ' . $alt_bg_color . ';}';
			echo '.spb_accordion .spb_accordion_section {border-color: ' . $section_divide_color . ';}';
			echo '.spb_accordion .spb_accordion_section > h4.ui-state-active a, .toggle-wrap .spb_toggle.spb_toggle_title_active {color: '.$body_text_color.'!important;}';

            // SIDEBAR STYLES
            echo '.widget ul li, .widget.widget_lip_most_loved_widget li, .widget_download_details ul > li {border-color: ' . $section_divide_color . ';}';
            echo '.widget.widget_lip_most_loved_widget li {background: ' . $inner_page_bg_color . '; border-color: ' . $section_divide_color . ';}';
            echo '.widget_lip_most_loved_widget .loved-item > span {color: ' . $body_alt_text_color . ';}';
            echo 'ul.wp-tag-cloud li > a, ul.wp-tag-cloud li:before {border-color: ' . $section_divide_color . ';}';
            echo '.widget .tagcloud a:hover, ul.wp-tag-cloud li:hover > a, ul.wp-tag-cloud li:hover:before {background-color: ' . $accent_color . '; border-color: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo 'ul.wp-tag-cloud li:hover:after {border-color: ' . $accent_color . '; background-color: ' . $accent_alt_color . ';}';
            echo '.loved-item .loved-count > i {color: ' . $body_text_color . ';background: ' . $section_divide_color . ';}';
            echo '.subscribers-list li > a.social-circle {color: ' . $secondary_accent_alt_color . ';background: ' . $secondary_accent_color . ';}';
            echo '.subscribers-list li:hover > a.social-circle {color: #fbfbfb;background: ' . $accent_color . ';}';
            echo '.widget_download_details ul > li a, .sidebar .widget_categories ul > li a, .sidebar .widget_archive ul > li a, .sidebar .widget_nav_menu ul > li a, .sidebar .widget_meta ul > li a, .sidebar .widget_recent_entries ul > li, .widget_product_categories ul > li a, .widget_layered_nav ul > li a, .widget_display_replies ul > li a, .widget_display_forums ul > li a, .widget_display_topics ul > li a {color: ' . $link_text_color . ';}';
            echo '.widget_download_details ul > li a:hover, .sidebar .widget_categories ul > li a:hover, .sidebar .widget_archive ul > li a:hover, .sidebar .widget_nav_menu ul > li a:hover, .widget_nav_menu ul > li.current-menu-item a, .sidebar .widget_meta ul > li a:hover, .sidebar .widget_recent_entries ul > li a:hover, .widget_product_categories ul > li a:hover, .widget_layered_nav ul > li a:hover, .widget_edd_categories_tags_widget ul li a:hover, .widget_display_replies ul li, .widget_display_forums ul > li a:hover, .widget_display_topics ul > li a:hover {color: ' . $link_hover_color . ';}';
            echo '#calendar_wrap caption {border-bottom-color: ' . $secondary_accent_color . ';}';
            echo '.sidebar .widget_calendar tbody tr > td a {color: ' . $secondary_accent_alt_color . ';background-color: ' . $secondary_accent_color . ';}';
            echo '.sidebar .widget_calendar tbody tr > td a:hover {background-color: ' . $accent_color . ';}';
            echo '.sidebar .widget_calendar tfoot a {color: ' . $secondary_accent_color . ';}';
            echo '.sidebar .widget_calendar tfoot a:hover {color: ' . $accent_color . ';}';
            echo '.widget_calendar #calendar_wrap, .widget_calendar th, .widget_calendar tbody tr > td, .widget_calendar tbody tr > td.pad {border-color: ' . $section_divide_color . ';}';
            echo '.sidebar .widget hr {border-color: ' . $section_divide_color . ';}';
            echo '.widget ul.flickr_images li a:after, .portfolio-grid li a:after {color: ' . $accent_alt_color . ';}';
			echo '.loved-item:hover .loved-count > svg .stroke {stroke: '.$accent_alt_color.';}';
			echo '.loved-item:hover .loved-count > svg .fill {fill: '.$accent_alt_color.';}';

            // PORTFOLIO STYLES
            echo '.fw-row .spb_portfolio_widget .title-wrap {border-bottom-color: ' . $section_divide_color . ';}';
            echo '.portfolio-item {border-bottom-color: ' . $section_divide_color . ';}';
            echo '.masonry-items .portfolio-item-details {background: ' . $alt_bg_color . ';}';
            echo '.masonry-items .blog-item .blog-details-wrap:before {background-color: ' . $alt_bg_color . ';}';
            echo '.masonry-items .portfolio-item figure {border-color: ' . $section_divide_color . ';}';
            echo '.portfolio-details-wrap span span {color: #666;}';
            echo '.share-links > a:hover {color: ' . $accent_color . ';}';
            echo '.portfolio-item.masonry-item .portfolio-item-details {background: ' . $inner_page_bg_color . ';}';

            // BLOG STYLES
            echo '#infscr-loading .spinner > div {background: ' . $section_divide_color . ';}';
            echo '.blog-aux-options li.selected a {background: ' . $accent_color . ';border-color: ' . $accent_color . ';color: ' . $accent_alt_color . ';}';
            echo '.blog-filter-wrap .aux-list li:hover {border-bottom-color: transparent;}';
            echo '.blog-filter-wrap .aux-list li:hover a {color: ' . $accent_alt_color . ';background: ' . $accent_color . ';}';
            echo '.mini-blog-item-wrap, .mini-items .mini-alt-wrap, .mini-items .mini-alt-wrap .quote-excerpt, .mini-items .mini-alt-wrap .link-excerpt, .masonry-items .blog-item .quote-excerpt, .masonry-items .blog-item .link-excerpt, .timeline-items .standard-post-content .quote-excerpt, .timeline-items .standard-post-content .link-excerpt, .post-info, .author-info-wrap, .body-text .link-pages, .page-content .link-pages, .posts-type-list .recent-post, .standard-items .blog-item .standard-post-content {border-color: ' . $section_divide_color . ';}';
            echo '.standard-post-date, .timeline {background: ' . $section_divide_color . ';}';
            echo '.timeline-items .standard-post-content {background: ' . $inner_page_bg_color . ';}';
            echo '.timeline-items .format-quote .standard-post-content:before, .timeline-items .standard-post-content.no-thumb:before {border-left-color: ' . $alt_bg_color . ';}';
            echo '.search-item-img .img-holder {background: ' . $alt_bg_color . ';border-color:' . $section_divide_color . ';}';
            echo '.masonry-items .blog-item .masonry-item-wrap {background: ' . $alt_bg_color . ';}';
            echo '.mini-items .blog-item-details, .share-links, .single-portfolio .share-links, .single .pagination-wrap, ul.post-filter-tabs li a {border-color: ' . $section_divide_color . ';}';
            echo '.mini-item-details {color: ' . $body_alt_text_color . ';}';
            echo '.related-item figure {background-color: ' . $secondary_accent_color . '; color: ' . $secondary_accent_alt_color . '}';
            echo '.required {color: #ee3c59;}';
            echo '.post-item-details .comments-likes a i, .post-item-details .comments-likes a span {color: ' . $body_text_color . ';}';
            echo '.posts-type-list .recent-post:hover h4 {color: ' . $link_hover_color . '}';
            echo '.blog-grid-items .blog-item .grid-left:after {border-left-color: ' . $bold_rp_bg . ';}';
            echo '.blog-grid-items .blog-item .grid-right:after {border-right-color: ' . $bold_rp_bg . ';}';
            echo '.blog-item .tweet-icon, .blog-item .post-icon, .blog-item .inst-icon {color: ' . $bold_rp_hover_text . '!important;}';
            echo '.posts-type-bold .recent-post .details-wrap, .masonry-items .blog-item .details-wrap, .blog-grid-items .blog-item > div, .product-shadows .preview-slider-item-wrapper {background: ' . $bold_rp_bg . ';color: ' . $bold_rp_text . ';}';
            echo '.masonry-items .blog-item .details-wrap:before {background: ' . $bold_rp_bg . ';}';
            echo '.masonry-items .blog-item .comments-svg .stroke, .masonry-items .blog-item .loveit-svg .stroke {stroke: ' . $bold_rp_text . ';}';
			echo '.masonry-items .blog-item .loveit-svg .fill {fill: ' . $bold_rp_text . ';}';
            echo '.masonry-items .blog-item:hover .comments-svg .stroke, .masonry-items .blog-item:hover .loveit-svg .stroke {stroke: ' . $bold_rp_hover_text . ';}';
			echo '.masonry-items .blog-item:hover .loveit-svg .fill {fill: ' . $bold_rp_hover_text . ';}';
            echo '.blog-grid-items .blog-item h2, .blog-grid-items .blog-item h6, .blog-grid-items .blog-item data, .blog-grid-items .blog-item .author span, .blog-grid-items .blog-item .tweet-text a, .masonry-items .blog-item h2, .masonry-items .blog-item h6 {color: ' . $bold_rp_text . ';}';
            echo '.posts-type-bold a, .masonry-items .blog-item a {color: ' . $link_text_color . ';}';
            echo '.posts-type-bold .recent-post .details-wrap:before, .masonry-items .blog-item .details-wrap:before, .posts-type-bold .recent-post.has-thumb .details-wrap:before {border-bottom-color: ' . $bold_rp_bg . ';}';
            echo '.posts-type-bold .recent-post.has-thumb:hover .details-wrap, .posts-type-bold .recent-post.no-thumb:hover .details-wrap, .bold-items .blog-item:hover, .masonry-items .blog-item:hover .details-wrap, .blog-grid-items .blog-item:hover > div, .instagram-item .inst-overlay, .masonry-items .blog-item:hover .details-wrap:before {background: ' . $bold_rp_hover_bg . ';}';
            if ( $overlay_opacity < 100 ) {
                $inst_overlay_rgb = sf_hex2rgb( $bold_rp_hover_bg );
                echo '.blog-grid-items .instagram-item:hover .inst-overlay {background: rgba(' . $inst_overlay_rgb["red"] . ',' . $inst_overlay_rgb["green"] . ',' . $inst_overlay_rgb["blue"] . ', 0.' . $overlay_opacity . ');}';
            }
            echo '.posts-type-bold .recent-post:hover .details-wrap:before, .masonry-items .blog-item:hover .details-wrap:before {border-bottom-color: ' . $bold_rp_hover_bg . ';}';
            echo '.posts-type-bold .recent-post:hover .details-wrap *, .bold-items .blog-item:hover *, .masonry-items .blog-item:hover .details-wrap, .masonry-items .blog-item:hover .details-wrap a, .masonry-items .blog-item:hover h2, .masonry-items .blog-item:hover h6, .masonry-items .blog-item:hover .details-wrap .quote-excerpt *, .blog-grid-items .blog-item:hover *, .instagram-item .inst-overlay data {color: ' . $bold_rp_hover_text . ';}';
            echo '.blog-grid-items .blog-item:hover .grid-right:after {border-right-color:' . $bold_rp_hover_bg . ';}';
            echo '.blog-grid-items .blog-item:hover .grid-left:after {border-left-color:' . $bold_rp_hover_bg . ';}';
            echo '.blog-grid-items .blog-item:hover h2, .blog-grid-items .blog-item:hover h6, .blog-grid-items .blog-item:hover data, .blog-grid-items .blog-item:hover .author span, .blog-grid-items .blog-item:hover .tweet-text a {color: ' . $bold_rp_hover_text . ';}';
			echo '.blog-item .side-details, .narrow-date-block {background: ' . $bold_rp_bg . ';color: ' . $bold_rp_text . ';}';
			echo '.blog-item .side-details .comments-wrapper {border-color: ' . $section_divide_color . ';}';
			echo '.standard-items.alt-styling .blog-item .standard-post-content {background: ' . $inner_page_bg_color . ';}';
			echo '.standard-items.alt-styling .blog-item.quote .standard-post-content, .mini-items .blog-item.quote .mini-alt-wrap {background: ' . $body_text_color . ';color: ' . $inner_page_bg_color . ';}';
			echo '.standard-items .blog-item .read-more-button, .mini-items .blog-item .read-more-button {background-color: ' . $inner_page_bg_color . ';}';
			echo '#respond .form-submit input[type=submit]:hover {border-color: '.$accent_color.';}';
			echo '.post-details-wrap .tags-wrap, .post-details-wrap .comments-likes {border-color: ' . $section_divide_color . ';}';
			
            // SHORTCODE STYLES
            echo '.sf-button.accent {color: ' . $accent_alt_color . '; background-color: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
            echo '.sf-button.sf-icon-reveal.accent {color: ' . $accent_alt_color . '!important; background-color: ' . $accent_color . '!important;}';
            echo 'a.sf-button.stroke-to-fill {color: ' . $link_text_color . ';}';
            echo '.sf-button.accent.bordered .sf-button-border {border-color: ' . $accent_color . ';}';
            echo 'a.sf-button.bordered.accent {color: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
            echo 'a.sf-button.bordered.accent:hover {color: ' . $accent_alt_color . ';}';
            echo 'a.sf-button.rotate-3d span.text:before {color: ' . $accent_alt_color . '; background-color: ' . $accent_color . ';}';
            echo '.sf-button.accent:hover, .sf-button.bordered.accent:hover {background-color: ' . $secondary_accent_color . ';border-color: ' . $secondary_accent_color . ';color: ' . $secondary_accent_alt_color . ';}';
            echo 'a.sf-button, a.sf-button:hover, #footer a.sf-button:hover {background-image: none;color: #fff;}';
            echo 'a.sf-button.gold, a.sf-button.gold:hover, a.sf-button.lightgrey, a.sf-button.lightgrey:hover, a.sf-button.white:hover {color: #222!important;}';
            echo 'a.sf-button.transparent-dark {color: ' . $body_text_color . '!important;}';
            echo 'a.sf-button.transparent-light:hover, a.sf-button.transparent-dark:hover {color: ' . $accent_color . '!important;}';
            echo '.title-wrap a.sf-button:hover {color: ' . $accent_color . '!important;}';
            echo '.sf-icon {color: ' . $icon_color . ';}';
            echo '.sf-icon-cont, .sf-icon-cont:hover, .sf-hover .sf-icon-cont, .sf-icon-box[class*="icon-box-boxed-"] .sf-icon-cont, .sf-hover .sf-icon-box-hr {background-color: ' . $icon_container_bg_color . ';}';
            echo '.sf-hover .sf-icon-cont, .sf-hover .sf-icon-box-hr {background-color: ' . $icon_container_hover_bg_color . '!important;}';
            echo '.sf-hover .sf-icon-cont .sf-icon {color: ' . $icon_alt_color . '!important;}';
            echo '.sf-icon-box[class*="sf-icon-box-boxed-"] .sf-icon-cont:after {border-top-color: ' . $icon_container_bg_color . ';border-left-color: ' . $icon_container_bg_color . ';}';
            echo '.sf-hover .sf-icon-cont .sf-icon, .sf-icon-box.sf-icon-box-boxed-one .sf-icon, .sf-icon-box.sf-icon-box-boxed-three .sf-icon {color: ' . $icon_alt_color . ';}';
            echo '.sf-icon-box-animated .front {background: ' . $alt_bg_color . '; border-color: ' . $section_divide_color . ';}';
            echo '.sf-icon-box-animated .front h3 {color: ' . $body_text_color . ';}';
            echo '.sf-icon-box-animated .back {background: ' . $accent_color . '; border-color: ' . $accent_color . ';}';
            echo '.sf-icon-box-animated .back, .sf-icon-box-animated .back h3 {color: ' . $accent_alt_color . ';}';
            echo '.client-item figure, .borderframe img {border-color: ' . $section_divide_color . ';}';
            echo 'span.dropcap3 {background: #000;color: #fff;}';
            echo 'span.dropcap4 {color: #fff;}';
            echo '.spb_divider, .spb_divider.go_to_top_icon1, .spb_divider.go_to_top_icon2, .testimonials > li, .tm-toggle-button-wrap, .tm-toggle-button-wrap a, .portfolio-details-wrap, .spb_divider.go_to_top a, .widget_search form input {border-color: ' . $section_divide_color . ';}';
            echo '.spb_divider.go_to_top_icon1 a, .spb_divider.go_to_top_icon2 a {background: ' . $inner_page_bg_color . ';}';
            echo '.divider-wrap h3.divider-heading:before, .divider-wrap h3.divider-heading:after {background: ' . $section_divide_color . ';}';
            echo '.spb_tabs .ui-tabs .ui-tabs-panel, .spb_content_element .ui-tabs .ui-tabs-nav, .ui-tabs .ui-tabs-nav li {border-color: ' . $section_divide_color . ';}';
            echo '.spb_tabs .ui-tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li.ui-tabs-active a {background: ' . $inner_page_bg_color . '!important;}';
            echo '.tabs-type-dynamic .nav-tabs li.active a, .tabs-type-dynamic .nav-tabs li a:hover {background:' . $accent_color . ';border-color:' . $accent_color . '!important;color: ' . $accent_color . ';}';
            echo '.spb_tabs .nav-tabs li a, .spb_tour .nav-tabs li a {border-color: '.$section_divide_color.'!important;}';
            echo '.spb_tabs .nav-tabs li:hover a, .spb_tour .nav-tabs li:hover a {border-color: '.$accent_color.'!important;color: '.$accent_color.'!important;}';
            echo '.spb_tabs .nav-tabs li.active a, .spb_tour .nav-tabs li.active a {background: '.$accent_color.';border-color: '.$accent_color.'!important;color: ' . $accent_alt_color . '!important;}';
            echo '.spb_accordion_section > h4:hover .ui-icon:before {border-color: ' . $accent_color . ';}';
            echo '.toggle-wrap .spb_toggle, .spb_toggle_content {border-color: ' . $section_divide_color . ';}';
            echo '.toggle-wrap .spb_toggle:hover {color: ' . $accent_color . ';}';
            echo '.ui-accordion h4.ui-accordion-header .ui-icon {color: ' . $body_text_color . ';}';
            echo '.standard-browser .ui-accordion h4.ui-accordion-header.ui-state-active:hover a, .standard-browser .ui-accordion h4.ui-accordion-header:hover .ui-icon {color: ' . $accent_color . ';}';
            echo 'blockquote.pullquote {border-color: ' . $accent_color . ';}';
            echo '.borderframe img {border-color: #eeeeee;}';
            echo '.spb_box_content.whitestroke {background-color: #fff;border-color: ' . $section_divide_color . ';}';
            echo 'ul.member-contact li a:hover {color: ' . $link_hover_color . ';}';
            echo '.testimonials.carousel-items li .testimonial-text {border-color: ' . $section_divide_color . ';}';
            echo '.testimonials.carousel-items li .testimonial-text:after {border-left-color: ' . $section_divide_color . ';border-top-color: ' . $section_divide_color . ';}';
            echo '.product-reviews.masonry-items li.testimonial .testimonial-text {background-color: ' . $section_divide_color . ';}';
            echo '.product-reviews.masonry-items li.testimonial.has-cite .testimonial-text::after {border-top-color: ' . $section_divide_color . ';}';
            echo '.horizontal-break {background-color: ' . $section_divide_color . ';}';
            echo '.horizontal-break.bold {background-color: ' . $body_text_color . ';}';
            echo '.progress .bar {background-color: ' . $accent_color . ';}';
            echo '.progress.standard .bar {background: ' . $accent_color . ';}';
            echo '.progress-bar-wrap .progress-value {color: ' . $accent_color . ';}';
            echo '.sf-share-counts {border-color: ' . $section_divide_color . ';}';
            echo '.mejs-controls .mejs-time-rail .mejs-time-current {background: ' . $accent_color . '!important;}';
            echo '.mejs-controls .mejs-time-rail .mejs-time-loaded {background: ' . $accent_alt_color . '!important;}';
            echo '.pt-banner h6 {color: ' . $accent_alt_color . ';}';
            echo '.pinmarker-container a.pin-button:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '.directory-item-details .item-meta {color: ' . $body_alt_text_color . ';}';

            // CONTENT SLIDER STYLES
            echo '.spb_row_container .spb_tweets_slider_widget .spb-bg-color-wrap, .spb_tweets_slider_widget .spb-bg-color-wrap {background: ' . $tweet_slider_bg . ';}';
            echo '.spb_tweets_slider_widget .tweet-text, .spb_tweets_slider_widget .tweet-icon {color: ' . $tweet_slider_text . ';}';
            echo '.spb_tweets_slider_widget .tweet-text a, .spb_tweets_slider_widget .twitter_intents a {color: ' . $tweet_slider_link . ';}';
            echo '.spb_tweets_slider_widget .tweet-text a:hover, .spb_tweets_slider_widget .twitter_intents a:hover {color: ' . $tweet_slider_link_hover . ';}';
            echo '.spb_testimonial_slider_widget .spb-bg-color-wrap {background: ' . $testimonial_slider_bg . ';}';
            echo '.spb_testimonial_slider_widget .heading-wrap h3.spb-center-heading, .spb_testimonial_slider_widget .testimonial-text, .spb_testimonial_slider_widget cite, .spb_testimonial_slider_widget .testimonial-icon {color: ' . $testimonial_slider_text . ';}';
            echo '.spb_testimonial_slider_widget .heading-wrap h3.spb-center-heading {border-bottom-color: ' . $testimonial_slider_text . ';}';
			echo '.content-slider .flex-direction-nav .flex-next:before, .content-slider .flex-direction-nav .flex-prev:before {background-color: ' . $section_divide_color . ';color: '.$body_text_color.';}';
			echo '.spb_tweets_slider_widget .heading-wrap h3.spb-center-heading {color: ' . $tweet_slider_text . ';border-bottom-color: ' . $tweet_slider_text . ';}';

            // FOOTER STYLES
            echo '#footer {background: ' . $footer_bg_color . ';}';
            echo '#footer.footer-divider {border-top-color: ' . $footer_border_color . ';}';
            echo '#footer, #footer p, #footer h3.spb-heading {color: ' . $footer_text_color . ';}';
            echo '#footer h3.spb-heading span {border-bottom-color: ' . $footer_text_color . ';}';
            echo '#footer a {color: ' . $footer_link_color . ';}';
            echo '#footer a:hover {color: ' . $footer_link_hover_color . ';}';
            echo '#footer .widget ul li, #footer .widget_categories ul, #footer .widget_archive ul, #footer .widget_nav_menu ul, #footer .widget_recent_comments ul, #footer .widget_meta ul, #footer .widget_recent_entries ul, #footer .widget_product_categories ul {border-color: ' . $footer_border_color . ';}';
            echo '#copyright {background-color: ' . $copyright_bg_color . ';border-top-color: ' . $footer_border_color . ';}';
            echo '#copyright p, #copyright .text-left, #copyright .text-right {color: ' . $copyright_text_color . ';}';
            echo '#copyright a {color: ' . $copyright_link_color . ';}';
            echo '#copyright a:hover, #copyright nav .menu li a:hover {color: ' . $copyright_link_hover_color . '!important;}';
            echo '#copyright nav .menu li {border-left-color: ' . $footer_border_color . ';}';
            echo '#footer .widget_calendar #calendar_wrap, #footer .widget_calendar th, #footer .widget_calendar tbody tr > td, #footer .widget_calendar tbody tr > td.pad {border-color: ' . $footer_border_color . ';}';
            echo '.widget input[type="email"] {background: #f7f7f7; color: #999}';
            echo '#footer .widget hr {border-color: ' . $footer_border_color . ';}';
            echo '#sf-newsletter-bar, .layout-boxed #sf-newsletter-bar > .container {background-color: ' . $newsletter_bar_bg_color . ';}';
			echo '#sf-newsletter-bar h3.sub-text {color: ' . $newsletter_bar_text_color . ';}';
			echo '#sf-newsletter-bar .sub-code > form input[type=submit], #sf-newsletter-bar .sub-code > form input[type="text"], #sf-newsletter-bar .sub-code > form input[type="email"] {border-color: '.$newsletter_bar_text_color.';color: '.$newsletter_bar_text_color.';}';
			echo '#sf-newsletter-bar .sub-code > form input[type=submit]:hover {border-color: '.$newsletter_bar_link_hover_color.';color: '.$newsletter_bar_link_hover_color.';}';
			echo '#sf-newsletter-bar .sub-close {color: '.$newsletter_bar_text_color.';}';
			echo '#sf-newsletter-bar .sub-close:hover {color: '.$newsletter_bar_link_hover_color.';}';
			echo '#sf-newsletter-bar ::-webkit-input-placeholder {color:' . $newsletter_bar_text_color . '!important;}';
            echo '#sf-newsletter-bar :-moz-placeholder {color:' . $newsletter_bar_text_color . '!important;}';
            echo '#sf-newsletter-bar ::-moz-placeholder {color:' . $newsletter_bar_text_color . '!important;}';
            echo '#sf-newsletter-bar :-ms-input-placeholder {color:' . $newsletter_bar_text_color . '!important;}';

            // WOOCOMMERCE STYLES
            if ( sf_woocommerce_activated() ) {
			echo '.woocommerce .wc-new-badge {background-color:'.$new_tag_color.';}';
			echo '.woocommerce .wc-new-badge:before {border-right-color:'.$new_tag_color.';}';
			echo '.woocommerce .free-badge, .woocommerce span.onsale {background-color:'.$sale_tag_color.';}';
			echo '.woocommerce .free-badge:before, .woocommerce span.onsale:before {border-right-color:'.$sale_tag_color.';}';
			echo '.woocommerce .out-of-stock-badge {background-color:'.$oos_tag_color.';}';
			echo '.woocommerce .out-of-stock-badge:before {border-right-color:'.$oos_tag_color.';}';
			echo '.woocommerce div.product .stock {color:'.$accent_color.';}';
            echo '.woocommerce nav.woocommerce-pagination {border-top-color: '.$section_divide_color.'}';
            echo '.price ins {color:'.$sale_tag_color.';}';
            echo '.woocommerce div.product p.stock.out-of-stock {color:'.$oos_tag_color.';}';
            echo '.woocommerce form .form-row .required {color:'.$accent_color.';}';
            echo '.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info {border-color:'.$accent_color.';}';
            echo '.woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error {color: ' . $body_text_color . ';}';
            echo '.woocommerce .woocommerce-info a:hover, .woocommerce-page .woocommerce-info a:hover {color: '.$accent_color.';}';
            echo '.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a {color: '.$body_alt_text_color.'}';
            echo '.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li:hover a {color: '.$section_divide_color.'}';
            echo '.woocommerce .help-bar, .woo-aux-options, .woocommerce nav.woocommerce-pagination ul li span.current, .modal-body .comment-form-rating, ul.checkout-process, #billing .proceed, ul.my-account-nav > li, .woocommerce #payment, .woocommerce-checkout p.thank-you, .woocommerce .order_details, .woocommerce-page .order_details, .woocommerce .products .product figure .cart-overlay .price, .woocommerce .products .product figure .cart-overlay .yith-wcwl-add-to-wishlist, #product-accordion .panel, .review-order-wrap, .woocommerce form .form-row input.input-text, .woocommerce .coupon input.input-text, .woocommerce table.shop_table, .woocommerce-page table.shop_table, .mini-list li, .woocommerce div.product .woocommerce-tabs .panel, .product-type-standard .product .cart-overlay .shop-actions .jckqvBtn, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce input[name="apply_coupon"], .woocommerce a.button.wc-backward, #yith-wcwl-form .product-add-to-cart > .button, .woocommerce .coupon input.input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .summary-top .product-navigation .nav-previous, .summary-top .product-navigation .nav-next, .woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th, .woocommerce a.button { border-color: ' . $section_divide_color . ' ;}';
            echo '.woocommerce .widget_layered_nav ul li.chosen {background-color: '.$accent_color.';}';
            echo '.woocommerce .widget_layered_nav ul li.chosen > * {color: '.$accent_alt_color.';}';
            echo '.woocommerce .single_add_to_cart_button:disabled[disabled] {border-color: ' . $body_text_color . '!important;color: ' . $body_text_color . '!important;}';
            echo '.bag-buttons a.sf-button.bag-button, .bag-buttons a.sf-button.wishlist-button {border-color: '.$section_divide_color.';}';
            echo 'nav.woocommerce-pagination ul li a:hover {border-color:' . $section_divide_color . ';}';
            echo '.woocommerce-account p.myaccount_address, .woocommerce-account .page-content h2, p.no-items, #order_review table.shop_table, #payment_heading, .returning-customer a, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods, .woocommerce .coupon, .summary-top {border-bottom-color: ' . $section_divide_color . ';}';
            echo 'p.no-items, .woocommerce-page .cart-collaterals, .woocommerce .cart_totals table tr.cart-subtotal, .woocommerce .cart_totals table tr.order-total, .woocommerce table.shop_table td, .woocommerce-page table.shop_table td, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row {border-top-color: ' . $section_divide_color . ';}';
            echo '.woocommerce a.button, .woocommerce input.button, .woocommerce button[type=submit], .woocommerce-ordering .woo-select, .variations_form .woo-select, .add_review a, .woocommerce .coupon input.apply-coupon, .woocommerce .button.update-cart-button, .shipping-calculator-form .woo-select, .woocommerce .shipping-calculator-form .update-totals-button button, .woocommerce #billing_country_field .woo-select, .woocommerce #shipping_country_field .woo-select, .woocommerce #review_form #respond .form-submit input, .woocommerce table.my_account_orders .order-actions .button, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce.widget .buttons a, .load-more-btn, #wew-submit-email-to-notify, .woocommerce input[name="save_account_details"], .woocommerce .shipping-calculator-form .update-totals-button button {background: transparent; color: ' . $link_text_color . '}';
            echo '.product figcaption a.product-added {color: ' . $accent_alt_color . ';}';
            echo 'ul.products li.product a.quick-view-button, .woocommerce p.cart a.add_to_cart_button, .lost_reset_password p.form-row input[type=submit], .track_order p.form-row input[type=submit], .change_password_form p input[type=submit], .woocommerce form.register input[type=submit], .woocommerce .wishlist_table tr td.product-add-to-cart a, .woocommerce input.button[name="save_address"], .woocommerce .woocommerce-message a.button, .woocommerce .quantity, .woocommerce-page .quantity, .woocommerce .cart .yith-wcwl-add-to-wishlist a, .woocommerce-checkout .login input[type=submit], .woocommerce button[type=submit], .my-account-login-wrap .login-wrap form.login p.form-row input[type=submit], .products .product.buy-btn-visible > .product-actions .add-to-cart-wrap > a, .woocommerce div.product .woocommerce-tabs {border-color: ' . $section_divide_color . ';}';
            echo '.woocommerce form.cart button.add_to_cart_button, #jckqv .cart .add_to_cart_button, #jckqv .cart .single_add_to_cart_button, #jckqv .quantity .qty, #jckqv .cart .yith-wcwl-add-to-wishlist a, #jckqv .quantity .qty-plus, #jckqv .quantity .qty-minus, .woocommerce .single_add_to_cart_button, .woocommerce .single_add_to_cart_button.button.alt, .woocommerce button.single_add_to_cart_button.button.alt.disabled {border-color: '.$body_text_color.';color: '.$body_text_color.';}';
            echo '.woocommerce form.cart button.add_to_cart_button:disabled[disabled] {border-color: '.$accent_color.'!important; color: '.$accent_color.'!important;}';
            echo '.woocommerce div.product form.cart .variations select {background-color: ' . $alt_bg_color . ';color: ' . $body_text_color . ';}';
            echo '.woocommerce .products .product figure .cart-overlay .shop-actions > a.product-added, .woocommerce .products .product figure .cart-overlay .shop-actions .add-to-cart-wrap > a.product-added, .woocommerce ul.products li.product figure figcaption .shop-actions > a.product-added:hover, .add_to_cart_button > i.fa-circle-o-notch, .yith-wcwl-wishlistaddedbrowse a, .yith-wcwl-wishlistexistsbrowse a {color: ' . $accent_color . '!important;}';
            echo 'ul.products li.product .product-details .posted_in a {color: ' . $body_alt_text_color . ';}';
            echo '.woocommerce form.cart button.add_to_cart_button, .woocommerce .cart .yith-wcwl-add-to-wishlist a, .woocommerce .quantity input, .woocommerce .quantity .minus, .woocommerce .quantity .plus {color: ' . $body_text_color . ';}';
            echo '.woocommerce .products .product figure .cart-overlay .shop-actions > a:hover, .woocommerce .products .product figure .cart-overlay .shop-actions .add-to-cart-wrap > a:hover, ul.products li.product .product-details .posted_in a:hover, .product .cart-overlay .shop-actions .jckqvBtn:hover {color: ' . $accent_color . ';}';
            echo '.shop-actions > a:hover .addtocart-svg .stroke, .shop-actions a:hover .wishlist-svg .stroke {stroke: ' . $accent_color . ';}';
            echo '.shop-actions a:hover .wishlist-svg .fill {fill: ' . $accent_color . ';}';
            echo '.woocommerce p.cart a.add_to_cart_button:hover {background: ' . $secondary_accent_color . '; color: ' . $accent_color . ' ;}';
            echo '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce .coupon input.apply-coupon:hover, .woocommerce .shipping-calculator-form .update-totals-button button:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .add_review a:hover, .lost_reset_password p.form-row input[type=submit]:hover, .track_order p.form-row input[type=submit]:hover, .change_password_form p input[type=submit]:hover, .woocommerce table.my_account_orders .order-actions .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce.widget .buttons a:hover, .woocommerce .wishlist_table tr td.product-add-to-cart a:hover, .woocommerce input.button[name="save_address"]:hover, .woocommerce input[name="apply_coupon"]:hover, .woocommerce form.register input[type=submit]:hover, .woocommerce .cart .yith-wcwl-add-to-wishlist a:hover, .load-more-btn:hover, #wew-submit-email-to-notify:hover, .woocommerce input[name="save_account_details"]:hover, .woocommerce .cart .yith-wcwl-wishlistexistsbrowse a, .woocommerce-checkout .login input[type=submit]:hover, .woocommerce .cart .button:hover, .woocommerce .cart input.button:hover, .woocommerce input[name="apply_coupon"]:hover, .woocommerce a.button.wc-backward:hover, #yith-wcwl-form .product-add-to-cart > .button:hover, .my-account-login-wrap .login-wrap form.login p.form-row input[type=submit]:hover {border-color: '.$accent_color.'; color: '.$accent_color.';}';
//            echo '.woocommerce input.button, .woocommerce a.button {background:'.$accent_color.';color:'.$accent_alt_color.';}';
//            echo '.woocommerce input.button:hover, .woocommerce a.button:hover {background-color:'.$secondary_accent_color.';color:'.$accent_alt_color.';}';			
            echo '.woocommerce-MyAccount-navigation li {border-color: '.$section_divide_color.';}';
            echo '.woocommerce-MyAccount-navigation li.is-active a, .woocommerce-MyAccount-navigation li a:hover {color: '.$body_text_color.';}';
            echo '.woocommerce form.cart button.add_to_cart_button.product-added {border-color: '.$accent_color.'!important; color: '.$accent_color.'!important;}';
            echo '.woocommerce form.cart button.add_to_cart_button:hover, #jckqv .cart .add_to_cart_button:hover, #jckqv .cart .single_add_to_cart_button:hover, #jckqv .cart .yith-wcwl-add-to-wishlist a:hover, .woocommerce .single_add_to_cart_button:hover, .woocommerce .single_add_to_cart_button.button.alt:hover {border-color: '.$accent_color.'!important; color: '.$accent_color.'!important;}';
            echo '.woocommerce #account_details .login, .woocommerce #account_details .login h4.lined-heading span, .my-account-login-wrap .login-wrap, .my-account-login-wrap .login-wrap h4.lined-heading span, .woocommerce div.product form.cart table div.quantity {background: ' . $alt_bg_color . ';}';
            echo '.woocommerce .address .edit-address:hover, .my_account_orders td.order-number a:hover, .product_meta a.inline:hover { border-bottom-color: ' . $accent_color . ';}';
            echo '.woocommerce .order-info, .woocommerce .order-info mark, .woocommerce .button.checkout-button {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '.woocommerce #payment div.payment_box {background: ' . $section_divide_color . '; color: ' . $body_text_color . ';}';
            echo '.woocommerce #payment div.payment_box:after {border-bottom-color: ' . $section_divide_color . ';}';
            echo '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {background: ' . $alt_bg_color . ';}';
            echo '.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {background: ' . $h3_text_color . ';}';
            echo '.yith-wcwl-wishlistexistsbrowse a:hover, .yith-wcwl-wishlistaddedbrowse a:hover {color: ' . $accent_alt_color . ';}';
            echo '.inner-page-wrap.full-width-shop .sidebar[class*="col-sm"] {background-color:' . $inner_page_bg_color . ';}';
            echo '.woocommerce .products .product .price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price {color: ' . $body_text_color . ';}';
            echo '.preview-slider-item-wrapper .product-details span.price del::after {background-color: ' . $body_text_color . ';}';
            echo '.woocommerce div.product form.cart .variations td.label label {color: ' . $body_text_color . ';}';
            echo '.woocommerce div.product p.price, .woocommerce div.product span.price {color: ' . $body_text_color . ';}';
            echo '.woocommerce .products .product.product-display-gallery-bordered > figure, .product-type-gallery-bordered .products, .product-type-gallery-bordered .products .owl-wrapper-outer, .inner-page-wrap.full-width-shop .product-type-gallery-bordered .sidebar[class*="col-sm"], .products.product-type-gallery-bordered {border-color:' . $section_divide_color . ';}';
			echo '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after {background: '.$section_divide_color.'; box-shadow: inset 2px 2px '.$section_divide_color.';}';
			echo ' .woocommerce #review_form #respond .form-submit input:hover {background: ' . $accent_color . '!important; border-color: ' . $accent_color . '!important; color: ' . $accent_alt_color . '!important;}';
			echo '.woocommerce .quantity .minus, .woocommerce .quantity input.qty, .woocommerce .quantity .qty-adjust .woocommerce .quantity .plus, .woocommerce div.product form.cart .variations select, .woocommerce .quantity .qty-plus, .woocommerce .quantity .qty-minus, .woocommerce .quantity .qty-adjust {border-color:' . $section_divide_color . ';}';
			echo '.woocommerce table.shop_attributes th, .woocommerce table.shop_attributes td {border-color:' . $section_divide_color . ';}';
			echo '.product-fw-split div.product div.summary {background-color:' . $inner_page_bg_color . ';}';
			echo '.woocommerce table.shop_table tr td.product-remove .remove {color: '.$body_text_color.'!important;}';
			echo '.woocommerce .button.checkout-button:hover, .review-order-wrap #payment #place_order {background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}';
			echo '#jckqv_summary > h1 {border-bottom-color: '.$section_divide_color.';}';
			echo '.woocommerce .widget_layered_nav_filters ul li a:before {color: '.$accent_alt_color.';}';
			
			if ( $product_imagewidth_override ) {
				$product_imagewidth = $sf_options['productdetail_imagewidth'];
				$product_fw_imagewidth = $product_imagewidth - 2;
				$product_summary_width = 98 - $product_imagewidth;
				
				echo '@media only screen and (min-width: 768px) {';
				echo '.woocommerce div.product div.images {width: '.$product_imagewidth.'%;}';
				echo '.woocommerce.product-fw-split div.product div.images {width: '.$product_fw_imagewidth.'%;}';
				echo '.woocommerce div.product div.summary {width: '.$product_summary_width.'%;}';
				echo '}';
				
			}
			
			}
			
			// EDD STYLES
			if ( sf_edd_activated() ) {
				echo '.download-sidebar, #edd_checkout_form_wrap legend, #edd_checkout_form_wrap fieldset#edd_cc_fields legend {border-color:'.$section_divide_color.';}';
			}

            // BUDDYPRESS STYLES
            echo '#buddypress .activity-meta a, #buddypress .acomment-options a, #buddypress #member-group-links li a, .widget_bp_groups_widget #groups-list li, .activity-list li.bbp_topic_create .activity-content .activity-inner, .activity-list li.bbp_reply_create .activity-content .activity-inner {border-color: ' . $section_divide_color . ';}';
            echo '#buddypress .activity-meta a:hover, #buddypress .acomment-options a:hover, #buddypress #member-group-links li a:hover {border-color: ' . $accent_color . ';}';
            echo '#buddypress .activity-header a, #buddypress .activity-read-more a {border-color: ' . $accent_color . ';}';
            echo '#buddypress #members-list .item-meta .activity, #buddypress .activity-header p {color: ' . $body_alt_text_color . ';}';
            echo '#buddypress .pagination-links span, #buddypress .load-more.loading a {background-color: ' . $accent_color . ';color: ' . $accent_alt_color . ';border-color: ' . $accent_color . ';}';
            echo '#buddypress div.dir-search input[type=submit], #buddypress #whats-new-submit input[type=submit] {background: ' . $alt_bg_color . '; color: ' . $secondary_accent_color . '}';

            // BBPRESS STYLES
            echo 'span.bbp-admin-links a, li.bbp-forum-info .bbp-forum-content {color: ' . $body_alt_text_color . ';}';
            echo 'span.bbp-admin-links a:hover {color: ' . $accent_color . ';}';
            echo '.bbp-topic-action #favorite-toggle a, .bbp-topic-action #subscription-toggle a, .bbp-single-topic-meta a, .bbp-topic-tags a, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbp-user-navigation ul li a, .bbp-pagination-links a, #bbp-your-profile fieldset input, #bbp-your-profile fieldset textarea, #bbp-your-profile, #bbp-your-profile fieldset {border-color: ' . $section_divide_color . ';}';
            echo '.bbp-topic-action #favorite-toggle a:hover, .bbp-topic-action #subscription-toggle a:hover, .bbp-single-topic-meta a:hover, .bbp-topic-tags a:hover, #bbp-user-navigation ul li a:hover, .bbp-pagination-links a:hover {border-color: ' . $accent_color . ';}';
            echo '#bbp-user-navigation ul li.current a, .bbp-pagination-links span.current {border-color: ' . $accent_color . ';background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '#bbpress-forums fieldset.bbp-form button[type=submit], #bbp_user_edit_submit, .widget_display_search #bbp_search_submit {background: ' . $alt_bg_color . '; color: ' . $secondary_accent_color . '}';
            echo '#bbpress-forums fieldset.bbp-form button[type=submit]:hover, #bbp_user_edit_submit:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            echo '#bbpress-forums li.bbp-header {border-top-color: ' . $accent_color . ';}';

            // CROWDFUNDING STYLES
            echo '.campaign-item .details-wrap {background-color:' . $inner_page_bg_color . ';}';
			echo '.atcf-profile-campaigns > li {border-color: ' . $section_divide_color . ';}';

            // EVENTS CALENDAR STYLES
            echo '.tribe-events-list-separator-month span {background-color:' . $inner_page_bg_color . ';}';
            echo '#tribe-bar-form, .tribe-events-list .tribe-events-event-cost span, #tribe-events-content .tribe-events-calendar td {background-color:' . $alt_bg_color . ';}';
            echo '.tribe-events-loop .tribe-events-event-meta, .tribe-events-list .tribe-events-venue-details {border-color: ' . $section_divide_color . ';}';

            // PAGE BACKGROUND STYLES
            if ( $bg_image_url != "" ) {
            	echo '.boxed-inner-page #container {background: transparent;}';
                if ( $background_image_size == "cover" ) {
                    echo 'body { background: transparent url("' . $bg_image_url . '") no-repeat center top fixed; background-size: cover; }';
                } else {
                    echo 'body { background: transparent url("' . $bg_image_url . '") repeat center top fixed; background-size: auto; }';
                }
            }

            // INNER PAGE BACKGROUND STYLES
            if ( $inner_bg_image_url != "" ) {
                if ( $inner_background_image_size == "cover" ) {
                    echo '#main-container { background: transparent url("' . $inner_bg_image_url . '") no-repeat center top; background-size: cover;background-attachment: fixed; }';
                } else {
                    echo '#main-container { background: transparent url("' . $inner_bg_image_url . '") repeat center top; background-size: auto;}';
                }
                echo '.timeline-items .standard-post-content, .blog-aux-options li a, .blog-aux-options li form input, .masonry-items .blog-item .masonry-item-wrap, .wp-tag-cloud li a, .masonry-items .portfolio-item-details {background: ' . $inner_page_bg_color . ';}';
                echo '.timeline-items .format-quote .standard-post-content:before, .timeline-items .standard-post-content.no-thumb:before {border-left-color: ' . $inner_page_bg_color . ';}';
            }

            // RESPONSIVE STYLES
            if ( $enable_responsive ) {
                echo '@media only screen and (max-width: 767px) {';
                echo 'nav .menu > li {border-top-color: ' . $section_divide_color . ';}';
                echo '}';
            }

            if ( $disable_mobile_animations ) {
                echo 'html.no-js .sf-animation, .mobile-browser .sf-animation, .apple-mobile-browser .sf-animation, .sf-animation[data-animation="none"], .image-banner-content.sf-animation[data-animation="none"] {
				opacity: 1!important;left: auto!important;right: auto!important;bottom: auto!important;-webkit-transform: scale(1)!important;-o-transform: scale(1)!important;-moz-transform: scale(1)!important;transform: scale(1)!important;}';
                echo 'html.no-js .sf-animation.image-banner-content, .mobile-browser .sf-animation.image-banner-content, .apple-mobile-browser .sf-animation.image-banner-content, .sf-animation[data-animation="none"].image-banner-content {
				bottom: 50%!important;}';
				echo '.mobile-browser .product-grid .product {opacity: 1!important;}';
            }

            // USER STYLES
            if ( $custom_css ) {
                echo "\n" . '/*========== User Custom CSS Styles ==========*/' . "\n";
                echo $custom_css;
            }

            // CLOSE STYLE TAG
            echo "</style>" . "\n";
        }

        add_action( 'wp_head', 'sf_custom_styles' );
    }

    /* CUSTOM JS OUTPUT
	================================================== */
    function sf_custom_script() {
        global $sf_options;
        $custom_js = $sf_options['custom_js'];

        if ( $custom_js ) {
            echo '<script>';
            echo $custom_js;
            echo '</script>';
        }
    }

    add_action( 'wp_footer', 'sf_custom_script' );
?>