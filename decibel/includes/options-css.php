<?php
/**
 * Print custom CSS set up in the theme options
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get background CSS
 *
 * @param string $selector
 * @param string $option_name
 */
function wolf_get_background_css( $selector, $option_name ) {

	$css = '';

	$url        = null;
	$img        = wolf_get_theme_option( $option_name . '_img' );
	$color      = wolf_get_theme_option( $option_name . '_color' );
	$repeat     = wolf_get_theme_option( $option_name . '_repeat' );
	$position   = wolf_get_theme_option( $option_name . '_position' );
	$attachment = wolf_get_theme_option( $option_name . '_attachment' );
	$size       = wolf_get_theme_option( $option_name . '_size' );
	$parallax   = wolf_get_theme_option( $option_name . '_parallax' );

	if ( $img )
		$url = 'url("'. wolf_get_url_from_attachment_id( $img, 'extra-large' ) .'")';

	if ( $color || $img ) {

		if ( $parallax ) {

			$css .= "$selector {background : $color $url $repeat fixed}";
			$css .= "$selector {background-position : 50% 0}";

		} else {
			$css .= "$selector {background : $color $url $position $repeat $attachment}";
		}

		if ( $size == 'cover' ) {

			$css .= "$selector {
				-webkit-background-size: 100%;
				-o-background-size: 100%;
				-moz-background-size: 100%;
				background-size: 100%;
				-webkit-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}";
		}

		if ( $size == 'resize' ) {

			$css .= "$selector {
				-webkit-background-size: 100%;
				-o-background-size: 100%;
				-moz-background-size: 100%;
				background-size: 100%;
			}";
		}
	}

	return $css;
}

/**
 * Inline CSS with the theme options
 */
function wolf_theme_options_css() {

	$css = '';


	/*-----------------------------------------------------------------------------------*/
	/*  Accent Color
	/*-----------------------------------------------------------------------------------*/
	$accent = wolf_get_theme_option( 'accent_color' );

	if ( $accent ) {
		$css .= "
		a,
		.add_to_cart_button:hover,
		.wolf-button:hover,
		input[type='submit']:hover,
		input[type='reset']:hover,
		.wolf-social:hover,
		.wolf-show-ticket-button:hover,
		.team-member-social-container a:hover,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		.content-light-font h1 a:hover, .content-light-font h2 a:hover,
		.content-light-font h3 a:hover, .content-light-font h4 a:hover,
		.content-light-font h5 a:hover, .content-light-font h6 a:hover,
		.site-footer a:hover,
		#site-navigation-secondary a:hover,
		.comment-reply-link,
		.widget a:not(.button):not(.wolf-button):hover,
		figure.effect-sadie .entry-meta a,
		#top-bar #lang_sel a.lang_sel_sel:hover,
		.video-sidebar-container .video-title a:hover,
		.video-category .video-author-name a:hover,
		.single-video .video-author-meta .video-author-name a:hover,
		.has-bg h2.entry-title a:hover,
		.post-archives .entry-content a:hover,
		.video-youtube-all.single-video .video-author-meta .video-author-name a:hover,
		.video-youtube.single-video .video-author-meta .video-author-name a:hover,
		.wolf-bigtweet-content:before{
			color:$accent;
		}


		.entry-meta a:hover, .edit-link a:hover,
		#work-filter a.active, #work-filter a:hover, #video-filter a.active,
		#video-filter a:hover, #gallery-filter a.active, #gallery-filter a:hover,
		#plugin-filter a.active, #plugin-filter a:hover,
		#theme-filter a.active, #theme-filter a:hover,
		#demo-filter a.active, #demo-filter a:hover,
		.menu-hover-text-color .nav-menu li a:hover,
		.menu-hover-text-color .nav-menu li.current-menu-item > a:first-child,
		.menu-hover-text-color .nav-menu li.current-menu-ancestor > a:first-child,
		.menu-hover-text-color .nav-menu li.active a:first-child,
		input[type='submit']#place_order:hover{
			color:$accent!important;
		}

		a#scroll-down:hover,
		a#top-arrow:hover,
		input[type='submit'],
		input[type='reset'],
		.wolf-button,
		.button,
		.add_to_cart_button,
		.wolf-show-ticket-button{
			background:$accent;
			border-color:$accent;
		}

		.content-light-font .border-button-accent-hover:hover,
		.border-button-accent-hover:hover,
		.trigger,
		.sidebar-footer input[type='submit'].wolf-mailchimp-submit:hover,
		input[type='submit']#place_order{
			background:$accent!important;
			border-color:$accent!important;
		}

		.sidebar-footer .wolf-mailchimp-email:focus,
		.bypostauthor .avatar{
			border-color:$accent;
		}


		.wolf-social.square:hover, .wolf-social.circle:hover {
			background: $accent;
			border-color: $accent;
		}

		.vc_progress_bar .vc_single_bar .vc_bar,
		.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
		.mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{
			background:$accent!important;
		}

		.wolf-social.hover-fill-in.square:hover,
		.wolf-social.hover-fill-in.circle:hover,
		.wolf-social.circle.wolf-social-no-custom-style.hover-fill-in:hover,
		.wolf-social.square.wolf-social-no-custom-style.hover-fill-in:hover,
		.icon-box.icon-type-circle .wolf-icon-no-custom-style.hover-fill-in:hover,
		.icon-box.icon-type-square .wolf-icon-no-custom-style.hover-fill-in:hover{
			-webkit-box-shadow: inset 0 0 0 1em $accent;
			box-shadow: inset 0 0 0 1em $accent;
			border-color: $accent;
		}

		.icon-box.icon-type-circle .wolf-icon-no-custom-style.hover-none:hover,
		.icon-box.icon-type-square .wolf-icon-no-custom-style.hover-none:hover{
			background:$accent;
			border-color:$accent!important;
		}

		.pricing-table-currency,
		.pricing-table-price,
		.pricing-table-strike:before{
			color:$accent!important;
		}

		#navbar-container .nav-menu li.button-style > a:first-child span,
		#navbar-container-left .nav-menu li.button-style > a:first-child span,
		#navbar-mobile .nav-menu li.button-style > a:first-child span{
			background-color:$accent!important;
		}

		#navbar-container .nav-menu li.button-style > a:first-child span:hover,
		#navbar-container-left .nav-menu li.button-style > a:first-child span:hover,
		#navbar-mobile .nav-menu li.button-style > a:first-child span:hover{
			background:" . wolf_color_brightness( $accent, -8 ) . ";
		}

		figure.effect-sadie .item-icon,
		#infscr-loading,
		.shortcode-videos-grid figure,
		.shortcode-works-grid figure,
		.shortcode-plugins-grid figure,
		.shortcode-albums-grid figure,
		.pricing-table-featured,
		.pricing-table-inner ul li.pricing-table-button a:hover,
		.pricing-table-active ul li.pricing-table-button a ,
		.nav-menu .product-count, .menu .product-count,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		.woocommerce span.soldout,
		.woocommerce-page span.soldout,
		.woocommerce .woocommerce-tabs .panel,
		.woocommerce-page .woocommerce-tabs .panel,
		.woocommerce .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page .woocommerce-tabs ul.tabs li.active,
		.pricing-table-price-strike:before,
		.notif-count{
			background:$accent;
		}

		::-moz-selection{
			background-color:$accent!important;
		}

		::selection{
			background-color:$accent!important;
		}
";
	}

	if ( 'standard' == wolf_get_theme_option( 'home_header_type' ) && ! wolf_is_slider_in_home_header() )
		$css .=  wolf_get_background_css( '.is-home-header .parallax-inner', 'header_bg' );
	$css .=  wolf_get_background_css( '.is-home-header .hero-inner', 'header_bg' );

	$css .=  wolf_get_background_css( '.footer-holder', 'footer_holder_bg' );

	$holder_overlay_img = wolf_get_theme_option( 'footer_holder_overlay_img' );
	$holder_overlay_pattern = ( $holder_overlay_img ) ? esc_url( wolf_get_url_from_attachment_id( $holder_overlay_img ) ) : '';
	$holder_overlay_opacity = wolf_get_theme_option( 'footer_holder_overlay_opacity' );
	$holder_overlay_color = wolf_get_theme_option( 'footer_holder_overlay_color' );

	if ( $holder_overlay_color ) {
		$css .= ".footer-holder-overlay{background-color:$holder_overlay_color;}";
	}

	if ( $holder_overlay_pattern ) {
		$css .= ".footer-holder-overlay{background-image:url($holder_overlay_pattern);}";
	}

	if ( $holder_overlay_opacity ) {
		$css .= '.footer-holder-overlay{opacity:' . $holder_overlay_opacity / 100 . '}';
	}

	if ( 'dark' == wolf_get_theme_option( 'header_bg_font_color' ) && is_page_template( 'page-templates/home.php' ) ) {
		$css .= "
			.menu-transparent.is-home-header #navbar-container .nav-menu li a,
			.menu-semi-transparent.is-home-header #navbar-container .nav-menu li a{
				color: #333;
			}

			.menu-transparent.is-home-header #navbar-container .nav-menu li a:hover,
			.menu-semi-transparent.is-home-header #navbar-container .nav-menu li a:hover{
				color: #0d0d0d;
			}

			.menu-transparent.is-home-header .logo-light{
				opacity:0;
			}

			.menu-transparent.is-home-header .logo-dark{
				opacity:1;
			}

			.menu-border.menu-transparent #navbar-container,
			.menu-border.menu-semi-transparent #navbar-container{
				border-bottom: 1px solid rgba(0,0,0,.1);
			}
		";

		if ( ! wolf_get_theme_option( 'sub_menu_bg_color' ) ) {

			$css .= "
				.menu-hover-border-top.menu-transparent.is-home-header .nav-menu li:hover a,
				.menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li:hover a,
				.menu-hover-border-top.menu-transparent.is-home-header .nav-menu li.current-menu-item > a:first-child,
				.menu-hover-border-top.menu-transparent.is-home-header .nav-menu li.current-menu-ancestor > a:first-child,
				.menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li.current-menu-item > a:first-child,
				.menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li.current-menu-ancestor > a:first-child {
					-webkit-box-shadow: inset 0px 3px 0px 0px #0d0d0d;
					box-shadow: inset 0px 3px 0px 0px #0d0d0d;
				}
			";
		}
	}

	if ( ! wolf_is_slider_in_home_header() ) {
		$overlay_img = wolf_get_theme_option( 'header_overlay_img' );
		$overlay_pattern = ( $overlay_img ) ? esc_url( wolf_get_url_from_attachment_id( $overlay_img ) ) : '';
		$overlay_opacity = wolf_get_theme_option( 'header_overlay_opacity' );
		$overlay_color = wolf_get_theme_option( 'header_overlay_color' );

		if ( $overlay_color ) {
			$css .= ".is-home-header .header-overlay{background-color:$overlay_color;}";
		}

		if ( $overlay_pattern ) {
			$css .= ".is-home-header .header-overlay{background-image:url($overlay_pattern);}";
		}

		if ( $overlay_opacity ) {
			$css .= '.is-home-header .header-overlay{opacity:' . $overlay_opacity / 100 . '}';
		}

	}

	/*-----------------------------------------------------------------------------------*/
	/*  Sub menu bg color
	/*-----------------------------------------------------------------------------------*/
	$sub_menu_bg_color = wolf_get_theme_option( 'sub_menu_bg_color' );

	if ( $sub_menu_bg_color ) {
		$css .= "

		#navbar-container .nav-menu li.cart-menu-item .cart-menu-panel,
		#navbar-container .nav-menu li ul.sub-menu,
		#navbar-container .nav-menu li ul.children,
		.menu-hover-plain-color #navbar-container .nav-menu li:hover a,
		.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-item > a:first-child,
		.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-ancestor > a:first-child,
		.menu-hover-plain-color #navbar-container .nav-menu li.active > a:first-child,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li:hover a,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-item > a:first-child,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-ancestor > a:first-child,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.active > a:first-child{
			background-color:$sub_menu_bg_color!important;
		}

		.menu-hover-border-top.menu-transparent.is-home-header .nav-menu li:hover a,
		.menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li:hover a,
		.menu-hover-border-top.menu-transparent.is-home-header .nav-menu li.current-menu-item > a:first-child,
		.menu-hover-border-top.menu-transparent.is-home-header .nav-menu li.current-menu-ancestor > a:first-child,
		.menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li.current-menu-item > a:first-child,
		.menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li.current-menu-ancestor > a:first-child,
		.menu-hover-border-top.menu-transparent.has-header-image.show-title-area .nav-menu li:hover a,
		.menu-hover-border-top.menu-semi-transparent.has-header-image.show-title-area .nav-menu li:hover a,
		.menu-hover-border-top.menu-transparent.has-header-image.show-title-area .nav-menu li.current-menu-item > a:first-child,
		.menu-hover-border-top.menu-transparent.has-header-image.show-title-area .nav-menu li.current-menu-ancestor > a:first-child,
		.menu-hover-border-top.menu-semi-transparent.has-header-image.show-title-area .nav-menu li.current-menu-item > a:first-child,
		.menu-hover-border-top.menu-semi-transparent.has-header-image.show-title-area .nav-menu li.current-menu-ancestor > a:first-child {
			-webkit-box-shadow: inset 0px 3px 0px 0px $sub_menu_bg_color;
			box-shadow: inset 0px 3px 0px 0px $sub_menu_bg_color;
		}
	";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Sub bg color
	/*-----------------------------------------------------------------------------------*/
	$sub_menu_color = wolf_get_theme_option( 'sub_menu_color' );

	if ( $sub_menu_color ) {
		$css .= "
		/*#navbar-container-right .wolf-social,
		#navbar-container-right .widget-title,
		#navbar-container-right,
		#navbar-container-right a,
		#navbar-container-right a:hover,
		#navbar-container-right .wolf-twitter-widget ul.wolf-tweet-list li:before,*/
		.wolf #navbar-container .nav-menu li.cart-menu-item .cart-menu-panel a,
		.wolf #navbar-container .nav-menu li ul.sub-menu span,
		.wolf #navbar-container .nav-menu li ul.children span,
		.wolf #navbar-container .nav-menu li ul.sub-menu li:before,
		.wolf #navbar-container .nav-menu li ul.children li:before,
		.menu-dark.menu-hover-plain-color .nav-menu li:hover a,
		.menu-dark.menu-hover-plain-color .nav-menu li.current-menu-item > a:first-child,
		.menu-dark.menu-hover-plain-color .nav-menu li.current-menu-ancestor > a:first-child,
		.menu-light.menu-hover-plain-color .nav-menu li:hover a,
		.menu-light.menu-hover-plain-color .nav-menu li.current-menu-item > a:first-child,
		.menu-light.menu-hover-plain-color .nav-menu li.current-menu-ancestor > a:first-child,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li:hover a,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-item > a:first-child,
		.sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-ancestor > a:first-child{
			color:$sub_menu_color!important;
		}
";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Loader
	/*-----------------------------------------------------------------------------------*/
	$spinner_color = wolf_get_theme_option( 'spinner_color' );
	$loading_overlay_color = wolf_get_theme_option( 'loading_overlay_color' );

	if ( $loading_overlay_color ) {
		$css .= "#loading-overlay{background:$loading_overlay_color}";
	}

	if ( $spinner_color ) {
		$css .= ".loader2-double-bounce1,
		.loader2-double-bounce2,
		.loader3 > div,
		.loader4-cube1,
.loader4-cube2,
.loader5,
.loader6-dot1, .loader6-dot2,
.loader7 > div,
.loader8-container1 > div, .loader8-container2 > div, .loader8-container3 > div
{background-color:$spinner_color}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Overlay Menu
	/*-----------------------------------------------------------------------------------*/
	$overlay_menu_bg = wolf_get_theme_option( 'overlay_menu_bg' );
	$overlay_opacity = wolf_get_theme_option( 'overlay_menu_bg_opacity' );
	$overlay_opacity = ( $overlay_opacity ) ? $overlay_opacity / 100 : 1;

	if ( $overlay_menu_bg ) {
		$css .= '
			#navbar-container-overlay{
				background-color:rgba(' . wolf_hex_to_rgb( $overlay_menu_bg )  . ', ' . $overlay_opacity . ');
			}
		';
	}

	$overlay_menu_color = wolf_get_theme_option( 'overlay_menu_color' );

	if ( $overlay_menu_color ) {
		$css .= '
			#navbar-container-overlay,
			#navbar-container-overlay a{
				color:' .$overlay_menu_color . '!important;
			}
		';
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Entry Meta
	/*-----------------------------------------------------------------------------------*/

	$entry_meta_font = wolf_get_theme_option( 'entry_meta_font_name' );
	$entry_meta_selectors = '.entry-meta, .category, .edit-link, .author-link, .author-description, .share-link,
	.page-title-container .subheading, .page-title-container .category-description p';

	if ( $entry_meta_font ) {
		$css .= "$entry_meta_selectors{font-family:'$entry_meta_font'}";
	}

	$entry_meta_font_weight = wolf_get_theme_option( 'entry_meta_font_weight' );

	if ( $entry_meta_font_weight ) {
		$css .= "$entry_meta_selectors{font-weight:$entry_meta_font_weight}";
	}

	$entry_meta_font_transform = wolf_get_theme_option( 'entry_meta_font_transform' );

	if ( 'uppercase' == $entry_meta_font_transform ) {
		$css .= "$entry_meta_selectors{text-transform:uppercase}";
	}

	$entry_meta_font_style = wolf_get_theme_option( 'entry_meta_font_style' );

	if ( $entry_meta_font_style ) {
		$css .= "$entry_meta_selectors{font-style:$entry_meta_font_style}";
	}

	$entry_meta_letterspacing = wolf_get_theme_option( 'entry_meta_font_letter_spacing' );

	if ( $entry_meta_letterspacing ) {
		$entry_meta_letterspacing = $entry_meta_letterspacing . 'px';
		$css .= "$entry_meta_selectors{letter-spacing:$entry_meta_letterspacing}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Heading Font
	/*-----------------------------------------------------------------------------------*/

	$heading_font = wolf_get_theme_option( 'heading_font_name' );
	$heading_selectors = 'h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title';

	if ( $heading_font ) {
		$css .= "$heading_selectors{font-family:'$heading_font'}";
	}

	$heading_font_weight = wolf_get_theme_option( 'heading_font_weight' );

	if ( $heading_font_weight ) {
		$css .= "$heading_selectors{font-weight:$heading_font_weight}";
	}

	$heading_font_transform = wolf_get_theme_option( 'heading_font_transform' );

	if ( 'uppercase' == $heading_font_transform ) {
		$css .= "$heading_selectors{text-transform:uppercase}";
	}

	$heading_font_style = wolf_get_theme_option( 'heading_font_style' );

	if ( $heading_font_style ) {
		$css .= "$heading_selectors{font-style:$heading_font_style}";
	}

	$heading_letterspacing = wolf_get_theme_option( 'heading_font_letter_spacing' );

	if ( $heading_letterspacing ) {
		$heading_letterspacing = $heading_letterspacing . 'px';
		$css .= "$heading_selectors{letter-spacing:$heading_letterspacing}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Page title Font
	/*-----------------------------------------------------------------------------------*/

	$page_title_font = wolf_get_theme_option( 'page_title_font_name' );
	$page_title_selectors = 'h1.page-title';

	if ( $page_title_font ) {
		$css .= "$page_title_selectors{font-family:'$page_title_font'}";
	}

	$page_title_font_weight = wolf_get_theme_option( 'page_title_font_weight' );

	if ( $page_title_font_weight ) {
		$css .= "$page_title_selectors{font-weight:$page_title_font_weight}";
	}

	$page_title_font_transform = wolf_get_theme_option( 'page_title_font_transform' );

	if ( 'uppercase' == $page_title_font_transform ) {
		$css .= "$page_title_selectors{text-transform:uppercase}";
	}

	$page_title_font_style = wolf_get_theme_option( 'page_title_font_style' );

	if ( $page_title_font_style ) {
		$css .= "$page_title_selectors{font-style:$page_title_font_style}";
	}

	$page_title_letterspacing = wolf_get_theme_option( 'page_title_font_letter_spacing' );

	if ( $page_title_letterspacing ) {
		$page_title_letterspacing = $page_title_letterspacing . 'px';
		$css .= "$heading_selectors{letter-spacing:$heading_letterspacing}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Menu Font
	/*-----------------------------------------------------------------------------------*/

	$menu_font = wolf_get_theme_option( 'menu_font_name' );
	$menu_selectors = '.nav-menu li a, #navbar-container-right';

	if( $menu_font ) {
		$css .= "$menu_selectors{ font-family:'$menu_font'}";
	}

	$menu_font_weight = wolf_get_theme_option( 'menu_font_weight' );

	if( $menu_font_weight ) {
		$css .= "$menu_selectors{font-weight:$menu_font_weight}";
	}

	$menu_font_transform = wolf_get_theme_option( 'menu_font_transform' );

	if ( 'uppercase' == $menu_font_transform ) {
		$css .= "$menu_selectors{text-transform:uppercase}";
	}

	$menu_font_style = wolf_get_theme_option( 'menu_font_style' );

	if ( $menu_font_style ) {
		$css .= "$menu_selectors{font-style:$menu_font_style}";
	}

	$menu_letterspacing = wolf_get_theme_option( 'menu_font_letter_spacing' );

	if ( $menu_letterspacing ) {
		$menu_letterspacing = $menu_letterspacing . 'px';
		$css .= "$menu_selectors{letter-spacing:$menu_letterspacing}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Body Font
	/*-----------------------------------------------------------------------------------*/

	$body_font = wolf_get_theme_option( 'body_font_name' );
	$body_selectors = 'body, blockquote.testimonial-content, .wolf-slide-subtitle';

	if( $body_font ) {
		$css .= "$body_selectors{font-family:'$body_font'}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Backgrounds
	/*-----------------------------------------------------------------------------------*/

	if ( 'boxed' == wolf_get_theme_option( 'layout' ) ) {
		$css .= wolf_get_background_css( 'body.wolf', 'body_bg' );
	}

	if ( 'boxed' == wolf_get_theme_option( 'layout' ) && ( wolf_get_theme_option( 'body_bg_color' ) || wolf_get_theme_option( 'body_bg_img' ) ) )
		$css .= '#page{background:none;}';

	// page
	//$css .= wolf_get_background_css( '.wolf #page-content', 'page_bg' );

	if ( 'light' == wolf_get_theme_option( 'page_bg_font_color' ) ) {
		$css .= "
			body{
				color:white;
			}
		";
	}

	// footer
	$css .= wolf_get_background_css( 'site_footer_bg', '.site-footer' );

	/*-----------------------------------------------------------------------------------*/
	/*  Custom CSS
	/*-----------------------------------------------------------------------------------*/

	if ( wolf_get_theme_option( 'c' ) ) {
		$css .= stripslashes( wolf_get_theme_option( 'c' ) );
	}

	if ( get_option( 'wolf_theme_css_' . wolf_get_theme_slug() ) ) {
		$css .= stripslashes( get_option( 'wolf_theme_css_' . wolf_get_theme_slug() ) );
	}

	if ( WOLF_DEBUG ) {
		return $css;
	} else {
		return wolf_compact_css( $css );
	}
} // end function

if ( ! function_exists( 'wolf_output_theme_options_css' ) ) {
	/**
	 * Output the custom CSS
	 */
	function wolf_output_theme_options_css() {
		echo '<style type="text/css">';
		echo '/* Theme settings */' . "\n";
	    	echo wolf_theme_options_css();
	    	echo '</style>';
	}
	add_action( 'wp_head', 'wolf_output_theme_options_css' );
}
